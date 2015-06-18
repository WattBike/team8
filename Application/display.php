<?php
    global $base_url;
    define('safeGuard', TRUE);
    define('dbConnected', TRUE);
    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/assets/classes/class.connect.php');
	$connection = new Connect;
    if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
        header('Location: index.php', 401);
    else:
		require_once(__ROOT__ . '/assets/include/header.php');
?>
<div class="col-xs-12 col-md-8 col-md-offset-2">
	<h1 align="center"> Welcome </h1>
</div>
<div class="col-xs-12 col-md-6 col-md-offset-3">
	<?php if(isset($_SESSION['status'])):?>
			<div class="alert alert-success"><?php echo $_SESSION['status'];?></div>
	<?php unset($_SESSION['status']);endif;?>
	<div id="nBgr" class="col-md-12">
		<center>
			<a href="session.php"><img src="assets/images/grBtn.jpg" width="90%"></a>
		</center>
	</div>
	<div id="nBgr" class="col-md-12">
		<a href="new.php" class="btn btn-primary btn-lg btn-block" role="button">Start</a>
		<a href="session.php" class="btn btn-primary btn-lg btn-block" role="button">Results</a>
		<a href="profile.php" class="btn btn-primary btn-lg btn-block" role="button">Profile</a>
		<a href="settings.php" class="btn btn-primary btn-lg btn-block" role="button">Settings</a>
		<a href="index.php?logout=true" class="btn btn-primary btn-lg btn-block" role="button">Log out</a>
	</div>

	<div id="nBgr" class="col-md-2">

	</div>
</div><!-- /card-container -->
<?php
require_once (__ROOT__ . '/assets/include/header.php');
endif;
?>