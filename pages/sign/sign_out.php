<?php
	session_start();
	session_destroy();

	require_once($_SERVER['DOCUMENT_ROOT'] . "/assets/file/analyticsmanage.php");

	$cookies = explode(';', $_SERVER['HTTP_COOKIE']);

	foreach ($cookies as $cookie) {
		$parts = explode('=', $cookie);
		$name = trim($parts[0]);
		setcookie($name, '', time()-1000);
		setcookie($name, '', time()-1000, '/');
	}
?>

<script> location.href = '/pages/sign/'; </script>
