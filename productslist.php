<?php
$servername = "mysql.metropolia.fi";
$username = "joelva";
$password = "kappa1";
$dbname="joelva";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
	//echo "Connected successfully";
}

$sql = "SELECT * from products";
	
	$result = $conn->query($sql);
	
	
	
	echo "
	
			<div>
			<div class='div-table'>
	";
	
	
	
  while ($row = $result->fetch_assoc()) {
       
	//printf ("%s (%s)\n",$row[ProductName],$row[ProductID],$row[description]);
	echo
	"
	
			<div class='div-table-row'>
			<div class='div-table-col'>
	
			<img src='{$row[image]}' width='100' height='100'/>
			</div>
			<div class='div-table-col productNamecss'>
			<p>{$row[productName]}</p>
			</div>
			<div class='div-table-col'>
			<div class='info'>
				<p>price: {$row['price']}</p>
				<p>year: {$row['year']}</p>
				<p>quantity: {$row['quantity']}</p>
				
				<form name='register' method='GET'>
					<input type='submit' name='submit' value='Buy' />
				</form>
			</div>
			
			</div>
			</div>	
				
		";
    }
	echo "
	
	
	
	</div>
	</div>
	";

	
	
	if(isset($_GET['submit'])) {
	
		if (session_status() == PHP_SESSION_NONE) {
			header('Location: register.php');
			// go to rekisteröitymis sivu
			echo "Ei settiota";
			
		}
		else {
			//jatka orderiin
		echo	"Sessio löydetty!";
		header('Location: order.php');
		}
	}
?>