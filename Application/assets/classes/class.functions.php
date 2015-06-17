<?php

class Functions{
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
	
	function url(){
	    if(isset($_SERVER['HTTPS'])){
	        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	    }
	    else{
	        $protocol = 'http';
	    }
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $uri;
	}
}
?>
