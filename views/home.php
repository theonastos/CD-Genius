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
                                          die("Query failed");
                                    }
                                    if (mysqli_num_rows($result) > 0) {
                                          while($row = mysqli_fetch_assoc($result)) {
                                                $artist_result = mysqli_query($db, "SELECT artist_name FROM artists WHERE artist_id = '$row[artist_id]'");
                                                if (!$result) {
                                                      die("Query to select artist failed!");
                                                }
                                                $artist_row = mysqli_fetch_array($artist_result);
                                                echo '<div class="col-sm-4 col-lg-4 col-md-4">
                                                <div class="thumbnail">
                                                      <img src="http://placehold.it/140x100" alt="">
                                                      <div class="caption">
                                                            <h4 class="pull-right">' . $row['price'] . '&#8364;</h4>
                                                            <h4><a href="#">' . $row['name'] . '</a></h4>
                                                            <h4>' . $artist_row['artist_name'] . '</h4>
                                                      </div>
                                                </div>
                                          </div>';
                                    //echo "id: " . $row["product_id"]. " - Name: " . $row["name"]. "<br>";
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


<!--<div class="col-sm-4 col-lg-4 col-md-4">
                                    <div class="thumbnail">
                                          <img src="http://placehold.it/320x150" alt="">
                                          <div class="caption">
                                                <h4 class="pull-right">$94.99</h4>
                                                <h4><a href="#">Fifth Product</a>
                                                </h4>
                                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                          </div>
                                    </div>
                              </div>-->