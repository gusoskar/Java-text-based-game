<?php

require_once('connect.php');

if(!($_SESSION['loggedIn'] == true) OR !($_SESSION['rights'] == 1)){
	header('location:index.php');
}

if(isset($_GET['orderID'])){
	$orderID = $_GET['orderID'];
	
	$sql = "UPDATE orders SET active = 0 WHERE orderID = {$orderID};";
	mysqli_query($connection, $sql);
	
}

?>

<div id="productsA">
	<h3>Orders</h3>
	<?php
	
	$sql = "SELECT * FROM orders INNER JOIN orderdetails ON orders.orderID = orderdetails.orderID WHERE active = 1;";
	
	echo "<h3>Active orders</h3>";
	if($result = mysqli_query($connection, $sql)){
		if(mysqli_num_rows($result) == 0){
			echo "Orders not found.";
		}
		else{
			
			echo "<ul>";
			while($row = $result->fetch_assoc()){
				echo "
				<li>
					OrderID: {$row['orderID']} | UserID: {$row['userID']} | ProductID: {$row['productID']} | Sum: {$row['sum']} | <a href='adminpage.php?page=3&orderID={$row['orderID']}&active=false'>Check</a>
				</li>";
			}
			echo "</ul>";
		}
	}
	else{
		echo "MySQL query failed.";
	}
	
	$sql = "SELECT * FROM orders INNER JOIN orderdetails ON orders.orderID = orderdetails.orderID WHERE active = 0;";
	
	echo "<h3>Old orders</h3>";
	if($result = mysqli_query($connection, $sql)){
		if(mysqli_num_rows($result) == 0){
			echo "Orders not found.";
		}
		else{
			
			echo "<ul>";
			while($row = $result->fetch_assoc()){
				echo "
				<li>
					OrderID: {$row['orderID']} | UserID: {$row['userID']} | ProductID: {$row['productID']} | Sum: {$row['sum']}
				</li>";
			}
			echo "</ul>";
		}
	}
	else{
		echo "MySQL query failed.";
	}
	
	?>
</div>

<?php

// Close MySQL connection
mysqli_close($connection);

?>