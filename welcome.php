<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel ="stylesheet" type="text/css" href="healthymind.css">
    <style type="text/css">
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your home page.</h1>
    </div>
    <h3 align="left">Home Menu</h3>
		<div class="vertical-menu">
		<a href="reset-password.php">Reset password</a>
		<a href="logout.php" class="btn btn-danger">Logout</a>
		</div>  
</body>
</html>