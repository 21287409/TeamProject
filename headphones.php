<?php
//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';
?>
<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products || Online Shop</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/website.css" />
  </head>
  
  <body>
   <nav class="top-bar" data-topbar role="navigation">
	<h1 class="logo">
		<a href="index.php">Online Shop</a>
	</h1>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="dropdown menu main-navigation" data-dropdown-menu>
          <li><a href="about.php">About</a></li>
          <li class='active'>
          	<a href="products.php">Products</a>
          	<ul class="menu">
			  <li><a href="laptops.php">Laptops</a></li>
			  <li><a href="desktops.php">Desktops</a></li>
			  <li><a href="phones.php">Phones</a></li>
			  <li><a href="Headphones.php">Headphones</a></li>
			</ul>
          </li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php

          if(isset($_SESSION['username'])){
            echo '<li><a href="account.php">My Account</a></li>';
            echo '<li><a href="logout.php">Log Out</a></li>';
          }
          else{
            echo '<li><a href="login.php">Log In</a></li>';
            echo '<li><a href="register.php">Register</a></li>';
          }
          ?>
        </ul>
      </section>
    </nav>
    
	<div class="grid-container">
   

    <div class="grid-x grid-padding-x">
        <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query('SELECT * FROM products WHERE id IN (6, 7, 8, 9, 10)');
          if($result === FALSE){
            die(mysql_error());
          }

          if($result){

            while($obj = $result->fetch_object()) {

              echo '<div class="large-4 cell item-for-sale">';
              echo '<h3>'.$obj->product_name.'</h3>';
              echo '<img src="images/products/'.$obj->product_img_name.'"/>';
				echo '<ul class="tech-features">';
              echo '<li class="device-features"><span>Product Code</span>'.$obj->product_code.'</li>';
              echo '<li class="device-features"><span>Description</span>'.$obj->product_desc.'</li>';
              echo '<li class="device-features"><span>Units Available</span>'.$obj->qty.'</li>';
              echo '<li class="device-features"><span>Price (Per Unit)</span>'.$currency.$obj->price.'</li>';

              if($obj->qty > 0){
                echo '<li class="buy-this"><a href="update-cart.php?action=add&id='.$obj->id.'"><input type="submit" value="Add To Cart"  /></a></li>';
              }
              else {
                echo '<li class="out-of-stock">Out Of Stock!</li>';
              }
              echo '</div>';

              $i++;
            }

          }

          $_SESSION['product_id'] = $product_id;

          echo '</div>';
          echo '</div>';
          ?>

        <div class="row" style="margin-top:10px;">
          <div class="small-12">

        <footer class="main-footer">
           <span>&copy;2018 - Online Shop. All Rights Reserved.</span>
        </footer>
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script>
      $(document).foundation();
    </script>
		</div>
  </body>
</html>