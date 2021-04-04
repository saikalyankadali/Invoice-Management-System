<?php	
	require('db.php');
	include("auth.php");
	$status = "";
	if(isset($_POST['new']) && $_POST['new']==1)
	{
		$trn_date = date("Y-m-d H:i:s");
		$name =$_REQUEST['name'];
		$amount = $_REQUEST['amount'];
		$paid = $_REQUEST['paid'];
		$balance = $_REQUEST['balance'];
		$submittedby = $_SESSION["username"];
		$ins_query="insert into new_record (`trn_date`,`name`,`amount`,`paid`,`balance`,`submittedby`) values ('$trn_date','$name','$amount','$paid','$balance','$submittedby')";
		mysqli_query($con,$ins_query) or die(mysql_error());
		$status = "New Record Inserted Successfully.</br></br><a href='view.php'>View Inserted Record</a>";
	}
?>

<!DOCTYPE html>
<html>
<title><?php echo $_SESSION['username']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css\style1.css">
<link rel="stylesheet" href="css\style.css">
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
		<div class="form">
			<p><a href="debt.php">Dashboard</a> | <a href="view.php">View Records</a> | <a href="logout.php">Logout</a></p>

			<div>
				<h1>Insert New Record</h1>
				<form name="form" method="post" action=""> 
					<input type="hidden" name="new" value="1" />
					<p><input type="text" name="name" placeholder="Enter Name" required /></p>

					<p><input type="text" name="amount" id = "am"  placeholder="Total Amount" required /></p>
					<p><input type="text" name="paid" id ="paid"  placeholder="Amount Paid" required /></p>
					<p><input type="button" name="sub" onclick = "calc()"  value="Total"/></p>
					<p><input type="text" name="balance"  id ="balance" placeholder="Balance Amount" required /></p>
					<p><input name="submit" type="submit" value="Submit" /></p>
				</form>
				<p style="color:#FF0000;"><?php echo $status; ?></p>

				<br /><br /><br /><br />

			</div>
		</div>
		<script>
					function calc()
					{
						var am = parseInt(document.getElementById("am").value);
						var paid = parseInt(document.getElementById("paid").value);
						document.getElementById("balance").value = (am-paid);
					}
		</script>

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

