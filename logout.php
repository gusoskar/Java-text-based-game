<?php

session_start();

unset($_SESSION["username"]);
unset($_SESSION["loggedIn"]);
unset($_SESSION["rights"]);

// Redirect to index
header('location:index.php');

?>