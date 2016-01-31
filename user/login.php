<?php
   
   include("../config.php");

   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
         // username and password sent from form 

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $query = "SELECT user_id FROM user WHERE username = '$myusername' and password = '$mypassword'";

      $result = mysqli_query($db,$query);
      if (!$result) {
         die('Invalid query: ' . mysqli_error($db));
      }

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {

         $_SESSION['login_user'] = $myusername;

         $_SESSION['user-id'] = $row['user_id'];

         header("location: $home/views/home.php");

      }else {

         echo "Your Login Name or Password is invalid";

      }
      mysql_close($db);
   }
?>