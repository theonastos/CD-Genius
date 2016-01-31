<?php
      include ("../user/login.php");
?>
<!DOCTYPE html>
<html lang="en">
      <?php include "_meta.php" ?>
      <body>
            <?php include "_header.php" ?>
            <div class="container">
                  <div class="row">
                        <div class="row">
                              <?php
                                    $result = mysqli_query($db, "SELECT * FROM products");
                                    if (!$result) {
                                          die('Invalid query: ' . mysqli_error($db));
                                    }
                                    if (mysqli_num_rows($result) > 0) {
                                          while($row = mysqli_fetch_assoc($result)) {
                                                $artist_result = mysqli_query($db, "SELECT artist_name FROM artists WHERE artist_id = '$row[artist_id]'");
                                                if (!$result) {
                                                      die('Invalid query: ' . mysqli_error($db));
                                                }
                                                $artist_row = mysqli_fetch_assoc($artist_result);
                                                echo '<div class="col-sm-3 col-lg-3 col-md-3">
                                                <div class="thumbnail">
                                                      <img src="http://placehold.it/268x191" alt="">
                                                      <div class="caption">
                                                            <h4 class="pull-right">' . $row['price'] . '&#8364;</h4>
                                                            <h4>' . $row['name'] . '</h4>
                                                            <form id="order-form" action="../user/order.php" method="post" role="form">
                                                                  <button type="submit" name="add-to-cart" id="add-to-cart" class="pull-right" >
                                                                        <input type="hidden" name="product-id" value="'. $row['product_id'] .'">
                                                                        <span class="glyphicon glyphicon-shopping-cart pull-right"></span>
                                                                  </button>
                                                            </form>
                                                            <h4>' . $artist_row['artist_name'] . '</h4>
                                                      </div>
                                                </div>
                                          </div>';
                                    }
                                    }else{
                                          echo "0 results";
                                    }
                              ?>
                        </div>
                  </div>
            </div>
            <?php include "_footer.php" ?>
      </body>
</html>