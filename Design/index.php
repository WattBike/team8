<?php
global $base_url;
define('safeGuard', TRUE);
define('dbConnected', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/include/connect.php');
require_once(__ROOT__ . '/include/config.php');
if (isset($_POST['email']) && ($_POST['email'] != "")):
    if (!verified_login($_POST['email'], $_POST['password'])) {
        header("Location: $base_url/index.php", 401);
    } else {
        header("Location: $base_url/display.php", 200);
    }
else:
//require_once(__ROOT__ . '/include/header.php');
?>
<?php
//if (!defined('safeGuard')) {
//	die('Direct access not permitted');
//}
require_once (__ROOT__ . '/include/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>WattBike</title>

		<!-- Bootstrap -->
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/index.css" rel="stylesheet"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <style>
            .well{
                background-color: #e1eeff;
            }
            .navbar{
                background-color: #e1eeff;
            }
        </style>
	</head>
	<body>
        <div class="container-fluid">
            <div class="row">

                <div class="col-xs-12 col-md-6 col-md-offset-3 well">
                    <form class="form-signin" method="post">
                        <img class="img-circle img-responsive center-block form-group" src="images/logo.png" width="120"/>
                        <div class="form-group">
                            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <a href="display.php" class="btn btn-primary btn-lg btn-block" type="submit">
                            Sign in
                        </a>
                        <a href="register.php" class="btn btn-default btn-lg btn-block pull-right"> Sign up </a>
                    </form><!-- /form -->
                    <a href="#" class="forgot-password"> Forgot the password? </a>
                </div><!-- /card-container -->
<?php
endif;
require_once "include/footer.php";
?>
