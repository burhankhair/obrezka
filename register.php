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
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
    body{
        margin: 0;
        padding: 0;
        width:90vw;
        z-index: -9999;
        height: 100vh;
    }
    
    a{
        text-decoration: none;
        color:rgb(49, 45, 45);
        
    }
    a:hover{
        text-decoration: none;
        color: #7f7d7d;
    }
    .wrap{
        position: relative;
        font-family:'Montserrat';
        top:3%;
        position: relative;
        max-width: 350px;
        border-radius: 20px;
        margin: auto;
        background:white;
        padding: 20px 40px;
        color: white;
        box-sizing: border-box;
        z-index: 999;
        width:90vw;		
    }
    h2{
        text-align: center;
        color: rgb(49, 45, 45);
        font-weight: bolder;
    }
    h6{
        text-align: center;
        padding: 5px 1px;
        color: black;
    }
    input[type=text], input[type=number], input[type=email], input[type=text], textarea, input[type=password]{
        width: 100%;
        box-sizing: border-box;
        padding: 12px 5px;
        background: rgba(0,0,0,0.10);
        outline: none;
        border: none;
        border-bottom: 1px solid #fff;
        color: #7f7d7d;
        border-radius: 5px;
        margin: 5px;
        font-weight: bold;
    }
    input[type=submit]{
        width: 100%;
        box-sizing: border-box;
        padding: 10px 0;
        margin-top: 30px;
        outline: none;
        border: none;
        background: linear-gradient(to right, #7f7d7d, #15130f);
        border-radius: 20px;
        font-size: 20px;
        color: #fff;
    }
    input[type=submit]:hover{
        background: linear-gradient(to left, #7f7d7d, #15130f);
    }
    @media screen and (max-width: 579px){
        .wrap{
          top: 10%;
        }
    } 
   
    .backgroundimg{
        position:relative;
        
        padding-left:0px;
        width:50vw;
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
<body>


    <div class="row" style="width:97vw;">
        
        <div class="col-lg-6 left">
        <a href="index.php"><button type="button" class="btn btn-dark ml-3" style="float:left;position:relative;top:15px;right:10px;">HOME</button></a>
            <div class="wrap">
                <h2>Register</h2>
                <form action="register.php" method="post">
                    <input class="" type="text" name="name" value="" placeholder="Name" required>
        
                    <input class="" type="text" name="mobile" value="" placeholder="Mobile Number" pattern="[1-9]{1}[0-9]{9}"> 
         
                    <input class="" type="email" name="email" value="" placeholder="Email" required>
        
                    <textarea class="" name="address" placeholder="Address" required></textarea>
                    
                    <input class="" type="password" name="password" value="" placeholder="Password" required>
        
                    <input class="" type="password" name="cpassword" value="" placeholder="Confirm Password" required>
        
                    <input type="submit" name="submit" value="Register" class="">
        
                    <h6 class="pt-3">Already Have an Acccount? <a href="login.php">Login</a></h6>
                </form>
            </div>
            
        </div>
        <div class="col-lg-6 ">
            <img class="backgroundimg" src="imgs/pic1.PNG" alt="" srcset="" width="685px" height="100%">
        </div>
        
        
                
              
            
            </form>
          </div>
    </div>
    <script src="bootstrap/jss/jquery.min.js"></script>
        <script src="bootstrap/jss/popper.min.js"></script>
        <script src="bootstrap/jss/bootstrap.min.js"></script>
</body>
</html>


<?php

	if (isset($_POST['submit'])) 
	{
		include('dbcon.php');
	
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];

		if ($password != $cpassword) 
		{
			?>
			<script type="text/javascript">
				alert("Password and Confirm Password not match!");
			</script>
			<?php	
			die();
		}

		$esql = "SELECT 1 FROM `user` WHERE `email` = '$email'";
		$erun = mysqli_query($conn, $esql);

		if (mysqli_num_rows($erun) > 0) 
		{
			?>
			<script type="text/javascript">
				alert("Email Aleready Exist!");
			</script>
			<?php	
			die();
		}
		
		$sql = "INSERT INTO `user`(`name`, `mobile`, `address`, `email`, `password`, `cpassword`) VALUES ('$name', '$mobile', '$address', '$email', '$password', '$cpassword')";
		$run = mysqli_query($conn, $sql);
		
		if ($run == true) 
		{
			?>

			<script>
				alert("User Registration Successfully !");
				window.open('login.php','_self')
			</script>

			<?php
		}
		else
		{
    		echo "ERROR: $sql. " . mysqli_error($conn);
		}
	}
?>