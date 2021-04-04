<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $_SESSION['username']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css\style1.css">
	</head>
	<body>

		<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
			<button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
			<a href="#" class="w3-bar-item w3-button">Home</a>
			<div class="w3-dropdown-hover">
				<button class="w3-button w3-black">Welcome <?php echo $_SESSION['username']; ?> !</button>
				<div class="w3-dropdown-content w3-bar-block w3-border">
					<a href="logout.php" class="w3-bar-item w3-button">Logout</a>
				</div>
			</div>
	  
			<div class="w3-dropdown-hover">
				<button class="w3-button w3-black">Dashboard</button>
				<div class="w3-dropdown-content w3-bar-block w3-border">
					<a href="" class="w3-bar-item w3-button">Transaction</a>
					<a href="" class="w3-bar-item w3-button">+ Product</a>
					<a href="" class="w3-bar-item w3-button">+ Employee</a>
					<a href="" class="w3-bar-item w3-button">+ Supplier</a>
					<a href="" class="w3-bar-item w3-button">+ Customer</a>
					<a href="" class="w3-bar-item w3-button">+ Promo</a>
					<a href="" class="w3-bar-item w3-button">+ Department</a>
					<a href="settings.php" class="w3-bar-item w3-button">Settings</a>
				</div>
			</div>  
		</div>

		<div id="main">

			<div class="w3-teal">
				<button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
				<div class="w3-container">
					<h1>SRI SURYA JEWELLERIES</h1>
				</div>
			</div>


			<div class="w3-container">
									<?php 
										require_once("include/functions.php");
			?>
			<div id="body">
				<div class="rcontent">
					<h1><span>Settings:</span></h1>
					<div id='contentbox'><div id="data">
						<?php
							//perform query
							$emp = mysql_query("SELECT * FROM login WHERE id ='{$_SESSION['user_id']}'");
							$result = mysql_fetch_array($emp);
							if(isset($_GET['change_pass'])==1){
								if(isset($_GET['up_pass'])==1){
									//chk passwords
									if($result['password']==($_POST['old_pass']) && $_POST['new_pass'] == $_POST['new_pass_confirm']){
										$success = mysql_query("UPDATE login SET password = ('{$_POST['new_pass']}') WHERE id = '{$_SESSION['emp_id']}' ");
									
										if($success){ echo "Password changed successfully.<br />"; }
									}
									else echo "Password changing failed. Please <a href='settings.php?change_pass=1'>retry</a>";
								}
							else{	
								echo "Change your password.";
								echo "<form method='post' action='settings.php?change_pass=1&up_pass=1'>
									<table>
										<tr><td>Old Password:</td><td><input type='password' name='old_pass' /></td></tr>
										<tr><td>New password:</td><td><input type='password' name='new_pass' /></td></tr>
										<tr><td>Re-type password:</td><td><input type='password' name='new_pass_confirm' /></td></tr>
										<tr><td colspan='2'><input type='submit' value='update' /></td></tr>
									</table>
								</form>";
							}
						}
						elseif(isset($_GET['del_acc'])==1){
							if(isset($_GET['del_confirm'])==1){
								echo $_SESSION['emp_id']." <br />";
								$success= mysql_query("DELETE FROM login WHERE id='{$_SESSION['emp_id']}'");
								if($success) {
									echo "Deletion Successful";
									session_destroy();
									header("Location: login.php");
								}
								else echo "Deletion Unsuccessful";
							}
							else{
								echo "Are you sure you want to delete your account?
								<a href='settings.php?del_acc=1&del_confirm=1'><button>Yes</button></a>&nbsp;
								<a href='settings.php'><button>No</button></a>";
							}
						}
						elseif(isset($_GET['del_other_acc'])==1 && $_SESSION["admin"]==1){
							if(isset($_GET['del_confirm'])==1){
								$success= mysql_query("DELETE FROM login WHERE id='{$_GET['id']}'");
								if($success) {
									echo "Deletion Successful of Employee ID {$_GET['id']}";
								}
								else echo "Deletion Unsuccessful";
							}
							else{
								echo" Delete one of the following accounts";
								echo "<table border='1'><tr><th>Employee ID</th><th>Username</th><th>Delete</th></tr>";
								$emp_data = mysql_query("SELECT * FROM login");
								while($emp_list = mysql_fetch_array($emp_data)){
								echo "<tr><td>{$emp_list['id']}<td>{$emp_list['username']}</td>";
								echo "<td><a href='settings.php?del_other_acc=1&del_confirm=1&id={$emp_list['id']}'>Delete</a></td></tr>";
							}
							echo "</table>";
						}
					}
					else{
						//settings menu
				
						if($result["admin"]==0){
							echo $result["username"] . " is not an admin<br />";
							echo "<a href='settings.php?change_pass=1' >Change Password</a><br /><a href='settings.php?del_acc=1' >Delete account</a><br />";
						}
						else{
							echo $result["username"]." is an admin<br />";
							echo "<a href='settings.php?change_pass=1' >Change Password</a><br /><a href='settings.php?del_acc=1' >Delete account</a><br />";
							echo "<a href='settings.php?del_other_acc=1' >Delete other accounts</a><br />";
						}
					}
				?>
			</div>
        </div>
    </div>
</div>

			</div>
		</div>

		<script>
		function w3_open() {
		  document.getElementById("main").style.marginLeft = "25%";
		  document.getElementById("mySidebar").style.width = "25%";
		  document.getElementById("mySidebar").style.display = "block";
		  document.getElementById("openNav").style.display = 'none';
		}
		function w3_close() {
		  document.getElementById("main").style.marginLeft = "0%";
		  document.getElementById("mySidebar").style.display = "none";
		  document.getElementById("openNav").style.display = "inline-block";
		}
		</script>

	</body>
</html>
