<?php 

	function deleteProduct($db){

      	$id = $_POST['delete-id'];

      	$query = "DELETE FROM products WHERE product_id = '$id'";

      	$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}

      }

	function productList($db){
		global $result;
		if (mysqli_num_rows($result) > 0) {
	           	while($row = mysqli_fetch_assoc($result)) {
	           		$productID = $row['product_id'];
	          		echo '<tr>
						<td>' . $row['product_id'] .'</td>
						<td>' . $row['name'] . '</td>
						<td>' . $row['price'] . '</td>
						<td>' . $row['artist_name'] . '</td>
						<td>' . $row['genre_name'] . '</td>
						<td>' .$row['label_name'] . '</td>
						<form action="admin_panel.php" method="post">
							<input type="hidden" name="delete-id" value="' . $productID . '"/>
							<td><input type="submit" name="delete-product-button" value="delete"/></td>
						</form>
					</tr>';
	          	}
	      }else{
	      	echo "<h4>0 <h4>";
	      }
	}

	function artistList($db){
		$query = "SELECT artist_id, artist_name FROM artists";
		$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}
		if (mysqli_num_rows($result) > 0) {
	           	while($row = mysqli_fetch_assoc($result)) {
	           		echo '<option>' . $row['artist_name'] . '</option>';
	         	}
	      }
	}

	function labelList($db){
		$query = "SELECT label_id, label_name FROM labels";
		$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}
		if (mysqli_num_rows($result) > 0) {
	           	while($row = mysqli_fetch_assoc($result)) {
	           		echo '<option>' . $row['label_name'] . '</option>';
	         	}
	      }
	}

	function genreList($db){
		$query = "SELECT genre_id, genre_name FROM genres";
		$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}
		if (mysqli_num_rows($result) > 0) {
	           	while($row = mysqli_fetch_assoc($result)) {
	           		echo '<option>' . $row['genre_name'] . '</option>';
	         	}
	      }
	}

	function addProduct($db){

		$p_name = $_POST['product-name'];
		$p_price = $_POST['product-price'];
		$p_artist = $_POST['product-artist'];
		$p_label = $_POST['product-label'];
		$p_genre = $_POST['product-genre'];

		$query = "SELECT artists.artist_id, labels.label_id, genres.genre_id 
			FROM artists, labels, genres
			WHERE artists.artist_name = '$p_artist'
			AND labels.label_name = '$p_label'
			AND genres.genre_name = '$p_genre'";

		$result = mysqli_query($db, $query);	
		if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}

	      $row = mysqli_fetch_assoc($result);
	     	
	     	$p_artist = $row['artist_id'];
	      $p_label = $row['label_id'];
	      $p_genre = $row['genre_id'];
	           	
	      $query = "INSERT INTO products(name, price, artist_id, label_id, genre_id) VALUES ('$p_name', '$p_price', '$p_artist', '$p_label', '$p_genre')";
	      $result = mysqli_query($db, $query);	
		if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}
	}

	function addArtist($db){

		$a_name = $_POST['artist-field'];

		$query = "INSERT INTO artists(artist_name) VALUES ('$a_name')";
		$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}
	}

	function addLabel($db){

		$l_name = $_POST['label-field'];

		$query = "INSERT INTO labels(label_name) VALUES ('$l_name')";
		$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}
	}

	function addGenre($db){

		$g_name = $_POST['genre-field'];

		$query = "INSERT INTO genres(genre_name) VALUES ('$g_name')";
		$result = mysqli_query($db, $query);
      	if (!$result) {
      		die('Invalid query: ' . mysqli_error($db));
      	}
	}
	
?>