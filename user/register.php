<?php

	require_once("../config.php");
		
	function newUser($db){

		$email = $_POST['email']; 
		$userName = $_POST['username']; 
		$password = $_POST['password'];
		$confirmation = $_POST['confirm-password'];
		$firstName = $_POST['first_name'];
		$lastName = $_POST['last_name'];
		$address = $_POST['address'];
		$creditCard = $_POST['credit_card'];

		if ($password == $confirmation){
			$query = "INSERT INTO user(email, username, password, first_name, last_name, address, credit_card) VALUES ('$email','$userName','$password', '$firstName', '$lastName', '$address', '$creditCard')"; 
			
			$data = mysqli_query($db, $query);

			if($data) { 
				echo "Your registration is completed...</br>You can now Log In";
				echo "</br></br>This page will redirect in 5 seconds";

				header( "refresh:5;url=../views/home.php" );

			}else {
				die('Invalid query: ' . mysqli_error($db));
			}
		}else{
			echo "Your passwords do not match";

			header( "refresh:5;url=../views/register-form.php" );

		}
	}
		
	function signUp($db) {

		if(!empty($_POST['username'])) {
		
			$myusername = mysqli_real_escape_string($db,$_POST['username']);
      		$mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      		$sql = "SELECT user_id FROM user WHERE username = '$myusername' and password = '$mypassword'";
      		
      		$result = mysqli_query($db,$sql);
      		if (!$result) {
         			die('Invalid query: ' . mysqli_error($db));
      		}
			
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

      		$count = mysqli_num_rows($result);

			if($count == 1) {

				echo "Sorry you are already a registered user";
				echo "</br></br>This page will redirect in 5 seconds";

				header( "refresh:5;url=../views/register-form.php" );

			} else {

				newUser($db);

			} 
		} 
	}

	if(isset($_POST['register-submit'])) {

		signUp($db);
		
	}

?>