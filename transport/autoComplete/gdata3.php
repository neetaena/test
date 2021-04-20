<?php
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);       
// เชื่อมต่อฐานข้อมูล
$link=mysql_connect("localhost","root","654321") or die("error".mysql_error());
mysql_select_db("properties",$link);
mysql_query("set character set utf8");
$q = urldecode($_GET["q"]);
$pagesize = 50; // จำนวนรายการที่ต้องการแสดง
$sql = "select * from head_project WHERE numberProject LIKE '$q%' limit 0 , $pagesize";
$results = mysql_query($sql);
while ($row = mysql_fetch_array( $results )) {
	$id = $row[numberProject]; // ฟิลที่ต้องการส่งค่ากลับ
	$id2 = $row[IDP];
	//$name = ucwords( strtolower( $row["arti_topic"] ) ); // ฟิลที่ต้องการแสดงค่า
	$show = ucwords( strtolower( $row["show_arti_topic"] )); // ฟิลที่ต้องการแสดงค่า
	// ป้องกันเครื่องหมาย '
	$name = str_replace("'", "'", $name);
	// กำหนดตัวหนาให้กับคำที่มีการพิมพ์
	$display_name = preg_replace("/(" . $q . ")/i", "<b>$1</b>", $name);
	echo "<li onselect=\"this.setText('".$id."').setValue('".$id2."');\">$id</li>";
}
mysql_close();
?>
