<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
<link rel="stylesheet" href="css\style1.css">
<link rel="stylesheet" href="css\style.css" >
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
body {
	font-family:Arial, Sans-Serif;
}
.clearfix:before, .clearfix:after { 
	content: ""; 
	display: table;
}
.clearfix:after { 
	clear: both;
}
a {
	color:#008080; 
	text-decoration:none;
}
a:hover {
	text-decoration:underline;
}
.form{
	width: 300px; 
	margin: 0 auto;
}
input[type='text'], input[type='email'], input[type='password'] {
	width: 200px; 
	border-radius: 2px;
	border: 1px solid #CCC; 
	padding: 10px; 
	color: #333;
	font-size: 14px; 
	margin-top: 10px;
}
input[type='submit']{
	padding: 10px 25px 8px;
	color: #fff; 
	background-color: #008080;
	text-shadow: rgba(0,0,0,0.24) 0 1px 0;
	font-size: 16px; 
	box-shadow: rgba(255,255,255,0.24) 0 2px 0 0 inset,#fff 0 1px 0 0; 
	border: 1px solid #0164a5; 
	border-radius: 2px; 
	margin-top: 10px; 
	cursor:pointer;
}
input[type='submit']:hover {
	background-color: 	#5F9EA0;
}
</style>
</head>
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0;" id="rightMenu">
  <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="login.php" class="w3-bar-item w3-button"><i class='fas fa-user-alt'></i> SIGN IN</a>
  <a href="registration.php" class="w3-bar-item w3-button"><i class='fas fa-user-plus'></i> SIGN UP</a>
</div>

<div class="w3-teal">
  <button class="w3-button w3-teal w3-xlarge w3-right" onclick="openRightMenu()">&#9776;</button>
  <div class="w3-container">
    <h1>SRI SURYA JEWELLERY</h1>
  </div>
</div>

<div class="w3-container">
	<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<br /><br />

</div>
<?php } ?>
</div>
     
<script>


function openRightMenu() {
  document.getElementById("rightMenu").style.display = "block";
}

function closeRightMenu() {
  document.getElementById("rightMenu").style.display = "none";
}
</script>
     
</body>
</html>
