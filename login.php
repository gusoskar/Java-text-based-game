<?php

require_once('connect.php');

// Login
if(isset($_POST['login'])){
	// User input
	$username = $_POST['username'];
	$password = md5(htmlspecialchars($_POST['password']));
	
	// MySQL query
	$sql = "SELECT username, rights FROM joelva.users WHERE username = '{$username}' AND password = '{$password}'";

	// If there is row containing both information then login, otherwise return frontpage with error.
	if($result = mysqli_query($connection, $sql)){
		if(mysqli_num_rows($result) > 0){
			$row = $result->fetch_assoc();
			$_SESSION["loggedIn"] = true;
			$_SESSION["username"] = $username;
			$_SESSION["rights"] = $row[rights]; // Set rights to session
			mysqli_free_result($result);
			header('location:index.php?login=1');
		}
		else{
			header('location:index.php?error=1');
		}
	}
	else{
		header('location:index.php?error=2');
	}
}

// "Register now" button that will forward to register form.
if(isset($_POST['registernow'])){
	header('location:register.php');
}

// Register
if(isset($_POST['register'])){
	// User input
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$password2 = md5($_POST['password2']);
	
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$postalcode = $_POST['postalcode'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	$phone = $_POST['phone'];
	
	// MySQL query
	$sql = "SELECT username FROM joelva.users WHERE username = '{$username}'";
	
	if($result = mysqli_query($connection, $sql)){
		if(mysqli_num_rows($result) > 0){
			mysqli_free_result($result);
			header('location:register.php?register=1');
		}
		else{
			if($password == $password2){
				// Register
				$sql = "INSERT INTO joelva.users (userID, username, password, firstname, surname, email, streetaddress, postalcode, city, country, phone, rights) VALUES (NULL, '".$username."', '".$password."', '".$firstname."', '".$surname."', '".$email."', '".$address."', '".$postalcode."', '".$city."', '".$country."', '".$phone."', '0')";
				
				$result = mysqli_query($connection, $sql);
				header('location:register.php?register=3');
			}
			else{
				mysqli_free_result($result);
				header('location:register.php?register=2');
			}
		}
	}
}

// Close MySQL connection
mysqli_close($connection);

?>