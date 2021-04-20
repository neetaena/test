<?php
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);       
// เชื่อมต่อฐานข้อมูล
include("../../include/mySqlFunc.php");
query("USE transport");

$q = urldecode($_GET["q"]);

	$pagesize = 50; // จำนวนรายการที่ต้องการแสดง

			$row = getlist("SELECT * from car_detail where status = '1' and licenceplates LIKE '%$q%'  order by licenceplates limit 0 , $pagesize ");	
		
 
	for($i=0;$i<sizeof($row);$i++){
		echo "<li onselect=\"this.setText('".$row[$i]['licenceplates']." ".$row[$i]['licenceplate2']."').setValue('".$row[$i]['id_car']."');\">".$row[$i]['licenceplates']." ".$row[$i]['licenceplate2']."</li>";
	}

?>
