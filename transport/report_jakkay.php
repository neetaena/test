<?php
if(empty($_GET['excel'])){
	include("../include/mySqlFunc.php");
}
	
	query("USE transport");
	@ini_set('display_errors', '0');
	$datein = $_GET['datein'];
	$dateout = $_GET['dateout'];
	$namedriver = $_GET['namedriver'];
	
	
?>
<meta http-equiv = "Content-Type" content="text/html; charset = utf-8" />
<html>
	<head>
		<title>
		รายงานการขับรถส่งสินค้า
		</title>
		<style type="text/css">
			.body-style{
				empty-cells: show;
				font-family:angsana new;
				font-size:16px;
				border-bottom:1px groove;
				border-top: 0px;
				border-left: 0px;
			}

			.header-style{
				empty-cells: show;
				font-family:angsana new;
				font-size:20px;
				border-top: 0px;
				border-left: 0px;
			}
			td{
				border-right: 1px groove;
			}

			@media print   
			{   
			#footer {
			    position: fixed;
			    bottom: 0;
			    width: 100%;
			}
			 .excel{ display: none !important; } 
			
			}
		</style>
	</head>
	<?php 
	print("<div class=\"container\">");
				print("<a href=\"excel_report_report_jakkay.php?datein=".$datein."&dateout=".$dateout."&namedriver=".$namedriver."&excel=1\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");

	function head()
	{
		global $datein,$dateout;
	?>
	<form action = "" name = "insertquarity" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:240mm;empty-cells: show;">
		
		<tr align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;">

			<td style="border:none;" colspan="9">
			<?php
			
					print("<b>รายงานการใช้รถจักกายขนส่งสินค้าเพื่อทำการจ่ายค่าขนส่ง<br>");
					print("ระหว่างวันที่ ".printShortSlateThaiDate($datein)." ถึง ".printShortSlateThaiDate($dateout)."<br>");
				
			?>
				
			</td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:240mm;empty-cells: show;border: 1px groove;">
		<tr>
			<td align = "center" rowspan="1" style = "width:15mm;" class='header-style'>
				<b>ลำดับ
			</td>
			<td align = "center" rowspan="1" style = "width:15mm;" class='header-style'>
				<b>วันที่ส่ง
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>ชนิดไม้
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>เลขที่ใบกำกับภาษี
			</td>
			
			
			<td colspan="2" align = "center" rowspan="1" style = "width:40mm;" class='header-style'>
				<b>สถานที่ส่ง
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>คนขับรถ
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>ทะเบียน
			</td>
		
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>หมายเหตุ
			</td>
		</tr>
	<?php
	}


	
		$c = 1;
		$price = 0;
		$getdata = getlist("SELECT * FROM production_order as p JOIN insertdata_transport  as i ON p.boonpon_id = i.boonpon_id WHERE delivery_date between '$datein' AND '$dateout' and typecar=6  GROUP BY p.boonpon_id,delivery_date");

		if(!empty($getdata)){
		head();
		$rayong = 0;
		$chonburi = 0;
		$number_reyong =0;
		$number_chonburi =0;
		$num_row = sizeof($getdata);
		//$num_row = 30;
		$m =1;
		for($i=0;$i<$num_row;$i++){
	?>
		<tr>
			<td align = "center" style = "width:10mm;" class='body-style'">
				<?php
					
						print ($i+1);
					
				?>
			</td>
			<td align = "center"  class='body-style'">
				<?php
					print(printShortSlateThaiDate($getdata[$i]['delivery_date']));
				?>	
			</td>	
			<td  style = "width:10mm;text-align: center;" class='body-style'">
				<?php
					$get_product = getlist("SELECT * FROM type_production WHERE id_production='".$getdata[$i]['product_id']."'");
								print($get_product[0]['alis_name']);
								
				?>
			</td>		
			<td align = "center" style = "width:20mm;" class='body-style'">
				<?php //เลขที่ใบกำกับภาษี
						$get_invoice = getlist("SELECT * FROM  production_order WHERE boonpon_id='".$getdata[$i]['boonpon_id']."' and delivery_date='".$getdata[$i]['delivery_date']."'");

						$invoice = array();
						for ($p=0; $p <sizeof($get_invoice) ; $p++) { 
								if(!in_array($get_invoice[$p]['invoice'],$invoice)){
									$invoice[] = $get_invoice[$p]['invoice'];
								}
							}

						for ($k=0; $k < sizeof($invoice); $k++) { 
							print(strtoupper($invoice[$k]));
							if(!empty($invoice[$k+1])) {
								print("<br>");
							}
						}
				?>	
			</td>	
			
			<td  style = "width:40mm;padding-left: 5px;" class='body-style'">
				<?php
								$get_custoemr = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[$i]['name']."'");

								print($get_custoemr[0]['namecustomer']);
								
				?>
			</td>
			<td  style = "width:10mm;text-align: center;" class='body-style'">
				<?php
							
								$get_ship = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata[$i]['delivery_name']."'");

								print($get_ship[0]['detailship']);

								if($getdata[$i]['delivery_name']==699){//บ้านบึง
									$chonburi += 6500;
									$number_chonburi +=1;

								}else if($getdata[$i]['delivery_name']==645){//ระยอง
									$rayong += 7430;
									$number_reyong +=1;
								}
								
				?>
			</td>

			<td  style = "width:10mm;text-align: center;" class='body-style'">
				<?php
							
								$get_driver = getlist("SELECT * FROM driver WHERE id_driver='".$getdata[$i]['nameDriver']."'");

								print($get_driver[0]['namedriver1']);
						
				?>
			</td>

			<td align = "center" style = "width:20mm;" class='body-style'">
				<?php
				$get_transport = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$getdata[$i]['boonpon_id']."'");
							
				$get_car_detail = getlist("SELECT * FROM car_detail as cd inner join car_head as ch on cd.typecar=ch.id_hcar WHERE id_car='".$get_transport[0]['idcar']."'");

					print($get_car_detail[0]['licenceplates']." ".$get_car_detail[0]['licenceplate2']);
				?>	
			</td>	
			
			
			<td align = "center" style = "width:20mm;" class='body-style'">
				<?php
					
						print($getdata[$i]['note']);
					
				?>	
			</td>	

		</tr>
	<?php
				if($c>40){
					print("</table>");
					print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");
					head();
					$c=1;
				}else{
					$c++;
				}

		}

	}

	print("</table>");
	
	?>
			
	
	
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:240mm;empty-cells: show;margin-top: 10px;border: 1px groove">
		<tr>
			<td align = "left" colspan="4" style = "width:15mm;text-align: center;" class='header-style'>
				<?php
					print("<b>สรุปรวม</b>");
					
				?>
			</td>
			
		</tr>
		<tr>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<b>ปลายทาง</b>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<b>อัตราค่าขนส่ง/เที่ยว</b>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<b>จำนวนเที่ยว</b>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<b>จำนวนเงินรวม</b>
			</td>
		</tr>
		<tr>
			<td align = "left" style = "width:15mm;padding-left: 10px;" class='body-style'>
				<b>บ้านบึง</b>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<?php print(number_format("6500")); ?>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<?php print(number_format($number_chonburi)); ?>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<?php print(number_format($chonburi)); ?>
			</td>
		</tr>
		<tr>
			<td align = "left" style = "width:15mm;padding-left: 10px;" class='body-style'>
				<b>ระยอง</b>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<?php print(number_format("7430")); ?>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<?php print(number_format($number_reyong)); ?>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<?php print(number_format($rayong)); ?>
			</td>
		</tr>
		<tr>
			<td align = "left" colspan="3" style = "width:15mm;text-align: center;" class='body-style'>
				<?php
					print("<b>รวม</b>");
					
				?>
			</td>
			<td align = "left" style = "width:15mm;text-align: center;" class='body-style'>
				<?php print(number_format($chonburi+$rayong)); ?>
			</td>
		</tr>
		

					<?php
						//print(" <b>สรุปรวม ".($number_chonburi+$number_reyong)." เที่ยว เป็นจำนวนเงิน ".number_format($chonburi+$rayong)." บาท</b>");
					?>
		
	</table>

	<?php
		if($num_row>40){
			$cll_id  = "";
		}else{
			$cll_id  = "id=\"footer\"";
		}
	?>
	<table  <?php print($cll_id); ?> bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:240mm;empty-cells: show;margin-top: 10px;border: 1px groove;">
		<tr>
			<td align = "center"  style = "width:15mm;" class='header-style' colspan="2">
				<b>คลังสินค้า</b><br>
				........................<br>
				......./......../.......
			</td>
			<td align = "center"  style = "width:15mm;" class='header-style' colspan="2">
				<b>หัวหน้าส่วน</b><br>
				........................<br>
				......./......../.......
			</td>
			<td align = "center"  style = "width:15mm;" class='header-style'>
				<b>ผู้จัดการฝ่าย</b><br>
				........................<br>
				......./......../.......
			</td>
			<td align = "center"  style = "width:15mm;" class='header-style' colspan="2">
				<b>ผช.กจก</b><br>
				........................<br>
				......./......../.......
			</td>
			<td align = "center"  style = "width:15mm;" class='header-style' colspan="2">
				<b>บัญชี</b><br>
				........................<br>
				......./......../.......
			</td>
			
		</tr>
	</table>
		
