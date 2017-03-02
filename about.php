<?php

require_once('connect.php');

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="StyleSheet" href="style.css" />
		<title>
			Best Car Online - About
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
				<h3>Best Car Online</h3>
				<div class='userpage-text'>
					<p>
						We have been in this field of business for over 30 years. There are some shady people in this business, but not us!
						We have <del>an huge amount of</del> some happy customers from over the years.
					</p>
					<p>
						You can trust us 100%! Hurry up and get the best cars on the market!
					</p>
				</div>
			</div>
			<?php include("menu.php"); ?>
			<div id="footer">&copy; Oskar Gusgård and Joel Vainikka 2015</div>
		</div>
	</body>
</html>