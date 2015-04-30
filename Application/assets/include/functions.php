<?php
function hash_pass($username, $password) {
	global $passwordPreSalt;
	require_once (__ROOT__ . '/assets/include/config.php');
	$hash = "";
	$hash = hash('whirlpool', $passwordPreSalt . $password);
	for ($i = 0; $i < 5; $i++) {
		$hash = hash('whirlpool', $passwordPreSalt . $hash . $username);
	}
	return $hash;
}
?>
