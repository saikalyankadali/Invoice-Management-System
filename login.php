<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
		<link rel="stylesheet" href="css\style1.css">
		<link rel="stylesheet" href="css\style.css" />
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/design.js"></script>
        <script type="text/javascript" src="js/validate.js"></script>
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
			  <a href="logout.php" class="w3-bar-item w3-button"><i class='fas fa-user-plus'></i>SIGN OUT</a>
		</div>

		<div class="w3-teal">
			<button class="w3-button w3-teal w3-xlarge w3-right" onclick="openRightMenu()">&#9776;</button>
			<div class="w3-container">
				<h1>SAI TRADERS (CHINTALAGARUVU)</h1>
			</div>
		</div>

		<div class="w3-container">
			<?php 
				session_start(); 
				require_once("include/connection.php");

				//if redirected from login.php
				if(isset($_POST['username'])){
					$user = mysql_real_escape_string($_POST['username']);
					$pass = ($_POST['password']);
					//check
					$login = mysql_query("SELECT * FROM login  WHERE username = '{$user}' AND password = '{$pass}'");
					if(mysql_num_rows($login)>=1){
						$emp_array = mysql_fetch_array($login);
						$_SESSION['username'] = $user;
						$_SESSION['emp_id'] = $emp_array['id'];
						$_SESSION['user_id'] = $emp_array['id'];
						
						$_SESSION['transaction']=0;
						if($emp_array['admin']==1) $_SESSION['admin']=1;
						if($emp_array['admin']==2) $_SESSION['admin']=2;
					}
					else{
						$temp=1;
					}
					if(isset($_SESSION['username']))
					header("Location: main2.php");
				}	
			?>
			<div align="center">
				
			</div>
			<div class="mcontent">
				<div align="center">
					<h1 style= "color: #008080">LOGIN</h1>
					<div id="data">
						<div align="center">
							<?php 
								if(isset($_SESSION['username']))
								{
									echo "You are logged in."; ?><a href = "logout.php">LOGOUT</a><?php
								}
								 else{
									 if(isset($temp)) echo"Incorrect Username or Password";
									echo"<form method='post' action='login.php'><table>
										 <tr><td style='padding:5px' >Username:</td><td style='padding:5px' ><input type='text' name='username' placeholder='Username' /></td></tr>
										 <tr><td style='padding:5px' >Password:</td><td style='padding:5px' ><input type='password' name='password' placeholder='password' /></td></tr>
										 <tr><td></td><td colspan='2' style='padding:5px;' ><input type='submit' value='submit' /></td></tr></table>
										 </form>";
									 }
						   ?>
						</div>
					</div>
				</div>
			</div>
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

