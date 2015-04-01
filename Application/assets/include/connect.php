<?php
    require_once "database.php";

    $mysqliConnection = mysqli_connect($mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase);
    if (mysqli_connect_errno($mysqliConnection)){
        echo $errorMessage = "Failed to connect to server: ".mysqli_connect_error();
    }else{
        echo $Message="Connection succes";
    }
?>