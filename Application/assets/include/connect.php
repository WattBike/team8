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
    if (!($stmt = $mysqli->prepare("SELECT email_id, password, firstname, member_id FROM Member WHERE email_id=? AND password =?"))) {
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
    $_SESSION['mail'] = $mail;
    $result = $res->fetch_all();
    $_SESSION['first_name'] = $result[0][2];
    $_SESSION['member_id'] = $result[0][3];
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
        if (!($stmt = $mysqli->prepare("INSERT INTO `member` (`email_id`, `password`, `firstname`, `lastname`, `age`, `gender`, `length`, `weight`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);"))) {
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
?>
