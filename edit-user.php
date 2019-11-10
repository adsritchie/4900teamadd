<?php

session_start();

// Check if the user is an admin and if not redirect to the welcome page.
if(isset($_SESSION["role"]) && $_SESSION["role"] !== "admin"){
  header("location: welcome.php");
  exit;
}

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $role = "";
$username_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 	 if(empty(trim($_POST["username"]))){
        $username_err = "</table><font color='red'>Please enter a username.<br></font><table>";
    } else{
		// Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 0){
                    $username_err = "</table><font color='red'>User not found.<br></font><table>";
            }} else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
	}

		
		
		
		
		
		
		
		
		
		
		
		
		
				
	$sql = "UPDATE users SET role = ? WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_role, $param_username);
			
			$param_username = $_POST['username'];
			$param_role = $_POST['new_role'];
			
			if(mysqli_stmt_execute($stmt)){
				if (empty($username_err)){
				echo "<font color ='purple'>User role updated</font>";}
            } else{
                echo "Something went wrong. Please try again later.";
            }

         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel ="stylesheet" type="text/css" href="healthymind.css">
    <style type="text/css">
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Edit User</h2>
        <p>Please fill this form to edit a user account.</p>
		<table>
        <tr><td><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           <tr><td> <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>   
				<label for="idSelect"> Select updated role: </label>
				<select id="idSelect" name = 'new_role'>
				<option value='user'>user</option>
				<option value='admin'>admin</option>
				</select>
		</table>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p><a href="admin_welcome.php">Return to home page</a></p>
        </form>
    </div>    
</body>
</html>