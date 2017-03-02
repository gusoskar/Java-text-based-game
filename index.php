<?php

require_once('connect.php');

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="StyleSheet" href="style.css" />
		<title>
			Best Car Online
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
				<div class='userpage-text'>
				<h2>Welcome to Best Car Online!</h2>
				<p>Here you can buy the best vehicles on the market. We have everything from vans, passenger cars, sports cars and even luxury cars for all you snobs out there with too much money.</p>
				</div>
			</div>
			<?php include("menu.php"); ?>
			<div id="footer">&copy; Oskar Gusgård and Joel Vainikka 2015</div>
		</div>
	</body>
</html>