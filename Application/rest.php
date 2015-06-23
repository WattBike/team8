<?php
	/**
	 * This API is stateless and therefore REST I guess?
	 */
	define('safeGuard', TRUE);
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__ . '/assets/classes/class.connect.php');
	$connection = new Connect;
	$res = array();
	//Check if we're dealing with a session request
	if (isset($_GET['session'])) {
		$res = $connection->get_user_session($_GET['session']);
		
	//Check if we're dealing with a request to write a heartbeat
	} elseif (isset($_GET['bpm'])) {
		$obj = new stdClass();
		$obj -> BPM = $_GET['bpm'];
		$obj -> UUID = $_GET['UUID'];
		$res = $connection->write_heartbeat($obj);
		
	//Check if we're trying to log in
	} elseif (isset($_POST['email'])&&isset($_POST['UUID'])&&isset($_POST['pass'])) {
		$res = $connection->register_device($_POST['email'], $_POST['pass'], $_POST['UUID']);
	//Check if we're trying to log out
	} elseif (isset($_POST['UUID'])&&isset($_POST['first_active'])) {
		$res = $connection->unregister_device($_POST['first_active'], $_POST['UUID']);
	//you're doing none of that. We'll just give you all your sessions (or an error if you forgot to log in)
	}else {
		$res = $connection->get_user_session(-1);
	}
	echo json_encode($res);
?>
