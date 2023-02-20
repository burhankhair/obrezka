<?php
	
	session_start();

	if (isset($_SESSION['uid'])) 
	{
		
	}
	else
	{
		header('location: ../login.php');
	}
	if (isset($_SESSION['uid'])) 
{
  include('../dbcon.php');
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
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../CSS/styles.css" />
  <link rel="stylesheet" href="../CSS/footer.css" />
  <link rel="stylesheet" href="../CSS/cart-icon.css" />
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
		body{
			background-image: url('../images/back.jpg');
			background-repeat: no-repeat;    
			background-attachment: fixed;
   		 	background-position: center;
    		background-size: cover;
			background-color:white;
		}
		.main{
			padding-bottom: 10px;
			border-radius: 15px; 
			margin-top: 50px; 
			opacity: 0.9;
			width: 700px;
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
	</style>
</head>
<body>
	
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="../index.php" id="obrezka" style="color:black;font-family:'Montserrat';"><img src="../imgs/logo.png" alt="" srcset=""></a>
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
                ?><a href="../logout.php"  class="nav-link href" ><i class="fa fa-sign-out" aria-hidden="true">&nbsp;</i>Logout</a><?php
            }
            else{
                
            }
        ?></li><li class="nav-item">
        <?php
            if (isset($_SESSION['uid'])) 
            {
                ?><a href="account.php"  style="text-decoration:none;position:relative;top:9px;" ><i class="fa fa-user" aria-hidden="true">&nbsp;</i><?php echo $data['name'] ?></a><?php
            }
            else{
                ?><a href="login.php" class="nav-link href" >Login/Sign up</a><?php
            }
        ?></li>
          
          <!-- Here there we will implement an icon of Shopping cart -->
          
    
        
      </ul>
    </div>
  </nav>
	  <a href="account.php"><button type="button" class="btn btn-dark ml-3" style="float:left;position:relative;top:3rem;left:4rem;">BACK</button></a>

	<div class="container bg-dark text-light text-center main" style="10px;padding-bottom:10px;">
		<h1 class="pt-4" >CHANGE PASSWORD</h1>
		<table align="center" class="mt-5 text-right" >
			<form  action="chngePwd.php" method="post">
			<tr>
				<td>Old Password</td>
				<td><input type="text" name="oldpwd" placeholder="Old Password" value="" required></td>
			</tr>
			<tr>
				<td>New Password</td>
				<td><input type="text" name="pwd" placeholder="Password" value="" required></td>
			</tr>
			<tr>
				<td>Confirm Password</td>
				<td><input type="text" name="cpwd" placeholder="Confirm Password" value="" required></td>
			</tr>
			<tr align="center" >
				<td colspan="2" style="padding-top:10px;"><input type="submit" name="submit" value="Change Password" class="btn btn-secondary" style="position:relative;left:45px;top:"></td>
			</t>
			</form>
		</table>
	</div>


	<script src="bootstrap/jss/jquery.min.js"></script>
	<script src="bootstrap/jss/popper.min.js"></script>
	<script src="bootstrap/jss/bootstrap.min.js"></script>		
</body>
</html>

<?php
	
	if (isset($_POST['submit'])) 
	{
		include('../dbcon.php');
		$uid = $_SESSION['uid'];
	 	$oldpwd = $_POST['oldpwd'];
		$pwd = $_POST['pwd'];
		$cpwd = $_POST['cpwd'];
		
		$sql = "SELECT `password` FROM `user` WHERE `id` = '$uid'";
		$run = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($run);

		$oldpwdDb = $data['password'];

		if ($oldpwd == $oldpwdDb) 
		{
			if ($pwd == $cpwd) 
			{
				$usql = "UPDATE `user` SET `password` = '$pwd', `cpassword` =  '$cpwd' WHERE `id` = '$uid'";
				$run = mysqli_query($conn, $usql);
				?>
				<script type="text/javascript">
					alert("Password Changed Successfully! Login Again!!");
					window.open('../login.php','_self');
					
				</script>
				<?php	
				session_destroy();
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("Password and Confirm Password not match!");
				</script>
				<?php	
			}
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Incorrect Current Password!");
			</script>
			<?php	
		}
	}
?>