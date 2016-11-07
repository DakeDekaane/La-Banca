<?php
	session_start();
	if(isset($_SESSION['nickname'])) {
		session_unset();
		session_destroy();
		header('location: ./index.php');
	}
	else {
		header('location: ./error.html');
	}
	exit();
?>