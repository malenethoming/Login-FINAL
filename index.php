<?php

session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome to your Web Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
        <?php $curpage = 'index.php';?>
		<?php include 'menu.php';?>
	</div>

    <?php if( !empty($user) ): ?>

    <br><br><br>
		<br />Welcome <?= $user['email']; ?> 
		<br /><br />You are successfully logged in!
        <br /><br>
        <img src="ha.jpeg" alt="ha" style="width:25%;">
		<br /><br>
		<a href="logout.php">Logout?</a>

	<?php else: ?>
    
    <br><br><br>
    <h1>Please Login or Register</h1>
		<a href="login.php">Login</a> or
		<a href="register.php">Register</a>
	
    <?php endif; ?>
</body>
</html>