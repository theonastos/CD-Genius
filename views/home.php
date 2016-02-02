<?php
      
      include $_SERVER['DOCUMENT_ROOT'] . "/CD-Genius/config.php";

      session_start();

?>

<!DOCTYPE html>
<html lang="en">
      <?php include "_meta.php" ?>
      <body>
            <?php include "_header.php" ?>
            <div class="container">
                  <div class="row">
                        <div class="row">
                              <?php include("display.php") ?>
                        </div>
                  </div>
            </div>
            <?php include "_footer.php" ?>
      </body>
</html>