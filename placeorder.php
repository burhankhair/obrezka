<?php

if (isset($_SESSION['uid'])) 
{
  include('dbcon.php');
  $uid = $_SESSION['uid'];
  $query = "SELECT * FROM `user` WHERE `id` = '$uid'";
  $run = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($run);
}
else{

}
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

?>


<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/cart-icon.css" />
  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/e4a8df432c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
</head>

<style>
  .cart-no{
    <?php
      if ($num_items_in_cart > 0){
          
      }
      else {
        echo 'display:none';
      }
    ?>
  }
</style>

    <body>
        
    <?php include  ('header.php') ?>




    <div class="placeorder content-wrapper" style="position:relative;top:3rem;right:5.8rem;">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
    <button class="btn btn-dark btn-lg" style = "font-family:'Montserrat';">Continue Shopping</button>
</div>


    </body>

    </html>

