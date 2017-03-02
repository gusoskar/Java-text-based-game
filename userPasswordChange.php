<?php
require_once('connect.php');
session_start();
$username = $_SESSION['username'];

if(isset($_POST['update'])){
	
	$oldpassword=$_POST['oldpassword'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	
	$oldpassword=md5($oldpassword);
	$sql = "SELECT user from users WHERE username= '{$username}' AND password= '{$oldpassword}'";
	
	if($result = mysqli_query($connection, $sql)){
		$rows = mysqli_affected_rows($connection);
			if($rows == 0){
				header("location:userpage.php?page=3&message=4");
			}
	}
	else{
	
		if($password==$password2){
			$password=md5($password);
			//echo "everything went butter from explosion";
			$sql = "UPDATE joelva.users SET password='{$password}' WHERE username= '{$username}'";
		
			if($result = mysqli_query($connection, $sql)){
				$rows = mysqli_affected_rows($connection);
					if($rows == 1){
						header("location:userpage.php?page=3&message=1");
					}
					if($rows == 0){
						header("location:userpage.php?page=3&message=3");
					}
			}
			else{
				echo "SQL failed.<br />";
			}
		}
		else{
			header("location:userpage.php?page=3&message=2");
		}
	}
}

?>
<div id="productsA">
<?php

echo "
	<div id='registerForm'>
		<div class='registerTitle'>Change password</div>
			<hr>
			<form name='passwordchange' action='userPasswordChange.php' method='post'>
				<article>
					<span>Old password</span><input type='password' name='oldpassword' class='field' required />
				</article>
				<article>
					<span>New password</span><input type='password' name='password' class='field' required />
				</article>
				<article>
					<span>New password again</span><input type='password' name='password2' class='field' required />
				</article>
						
				<input type='submit' name='update' value='Update password' />
				</form>
				</div>
";

if(isset($_GET['message'])){
	
		if($_GET['message']==1){
			echo "<div class='notificationY'>Update was successful.</div>";
		}
		if($_GET['message']==2){
			echo "<div class='notificationN'>Passwords didn't match.</div>";
		}
		if($_GET['message']==3){
			echo "<div class='notificationN'>Nothing was changed.</div>";
		}
		if($_GET['message']==4){
			echo "<div class='notificationN'>Old password was incorrect.</div>";
		}
}
?>
</div>

<?php

// Close MySQL connection
mysqli_close($connection);

?>