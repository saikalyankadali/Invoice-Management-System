<?php
session_start(); 
	require_once("include/connection.php");
	//check login
		//if from another page, check for session existence
	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $_SESSION['username']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css\style1.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/design.js"></script>
        <script type="text/javascript" src="js/validate.js"></script>
		</head>
<body onload="addData()">

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
		<div class="container">
            <div class="header">
            <a href='index.php'></a>
                <span class="right">
                    
                    
                </span>
                <div class="clr"></div>
            </div>
<div id="body">
	<?php include_once("include/left_content.php"); ?>
    <div class="rcontent">
    	<h1><span>Transaction</span></h1>
        <div id="data">
        <?php
		if(isset($_POST['cancel'])) mysql_query("truncate table transaction"); ?>
        <span id="transalert"></span>
        	<form action="sell.php" method="post">
        		<table border="0" style="width:100%">
                <tr><td style="vertical-align:top; padding:10px; width:40%">
                	<table style="margin-left:auto; margin-right:auto">
                        <tr><td>Product ID:</td><td><input type="text" id='prodid' name="prodid" onChange="pidChange(id,this.value)"/></td></tr>
                        <tr><td>Product Name:</td><td><input type="text" id='prodname' onchange='pnameChange(name,this.value)' name="prodname"/></td></tr>
						<!--<tr><td>HSN/SAC:</td><td><input type="text" id='prodhsn' onchange='phsnChange(hsn,this.value)' name="prodhsn"/></td></tr>-->
						<tr><td>Quantity:</td><td><input type="text" id='quantity' name="quantity" size="6"/><span id='quantityDisp'></span></td></tr>
                        <tr><tr><td>Discount:</td><td><input type="text" id='discount' name="dis" size="6"/><span id='discountDisp'></span></td></tr>
						<tr><td>Price:</td><td>Rs.&nbsp;<span id="itemPrice">0</span></td></tr>            
                        <tr><td colspan="2" style="float:right"><input type="button" id='add' value="add" onClick="transadd()" /></td></tr>
                        <!--<td>PromoCode:</td><td><input type="text" id='discount' name="discount" size="6"/></td></tr>-->
                        <tr><td>Customer Id:</td><td><input type="text" id='cid' name="cid" size="6" placeholder="0 for Guest"/></td></tr>
                    </table>
        			</td>
        			<td style="vertical-align:top; padding:10px; width:50%">
                    
                        <span id="transtable" style="overflow:auto">
						<?php if($_SESSION['transaction']==0) echo "No Items added yet.";
							  else if($_SESSION['transaction']==1) echo "<script type='text/javascript'>addData()</script>"; ?>
                        </span>
                    
            		</td>
                </tr>                        
                <tr><td><input type="submit" name="submit" onclick="validate()" value="Pay & Print"/></form></td><td>
                <form action="transaction.php" method="post"><input type="submit" value="cancel" name="cancel"/></form></td></tr>       
                </table>                      
        <div class="clear" style="clear:both"></div><br /><br />
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
