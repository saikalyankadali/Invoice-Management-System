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
	$sel_query="select * from new_record where name = '".$res."';";
	$result = mysqli_query($con,$sel_query);
	

	
	echo "<table border = 1 style='width:90%; border-collapse : collapse;'>";
		while($row = mysqli_fetch_assoc($result)) 
		{ 
			echo "<tr>
										<td  rowspan='3'><h2>SAI TRADERS</h2> 3-18/1A, NEAR RAMALAYAM<br/>VADDIPARRU POST<br/>CHINTALAGARUVU, PODURU MANDAL, W G Dt <br/> GSTIN/UIN: 37AYTPH0545A1ZL<BR/> State Name : ANDHRA PRADESH, Code: 37</td>
										<td>INVOICE  No: </td>
										<td><b>Dated<br/></td>
									</tr>
									<tr>
										<td>Delivery Note</td>
										<td>Mode/Terms of Payment</td>
									</tr>
									<tr>
										<td>Supplier's Ref.</td>
										<td>Other References</td>
									</tr>
									<tr>
										<td  rowspan='3'><b>Buyer</b> <br/></td>
										<td>Buyer's Order No.</td>
										<td>Dated</td>
									</tr>
									<tr>
									<td>Dispatch Document No.</td>
									<td>Delivery Note Date</td>
									</tr>
									<tr>
										<td>Dispatched Through</td>
										<td>Destination</td>
									</tr>
								</table>";
		
							
		echo "<table border = 1 id='list' style='width:90%;'>
													<tr>
														<th>Description of goods</th>
														<th>HSN/SAC</th>
														<th>Quantity</th>
														<th>Per</th>
														
													</tr>";
													echo "<tr>";
				echo "<td>" . $row["des"]. "</td>";
					echo "<td>" . $row["name"]. "</td>";
					echo "<td>" . $row["amount"]. "</td>";
					echo "<td>" . $row["balance"]. "</td>";
					
				echo"</tr>";
													
								
		}						
		?>
		
		
								
		 </center>
	</body>
</html>	
	
