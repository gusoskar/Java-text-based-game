<?php

require_once('connect.php');

$categorySQL = "SELECT * FROM joelva.categories";
$categoryResult = $connection->query($categorySQL);

?>

<div id="menubar">
	<h3>Product Categories</h3>
	<ul>
		<?php

		while ($categoryRow = $categoryResult->fetch_assoc()){
			echo "<li><a href='?page={$categoryRow['categoryID']}'>{$categoryRow['category']}</a></li>";
		}

		?>
	</ul>
</div>