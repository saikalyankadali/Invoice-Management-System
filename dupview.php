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
	<style>
	
	
	@media print { 
               .noprint { 
                  visibility: hidden; 
               } 
            } 
			@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
	</style>
<script>
 function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
	</head>
	<body>

		<center><br/>
					  <p><h4><b>SAI TRADERS - CHINTALAGARUVU</b></h4>
					  VADDIPARRU POST, 3-18/1A, NEAR RAMALAYAM<br/>
					  CHINTALAGARUVU - PODURU MANDAL<br/>
					  WEST GODAVARI DISTRICT</p>
					  <p>----------------------------------------<br/>Ledger Account</p>
					  
					 
					 
				
						<table border = 1 style='width:80%; border-collapse : collapse;'>
						<thead>
							<tr>
									<th align="center" >S.No</th>
									<th align="center" >ID</th>
									<th align="center" >Date</th>
									<th align="center" >Description of Goods</th>
									<th align="center" >Total Amount</th>
									<th align="center" >Amount Paid</th>
									<th align="center" >Balance</th>
									
							</tr>
						</thead>
						<tbody id="myTable">
								<?php
								
								 $res = $_GET['id'];
								 
								//echo $res;
								$sel_query="select * from new_record where name = '".$res."';";
								$result = mysqli_query($con,$sel_query);
								$count=1;
								$totalam = 0;
								$totalpai = 0;
								$totalbal = 0;
								$cnt= 0;
								while($row = mysqli_fetch_assoc($result)) { 
									$bal = $row['balance'];
									$pai = $row["paid"]; 
									$am = $row["amount"];
									$totalam = $totalam + $am;
									$totalpai = $totalpai + $pai;
									$totalbal = $totalbal + $bal;
									
									
									if(0 == $cnt++) {
											$n = $row["name"]; 
											$result_str = strtoupper($n);  
											?><center><b> CUSTOMER NAME : <?php echo $result_str; ?></b></center><br/><?php 
										}
										// all iterations
									
									?>
									<tr>
										<td align="center" style='border-bottom:none;border-top:none'><?php echo $count; ?></td>
										<td align="center" style='border-bottom:none;border-top:none'><?php echo $row["id"]; ?></td>
										<td align="center" style='border-bottom:none;border-top:none'><?php echo $row["trn_date"]; ?></td>
										<td align="center" style='border-bottom:none;border-top:none'><?php echo strtoupper($row["des"]); ?></td>
										<td align="center" style='border-bottom:none;border-top:none'><?php echo $row["amount"]; ?></td>
										<td align="center" style='border-bottom:none;border-top:none'><?php echo $row["paid"]; ?></td>
										<td align="center" style='border-bottom:none;border-top:none'><?php echo $row["balance"]; ?></td>
										
									</tr>
									
									
									
								<?php $count++; } ?>
								<tr>
										<td align="right" colspan ="4"><b><i>Total</i></b></td>
										<td align="center"><?php echo $totalam; ?></td>
										<td align="center"><?php echo $totalpai; ?></td>
										<td align="center"><?php echo $totalbal; ?></td>
										
									</tr>
								
								
							</tbody>
						</table>

						<br /><br /><br /><br />
				

					<p id="add"></p>
					<input id="printpagebutton" type="button" value="Print this page" onclick="printpage()"/>
			<a href ="view.php" class = "noprint"><input  id="printpagebutton" type="button" value="View Debt"/></a>
			
 </center>
	</body>
</html>