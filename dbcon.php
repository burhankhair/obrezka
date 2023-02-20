<?php
	
	$conn = mysqli_connect('localhost','root','','obrezkadb');

	if ($conn == false) 
	{
		echo "Database connection failed";
	}
?>