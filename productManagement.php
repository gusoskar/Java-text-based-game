<?php

require_once('connect.php');

if (!($_SESSION['loggedIn'] == true) OR !($_SESSION['rights'] == 1)){
	header('location:index.php');
}

// Product update
if(isset($_POST['update'])){
	$sql = "UPDATE joelva.products SET categoryID = '".$_POST['category']."', productName = '".$_POST['productname']."', description = '".$_POST['description']."', price = '".$_POST['price']."', year = '".$_POST['year']."', quantity = '".$_POST['quantity']."', image  = '".$_POST['image']."' WHERE productID  = '".$_POST['productid']."'";
	$productid = $_POST['productid'];
	
	if($result = mysqli_query($connection, $sql)){
		$rows = mysqli_affected_rows($connection);
		if($rows == 1){
			header("location:adminpage.php?page=1&productID={$productid}&update=true");
		}
		if($rows == 0){
			header("location:adminpage.php?page=1&productID={$productid}&update=false");
		}
	}
	else{
		echo "SQL failed.<br />";
	}
}

?>

<div id="productsA">
	<?php

	if(isset($_GET['productID'])){ // If productID is given in URL, then load editing
		if(isset($_GET['delete'])){
			$sql = "UPDATE joelva.products SET deleted = '1' WHERE productID = '".$_GET['productID']."';";
			
			if($result = mysqli_query($connection, $sql)){
				if($result == true){
					header("location:adminpage.php?page=1");
				}
				else{
					echo "MySQL error.";
				}
			}
		}
		else{
			$sql = "SELECT * FROM joelva.products WHERE productID = '".$_GET['productID']."'";
			$sql2 = "SELECT * FROM joelva.categories";
		
			if($result = mysqli_query($connection, $sql)){
				if(mysqli_num_rows($result) == 0){
					echo "Product not found.";
				}
				else{
					while($row = $result->fetch_assoc()){
						echo "
						<div id='registerForm'>
							<div class='registerTitle'>Product</div>
							<hr>
							<form action='productManagement.php' method='post'>
								<article>
									<span>Productname</span><input type='text' name='productname' class='field' value='{$row['productName']}' />
								</article>
								<article>
									<span>Description</span><input type='text' name='description' class='field' value='{$row['description']}' />
								</article>
								<article>
									<span>Price</span><input type='text' name='price' class='field' value='{$row['price']}' />
								</article>
								<article>
									<span>Year</span><input type='text' name='year' class='field' value='{$row['year']}' />
								</article>
								<article>
									<span>Quantity</span><input type='text' name='quantity' class='field' value='{$row['quantity']}' />
								</article>
								<article>
									<span>Category</span><select name='category'>";
									if($result2 = mysqli_query($connection, $sql2)){
										while($row2 = $result2->fetch_assoc()){
											echo "<option value='{$row2['categoryID']}'>{$row2['category']}</option>";
										}	
									}
								echo "</select>
								</article>
								<article>
									<span>Image</span><input type='text' name='image' class='field' value='{$row['image']}' />
								</article>
								<article>
									<input type='submit' name='update' value='Update product' />
								</article>
								<input name='productid' type='hidden' value='{$row['productID']}' />
							</form>
						</div>
						<div id='registerTerms'>
							<div class='registerTitle'>Note</div>
							<hr>
							<p>
								- Image url must be shorter than 100.<br />
								- It is recommended to edit product description in editor.
							</p>
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
		}
	}
	else{ // Else list all products
		echo "<h3>Products</h3>";
			
		$sql = "SELECT * FROM joelva.products WHERE deleted = 0";
		
		if($result = mysqli_query($connection, $sql)){
			if(mysqli_num_rows($result) == 0){
				echo "Products not found.";
			}
		}
		else{
			echo "MySQL query failed.";
		}
			
		echo "<ul>";
		
		while($row = $result->fetch_assoc()){
			echo "<li><a href='adminpage.php?page=1&productID={$row['productID']}'>{$row['productName']}</a> | <a href='adminpage.php?page=1&delete=1&productID={$row['productID']}'>Remove</a><ul><li>Price: {$row['price']} | Year: {$row['year']} | Quantity: {$row['quantity']}</li></ul></li>";
		}

		echo "</ul>";
	}

	?>
</div>


<?php

// Close MySQL connection
mysqli_close($connection);

?>