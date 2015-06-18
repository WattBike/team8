<?php
if (!defined('safeGuard')) {
	die('Direct access not permitted');
}
require_once (__ROOT__ . '/assets/classes/class.functions.php');
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
		<link href="assets/css/index.css" rel="stylesheet"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300italic,700,300' rel='stylesheet' type='text/css'>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			<?php if(key_exists('mail', $_SESSION)):?>
            	.well{background-color: #e1eeff;}
            	body{background-color: #e1eeff;}
            <?php else:?>
            	.well {background-color: #e1eeff;}
				.navbar {background-color: #e1eeff;}
            <?php endif;?>
        </style>
	</head>
	<body>
		<?php if(key_exists('mail', $_SESSION)):?>
	        <nav class="navbar navbar-inverse navbar-fixed-top">
	            <div class="container-fluid">
	            <!-- Brand and toggle get grouped for better mobile display -->
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                    <a class="navbar-brand" href="index.php">WattApp</a>
	                </div>
	
	                <!-- Collect the nav links, forms, and other content for toggling -->
	                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                    <ul class="nav navbar-nav">
	                        <li><a href="display.php">Home</a></li>
	                        <li><a href="new.php">Start new</a></li>
	                        <li><a href="session.php">Results</a></li>
	                        
	                    </ul>
	                    <ul class="nav navbar-nav navbar-right">
	                        <li><a href="profile.php">Profile</a></li>
	                        <li><a href="#">Settings</a></li>
	                        <li><a href="index.php?logout=true">Logout</a></li>
	                    </ul>
	                </div><!-- /.navbar-collapse -->
	              </div><!-- /.container-fluid -->
	        </nav>
	        <?php endif;?>
        <div class="container-fluid">
            <div class="row border">
