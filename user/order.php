<?php

	include $_SERVER['DOCUMENT_ROOT'] . "/CD-Genius/config.php";

	session_start();

	function cart($db) {
		if(isset($_POST['add-to-cart'])){

			$userID = $_SESSION['user-id'];
			$productID = $_POST['product-id'];

			$query = "SELECT order_id FROM orders WHERE user_id = '$userID' and product_id = '$productID'";

			$result = mysqli_query($db,$query);
			if (!$result) {
				die('Invalid query: ' . mysqli_error($db));
			}

			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

			$count = mysqli_num_rows($result);

			if($count == 1) {

				$orderID = $row['order_id'];

				$query = "UPDATE orders SET qty=qty+1 WHERE order_id='$orderID'";

				$data = mysqli_query($db, $query);

				if(!$data){
					die('Invalid query: ' . mysqli_error($db));
				}

			}else {
			
				$query = "INSERT INTO orders(user_id, product_id) VALUES ('$userID', '$productID')";

				$data = mysqli_query($db, $query);

				if(!$data){
					die('Invalid query: ' . mysqli_error($db));
				}
			}


		}
	}

	if(!$_SESSION['login_user']){

		echo "<br>You need to login first";
		echo "</br></br>This page will redirect in 5 seconds";

		header( "refresh:5;url=$base_url/views/home.php" );
		
	}else{

		cart($db);

		header("location: $base_url/views/home.php");

	}
?>
