<!-- autocomplete code -->
	<script type="text/javascript" src="autocomplete_2/assets/js/jquery.js"></script>
    <script type="text/javascript" src="autocomplete_2/assets/js/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

	<link rel="stylesheet" type = "text/css" href = "autocomplete_2/datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="autocomplete_2/datetimepicker/jquery.datetimepicker.js"></script>
	<link rel="stylesheet" href="autocomplete_2/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
	<script src="search_all_data.js"></script>
<!-- end autocomplete code -->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script language="javascript" src="jquery/jquery-1.12.4.js"></script>
<script type="text/javascript">
$(function(){
    $("#addRow").click(function(){
        $("#myTbl").append($("#firstTr").clone());
    });
    $("#removeRow").click(function(){
        if($("#myTbl tr").size()>1){
            $("#myTbl tr:last").remove();
        }else{
            alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
        }
    });         
});
</script>
<!DOCTYPE html>
<html>
<head>
	<title>fix_car</title>
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
		div.b td,th
		{
			font-size:20px;
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
<?php
include("../include/mySqlFunc.php");
error_reporting(0);
query("USE transport");
date_default_timezone_set("Asia/Bangkok");

if(!empty($_POST['submit']))
{
	$fix_type = $_POST['fix_type'];
	$fix_licence = $_POST['fix_licence'];
	$date = date("Y-m-d H:i:S");
	for($j=0;$j<sizeof($fix_licence);$j++)
	{
		//print($fix_licence[$j]);
		$result = query("INSERT INTO fix_car SET fix_licence='".$fix_licence[$j]."', fix_type='".$fix_type[$j]."', date_time_records='$date'");
	}
	if($result)
	{
		print"<script type='text/javascript'>alert('บันทึกสำเร็จ');</script>";
	}
	else
	{
		print"<script type='text/javascript'>alert('บันทึกล้มเหลว');</script>";
	}
}
print("<div id=\"grad1\">");
print("<br>");
print("<div class=\"a\">");
print("<center><caption>เพิ่มทะเบียนรถที่ว่างงาน</caption></center>");
print("</div>");
$getdata = getlist("SELECT * FROM fix_car");
print("<form id=\"form1\" action=\"\" name=\"form1\" method=\"POST\">");
print("<div class=\"b\">");
print("<table border=\"1\" bgcolor=\"white\" align=\"center\" style=\"width:600px;\">");
print("<tr>");
print("<th style=\"text-align:center;\">ทะเบียนรถที่ว่าง</th>");
print("<th style=\"text-align:center;\">ประเภท</th>");
print("<th style=\"text-align:center;\">แก้ไขข้อมูล</th>");
print("<th style=\"text-align:center;\">ลบข้อมูล</th>");
print("</tr>");
for($i=0;$i<sizeof($getdata); $i++)
{
	print("<tr>");
	print("<td style=\"padding-left:2mm;\">".$getdata[$i]['fix_licence']."</td>");
	print("<td style=\"padding-left:2mm;\">".$getdata[$i]['fix_type']."</td>");
	//////////ปุ่มแก้ไข
	print("<td style=\"text-align:center;\">");
  	print("<button type=\"button\" class=\"btn btn-warning\" ><a onclick=\"window.open('fix_car_edit.php?fix_id=".$getdata[$i]['fix_id']."' , '','menubar=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=450,top=45 ,left=250')\" style=\"cursor:pointer;color:#000000;\"><div id=\"btn\">แก้ไขข้อมูล</div></a></button> ");
  	print("</td>");
  	//////////ปุ่มลบ
	print("<td style=\"text-align:center;\">");
  	print("<button type=\"button\" class=\"btn btn-danger\"><a href=\"JavaScript:if(confirm('คุณต้องการลบข้อมูลนี่ใช่หรือไม่')==true){window.location='".$_SERVER["PHP_SELF"]."?path=fix_car&fix_id=".$getdata[$i]['fix_id']."';}\"><font color=\"black\"><div id=\"btn\">ลบข้อมูล</div></font></button>");
  	print("</td>");	
	print("</tr>");
}
print("</table>");
print("<br>");

print("<table bgcolor=\"white\" id=\"myTbl\" width=\"600px\" border=\"1\" cellspacing=\"2\" cellpadding=\"0\" align=\"center\">");
print("<tr>");
	print("<td style=\"text-align:center;\">เลือกชนิด</td>");
	print("<td style=\"text-align:center;\">ใส่ทะเบียนรถที่ว่างงาน</td>");
print("</tr>");
print("<tr id=\"firstTr\">");
	print("<td style=\"width:30%;\">");
		print("<select name=\"fix_type[]\" id=\"fix_type[]\" style=\"width:100%;\">");
		print("<option value=\"เทเลอร์\">เทรนเลอร์</option>");
		print("<option value=\"สิบล้อ\">สิบล้อ</option>");
		print("</select></td>");
	print("<td><input type=\"text\" name=\"fix_licence[]\" id=\"fix_licence[]\" style=\"width:100%;\"></td>");
print("</tr>");
print("</table>");
print("<br/>");

print("<table width=\"600px\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">");
print("<tr>");
	print("<td>");
		print("<button id=\"addRow\" type=\"button\" class=\"btn btn-success\"><font color='black'>+</font></button>"); 
		print("&nbsp;");
		print("<button id=\"removeRow\" type=\"button\" class=\"btn btn-warning\"><font color='black'>-</font></button>");
		print("&nbsp;");
		print("&nbsp;");
		print("&nbsp;");
//print("<button id=\"submit\" name=\"submit\" type=\"submit\">Submit</button>");    
		//print("<input type=\"submit\" align=\"middle\" name=\"submit\" value=\"เพิ่ม\">");
		print("<input type=\"submit\" align=\"middle\" name=\"submit\" value=\"เพิ่มทะเบียน\" class=\"btn btn-primary\">");
	print("</td>");
print("</tr>");
print("</table>");

if($_GET['fix_id'])
{
	query("DELETE FROM fix_car WHERE fix_id ='".$_GET['fix_id']."'");
	print"<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');</script>";
	print("<META HTTP-EQUIV='Refresh' CONTENT = '0;URL=fix_car.php'>");
}
print("</div>"); //ปิด class=\"b\"
print("</form>");
print("</div>");
?>
</body>
</html>