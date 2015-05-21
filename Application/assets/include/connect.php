<?php
if (!defined('safeGuard')) {
    die('Direct access not permitted');
}
require_once(__ROOT__ . '/assets/include/functions.php');
session_start();
/**
 * Connects the DB to the application
 */
class Connect{

/**
 * Redirects the user to a page.
 */
	function redirect($extra = "index.php", $status = 401){
		$local_url = url();
		session_write_close();
		header("location: $local_url/$extra", $status);
		die();
	}

	function getUrl(){
		return url();
	}

	protected function connection(){
			global $mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase;
			require_once(__ROOT__ . '/assets/include/config.php');
			$mysqli = new mysqli($mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase);
			$mysqli->set_charset("utf8");
			return $mysqli;
	}
	function verified_login($mail, $pass)
	{
			$mysqli = $this->connection();
			$mail = $mysqli->real_escape_string($mail);
			$pass = $mysqli->real_escape_string($pass);
			$pass = hash_pass($mail, $pass);
			if (!($stmt = $mysqli->prepare("SELECT `firstname`, `member_id` FROM `Member` WHERE `email_id`=? AND `password`=?"))) 			{
					echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$stmt->bind_param('ss', $mail, $pass)) {
					echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			if (!$stmt->execute()) {
					echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			if (!($res = $stmt->get_result())) {
					echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			$logged_in = ($res->num_rows == 1);
			if($logged_in){
				$result = $res->fetch_array();
				$_SESSION['mail'] = $mail;
				$_SESSION['first_name'] = $result['firstname'];
			}
			$res->close();
			return $logged_in;
	}

	function register_user($mail, $pass, $verification_pass, $first_name, $last_name, $age, $gender, $lenghth, $weight)
	{
			$mysqli = $this->connection();
			$mail = $mysqli->real_escape_string($mail);
			$pass = $mysqli->real_escape_string($pass);
			if(!$mysqli->real_escape_string($pass)==$mysqli->real_escape_string($verification_pass))
			{
					$status["statuscode"]="Passwords do not match";
			}else{
					$pass = hash_pass($mail, $pass);
					if (!($stmt = $mysqli->prepare("INSERT INTO `Member` (`email_id`, `password`, `firstname`, `lastname`, `age`, `gender`, `length`, `weight`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);"))) {
							echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
					}
					if (!$stmt->bind_param('ssssisdd', $mail, $pass, $first_name, $last_name, $age, $gender, $lenghth, $weight)) {
							echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
					}
					if (!$stmt->execute()) {
							echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
							$status["statuscode"]="Registration failed, please try again later";
					}
					$status["statuscode"]="";
					$status['success']=TRUE;
					$_SESSION['mail'] = $mail;
					$_SESSION['first_name'] = $first_name;
			}
			return $status;
	}

	function get_user_session($session = -1){
			$mysqli     = $this->connection();
			$resultset  = array();
			$mail       = $mysqli->real_escape_string($_SESSION['mail']);
			$member_res = $mysqli->query("SELECT `member_id` FROM `Member` WHERE `email_id`='$mail'");
			if($member_res){
					$row       = $member_res->fetch_assoc();
					$member_id = $row['member_id'];
					if($session < 0){
							$sql = "SELECT * FROM `Heartrate` WHERE `member_id`='$member_id' ORDER BY `session_nr` ";
					}else{
							$sql = "SELECT * FROM `Heartrate` WHERE `member_id`='$member_id' AND `session_nr`='$session' ORDER BY `time` ASC";
					}
					$results   = $mysqli->query($sql);
					$old_nr= 0;
					$nr=1;
					for($i=0; $i<$results->num_rows;$i++){
							$tmp = $results->fetch_array();
							if($tmp['session_nr']!=$old_nr){
									$old_nr=$tmp['session_nr'];
									$nr=$nr+1;
							}
							$tmp['new_session_nr'] = $nr;
							array_push($resultset, $tmp);
					}
					$results->close();
			}
			$member_res->close();
			return $resultset;
	}

	function get_total_session(){
			$mysqli     = $this->connection();
			$resultset  = array();
			$session    = array();
			$mail       = $mysqli->real_escape_string($_SESSION['mail']);
			$member_res = $mysqli->query("SELECT `member_id` FROM `Member` WHERE `email_id`='$mail'");
			if($member_res){
					$row    = $member_res->fetch_assoc();
					$id= $row['member_id'];
					$sql = "SELECT `session_nr`, `training_type_nr`, `date` FROM `Training_session` WHERE `member_id`='$id' ORDER BY `session_nr`";
					$results    =   $mysqli->query($sql);
					$session_nr=1;
					for($i=0; $i<$results->num_rows; $i++){
							array_push($resultset, $results->fetch_array());
					}
					$results->close();
			}
			$member_res->close();
			return $resultset;
	}

	function write_heartbeat($heartbeat) {
		$temp_session = 0;
		if (property_exists($heartbeat, "BPM") && property_exists($heartbeat, "UUID")) {
			$obj 		= new stdClass();
			$mysqli = $this->connection();
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
									$session_query = "SELECT MAX(`session_nr`) FROM `Training_session` WHERE `member_id`=".$member_id.";";
									$max_session_result = $mysqli -> query($session_query);
									$max_session = $max_session_result->fetch_array();
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
	function register_device($email, $pass, $UUID){
		$logged_in = $this->verified_login($mail, $pass);
		$obj = new stdClass();
		if($logged_in){
			$obj -> status = "login";
		}else{
			$obj -> status = "failure";
		}
		return $obj;
	}
}
?>
