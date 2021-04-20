<meta http-equiv = "Content-Type" content="text/html; charset = utf-8" />
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
				font-size:16px;"
			}
		</style>
	</head>
<?php
@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");
	//@ini_set('display_errors', '0');

		$datein = $_POST['datein'];
		$dateout = $_POST['dateout'];
		include('report_gasngv_data.php');
?>
