<?php

session_start();

if (!($_SESSION['loggedIn'] == true) OR !($_SESSION['rights'] == 0)){
	header('location:index.php');
}

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="StyleSheet" href="style.css" />
		<title>
			Best Car Online - Userpage
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
						include('userOrderManagement.php');
					}
					if($_GET['page'] == 2){
						include('userInfoManagement.php');
					}
					if($_GET['page'] == 3){
						include('userPasswordChange.php');
					}
			}
			else{
				echo "
				<div class='userpage-text'>
				<h3>This is your userpage</h3>
				<p>In 'Your orders' tab, you can check on your previous orders and your active orders if you have some.
				There you can also cancel active orders that haven't been shipped yet. If the order that you are looking for is already in the 'old orders' section
				: it is already shipped.</p>
				<p>In 'Your information' tab, you can look at your details and chance them how you like. This will come in handy if you need to change your address for the delivery.</p>
				<p>The 'Change password' tab is quite obvious right?</p>
				</div>
				";
			}
			?>
			</div>
			
			<?php include("menu.php"); ?>
			<div id="footer">&copy; Oskar Gusgård and Joel Vainikka 2015</div>
		</div>
	</body>
</html>