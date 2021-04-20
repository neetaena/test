<?php
	@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	include 'function.php';
	query("USE transport");
	$date_send = $_GET['date_send'];
	$getdata = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production  WHERE boonpon_id = '".$_GET['id']."' and delivery_date='$date_send'");

	//print_r($getdata);
?>
<meta http-equiv="Content-Type" content="text/html; charset = utf-8" />
<html >
<style type="text/css">
	.header_report
	{
		empty-cells: show;font-family:angsana new;font-size:14px;
	}
</style>
<body bgcolor= "FFFFFF">
<?php  function head(){  
global $getdata;
	?>

	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;empty-cells: show;padding-top: 10px;">
		<tr>
			<td align = "center" colspan = "4" style = "width:180mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>
					บริษัท วนชัย กรุ๊ป จำกัด (มหาชน) - สระบุรี
				</b>
			</td>
		<tr>
		</tr>
			<td colspan = "1" align = "right" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				&nbsp;
			</td>
			<td align = "center" colspan = "1" style = "width:100mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>
					ใบสั่งขนส่งสินค้า
				</b>
			</td>
			<td align = "right" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				เลขที่
			</td>
			<td colspan = "1" align = "right" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;border-bottom:1px solid;">
				<?php print $getdata[0]['boonpon_id']." ".mb_strtoupper($getdata[0]['warehouse_id'], "UTF-8");?>
			</td>
		</tr>
		<tr>
			<td align = "right" colspan = "3" style = "width:150mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				วันที่
			</td>
			<td colspan = "1" align = "center" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					global $getdata;
					print printShortThaiDate($getdata[0]['delivery_date']);
				?>
			</td>
		</tr>
	</table>
	<form action = "" name = "insertquarity" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "bottom" style="margin-top:2px; width:180mm;empty-cells: show;border-bottom:1px solid;border-top:1px solid;border-left:1px solid;border-right:1px solid;">
		<tr>
			<td align = "left" style = "width:25mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				&nbsp;&nbsp;เรียน
			</td>
			<td colspan = "2" align = "center" style = "width:85mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				บริษัท บุญพรขนส่ง จำกัด			
			</td>
			<td align = "right"  valign = "bottom" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				ต้นทาง
			</td>
			<td align = "center" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
				$get_transaction = getlist("select * from insertdata_order where number = '".$_GET['id']."'");
					print "สระบุรี"; 
				?>
			</td>
		</tr>
		<tr>
			<td colspan = "2" align = "left" style = "width:25mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				&nbsp;&nbsp;โปรดส่งสินค้าตามใบส่งของเลขที่
			</td>
			<th align = "center" style = "width:85mm;empty-cells: show;font-family:angsana new;font-size:18px;border-bottom:1px solid;">
				<?php

					$product = array();

					for ($p=0; $p <sizeof($getdata) ; $p++) { 
						if(!in_array($getdata[$p]['product_id'],$product)){
							$product[] = $getdata[$p]['product_id'];
						}
					}
					$tax = array();
						for($i=0;$i<sizeof($getdata);$i++){
							if(!in_array($getdata[$i]['invoice'],$tax)){
								$tax[] = $getdata[$i]['invoice'];
							}
						}

					//print_r($tax);
			
						sort($tax);
						$cut_invoice = array();
						for($s=0;$s<sizeof($tax);$s++){
							$cut =substr($tax[$s], 0,8);
							if(!in_array($cut,$cut_invoice)){
							$cut_invoice[] = $cut;
							}
						}

						for ($l=0; $l < sizeof($cut_invoice); $l++) 
						{ 
							$m = 1;
							$u = 0;
							for($i=0;$i<sizeof($tax);$i++)
							{
								$data3 = strpos($tax[$i],$cut_invoice[$l]);
									if($data3 !== FALSE)
									{
										if($m==1)
										{
											print strtoupper($tax[$i]);
											$m=2;
										}else{
											print substr($tax[$i], 8,8);

										}
										
										if(!empty($tax[$i+1])){
											print ",";
										}
										$u += 1;
										//print($u);
										if($u>=9){
												print("<br>");
												$u = 0;
										}
									}

									
								
							}

						}

						
					
					
				?>
			</th>
			<td align = "right" valign = "bottom" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				ปลายทาง
			</td>
			<td align = "center" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
				$get_country = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata[0]['delivery_name']."'");
				print($get_country[0]['country']);

				?>
			</td>
		</tr>
		<tr>
			<td align = "left" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				&nbsp;&nbsp;ให้แก่ผู้รับ
			</td>
			<td colspan = "2" align = "center" style = "width:100mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata[0]['delivery_name']."'");
					$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[0]['name']."'");


					print  $get_customer_name[0]['namecustomer']." <b>ส่งที่</b> ".$get_delivery_name[0]['detailship'];//สถานที่จัดส่ง
					//print($getdata[0]['delivery_name']);
				?>
			</td>
			<td align = "center" colspan = "2" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				&nbsp;
			</td>
		</tr>
		<tr>
			
			<td colspan = "3" align = "left" style = "width:100mm;empty-cells: show;font-family:angsana new;font-size:16px;padding-left: 5px;/*border-bottom:1px solid;*/">
				<?php
					print("จำนวนเอกสารที่ต้องนำกลับโรงงาน ".sizeof($tax)." ชุด");
					//print $getdata[0]['note'];//สถานที่จัดส่ง
					//print($getdata[0]['delivery_name']);
				?>
			</td>
			<td align = "center" colspan = "2" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				&nbsp;
			</td>
		</tr>
	</table>   

	<table   border color ="#000000" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "bottom" style =  "width:180mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;border-top:1px solid;border-left:1px solid;border-right:1px solid;">
		 <tr>
	        <td align = "center" style = "width:70mm;heigh40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;solid;">
				<b>รายละเอียดสินค้า
			</td>
			   <td align = "center" style = "width:20mm;height40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;solid;border-left:1px solid;">
				<b>จำนวนแผ่น
			</td>
			<td align = "center" style = "width:70mm;heigh40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;solid;border-left:1px solid;">
				<b>รายละเอียดสินค้า
			</td>
			   <td align = "center" style = "width:20mm;height40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;solid;border-left:1px solid;">
				<b>จำนวนแผ่น
			</td>
		</tr>
		<?php } ?>

	<?php 
	function footer_trans($page){
			global $getdata;
			$get_transaction = getlist("SELECT * from insertdata_transport where boonpon_id = '".$getdata[0]['boonpon_id']."'");
		?>

	<table   border = "1" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;empty-cells: show;font-family:angsana new;font-size:18px">
		<tr>
			<td align = "center" style="width:20mm;" 	class="header_report">
				จัดส่งโดย
			</td>
	            <td align = "center" style="width:20mm;" class="header_report">
				ทะเบียนรถ
			</td>
			    <td align = "center" style="width:20mm;" class="header_report">
				ประเภทรถ
			</td>
			    <td align = "center" style="width:20mm;" class="header_report">
				ผู้ขับรถ
			</td>
			    <td align = "center" style="width:20mm;" class="header_report">
				ผู้จ่ายสินค้า
		</tr>
		<?php
			 $getCar = getlist("SELECT * FROM car_detail inner JOIN car_head ON car_detail.typecar = car_head.id_hcar WHERE id_car = '".$get_transaction[0]['idcar']."'");
			 $getDriver = getlist("SELECT * FROM driver WHERE id_driver = '".$get_transaction[0]['nameDriver']."'");
		?>
		<tr>     
			<td align = "center" style = "width:20mm;height:7mm;empty-cells: show;font-family:angsana new;font-size:16px;">
			        <?php
						print $get_transaction[0]['runperday'];
					?>
			</td>
			<td align = "center" style = "width:20mm;height:7mm;empty-cells: show;font-family:angsana new;font-size:16px;">
			        <?php
						print $getCar[0]['licenceplates']."   ".$getCar[0]['licenceplate2'];
					?>
			</td>
			<td align = "center" style = "width:24mm;height:7mm;empty-cells: show;font-family:angsana new;font-size:16px;">
					<?php
						print $getCar[0]['detailhcar'];
					?>
			</td>
			<td align = "center" style = "width:20mm;height:7mm;empty-cells: show;font-family:angsana new;font-size:16px;">
			        <?php
						print $getDriver[0]['namedriver1'];
					?>
			</td>
			<td align = "center" style = "width:20mm;height:7mm;empty-cells: show;font-family:angsana new;font-size:16px;">
			        &nbsp;
			</td>
			    </tr>
	        </table>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;empty-cells: show;font-family:angsana new;font-size:13px">
		<tr>
			<td>
				ได้ตรวจรับสินค้ารายการข้างต้นในสภาพเรียบร้อยและถูกต้องแล้ว
			<td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;empty-cells: show;">

		<tr>
			<td align = "left" style = "width:40mm;" class="header_report">
				_______________________________
			</td>
			<td  align = "center" style = "width:70mm;" class="header_report">
				_______________________________
			</td>
			<td align = "left" rowspan="3" style = "width:40mm;" class="header_report">
				* พนักงานขับรถต้องตรวจสอบเอกสารที่ต้องนำกลับโรงงานและต้องมีลายมือชื่อลูกค้าที่รับสินค้าให้ครบถ้วนทุกครั้ง
			</td>
		</tr>

		<tr>
			<td align = "center" style = "width:40mm;" class="header_report">
				ผู้รับส่งสินค้า
			</td>
			<td  align = "center" style = "width:70mm;" class="header_report">
				ผู้รับใบสั่งขนส่งสินค้า
			</td>
		
		</tr>

		<tr>
			<td align = "center" style = "width:40mm;" class="header_report">
				วันที่......./......./.........
			</td>
			<td  align = "left" style = "width:70mm;" class="header_report">
				<?php
					if(sizeof($getdata) >16)
					{
						print("หน้า &nbsp".$page."/2");
					}
				?>
			</td>
			
		</tr>
		</table>
	<?php } 

	?>
	
	
	<!---------------------------------------  ส่วนการเรียกรายงาน ------------------------------------------------------------------- -->
	
	<?php

		head();
		for($i=0;$i<12;$i+=2){
	?>

		<tr>
			<td align = "left" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:15px;">
				<?php
								show_description($getdata[$i]['id_order'],$getdata[$i]['product_id']);
				?>
			</td>
			<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:15px;solid;border-left:1px solid; ">
				<?php
						if(!empty($getdata[$i]['quantity']))
						{
							print number_format(ABS($getdata[$i]['quantity'])) ;
						}elseif(!empty($getdata[$i]['counts'])){
							print number_format(ABS($getdata[$i]['counts'])) ;
						}else{
							print("&nbsp;");
						}
						
				?>
			</td>
			<td align = "left" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:15px;solid;border-left:1px solid;">
				<?php
						show_description($getdata[$i+1]['id_order'],$getdata[$i+1]['product_id']);
					
				?>
			</td>
			<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:15px;solid;border-left:1px solid; ">
				<?php
						if(!empty($getdata[$i+1]['quantity']))
						{
							print number_format(ABS($getdata[$i+1]['quantity'])) ;
						}elseif(!empty($getdata[$i+1]['counts'])){
							print number_format(ABS($getdata[$i+1]['counts'])) ;
						}else{
							print("&nbsp;");
						}
				?>
			</td>
		</tr>
	<?php
		}
	?>	
		
	</table>  
	<?php 
	footer_trans(1);
	//print(sizeof($getdata));
	//ใช้เมื่อจำนวน Item มากกว่า 12 เพราะล้นช่องที่กำหนดไว้
	
	if(sizeof($getdata) >12)
		{	
			print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");

			?>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;empty-cells: show;">
		<tr>
			<td align = "center" colspan = "4" style = "width:180mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>
					บริษัท วนชัย กรุ๊ป จำกัด (มหาชน) - สระบุรี
				</b>
			</td>
		<tr>
		</tr>
			<td colspan = "1" align = "right" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				&nbsp;
			</td>
			<td align = "center" colspan = "1" style = "width:100mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>
					ใบขนส่งสินค้า
				</b>
			</td>
			<td align = "right" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				เลขที่
			</td>
			<td colspan = "1" align = "right" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;border-bottom:1px solid;">
				<?php print $getdata[0]['boonpon_id']." ".strtoupper($getdata[0]['warehouse_id']); ?>
			</td>
		</tr>
		<tr>
			<td align = "right" colspan = "3" style = "width:150mm;empty-cells: show;font-family:angsana new;font-size:16px;">
				วันที่
			</td>
			<td colspan = "1" align = "center" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					global $getdata;
					print printShortThaiDate($getdata[0]['delivery_date']);
				?>
			</td>
		</tr>
	</table>
	<table   border color ="#000000" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "bottom" style =  "width:180mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;border-top:1px solid;border-left:1px solid;border-right:1px solid;">
		 <tr>
	        <td align = "center" style = "width:70mm;heigh40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;solid;">
				<b>รายละเอียดสินค้า
			</td>
			   <td align = "center" style = "width:20mm;height40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;solid;border-left:1px solid;">
				<b>จำนวนแผ่น
			</td>
			<td align = "center" style = "width:70mm;heigh40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;solid;border-left:1px solid;">
				<b>รายละเอียดสินค้า
			</td>
			   <td align = "center" style = "width:20mm;height40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;solid;border-left:1px solid;">
				<b>จำนวนแผ่น
			</td>
		</tr>
	<?php


			for($i=12;$i<36;$i+=2){?>
						<tr>
							<td align = "left" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									show_description($getdata[$i]['id_order'],$getdata[$i]['product_id']);
								?>
							</td>
							<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;solid;border-left:1px solid; ">
								<?php
										if(!empty($getdata[$i]['quantity']))
										{
											print number_format(ABS($getdata[$i]['quantity'])) ;
										}elseif(!empty($getdata[$i]['counts'])){
											print number_format(ABS($getdata[$i]['counts'])) ;
										}else{
											print("&nbsp;");
										}
										
								?>
							</td>
							<td align = "left" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:14px;solid;border-left:1px solid;">
								<?php
									show_description($getdata[$i+1]['id_order'],$getdata[$i+1]['product_id']);
								?>
								
							</td>
							<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;solid;border-left:1px solid; ">
								<?php
										if(!empty($getdata[$i+1]['quantity']))
										{
											print number_format(ABS($getdata[$i+1]['quantity'])) ;
										}elseif(!empty($getdata[$i+1]['counts'])){
											print number_format($getdata[$i+1]['counts']) ;
										}else{
											print("&nbsp;");
										}
								?>
							</td>
						</tr>
			<?php
					}	?>	
	</table>  
	<?php 
	footer_trans(2);
	 }
	?>
	
		</body>
	</form>
</html>
<?php
	//include("temporaryorder.php");
	//include("informationfueling.php");
	//include("allowances.php");
?>
			