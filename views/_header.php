<header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="home.php">Cd-Genius</a>
            <nav>
                  <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                    <?php
                                          if(!$_SESSION['login_user']){
                                                echo "<li><a href='register-form.php'>Log In</a></li>";
                                          }else{
                                                echo "<li><a>".$_SESSION['login_user']."</a></li>";
                                                echo "<li><a href='$home/user/logout.php'>Log Out</a></li>";
                                          }
                                    ?>
                              </ul>
                        </li>
                        <li><a href="#">Cart<br>0,00</a></li>
                  </ul>
            </nav>
      </div>
</header>