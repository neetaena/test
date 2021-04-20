<?php

//ส่วนของการเชื่อมต่อฐานข้อมูล MySQL
/*$objConnect = mysql_connect("server-vng","root","0894841471") or die("Error Connect to Database"); // Conect to MySQL
$objDB = mysql_select_db("transport");*/
error_reporting (E_ALL ^ E_NOTICE);
include("../include/mySqlFunc.php");
	query("USE transport");
	query("SET NAMES UTF8");
	date_default_timezone_set("Asia/Bangkok");
//ทำการเปิดไฟล์ CSV เพื่อนำข้อมูลไปใส่ใน MySQL
$objCSV = fopen("new.csv", "r");
$i =0;
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	$date_time =  date("Y-m-d H:i:s");
        //นำข้อมูลใส่ในตาราง member
		if(!empty($objArr[1])){
			$objArr[0] =iconv("tis-620","utf-8",trim($objArr[0]));
			$objArr[1] =iconv("tis-620","utf-8",trim($objArr[1]));
			$objArr[2] =iconv("tis-620","utf-8",trim($objArr[2]));
			/*$objArr[3] =iconv("tis-620","utf-8",trim($objArr[3]));
			$objArr[4] =iconv("tis-620","utf-8",trim($objArr[4]));
			$objArr[5] =iconv("tis-620","utf-8",trim($objArr[5]));*/
			
			/*$objArr[6] =iconv("tis-620","utf-8",trim($objArr[6]));
			$objArr[7] =iconv("tis-620","utf-8",trim($objArr[7]));
			/*$objArr[8] =iconv("tis-620","utf-8",trim($objArr[8]));
			$objArr[10] =iconv("tis-620","utf-8",trim($objArr[10]));
			//$objArr[11] =iconv("tis-620","utf-8",trim($objArr[11]));

			*/
			$get_product = getlist("SELECT * FROM type_production where  detail_production like '".$objArr[2]."'");

			query("UPDATE production_size SET size_tung='".$objArr[3]."' where product_id='".$get_product[0]['id_production']."' and size_description='".$objArr[1]."'");

			//query("INSERT INTO type_lock SET detail_lock='".$objArr[0]."',row_data='9',layer_data='5',id_warehouse='11'");

			print("<br>");

 }
}
fclose($objCSV);

echo "Import Done.";
?>