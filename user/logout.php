<?php
	include $_SERVER['DOCUMENT_ROOT'] . "/CD-Genius/config.php";

	session_start();

	if(session_destroy()) {
		header("location: $base_url/views/home.php");
	}
?>