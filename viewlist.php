<?php
	include("auth.php"); //include auth.php file on all secure pages
 ?><!DOCTYPE html>
<html>
	<title><?php echo $_SESSION['username']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css\style1.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<style>
	table td a{
		color:white;
	}
	</style>
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
	
							<?php if(isset($_GET['list'])){
								//product
								if(!strcmp(strtolower($_GET['list']),"product")){
									echo"<h1><span>List of ".ucfirst($_GET['list'])."</span></h1>";?>
									<div id='contentbox'>
										<div id='data'>
	
											<div class="form">
												<div class="container">
					 
													<input class="form-control" id="myInput" type="text" placeholder="Search..">
																	<table id='itemList' class='table table-bordered table-striped'>
																	<thead>
																		<tr>
																				<th>ID</th>
																				<th>Product name</th>
																				<th>Supplier name</th>
																				<th>Stock</th>
																				<th>Market Price</th>
																				<th>Cost Price</th>
																				<th>Discount</th>
																				<th>Options</th>
																		</tr>
																	</thead>
																	<?php	$plist = mysql_query("select product_id, product_name, supplier_id, quantity, market_price, cost_price, discount from product");
																		while($row = mysql_fetch_array($plist)){
																	?>
																	<tbody id='myTable'>
																			<tr>
																			<td align="center"><?php echo $row["product_id"]; ?></td>
																			<td align="center"><?php echo $row["product_name"]; ?></td>
																			<?php $slist = mysql_query("select sdealer from supplier where sid='{$row['supplier_id']}'");
																						$slist = mysql_fetch_array($slist) ;?>
																			<td align="center"><?php echo $slist["sdealer"]; ?></td>
																			<td align="center"><?php echo $row["quantity"]; ?></td>
																			<td align="center"><?php echo $row["market_price"]; ?></td>
																			<td align="center"><?php echo $row["cost_price"]; ?></td>
																			<td align="center"><?php echo $row["discount"]; ?></td>
																			<td align="center" style = "background:#008080; color:white;"><?php echo "<a href='editlist.php?name=product&id=".$row['product_id']."'>Edit";?></td>
															<?php }?>
																			</tr>
																	</tbody>
																	</table>
												</div>

												<p id="add"></p>
											</div>
										</div>
									</div>
										<?php	}//end product
		//supplier
	elseif(!strcmp(strtolower($_GET['list']),"supplier")){
			echo"<h1><span>List of ".ucfirst($_GET['list'])."</span></h1>";?>
			<div id='contentbox'>
										<div id='data'>
	
											<div class="form">
												<div class="container">
					 
													<input class="form-control" id="myInput" type="text" placeholder="Search..">
																	<table id='itemList' class='table table-bordered table-striped'>
																	<thead>
																		<tr>
																			<th>ID</th>
																			<th>Supplier name</th>
																			<th>Dealer name</th>
																			<th>Email</th>
																			<th>Phone</th>
																			<th>Options</th>
																		</tr>
																	</thead>
																	<?php $slist = mysql_query("select sid, sname, sdealer, semail, sphone from supplier");
																	while($row = mysql_fetch_array($slist)){
																	?>
																	<tbody id='myTable'>
																			<tr>
																			<td align="center"><?php echo $row["sid"]; ?></td>
																			<td align="center"><?php echo $row["sname"]; ?></td>
																			<td align="center"><?php echo $row["sdealer"]; ?></td>
																			<td align="center"><?php echo $row["semail"]; ?></td>
																			<td align="center"><?php echo $row["sphone"]; ?></td>
																			<td align="center" style = "background:#008080; color:white;"><?php echo "<a href='editlist.php?name=supplier&id=".$row['sid']."'>Edit";?></td>
						
																	<?php }?>
																			</tr>
																	</tbody>
																	</table>
												</div>

												<p id="add"></p>
											</div>
										</div>
									</div>
										<?php	}//end supplier
		//customer
	elseif(!strcmp(strtolower($_GET['list']),"customer")){
			echo"<h1><span>List of ".ucfirst($_GET['list'])."</span></h1>";?>
			<div id='contentbox'>
										<div id='data'>
	
											<div class="form">
												<div class="container">
					 
													<input class="form-control" id="myInput" type="text" placeholder="Search..">
																	<table id='itemList' class='table table-bordered table-striped'>
																	<thead>
																		<tr>
																			<th>ID</th>
																			<th>Customer Name</th>
																			<th>Surname</th>
																			<th>Join Date</th>
																			<th>Address</th>
																			<th>Phone</th>
																			<th>Options</th>
																		</tr>
																	<?php $slist = mysql_query("select cid, first_name,last_name, cjoin_date, cmoney_spent, caddress,cmoney_spent_reset,cphone from customer");
																	while($row = mysql_fetch_array($slist)){?>
																	<tbody id='myTable'>
																		<tr>
																			<td align="center"><?php echo $row["cid"]; ?></td>
																			<td align="center"><?php echo $row["first_name"]; ?></td>
																			<td align="center"><?php echo $row["last_name"]; ?></td>
																			<td align="center"><?php echo $row["cjoin_date"]; ?></td>
																			<td align="center"><?php echo $row["caddress"]; ?></td>
																			<td align="center"><?php echo $row["cphone"]; ?></td>
																			<td align="center" style = "background:#008080; color:white;"><?php echo "<a href='editlist.php?name=customer&id=".$row['cid']."'>Edit";?></td>
						
				<?php }?>
																			</tr>
																	</tbody>
																	</table>
												</div>

												<p id="add"></p>
											</div>
										</div>
									</div>
										<?php	}//end customer
		//employee
	elseif(!strcmp(strtolower($_GET['list']),"employee")){
			echo"<h1><span>List of ".ucfirst($_GET['list'])."</span></h1>";?>
			<div id='contentbox'>
										<div id='data'>
	
											<div class="form">
												<div class="container">
					 
													<input class="form-control" id="myInput" type="text" placeholder="Search..">
																	<table id='itemList' class='table table-bordered table-striped'>
																	<thead>
																		<tr>
																			<th>ID</th>
																			<th>Employee Name</th>
																			<th>Surname</th>
																			<th>Salary</th>
																			<th>Admin</th>
																			<th>DOB</th>
																			<th>Phone</th>
																			<th>Address</th>
																			<th>UID</th>
																			<th>Join Date</th>
																			<th>End Date</th>
																		</tr>
																	</thead>
																<?php $slist = mysql_query("select id, first_name, last_name, salary, admin, dob, phone_number, address, uid, join_date, end_date from employee");
																while($row = mysql_fetch_array($slist)){?>
																	<tbody id='myTable'>
																		<tr>
																			<td align="center"><?php echo $row["id"]; ?></td>
																			<td align="center"><?php echo $row["first_name"]; ?></td>
																			<td align="center"><?php echo $row["last_name"]; ?></td>
																			<td align="center"><?php echo $row["salary"]; ?></td>
																			<td align="center"><?php echo $row["admin"]; ?></td>
																			<td align="center"><?php echo $row["dob"]; ?></td>
																			<td align="center"><?php echo $row["phone_number"]; ?></td>
																			<td align="center"><?php echo $row["address"]; ?></td>
																			<td align="center"><?php echo $row["uid"]; ?></td>
																			<td align="center"><?php echo $row["join_date"]; ?></td>
																			<td align="center"><?php echo $row["end_date"]; ?></td>
																	<?php }?>
																		</tr>
																	</tbody>
																	</table>
												</div>

												<p id="add"></p>
											</div>
										</div>
									</div>
										<?php	}//end employee
	//promo
	elseif(!strcmp(strtolower($_GET['list']),"promo")){
			echo"<h1><span>List of ".ucfirst($_GET['list'])."</span></h1>";?>
			<div id='contentbox'>
										<div id='data'>
	
											<div class="form">
												<div class="container">
					 
													<input class="form-control" id="myInput" type="text" placeholder="Search..">
																	<table id='itemList' class='table table-bordered table-striped'>
																	<thead>
																		<tr>
																			<th>ID</th>
																			<th>Discount</th>
																			<th>Valid upto</th>
																			<th>count</th>
																		</tr>
																	</thead>
															<?php $slist = mysql_query("select promo_code, discount, valid_upto, count from promotion");
															while($row = mysql_fetch_array($slist)){?>
																	<tbody id='myTable'>
																		<tr>
																			<td align="center"><?php echo $row["promo_code"]; ?></td>
																			<td align="center"><?php echo $row["discount"]; ?></td>
																			<td align="center"><?php echo $row["valid_upto"]; ?></td>
																			<td align="center"><?php echo $row["count"]; ?></td>
																	<?php }?>
																		</tr>
																	</tbody>
																	</table>
												</div>

												<p id="add"></p>
											</div>
										</div>
									</div>
										<?php	}//end promo
		//dept
		elseif(!strcmp(strtolower($_GET['list']),"dept")){
			echo"<h1><span>List of ".ucfirst($_GET['list'])."</span></h1>";?>
			<div id='contentbox'>
										<div id='data'>
	
											<div class="form">
												<div class="container">
					 
													<input class="form-control" id="myInput" type="text" placeholder="Search..">
																	<table id='itemList' class='table table-bordered table-striped'>
																	<thead>
																		<tr>
																			<th>ID</th>
																			<th>Dept Name</th>
																			<th>Manager Name</th>
																			<th>Manager Surname</th>
																		</tr>
																	</thead>
																
																<?php $dlist = mysql_query("select dept_id, dept_name, manager_id from department");
																while($row = mysql_fetch_array($dlist)){?>
																	<tbody id='myTable'>
																		<tr>
																			<td align="center"><?php echo $row["dept_id"]; ?></td>
																			<td align="center"><?php echo $row["dept_name"]; ?></td>
																			<?php 
																			if($row['manager_id']){
																								$elist = mysql_query("select first_name, last_name from employee where id='{$row['manager_id']}'");
																								$ename =  mysql_fetch_array($elist); ?>
																			<td align="center"><?php echo $ename["first_name"]; ?></td>
																			<td align="center"><?php echo $ename["last_name"]; ?></td>
					
																			<?php }
																			else echo"<td align='center'>No one assigned</td><td align='center'>No one assigned</td>";
																			?>
																			<!--
																			<font color ="white"><td align="center" style = "background:#008080; "><?php echo "<a href='editlist.php?name=dept&id=".$row['dept_id']."'>Edit";?></td></font>
-->				<?php }?>
																		</tr>
																	</tbody>
																	</table>
												</div>

												<p id="add"></p>
											</div>
										</div>
									</div>
										<?php	}//end dept
		//dept
		/*elseif(!strcmp(strtolower($_GET['list']),"dept")){
			echo"<h1><span>List of ".ucfirst($_GET['list'])."</span></h1>";
			echo"<div id='contentbo'><div id='data'><table id='itemList' ><tr><th>ID</th><th>Name</th><th>Manager</th><th>Options</th></tr>";
			$dlist = mysql_query("select dept_id, dept_name, manager_id from department");
			while($row = mysql_fetch_array($dlist)){
				echo"<tr><td>{$row['dept_id']}</td>
					 <td>{$row['dept_name']}</td>";
				if($row['manager_id']){
					$elist = mysql_query("select first_name, last_name from employee where id='{$row['manager_id']}'");
					$ename =  mysql_fetch_array($elist);
					echo "<td>{$ename['first_name']}&nbsp;{$ename['last_name']}</td>";
				}
				else echo"<td>No one assigned</td>";
				echo"<td><a href='editlist.php?name=dept&id={$row['dept_id']}'>Edit</a>";
			}*/
		}//end dept
		//buy
		else{
			echo"<h1><span>List of buy</span></h1>";?>
			<div id='contentbox'>
										<div id='data'>
	
											<div class="form">
												<div class="container">
					 
													<input class="form-control" id="myInput" type="text" placeholder="Search..">
																	<table id='itemList' class='table table-bordered table-striped'>
																	<thead>
																		<tr>
																			<th>Purchase ID</th>
																			<th>Purchase Date</th>
																			<th>PID's</th>
																			<th>Pname's</th>
																			<th>Total Amount</th>
																			<th>CID</th>
																			<th>First Name</th>
																			<th>Last Name</th>
																			<th>Options</th>
																		</tr>
																	</thead>
			<?php $blist = mysql_query("select purchase_id, purchase_date, pids,pnames, total_amount, cid, first_name, last_name from buy");
			while($row = mysql_fetch_array($blist)){?>
																	<tbody id='myTable'>
																		<tr>
																			<td align="center"><?php echo $row["purchase_id"]; ?></td>
																			<td align="center"><?php echo $row["purchase_date"]; ?></td>
																			<td align="center"><?php echo $row["pids"]; ?></td>
																			<td align="center"><?php echo $row["pnames"]; ?></td>
																			<td align="center"><?php echo $row["total_amount"]; ?></td>
																			<td align="center"><?php echo $row["cid"]; ?></td>
																			<td align="center"><?php echo $row["first_name"]; ?></td>
																			<td align="center"><?php echo $row["last_name"]; ?></td>
																			<td align="center" style = "background:#008080; color:white;"><?php echo "<a href='editlist.php?name=buy&id=".$row['purchase_id']."'>Edit";?></td>
				<?php }?>
																		</tr>
																	</tbody>
																	</table>
												</div>

												<p id="add"></p>
											</div>
										</div>
									</div>
										<?php	}//end buy
	
	?>
    </div>
</div>
<!-- body ends -->
<?php 
	//require_once("include/footer.php");
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

$(document).ready(function(){
			  $("#myInput").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#myTable tr").filter(function() {
				  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			  });
			});
			var c = 0;
			var l = [];

			function ok(){ l.push(document.getElementById("na").value); c = parseInt(document.getElementById("ok").value) + c; document.getElementById("add").innerHTML = c;}



</script>

</body>
</html>
