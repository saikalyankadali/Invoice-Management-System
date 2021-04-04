<html>
<head>
<style>
.footer{
	position:fixed;
	text-align:center;
	width: 100%;
	height: 50px;
	margin-top:175px;
	color:#FFFFFF;
	font-size:15px;
	opacity: 0.9;
	z-index: 9999;
	bottom:0;
	background: #000;
	-moz-box-shadow: 1px 0px 2px #000;
	-webkit-box-shadow: 1px 0px 2px #000;
	box-shadow: 1px 0px 2px #000;
	clear:both;
}
</style>
</head>
<body>
<div class="footer">
	Developed by KADALI SAI KALYAN.
</div>
<?php
//close connection
if(isset($connect))
mysql_close();
?>

<!--body closes-->
</div>
</body>
</html>
