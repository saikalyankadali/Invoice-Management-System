<?php
	
	require('db.php');
	include("auth.php");

	$status = "";
	if(isset($_POST['new']) && $_POST['new']==1)
	{
		$trn_date = date("Y-m-d H:i:s");
		$name =$_REQUEST['name'];
		$des =$_REQUEST['des'];
		$gold =$_REQUEST['gold'];
		$mak =$_REQUEST['mak'];
		$was =$_REQUEST['was'];
		$qty =$_REQUEST['qty'];
		$gram =$_REQUEST['gram'];
		$amount = $_REQUEST['amount'];
		$cgst = $_REQUEST['cgst'];
		$sgst = $_REQUEST['sgst'];
		$gst = $_REQUEST['gst'];
		
		$des1 =$_REQUEST['des1'];
		$gold1 =$_REQUEST['gold1'];
		$mak1 =$_REQUEST['mak1'];
		$was1 =$_REQUEST['was1'];
		$qty1 =$_REQUEST['qty1'];
		$gram1 =$_REQUEST['gram1'];
		$amount1 = $_REQUEST['amount1'];
		$cgst1 = $_REQUEST['cgst1'];
		$sgst1 = $_REQUEST['sgst1'];
		$gst1 = $_REQUEST['gst1'];
		
		$des2 =$_REQUEST['des2'];
		$gold2 =$_REQUEST['gold2'];
		$mak2 =$_REQUEST['mak2'];
		$was2 =$_REQUEST['was2'];
		$qty2 =$_REQUEST['qty2'];
		$gram2 =$_REQUEST['gram2'];
		$amount2 = $_REQUEST['amount2'];
		$cgst2 = $_REQUEST['cgst2'];
		$sgst2 = $_REQUEST['sgst2'];
		$gst2 = $_REQUEST['gst2'];
		$subtotal = $_REQUEST['subtotal'];
		$submittedby = $_SESSION["username"];
		
		$ins_query="insert into new_record (`trn_date`,`name`,`des`,`gold`,`mak`,`was`,`qty`,`gram`,`amount`,`cgst`,`sgst`,`gst`,`des1`,`gold1`,`mak1`,`was1`,`qty1`,`gram1`,`amount1`,`cgst1`,`sgst1`,`gst1`,`des2`,`gold2`,`mak2`,`was2`,`qty2`,`gram2`,`amount2`,`cgst2`,`sgst2`,`gst2`,`subtotal`,`submittedby`) values ('$trn_date', '$name', '$des', '$gold', '$mak', '$was', '$qty', '$gram', '$amount', '$cgst', '$sgst', '$gst', '$des1', '$gold1', '$mak1', '$was1', '$qty1', '$gram1', '$amount1', '$cgst1', '$sgst1', '$gst1', '$des2', '$gold2', '$mak2', '$was2', '$qty2', '$gram2', '$amount2', '$cgst2', '$sgst2', '$gst2', '$subtotal','$submittedby')";
	
		mysqli_query($con,$ins_query) or die(mysql_error());
		$status = "New Record Inserted Successfully.</br></br><a href='view.php'>View Inserted Record</a>";
	}
	
?>


