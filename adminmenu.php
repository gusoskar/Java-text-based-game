<?php

require_once('connect.php');

if (!($_SESSION['loggedIn'] == true) OR !($_SESSION['rights'] == 1)){
	header('location:index.php');
}

?>
<div id="menubarA">
	<h4>Admintools</h4>
	
	<h5>Product management</h5>
	<ul>
		<a href="adminpage.php?page=1" ><li>Manage products</li></a>
		<a href="adminpage.php?page=4" ><li>Add product</li></a>
	</ul>
	
	<h5>Other tools</h5>
	<ul>
		<a href="adminpage.php?page=2" ><li>Categories</li></a>
		<a href="adminpage.php?page=3" ><li>Orders</li></a>
	</ul>
</div>