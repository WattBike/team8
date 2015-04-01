<?php
if(!defined('safeGuard')) {
   die('Direct access not permitted');
}
    require_once "database.php";

    $mysqliConnection = mysqli_connect($mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase);
    define('dbConnected', !mysqli_connect_errno($mysqliConnection));
?>