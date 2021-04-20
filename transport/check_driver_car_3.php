<!DOCTYPE html>
<html>
<head>
	<title>กรอกข้อมูลการทำงาน</title>
	<style>
		@import url('https://fonts.googleapis.com/css?family=K2D:600');
		div.a
		{
			font-family: 'K2D', sans-serif; 
			font-size:30px; 
		}
		div.b
		{
			font-family: 'K2D' , sans-serif;
			font-size:18px;
		}
	</style>
	<style>
	#grad1 {
  	height: 1000px;
  	background-color: #acb6e5; /* For browsers that do not support gradients */
    background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
    /*background-image: linear-gradient(to bottom right, #acb6e5, #86fde8);*/
    /*background-image: linear-gradient(to bottom right, pink, rgb(254, 114, 123));*/ /* Standard syntax (must be last) */
	}
</style>
</head>
<body>
	<!-- autocomplete code -->
	<script type="text/javascript" src="autocomplete_2/assets/js/jquery.js"></script>
    <script type="text/javascript" src="autocomplete_2/assets/js/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<link rel="stylesheet" type = "text/css" href = "autocomplete_2/datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="autocomplete_2/datetimepicker/jquery.datetimepicker.js"></script>
	<link rel="stylesheet" href="autocomplete_2/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
	<script src="search_all_data.js"></script>
	<!-- end autocomplete code -->
	<!-- bootsrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- end bootsrap -->
	<script type="text/javascript">
	function chkNumber(ele)
	{
  		var vchar = String.fromCharCode(event.keyCode);
  		if ((vchar<'0' || vchar>'9')) return false;
  		ele.onKeyPress=vchar;
	}		
	</script>
