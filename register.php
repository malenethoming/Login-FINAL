<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: login.php");
}


//require connection
require 'database.php';

//empty variable
$message = '';

if(!empty($_POST['email']) && !empty($_POST['password'])):

	//enter new user and password
	$email = mysql_escape_string($_POST['email']);
    $password = mysql_escape_string($_POST['password']);         
             
if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
    // Return Error - Invalid Email
}else{
    // Return Success - Valid Email

	
	// Query to enter the new user in the database
  //prevention from sql injection)
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
}

  //if the variable is not empty, execute it - true or false
	if( $stmt->execute() ):
		$message = 'Successfully created new user';
	else:
		$message = 'Sorry there must have been an issue creating your account';
	endif;

endif;

?>


<!DOCTYPE html>
<html>
<head>
	<title>Register Below</title>
	<link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="menu.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
        <?php $curpage = 'register.php';?>
		<?php include 'menu.php';?>
	</div>
    
    <?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>
    
    
    <h1>Register</h1>
	<span>or <a href="login.php">login here</a></span>

	<form action="register.php" method="POST">
		
		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder="and password" name="password">
		<input type="password" placeholder="confirm password" name="confirm_password">
		<input type="submit">

	</form>
</body>
</html>
