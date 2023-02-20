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
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- NAVBAR  -->
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="CSS/styles.css" />
  <!-- <link rel="stylesheet" href="CSS/footer.css" /> -->
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
    <script src="https://kit.fontawesome.com/2c65622727.js" crossorigin="anonymous"></script>

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
    
    .dropdown-menu, .show{
      background-color:white;
    }

      
  
@media only screen and (max-width: 550px) {
  .item-images {
    display: inline-block;
    position: relative;
    /* border: 2px solid red; */
    text-align: center;
  }



  /* TEXT ON CAROUSEL Images */

  .text-carousel1 {
    font-family: "Montserrat";
    position: relative;
    top: 190px;
    font-size: 20px;
    left: 35%;
    display: inline-block;
  }

  .text-carousel2 {
    font-family: "Montserrat";
    position: relative;
    top: 190px;
    font-size: 20px;

    left: 5%;
    display: inline-block;
  }

  .explore-btn1 {
    font-family: "Montserrat";
    position: relative;
    top: 230px;
    left: 40px;

    font-size: small;
    display: inline-block;
  }

  .explore-btn2 {
    font-family: "Montserrat";
    position: relative;
    top: 230px;
    right: 120px;
    font-size: small;
    display: inline-block;
  }

 

}




    .cart-no {
    background-color:blue;
    padding-right:.3rem;
    padding-left:.3rem;
    
    border-radius: 80%;
    position:relative;
    right:1.7rem;
    top:-1.5rem;
    bottom:15rem;
    color: white;
}
  


.row{width: 91.66%;} 

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
@import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,700&display=swap");
</style>
</head>
<body>

<script src="https://kit.fontawesome.com/2c65622727.js" crossorigin="anonymous"></script>
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
            <a class="dropdown-item" href="products.php">Chains</a>
            <a class="dropdown-item" href="products.php">Rings</a>
            <a class="dropdown-item" href="products.php">Bracelets</a>
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
                    
						<i class="fas fa-shopping-cart"></i><sup class="cart-no"><?php  echo $num_items_in_cart?></sup>
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

          
          <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="1700">
            <div class="carousel-inner">
              <div class="carousel-item active carousel-item-left">
                <span class="text-carousel1" style="color:black;position:relative;left:33rem;">Jackets and More</span>
                <button type="button" class="explore-btn1 btn btn-outline-light btn-lg" style="position:relative;left:23rem;">
                  <a href="jackets.html" style="text-decoration: none; color:black;">Buy Now!
                </button></a>

                <picture>
                  <source media="(max-width:550px)" srcset="imgs/carousel/responsive-img2.jpg" alt="" />
                  
                  <img class="carousel-image d-block w-100" src="imgs/carousel/pic4-1.jpg" alt="First slide" >
                </picture>
              </div>
              <div class="carousel-item carousel-item-next carousel-item-left">
                <span class="text-carousel2">Accessories & More</span>
                <button type="button" class="explore-btn2 btn btn-outline-dark btn-lg">
                  <a href="accessories.html" style="text-decoration: none; color:black">Explore More!
                </button></a>

                <picture>
                  <source media="(max-width:550px)" srcset="imgs/carousel/responsive-img1.jpg" alt="" />
                  
                  <img class="carousel-image2 d-block w-100" src="imgs/carousel/pic22.jpg" alt="Second slide" />
                </picture>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    <!-- New Arrivals  -->

    <section id="new-arrivals" >
    <h3 style="padding-bottom: 15px">New Arrivals</h3>

    <div class="row" style="width:99vw;">
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




</div>

<div class="container-fluid" style="font-family: 'Montserrat';border-top: .51px solid rgb(102, 76, 47);position:relative;top:3rem;">
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




