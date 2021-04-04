<?php

require('db.php');
include("auth.php"); //include auth.php file on all secure pages
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Dashboard - Secured Page</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<div class="form">
			<p>Welcome to Dashboard.</p>

			<p><a href="index.php">Home</a><p>
			<p><a href="insert.php">Insert New Record</a></p>
			<p><a href="view.php">View Records</a><p>
			<p><a href="logout.php">Logout</a></p>
			<br /><br /><br /><br />
		</div>
		
	</body>
</html>