<?php
include("../include/mySqlFunc.php");
error_reporting(0);
query("USE transport");
date_default_timezone_set("Asia/Bangkok");
$getdata = getlist("SELECT * FROM fix_car");
if(!empty($_POST['submit_data']))
{
	$count_order = $_POST['count_order'];
	$date = date("Y-m-d H:i:s");
	$date_in = $_POST['date_in'];
	$note = $_POST['note'];
	$name_leave = $_POST['name_leave'];
	$licence = $_POST['licence'];
	$note2 = $_POST['note2'];
	$name_leave2 = $_POST['name_leave2'];

	for($j=0;$j<$count_order;$j++)
	{
		$result = query("INSERT INTO check_driver_car SET licence_check_driver='".$licence[$j]."', 
			note_check_driver='".$note[$j]."', detail='".$name_leave[$j]."', date_time='$date_in', date_time_record='$date'");
	}
	if($result)
	{
		 print"<script type='text/javascript'>alert('บันทึกสำเร็จ');</script>";
		 print"<script>window.close();</script>";
	}
	else
	{
		print"<script type='text/javascript'>alert('บันทึกล้มเหลว');</script>";
	}
	/*if(!empty($_POST['count_order']))
	{
		for($k=0;$k<sizeof($count_order);$k++) 
		{ 
			$result2 = query("INSERT INTO check_driver_car SET licence_check_driver='".$licence[$k]."', 
				note_check_driver='".$note2[$k]."', detail='".$name_leave2[$k]."', date_time='$date_in', date_time_record='$date'");
		}
	}*/
}
print("<div id=\"grad1\">");
print("<form action=\"check_driver_car_3.php\" method=\"POST\">");
print("<br>");
print("<div class=\"a\">");
print("<center><caption>เพิ่มข้อมูลรถว่างงาน</caption></center>");
print("</div>");
print("<div class=\"b\">");
print("<br>");
print("<center>");
print("<table border='0' style=\"width:200mm;\">");
print("<tr>");
print("<td style=\"text-align:right;\">");
print("<button type=\"button\" class=\"btn btn-primary\" ><a href=\"fix_car.php\" target=\"_blank\" style=\"color:white;\">ปุ่มเพิ่ม/แก้ไข ทะเบียน</a></button> ");
print("</td>");
print("</tr>");
print("</table>");
print("<table bgcolor=\"white\" style=\"width:200mm; empty-cells:show;\" border=\"2\" cellpadding=\"2\" align=\"center\" valign=\"middle\">");
///////////ส่วนของเพิ่มช่องกรอก
print("<tr>");
print("<td style=\"text-align:center;\">เพิ่มข้อมูลวันที่</td>");
print("<td colspan=\"2\"><input type=\"date\" name=\"date_in\" value=\"".$_POST['date_in']."\" style=\"width:100%;\" required></td>");
print("</tr>");
print("<tr>");
print("<td style=\"text-align:center;\">เพิ่มจำนวนรถ</td>");
$_POST['count_order'] = empty($_POST['count_order']) ? sizeof($getdata) : $_POST['count_order'];
print("<td colspan=\"2\"><input type=\"text\" name=\"count_order\" value=\"".$_POST['count_order']."\" maxlength=\"2\" onkeydown=\"if(event.keyCode==13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" placeholder=\"กรุณากรอกเลข 1-99 เท่านั้น\" onchange=\"this.form.submit();\" style=\"width:100%;\" ></td>");
print("</tr>");
///////////สิ้นสุดส่วนเพิ่ทช่องกรอก
print("<tr class=\"header_table\">");
print("<th style=\"text-align:center; width:50mm;\">ทะเบียนรถ</th>");
print("<th style=\"text-align:center; width:70mm;\">หมายเหตุ</th>");
print("<th style=\"text-align:center; width:70mm;\">รายละเอียดหมายเหตุ</th>");
print("</tr>");

$note_descripteion = array("ไม่มีงาน","คนขับลา","รถซ่อม","วันหยุด","ยังไม่มีคนขับ","เทเลอร์แก๊ส","เทเลอร์น้ำมัน","สิบล้อแก๊ส","สิบล้อน้ำมัน","อื่นๆ");
for($i=0;$i<$_POST['count_order']; $i++)
{
	$_POST['licence'][$i] = empty($_POST['licence'][$i]) ? $getdata[$i]['fix_licence'] : $_POST['licence'][$i];
	//$insert_lic[] = $getdata[$i]['fix_licence'];
	print("<tr>");
		//print("<td style =\"padding-left:2mm;\">".$getdata[$i]['fix_licence']."</td>");
		print("<td><input type=\"text\" name=\"licence[]\" value=\"".$_POST['licence'][$i]."\" class=\"search_licen\" style=\"width:50mm;\"></td>");
		print("<td>");
	 	 print("<select name=\"note[]\" style=\"width:70mm;\" >");
	 	 print("<option value=''>เลือกหมายเหตุ</option>");
		 for($k=0;$k<sizeof($note_descripteion);$k++)
		 {
			$selected = $_POST['note'][$i] == $note_descripteion[$k] ? "selected=\"selected\"" : "";
			print("<option value=\"".$note_descripteion[$k]."\"".$selected.">".$note_descripteion[$k]."</option>");
		 }
	 	 print("</select>");
		print("</td>");
		print("<td>");
		print("<input type=\"text\" name=\"name_leave[]\" value=\"".$_POST['name_leave'][$i]."\" class=\"search_driver\" placeholder=\"กรุณากรอกรายละเอียดเพิ่มเติม\" style=\"width:100%;\">");
		print("</td>");
	print("</tr>");
}

//for($i=0; $i<$_POST['count_order']; $i++)
//{
 /*print("<tr class=\"body_table\">");
	print("<td><input type=\"text\" name=\"licence[]\" value=\"".$_POST['licence'][$i]."\" class=\"search_licen\" style=\"width:50mm;\"></td>");
	print("<td>");
	 print("<select name=\"note2[]\" style=\"width:70mm;\" >");
	 print("<option value=''>เลือกหมายเหตุ</option>");
	 for($k=0;$k<sizeof($note_descripteion);$k++)
	 {
		$selected = $_POST['note2'][$i] == $note_descripteion[$k] ? "selected=\"selected\"" : "";
		print("<option value=\"".$note_descripteion[$k]."\"".$selected.">".$note_descripteion[$k]."</option>");
	 }
	 print("</select>");
	print("</td>");
	print("<td>");
	print("<input type=\"text\" name=\"name_leave2[]\" value=\"".$_POST['name_leave2'][$i]."\" class=\"search_driver\" placeholder=\"กรุณากรอกรายละเอียดเพิ่มเติม\" style=\"width:100%;\">");
	print("</td>");
	/*if($_POST['note'][$i]=='คนขับลา'||$_POST['note'][$i]=='รถซ่อม'||$_POST['note'][$i]=='อื่นๆ')
	{
		print("<td>");
		print("<input type=\"text\" name=\"name_leave[]\" value=\"".$_POST['name_leave'][$i]."\" class=\"search_driver\" placeholder=\"กรุณากรอกรายละเอียดเพิ่มเติม\" style=\"width:100mm;\">");
		print("</td>");
	}

	if($_POST['note'][$i]=='คนขับลา')
	{
		print("<td>");
		print("<input type=\"text\" name=\"name_leave[]\" value=\"".$_POST['name_leave'][$i]."\" class=\"search_driver\" placeholder=\"กรุณากรอกรายละเอียดเพิ่มเติม\" style=\"width:100mm;\">");
		print("</td>");
	}
	else if($_POST['note'][$i]=='รถซ่อม')
	{
		print("<td>");
		print("<input type=\"text\" name=\"name_leave2[]\" value=\"".$_POST['name_leave2'][$i]."\"  placeholder=\"กรุณากรอกรายละเอียดเพิ่มเติม\" style=\"width:100mm;\">");
		print("</td>");
	}
	else if($_POST['note'][$i]=='อื่นๆ')
	{
		print("<td>");
		print("<input type=\"text\" name=\"name_leave3[]\" value=\"".$_POST['name_leave3'][$i]."\"  placeholder=\"กรุณากรอกรายละเอียดเพิ่มเติม\" style=\"width:100mm;\">");
		print("</td>");
	}*/
 //print("</tr>");
//}

/*print("<tr>");
print("<td style=\"text-align:center;\">");
print("<input type=\"submit\" align=\"middle\" name=\"submit_data\" value=\"ตกลง\" class=\"btn btn-primary\">");
print("</td>");
print("<td style=\"text-align:center;\">");
print("<input type=\"reset\" name=\"reset\" value=\"ล้างค่า\">");
print("</td>");
print("</tr>");*/
print("</table>");
print("<br>");
////btn table
print("<table style=\"width:200mm; empty-cells:show;\" border=\"0\" cellpadding=\"2\" align=\"center\" valign=\"middle\">");
print("<tr>");
print("<td>");
print("<input type=\"submit\" align=\"middle\" name=\"submit_data\" value=\"ตกลง\" class=\"btn btn-success\">");
print("&nbsp;");
print("&nbsp;");
print("<input type=\"reset\" align=\"middle\" name=\"reset\" value=\"ล้างค่า\" class=\"btn btn-danger\">");
print("</td>");
print("</tr>");
print("</table>");
print("</center>");
print("</div>");
print("</form>");
print("</div>");
?>
</body>
</html>