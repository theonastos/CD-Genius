<?php

	$base_url = "http://" . $_SERVER['SERVER_NAME'] . "/CD-Genius";
	$root_path = $_SERVER['DOCUMENT_ROOT'] . "/CD-Genius";

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'Thodoris7');
	define('DB_DATABASE', 'web_store');
	
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
?>