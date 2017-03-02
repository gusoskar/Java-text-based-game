<a href="index.php">Home</a> | 
<a href="products.php">Products</a> | 
<a href="about.php">About us</a> 
<?php 
	if(isset($_SESSION['loggedIn']) AND $_SESSION['rights'] == 1){
		echo " | <a href='adminpage.php'>Adminpage</a>";
	}
	
	if(isset($_SESSION['loggedIn']) AND $_SESSION['rights'] == 0){
		echo " | <a href='userpage.php'>Userpage</a>";
	}
	
	if(isset($_SESSION['loggedIn'])){
		echo " | <a href='logout.php'>Logout</a>";
	}
?>