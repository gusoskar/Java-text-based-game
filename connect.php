<?php

session_start();

// Connect to the database
$connection = mysqli_connect("mysql.metropolia.fi", "joelva", "kappa1", "joelva"); // Metropolia MySQL
//$connection = mysqli_connect("localhost", "root", "", "joelva"); // Local use

// Check connection
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>