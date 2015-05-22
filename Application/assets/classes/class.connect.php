<?php
if (!defined('safeGuard')) {
	die('Direct access not permitted');
}
require_once (__ROOT__ . '/assets/classes/class.functions.php');
require_once (__ROOT__ . '/assets/classes/class.db.php');
session_start();
/**
 * Connects the DB to the application
 */
class Connect {

	/**
	 * Redirects the user to a page.
	 */
	function redirect($extra = "index.php", $status = 401) {
		$local_url = url();
		session_write_close();
		header("location: $local_url/$extra", $status);
		die();
	}

	function getUrl() {
		return url();
	}

	function verified_login($mail, $pass) {
		$pass = hash_pass($mail, $pass);
		$db = new db;
		$res = $db -> query_2("SELECT `firstname`, `member_id` FROM `Member` WHERE `email_id`=? AND `password`=?", FALSE, "ss", $mail, $pass);
		$logged_in = (count($res['result']) == 1);
		if ($logged_in) {
			$result = $res['result'][0];
			$_SESSION['mail'] = $mail;
			$_SESSION['first_name'] = $result['firstname'];
		}
		return $logged_in;
	}

	function register_user($mail, $pass, $verification_pass, $first_name, $last_name, $age, $gender, $lenghth, $weight) {
		if (!$pass == $verification_pass) {
			$status["statuscode"] = "Passwords do not match";
		} else {
			$db = new db;
			$pass = hash_pass($mail, $pass);
			$res = $db -> query_8("INSERT INTO `Member` (`email_id`, `password`, `firstname`, `lastname`, `age`, `gender`, `length`, `weight`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);", TRUE, "ssssisdd", $mail, $pass, $first_name, $last_name, $age, $gender, $lenghth, $weight);
			if ($res['result']) {
				$_SESSION['mail'] = $mail;
				$_SESSION['first_name'] = $first_name;
			}
		}
		return $res['result'];
	}

	function get_user_session($session = -1) {
		$db = new db;
		$member_res = $db->query_1("SELECT `member_id` FROM `Member` WHERE `email_id`=?",FALSE,"s",$_SESSION['mail']);
		if (count($member_res['result']) == 1) {
			$row = $member_res['result'][0];
			$member_id = $row['member_id'];
			if ($session < 0) {
				$results = query_1("SELECT * FROM `Heartrate` WHERE `member_id`=? ORDER BY `session_nr`",FALSE,"i",$member_id) ;
			} else {
				$results = query_2("SELECT * FROM `Heartrate` WHERE `member_id`=? AND `session_nr`=? ORDER BY `time` ASC",FALSE,"ii",$member_id, $session) ;
			}
			$old_nr = 0;
			$nr = 1;
			for ($i = 0; $i < count($results['result']); $i++) {
				$tmp = $results['result'][$i];
				if ($tmp['session_nr'] != $old_nr) {
					$old_nr = $tmp['session_nr'];
					$nr = $nr + 1;
				}
				$tmp['new_session_nr'] = $nr;
				array_push($resultset, $tmp);
			}
		}
		return $resultset;
	}

	function get_total_session() {
		$db = new db;
		$session = array();
		$member_res = $db->query_1("SELECT `member_id` FROM `Member` WHERE `email_id`=?",FALSE,"s",$_SESSION['mail']);
		if (count($member_res['result']) == 1) {
			$row = $member_res['result'][0];
			$member_id = $row['member_id'];
			$results = query_1("SELECT `session_nr`, `training_type_nr`, `date` FROM `Training_session` WHERE `member_id`=? ORDER BY `session_nr`",FALSE,"i",$member_id);
			$results = $mysqli -> query($sql);
			for ($i = 0; $i < count($results['result']); $i++) {
				array_push($resultset, $results['result'][$i]);
			}
			$results -> close();
		}
		return $resultset;
	}

	function write_heartbeat($heartbeat) {
		$temp_session = 0;
		if (property_exists($heartbeat, "BPM") && property_exists($heartbeat, "UUID")) {
			$obj = new stdClass();
			$mysqli = $this -> connection();
			if (!($stmt = $mysqli -> prepare("SELECT `member_id` FROM `Member_devices` WHERE `UUID`=?;"))) {
				$obj -> status = "Logging heartbeat failed, please try again later";
			}
			if (!$stmt -> bind_param('s', $heartbeat -> UUID)) {
				$obj -> status = "Logging heartbeat failed, please try again later";
			}
			if (!$stmt -> execute()) {
				$obj -> status = "Logging heartbeat failed, please try again later";
			}
			if (!($res = $stmt -> get_result())) {
				$obj -> status = "Logging heartbeat failed, please try again later";
			} else {
				$logged_in = ($res -> num_rows == 1);
				if ($logged_in) {
					$result = $res -> fetch_all();
					$member_id = $result[0][0];
					$session_query = "SELECT MAX(`session_nr`) FROM `Training_session` WHERE `member_id`=" . $member_id . ";";
					$max_session_result = $mysqli -> query($session_query);
					$max_session = $max_session_result -> fetch_array();
					if (!($stmt = $mysqli -> prepare("INSERT INTO `Heartrate` (`bpm`, `time`, `session_nr`, `member_id`) VALUES (?, CURRENT_TIMESTAMP, ?, ?);"))) {
						$obj -> status = "Heartbeat failed to register";
					}

					if (!$stmt -> bind_param('iii', $heartbeat -> BPM, $max_session[0], $member_id)) {
						$obj -> status = "Heartbeat failed to register";
					}
					if (!$stmt -> execute()) {
						$obj -> status = "Heartbeat failed to register";
					} else {
						$obj -> status = "Heartbeat Success";
					}
				}
			}
			return $obj;
		} else {
			$obj -> status = "failure";
			return $obj;
		}
	}

	//TODO write this to perfection
	function register_device($email, $pass, $UUID) {
		$logged_in = $this -> verified_login($email, $pass);
		$obj = new stdClass();
		if ($logged_in) {
			$obj -> status = "login";
		} else {
			$obj -> status = "failure";
		}
		return $obj;
	}

}
?>
