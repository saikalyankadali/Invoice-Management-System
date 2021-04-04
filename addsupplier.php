<?php
include("auth.php"); //include auth.php file on all secure pages
 ?><!DOCTYPE html>
<html>
<title><?php echo $_SESSION['username']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css\style1.css">
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>
  <a href="main2.php" class="w3-bar-item w3-button">Home</a>
	<div class="w3-dropdown-hover">
		<button class="w3-button w3-black">Welcome <?php echo $_SESSION['username']; ?> !</button>
		<div class="w3-dropdown-content w3-bar-block w3-border">
			<a href="logout.php" class="w3-bar-item w3-button">Logout</a>
		</div>
  </div>
  
  <div class="w3-dropdown-hover">
    <button class="w3-button w3-black">Dashboard</button>
    <div class="w3-dropdown-content w3-bar-block w3-border">
     <?php if(isset($_SESSION['username'])){
	echo"<div class='lcontent'>
            <a href='transaction.php' class='w3-bar-item w3-button'>Transaction</a>      
			<a href='settings.php' class='w3-bar-item w3-button'>Settings</a>";    
                    if(isset($_SESSION['admin'])){
						if($_SESSION['admin']!=0){
						echo "<a href='addproduct.php' class='w3-bar-item w3-button'>+ Product</a>
									  <a href='addemp.php' class='w3-bar-item w3-button'>+ Employee</a>
									  <a href='addsupplier.php' class='w3-bar-item w3-button'>+ Supplier</a>
									  <a href='addcustomer.php' class='w3-bar-item w3-button'>+ Customer</a>
									  <a href='addpromo.php' class='w3-bar-item w3-button'>+ Promo</a>
									  <a href='adddept.php' class='w3-bar-item w3-button'>+ Department</a>
									  <a href='viewlist.php?list=employee' class='w3-bar-item w3-button'>Employee List</a>
									  <a href='viewlist.php?list=dept' class='w3-bar-item w3-button'>Department List</a>
									  <a href='viewlist.php?list=product' class='w3-bar-item w3-button'>Product List</a>
									  <a href='viewlist.php?list=customer' class='w3-bar-item w3-button'>Customer List</a>
									  <a href='viewlist.php?list=supplier' class='w3-bar-item w3-button'>Supplier List</a>
									  <a href='viewlist.php' class='w3-bar-item w3-button'>Transaction List</a>
									  <a href='debt.php' class='w3-bar-item w3-button'>Debt</a>
									  <a href='#' class='w3-bar-item w3-button'></a>
									  <a href='#' class='w3-bar-item w3-button'></a>
									  <a href='#' class='w3-bar-item w3-button'></a>
									  <a href='#' class='w3-bar-item w3-button'></a>
									  <a href='#' class='w3-bar-item w3-button'></a>
									  <a href='#' class='w3-bar-item w3-button'></a>";
						}
					}
    echo"</ul></div>";
              //btw above ul and div <!-- <div class='more'></div>-->
} ?>
					
    </div>
  </div>
  
</div>

<div id="main">

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1>SAI TRADERS (CHINTALAGARUVU)</h1>
  </div>
</div>


<div class="w3-container">
		<?php 
	require_once("include/header.php");
?>
<div id="body">
	<?php include_once("include/left_content.php"); ?>
    <div class="rcontent">
        <h1><span>Supplier Details:</span></h1>
        <div id="data">To view list of suppliers <a style="text-decoration:underline" href="viewlist.php?list=supplier">click here</a><br /><br />
       		<?php 
			if(isset($_GET['success'])){
				$result=mysql_query("INSERT INTO supplier VALUES('{$_POST['dealer']}','{$_POST['email']}',NULL,'{$_POST['address']}','{$_POST['name']}',{$_POST['phone']})");
				if(!$result)echo "Addition not successful" .mysql_error();
	   			else echo"Addition of supplier data successful";
			}
			else{
				echo "<form method='post' action='addsupplier.php?success=1'>
					  <table>
					    <tr><td style='padding:5px'>Name: </td><td><input name='name' type='text' /></td></tr>
						<tr><td style='padding:5px'>Address: </td><td><input name='address' type='text' /></td></tr>
						<tr><td style='padding:5px'>Dealer: </td><td><input name='dealer' type='text' /></td></tr>
						<tr><td style='padding:5px'>Phone: </td><td><input name='phone' placeholder='+91..' type='text' /></td></tr>
						<tr><td style='padding:5px'>Email: </td><td><input name='email' placeholder='name@email.com' type='text' /></td></tr>
						<tr><td style='padding:5px' colspan='2'><input type='submit' value='submit' /></td></tr>
					  </table></form>";
			} 
			?>
        </div>
    </div>
</div>
<!-- body ends -->
<?php 
	require_once("include/footer.php");
?>

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

