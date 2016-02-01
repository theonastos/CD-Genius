<?php
   
	include("../config.php");
	include("functions.php");

	session_start();

	$query = "SELECT products.product_id, products.name, products.price, artists.artist_name, genres.genre_name , labels.label_name
            FROM products 
            JOIN artists ON products.artist_id = artists.artist_id
            JOIN genres ON products.genre_id = genres.genre_id
            JOIN labels ON products.label_id = labels.label_id";

      $result = mysqli_query($db, $query);
      	if (!$result) {
            die('Invalid query: ' . mysqli_error($db));
      }

	if(isset($_POST['add-product-button'])){
		
		addProduct($db);
		
		header("Refresh:0");	

	}

	if(isset($_POST['delete-product-button'])){

		deleteProduct($db);

		header("Refresh:0");	
	}

	if(isset($_POST['add-artist-button'])){

		addArtist($db);

		header("Refresh:0");	
	}

	if(isset($_POST['add-label-button'])){

		addLabel($db);

		header("Refresh:0");	
	}

	if(isset($_POST['add-genre-button'])){

		addGenre($db);

		header("Refresh:0");	
	}

?>

<!DOCTYPE html>
<html lang="en">
	
	<?php include "_meta.php" ?>
	<body>
		<h1 style="text-align:center">ADMIN PANEL</h1>
		<h3>Products</h3>
		<hr>
		<table style="width:100%">
			<tr style="font-weight:bold">
				<td>Product ID</td>
				<td>Name</td>
				<td>Price</td>
				<td>Artist</td>
				<td>Genre</td>
				<td>Label</td>
			</tr>
			<?php productList($db); ?>
		</table>
		<h3>Add Product</h3>
		<hr>
		<table style="width:100%">
			<tr style="font-weight:bold">
				<td>Name</td>
				<td>Price</td>
				<td>Artist</td>
				<td>Genre</td>
				<td>Label</td>
			</tr>
			<tr style="font-weight:bold">
				<form action="admin_panel.php" method="post">
					<td><Input type="text" name="product-name" placeholder="Name"/></td>
					<td><Input type="number" step="0.01" name ="product-price" placeholder="Price"/></td>
					<td>
						<select name="product-artist">
							<?php artistList($db); ?>
						</select>
					</td>
					<td>
						<select name="product-genre">
							<?php genreList($db); ?>
						</select>
					</td>
					<td>
						<select name="product-label">
							<?php labelList($db); ?>
						</select>
					</td>				
					<td><input type="submit" name="add-product-button" value="Add Product" onclick=""/></td>
				</form>
			</tr>
		</table>
		<h3>Add Artist</h3>
		<hr>
		<table style="width:100%">
			<form action="admin_panel.php" method="post">
				<input type="text" name="artist-field" value="" placeholder="Add New Artist"/>
				<input type="submit" name="add-artist-button" value="Add"/>
			</form>
		</table>
		<h3>Add Label</h3>
		<hr>
		<table style="width:100%">
			<form action="admin_panel.php" method="post">
				<input type="text" name="label-field" value="" placeholder="Add New Label"/>
				<input type="submit" name="add-label-button" value="Add"/>
			</form>
		</table>
		<h3>Add Genre</h3>
		<hr>
		<table style="width:100%">
			<form action="admin_panel.php" method="post">
				<input type="text" name="genre-field" value="" placeholder="Add New Genre"/>
				<input type="submit" name="add-genre-button" value="Add"/>
			</form>
		</table>
	</body>
</html>

