<?php
   
   include("../config.php");

   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
         // username and password sent from form 

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      $sql = "SELECT user_id FROM user WHERE username = '$myusername' and password = '$mypassword'";

      $result = mysqli_query($db,$sql);
      if (!$result) {
         die('Invalid query: ' . mysql_error());
      }

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {

         $_SESSION['login_user'] = $myusername;
         header("location: $home/views/home.php");

      }else {

         $error = "Your Login Name or Password is invalid";
         echo $error;

      }
      mysql_close($db);
   }
?>