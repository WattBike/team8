<?php
define('safeGuard', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once (__ROOT__ . '/assets/classes/class.connect.php');
$connection = new Connect();
require_once (__ROOT__ . '/assets/include/header.php');

if (key_exists("mail", $_SESSION)) {
	if (isset($_GET['logout'])) {
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		}
		unset($_SESSION['mail']);
		unset($_SESSION['first_name']);
		session_destroy();
		header("Location:index.php");
		$location = FALSE;
	} else {
		$location = TRUE;
	}
} elseif (isset($_POST['email']) && ($_POST['email'] != "")) {
	if (!$connection -> verified_login($_POST['email'], $_POST['password'])) {
		$_SESSION['status'] = "Your username and or password were incorrect. Please try again.";
		$location = FALSE;
	} else {
		$location = TRUE;
	}
} else {
	$location = FALSE;
}
require_once (($location) ? "display.php" : "login.php");
require_once (__ROOT__ . '/assets/include/footer.php');
?>
