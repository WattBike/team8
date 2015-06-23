<?php

class Functions {
	/**
	 * <p>Hashes the password as described as a best practice in 
	 * <a href=ttps://www.ncsc.nl/binaries/content/documents/ncsc-nl/actueel/whitepapers/ict-beveiligingsrichtlijnen-voor-webapplicaties/3/ICT%2Bbeveiligingsrichtlijnen%2Bvoor%2Bwebapplicaties%2B%2B%2Bdeel%2B2%2B%2Bleesversie%2B.pdf">The NCSC guidelines</a>
	 * Chapter 6. </p>
	 */
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

	/**
	 * Returns the current URL to apply redirects to.
	 * @return string URL
	 */
	function url() {
		if (isset($_SERVER['HTTPS'])) {
			$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
		} else {
			$protocol = 'http';
		}
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		return $protocol . "://" . $_SERVER['HTTP_HOST'] . $uri;
	}

	/**
	 * Show the current menu item and wheter it's active or not
	 * @param string the URL it'll link to
	 * @param string the name for the menu item
	 * @return string an HTML element to display in the menu
	 * TODO implement this in header.php
	 */
	function echoListItem($requestUri, $name) {
		$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

		if ($current_file_name == $requestUri){
			echo '<li class="active"><a href="'.$this->url().$requestUri.'.php">'.$name.'</a></li>';
		}else{
			echo '<li><a href="'.$this->url().$requestUri.'.php">'.$name.'</a></li>';
		}
	}

}
?>
