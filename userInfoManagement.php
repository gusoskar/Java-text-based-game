<?php
require_once('connect.php');

session_start();
$username = $_SESSION['username'];
// Product update


if(isset($_POST['update'])){
	$sql = "UPDATE joelva.users SET firstname = '{$_POST['firstname']}', surname = '{$_POST['surname']}', streetaddress = '{$_POST['streetaddress']}', postalcode = '{$_POST['postalcode']}', city = '{$_POST['city']}', country = '{$_POST['country']}', phone = '{$_POST['phone']}', email = '{$_POST['email']}' WHERE   username= '{$username}'";
	//$sql = "UPDATE joelva.users SET firstname = '{$_POST['firstname']}', WHERE username='{$username}'";
	$productid = $_POST['productid'];
	
	if($result = mysqli_query($connection, $sql)){
		$rows = mysqli_affected_rows($connection);
		if($rows == 1){
			header("location:userpage.php?page=2&update=true");
		}
		if($rows == 0){
			header("location:userpage.php?page=2&update=false");
		}
	}
	else{
		echo "SQL failed.<br />";
	}
}

?>

<div id="productsA">
	<?php

			$sql = "SELECT * FROM users WHERE username='{$username}'";
			
			if($result = mysqli_query($connection, $sql)){
				if(mysqli_num_rows($result) == 0){
					echo "No information found.";
				}
				else{
					while($row = $result->fetch_assoc()){
						echo "
						<div id='registerForm'>
							<div class='registerTitle'>Product</div>
							<hr>
							<form action='userInfoManagement.php' method='post'>
								<article>
									<span>First Name</span><input type='text' name='firstname' class='field' value='{$row['firstname']}' required />
								</article>
								<article>
									<span>Surname</span><input type='text' name='surname' class='field' value='{$row['surname']}' required />
								</article>
								<article>
									<span>Street Address</span><input type='text' name='streetaddress' class='field' value='{$row['streetaddress']}' required />
								</article>
								<article>
									<span>Postalcode</span><input type='text' name='postalcode' class='field' value='{$row['postalcode']}' required />
								</article>
								<article>
									<span>City</span><input type='text' name='city' class='field' value='{$row['city']}' required />
								</article>
								<article>
									<span>Country</span><input type='text' name='country' class='field' value='{$row['country']}' required />
								</article>
								<article>
									<span>Phone</span><input type='text' name='phone' class='field' value='{$row['phone']}' required />
								</article>
								<article>
									<span>Email</span><input type='text' name='email' class='field' value='{$row['email']}' required />
								</article>
								
								<article>
									<input type='submit' name='update' value='Update info' />
								</article>
							</form>
						</div>
						";
						
						if(isset($_GET['update'])){
							if($_GET['update'] == "true"){
								echo "<div class='notificationY'>Update was successful.</div>";
							}
							if($_GET['update'] == "false"){
								echo "<div class='notificationN'>Nothing was changed.</div>";
							}
						}
						
					}
				}
			}
	?>
</div>

<?php

// Close MySQL connection
mysqli_close($connection);

?>