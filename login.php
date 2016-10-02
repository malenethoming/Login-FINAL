<?php

session_start();

//if the session is set, we know the user is logged in
if( isset($_SESSION['user_id']) ){
  //show a page that only the logged in user can see
	header("Location: secret.php");
}

require 'database.php';

//if it is not empty, then read the script
if(!empty($_POST['email']) && !empty($_POST['password'])):

	//records to store in the database
	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

//empty variable
	$message = '';

  //if we count the results are it is greater than zero and the password matches  - success
	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

   //session - variable that is connected between the user and the server. session_start(); in the beginning of the php
		$_SESSION['user_id'] = $results['id'];
   //redirect if successfully logged in
		header("Location: secret.php");

	} else {
		$message = 'Sorry, those credentials do not match';
	}

endif;

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Below</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

  
  <!-- click on the logo and go back to the home page -->
	<div class="header">
        <?php $curpage = 'login.php';?>
        <?php include 'menu.php';?>

	</div>
    
    <?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>
    
    <h1>Login</h1>
	<span>or <a href="register.php">register here</a></span>

	<form action="login.php" method="POST">
		
		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder="and password" name="password">

		<input type="submit">

	</form>

    </body>
</html>