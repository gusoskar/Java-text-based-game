	<?php

	if(isset($_SESSION['rights'])){
		if($_SESSION['rights'] == 0){
			echo "
				<div id='menubar'>
				<ul>
					<li><a href='userpage.php?page=1'>Your orders</a></li>
					<li><a href='userpage.php?page=2'>Your information</a></li>
					<li><a href='userpage.php?page=3'>Change password</a></li>
				</ul>
				</div>
			";
		}
	}

	?>
