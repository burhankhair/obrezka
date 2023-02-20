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
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
  // Remove the product from the shopping cart
  unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
  // Loop through the post data so we can update the quantities for every product in cart
  foreach ($_POST as $k => $v) {
      if (strpos($k, 'quantity') !== false && is_numeric($v)) {
          $id = str_replace('quantity-', '', $k);
          $quantity = (int)$v;
          // Always do checks and validation
          if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
              // Update new quantity
              $_SESSION['cart'][$id] = $quantity;
          }
      }
  }
  // Prevent form resubmission...
  header('location: index.php?page=cart');
  exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty



// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="CSS/footer.css" />
  <link rel="stylesheet" href="CSS/cart-icon.css" />
  <link rel="stylesheet" href="CSS/styles.css">
  <link rel="stylesheet" href="style.css">
  
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

    <style>

.cart, .content-wrapper{
position: relative;
top:3rem;

right:9rem;

}
.content-wrapper{
  width:69%;

}



.subtotal{
  margin-top:1rem;
  padding-top:.3rem;
  padding-bottom:.3rem;
  border-top:0.01px solid rgb(207, 205, 205);
  border-bottom:0.1px solid rgb(207, 205, 205);
  

}

.buttons{
    margin-top:.5rem;
    margin-right:.5rem;
    padding-right:1rem;
}

.cart-no{
    <?php
      if ($num_items_in_cart > 0){
          
      }
      else {
        echo 'display:none';
      }
    ?>
  }
  .cart-product-img{
    border:1px solid black;
  }

.container-fluid {
    position: absolute;
    bottom: 0;
    background-color: rgb(233, 233, 233);
    padding-bottom: 1rem;
     
  }
.foot-title{
  padding-top:2rem;
  padding-bottom: 2rem;
      
}
  
  
.foot-linklist :hover{
      color: rgb(126, 103, 84); 
  }
  
.socials-logo:hover {
      -ms-transform: scale(1.5); /* IE 9 */
      -webkit-transform: scale(1.5); /* Safari 3-8 */
      transform: scale(110%); 
}
    </style>
