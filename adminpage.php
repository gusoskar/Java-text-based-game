<?php

require_once('connect.php');

if (!($_SESSION['loggedIn'] == true) OR !($_SESSION['rights'] == 1)){
	header('location:index.php');
}

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="StyleSheet" href="style.css" />
		<title>
			Best Car Online - Admin
		</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="logo">
				<img src="img/logo.png" alt="logo" />
			</div>
			<div id="login">
				<?php
				
				if(isset($_SESSION['loggedIn'])){
					echo "Hello " . $_SESSION['username'];
				}
				else{
					echo "
					<form name='input' action='login.php' method='post'>
						<article>
							Username<br />
							<input type='text' name='username' class='field' />
						</article>
						<article>
							Password<br />
							<input type='password' name='password' class='field' />
						</article>
						<footer>
							<input type='submit' name='login' value='Login' />
							OR
							<input type='submit' name='registernow' value='Register now' />
						</footer>
					</form>
					";
				}
				
				// Error messages
				if(isset($_GET['error'])){
					echo "<div id='error'>";
					if($_GET['error'] == 1){
						echo "Username or password incorrect!";
					}
					
					echo "</div>";
				}

				?>
			</div>
			<div id="navigation">
				<?php include('navigation.php'); ?>
			</div>
			<div id="content">
				<?php
				
				if(isset($_GET['page'])){
					if($_GET['page'] == 1){
						include('productManagement.php');
					}
					if($_GET['page'] == 2){
						include('categoryManagement.php');
					}
					if($_GET['page'] == 3){
						include('orderManagement.php');
					}
					if($_GET['page'] == 4){
						include('addProduct.php');
					}
				}
				else{
					echo "<p>This is adminpage :D</p>";
				}
				
				?>
			</div>
			<?php include("adminmenu.php"); ?>
			<div id="footer">&copy; Oskar Gusgård and Joel Vainikka 2015</div>
		</div>
	</body>
</html>