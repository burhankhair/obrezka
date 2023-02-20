<?php
session_start();
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
include 'functions.php';
$pdo = pdo_connect_mysql();
// The amounts of products to show on each page
$num_products_on_each_page = 4;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products')->rowCount();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="CSS/styles.css" />
  
  <link rel="stylesheet" href="CSS/cart-icon.css" />
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
    <link rel="stylesheet" href="style.css">
</head>
<body>

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
  .container-fluid {
  position: absolute;
  bottom: 0;
  background-color: rgb(233, 233, 233);
  padding-bottom: 1rem;
  font-family:'Montserrat';
  
}
.foot-title{
    padding-bottom: 2rem;
    padding-top:1rem;
    font-family:'Montserrat'}


 .foot-linklist :hover{
    color: rgb(126, 103, 84);

}
  .foot-linklist {
    font-family:'Montserrat';

}

.socials-logo:hover {
    
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Safari 3-8 */
    transform: scale(110%); 
  }

</style>

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

    <h1 style="position:relative;top:2.5rem;left:35rem;display:inline-block">Products</h1>
    <p></p>
    <p></p>
    <p style="padding-top:2rem;"></p>
    <div class="row" style="width:99vw;position:relative;left:.2rem;">
    <?php foreach ($products as $product): ?>
      <div class="item-images col-xl-3 col-md-4 col-12">
      
        <a class="link-item" href="index.php?page=product&id=<?=$product['id']?>"><img class="new-arrival-item" src="imgs/<?=$product['img']?>" alt="<?=$product['name']?>" 
            width="300px" height="300px" /></a>
        <a class="link-item" style="text-decoration: none;" href="tshirt1.php">
          <h4 class="item-title"><?=$product['name']?></h4>
        </a>
        <span class="markprice">&dollar;<?=$product['price']?></span>
        <?php if ($product['rrp'] > 0): ?>
        <strike class="cancelled-price">&dollar;<?=$product['rrp']?></strike>
        <?php endif; ?>
        
    </div>
    <?php endforeach; ?> 
    <?php foreach ($products as $product): ?>
      <div class="item-images col-xl-3 col-md-4 col-12">
      
        <a class="link-item" href="index.php?page=product&id=<?=$product['id']?>"><img class="new-arrival-item" src="imgs/<?=$product['img']?>" alt="<?=$product['name']?>" 
            width="300px" height="300px" /></a>
        <a class="link-item" style="text-decoration: none;" href="tshirt1.php">
          <h4 class="item-title"><?=$product['name']?></h4>
        </a>
        <span class="markprice">&dollar;<?=$product['price']?></span>
        <?php if ($product['rrp'] > 0): ?>
        <strike class="cancelled-price">&dollar;<?=$product['rrp']?></strike>
        <?php endif; ?>
        
    </div>
    <?php endforeach; ?>
    <?php foreach ($products as $product): ?>
      <div class="item-images col-xl-3 col-md-4 col-12">
      
        <a class="link-item" href="index.php?page=product&id=<?=$product['id']?>"><img class="new-arrival-item" src="imgs/<?=$product['img']?>" alt="<?=$product['name']?>" 
            width="300px" height="300px" /></a>
        <a class="link-item" style="text-decoration: none;" href="tshirt1.php">
          <h4 class="item-title"><?=$product['name']?></h4>
        </a>
        <span class="markprice">&dollar;<?=$product['price']?></span>
        <?php if ($product['rrp'] > 0): ?>
        <strike class="cancelled-price">&dollar;<?=$product['rrp']?></strike>
        <?php endif; ?>
        
    </div>
    <?php endforeach; ?>   
    </div>
    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
        <?php endif; ?>
    </div>
</div>
<div class="container-fluid" style="font-family: 'Montserrat';border-top: .51px solid rgb(102, 76, 47);position:relative;top:7rem;">
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






