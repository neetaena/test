<?php
 include("../include/mySqlFunc.php");
 query("USE transport");

 $id_check_driver = $_GET['id_check_driver'];
 if(!empty($_POST['submit']))
 {
 	$licence_check_driver = $_POST['licence_check_driver'];
 	$note_check_driver = $_POST['note_check_driver'];
 	$detail = $_POST['detail'];
 	$date_time = $_POST['date_time'];

 	$result = query("UPDATE check_driver_car SET licence_check_driver='$licence_check_driver',note_check_driver='$note_check_driver'
 		,detail='$detail',date_time='$date_time' WHERE id_check_driver='$id_check_driver'");

 	if($result)
 	{
 		print"<script type='text/javascript'>alert('บันทึกสำเร็จ');</script>";
		print"<script>window.close();</script>";
 	}
 	else
 	{
 		print"<script type='text/javascript'>alert('บันทึกล้มเหลว');</script>";
 	}
 }

 $edit_data = getlist("SELECT * FROM check_driver_car AS cdc WHERE cdc.id_check_driver='$id_check_driver'");
print("<html>");
print("<head>");
print("<title>edit_data </title>");
print("</head>");
print("<body>");
print("<form action=\"#\" name=\"edit_data\" method=\"POST\">");
print("<br>");
print("<table border=\"1\" align=\"center\" width=\"400\">");

$_POST['licence_check_driver'] = empty($_POST['licence_check_driver']) ? $edit_data[0]['licence_check_driver']:$_POST['licence_check_driver'];
$_POST['note_check_driver'] = empty($_POST['note_check_driver']) ? $edit_data[0]['note_check_driver']:$_POST['note_check_driver'];  
$_POST['detail'] = empty($_POST['detail']) ? $edit_data[0]['detail']:$_POST['detail'];
$_POST['date_time'] = empty($_POST['date_time']) ? $edit_data[0]['date_time']:$_POST['date_time'];

print("<tr>");
	print("<th>ทะเบียนรถ</th>");
	print("<td><input type =\"text\" name =\"licence_check_driver\" value=\"".$_POST['licence_check_driver']."\" style=\"width:100%;\" required></td>");
print("</tr>");

print("<tr>");
	print("<th>หมายเหตุ</th>");
	print("<td>");
	$note_descripteion = array("ไม่มีงาน","คนขับลา","รถซ่อม","วันหยุด","ยังไม่มีคนขับ","เทเลอร์แก๊ส","เทเลอร์น้ำมัน","สิบล้อแก๊ส","สิบล้อน้ำมัน","อื่นๆ");
	print("<select name=\"note_check_driver\" style=\"width:100%;\" required>");
	print("<option value=''>เลือกหมายเหตุ</option>");
	for($k=0;$k<sizeof($note_descripteion);$k++)
	{
		$selected = $_POST['note_check_driver'] == $note_descripteion[$k] ? "selected=\"selected\"" : "";
		print("<option value=\"".$note_descripteion[$k]."\" $selected>".$note_descripteion[$k]."</option>");
	}
	print("</select>");
	print("</td>");
print("</tr>");

print("<tr>");
	print("<th>รายละเอียด</th>");
	print("<td><input type =\"text\" name=\"detail\" value=\"".$_POST['detail']."\" style=\"width:100%;\"></td>");
print("</tr>");

print("<tr>");
	print("<th>วันที่</th>");
	print("<td><input type =\"date\" name=\"date_time\" value=\"".$_POST['date_time']."\" style=\"width:100%;\" required></td>");
print("</tr>");
print("</table>");

print("<table border=\"0\" align=\"center\" width=\"120\">");
print("<colgroup>");
print("<col span=\"2\" width=\"50\">");
print("</colgroup>"); 
print("<tr>");
	print("<td style=\"text-align:center;\">");
	print("<input type=\"submit\" align=\"middle\" name=\"submit\" value=\"ตกลง\" style=\"background-color:green; font-size:20px; color:white;\">");
	print("</td>");
	print("<td style=\"text-align:center;\">");
	print("<button onclick=\"self.close()\" style=\"background-color:red; font-size:20px;\">ปิด</button>");
	print("</td>");
print("</tr>");
print("</table>");
print("</form>");
?>