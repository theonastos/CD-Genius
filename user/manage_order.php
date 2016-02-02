<?php
	
	include $_SERVER['DOCUMENT_ROOT'] . "/CD-Genius/config.php";

	session_start();
	
	
		$userID = $_SESSION['user-id'];

		$query = "SELECT orders.order_id, products.name, products.price, orders.qty FROM  products
			JOIN orders ON products.product_id = orders.product_id
			JOIN user ON user.user_id = orders.user_id
			WHERE user.user_id = '$userID'";

		$result = mysqli_query($db, $query);
			if (!$result) {
				die('Invalid query: ' . mysqli_error($db));
			}

	function cartList($db){
		global $result;
		if (mysqli_num_rows($result) > 0) {
	           	while($row = mysqli_fetch_assoc($result)) {
	           		$entryID = $row['order_id'];
	          		echo '<tr>
						<td>' . $row['name'] . '</td>
						<td>' . $row['price'] . '</td>
						<td>' . $row['qty'] . '</td>
						<form class="form-group" action="manage_order.php" method="post">
							<input type="hidden" name="entry-id" value="' . $entryID . '"/>
							<td><input class="btn btn-default" type="submit" name="delete-product-button" value="delete"/>
							<input class="btn btn-default" type="submit" name="add-amount" value="+"/>
							<input class="btn btn-default" type="submit" name="remove-amount" value="-"/></td>
						</form>
					</tr>';
	          	}
	      }else{
	      	echo "<h4>0 products<h4>";
	      }
	}

	function deleteEntry($db){

		$entryID = $_POST['entry-id'];

		$query = "DELETE FROM orders WHERE order_id = '$entryID'";

		$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}
	}

	function addAmount($db){

		$entryID = $_POST['entry-id'];

		$query = "UPDATE orders SET qty=qty+1 WHERE order_id='$entryID' ";
		$result = mysqli_query($db, $query);
		if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}

	}

	function removeAmount($db){

		$entryID = $_POST['entry-id'];

		$query = "SELECT qty FROM orders WHERE order_id = '$entryID'";
		$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}

      	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		if($row['qty'] == 1){

			deleteEntry($db);
		
		}else {
			
			$query = "UPDATE orders SET qty=qty-1 WHERE order_id='$entryID'";
			$result = mysqli_query($db, $query);
      		if (!$result) {
      			die('Invalid query: ' . mysqli_error($db));
      		}

		}

	}

	if(isset($_POST['add-amount'])){
		
		addAmount($db);
		
		header("Refresh:0");	

	}

	if(isset($_POST['remove-amount'])){
		
		removeAmount($db);
		
		header("Refresh:0");	

	}

	if(isset($_POST['delete-product-button'])){
		
		deleteEntry($db);
		
		header("Refresh:0");	

	}

?>

<!DOCTYPE html>
<html lang="en">
	
	<?php include $root_path . "/views/_meta.php" ?>
	<body>
		<?php include $root_path . "/views/_header.php" ?>
		<div class="container">
			<h1 style="text-align:center">MANAGE ORDER</h1>
			<h3>Products</h3>
			<hr>
			<table style="width:100%">
				<tr style="font-weight:bold">
					<td>Name</td>
					<td>Price</td>
					<td>Quantity</td>
				</tr>
				<?php cartList($db); ?>
			</table>
		</div>
		<?php include $root_path . "/views/_footer.php" ?>
	</body>
</html>