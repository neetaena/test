<style type="text/css">
	th,td{
		font-family: 'angsana new';
		font-size: 17px;
	}
	.item_head{
		border: 1px solid;
		text-align: center;
	}
	.item_body{
		border-left: 1px solid;
		padding-left: 5px;
		line-height: 0.7;
	}

</style>
<?php
	@session_start();
    @ini_set('display_errors', '0');
    include("../include/mySqlFunc.php");
    query("Use transport");
    $datein = $_GET['datein'];
	$dateout = $_GET['dateout'];
	$namedriver = $_GET['namedriver'];
	$department = $_GET['department'];
    function nextPage(){
		
		print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");
	}

	print("<div class=\"container\">");
				print("<a href=\"excel_report_boonpon2.php?datein=".$datein."&dateout=".$dateout."&department=$department&namedriver=$namedriver&excel=1\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");	

   include 'report_boonpon2_test.php';
?>