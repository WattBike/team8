<?php
	session_start();
	define('safeGuard', TRUE);
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__ . '/assets/include/connect.php');
	$connection = new Connect;
$res = array();
if (isset($_GET['session'])) {
	$res = $connection->get_user_session($_GET['session']);
} elseif (isset($_GET['bpm'])) {
	$obj = new stdClass();
	$obj -> BPM = $_GET['bpm'];
	$obj -> UUID = $_GET['UUID'];
	$res = $connection->write_heartbeat($obj);
} elseif (isset($_POST['email'])) {
	$res = $connection->register_device($_POST['email'], $_POST['pass'], $_POST['UUID']);
} else {
	$res = $connection->get_user_session(-1);
}
echo json_encode($res);
?>
