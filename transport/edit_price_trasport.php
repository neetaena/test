<html>
<head>
	<title>แก้ไขข้อมูลค่าขนส่ง</title>
	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
	 <style type="text/css">
	 	.font-style{
	 		width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;
	 	}
	 </style>
	<script type="text/javascript">
			function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
						ele.onKeyPress=vchar;
						}	
	</script>
</head>

<body style="background-color: #d1d4d8;">
<?php 
include("../include/mySqlFunc.php");
query("USE transport");
$id_ship =$_GET['id_ship'];
$query_shipping = getlist("SELECT * FROM shipping where id_ship='$id_ship'");
	if(!empty($_POST['summit'])){

		$price = $_POST['price'];
		$a = query("UPDATE shipping SET price_of_transport='$price' where id_ship='$id_ship'");
		if(!empty($a)){
			$message = "แก้ไขข้อมูลเรียบร้อย";
		}else{
			$message = "ล้มเหลว ไม่สามารถบันทึกข้อมูลได้";
		}
			
		print "<script type='text/javascript'>alert('$message');</script>";
		print "<script>window.opener.location.reload();</script>";
	    print "<script>window.close();</script>";
	}
//print shrink2fitCell($query_driver[0]['namedriver1'],32,18);
 ?>
<form action="" method="POST" name = "edit_car" >
<div class="container">
<div style="text-align:center;font-family:angsana new;font-size:30px; margin-top:20px; margin-bottom:20px;"><b>เพิ่ม/แก้ไข ข้อมูลราคาค่าขนส่ง</b></div>
    <table class="center" align="center">
    <?php
		print("<tr style='text-align:center;'>");
		print("<td colspan = \"2\"  class='font-style' >");
        	   print("<t style='font-size:20px;'>ชื่อสถานที่</t> <b>".$query_shipping[0]['detailship']."</b> <t style='font-size:20px;'>ระยะทาง</t> <b>".number_format($query_shipping[0]['distanct'])."</b> Km.</b>");
        print(" </td>");
		print("</tr>");

		print("<tr>");
			print("<td style=\"font-family:angsana new;font-size:25px;\"> อัตราค่าขนส่ง </td>");
			print("<td>");
				$_POST['price'] =  empty($_POST['price']) ? $query_shipping[0]['price_of_transport'] : $_POST['price'];
            	print("<input name = \"price\" type = \"text\" value = \"".$_POST['price']."\" class=\"font-style\" style='width:50mm;' OnKeyPress=\"return chkNumber(this)\" required> บาท" );
        	print(" </td>");
		print("</tr>");
		print("<tr>");
			print("<td colspan='2'>");
				print("..");
			print("</td>");
		print("</tr>");
	?>
		<tr>
			<td colspan = "10" align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ยืนยันการแก้ไข" style = "width:40mm;empty-cells:show;font-family:angsana new;font-size:25px;">	
			</td>
		</tr>
    </table>
	
</form>
</body>
</html>