<?php
if (!defined('safeGuard')) {
	die('Direct access not permitted');
}
session_start();
date_default_timezone_set('UTC');
function connect() {
	global $mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase;
	require_once (__ROOT__ . '/assets/include/functions.php');
	require_once (__ROOT__ . '/assets/include/config.php');
	$mysqli = new mysqli($mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase);
	$mysqli -> set_charset("utf8");
	return $mysqli;
}

function verified_login($mail, $pass) {
	$mysqli = connect();
	$mail = $mysqli -> real_escape_string($mail);
	$pass = $mysqli -> real_escape_string($pass);
	$pass = hash_pass($mail, $pass);
	if (!($stmt = $mysqli -> prepare("SELECT `email_id`, `password`, `firstname` FROM `Member` WHERE `email_id`=? AND `password`=?"))) {
		echo "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
	}
	if (!$stmt -> bind_param('ss', $mail, $pass)) {
		echo "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
	}
	if (!$stmt -> execute()) {
		echo "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
	}
	if (!($res = $stmt -> get_result())) {
		echo "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
	}
	$logged_in = ($res -> num_rows == 1);
	if ($logged_in) {
		$result = $res -> fetch_all();
		$_SESSION['mail'] = $mail;
		$_SESSION['first_name'] = $result[0][2];
	} else {
		session_destroy();
	}
	$res -> close();
	return $logged_in;
}

function register_user($mail, $pass, $verification_pass, $first_name, $last_name, $age, $gender, $lenghth, $weight) {
	$mysqli = connect();
	$mail = $mysqli -> real_escape_string($mail);
	$pass = $mysqli -> real_escape_string($pass);
	if (!$mysqli -> real_escape_string($pass) == $mysqli -> real_escape_string($verification_pass)) {
		$status["statuscode"] = "Passwords do not match";
	} else {
		$pass = hash_pass($mail, $pass);
		if (!($stmt = $mysqli -> prepare("INSERT INTO `Member` (`email_id`, `password`, `firstname`, `lastname`, `age`, `gender`, `length`, `weight`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);"))) {
			echo "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param('ssssisdd', $mail, $pass, $first_name, $last_name, $age, $gender, $lenghth, $weight)) {
			echo "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			echo "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
			$status["statuscode"] = "Registration failed, please try again later";
		}
		$status["statuscode"] = "";
		$status['success'] = TRUE;
		$_SESSION['mail'] = $mail;
		$_SESSION['first_name'] = $first_name;
	}
	return $status;
}

function get_user_session($id = -1, $time = "2015-01-01 00:00:00") {
	$mysqli = connect();
	$resultset = array();
	$mail = $mysqli -> real_escape_string($_SESSION['mail']);
	$member_res = $mysqli -> query("SELECT `member_id` FROM `Member` WHERE `email_id`='$mail'");
	if ($member_res) {
		$row = $member_res -> fetch_assoc();
		$member_id = $row['member_id'];
		if ($id > -1 && $time != date('Y-m-d H:i:s')) {
			$sql = "SELECT * FROM `Heartrate` WHERE `member_id`='$member_id' AND `session_nr`='$id' AND `time`>'$time' ORDER BY time";
		} elseif ($id > -1) {
			$sql = "SELECT * FROM `Heartrate` WHERE `member_id`='$member_id' AND `session_nr`='$id' ORDER BY time";
		} else {
			$sql = "SELECT * FROM `Heartrate` WHERE `member_id`='$member_id' ORDER BY time";
		}
		$results = $mysqli -> query($sql);
		for ($i = 0; $i < $results -> num_rows; $i++) {
			array_push($resultset, $results -> fetch_array());
		}
		$results -> close();
	}
	$member_res -> close();
	return $resultset;
}

function register_device($mail, $pass, $UUID) {
	$mysqli = connect();
	$mail = $mysqli -> real_escape_string($mail);
	$pass = $mysqli -> real_escape_string($pass);
	$pass = hash_pass($mail, $pass);
	if (!($stmt = $mysqli -> prepare("SELECT `member_id` FROM `Member` WHERE `email_id`=? AND `password`=?"))) {
		$obj -> status = "Login failed to register";
	}
	if (!$stmt -> bind_param('ss', $mail, $pass)) {
		$obj -> status = "Login failed to register";
	}
	if (!$stmt -> execute()) {
		$obj -> status = "Login failed to register";
	}
	if (!($res = $stmt -> get_result())) {
		$obj -> status = "Login failed to register";
	}
	$logged_in = ($res -> num_rows == 1);
	if ($logged_in) {
		$result = $res -> fetch_all();
		$member_id = $result[0][1];
		if (!($stmt = $mysqli -> prepare("INSERT INTO `Member_devices` (`member_id`, `UUID`) VALUES (?, ?);"))) {
			$obj -> status = "Login failed to register";
		}
		if (!$stmt -> bind_param('is', $member_id, $UUID)) {
			$obj -> status = "Login failed to register";
		}
		if (!$stmt -> execute()) {
			$obj -> status = "Login failed to register";
		} else {
			$obj -> status = "Login Success";
		}
	}
}

function write_heartbeat($heartbeat) {
	if (property_exists($heartbeat, "BPM") && property_exists($heartbeat, "UUID")) {
		$mysqli = connect();
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
				if (!($stmt = $mysqli -> prepare("INSERT INTO `Heartrate` (`bpm`, `time`, `session_nr`, `member_id`) VALUES (?, CURRENT_TIMESTAMP, ?, ?);"))) {
					$obj -> status = "Heartbeat failed to register";
				}
				$temp_session = 0;
				if (!$stmt -> bind_param('iii', $heartbeat -> BPM, $temp_session, $member_id)) {
					$obj -> status = "Heartbeat failed to register";
				}
				if (!$stmt -> execute()) {
					$obj -> status = "Heartbeat failed to register";
				} else {
					$obj -> status = "Heartbeat Success";
				}
			}
		}
	} else {
		$obj -> status = "failure";
	}
	return $obj;
}
?>
