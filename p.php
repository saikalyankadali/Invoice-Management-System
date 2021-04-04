<html>
<head>

</head>
<body>
<?php
	require('db.php');
	include("auth.php");
	
   $res = $_GET['id'];
	//echo $res;
	$sel_query="select * from new_record where id = '".$res."';";
	$result = mysqli_query($con,$sel_query);
	echo "<table border='1'>";

 
	while($row = mysqli_fetch_assoc($result)) 
	{ 
 echo "<tr>";

		echo "<td>" . $row["name"]. "</td>";
		echo "<td>" . $row["des"]. "</td>";
		echo "<td>" . $row["gold"]. "</td>";
		echo "<td>" . $row["was"]. "</td>";
		echo "<td>" . $row["qty"]. "</td>";
		echo "<td>" . $row["mak"]. "</td>";
		echo "<td>" . $row["gram"]. "</td>";
		echo "<td>" . $row["amount"]. "</td>";
		echo "<td>" . $row["cgst"]. "</td>";
		echo "<td>" . $row["sgst"]. "</td>";
		echo "<td>" . $row["gst"]. "</td>";
		echo "</tr>";

  }

echo "</table>";

?>
			
	
