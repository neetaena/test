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

		$datein = $_GET['datein'];
		$dateout = $_GET['dateout'];
		$license_plate = $_GET['license_plate'];
		$today = $_GET['today'];
		$type_fule = $_GET['type_fule'];
	/*$datein = "2018-10-20";
	$dateout = "2018-10-26";
	$license_plate = "11";//61-7765*/

	//เงื่อนไขเมื่อกดรายงานตัวที่ 1 แยกตามทะเบียน
	if($today==1){
		include('report_all_gas_data.php');

	}
	//เงื่อนไขเมื่อกดรายงานตัวที่ 2 การใช้เชื้อเพลิงในแต่ละวัน
	else if($today==2){
		include('report_today_ngv.php');
	}

?>
