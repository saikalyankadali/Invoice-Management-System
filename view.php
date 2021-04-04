<?php
	require('db.php');
	include("auth.php");
?>
 <!DOCTYPE html>
<html>
	<head>
	<title>view</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css\style1.css">
	  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
	<style>
	th{color:#008080;}
	</style>
	</head>
	<body>

		<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
			<button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
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
					<center><h2>View Records</h2></center>
					<div class="container">
					 
					  <input class="form-control" id="myInput" type="text" placeholder="Search..">
					  <br>
					  <hr>
					  <br>
						<table class="table table-bordered table-striped">
						<thead>
							<tr>
									<th><strong>S.No</strong></th>
									<th><strong>Date</strong></th>
									<th><strong>Bill No.</strong></th>
									<th><strong>Name</strong></th>
									<th><strong>Description</strong></th>
									<th><strong>Total Amount</strong></th>
									<th><strong>Amount Paid</strong></th>
									<th><strong>Balance Amount</strong></th>
									<th><strong>Edit</strong></th>
									<th><strong>Delete</strong></th>
									<th><strong>Print</strong></th>
							</tr>
						</thead>
						<tbody id="myTable">
								<?php
								$count=1;
								$sel_query="Select * from new_record ORDER BY id desc;";
								$result = mysqli_query($con,$sel_query);
								while($row = mysqli_fetch_assoc($result)) { ?>
									<tr>
										<td align="center" ><?php echo $count; ?></td>
										<td align="center" style="border-color:#008080;"><?php echo $row["trn_date"]; ?></td>
										<td align="center"><?php echo $row["id"]; ?></td>
										<td align="center"><?php echo $row["name"]; ?></td>
										<td align="center"><?php echo $row["des"]; ?></td>
										<td align="center"><?php echo $row["amount"]; ?></td>
										<td align="center"><?php echo $row["paid"]; ?></td>
										<td align="center"><?php echo $row["balance"]; ?></td>
										<td align="center"><a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
										<td align="center"><a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
										<td align="center" style = "background:#008080; color:white;"><?php echo "<a href='dupview.php?id=".$row['name']."' >Print"; ?></td>
									
									</tr>
									
									
									
								<?php $count++; } ?>
							</tbody>
						</table>

						<br /><br /><br /><br />
					</div>

					<p id="add"></p>
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