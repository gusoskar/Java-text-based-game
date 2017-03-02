<?php

require_once('connect.php');

if(!($_SESSION['loggedIn'] == true) OR !($_SESSION['rights'] == 1)){
	header('location:index.php');
}

?>

<div id="productsA">
	<h3>Categories</h3>
	<?php
	
	$sql = "SELECT * FROM categories";
	
	if($result = mysqli_query($connection, $sql)){
		if(mysqli_num_rows($result) == 0){
			echo "Categories not found.";
		}
	}
	else{
		echo "MySQL query failed.";
	}
		
	?>
	<ul>
	<?php     
	
	while($row = $result->fetch_assoc()){
		echo "<li>{$row['category']}</li>";
	}

	?>
	</ul>
</div>

<?php

// Close MySQL connection
mysqli_close($connection);

?>