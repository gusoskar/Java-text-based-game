<?php

require_once('connect.php');

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="StyleSheet" href="style.css" />
		<title>
			Best Car Online - Products
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
				<div id="products">
					<?php
					
					if(isset($_GET['productID'])){
						$productID = $_GET['productID'];
						$sql = "SELECT * FROM joelva.products WHERE productID = '".$productID."'";
						
						if($result = mysqli_query($connection, $sql)){
							if(mysqli_num_rows($result) == 0){
								echo "Products not found.";
							}
							else{
								while($row = $result->fetch_assoc()){
									echo "
									<div class='close-product-row'>
										<div class='close-product-img'>
											<img src='{$row['image']}'/>
										</div>
										<div class='close-product-name'>
											<p>{$row['productName']}</p>
										</div>
										
										<div class='close-product-info'>
											<p>Price: {$row['price']}</p>
											<p>Year: {$row['year']}</p>
											<p>Quantity: {$row['quantity']}</p>
									";
									if($row['quantity'] > 0){
										echo "
											<form name='order' action='order.php' method='GET'>
												<input type='hidden' name='productID' value='{$row['productID']}' />
												<input type='submit' name='submit' value='Buy' />
											</form>
										";
									}
									echo "
										</div>
									</div>
									<div class='close-product-row'>
										<div class='close-product-description'>
											<p>{$row['description']}</p>
										</div>
									</div>
									";
								}
							}
						}
					}
					else{
						if(isset($_GET['page'])){
							$categoryID = $_GET['page'];
							$sql = "SELECT * FROM joelva.products WHERE categoryID = '".$categoryID."' AND deleted = 0 AND quantity > 0";
						}
						else{
							$sql = "SELECT * FROM joelva.products WHERE deleted = 0 AND quantity > 0";
						}
						
						if($result = mysqli_query($connection, $sql)){
							if(mysqli_num_rows($result) == 0){
								echo "Products not found.";
							}
							else{
								while($row = $result->fetch_assoc()){
									echo "
									<div class='product-row'>
										<div class='product-img'>
											<img src='{$row['image']}' width='100' height='100'/>
										</div>
										<div class='product-name'>
											<p><a href='products.php?productID={$row['productID']}'>{$row['productName']}</a></p>
										</div>
										<div class='product-info'>
											<p>Price: {$row['price']}</p>
											<p>Year: {$row['year']}</p>
											<p>Quantity: {$row['quantity']}</p>
											<form name='order' action='order.php' method='GET'>
												<input type='hidden' name='productID' value='{$row['productID']}' />
												<input type='submit' name='submit' value='Buy' />
											</form>
										</div>
									</div>	
									";
								}
							}
						}
					}
					
					?>
				</div>
			</div>
			<?php include("productsmenu.php"); ?>
			<div id="footer">&copy; Oskar Gusgård and Joel Vainikka 2015</div>
		</div>
	</body>
</html>

<?php

// Close MySQL connection
mysqli_close($connection);

?>