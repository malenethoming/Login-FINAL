<?php
require_once('database.php');

?>



<!DOCTYPE html>
<html>
    
    <head>
			<meta charset="utf-8">
			<title>PHP includes</title>
            <link rel="stylesheet" href="menu.css" type="text/css">
    </head>
    <body>

      <?php
	  //find current filename with $_SERVER superglobal 
      $curpage = basename($_SERVER['PHP_SELF']);
      ?>
		<ul>
        	<!-- set current page 'active' -->
			<li><a href="index.php" <?php if($curpage == 'index.php') {echo 'class="active"'; } ?>>Home</a></li>	
			<li><a href="login.php" <?php if($curpage == 'login.php') {echo 'class="active"'; } ?>>Login</a></li>
			<li><a href="register.php" <?php if($curpage == 'register.php') {echo 'class="active"'; } ?>>Register</a></li>
		</ul>
	</body>
</html>
