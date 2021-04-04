<?php
	require('db.php');
	include("auth.php");
?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title> Online Medical Store </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  
<div class="container">
  <p> Choose medicines & place order : </p>  
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
										<td align="center" style = "background:#008080; color:white;"><?php echo "<a href='job_details.php?id=".$row['id']."' >Print"; ?></td>
									
									</tr>
									
									
									
								<?php $count++; } ?>
						</tbody>
					</table>

					<br /><br /><br /><br />

				</div>

	<p id="add"></p>
<script>
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