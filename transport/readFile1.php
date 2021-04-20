<?php
//ส่วนของการเชื่อมต่อฐานข้อมูล MySQL
/*$objConnect = mysql_connect("server-vng","root","0894841471") or die("Error Connect to Database"); // Conect to MySQL
$objDB = mysql_select_db("transport");*/
include("../include/mySqlFunc.php");
	query("USE transport");
	query("SET NAMES UTF8");
	 //date_default_timezone_set("Asia/Bangkok");
    	//	$date_time =  date("Y-m-d H:i:s");
//ทำการเปิดไฟล์ CSV เพื่อนำข้อมูลไปใส่ใน MySQL
//$objCSV = fopen("location.csv", "r");
$i =0;
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
        //นำข้อมูลใส่ในตาราง member
	if(!empty(trim($objArr[0]))){
		$objArr[0] = iconv("tis-620", "utf-8",  $objArr[0]);
		$objArr[1] = iconv("tis-620", "utf-8",  $objArr[1]);
		$objArr[2] = iconv("tis-620", "utf-8",  $objArr[2]);
		$objArr[3] = iconv("tis-620", "utf-8",  $objArr[3]);

		query("UPDATE shipping SET country='".trim($objArr[3])."' where id_ship='".$objArr[1]."'");
	}


 }
fclose($objCSV);

echo "Import Done.";
/*$get_data = getlist("SELECT detailship,id_ship FROM shipping");
for ($i=0; $i < sizeof($get_data); $i++) { 
	//query("UPDATE shipping set detailship='".trim($get_data[$i]['detailship'])."' where id_ship='".$get_data[$i]['id_ship']."'");
	$check_data = getlist("SELECT detailship,id_ship FROM shipping where detailship='".trim($get_data[$i]['detailship'])."'");
	if(sizeof($check_data)>1){
		for ($j=1; $j < sizeof($check_data); $j++) { 
			query("DELETE FROM shipping where id_ship='".$check_data[$j]['id_ship']."'");
		}
	}
}*/



?>