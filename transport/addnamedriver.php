<?php
	@session_start();
	@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");
	if(!empty($_POST['summit'])){

		$check_double = getlist("SELECT * FROM driver where namedriver1	= '".$_POST['namedriver1']."'");
		if(sizeof($check_double)==0){
			$ty_user = $_SESSION["permission"]==2 ? "2":"1";
			 $a = query("INSERT INTO driver SET namedriver1	= '".$_POST['namedriver1']."'
						,licence_driver = '".$_POST['licence_driver']."'
						,type_driver =  '".$_POST['type_driver']."'
						,date_last =  '".$_POST['date_last']."'
						,personalid =  '".$_POST['personalid']."'
						,status = '1',type_user='$ty_user'");
			if($a){
				$message =  "เพิ่มข้อมูลสำเร็จ";
				print "<script>window.opener.location.reload();</script>";
				unset($_POST);
				
			}else{
				$message =  "ไม่สามารถเพิ่มข้อมูลได้";
			}
		}else{

			$message =  "ข้อมูลนี้มีในระบบแล้ว";
		
		}
		print "<script type='text/javascript'>alert('$message');</script>";
	}
?>
<html>
	<body bgcolor= "FFFFFF">
		<center><font color="#000000" face="angsana new"><h1><b>ลงข้อมูล(ชื่อคนขับรถ)</b></h1></center></font>
			<form action = "" name = "insertquarity" method = "POST">
				<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;height:10mm;empty-cells: show;">
					<tr>
						<td align = "right" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
							
							<b>ชื่อ-นามสกุลคนขับ</b>
						
						</td>
						<td align = "left" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
					
							<input type = "text" name = "namedriver1" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" required>
						
						</td>
						
					</tr>
					
					<tr>
				<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;height:10mm;empty-cells: show;">
					<tr>
						<td align = "right" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
							
							<b>เลขที่ใบอนุญาติ</b>
						
						</td>
						<td align = "left" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
					
							<input type = "text" name = "licence_driver" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">
						
						</td>
						
					</tr>
					
					<tr>
				<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;height:10mm;empty-cells: show;">
					<tr>
						<td align = "right" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
							
							<b>ชนิด</b>
						
						</td>
						<td align = "left" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
					
							<input type = "text" name = "type_driver" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">
						
						</td>
						
					</tr>
					
					<tr>
					<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;height:10mm;empty-cells: show;">
					<tr>
						<td align = "right" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
							
							<b>วันที่สิ้นสุด</b>
						
						</td>
						<td align = "left" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
					
							<input type = "text" name = "date_last" id = "date_last" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">
							<script type="text/javascript">
								jQuery('#date_last').datetimepicker({
								timepicker:false,
								format:'Y-m-d'
								});
							</script>
						</td>
						
					</tr>
					
					<tr>
				<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;height:10mm;empty-cells: show;">
					<tr>
						<td align = "right" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
							
							<b>เลขประจำตัวประชาชน</b>
						
						</td>
						<td align = "left" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
					
							<input type = "text" name = "personalid" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">
						
						</td>
						
					</tr>
					
					<tr>
					
						<td colspan = "2" align = "center" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:22px;"><br>
							<input type = "submit" name = "summit" value = "ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					
						</td>
					</tr>
			</FORM>
				</table>
				

	</body>			
</html>