<?php
@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");

	$getdata = getlist("SELECT * FROM insertdata_transport where boonpon_id='".$_GET['id']."'");

	$getOperator = getlist("SELECT * FROM operator WHERE 1");
?>

<?php
	$_POST['datestart'] = date('Y-m-d');
?>

<html>
	<head>
		<title>
			ใบกำกับการขนส่ง
		</title>
	</head>
		<form action = "" name = "insertquarity" method = "POST">
		<center><font color = "#000000" face = "angsana new"><h1><b>ใบกำกับการขนส่ง</b></h1></center></font>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr valign = "bottom">
			<td colspan = "2" align = "left" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>1.ชื่อผู้ได้รับใบอนุญาติประกอบการขนส่ง				
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>&nbsp;&nbsp;&nbsp;&nbsp;1.1 บุคคล/นิติบุคคล
			</td>
			<td align = "left" style = "width:120mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				<?php
					print $getOperator[0]['name_op'];
				?>
			</td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>2.ใบอนุญาติประกอบการขนส่งเลขที่			
			</td>
			<td align = "left" style = "width:120mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				<?php
					print $getOperator[0]['licence'];
				?>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "right" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				
				<b>จังหวัด&nbsp;&nbsp;&nbsp;&nbsp;
				
			</td>
			<td align = "left" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				
				<?php
					print $getOperator[0]['place'];
				?>
				
			</td>
		</tr>
	</table>
				<?php
					$getCar = getlist("SELECT * FROM car_detail JOIN car_head ON car_detail.typecar = car_head.id_hcar WHERE id_car = '".$getdata[0]['idcar']."'");
				?>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr valign = "bottom">
			<td colspan = "2" align = "left" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>3.รถที่ใช้ทำการขนส่ง				
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					    <b>&nbsp;&nbsp;&nbsp;&nbsp;3.1 ประเภทรถ
			</td>
			
			<td align = "left" style = "width:120mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
					<?php
						print $getCar[0]['detailhcar'];
					?>
			</td>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;3.2 เลขทะเบียนรถ
			</td>
			
			<td align = "left" style = "width:120mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
					<?php
						print $getCar[0]['licenceplates'];
					?>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;3.3 เลขทะเบียนรถพ่วง
			</td>
			
			<td align = "left" style = "width:120mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
					<?php
						print $getCar[0]['licenceplate2'];
					?>
			</td>
		</tr>
	</table>
	<?php
		 $getDriver = getlist("SELECT * FROM driver WHERE id_driver = '".$getdata[0]['nameDriver']."'");
	?>
	<table bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td colspan = "2" align = "left" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>4.พนักงานขับรถ			
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;4.1 ชื่อคนขับ
			</td>
			
			<td align = "left" colspan = "5" style = "width:120mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
					<?php
						print $getDriver[0]['namedriver1'];
					?>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;4.2 เลขบัตรประชาชน
			</td>
			<td align = "left" colspan = "5" style = "width:120mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
					<?php
						print $getDriver[0]['personalid'];
					?>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;4.3 ใบอนุญาตเลขที่
			<td align = "center" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
					<?php
						print $getDriver[0]['licence_driver'];
					?>
			</td>
			<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>ชนิด
			<td align = "center" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
					<?php
						print $getDriver[0]['type_driver'];
					?>
			</td>
			<td align = "left" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>สิ้นสุด
			<td align = "center" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
					<?php
						print printShortSlateThaiDate($getDriver[0]['date_last']);
					?>
			</td>
		</tr>	
	</table>
	<br>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr valign = "bottom">
			<td align = "center" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>5. จุดต้นทาง สถานที่
			<td align = "center" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				<?php
					
					print ("สระบุรี"); 
				?>
			</td>
			<td align = "center" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<b>ปลายทาง
			<td align = "center" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				<?php
					$get_data = getlist("SELECT * FROM production_order where boonpon_id='".$_GET['id']."'");
					$get_country = getlist("SELECT * FROM shipping WHERE id_ship='".$get_data[0]['delivery_name']."'");
				print($get_country[0]['country']);
				?>
			</td>
		</tr>
	</table>
	<br>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style ="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td align = "center" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>ลำดับ
			</td>
			
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>รายการ<br>ชนิด/ประเภทสินค้า
			</td>
		
			<td align = "center" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>ปริมาณสินค้า(น้ำหนักสินค้า ก.ก หรือ ปริมาตร ลบ.ม.)
			</td>
			
			<td align = "center" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<b>จุดส่งสินค้า
			</td>
		</tr>
	<?php
		for($i=0;$i<6;$i++){
	?>	
		<tr>
			<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					<?php
						if($i == 0){
							print $i+1;
						}
					?>
			</td>
			
			<td align = "center" style = "width:70mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					<?php
						if($i == 0){
							print "ไม้อัดแปรรูป";
						}
					?>	
			</td>
		
			<td align = "center" style = "width:40mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<?php
							
								print "&nbsp";
							
						?>	
			</td>
		<?php
			if($i == 0){
		?>
			<td rowspan = "6" align = "center" valign = "top" style = "width:60mm;height:48mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						<?php
							//print $get_data[0]['name'];
							$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$get_data[0]['delivery_name']."'");
								print $get_delivery_name[0]['detailship'];//สถานที่จัดส่ง
						?>
			</td>
		<?php
			}
		?>
		</tr>
	<?php
		}
	?>
		<tr>
			<td colspan = "4" align = "center" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				รวมน้ำหนัก
			</td>
		</tr>
	</table>
	<p>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td  style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					1.ออกจากโรงงาน เวลา______________  น.
			</td>
			
			<td colspan = "2" align = "right" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						ลงชื่อ
			<td align = "right" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				&nbsp;
			</td>
			<td colspan = "2" align = "right" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:18px;" >
						ผู้บันทึก
			</td>
		</tr>
		<tr>
			<td  style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					2.ถึงลูกค้า เวลา_____________________ น.
			</td>
			
			<td colspan = "2" align = "right" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:18px;" >
						
			<td align = "right" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				&nbsp;(ธิดารัตน์ เชื้อคำเพ็ง) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			
			
		</tr>
		<tr>
			<td  style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					3.ลูกค้าเริ่มลงสินค้า เวลา______________ น.
			</td>
			<td colspan = "2" align = "right" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						ตำแหน่ง
			</td>
			<td align = "right" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				&nbsp; ผู้ช่วยสำนักงาน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td  style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					4.ลูกค้าลงสินค้าให้เสร็จเวลา___________ น.
			<td colspan = "2" align = "right" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:18px;">
						วันที่
			</td>
			<td align = "right" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				&nbsp; <?php print(printShortSlateThaiDate($get_data[0]['delivery_date'])); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td align = "left" style = "width:180mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				<b>หมายเหตุ : ให้ประจำไว้กับรถสำหรับแสดงเมื่อมีการขอตรวจ
			</td>
		</tr>
	</table>

</html>