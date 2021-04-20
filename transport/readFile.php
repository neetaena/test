<?php
	include("../include/mySqlFunc.php");
	query("USE transport");
	query("SET NAMES UTF8");

	//$get_data = getlist("SELECT * FROM  insertdata_transport ");

	for ($i=0; $i < sizeof($get_data); $i++) { 
		$check_use = getlist("SELECT * FROM car_detail WHERE id_car='".$get_data[$i]['idcar']."'");
	
			query("UPDATE insertdata_transport SET typecar='".$check_use[0]['typecar']."' WHERE id_transport='".$get_data[$i]['id_transport']."'");
		
	
	}

	/*$num = 817;

	for ($i=$num; $i <= 929; $i++) { 
		query("DELETE FROM customer where id_customer='$i'");
		//print("<br>");
	}*/

?>
