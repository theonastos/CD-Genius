<?php

	function orderAmount($db) {

		$userID = $_SESSION['user-id'];

		$query = "SELECT orders.product_id, products.product_id ,qty ,price FROM orders JOIN products ON orders.product_id = products.product_id WHERE orders.user_id = '$userID'";

		$result = mysqli_query($db, $query);
		if (!$result) {
			die('Invalid query: ' . mysqli_error($db));
		}

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {

				$totalAmount += $row['qty'] * $row['price'];

			}
			
			return $totalAmount;
		
		}else{
			
			return 0.00;
		
		}

	}

?>