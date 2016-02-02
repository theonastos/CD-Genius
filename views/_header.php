<?php  
      include("../user/order_amount.php");
?>

<header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="<?= $base_url . "/views/home.php " ?>"><span>Cd-Genius</span></a>
            <nav>    
                  <form action="home.php" method="post" class="navbar-form" role="search">
                        <div class="form-group">
                              <input type="text" class="form-control" name="search" placeholder="Search">
                        </div>
                        <button type="submit" name="search-submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                  </form>
                  <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                    <?php
                                          if(!$_SESSION['login_user']){
                                                echo "<li><a href='$base_url/views/register-form.php'>Log In</a></li>";
                                          }else{
                                                echo "<li class='disabled'><a style='color:blue'>".$_SESSION['login_user']."</a></li>";
                                                echo "<li><a href='$base_url/user/logout.php'>Log Out</a></li>";
                                          }
                                    ?>
                              </ul>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cart<span class="caret"></span></br><?php echo orderAmount($db);?>&#8364;</a>
                              <ul class="dropdown-menu">
                                    <?php
                                          if(!$_SESSION['login_user']){
                                                echo "<li><a href='#' onclick='loginAlert()'>Manage Your Cart</a></li>";
                                          }else{
                                                echo "<li><a href='$base_url/user/manage_order.php'>Manage Your Cart</a></li>";
                                          }
                                    ?>
                              </ul>
                        </li>
                  </ul>
            </nav>
      </div>
</header>
