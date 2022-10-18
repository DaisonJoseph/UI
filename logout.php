<?php
	session_start();

	unset($_SESSION['name']);
	echo 'unset name';
	exit(header("Location: login.php"));
?>