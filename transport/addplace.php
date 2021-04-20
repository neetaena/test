<?php
@session_start();
	@ini_set('display_errors', '0');
include("../include/mySqlFunc.php");
	if(!empty($_POST['summit'])){
		
		query("USE transport");
			if(!empty($_POST['place_id']))
			{
				$place_id = $_POST['place_id'];
				$distance =$_POST['distance'];
	
				$grade = $_POST['grade'];
				$country =$_POST['country'];
				$district = $_POST['district'];
				$insert = query("INSERT INTO shipping SET detailship='$place_id',grade='$grade',distanct='$distance',statusship='1',country='$country',district='$district'");
				if ($insert) {
						$message =  "เพิ่มข้อมูลสำเร็จ";
						print("<meta http-equiv='refresh' content='0; url= addplace.php'>");
						
	
					}else{
						$message = "ไม่เรียบร้อย";
					}


			}else
			{
				$message = "ไม่เรียบร้อย กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
			}
			print "<script type='text/javascript'>alert('$message');</script>";
			print "<script>window.opener.location.reload();</script>";
	}
?>
<script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>
<center><font color="#000000" face="angsana new"><h1><b>สถานที่จัดส่ง</b></h1></center></font>
<form action = "" name = "insertplace" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;empty-cells: show;">
		

		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<b> สถานที่จัดส่ง</b>
			</td>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<input type = "text" name = "place_id"   value = "<?php print $_POST['place_id'];?>"  style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;"  required>
				<!--<input type = "hidden" name = "Sendlocation"  id = "Sendlocation" value = "<?php print $_POST['Sendlocation'];?>">-->
	        </td>
		</tr>
		



		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>อำเภอ</b>
			</td>
			<td>
				<input type="text" name="district" style="width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;" required>
			</td>
		</tr>

		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>จังหวัด</b>
			</td>
			<td>
				<input type="text" name="country" style="width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;" required>
			</td>
		</tr>
		

		
		<tr>
			<td colspan = "2" align = "center" style = "width:200mm;empty-cells: show;font-family:angsana new;font-size:24px;"><br>
				<input type="submit" name="summit" value ="ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:20px;">
		     </td>
	    </tr>
	    <tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;" colspan="2">			  
				<b style="color: red">** ถ้าหากจังหวัดเป็น กรุงเทพ ให้ใช้คำว่า </b><b style="font-size: 28px">กรุงเทพฯ</b><br>
				<b style="color: red">** ถ้าหากจังหวัดเป็น โคราช ให้ใช้คำว่า </b><b style="font-size: 28px"> นครราชสีมา</b><br>
				<b style="color: red">** หากไม่รู้ หรือ ไม่มี อำเภอ ให้ใช้ </b><b style="font-size: 28px"> - (ขีดกลาง)</b>
			</td>
		
		</tr>
</form>
