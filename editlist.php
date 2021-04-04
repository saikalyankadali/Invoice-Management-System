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
    
      <?php
		//product start
	  if(!strcmp(strtolower($_GET['name']),"product") & isset($_GET['success'])){
				$result=mysql_query("update product set product_name='{$_POST['product_name']}',cost_price={$_POST['cprice']},supplier_id={$_POST['supplier']},quantity={$_POST['quantity']},discount={$_POST['discount']},product_type='{$_POST['product_type']}',market_price={$_POST['mprice']} where product_id='{$_POST['product_id']}'");
				if(!$result)echo "Addition not successful ".mysql_error();
	   			else echo"<h1><span>Editting of product data successful</span></h1>";?><a href = "main2.php">Go to Home</a><?php
			}
			else{
	   if(isset($_GET['name'])&isset($_GET['id'])){
		//product
		if(!strcmp(strtolower($_GET['name']),"product")){
			echo"<h1><span>Edit ".ucfirst($_GET['name'])."</span></h1>";
			echo"<div id='data'>";
			
			
				$plist=mysql_query("select * from product where product_id='{$_GET['id']}'");
				$plist=mysql_fetch_array($plist);
			echo "<form method='post' action='editlist.php?name=product&success=1'>
					  <table>
					    <tr><td style='padding:5px'>Product Name: </td><td><input name='product_name' type='text' value='{$plist['product_name']}' /></td></tr>
						<input type='hidden' name='product_id' value='{$plist['product_id']}' />
						<tr><td style='padding:5px'>Product type: </td>
						<td><select name='product_type'>";
						
						$dept_set = mysql_query("select dept_id, dept_name from department");
				while($row = mysql_fetch_array($dept_set))
					if($row['dept_id']==$plist['product_type']) echo "<option value='{$row['dept_id']}' selected='selected'>{$row['dept_name']}</option>";
					else echo "<option value='{$row['dept_id']}'>{$row['dept_name']}</option>";
																	
					echo"</select>
						</td></tr>
						<tr><td style='padding:5px'>Supplier ID: </td>
						<td><select name='supplier'>";
						
						$supplier_set = mysql_query("select sid, sname from supplier");
				while($row = mysql_fetch_array($supplier_set))
					if($row['sid']==$plist['supplier_id']) echo "<option value='{$row['sid']}' selected='selected'>{$row['sname']}</option>";
					else echo "<option value='{$row['sid']}'>{$row['sname']}</option>";
						
						echo"</select></td></tr>
						<tr><td style='padding:5px'>Quantity: </td><td><input name='quantity' type='text' value='{$plist['quantity']}' /></td></tr>
						<tr><td style='padding:5px'>Discount: </td><td><input name='discount' type='text' value='{$plist['discount']}' /></td></tr>
						<tr><td style='padding:5px'>Market Price: </td><td><input name='mprice' type='text' value='{$plist['market_price']}' /></td></tr>
						<tr><td style='padding:5px'>Cost Price: </td><td><input name='cprice' type='text' value='{$plist['cost_price']}' /></td></tr>
						<tr><td style='padding:5px' colspan='2'><input type='submit' value='submit' /></td></tr>
					  </table></form>";
			echo"</div>";
			}
		}
	  }//product end
	  //supplier start
	  	  if(!strcmp(strtolower($_GET['name']),"supplier") & isset($_GET['success'])){
				$result=mysql_query("update supplier set sname='{$_POST['name']}',saddress='{$_POST['address']}',sdealer='{$_POST['dealer']}',sphone={$_POST['phone']},semail='{$_POST['email']}' where sid='{$_POST['sid']}'");
				if(!$result)echo "Addition not successful ".mysql_error();
	   			else echo"<h1><span>Editting of supplier data successful</span></h1>";?><a href = "main2.php">Go to Home</a><?php
			}
			else{
	   if(isset($_GET['name'])&isset($_GET['id'])){
		//supplier
		if(!strcmp(strtolower($_GET['name']),"supplier")){
			echo"<h1><span>Edit ".ucfirst($_GET['name'])."</span></h1>";
			echo"<div id='data'>";
			
			
				$plist=mysql_query("select * from supplier where sid='{$_GET['id']}'");
				$plist=mysql_fetch_array($plist);
			echo "<form method='post' action='editlist.php?name=supplier&success=1'>
					  <table>
					    <tr><td style='padding:5px'>Name: </td><td><input name='name' type='text' value='{$plist['sname']}' /></td></tr>
						<tr><td style='padding:5px'>Address: </td><td><input name='address' type='text' value='{$plist['saddress']}' /></td></tr>
						<tr><td style='padding:5px'>Dealer: </td><td><input name='dealer' type='text' value='{$plist['sdealer']}' /></td></tr>
						<tr><td style='padding:5px'>Phone: </td><td><input name='phone' placeholder='+91..' type='text' value='{$plist['sphone']}'/></td></tr>
						<input type='hidden' value='{$_GET['id']}' name='sid' />
						<tr><td style='padding:5px'>Email: </td><td><input name='email' placeholder='name@email.com' type='text' value='{$plist['semail']}'/></td></tr>
						<tr><td style='padding:5px' colspan='2'><input type='submit' value='submit' /></td></tr>
					  </table></form>";
			echo"</div>";
			}
		}
	  }//supplier end
	  
	  
	  
	  
	  
	  
	   //dept start
	  	  if(!strcmp(strtolower($_GET['name']),"dept") & isset($_GET['success'])){
				$result=mysql_query("update department set dname='{$_POST['dept_name']}',manager_start_date='{$_POST['doj']}',manager_id='{$_POST['mid']}' where dept_id='{$_POST['dept_id']}'");
				if(!$result)echo "Addition not successful ".mysql_error();
	   			else echo"<h1><span>Editting of department data successful</span></h1>";?><a href = "main2.php">Go to Home</a><?php
			}
			else{
	   if(isset($_GET['name'])&isset($_GET['id'])){
		//dept
		if(!strcmp(strtolower($_GET['name']),"dept")){
			echo"<h1><span>Edit ".ucfirst($_GET['name'])."</span></h1>";
			echo"<div id='data'>";
			
			
				$plist=mysql_query("select * from department where dept_id='{$_GET['id']}'");
				$plist=mysql_fetch_array($plist);
			echo "<form method='post' action='editlist.php?name=dept&success=1'>
					  <table>
					   		  
					    <tr><td style='padding:5px'>Dept Name: </td><td><input name='dname' type='text' value='{$plist['dept_name']}' /></td></tr>
						<tr><td style='padding:5px'>Manager: </td>
						<td><select name='mid'><option value='NULL'>NULL</option>";
				$manager_set = mysql_query("select id, first_name, last_name from employee where admin='1' and dept_id='0'");
				while($row = mysql_fetch_array($manager_set))
					echo "<option value='{$row['id']}'>{$row['first_name']}&nbsp;{$row['last_name']}</option>";
				echo"</select></td>
						</tr>					
						<tr><td style='padding:5px' colspan='2'><input type='hidden' name='doj' value='{$time}' />
						<tr><td style='padding:5px' colspan='2'><input type='submit' value='submit' /></td></tr>
					  </table></form>";
			echo"</div>";
			}
		}
	  }//dept end
	  
	  
	  
	  
	  
	  
	  //customer start
	  	  if(!strcmp(strtolower($_GET['name']),"customer") & isset($_GET['success'])){
				$result=mysql_query("update customer set first_name='{$_POST['fname']}',last_name='{$_POST['lname']}',caddress='{$_POST['caddress']}',cphone={$_POST['cphone']} where cid='{$_POST['cid']}'");
				if(!$result)echo "Addition not successful ".mysql_error();
	   			else echo"<h1><span>Editting of customer data successful</span></h1>";?><a href = "main2.php">Go to Home</a><?php
			}
			else{
	   if(isset($_GET['name'])&isset($_GET['id'])){
		//customer
		if(!strcmp(strtolower($_GET['name']),"customer")){
			echo"<h1><span>Edit ".ucfirst($_GET['name'])."</span></h1>";
			echo"<div id='data'>";
			
			
				$plist=mysql_query("select * from customer where cid='{$_GET['id']}'");
				$plist=mysql_fetch_array($plist);
			echo "<form method='post' action='editlist.php?name=customer&success=1'>
					  <table>
						<tr><td style='padding:5px'>First Name: </td><td><input name='fname' type='text' value='{$plist['first_name']}'/></td></tr>
						<tr><td style='padding:5px'>Last Name: </td><td><input name='lname' type='text' value='{$plist['last_name']}'/></td></tr>
						<tr><td style='padding:5px'>Address: </td><td><input name='caddress' type='text' value='{$plist['caddress']}' /></td></tr>					
						<input type='hidden' name='cid' value='{$_GET['id']}' />		 			
						<tr><td style='padding:5px'>Phone no.</td><td><input type='text' placeholder='+91..' name='cphone' value='{$plist['cphone']}'/></td></tr>
						<tr><td colspan='2'><input type='submit' value='submit' /></td></tr>
					</table></form>";
			echo"</div>";
			}
		}
	  }//customer end
	  ?>
       
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




