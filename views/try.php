<?php
      include ("../user/login.php");

      

      $result = mysqli_query($db, "SELECT * FROM products");
      if (!$result) {
            die("Query to show fields from table failed");
      }
      if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                  //echo "id: " . $row["product_id"]. " - Name: " . $row["name"]. "<br>";
            }
      }else{
            echo "0 results";
      }

      /*
      for($i=0; $i<$fields_num; $i++) {
            $field = mysqli_fetch_field($result);
            echo "<td>$field->name</td></br>";
      }

      while($row = mysqli_fetch_row($result)){
            

            echo "<tr>";
            printf("%s\n", $row[1]);
            // $row is array... foreach( .. ) puts every element of $row to $cell variable

                  foreach ($temp as $cell) {
                        echo "$cell <br>";
                  }

      }*/
?>



<!DOCTYPE html>
<html lang="en">
      <?php include "_meta.php" ?>
      <body>
            <?php include "_header.php" ?>
            <div class="container">
                  <ul class="products">
                        <?php
                        $result = mysqli_query($db, "SELECT * FROM products");
                        if (!$result) {
                              die("Query to show fields from table failed");
                        }
                        if (mysqli_num_rows($result) > 0) {
                              while($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="col-sm-4 col-lg-4 col-md-4">
                                          <div class="thumbnail">
                                                <img src="http://placehold.it/140x100" alt="">
                                                <div class="caption">
                                                      <h4 class="pull-right">' . $row['price'] . '&#8364;</h4>
                                                      <h4><a href="#">' . $row['name'] . '</a></h4>
                                                </div>
                                          </div>
                                    </div>';
                              //echo "id: " . $row["product_id"]. " - Name: " . $row["name"]. "<br>";
                              }
                        }else{
                              echo "0 results";
                        }
                        ?>
                  </ul>
            </div>
            <?php include "_footer.php" ?>
      </body>
</html>

