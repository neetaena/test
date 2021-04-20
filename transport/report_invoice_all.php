<?php
	include("../include/mySqlFunc.php");
	query("USE transport");

	
?>
<html>
	<head>
		<title>
			ใบกำกับการขนส่ง
		</title>
		<style type="text/css">
			.font-style{
				empty-cells: show;
				font-family:angsana new;
				font-size:18px;
			}
		</style>

		<?php
			$_POST['datestart'] = date('Y-m-d');
		?>

	</head>
		<form action = "" name = "insertquarity" method = "POST">
			<?php
				$get_boonpon_id = getlist("SELECT * FROM production_order  WHERE delivery_date = '".$_GET['delivery_date']."' and boonpon_id !='' group by boonpon_id");
				
			for ($g=0; $g < sizeof($get_boonpon_id); $g++) { 
		
			$getdata = getlist("SELECT * FROM insertdata_transport where boonpon_id='".$get_boonpon_id[$g]['boonpon_id']."'");
			$getOperator = getlist("SELECT * FROM operator WHERE 1");
			?>
		<center><font color = "#000000" face = "angsana new"><h1><b>ใบกำกับการขนส่ง</b></h1></center></font>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr valign = "bottom">
			<td colspan = "2" align = "left" style = "width:140mm;" class='font-style'>
				<b>1.ชื่อผู้ได้รับใบอนุญาติประกอบการขนส่ง				
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;" class='font-style'>
				<b>&nbsp;&nbsp;&nbsp;&nbsp;1.1 บุคคล/นิติบุคคล
			</td>
			<td align = "left" style = "width:120mm;border-bottom:1px solid;" class='font-style'>
				<?php
					print $getOperator[0]['name_op'];
				?>
			</td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;" class='font-style'>
				<b>2.ใบอนุญาติประกอบการขนส่งเลขที่			
			</td>
			<td align = "left" style = "width:120mm;border-bottom:1px solid;" class='font-style'>
				<?php
					print $getOperator[0]['licence'];
				?>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "right" style = "width:60mm;" class='font-style'>
				
				<b>จังหวัด&nbsp;&nbsp;&nbsp;&nbsp;
				
			</td>
			<td align = "left" style = "width:80mm;border-bottom:1px solid;" class='font-style'>
				
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
			<td colspan = "2" align = "left" style = "width:140mm;" class='font-style'>
				<b>3.รถที่ใช้ทำการขนส่ง				
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;" class='font-style'>
					    <b>&nbsp;&nbsp;&nbsp;&nbsp;3.1 ประเภทรถ
			</td>
			
			<td align = "left" style = "width:120mm;border-bottom:1px solid;" class='font-style'>
					<?php
						print $getCar[0]['detailhcar'];
					?>
			</td>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;" class='font-style'>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;3.2 เลขทะเบียนรถ
			</td>
			
			<td align = "left" style = "width:120mm;border-bottom:1px solid;" class='font-style'>
					<?php
						print $getCar[0]['licenceplates'];
					?>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;" class='font-style'>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;3.3 เลขทะเบียนรถพ่วง
			</td>
			
			<td align = "left" style = "width:120mm;border-bottom:1px solid;" class='font-style'>
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
			<td colspan = "2" align = "left" style = "width:140mm;" class='font-style'>
				<b>4.พนักงานขับรถ			
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;" class='font-style'>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;4.1 ชื่อคนขับ
			</td>
			
			<td align = "left" colspan = "5" style = "width:120mm;border-bottom:1px solid;" class='font-style'>
					<?php
						print $getDriver[0]['namedriver1'];
					?>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:60mm;" class='font-style'>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;4.2 เลขบัตรประชาชน
			</td>
			<td align = "left" colspan = "5" style = "width:120mm;border-bottom:1px solid;" class='font-style'>
					<?php
					if (!empty($getDriver[0]['personalid'])) {
						print $getDriver[0]['personalid'];
					}
						
					?>
			</td>
		</tr>
		<tr valign = "bottom">
			<td align = "left" style = "width:20mm;" class='font-style'>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;4.3 ใบอนุญาตเลขที่
			<td align = "center" style = "width:40mm;border-bottom:1px solid;" class='font-style'>
					<?php
						print $getDriver[0]['licence_driver'];
					?>
			</td>
			<td align = "center" style = "width:20mm;" class='font-style'>
				<b>ชนิด
			<td align = "center" style = "width:40mm;border-bottom:1px solid;" class='font-style'>
					<?php
						print $getDriver[0]['type_driver'];
					?>
			</td>
			<td align = "left" style = "width:20mm;" class='font-style'>
				<b>สิ้นสุด
			<td align = "center" style = "width:40mm;border-bottom:1px solid;" class='font-style'>
					<?php
						if(!empty($getDriver[0]['date_last']) & $getDriver[0]['date_last']!="0000-00-00"){
							print printShortSlateThaiDate($getDriver[0]['date_last']);	
						}
						
					?>
			</td>
		</tr>	
	</table>
	<br>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr valign = "bottom">
			<td align = "center" style = "width:50mm;" class='font-style'>
				<b>5. จุดต้นทาง สถานที่
			<td align = "center" style = "width:80mm;border-bottom:1px solid;" class='font-style'>
				<?php
					
					print ("สระบุรี"); 
				?>
			</td>
			<td align = "center" style = "width:50mm;" class='font-style'>
				<b>ปลายทาง
			<td align = "center" style = "width:80mm;border-bottom:1px solid;" class='font-style'>
				<?php
					$get_country = getlist("SELECT * FROM shipping WHERE id_ship='".$get_boonpon_id[$g]['delivery_name']."'");
				print($get_country[0]['country']);
				?>
			</td>
		</tr>
	</table>
	<br>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style ="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td align = "center" style = "width:10mm;" class='font-style'>
						<b>ลำดับ
			</td>
			
			<td align = "center" style = "width:70mm;" class='font-style'>
						<b>รายการ<br>ชนิด/ประเภทสินค้า
			</td>
		
			<td align = "center" style = "width:40mm;" class='font-style'>
						<b>ปริมาณสินค้า(น้ำหนักสินค้า ก.ก หรือ ปริมาตร ลบ.ม.)
			</td>
			
			<td align = "center" style = "width:60mm;" class='font-style'>
						<b>จุดส่งสินค้า
			</td>
		</tr>
	<?php
		for($i=0;$i<6;$i++){
	?>	
		<tr>
			<td align = "center" style = "width:10mm;height:8mm;" class='font-style'>
					<?php
						if($i == 0){
							print $i+1;
						}
					?>
			</td>
			
			<td align = "center" style = "width:70mm;height:8mm;" class='font-style'>
					<?php
						if($i == 0){
							print "ไม้อัดแปรรูป";
						}
					?>	
			</td>
		
			<td align = "center" style = "width:40mm;height:8mm;" class='font-style'>
						<?php
							
								print "&nbsp";
							
						?>	
			</td>
		<?php
			if($i == 0){
		?>
			<td rowspan = "6" align = "center" valign = "top" style = "width:60mm;height:48mm;" class='font-style'>
						<?php
						//$get_data = getlist("SELECT * FROM production_order where boonpon_id='".$_GET['id']."'");
							//print $get_data[0]['name'];
							$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$get_boonpon_id[$g]['delivery_name']."'");
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
			<td colspan = "4" align = "center" style = "width:140mm;" class='font-style'>
				รวมน้ำหนัก
			</td>
		</tr>
	</table>
	<p>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td  style = "width:60mm;" class='font-style'>
						1.ออกจากโรงงาน เวลา ______________  น.
			</td>
			
			<td colspan = "2" align = "right" style = "width:30mm;" class='font-style'>
						ลงชื่อ
			<td align = "right" style = "width:80mm;border-bottom:1px solid;" class='font-style'>
				&nbsp;
			</td>
			<td colspan = "2" align = "right" style = "width:30mm;" class='font-style' >
						ผู้บันทึก
			</td>
		</tr>
		<tr>
			<td  style = "width:60mm;" class='font-style'>
						2.ถึงลูกค้า เวลา_____________________ น.
			</td>
			
			<td colspan = "2" align = "right" style = "width:30mm;" class='font-style' >
						
			<td align = "right" style = "width:80mm;border-bottom:1px solid;" class='font-style'>
				&nbsp; (ธิดารัตน์ เชื้อคำเพ็ง) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			
			
		</tr>
		<tr>
			<td style = "width:30mm;" class='font-style'>
					3.ลูกค้าเริ่มลงสินค้า เวลา______________ น.	
			</td>
			<td colspan = "2" align = "right" style = "width:50mm;" class='font-style'>
						ตำแหน่ง
			</td>
			<td align = "right" style = "width:80mm;border-bottom:1px solid;" class='font-style'>
				&nbsp; ผู้ช่วยสำนักงาน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td  style = "width:30mm;" class='font-style'>
						4.ลูกค้าลงสินค้าให้เสร็จเวลา___________ น.
			</td>
			<td colspan = "2" align = "right" style = "width:50mm;" class='font-style'>
						วันที่
			</td>
			<td align = "right" style = "width:80mm;border-bottom:1px solid;" class='font-style'>
				&nbsp; <?php print(printShortSlateThaiDate($get_boonpon_id[0]['delivery_date'])); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td align = "left" style = "width:180mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				<b>หมายเหตุ : ให้ประจำไว้กับรถสำหรับแสดงเมื่อมีการขอตรวจ
					<?php
						print("# ".$get_boonpon_id[$g]['boonpon_id'])
					?>
			</td>
		</tr>
	</table>
<?php

	if(!empty($get_boonpon_id[$g+1]['boonpon_id'])){
		print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");
	}
}

?>
</html>