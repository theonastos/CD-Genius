<?php
      if(isset($_POST['search-submit'])){
            $searchq = $_POST['search'];
            $searchq = preg_replace("#^0-9a-z#i", "", $searchq);

            $query = "SELECT products.product_id, products.name, products.price, artists.artist_name, genres.genre_name 
            FROM products 
            JOIN artists ON products.artist_id = artists.artist_id
            JOIN genres ON products.genre_id = genres.genre_id
            WHERE products.name LIKE '%$searchq%'
            OR artists.artist_name LIKE '%$searchq%'
            OR genres.genre_name LIKE '%$searchq%'";
            $result = mysqli_query($db, $query);
      }else {
            $query = "SELECT products.product_id, products.name, products.price, artists.artist_name
            FROM products 
            JOIN artists ON products.artist_id = artists.artist_id";
            $result = mysqli_query($db, $query);
      }
      if (!$result) {
            die('Invalid query: ' . mysqli_error($db));
      }
      if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                  echo '<div class="col-sm-3 col-lg-3 col-md-3">
                  <div class="thumbnail">
                        <img src="http://localhost/CD-Genius/assets/Images/place-holder.png" alt="">
                        <div class="caption">
                              <h4 class="pull-right">' . $row['price'] . '&#8364;</h4>
                              <h4>' . $row['name'] . '</h4>
                              <form id="order-form" action="../user/order.php" method="post" role="form">
                                    <button type="submit" name="add-to-cart" id="add-to-cart" class="pull-right" >
                                          <input type="hidden" name="product-id" value="'. $row['product_id'] .'">
                                          <span class="glyphicon glyphicon-shopping-cart pull-right"></span>
                                    </button>
                              </form>
                              <h4>' . $row['artist_name'] . '</h4>
                        </div>
                  </div>
            </div>';
      }
      }else{
            echo "<h4>0 results<h4>";
      }
?>