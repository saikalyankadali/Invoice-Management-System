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
		<h1><span>Add Employee:</span></h1>
        <div id="data">To view list of employees <a style="text-decoration:underline" href="viewlist.php?list=employee">click here</a><br /><br />
	<?php
	   if(isset($_GET['third'])&&isset($_POST['user'])){
		   $user_result=mysql_query("INSERT INTO login VALUES('{$_POST['user']}',md5('{$_POST['password']}'),NULL,{$_POST['admin']})");
		   if(!$user_result){
		   echo "Addition not successful".mysql_error();
		   //header("Location:addemp.php");
	   		}
	   		else echo"Addition of employee user data successful";
	   }
	   else if(isset($_GET['third'])) echo "You are not supposed to visit this page. Please go <a href='addemp.php'>back</a>";
	   //second page
	   if(isset($_GET['second'])&&isset($_POST['fname'])){
		   
	   		$result = mysql_query("INSERT INTO employee VALUES('{$_POST['fname']}','{$_POST['lname']}',NULL,'{$_POST['dept_id']}',{$_POST['salary']},{$_POST['pnum']},'{$_POST['address']}',{$_POST['uid']},'{$_POST['jdate']}','{$_POST['bdate']}','{$_POST['edate']}',{$_POST['perks']},{$_POST['admin']})"); 
	   //page 2 form
	   $empidset = mysql_query("SELECT id FROM employee where uid='{$_POST['uid']}'");
	   $empid=mysql_fetch_array($empidset);
	   echo"<form method='post' action='addemp.php?third=1'>
	   		<table>
	   		<tr><td style='padding:5px'>Username:</td>
			<td><input type='text' name='user' /></td></tr>
			<tr><td style='padding:5px'>Password:</td>
			<td><input type='password' name='password' /></td></tr>
			<input type='hidden' name='admin' value='{$_POST['admin']}' />
			<input type='hidden' name='id' value='{$empid[0]}' />
			<tr><td colspan='2' style='padding:5px'><input type='submit' value='submit' /></td></tr>
			</table>
			</form>";
	   if(!$result)echo "Addition not successful";
	   else echo"Addition of employee data successful";
	
	   }
	   
	   else if(isset($_GET['second'])) echo "You are not supposed to visit this page. Please go <a href='addemp.php'>back</a>";
	   else {
		   $time = date("Y-m-d");
		echo"<form method='post' action='addemp.php?second=1'>
        	<table>
            	<tr><td style='padding:5px'>First Name:</td>
                    <td><input type='text' name='fname' /></td></tr>               
                <tr><td style='padding:5px'>Last Name:</td>
                    <td><input type='text' name='lname' /></td></tr>
					<tr><td style='padding:5px'>Dept: </td>
						<td><input list='depts' name='dept_id' placeholder='0' value='NULL'><datalist id='depts'>";
						
						$dept_set = mysql_query("select dept_id, dept_name from department where manager_id='0'");
				while($row = mysql_fetch_array($dept_set))
					echo "<option value='{$row['dept_id']}'>{$row['dept_name']}</option>";
																	
					echo"</datalist>
						</td></tr> 
                 <tr><td style='padding:5px'>Salary</td>
                 <td><input type='text' name='salary' /></td></tr>
                 <tr><td style='padding:5px'>Phone No.</td>
                 <td><input type='text' placeholder='+91..' name='pnum' /></td></tr>
                 <tr><td style='padding:5px'>Address</td>
                 <td><input type='text' name='address' /></td></tr>
                 <tr><td style='padding:5px'>Uid</td>
                 <td><input type='text' name='uid' /></td></tr>
                 <tr><td style='padding:5px'>Dob</td>
                 <td><input type='text' name='bdate' placeholder='YYYY-MM-DD' /></td></tr>
                 
				 <input type='hidden' name='jdate' value='{$time}' />
				 
                 <input type='hidden' name='edate' value='0000-00-00' />
				           
                 <input type='hidden' name='perks' value='0'/>
				 <tr><td style='padding:5px'>Admin</td><td><select name='admin'>
				 	<option value='1'>Admin</option>
					<option value='0'>Not Admin</option>
					</select></td></tr>
                 <tr><td colspan='2'><input type='submit' name='submit' value='Submit' /></td></tr>
        </table></form>";
	   }
		?>
       
         </div>
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
