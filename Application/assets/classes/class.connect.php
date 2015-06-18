<?php
if (!defined('safeGuard')) {
	die('Direct access not permitted');
}
session_start();
require_once (__ROOT__ . '/assets/classes/class.functions.php');
require_once (__ROOT__ . '/assets/classes/class.db.php');
/**
 * Connects the DB to the application
 */
class Connect {
	var $ID;
	/**
	 * Redirects the user to a page.
	 */
	function redirect($extra = "index.php", $status = 401) {
		$functions = new Functions();
		$local_url = $functions -> url();
		session_write_close();
		header("location: $local_url/$extra", $status);
		die();
	}

	function getUrl() {
		$functions = new Functions();
		return $functions -> url();
	}

	function verified_login($mail, $pass) {
		$functions = new Functions();
		$pass = $functions -> hash_pass($mail, $pass);
		$db = new db;
		$res = $db -> query_2("SELECT `firstname`, `member_id` FROM `Member` WHERE `email_id`=? AND `password`=?", FALSE, "ss", $mail, $pass);
		$logged_in = (count($res['result']) == 1);
		if ($logged_in) {
			$result = $res['result'][0];
			$_SESSION['mail'] = $mail;
			$_SESSION['first_name'] = $result['firstname'];
			$this -> ID = $result['member_id'];
		}
		return $logged_in;
	}

	function register_user($mail, $pass, $verification_pass, $first_name, $last_name, $age, $gender, $lenghth, $weight) {
		if (!$pass == $verification_pass) {
			$status["statuscode"] = "Passwords do not match";
		} else {
			$db = new db;
			$functions = new Functions();
			$pass = $functions -> hash_pass($mail, $pass);
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
		$resultset = array();
		$member_res = $db -> query_1("SELECT `member_id` FROM `Member` WHERE `email_id`=?", FALSE, "s", $_SESSION['mail']);
		if (count($member_res['result']) == 1) {
			$row = $member_res['result'][0];
			$member_id = $row['member_id'];
			if ($session < 0) {
				$results = $db -> query_1("SELECT * FROM `Heartrate` WHERE `member_id`=? ORDER BY `session_nr`", FALSE, "i", $member_id);
			} else {
				$results = $db -> query_2("SELECT * FROM `Heartrate` WHERE `member_id`=? AND `session_nr`=? ORDER BY `time` ASC", FALSE, "ii", $member_id, $session);
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
		$resultset = array();
		$session = array();
		$member_res = $db -> query_1("SELECT `member_id` FROM `Member` WHERE `email_id`=?", FALSE, "s", $_SESSION['mail']);
		if (count($member_res['result']) == 1) {
			$row = $member_res['result'][0];
			$member_id = $row['member_id'];
			$results = $db -> query_1("SELECT `session_nr`, `training_type_nr`, `date` FROM `Training_session` WHERE `member_id`=? ORDER BY `session_nr`", FALSE, "i", $member_id);
			for ($i = 0; $i < count($results['result']); $i++) {
				array_push($resultset, $results['result'][$i]);
			}
		}
		return $resultset;
	}

	function write_heartbeat($heartbeat) {
		$temp_session = 0;
		if (property_exists($heartbeat, "BPM") && property_exists($heartbeat, "UUID")) {
			$db = new db;
			$session = array();
			$res = $db -> query_1("SELECT `member_id` FROM `Member_devices` WHERE `UUID`=?;", FALSE, "s", $heartbeat -> UUID);
			$logged_in = (count($res['result']) == 1);
			if ($logged_in) {
				$member_id = $res['result'][0]['member_id'];
				$max_session_res = $db -> query_1("SELECT MAX(`session_nr`) FROM `Training_session` WHERE `member_id`=?;", FALSE, "i", $member_id);
				$max_session = $max_session_res['result'][0]['MAX(`session_nr`)'];
				$res = $db -> query_3("INSERT INTO `Heartrate` (`bpm`, `time`, `session_nr`, `member_id`) VALUES (?, CURRENT_TIMESTAMP, ?, ?);", TRUE, "iii", $heartbeat -> BPM, $max_session, $member_id);
				if ($res['result']) {
					$obj -> status = "Heartrate recorded successfully!";
				} else {
					$obj -> status = "Heartrate failed to save.";
				}
				return $obj;
			} else {
				$obj -> status = "Unfortunately, no account could be found to save your heartrate too";
				return $obj;
			}
		}
	}

	function register_device($email, $pass, $UUID) {
		$db = new db;
		$logged_in = $this -> verified_login($email, $pass);
		$member_id = $this -> ID;

		$obj = new stdClass();
		if ($logged_in) {
			$obj -> status = "login";
			$res = $db -> query_1("SELECT `member_id`,`first_active` FROM `Member_devices` WHERE `UUID`=?;", FALSE, "s", $UUID);
			if (array_key_exists(0, $res['result'])) {
				if ($res['result'][0]['member_id'] == $member_id) {
					$obj -> desc = "Device already registered to " . $res['result'][0]['member_id'];
					$obj -> date = $res['result'][0]['first_active'];
				} else {
					$obj -> status = "failure";
					$obj -> desc = "we're sorry but you can only have one user/device at this moment. Please use a different device.";
				}
			} else {
				$obj -> desc = "Welcome new device of " . $member_id;
				$time = $db -> query_0("SELECT CURRENT_TIMESTAMP;", FALSE);
				$obj -> date = $time['result'][0]['CURRENT_TIMESTAMP'];
				$res = $db -> query_3("INSERT INTO `Member_devices` VALUES (?, ?, ?);", TRUE, "sis", $UUID, $member_id, $obj -> date);
			}
		} else {
			$obj -> status = "failure";
			$obj -> desc = "Username and/or password were incorrect";
		}
		return $obj;
	}

	/**
	 *
	 */
	function unregister_device($first_active, $UUID) {
		$db = new db;
		$obj = new stdClass();
		$res = $db -> query_2("DELETE FROM `Member_devices` WHERE `UUID`=? AND `first_active`=?;", TRUE, "ss", $UUID, $first_active);
		$obj -> status = "attempted";
		return $obj;
	}

	function read_trainings_types() {
		$db = new db;
		$res = $db -> query_0("SELECT * FROM `Training_type`;", FALSE);
		return $res['result'];
	}

	function new_training($type) {
		$db = new db;
		$result = FALSE;
		$member_res = $db -> query_1("SELECT `member_id` FROM `Member` WHERE `email_id`=?", FALSE, "s", $_SESSION['mail']);
		$logged_in = (count($member_res['result']) == 1);
		if ($logged_in) {
			$member_id = $member_res['result'][0]['member_id'];
			$max_session_res = $db -> query_0("SELECT MAX(`session_nr`) FROM `Training_session`;", FALSE);
			$max_session = $max_session_res['result'][0]['MAX(`session_nr`)'];
			$db -> query_3("INSERT INTO `Training_session` VALUES(CURRENT_TIMESTAMP, ?, ?, ?);", TRUE, "iii", $type, $max_session + 1, $member_id);
			$result = TRUE;
		}
		return $result;
	}

	function graph_data($session = -1) {
		$array = $this->get_user_session($session);
		$bpm = array();
		$time = array();
		var_dump(count($array));
		for ($i=0; $i < count($array); $i++) { 
			$bpm[$i] = $array[$i]['bpm'];
			$time[$i] = $array[$i]['time'];
		}
		$result['bpm']=$bpm;
		$result['time']=$time;
		return $result;
	}

}
?>
