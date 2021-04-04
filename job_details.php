<html>
<head>
<style>
.des table{
		border-collapse:collapse;
		width:90%;
	}
	.des th,td{
		text-align:center;
		padding:8px;
	}
	.des tr:nth-child(even){
		background-color:#f2f2f2
	}
	.des th{
		background-color:#4CAF50;
		color:white;
	}
	@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
</head>
<body><center>
<p style = "text-align:center"> Bill</p>
<h1 style= "text-align:left; margin-left:50px;">SRI SURYA JEWELLERIES</h1>
<?php
	require('db.php');
	include("auth.php");
	
   $res = $_GET['id'];
	//echo $res;
	$sel_query="select * from new_record where id = '".$res."';";
	$result = mysqli_query($con,$sel_query);
	

	
	echo "<table border ='0' style= \"width:90%\" >";
		while($row = mysqli_fetch_assoc($result)) 
		{ 
			$subtotal =  $row["amount"] +  $row["amount1"] + $row["amount2"];
			$total =  $row["gst"] +  $row["gst1"] + $row["gst2"];
			echo "<tr>";
				echo "<td style=\"float: left;\"><h3 style= \"float:left;line-height: 0;\">Silver, 91.6 Gold Business</h3></td>";
				echo "<td><b> Cell</b> : 9912940537, 9985576503</td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td style= \"float:left; text-align:left;\"><p>Proprietor : Kadali Jithendra Sai Ram<br>Gummuluru Road, Valluru</p></td>";
				echo "<td><p>DATE ". $row["trn_date"] ."</p></td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td style= \"float:left; text-align:left;\"><p> <b>Customer Name</b> : " . $row["name"]."</p></td>";
				echo "<td ><h1>INVOICE</h1></td>";
			echo "<tr>";	

			echo "</table>";	
			?>
			<div class ="des">
			<?php
			echo "<table>";
				
				echo "<tr>";
					echo "<th>Description</th>";
					echo "<th>Quantity</th>";
					echo "<th>Wastage</th>";
					echo "<th>Total Qty</th>";
					echo "<th>Making Charge</th>";
					echo "<th>Rate</th>";
					echo "<th>Amount</th>";
				echo"</tr>";
				
				echo "<tr>";
				echo "<td>" . $row["des"]. "</td>";
					echo "<td>" . $row["gold"]. "</td>";
					echo "<td>" . $row["was"]. "</td>";
					echo "<td>" . $row["qty"]. "</td>";
					echo "<td>" . $row["mak"]. "</td>";
					echo "<td>" . $row["gram"]. "</td>";
					echo "<td>" . $row["amount"]. "</td>";
				echo"</tr>";
				
				echo "<tr>";
				echo "<td>" . $row["des1"]. "</td>";
					echo "<td>" . $row["gold1"]. "</td>";
					echo "<td>" . $row["was1"]. "</td>";
					echo "<td>" . $row["qty1"]. "</td>";
					echo "<td>" . $row["mak1"]. "</td>";
					echo "<td>" . $row["gram1"]. "</td>";
					echo "<td>" . $row["amount1"]. "</td>";
				echo"</tr>";
				
				echo "<tr>";
					echo "<td>" . $row["des2"]. "</td>";
					echo "<td>" . $row["gold2"]. "</td>";
					echo "<td>" . $row["was2"]. "</td>";
					echo "<td>" . $row["qty2"]. "</td>";
					echo "<td>" . $row["mak2"]. "</td>";
					echo "<td>" . $row["gram2"]. "</td>";
					echo "<td>" . $row["amount2"]. "</td>";
				echo"</tr>";
			
				echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td>Sub Total</td>";
					echo "<td> " .$subtotal."</td>";
				echo"</tr>";
				
				echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td>CGST</td>";
					echo "<td> " .$row["cgst"]."%</td>";
				echo"</tr>";
				
				echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td>SGST</td>";
					echo "<td> " .$row["sgst"]."%</td>";
				echo"</tr>";
				
				echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td>TOTAL</td>";
					echo "<td> " .$total."</td>";
				echo"</tr>";
			echo "</table>";
			?></div>
			<?php
			}
		 echo "<script>window.print();</script>" ?>
		 </center>
	</body>
</html>	
	