</head>
<body>
<!-- NAVBAR  -->

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php" id="obrezka" style="color:black;font-family:'Catalish Huntera'"><img src="imgs/logo.png" alt="" srcset=""></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
      data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Tops
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="products.php">New Arrivals</a>
            <a class="dropdown-item" href="products.php">Hoodies</a>
            <a class="dropdown-item" href="products.php">Oversized </a>

          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Pants
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="products.php">New Arivals</a>
            <a class="dropdown-item" href="products.php">Cargos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Accessories
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="products.php">Action</a>
            <a class="dropdown-item" href="products.php">Another action</a>
            <a class="dropdown-item" href="products.php">Something else here</a>
          </div>
        </li>

        
      </ul>
      <form class="form-inline my-2 my-lg-0">
         <input class="form-control mr-sm-4" type="search" placeholder="Search" aria-label="Search" />
        <button class="btn btn btn-outline-dark my-2 my-sm-0" type="submit">
        <img class="btn-search" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABiUlEQVRIie2Wu04CQRSGP0G2EUtIbHwA8B3EQisLIcorEInx8hbEZ9DKy6toDI1oAgalNFpDoYWuxZzJjoTbmSXERP7kZDbZ859vdmb27MJcf0gBUAaugRbQk2gBV3IvmDa0BLwA4Zh4BorTACaAU6fwPXAI5IAliTxwBDScvJp4vWWhH0BlTLEEsC+5Fu6lkgNdV/gKDnxHCw2I9rSiNQNV8baBlMZYJtpTn71KAg9SY3dUYn9xezLPgG8P8BdwLteq5X7CzDbnAbXKS42WxtQVUzoGeFlqdEclxXrnhmhhkqR+8KuMqzHA1vumAddl3IwB3pLxVmOyr1NjwKQmURJ4lBp7GmOAafghpg1qdSDeDrCoNReJWmZB4dsAPsW7rYVa1Rx4FbOEw5TEPKmFvgMZX3DCgYeYNniMaQ5piTXghGhPLdTmZ33hYNpem98f/UHRwSxvhqhXx4anMA3/EmhiOlJPJnSBOb3uQcpOE65VhujPpAms/Bu4u+x3swRbeB24mTV4LgB+AFuLedkPkcmmAAAAAElFTkSuQmCC" width="20px" height="20px">
        </button>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item">
          
            
            <?php $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?>
            <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i><sup class="cart-no"><?php echo $num_items_in_cart?></sup>
					</a>
                </div>
            
          
          </li>
        <li class="nav-item">
        <?php
            if (isset($_SESSION['uid'])) 
            {
                ?><a href="logout.php"  class="nav-link href" ><i class="fa fa-sign-out" aria-hidden="true">&nbsp;</i>Logout</a><?php
            }
            else{
                
            }
        ?></li><li class="nav-item">
        <?php
            if (isset($_SESSION['uid'])) 
            {
                ?><a href="ulogin/account.php"  style="text-decoration:none;position:relative;top:9px;" ><i class="fa fa-user" aria-hidden="true">&nbsp;</i><?php echo $data['name'] ?></a><?php
            }
            else{
                ?><a href="login.php" class="nav-link href" >Login/Sign up</a><?php
            }
        ?></li>
          
          <!-- Here there we will implement an icon of Shopping cart -->
          
    
        
      </ul>
    </div>
  </nav>


  <?php if (empty($products)): ?>
                
                    <h4 style="text-align:center;font-family:'Montserrat';margin-top:3rem;"> You have no products added in your Shopping Cart</h4>
                    <img src="imgs/shopping-bag.png" style="position:relative;left:35rem;" alt="">
                    <a href="index.php"><button type="button" class="btn btn-dark btn-lg" style="position:relative;top:8rem;left:21.5rem">Return to Shop</button></a>


    
    
    <?php else: ?>  
        <form action="index.php?page=cart" method="post">
        <div class="cart content-wrapper">          
        <table>
            <thead>
                <tr >
                    <td colspan="2" style="padding-right:15rem;font-size:larger;font-family:'Montserrat';border-bottom:1px solid black">Product</td>
                    <td style="padding-right:10rem;font-size:larger;font-family:'Montserrat';border-bottom:1px solid black">Price</td>
                    <td style="padding-right:10rem;font-size:larger;font-family:'Montserrat';border-bottom:1px solid black">Quantity</td>
                    <td style="padding-right:10rem;font-size:larger;font-family:'Montserrat';border-bottom:1px solid black">Total</td>
                </tr>
            </thead>
            <tbody>
            
        
                
                <?php foreach ($products as $product): ?>
                <tr >
                    <td class="img" style="padding-top:1rem;">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img class="cart-product-img" src="imgs/<?=$product['img']?>" width="100" height="100" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td style="padding-top:1rem;">
                        <a href="index.php?page=product&id=<?=$product['id']?>" style="text-decoration:none;color:black;font-family:'Montserrat;'"><?=$product['name']?></a>
                        <br>
                        
                    </td>
                    <td class="price" style="padding-top:1rem;">₹<?=$product['price']?></td>
                    <td class="quantity" style="padding-top:1rem;">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    </td>
                    <td class="price">₹<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                    <td><a href="index.php?page=cart&remove=<?=$product['id']?>"><img src="imgs/delete.png" alt="" srcset="" style="position:relative;right:5rem;" ></a></td>
                </tr>

                <?php endforeach; ?>
                
            </tbody>
        </table>
        
        
        <div class="subtotal" >
            <span class="text" >Subtotal</span>
            <span class="price">₹<?=$subtotal?></span>
        </div>
        <div class="buttons" style="float:right;">
            <input type="submit" class="btn btn-dark" value="Update" name="update" style="margin-top:.5rem;margin-right:.5rem;padding-right:5rem; font-family:'Montserrat';position:relative;left:2rem; ">
            <a href="index.php=checkout"><input type="button" class="btn btn-dark" value="Place Order" name="placeorder" style="margin-top:.5rem; font-family:'Montserrat';position:relative;left:2rem;
    margin-right:.5rem;
    padding-right:5rem; "></a>
        </div>
        <?php endif; ?></div>
    </form>
    
    <div class="container-fluid" style="font-family: 'Montserrat';border-top: .51px solid rgb(102, 76, 47);position:relative;top:15rem;">
        <div class="row" style="width: 97vw;">
            <div class="col-lg-3" >
                <ul  style="list-style-type: none;">
                    <li class="foot-title" >ABOUT US</li>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>About us</li></a>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>Contact us</li></a>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>Return Policies</li></a>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>Terms and Conditions</li></a>
                </ul>
            </div>
            <div class="col-lg-3" >
                <ul  style="list-style-type: none;">
                    <li class="foot-title">MY ACCOUNT</li>
                    <a href="ulogin/account.php" class="foot-linklist" style="text-decoration: none;color:black"><li>My account</li></a>
                    <a href="cart.php" class="foot-linklist" style="text-decoration: none;color:black"><li>Cart</li></a>
                    
                    <a href="ulogin/chngePwd.php" class="foot-linklist" style="text-decoration: none;color:black"><li>Change Password</li></a>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>Order History</li></a>
                </ul>
            </div>
            <div class="col-lg-3" >
                <ul  style="list-style-type: none;">
                    <li class="foot-title">CONTACT US</li>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>Exchange/Return Policies</li></a>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>Contact us</li></a>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>Cookies</li></a>
                    <a href="#" class="foot-linklist" style="text-decoration: none;color:black"><li>Terms and Conditions</li></a>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4 class="foot-title"><label for="">STAY CONNECTED</label></h4>
                <div style="display: inline-block; padding-right: 8px;" style="padding-top: 10px;" class="row-footer">
                    <a href="https://www.instagram.com/burhan.khair/"><img class="socials-logo"
                        src="imgs/footer-icons/facebook.png" width="40" height="40"></a>
      
                  </div>
                  <div style="display: inline-block; padding-right: 8px;" class="row-footer">
                    <a href="https://www.instagram.com/burhan.khair/"><img class="socials-logo"
                        src="imgs/footer-icons/twitter.png" width="40" height="40"></a>
      
                  </div>
                  <div style="display: inline-block; padding-right: 8px;" class="row-footer">
                    <a href="https://www.instagram.com/burhan.khair/"><img class="socials-logo"
                        src="imgs/footer-icons/instagram.png" width="40" height="40"></a>
      
                  </div>
                  <div style="display: inline-block; padding-right: 8px;" class="row-footer">
                    <a href="https://www.instagram.com/burhan.khair/"><img class="socials-logo"
                        src="imgs/footer-icons/google-plus.png" width="40" height="40"></a>
      
                  </div>
                  <div style="display: inline-block; padding-right: 8px;" class="row-footer">
                    <a href="https://www.instagram.com/burhan.khair/"><img class="socials-logo"
                        src="imgs/footer-icons/pinterest.png" width="40" height="40"></a>
            </div>
        </div>
    </div>
</body>
</html>


