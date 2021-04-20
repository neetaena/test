<?php
@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	$send_data = $_GET['shipping'];
	$type_car = $_GET['typecar'];
	query("USE transport");
	if(!empty($_POST['summit'])){
		$getALL = getlist("SELECT * FROM allowance WHERE placestart = '1' AND p_end = '$send_data' AND typecar = '$type_car'");
		if(empty($getALL)){
			$a = query("INSERT INTO allowance SET placestart = '1'
					,p_end = '$send_data'
					,typecar = '$type_car'
					,dis_1= '".$_POST['distance']."'
					,dis_2 = '".$_POST ['distance2']."'") ;
			if($a){
				$message =  "เรียบร้อย";
				print "<script>window.opener.location.reload();</script>";
				print "<script>window.close();</script>";
			}else{
				$message =  "ไม่สามารถเพิ่มข้อมูลได้";
			}
		}else{
			$message =  "ไม่สามารถเพิ่มข้อมูลได้";
		}
		print "<script type='text/javascript'>alert('$message');</script>";
	}
?>
<script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>

<center><font color="#000000" face="angsana new"><h1><b>ลงข้อมูลค่าเบี้ยเลี้ยง</b></h1></center></font>
<form action = "" name = "insertplace" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;empty-cells: show;">
				<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<b> สถานที่จัดส่ง</b>
			</td>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<?php
					$placeCus = getlist("SELECT * FROM shipping WHERE id_ship = '$send_data'");
				print ("<input type = \"text\" name = \"place_id\"  id = \"place_id\" value = \"".$placeCus[0]['detailship']."\"  style = \"width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;\" readonly>");

				?>
				
	        </td>
		</tr>

		<tr>
			<td align = "center" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>ประเภทรถ</b>
			</td>
			<td align = "center" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;">

			<?php
					$typeC = getlist("SELECT * FROM car_head WHERE id_hcar = '".$type_car."'");
				print ("<input type = \"text\" name = \"typecar\"  id = \"place_id\" value = \"".$typeC[0]['detailhcar']."\"  style = \"width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;\" readonly>");

				?>
				
			</td>
		</tr>
		<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>ค่าเบี้ยเลี้ยงเที่ยววิ่ง1</b>
			</td>
			<td>
				<input type="text" name="distance" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;" required>
			</td>
		</tr>
		<tr>
		<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>ค่าเบี้ยเลี้ยงเที่ยววิ่ง2</b>
			</td>
			<td>
				<input type="text" name="distance2" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;" required>
			</td>
		</tr>
		<tr>
		<td colspan = "2" align = "center" style = "width:200mm;empty-cells: show;font-family:angsana new;font-size:24px;"><br>
				<input type="submit" name="summit" value ="ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:20px;">
		     </td>
	    </tr>
</form>