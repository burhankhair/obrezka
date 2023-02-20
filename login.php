<?php
	
	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    .content {
  width: 250px;
  margin: 0 auto;
  top: 30%;
  position: absolute;
  left: 50%;
  margin-left: -125px;
}


    .row{
        height: 100vh;
    }
    body{
			margin: 0;
			padding: 0;
			
			
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
			
			font-family:'Montserrat';
			top: 25%;
			position: relative;
			max-width: 350px;
			border-radius: 20px;
			margin: auto;
			background: rgb(255, 255, 255);
			padding: 20px 40px;
			color: white;
			box-sizing: border-box;
			z-index: 999;		
		}
		h2{
            color: #000;
			text-align: center;
		}
		h6{
			text-align: center;
			padding: 5px 1px;
            color: #000;
		}
		input[type=text], input[type=number], input[type=email], input[type=text], textarea, input[type=password]{
			width: 100%;
			box-sizing: border-box;
			padding: 12px 5px;
			background: rgba(0,0,0,0.10);
			outline: none;
			border: none;
			border-bottom: 1px solid #fff;
			color:#7f7d7d;
			border-radius: 10px;
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
			background: linear-gradient(to left,  #7f7d7d, #15130f);
		}
		
		.background-img {
			padding-left:0px;
			padding-right:0px;
		}

		
</style>
<body>

    <div class="row" style="width:99vw;">
        <div class="col-lg-6">
            <img class ="background-img" src="imgs/background1.PNG" alt="" srcset="" width="675px" height="100%">
        </div>
        <div class="col-lg-6 right">
		<a href="index.php"><button type="button" class="btn btn-dark ml-3" style="float:right;position:relative;top:15px;right:10px;">HOME</button></a>
            <div class="wrap">
                <h2>Login</h2>
                <form action="login.php" method="post">
                    <input class="" type="email" name="uname" placeholder="Email" value="" required>
                    
                    <input class="" type="password" name="pass" placeholder="Password" value="" required>
        
                    <input type="submit" name="login" value="Login" class="">
        
                    <h6 class="pt-3">Don't have an Account? <a href="register.php">Sign Up</a></h6>
                </form>
				
            </div>
                    
                  
                
                </form>
              </div>
        </div>
    </div>
</body>
</html>
<?php

	if (isset($_POST['login'])) 
	{
		include('dbcon.php');

		$uname = $_POST['uname'];
		$password = $_POST['pass'];

		$query = "SELECT * FROM `user` WHERE `email` = '$uname' AND `password` = '$password'";
		$run = mysqli_query($conn, $query);

		$row = mysqli_num_rows($run);

		if ($row < 1) 
		{
			?>

			<script>
				alert("Username & Password not match!");
				window.open('login.php','_self');
			</script>

			<?php
		}
		else
		{
			$data = mysqli_fetch_assoc($run);
			$id = $data['id'];

			$_SESSION['uid'] = $id;

			?>
				<script>
					
					window.open('index.php','_self');
					alert("Login Successful")
				</script>
			<?php

		}
	}

?>