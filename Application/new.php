<?php
	session_start();
	define('safeGuard', TRUE);
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__ . '/assets/classes/class.connect.php');
		$connection = new Connect;
	if (!in_array("mail", $_SESSION) || $_SESSION['mail']==""):
	 	$connection->redirect("index.php", 401);
  	else:
	require_once(__ROOT__ . '/assets/include/header.php');
?>
<div class="container">
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name']; ?></small></h1>
    <h2>Your training</h2>
    <a class="btn btn-primary" href="display.php">Back</a>
    <a class="btn btn-warning" href="index.php">Logout</a>
    <br><br>
    <a class="btn btn-success">Start</a>
    <a class="btn btn-danger">Stop</a>
</div>

<?php require_once(__ROOT__ . '/assets/include/footer.php'); endif;?>
