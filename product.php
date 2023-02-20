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
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="CSS/styles.css" />
  <link rel="stylesheet" href="CSS/footer.css" />
  <link rel="stylesheet" href="CSS/cart-icon.css" />
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="footer.css">
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
  .container-fluid {
  position: absolute;
  bottom: 0;
  background-color: rgb(233, 233, 233);
  padding-bottom: 1rem;
  
}
.foot-title{
    padding-bottom: 2rem;
    padding-top:1rem;
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


<div class="row" style="width:97vw;position:relative;top:4rem;left:2rem;">
  <div class="col-lg-5" style="position:relative;ri">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="1300">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" style="width:450px;height:400px;">
              <div class="carousel-item active" >
                <img class="item-page-carouselitem-page-carousel d-block w-100" src="imgs/<?=$product['img']?>"
                  alt="First slide">
              </div>
              
              <div class="carousel-item">
                <img class="item-page-carousel d-block w-100" src="imgs/<?=$product['img1']?>" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="item-page-carousel d-block w-100" src="imgs/<?=$product['img2']?>" alt="Third slide">
              </div>
              
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>        


    
  
  <div class=col-lg-7>
    <h1 class="name"><?=$product['name']?></h1>
      <span class="price">
          &dollar;<?=$product['price']?>
          <?php if ($product['rrp'] > 0): ?>
          <span class="rrp" style="padding-left:3rem;"><strike>&dollar;<?=$product['rrp']?></strike></span>
          <?php endif; ?>
      </span>
      <form action="index.php?page=cart" method="post">
          <input type="number" name="quantity" class="quantity" style="width:100px;height:40px;" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
          <input type="hidden" name="product_id" value="<?=$product['id']?>">
          <input type="submit" class="btn btn-dark" style="width:200px;height:40px;position:relative;bottom:.15rem;" value="Add To Cart">
          
      </form>
      <div class="description" >
        <?=$product['desc']?>
      </div>
    </div>
    </div>
</div>
<div class="yml" style="position:relative;text-align:center;top:6rem;"><h4 style="">You may also like..</h4></div> 
<div class="row" style="width:97vw;position:relative;top:10rem;">
          
    <?php foreach ($recently_added_products as $product): ?>
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


<!-- Footer -->



 

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
</footer>
        </body>
        </html>