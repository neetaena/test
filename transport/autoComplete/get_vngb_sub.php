<?php
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);       
// เชื่อมต่อฐานข้อมูล
include("../../include/mySqlFunc.php");
query("USE transport");

$q = urldecode($_GET["q"]);

	$pagesize = 50; // จำนวนรายการที่ต้องการแสดง

			$row = getlist("SELECT * from supplier_vngb WHERE supplier_name LIKE '%$q%'  limit 0 , $pagesize ");	
	
	for($i=0;$i<sizeof($row);$i++){
		echo "<li onselect=\"this.setText('".$row[$i]['supplier_name']."').setValue('".$row[$i]['vngb_id']."');\">".$row[$i]['supplier_name']."</li>";
	}

?>
