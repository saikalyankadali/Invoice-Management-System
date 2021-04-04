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
	<style>
	th{color:#008080;}
	</style>
	</head>
	<body>

		<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
			<button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
			<a href="#" class="w3-bar-item w3-button">Home</a>
	  
			<a href="#" class="w3-bar-item w3-button"> Welcome <?php echo $_SESSION['username']; ?> !</a>
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
					<h1>SRI SURYA JEWELLERIES</h1>
				</div>
			</div>


			<div class="w3-container">
				<div class="form">
					<h2>View Records</h2>
					<table width="100%" border="1" style="border-collapse:collapse;">
						<thead>
							<tr>
									<th><strong>S.No</strong></th>
									<th><strong>Name</strong></th>
									<th><strong>Description</strong></th>
									<th><strong>Gold Quantity</strong></th>
									<th><strong>Wastage</strong></th>
									<th><strong>Total Quantity</strong></th>
									<th><strong>Making Charge</strong></th>
									<th><strong>Gram Rate</strong></th>
									<th><strong>Amount</strong></th>
									<th><strong>CGST</strong></th>
									<th><strong>SGST</strong></th>
									<th><strong>Total Amount</strong></th>
									<th><strong>Edit</strong></th>
									<th><strong>Delete</strong></th>
									<th><strong>print</strong></th>
							</tr>
						</thead>
						<tbody>
								<?php
								$count=1;
								$sel_query="Select * from new_record ORDER BY id desc;";
								$result = mysqli_query($con,$sel_query);
								while($row = mysqli_fetch_assoc($result)) { ?>
								<tr>
									<td align="center"><?php echo $count; ?></td>
									<td align="center"><?php echo $row["name"]; ?></td>
									<td align="center"><?php echo $row["des"]; ?></td>
									<td align="center"><?php echo $row["gold"]; ?></td>
									<td align="center"><?php echo $row["was"]; ?></td>
									<td align="center"><?php echo $row["qty"]; ?></td>
									<td align="center"><?php echo $row["mak"]; ?></td>
									<td align="center"><?php echo $row["gram"]; ?></td>
									<td align="center"><?php echo $row["amount"]; ?></td>
									<td align="center"><?php echo $row["cgst"]; ?></td>
									<td align="center"><?php echo $row["sgst"]; ?></td>
									<td align="center"><?php echo $row["gst"]; ?></td>
									<td align="center"><a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
									<td align="center"><a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
									<td align="center"><?php echo "<a href='job_details.php?id=".$row['id']."'>Print"; ?></td>
								</tr>
								<?php $count++; } ?>
						</tbody>
					</table>

					<br /><br /><br /><br />

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