<!DOCTYPE html>
<html>
	<title>Insert Record</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css\style1.css">
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
				<a href="insert.php" class="w3-bar-item w3-button">Insert Data</a>
				<a href="view.php" class="w3-bar-item w3-button">View Data</a>
				<a href="" class="w3-bar-item w3-button">Update Data</a>
			</div>
		</div>
	</div>

	<div id="main">

	<div class="w3-teal">
		<button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
		<div class="w3-container">
			<h1>SRI SURYA JEWELLERIES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Insert Record</h1>
		</div>
	</div>


	<div class="w3-container">
		<div class="form">
			<div>
			<table border ="0px" >
				<form name="form" method="post" action="" > 
					<input type="hidden" name="new" value="1" />
					<input type="hidden" name="subtotal" id = "subtotal" value="1" />
					<tr>
					<td><p><input type="text" name="name" placeholder="Enter Customer Name" required style="border-color:#008080"/></p></td>
					</tr>
					<tr>
					<td>
						<select id="product" name = "product">
							<option value="volvo">Choose Product</option>
							<option value="volvo">SANDYA 2C 25KG</option>
							<option value="saab">SANDYA 2P 25KG</option>
							<option value="mercedes">SANDYA 3S 25KG</option>
							<option value="audi">SANDYA 3SP 25KG</option>
						</select>
					</td>
					<td><p><input type="text" name="des" placeholder="Description" required /></p></td>
					<td><p><input type="text" name="des1" placeholder="Description" /></p></td>
					<td><p><input type="text" name="des2" placeholder="Description" /></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="gold" id ="gold" placeholder="Gold Quantity" required /></p></td>
					<td><p><input type="text" name="gold1" id ="gold1" placeholder="Gold Quantity"  /></p></td>
					<td><p><input type="text" name="gold2" id ="gold2" placeholder="Gold Quantity" /></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="was" id = "was" placeholder="Wastage" required /></p></td>
					<td><p><input type="text" name="was1" id = "was1" placeholder="Wastage" /></p></td>
					<td><p><input type="text" name="was2" id = "was2" placeholder="Wastage"  /></p></td>
					</tr>
					<tr>
					<td><p><input type="button" name="subb" onclick = "qtycal()"  value="Total Quantity"/></p></td>
					<td><p><input type="button" name="subb1" onclick = "qtycal1()"  value="Total Quantity"/></p></td>
					<td><p><input type="button" name="subb2" onclick = "qtycal2()"  value="Total Quantity"/></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="qty" id="qty" placeholder="Total Quantity" required /></p></td>
					<td><p><input type="text" name="qty1" id="qty1" placeholder="Total Quantity"  /></p></td>
					<td><p><input type="text" name="qty2" id="qty2" placeholder="Total Quantity" /></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="mak" id ="mak" placeholder="Making Charge" required /></p></td>
					<td><p><input type="text" name="mak1" id ="mak1" placeholder="Making Charge"  /></p></td>
					<td><p><input type="text" name="mak2" id ="mak2" placeholder="Making Charge" /></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="gram" id="gram" placeholder="Gram Rate" required /></p></td>
					<td><p><input type="text" name="gram1" id="gram1" placeholder="Gram Rate" /></p></td>
					<td><p><input type="text" name="gram2" id="gram2" placeholder="Gram Rate" /></p></td>
					</tr>
					<tr>
					<td><p><input type="button" name="subbm" onclick = "amcal()"  value="Amount"/></p></td>
					<td><p><input type="button" name="subbm1" onclick = "amcal1()"  value="Amount"/></p></td>
					<td><p><input type="button" name="subbm2" onclick = "amcal2()"  value="Amount"/></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="amount" id = "am"  placeholder="Amount" required /></p></td>
					<td><p><input type="text" name="amount1" id = "am1"  placeholder="Amount" /></p></td>
					<td><p><input type="text" name="amount2" id = "am2"  placeholder="Amount" /></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="cgst" id ="cgst"  placeholder="CGST" required /></p></td>
					<td><p><input type="text" name="cgst1" id ="cgst1"  placeholder="CGST"  /></p></td>
					<td><p><input type="text" name="cgst2" id ="cgst2"  placeholder="CGST"/></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="sgst"  id ="sgst" placeholder="SGST" required /></p></td>
					<td><p><input type="text" name="sgst1"  id ="sgst1" placeholder="SGST"  /></p></td>
					<td><p><input type="text" name="sgst2"  id ="sgst2" placeholder="SGST" /></p></td>
					</tr>
					<tr>
					<td><p><input type="button" name="sub" onclick = "calc()"  value="Total"/></p></td>
					<td><p><input type="button" name="sub1" onclick = "calc1()"  value="Total"/></p></td>
					<td><p><input type="button" name="sub2" onclick = "calc2()"  value="Total"/></p></td>
					</tr>
					<tr>
					<td><p><input type="text" name="gst" id = "gst"  placeholder=" Total Amount" /></p></td>
					<td><p><input type="text" name="gst1" id = "gst1"  placeholder=" Total Amount" /></p></td>
					<td><p><input type="text" name="gst2" id = "gst2"  placeholder=" Total Amount" /></p></td>
					</tr>
					
					<tr>
					<td><p><input name="submit" type="submit" onclick ="subtotal()" value="Submit" /></p></td>
					</tr>
				</form>
			</table>
				<p style="color:#FF0000;"><?php echo $status; ?></p>

				<br /><br /><br /><br />

			</div>
		</div>
		<script>
					function calc()
					{
						var am = parseFloat(document.getElementById("am").value);
						var cgst = parseFloat(document.getElementById("cgst").value);
						var sgst = parseFloat(document.getElementById("sgst").value);
						document.getElementById("gst").value = (am+(am * (cgst + sgst)/100));
					}
					function qtycal()
					{
						var gold = parseFloat(document.getElementById("gold").value);
						var was = parseFloat(document.getElementById("was").value);
						var qty = parseInt(document.getElementById("qty").value);
						
						document.getElementById("qty").value = (gold + was);
					}
					function amcal()
					{
						var qty = parseFloat(document.getElementById("qty").value);
						var mak = parseFloat(document.getElementById("mak").value);
						var gram = parseFloat(document.getElementById("gram").value);
						var am = parseFloat(document.getElementById("am").value);
						document.getElementById("am").value = ((qty * gram) + mak);
					}
					
					
					function calc1()
					{
						var am1 = parseFloat(document.getElementById("am1").value);
						var cgst1 = parseFloat(document.getElementById("cgst1").value);
						var sgst1 = parseFloat(document.getElementById("sgst1").value);
						document.getElementById("gst1").value = (am1+(am1 * (cgst1 + sgst1)/100));
					}
					function qtycal1()
					{
						var gold1 = parseFloat(document.getElementById("gold1").value);
						var was1 = parseFloat(document.getElementById("was1").value);
						var qty1 = parseInt(document.getElementById("qty1").value);
						
						document.getElementById("qty1").value = (gold1 + was1);
					}
					function amcal1()
					{
						var qty1 = parseFloat(document.getElementById("qty1").value);
						var mak1 = parseFloat(document.getElementById("mak1").value);
						var gram1 = parseFloat(document.getElementById("gram1").value);
						var am1 = parseFloat(document.getElementById("am1").value);
						document.getElementById("am1").value = ((qty1 * gram1) + mak1);
					}
					
					function calc2()
					{
						var am2 = parseFloat(document.getElementById("am2").value);
						var cgst2 = parseFloat(document.getElementById("cgst2").value);
						var sgst2 = parseFloat(document.getElementById("sgst2").value);
						document.getElementById("gst2").value = (am2+(am2 * (cgst2 + sgst2)/100));
					}
					function qtycal2()
					{
						var gold2 = parseFloat(document.getElementById("gold2").value);
						var was2 = parseFloat(document.getElementById("was2").value);
						var qty2 = parseInt(document.getElementById("qty2").value);
						
						document.getElementById("qty2").value = (gold2 + was2);
					}
					function amcal2()
					{
						var qty2 = parseFloat(document.getElementById("qty2").value);
						var mak2 = parseFloat(document.getElementById("mak2").value);
						var gram2 = parseFloat(document.getElementById("gram2").value);
						var am2 = parseFloat(document.getElementById("am2").value);
						document.getElementById("am2").value = ((qty2 * gram2) + mak2);
					}
					
					function subtotal()
					{
						var am = parseFloat(document.getElementById("am").value);
						var am1 = parseFloat(document.getElementById("am").value);
						var am2 = parseFloat(document.getElementById("am2").value);
						document.getElementById("subtotal").value = (am+am1+am2);
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


