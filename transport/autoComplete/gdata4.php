<?php
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);       
// เชื่อมต่อฐานข้อมูล
include("../../include/mySqlFunc.php");
query("USE transport");

$q = urldecode($_GET["q"]);

	$pagesize = 50; // จำนวนรายการที่ต้องการแสดง
	$row = getList("SELECT * from customer WHERE namecustomer LIKE '%$q%' limit 0 , $pagesize");
	for($i=0;$i<sizeof($row);$i++){
		echo "<li onselect=\"this.setText('".$row[$i]['namecustomer']."').setValue('".$row[$i]['id_customer']."');\">".$row[$i]['namecustomer']."</li>";
	}

?>
