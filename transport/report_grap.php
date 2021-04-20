<meta http-equiv = "Content-Type" content="text/html; charset = utf-8" />


<html>
	<head>
		<title>
		กราฟจำนวนการใช้งานรถ
		</title>
		<script type="text/javascript" src="assets/scripts/jquery.js"></script>
		<script src="assets/scripts/highcharts.js"></script>
		<script src="assets/scripts/exporting.js"></script>   
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

		$mount = $_GET['month'];
		$year = $_GET['year'];
		$show = $_GET['show'];

		if($show==1){
			include 'chart_mount.php';
		}else if($show==2){
			include 'chart.php';
		}else if($show==3){
			include 'chart_mount.php';
			include 'chart.php';
		}
?>
