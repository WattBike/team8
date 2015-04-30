<?php
define('safeGuard', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once (__ROOT__ . '/assets/include/connect.php');
$res = array();
if (isset($_GET['time'])) {
	$res = get_user_session(-1, $_GET['time']);
} elseif (isset($_GET['bpm'])) {
	$res = new stdClass();
	$res -> BPM = $_GET['bpm'];
	$res -> Time = date('Y-m-d H:i:s');
	$res -> UUID = $_GET['UUID'];
} else {
	$res = get_user_session(-1);
}

echo json_encode($res);
?>
