<?php
session_start();

require_once('connect.php');

$username=$_SESSION['username'];
//$sql = "(Select userID from users WHERE username='{$username}')";	
$sql = "SELECT t1.orderID,t2.productName,t2.year,t2.price,t1.active from (SELECT orders.active,orders.orderID from orders where userID=(Select userID from users WHERE username='{$username}')) as t1 INNER JOIN (SELECT orderdetails.productID, products.productName, products.year, products.price, orderdetails.orderID FROM orderdetails INNER JOIN products ON orderdetails.productID=products.productID WHERE userID=(Select userID from users WHERE username='{$username}')) as t2 ON t1.orderID=t2.orderID";

$result=$connection->query($sql);

if($result = mysqli_query($connection, $sql)){
	if(mysqli_num_rows($result) == 0){
		echo "You do not have any orders";
	}
	else{
		
		echo "	<h4>Old orders</h4>
				<div class='orders-row'>
						<div class='orders-info'><p>Product Name:<p></div>
						<div class='orders-info'><p>Manufacturing Year:<p></div>
						<div class='orders-info'><p>Sum:<p></div>
				</div>
			";
		while($row = $result->fetch_assoc()){
			
			if($row['active']==0){
				echo "
				<div class='orders-row'>
						<div class='orders-info'><p>{$row['productName']}<p></div>
						<div class='orders-info'><p>{$row['year']}<p></div>
						<div class='orders-info'><p>{$row['price']}<p></div>
				</div>
				";
			
			}		
		}
		
		echo "	
			<br><br><br><br><br><br>
			<h4>Active orders</h4>
			<div class='orders-row'>
					<div class='orders-info'><p>Product Name:<p></div>
					<div class='orders-info'><p>Manufacturing Year:<p></div>
					<div class='orders-info'><p>Sum:<p></div>
			</div>
			";
		$result=$connection->query($sql);
		while($row = $result->fetch_assoc()){
			
			if($row['active']==1){
				echo "
				<div class='orders-row'>
						<div class='orders-info'><p>{$row['productName']}<p></div>
						<div class='orders-info'><p>{$row['year']}<p></div>
						<div class='orders-info'><p>{$row['price']}<p></div>
						<div class='order-info'>
						<form name='cancelorder' action='userOrderManagement.php' method='post'>
						<input type='hidden' name='orderID' value='{$row['orderID']}' />
						<input type='hidden' name='productName' value='{$row['productName']}' />
						<input type='submit' name='deleteorder' value='Cancel order' />
						</form>
						</div>
				</div>
				";
			
			}
		}		
	}
}
else{
	echo "I AM ERROR";
}


if(isset($_POST['deleteorder'])){
	mysqli_free_result($result);
	$orderID=$_POST['orderID'];
	$productName=$_POST['productName'];
	$sql="DELETE FROM orders WHERE orderID='{$orderID}'"; 
	
	if($result = mysqli_query($connection, $sql)){
		$rows = mysqli_affected_rows($connection);
		if($rows==1){
				
			$sql="DELETE FROM orderdetails WHERE orderID='{$orderID}'";

			if($result = mysqli_query($connection, $sql)){
			$rows = mysqli_affected_rows($connection);
				if($rows==1){
					
					$sql="UPDATE products SET quantity=quantity+1 WHERE productName='{$productName}'";
					mysqli_query($connection, $sql);
						header("location:userpage.php?page=1&message=1");
						
					}
				}
				else{
					header("location:userpage.php?page=1&message=3");
				}
			}
		}
		else{
			header("location:userpage.php?page=1&message=2");
		}
	}

if(isset($_GET['message'])){
	
		if($_GET['message']==1){
			echo "<div class='notificationY'>Order was canceled.</div>";
		}
		if($_GET['message']==2){
			echo "<div class='notificationN'>Couldn't cancel order.</div>";
		}
		if($_GET['message']==3){
			echo "<div class='notificationN'>Something went horribly wrong. Contact the admins.</div>";
		}
}

mysqli_close($connection);

?>