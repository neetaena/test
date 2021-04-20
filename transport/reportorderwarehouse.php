<?php
	//@ini_set('display_errors', '0');
?>

<html>
	<body bgcolor= "FFFFFF">
	<center><font color="#000000" face="angsana new"><h1><b>ลงข้อมูล(การขนส่ง)</b></h1></center></font>
	<form action = "" name = "insertquarity" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td align = "center" style = "width:60mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>วันที่ส่งของ</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<input type = "text" name = "datestart" id = "datestart" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<script type="text/javascript">
					 jQuery('#datestart').datetimepicker({
					 timepicker:false,
					 format:'Y-m-d'
					 });
				</script>
			</td>
			<td colspan = "2" align = "left" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ยืนยัน" style = "width:20mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;">
					
			</td>
		</tr>
	</table>
	</form>
	<?php
		if(!empty($_POST['datestart'])){
	?>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "1" cellpadding = "2" align = "center" valign = "middle" style="width:290mm;height:10mm;empty-cells: show;">
		<tr align = "center">
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				ลำดับ
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				เลขที่ใบสั่งขาย
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				ชื่อลูกค้า
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				วันที่ส่ง/เวลา
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				รายการสินค้าที่ส่ง
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				จำนวนแผ่น
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				จำนวนตั้ง
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				สถานที่จัดส่ง
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				ระยะทางขนส่ง
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				ชื่อคนขับ
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				ทะเบียนรถ
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				ประเภทรถ
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;"><b>
				สถานะ
			</td>
		</tr>
		<?php
			$getdata = getlist("SELECT * FROM insertdatawarehouse where datetimeout = '".$_POST['datestart']."'");
			for($i=0;$i<sizeof($getdata);$i++){
				$get_transaction = getlist("select * from insertdata_transport where id_warehouse = '".$getdata[$i]['IDwarehouse']."'");
		?>
			<tr align = "center">
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					print $i+1;
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					print $getdata[$i]['invoicedsales']."&nbsp";
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					$getcus = getlist("select * from insertdatawarehouse JOIN customer ON insertdatawarehouse.customers = customer.id_customer where insertdatawarehouse.customers = '".$getdata[$i]['customers']."'");
					print $getcus[$i]['namecustomer'];
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					print $getdata[$i]['datetimeout']." : ".$getdata[$i]['Posttime'];
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					$getOrder = getlist("select * from productionorder where id_warehouse = '".$getdata[$i]['IDwarehouse']."'");
					for($j=0;$j<sizeof($getOrder);$j++){
						print $getOrder[$j]['detail_order']."<br>";
					}
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					for($j=0;$j<sizeof($getOrder);$j++){
						print $getOrder[$j]['plate']."<br>";
					}
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					for($j=0;$j<sizeof($getOrder);$j++){
						print $getOrder[$j]['numset']."<br>";
					}
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					$getplace = getlist("select * from insertdatawarehouse JOIN shipping JOIN distance ON insertdatawarehouse.Sendlocation = shipping.id_ship and distance.shipping_cus = shipping.id_ship where insertdatawarehouse.Sendlocation = '".$getdata[$i]['Sendlocation']."'");
					print $getplace[0]['detailship'];
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					print $getplace[0]['distance'];
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					//คนขับ
					if(!empty($get_transaction[0]['nameDriver'])){
						$getdriver = getlist("select * from driver where id_driver = '".$get_transaction[0]['nameDriver']."'");
						print $getdriver[0]['namedriver1'];
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					if(!empty($get_transaction[0]['idcar'])){
						$getcar = getlist("select * from car where id_car = '".$get_transaction[0]['idcar']."'");
						print $getcar[0]['licenceplates'];
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					if(!empty($get_transaction[0]['idcar'])){
						$getcar = getlist("select * from car where id_car = '".$get_transaction[0]['idcar']."'");
						print $getcar[0]['typecar'];
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td style = "width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				<?php
					if(!empty($get_transaction[0]['id_warehouse'])){
						
						print "<img src = \"image/true.png\" width=\"15mm;\" height=\"15mm;\">"."&nbsp";
						print "<img src = \"image/print.jpg\" width=\"15mm;\" height=\"15mm;\" onclick = \"window.open('reporttransportorder.php?id=".$getdata[$i]['IDwarehouse']."')\">";
						
					}else{
						
						print "<img src = \"image/false.png\" width=\"15mm;\" height=\"15mm;\" onclick = \"window.open('insertdata_transport2.php?id=".$getdata[$i]['IDwarehouse']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=700,height=280,top=220,left=450 ')\">";
						
					}
				?>
			</td>
		</tr>
		<?php		
			}
		?>
	</table>
	<?php
		}else{
			print "ไม่มีรายการส่งสินค้าในวันนี้";
		}	
	?>		

</html>