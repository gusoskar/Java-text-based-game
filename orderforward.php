<?php

require_once('connect.php');

if(!($_SESSION['loggedIn'] == true)){
	header('location:index.php');
}

$productID = $_GET['productID'];
$price = $_GET['price'];
$username = $_SESSION['username'];
$quantity = $_GET['quantity'];

$sql = "INSERT INTO orders(userID, sum) VALUES ((Select userID FROM users WHERE username = '{$username}'), '{$price}')";
mysqli_query($connection, $sql);

$sqlproductupdate = "UPDATE products SET quantity = (quantity - 1) WHERE productID = '{$productID}'";			
mysqli_query($connection, $sqlproductupdate);

$sqldetails = "INSERT INTO orderdetails (orderID, userID, productID, quantity) VALUES ((SELECT orderID FROM orders ORDER BY orderID DESC LIMIT 1),(Select userID FROM users WHERE username = '{$username}'), '{$productID}', '1')";			
mysqli_query($connection, $sqldetails);

header('Location: index.php');

?>