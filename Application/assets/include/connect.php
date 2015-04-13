<?php
if (!defined('safeGuard')) {
    die('Direct access not permitted');
}
function verified_login($mail, $pass)
{
    global $mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase;
    require_once(__ROOT__ . '/assets/include/functions.php');
    require_once(__ROOT__ . '/assets/include/config.php');
    $mysqli = new mysqli($mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase);
    $mysqli->set_charset("utf8");
    $mail = $mysqli->real_escape_string($mail);
    $pass = $mysqli->real_escape_string($pass);
    $pass = hash_pass($mail, $pass);
    if (!($stmt = $mysqli->prepare("SELECT email_id, password FROM register_tabel WHERE email_id=? AND password =?"))) {
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
    return $logged_in;
}
?>
