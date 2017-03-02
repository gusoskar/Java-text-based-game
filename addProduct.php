<?php

require_once('connect.php');

if(!($_SESSION['loggedIn'] == true) OR !($_SESSION['rights'] == 1)){
	header('location:index.php');
}

// Product update
if(isset($_POST['add'])){
	$sql = "INSERT INTO joelva.products (productID, categoryID, productName, description, price, year, quantity, image) VALUES (NULL, '".$_POST['category']."', '".$_POST['productname']."', '".$_POST['description']."', '".$_POST['price']."', '".$_POST['year']."', '".$_POST['quantity']."', '".$_POST['image']."');";
	
	if($result = mysqli_query($connection, $sql)){
		$rows = mysqli_affected_rows($connection);
		if($rows == 1){
			header("location:adminpage.php?page=4&add=true");
		}
		if($rows == 0){
			header("location:adminpage.php?page=4&add=false");
		}
	}
	else{
		echo "SQL failed.<br />";
	}
}

?>

<div id="productsA">
	<div id='registerForm'>
		<div class='registerTitle'>Add product</div>
		<hr>
		<form action='addProduct.php' method='post'>
			<article>
				<span>Product name</span><input type='text' name='productname' class='field' required />
			</article>
			<article>
				<span>Description</span><input type='text' name='description' class='field' required />
			</article>
			<article>
				<span>Price</span><input type='text' name='price' class='field' required />
			</article>
			<article>
				<span>Year</span><input type='text' name='year' class='field' required />
			</article>
			<article>
				<span>Quantity</span><input type='text' name='quantity' class='field' required />
			</article>
			<article>
				<span>Category</span><select name='category'>
				<?php
				$sql2 = "SELECT * FROM joelva.categories";
				
				if($result2 = mysqli_query($connection, $sql2)){
					while($row2 = $result2->fetch_assoc()){
						echo "<option value='{$row2['categoryID']}'>{$row2['category']}</option>";
					}	
				}
				?>
			</select>
			</article>
			<article>
				<span>Image</span><input type='text' name='image' class='field' required />
			</article>
			<article>
				<input type='submit' name='add' value='Add product' />
			</article>
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
	<?php
	
	if(isset($_GET['add'])){
		if($_GET['add'] == "true"){
			echo "<div class='notificationY'>Product added.</div>";
		}
		if($_GET['add'] == "false"){
			echo "<div class='notificationN'>Couldn't add product.</div>";
		}
	}
	
	?>
</div>


<?php

// Close MySQL connection
mysqli_close($connection);

?>