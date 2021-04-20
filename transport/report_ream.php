<meta http-equiv="Content-Type" content = "text/html; charset=utf-8" />
<html>
	<head>
		<title>
		ใบสั่งงานขนส่งไม้
		</title>
		<link type="text/css" href="assets/bootstrap/bootstrap.css" rel = "stylesheet" />
		<style type="text/css">
	@media print { 

	 .excel{ display: none !important; } 
	}

	.font-style{
		empty-cells: show;
		font-family:angsana new;
		font-size:14px;"
	}
</style>
	</head>
	<?php
		@ini_set('display_errors', '0');
		include("../include/mySqlFunc.php");
		include 'function.php';
		query("USE transport");

			function nextPage(){
				print ("</table>");
				print("<div style=\"float: right;margin-top: 5px;\">FM-SW-W09</div>");
				print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");

			}	
			
			include 'path_report_ream.php';
	
	?>

			
			
	
	</html>