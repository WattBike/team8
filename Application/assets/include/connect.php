<?php
if(!defined('safeGuard')) {
   die('Direct access not permitted');
}
    require_once "database.php";

    $mysqli = mysqli_connect($mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase);
    $mysqli->set_charset("utf8");
    define('dbConnected', !mysqli_connect_errno($mysqli));
?>