<?php

require_once('connect.php');

if(!($_SESSION['loggedIn'] == true)){
	header('location:register.php?register=5');
}

$productID = $_GET['productID'];

$sql = "SELECT * FROM joelva.products WHERE productID = '".$productID."' AND quantity > 0";		

if($result = mysqli_query($connection, $sql)){
	if(mysqli_num_rows($result) == 0){
		echo "Products not found.";
	}
	else{
		while($row = $result->fetch_assoc()){
			echo "
			<h2>This is your order:</h2>
			<div class='close-product-row'>
				<div class='close-product-name'>
					<p>{$row['productName']}</p>
				</div>
				<div class='close-product-info'>
					<p>Price: {$row['price']}</p>
					<p>Year: {$row['year']}</p>
					<form name='ordersubmit' action='orderforward.php' method='GET'>
						<input type='hidden' name='productID' value='{$row['productID']}' />
						<input type='hidden' name='price' value='{$row['price']}' />
						<input type='hidden' name='quantity' value='{$row['quantity']}' />
						<input type='submit' name='submitorder' value='Confirm Order' />
					</form>
				</div>
			</div>
			";
		}
	}
}

?>