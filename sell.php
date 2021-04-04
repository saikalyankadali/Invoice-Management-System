<?php 
	require_once("include/header.php");
	//if(!isset($_POST['cid'])) header("Location: transaction.php");
?>
 <center>
<script type="text/javascript">
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
<style>
 @media print { 
               .noprint { 
                  visibility: hidden; 
               } 
            } 
</style>
<div id="body">
	<?php include_once("include/left_content.php"); ?>
    <div class="rcontent"><br/>
     <h3><span>BILL OF SUPPLY</span></h3>
        <div id="contentbox">
           <?php 
				$time = date("Y-m-d");
				$discount=0;
				//pids
				$pidlist= mysql_query("select pid,p_name from transaction");		
				while($row = mysql_fetch_array($pidlist)){
					$pid[]=$row['pid'];
					$p_name[]=$row['p_name'];
				}
				$pids = implode(",",$pid);
				$p_names = implode(",",$p_name);
				//total amount
				$data = mysql_query("select sum(price) from transaction");
				$data = mysql_fetch_array($data);
				$totamo = $data['sum(price)'];
				$promo=$_POST['discount'];				
				if($promo!=0){
					$promolist = mysql_query("select discount,valid_upto from promotion where promo_code='{$promo}'");
					if(mysql_num_rows($promolist)){
						$promolist=mysql_fetch_array($promolist);
						$time = date("Y-m-d");
						$n=date($promolist['valid_upto']);
						if($n>$time){
							mysql_query("update promotion set count=count+1 where promo_code='{$promo}'");
							echo "Discount ".$promolist['discount']."%";
							$discount = ($totamo*$promolist['discount'])/100;
							$totamo = $totamo-($totamo*$promolist['discount'])/100;
						}
					}
				}
				//profit, profit-discount error
				$profit=0;
				$data = mysql_query("select pid,p_name,quantity from transaction");
				while($row=mysql_fetch_array($data)){
					$temp = mysql_query("select cost_price,market_price,quantity, product_name from product where product_id='{$row['pid']}'");
					$temp = mysql_fetch_array($temp);
					if($row['quantity']>$temp['quantity'] || $row['quantity']<=0){
						echo"<script>if(alert('Quantity of {$temp['product_name']} is wrong'))</script>";						
						$flag=0;
					}
					else $flag=1;
					$profit+=$row['quantity']*($temp['cost_price']-$temp['market_price']);
				}
				$profit-=$discount;
			
				if($flag==1){
					$cid = $_POST['cid'];
					if($cid!=0){
					 
					$clist = mysql_query("select first_name, last_name,cmoney_spent from customer where cid='{$cid}'");
					$clist=mysql_fetch_array($clist);?>
					<table border = 1 style='width:90%; border-collapse : collapse;'>
									<tr>
										<td  rowspan='3'><h2>SAI TRADERS</h2> 3-18/1A, NEAR RAMALAYAM<br/>VADDIPARRU POST<br/>CHINTALAGARUVU, PODURU MANDAL, W G Dt <br/> GSTIN/UIN: 37AYTPH0545A1ZL<BR/> State Name : ANDHRA PRADESH, Code: 37</td>
										<td>INVOICE  No: </td>
										<td><b>Dated<br/><?php echo $time;?></td>
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
										<td  rowspan='3'><b>CUSTOMER  NAME</b> <br/><br/> <?php echo strtoupper($clist['first_name']." ".$clist['last_name']);?></td>
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
								</table>
				<?php	//echo " Hello ".$clist['first_name']." ".$clist['last_name']." your previous balance is Rs. ". $clist['cmoney_spent']."<br />";
					mysql_query("update customer set cmoney_spent=cmoney_spent+'{$totamo}' where cid='{$cid}'");
					//echo "New balance: Rs. ";
					//echo $clist['cmoney_spent']+$totamo;
				}
				
				$fn=" ";
				$ln=" ";
				
				$rs = mysql_query("SELECT first_name, last_name FROM customer where cid='{$cid}'");


				if (mysql_num_rows($rs) > 0) {
					// output data of each row
					while($row = mysql_fetch_assoc($rs)) {
						$fn .= "" . $row['first_name']. "";
						$ln .= "" . $row['last_name']. "";
				}
			}

			//echo $menu;

				$result = mysql_query("insert into buy values(NULL,'{$time}','{$pids}', $totamo, $profit, $cid, '{$p_names}', '{$fn}','{$ln}')");
				if(!$result) echo "Error in transaction. Please <a href='transaction.php'>retry</a>";
				else {
					echo"<div id='data'>";
					
					
					echo"<script type='text/javascript' src='js/script.js'></script>
								<link rel='stylesheet' href='css/rupee.css'>
								<style type='text/css'>
									#list {
										  border-collapse: collapse;
										}
										#list th,td{
											padding:2px;
											text-align:left;
										}
										
										@font-face {
											font-family: 'rupee';
											src: url('rupee_foradian-1-webfont.eot');
											src: local('Ã¢ËœÂº'), url(data:font/truetype;charset=utf-8;base64,AAEAAAANAIAAAwBQRkZUTVen5G0AAADcAAAAHEdERUYAQAAEAAAA+AAAACBPUy8yRQixzQAAARgAAABgY21hcGmyCE0AAAF4AAABamdhc3D//wADAAAC5AAAAAhnbHlmmuFTtAAAAuwAABAoaGVhZPOmAG0AABMUAAAANmhoZWELSAQOAAATTAAAACRobXR4KSwAAAAAE3AAAABMbG9jYUCgSLQAABO8AAAAKG1heHAAFQP+AAAT5AAAACBuYW1lWObwcQAAFAQAAAIDcG9zdCuGzNQAABYIAAAAuAAAAAEAAAAAxtQumQAAAADIadrpAAAAAMhp2uoAAQAAAA4AAAAYAAAAAAACAAEAAQASAAEABAAAAAIAAAADAigBkAAFAAgFmgUzAAABGwWaBTMAAAPRAGYCEgAAAgAFAAAAAAAAAIAAAKdQAABKAAAAAAAAAABITCAgAEAAICBfBZr+ZgDNBrQBoiAAARFBAAAAAAAFnAAAACAAAQAAAAMAAAADAAAAHAABAAAAAABkAAMAAQAAABwABABIAAAADgAIAAIABgAgAFIAoCAKIC8gX///AAAAIABSAKAgACAvIF/////j/7L/ZeAG3+LfswABAAAAAAAAAAAAAAAAAAAAAAEGAAABAAAAAAAAAAECAAAAAgAAAAAAAAAAAAAAAAAAAAEAAAMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB//8AAgABAAAAAAO0BZwD/QAAATMVMzUhFTMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVIxUjNSMVIzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNSE1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1ITUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNSECTBAYATwEBAQEBAQEBAQEBAQEBAQEBAQEBAQQ2AQEBAQEBAQEBAQEBAQEBAT0BAQEBAQEBAQEBAQEBAQEBAQEBAQECJwEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAgEBAQECAQECAQIBAgECAgECAwICAgMCAwMEAwQFBAcHBAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBIAcMAwEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEsCAcEBAMDAwICAgICAgECAQIBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAT9/AQEBAQEBAQEBAQEBAQEBAQEBAQECAGYBAQEBAQEBAQEBAQEBAgECAQIBAwICAwIEBAYFCjwBAQEBAQEBAQEBAQEBAQEBAQEBAQECAH0BZwEBAQIBAgIBAgECAQIBAgIBAgECAQIBAQEDAgECAQIBAgECAwICAwQEAQEBAgECAQICAQIBAgECAgECAQICAQEBAgQEBAMDAgIDAQICAQICAQEBAgEBAgEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBBAECAQEBAgEBAgEBAQECAQECAQEBAgEBAQIBAQIBAQEBAQIBAgEBAgEBAQIBAQECAQEBAgEBAQIBAQEBAQIBAQIBAQECAQEBAgEBAgEBAQEBAgEBAgEBAgEBAQEBAgEBAgEBAQECAQECAQEBAgEBAQECAQECAQECAQEBAQIBAQEBAgEBAQEBAQECAQEBAQIBAQECAQEBAgEBAQIBAQECAQECAQEBAgECAQEBAgEBAQIBAQIBAQEBAgEBAgEBAgEBAQECAQECAQEBAQIBAQECAQECAQEBAQIBAQIBAQEBAQIBAQECAQEBAgEBAgEBAQEBAQIBAQECAQEBAQIBAQECAQEBAQEBAgIeAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQECAQECAQICAgIDAwIHBQMCAQICAQIBAgECAQICAQIBAgEBAQEDAgIBAgEBAgEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAgECAQIBAgECAQIBAgECAQICAQEBAQAAAAAAQAAAAADtAWcA/0AAAEzFTM1IRUzFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUjFSMVIxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFTMVMxUzFSMVIzUjFSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUhNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNSE1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUjNSM1IzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUzNTM1MzUhAkwQGAE8BAQEBAQEBAQEBAQEBAQEBAQEBAQEENgEBAQEBAQEBAQEBAQEBAQE9AQEBAQEBAQEBAQEBAQEBAQEBAQEBAicBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIBAQEBAgEBAgECAQIBAgIBAgMCAgIDAgMDBAMEBQQHBwQBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBASAHDAMBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBLAgHBAQDAwMCAgICAgIBAgECAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQE/fwEBAQEBAQEBAQEBAQEBAQEBAQEBAgBmAQEBAQEBAQEBAQEBAQIBAgECAQMCAgMCBAQGBQo8AQEBAQEBAQEBAQEBAQEBAQEBAQEBAgB9AWcBAQECAQICAQIBAgECAQICAQIBAgECAQEBAwIBAgECAQIBAgMCAgMEBAEBAQIBAgECAgECAQIBAgIBAgECAgEBAQIEBAQDAwICAwECAgECAgEBAQIBAQIBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQQBAgEBAQIBAQIBAQEBAgEBAgEBAQIBAQECAQECAQEBAQECAQIBAQIBAQECAQEBAgEBAQIBAQECAQEBAQECAQECAQEBAgEBAQIBAQIBAQEBAQIBAQIBAQIBAQEBAQIBAQIBAQEBAgEBAgEBAQIBAQEBAgEBAgEBAgEBAQECAQEBAQIBAQEBAQEBAgEBAQECAQEBAgEBAQIBAQECAQEBAgEBAgEBAQIBAgEBAQIBAQECAQECAQEBAQIBAQIBAQIBAQEBAgEBAgEBAQECAQEBAgEBAgEBAQECAQECAQEBAQECAQEBAgEBAQIBAQIBAQEBAQECAQEBAgEBAQECAQEBAgEBAQEBAQICHgEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAgEBAgECAgICAwMCBwUDAgECAgECAQIBAgECAgECAQIBAQEBAwICAQIBAQIBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIBAgECAQIBAgECAQIBAgECAgEBAQEAAAAAAEAAAABAACTKPMBXw889QALCAAAAAAAyGna6gAAAADIadrqAAAAAAO0BZwAAAAIAAIAAAAAAAAAAQAABrT+XgDeBZwAAAAAA7QAAQAAAAAAAAAAAAAAAAAAABMD9gAAAAAAAAKqAAAB/AAAA/YAAAH8AAACzgAABZwAAALOAAAFnAAAAd4AAAFnAAAA7wAAAO8AAACzAAABHwAAAE8AAAEfAAABZwAAAAAECgQKBAoECggUCBQIFAgUCBQIFAgUCBQIFAgUCBQIFAgUCBQIFAABAAAAEwP+AAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgB+AAEAAAAAABMABQAAAAMAAQQJAAAAaAAFAAMAAQQJAAEACgBtAAMAAQQJAAIADgB3AAMAAQQJAAMADgCFAAMAAQQJAAQAGgCTAAMAAQQJAAUAVgCtAAMAAQQJAAYACgEDAAMAAQQJABMACgENAAMAAQQJAMgAbgEXUnVwZWUAVAB5AHAAZQBmAGEAYwBlACAAqQAgACgAeQBvAHUAcgAgAGMAbwBtAHAAYQBuAHkAKQAuACAAMgAwADEAMAAuACAAQQBsAGwAIABSAGkAZwBoAHQAcwAgAFIAZQBzAGUAcgB2AGUAZABSAHUAcABlAGUAUgBlAGcAdQBsAGEAcgB3AGUAYgBmAG8AbgB0AFIAdQBwAGUAZQAgAFIAZQBnAHUAbABhAHIAVgBlAHIAcwBpAG8AbgAgADEALgAwADAAIABKAHUAbAB5ACAAMQA1ACwAIAAyADAAMQAwACwAIABpAG4AaQB0AGkAYQBsACAAcgBlAGwAZQBhAHMAZQBSAHUAcABlAGUAUgB1AHAAZQBlAFQAaABpAHMAIABmAG8AbgB0ACAAdwBhAHMAIABnAGUAbgBlAHIAYQB0AGUAZAAgAGIAeQAgAHQAaABlACAARgBvAG4AdAAgAFMAcQB1AGkAcgByAGUAbAAgAEcAZQBuAGUAcgBhAHQAbwByAC4AAAIAAAAAAAD/JwCWAAAAAAAAAAAAAAAAAAAAAAAAAAAAEwAAAAEAAgADADUBAgEDAQQBBQEGAQcBCAEJAQoBCwEMAQ0BDgEPB3VuaTAwQTAHdW5pMjAwMAd1bmkyMDAxB3VuaTIwMDIHdW5pMjAwMwd1bmkyMDA0B3VuaTIwMDUHdW5pMjAwNgd1bmkyMDA3B3VuaTIwMDgHdW5pMjAwOQd1bmkyMDBBB3VuaTIwMkYHdW5pMjA1Rg==)
											format('truetype');
											font-weight: normal;
											font-style: normal;
										}
										@page {
											size: auto;   /* auto is the initial value */
											margin: 0;  /* this affects the margin in the printer settings */
										}
								</style>";
								if(isset($_GET['id'])){
									mysql_query("delete from transaction where id='{$_GET['id']}'");
								}
								if(isset($_GET['pid']) & isset($_GET['q'])){
									$pid = $_GET['pid'];
									$quan = $_GET['q'];
									$plist = mysql_query("select product_name, hsn, cost_price from product where product_id='{$pid}'");
									if(!$plist) die("error");
									if(mysql_num_rows($plist)){	
										while($row = mysql_fetch_array($plist)){
											$pname = $row['product_name'];
											$phsn = $row['hsn'];
											$price = $row['cost_price'];
											
											$discount = $row['discount'];
											//$price *=$quan;	
											$price = ($price - ($price * ($discount/100))) * $quan;	
										}
									}
									mysql_query("insert into transaction values('{$pname}','{$phsn}',$pid,$quan,$discount,$price,NULL)");
								}
								$translist = mysql_query("select * from transaction");
								$transmax = mysql_query("select sum(price) from transaction");
								$transmax = mysql_fetch_array($transmax);
								
								if(mysql_num_rows($translist)){
									echo "<table border = 1 id='list' style='width:90%;'>
													<tr>
														<th>Description of goods</th>
														<th>HSN/SAC</th>
														<th>Quantity</th>
														<th>Per</th>
														<th>Disc. %</th>
														<th>Rate</th>
														<th>Amount</th>
													</tr>";
										  
									while($row = mysql_fetch_array($translist)){
										//transtable.php?id={$row['id']}
										$x = $row['quantity'];
										$y = $row['price'];
										$z = $y / $x ;
										?>
										<tr>
														<td style='border-bottom:none;border-top:none'><i><?php echo strtoupper($row['p_name']);?></i></td>
														<td style='border-bottom:none;border-top:none'></td>
														<td style='border-bottom:none;border-top:none'><?php echo $row['quantity'];?></td>
														<td style='border-bottom:none;border-top:none'>Pc.s</td>
														<td style='border-bottom:none;border-top:none'><?php echo $row['discount'];?>%</td>
														<td style='border-bottom:none;border-top:none'><?php echo $z;?></td>
														<td style='border-bottom:none;border-top:none;text-align :right'><?php echo $row['price'];?></td>
													</tr>
									<?php			
									}
									$number = $transmax['sum(price)'];
									   $no = floor($number);
									   $point = round($number - $no, 2) * 100;
									   $hundred = null;
									   $digits_1 = strlen($no);
									   $i = 0;
									   $str = array();
									   $words = array('0' => '', '1' => 'One', '2' => 'Two',
										'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
										'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
										'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
										'13' => 'Thirteen', '14' => 'Fourteen',
										'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
										'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
										'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
										'60' => 'Sixty', '70' => 'Seventy',
										'80' => 'Eighty', '90' => 'Ninety');
									   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
									   while ($i < $digits_1) {
										 $divider = ($i == 2) ? 10 : 100;
										 $number = floor($no % $divider);
										 $no = floor($no / $divider);
										 $i += ($divider == 10) ? 1 : 2;
										 if ($number) {
											$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
											$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
											$str [] = ($number < 21) ? $words[$number] .
												" " . $digits[$counter] . $plural . " " . $hundred
												:
												$words[floor($number / 10) * 10]
												. " " . $words[$number % 10] . " "
												. $digits[$counter] . $plural . " " . $hundred;
										 } else $str[] = null;
									  }
									  $str = array_reverse($str);
									  $result = implode('', $str);
									  $points = ($point) ?
										"." . $words[$point / 10] . " " . 
											  $words[$point = $point % 10] : '';
									  //echo $result . "Rupees  " . $points . " Paise";
									  $n = $transmax['sum(price)'];
									  $n = number_format($n, 2);
									echo "</table><br/>
												<table  border = '1' id='list' style='width:90%'><tr>
													<tr>
														<td colspan ='4' style = 'text-align :right;'>Total</td>
														<td style = 'text-align :right;'> <span style='font-family:rupee;font-size:20px'>R</span> {$n}</td>
													</tr>
													<tr>
														<td colspan = '5'>Amount Chargeable (in words) <i style =text-align:'right'>E & O.E</i> <p font-size = '14'>INR {$result} Rupees {$points} Paise Only</p></td>
														
													</tr>
													<tr>
														<td colspan = '4'>HSN/SAC</td>
														
														<td>Taxable <br/> Value</td>
													</tr>
													<tr>
														<td colspan = '4'></td>
														
														<td>{$transmax['sum(price)']}</td>
													</tr>
													<tr>
														<td colspan = '4' style='text-align:right'>Total</td>
													
														<td>{$transmax['sum(price)']}</td>
													</tr>
													<tr>
														<td colspan = '2' align = 'justify'><b>Declaration </b><br/>We Declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.</td>
														<td colspan = '3'>Company's Bank Details <br/> Bank Name : Axis Bank <br/> A/C  No. : 919020032014665 <br/> Branch & IFSC code : POOLAPALLI & UTIB000216</td>
													</tr>
													
													<tr>
														<td colspan = '2'> <b>Customer</b><br/><br/><br/>Signature</td>
														<td colspan = '3'>for <b>SAI TRADERS</b><br/><br/><br/>Signature</td>
													</tr>
													
												</table>";
												
												echo "This is a Computer Generated Invoice"; ?> <br/><?php
												echo "*** Thank You and Visit Again ***";
												
									}
									else 
										echo "No items added yet.";
									
									
					$data = mysql_query("select pid,quantity from transaction");
				while($row=mysql_fetch_array($data)){
					$temp = mysql_query("update product set quantity = quantity-'{$row['quantity']}' where product_id='{$row['pid']}'");					
				}
					mysql_query("truncate table transaction");
				}
				}else echo"Error with quantity values please check again... <a href='transaction.php'>Go Back</a>";
				
				




 ?>
 
 <br/> <br/> 
<input id="printpagebutton" type="button" value="Print this page" onclick="printpage()"/>
<a href ="main2.php" class = "noprint"><input  id="printpagebutton" type="button" value="Go to Home"/></a>

				
	
            </div>
        </div>
    </div>
</div>
</center>
<!-- body ends -->
<?php 
	require_once("include/footer.php");
?>