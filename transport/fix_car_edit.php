<?php
include("../include/mySqlFunc.php");
//error_reporting(0);
query("USE transport");
date_default_timezone_set("Asia/Bangkok");

$fix_id = $_GET['fix_id'];

if(!empty($_POST['submit']))
{
	$fix_licence = $_POST['fix_licence'];
	$fix_type = $_POST['fix_type'];
	$date = date("Y-m-d H:i:S");

	print($fix_licence);

	$result = query("UPDATE fix_car SET fix_licence='$fix_licence', fix_type='$fix_type', date_time_records='$date' WHERE fix_id='$fix_id'");

	if($result)
	{
		print"<script type='text/javascript'>alert('แก้ไขสำเร็จ');</script>";
		print"<script type='text/javascript'>window.close();</script>";
	}
	else
	{
		print"<script type='text/javascript'>alert('แก้ไขไม่สำเร็จ');</script>";
	}
}
$getdata = getlist("SELECT * FROM fix_car WHERE fix_id='$fix_id'");
$_POST['fix_licence'] = empty($_POST['fix_licence']) ? $getdata[0]['fix_licence']:$_POST['fix_licence'];
$_POST['fix_type'] = empty($_POST['fix_type']) ? $getdata[0]['fix_type']:$_POST['fix_type'];
print("<center><caption><h1>แก้ไขรถที่ว่างงาน</h1></caption></center>");
print("<form action=\"\" name=\"edit_data\" method=\"POST\">");
print("<table border=\"1\" align=\"center\" style=\"width:500px;\">");
print("<tr>");
	print("<th>ทะเบียนรถที่ว่าง</th>");
	print("<td><input type=\"text\" name=\"fix_licence\" value=\"".$_POST['fix_licence']."\" style=\"width:100%;\" required></td>");
print("</tr>");
print("<tr>");
	print("<th>ประเภทรถ</th>");
	$fix_type_array = array("เทเลอร์","สิบล้อ");
	print("<td>");
	print("<select name=\"fix_type\" style=\"width:100%\" required>");
	for($i=0; $i<sizeof($fix_type_array); $i++)
	{
		$selected = $_POST['fix_type'] == $fix_type_array[$i]?"selected='selected' " : "";
		print("<option value=\"".$fix_type_array[$i]."\" $selected>".$fix_type_array[$i]."</option>");
	}
	print("</select>");
	print("</td>");
	//print("<td><input type=\"text\" name=\"fix_licence\" value=\"".$_POST['fix_licence']."\" style=\"width:100%;\"></td>");
print("</tr>");
print("</table>");
print("<br>");
print("<table align=\"center\" style=\"width:500px;\">");
print("<tr>");
	print("<td>");
	print("<input type=\"submit\" align=\"middle\" name=\"submit\" value=\"ตกลง\">");
	print("&nbsp;");
	print("&nbsp;");
	print("<button onclick=\"self.close()\" class=\"btn btn-outline-danger\">ปิดหน้านี้</button>");
	print("</td>");
print("</tr>");
print("</table>");
print("</form>");
?>