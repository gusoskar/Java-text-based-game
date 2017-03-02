<?php

require_once('connect.php');

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="StyleSheet" href="style.css" />
		<title>
			Best Car Online - Register
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
				<div id="registerForm">
					<div class="registerTitle">Register</div>
					<hr>
					<form name="register" action="login.php" method="post">
						<article>
							<span>Username</span><input type="text" name="username" class="field" required />
						</article>
						<article>
							<span>Password</span><input type="password" name="password" class="field" required />
						</article>
						<article>
							<span>Password again</span><input type="password" name="password2" class="field" required />
						</article>
						<hr>
						<article>
							<span>Firstname</span><input type="text" name="firstname" class="field" required />
						</article>
						<article>
							<span>Surname</span><input type="text" name="surname" class="field" required />
						</article>
						<article>
							<span>Email</span><input type="email" name="email" class="field" required />
						</article>
						<article>
							<span>Address</span><input type="text" name="address" class="field" required />
						</article>
						<article>
							<span>Postalcode</span><input type="text" name="postalcode" class="field" required />
						</article>
						<article>
							<span>City</span><input type="text" name="city" class="field" required />
						</article>
						<article>
							<span>Country</span><input type="text" name="country" class="field" required />
						</article>
						<article>
							<span>Phone</span><input type="text" name="phone" class="field" required />
						</article>
						<article>
							<input type="submit" name="register" value="Register" />
						</article>
					</form>
				</div>
				<div id="registerTerms">
					<div class="registerTitle">Terms of service</div>
					<hr>
					<p>
						terms are very simple. to buy car you gibe money, then come get the car. car not work work? not our problem too bad :)
					</p>
				</div>
				<?php
				// Register error (Replace these in registeration file)
				if(isset($_GET['register'])){
					echo "
						<div id='registerTerms'>
							<div class='registerTitle'>Notice!</div>
							<hr>
							<p>
					";
					if($_GET['register'] == 1){
						echo "Username already in use!";
					}
					if($_GET['register'] == 2){
						echo "Passwords don't match!";
					}
					if($_GET['register'] == 3){
						echo "Username created!";
					}
					if($_GET['register'] == 5){
						echo "You need to create account in order to buy.";
					}
					echo "
						</p>
					</div>
					";
				}
				?>
			</div>
			<div id="footer">&copy; Oskar Gusgård and Joel Vainikka 2015</div>
		</div>
	</body>
</html>