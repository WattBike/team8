<?php
if (!defined('safeGuard')) {
    die('Direct access not permitted');
}
session_start();
function connect(){
    global $mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase;
    require_once(__ROOT__ . '/assets/include/functions.php');
    require_once(__ROOT__ . '/assets/include/config.php');
    $mysqli = new mysqli($mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase);
    $mysqli->set_charset("utf8");
    return $mysqli;
}
function verified_login($mail, $pass)
{
    $mysqli = connect();
    $mail = $mysqli->real_escape_string($mail);
    $pass = $mysqli->real_escape_string($pass);
    $pass = hash_pass($mail, $pass);
    if (!($stmt = $mysqli->prepare("SELECT `email_id`, `password`, `firstname` FROM `Member` WHERE `email_id`=? AND `password`=?"))) {
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
        $result = $res->fetch_all();
        $_SESSION['mail'] = $mail;
        $_SESSION['first_name'] = $result[0][2];
    }else{
        session_destroy();
    }
    $res->close();
    return $logged_in;
}

function register_user($mail, $pass, $verification_pass, $first_name, $last_name, $age, $gender, $lenghth, $weight)
{
    $mysqli = connect();
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

function get_user_session($id = -1){
    $mysqli   = connect();
    $resultset= array();
 	$mail     = $mysqli->real_escape_string($_SESSION['mail']);
    $member_res = $mysqli->query("SELECT `member_id` FROM `Member` WHERE `email_id`='$mail'");
    if($member_res){
        $row       = $member_res->fetch_assoc();
        $member_id = $row['member_id'];
        if($id>-1){
            $sql = "SELECT * FROM `Heartrate` WHERE `member_id`='$member_id' AND `session_nr`='$id' ORDER BY time";
        }else{
            $sql = "SELECT * FROM `Heartrate` WHERE `member_id`='$member_id' ORDER BY time";
        }
        $results   = $mysqli->query($sql);
        for($i; $i<$results->num_rows;$i++){
            array_push($resultset, $results->fetch_array());
        }
        $results->close();
    }
    $member_res->close();
    return $resultset;
}
?>
