<?php
    global $base_url;
    define('safeGuard', TRUE);
    define('dbConnected', TRUE);
    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/assets/classes/class.connect.php');
	$connection = new Connect;
    if (isset($_SESSION['mail'])):
		$base_url = $connection->getUrl();
        header('Location: $base_url/display.php', 200);
    else:
	require_once(__ROOT__ . '/assets/include/header.php');
?>
<div class="col-xs-12 col-md-6 col-md-offset-3 well">
	<form class="form-signin" method="post" action="index.php">
		<?php if(isset($_SESSION['status'])):?>
			<div class="alert alert-danger"><?php echo $_SESSION['status'];?></div>
		<?php unset($_SESSION['status']);endif;?>
		<img class="img-circle img-responsive center-block form-group" src="assets/images/logo.png" width="120"/>
		<div class="form-group">
			<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
		</div>
		<button type="submit" class="btn btn-primary btn-lg btn-block" type="submit"> Sign in </button>
		<a href="register.php" class="btn btn-default btn-lg btn-block pull-right"> Sign up </a>
	</form><!-- /form -->
	<a href="#" class="forgot-password"> Forgot the password? </a>
</div><!-- /card-container -->
<?php
require_once (__ROOT__ . '/assets/include/footer.php');
endif;
?>
