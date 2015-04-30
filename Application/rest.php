<?php
define('safeGuard', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once (__ROOT__ . '/assets/include/connect.php');
$res = array();
if (isset($_GET['time'])) {
	$res = get_user_session(-1, $_GET['time']);
} elseif (isset($_GET['bpm'])) {
	$obj = new stdClass();
	$obj -> BPM = $_GET['bpm'];
	$obj -> UUID = $_GET['UUID'];
	$res = write_heartbeat($obj);
} else {
	$res = get_user_session(-1);
}

echo json_encode($res);
?>
