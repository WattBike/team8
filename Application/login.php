<?php
if (!defined('safeGuard')) {
	die('Direct access not permitted');
}
?>
<div class="col-md-12 well">
	<?php if(isset($status)):
	?>
	<p class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $status; ?>
	</p>
	<?php endif; ?>
	<form class="form-signin" method="post" action="index.php">
		<img class="img-circle img-responsive center-block form-group" src="https://randomuser.me/api/portraits/lego/1.jpg" width="96"/>
		<div class="form-group">
			<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
		</div>
		<div class="form-group checkbox">
			<label>
				<input type="checkbox" value="remember-me">
				Remember me </label>
		</div>
		<button class="btn btn-primary btn-lg btn-block" type="submit">
			Sign in
		</button>
		<a href="register.php" class="btn btn-default btn-lg btn-block pull-right"> Sign up </a>
	</form><!-- /form -->
	<a href="#" class="forgot-password"> Forgot the password? </a>
</div><!-- /card-container -->