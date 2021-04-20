<meta http-equiv="Content-Type" content = "text/html; charset=utf-8" />
<html>
	<head>
		<title>
		ใบสั่งงานขนส่งไม้
		</title>
		<link type="text/css" href="assets/bootstrap/bootstrap.css" rel = "stylesheet" />
		<style type="text/css">
	@media print { 

	 .excel{ display: none !important; } 
	}

	.font-style{
		empty-cells: show;
		font-family:angsana new;
		font-size:14px;"
	}
</style>
	</head>
	<?php
		@ini_set('display_errors', '0');
		include("../include/mySqlFunc.php");
		query("USE transport");
			function nextPage(){
				print ("</table>");
				print("<div style=\"float: right;margin-top: 5px;\">FM-SW-W09</div>");
				print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");

			}	
			$id = $_GET['id'];
			$product_id = $_GET['product_id'];
			print("<div class=\"container\">");
				print("<a href=\"excel_report_transport2.php?id=".$id."&product_id=$product_id\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
		?>
	<form action = "" name = "insertquarity" method = "POST">
	<?php
		function head($wood){
			global $id;
	?>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:280mm;empty-cells: show;">
			<tr>
				<td align = "center" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;"><b>
				บริษัท วนชัย กรุ๊ป จำกัด (มหาชน)<br>
					ใบสั่งงานขนส่ง<?php 


					print $wood; ?> 
				</td>
			</tr>
			<tr>
				<td align = "center" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;"><b>
					<?php
						if(!empty($_GET['id'])){
							
							print  printlongSlateThaiDate($id);
						}
					?>
				</td>
			</tr>
			<tr>
				<td align = "left" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;"><b>
					<?php
						
					?>
				</td>
			</tr>
		</table>
	<?php
	}
		function headdetail($product){
	?>
		<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:280mm;empty-cells: show;border: 1px groove;">
				<tr>
					<td align = "center" rowspan="2" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						ที่
					</td>
					<td align = "center" rowspan="2" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						เลขที่                    
						ใบสั่ง (ขาย / โอน) 
					</td>
					<td align = "center" rowspan="2" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						เลขที่ใบโอน/ส่งของ
						ใบกำกับภาษี
					</td>
					
					<td align = "center" rowspan="2" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						รายการสินค้า
					</td>
					
					<td align = "center" rowspan="2" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						ชื่อลูกค้า
					</td>
					<?php
						$not_show = array(4,6,7,8);
						$check = data_in_array($product,$not_show);
						if($check==1){
							print("<td align = \"center\" colspan=\"4\" style = \"width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
								print("จำนวน");
							print("</td>");
						}else{
							print("<td align = \"center\" colspan=\"3\" style = \"width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
								print("จำนวน");
							print("</td>");
						}
					?>
					<td align = "center" rowspan="2" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						ช่องวางไม้
					</td>
					<td align = "center" rowspan="2" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						สถานที่จัดส่ง
					</td>
					<td align = "center" colspan="2" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						บรรทุกโดย
					</td>
					<td align = "center" rowspan="2" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						หมายเหตุ
					</td>
					<td align = "center" rowspan="2" style = "width:9mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						เวลา
					</td>
					<?php
						if($product==1 || $product==2){
					?>
					<td align = "center" rowspan="2" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						คิว
					</td>
					<?php
						}
					?>
				<tr>
					
					<?php
						if($check==1){
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">แผ่น</td>");
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">กล่อง</td>");
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">พาเลท</td>");
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">เศษกล่อง</td>");
						}else{
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">แผ่น</td>");
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">(ตั้ง)</td>");
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">เศษ(แผ่น)</td>");
						}
					?>
					<td align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:14px;">พขร.</td> 
					<td align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:14px;">ทะเบียน</td>
				</tr>
	<?php
		}
	$where_data = "";
	$search[0] = !empty($id) ? "delivery_date='$id'" : "";
	$search[1] = !empty($product_id) ? "product_id='$product_id'" : "";

	for ($s=0; $s < sizeof($search); $s++) {
		if(!empty($search[$s])){
			if(empty($where_data)){
			$where_data = $search[$s];
			}else{
				$where_data .= " and ".$search[$s];
			}
		}
		
	}
		
	$get_type = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE $where_data  group by product_id ");
			for ($ty=0; $ty <sizeof($get_type) ; $ty++) { 
				
			head($get_type[$ty]['detail_production']);
			headdetail($get_type[$ty]['product_id']);
			$not_show = array(4,6,7,8);
			$check_fl = data_in_array($get_type[$ty]['product_id'],$not_show);
			$getdata1 = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE delivery_date='$id'  and  product_id='".$get_type[$ty]['product_id']."' group by data_number  order by invoice asc");

			$next =1;
			for($i=0;$i<sizeof($getdata1);$i++)
			{
				$m = 1;
				$get_new = getlist("SELECT * FROM production_order WHERE data_number ='".$getdata1[$i]['data_number']."' and delivery_date='$id'");
				$total_quantity = 0;
				$total_court=0;
				$total_q = 0;

					//print $getdata1[$i]['boonpon_id']."<br>";
	?>		
						<tr>
							<td align = "center"  style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									print $next;//ที่
									$next++;
								?>
							</td>
							<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									$numer_data = array();
									for ($g=0; $g < sizeof($get_new); $g++) {
										//print $get_new[$g]['number'];//เลขที่ใบโอน/ส่งของ
										$check = data_in_array($get_new[$g]['number'],$numer_data);
										 if($check==0){
										 	array_push($numer_data, $get_new[$g]['number']);
										 }
									}
									
									for ($n=0; $n < sizeof($numer_data); $n++) { 
										print($numer_data[$n]);
										if(!empty($numer_data[$n+1])){
											print("<br>");
										}
									}

									//print "---".$getdata1[$i]['boonpon_id'];

								?>
							</td>
							<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
			
									//print $get_new[$g]['invoice']."";//เลขที่ใบโอน/ส่งของใบกำกับภาษี
									$invoice_data = array();
									for ($g=0; $g < sizeof($get_new); $g++) {
										//print $get_new[$g]['number'];//เลขที่ใบโอน/ส่งของ
										$check = data_in_array($get_new[$g]['invoice'],$invoice_data);
										 if($check==0){
										 	array_push($invoice_data, $get_new[$g]['invoice']);
										 }
									}
									
									for ($n=0; $n < sizeof($invoice_data); $n++) { 
										print($invoice_data[$n]);
										if(!empty($invoice_data[$n+1])){
											print("<br>");
										}
									}
									
								?>
							</td>
							<td align = "center" style = "width:35mm;empty-cells: show;font-family:angsana new;font-size:14px;text-align: left;">
								<?php
									
									if($getdata1[$i]['product_id']==6 || $getdata1[$i]['product_id']==7){
										print "บัวตัวจบ ".$getdata1[$i]['plate']." ".$getdata1[$i]['item_number']." ".$getdata1[$i]['mark_name'].$getdata1[$i]['box_name'];//รายการ	
									}elseif($getdata1[$i]['product_id']==3 or $getdata1[$i]['product_id'] ==5){
										print $getdata1[$i]['type_w']." ".$getdata1[$i]['item_number']." ".$getdata1[$i]['type_mark']."".$getdata1[$i]['mark_name'].$getdata1[$i]['side']." ".$getdata1[$i]['plate']." ".$getdata1[$i]['gule'];//รายการ	
									}elseif($getdata1[$i]['product_id']==4 ){
										print $getdata1[$i]['mark_name']." ".$getdata1[$i]['item_number']." ".$getdata1[$i]['plate']." เซาะ ".$getdata1[$i]['type_w'];//รายการ	
									}elseif($getdata1[$i]['product_id'] ==8){
										print $getdata1[$i]['mark_name']." ".$getdata1[$i]['item_number']." ".$getdata1[$i]['gule']." ".$getdata1[$i]['side']." ".$getdata1[$i]['plate']." เซาะ ".$getdata1[$i]['type_w'];//รายการ	
									}else{
										print  $getdata1[$i]['detail_production']." ".$getdata1[$i]['item_number']." ".$getdata1[$i]['gule'];//รายการ	
									}
									
									
									if(!empty($getdata1[$i+1]['detail_production']))
									{
										print("<br>");
									}
									/*if($getdata1[$i]['product_id']==3 or $getdata1[$i]['product_id'] ==5)
									{

										for ($g=0; $g < sizeof($get_new); $g++) {
										print  $get_new[$g]['type_w']." ".$get_new[$g]['item_number']." ".$get_new[$g]['type_mark']."".$get_new[$g]['mark_name'].$get_new[$g]['side']." ".$get_new[$g]['plate']." ".$get_new[$g]['gule'];//รายการ
											if(!empty($get_new[$g+1]['item_number'])){
												print("<br>");
											}
										}

									}else{
										for ($g=0; $g < sizeof($get_new); $g++) {
											print  $getdata1[$i]['detail_production']." ".$get_new[$g]['item_number']." ".$get_new[$g]['gule'];//รายการ
											if(!empty($get_new[$g+1]['item_number'])){
												print("<br>");
											}
										}
									}*/
						

								?>
							</td>
						
							<td align = "center"   style = "width:35mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									//print $get_new[$g]['name'];
									$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata1[$i]['name']."'");
							print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
								?>
							</td>
							<td align = "center" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									
										for ($g=0; $g < sizeof($get_new); $g++) {
											print  number_format($get_new[$g]['quantity']);//แผ่น
											$total_quantity += $get_new[$g]['quantity'];
											if(!empty($get_new[$g+1]['quantity'])){
												print("<br>");
											}
										}

										//print number_format(ABS($getdata1[$g]['quantity']));//แผ่น
									
								?>
							</td>
							<td align = "center" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
								//print number_format($get_new[$g]['counts']) ;
									for ($g=0; $g < sizeof($get_new); $g++) {
											print  number_format($get_new[$g]['counts']);//แผ่น
											$total_court += $get_new[$g]['counts'];
											if(!empty($get_new[$g+1]['counts'])){
												print("<br>");
											}
										}
							
								?>
							</td>
						
							<td align = "center" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php print ""; ?>
							</td>
							<?php
								
									print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
										
									print("</td>");
								
								if($check_fl==1){
									print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
											
												$post_time = array();
												for ($g=0; $g < sizeof($get_new); $g++) {
													
													array_push($post_time, $get_new[$g]['posttime']);
												}
												
												$new_postime= array_unique($post_time);
												for ($n=0; $n < sizeof($new_postime); $n++) { 
													print($new_postime[$n]);
												
													if(!empty($new_postime[$n+1])){
														print("<br>");
													}
												}
											
									print("</td>");
								}

							?>
							<td align = "center"   style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;">

								<?php

									
									
									//print $get_new[$g]['delivery_name'];//สถานที่จัดส่ง

									$delivery_name_data = array();
									for ($g=0; $g < sizeof($get_new); $g++) {
										//print $get_new[$g]['number'];//เลขที่ใบโอน/ส่งของ
										array_push($delivery_name_data, $get_new[$g]['delivery_name']);
									}
									
									$new_delivery_name_data= array_unique($delivery_name_data);
									for ($n=0; $n < sizeof($new_delivery_name_data); $n++) { 
										$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$new_delivery_name_data[$n]."'");
										print($get_delivery_name[0]['detailship']);
										if(!empty($new_delivery_name_data[$n+1])){
											print("<br>");
										}
									}

								?>
							</td>
							<td align = "center"   style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									//บรรทุกโดย
								
								$get_transaction = getlist("SELECT * from insertdata_transport where boonpon_id = '".$getdata1[$i]['boonpon_id']."'");
									if(!empty($get_transaction[0]['nameDriver'])){
										$getdriver = getlist("select * from driver where id_driver = '".$get_transaction[0]['nameDriver']."'");
										print $getdriver[0]['namedriver1'];
									}else{
										print "&nbsp";
									}
								?>
							</td>
							<td align = "center"   style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									if(!empty($get_transaction[0]['idcar'])){//ทะเบียน
										$getcar = getlist("select * from car_detail where id_car = '".$get_transaction[0]['idcar']."'");
										if($get_transaction[0]['typecar'] == 1 OR $get_transaction[0]['typecar'] == 3){
											print $getcar[0]['licenceplates'];
										}else{
											print $getcar[0]['licenceplates']."<br>";
											print $getcar[0]['licenceplate2'];
										}
									}else{
										print "&nbsp";
									}
								?>
							</td>
							<td align = "center"  style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;"><!-- หมายเหตุ -->
								<?php  //print $get_new[$g]['note']; 

								$note_data = array();
								
									for ($g=0; $g < sizeof($get_new); $g++) {
										//print $get_new[$g]['number'];//เลขที่ใบโอน/ส่งของ
										array_push($note_data, $get_new[$g]['note']);
										
										
									}
									
									$new_note= array_unique($note_data);
									for ($n=0; $n < sizeof($new_note); $n++) { 
										print($new_note[$n]);
										

										if(!empty($new_note[$n+1])){
											print("<br>");
										}
									}

								 ?>
							</td>
							
								<?php  //print $get_new[$g]['note']; 

								print("<td align = \"center\" style = \"empty-cells: show;font-family:angsana new;font-size:14px;\">");
								
												$post_time = array();
												for ($g=0; $g < sizeof($get_new); $g++) {
													
													array_push($post_time, $get_new[$g]['posttime']);
												}
												
												$new_postime= array_unique($post_time);
												for ($n=0; $n < sizeof($new_postime); $n++) { 
													print($new_postime[$n]);
												
													if(!empty($new_postime[$n+1])){
														print("<br>");
													}
												}
											
											
							print("</td>");

								if($get_type[$ty]['product_id']==1 || $get_type[$ty]['product_id']==2){
								print("<td align = \"center\"  style = \"empty-cells: show;font-family:angsana new;font-size:14px;\">");/*<!-- หมายเหตุ -->*/
								for ($g=0; $g < sizeof($get_new); $g++) {

											$size_data = explode("x", $get_new[$g]['item_number']);
											$q = (($size_data[0]*$size_data[1]*$size_data[2])/1000000000)*$get_new[$g]['quantity'];
											print  number_format($q,2);//แผ่น
											$total_q += $q;

											$total_quantity += $get_new[$g]['quantity'];
											if(!empty($get_new[$g+1]['quantity'])){
												print("<br>");
											}
										}
								
							print("</td>");
						}

						print("</tr>");
					
						if(sizeof($get_new)>1){
							print("<tr class='font-style'>");
								print("<td colspan='4'>");
									print("");
								print("</td>");
								print("<td style='text-align:center;'>");
									print("รวม");
								print("</td>");
								print("<td style='text-align:center;'>");
									print(number_format($total_quantity));
								print("</td>");
								print("<td style='text-align:center;'>");
									print(number_format($total_court));
								print("</td>");
								print("<td colspan='7'>");
									print("");
								print("</td>");
								if($get_type[$ty]['product_id']==1 || $get_type[$ty]['product_id']==2){
								print("<td style='text-align:center;'>");
									print(number_format($total_q,2));
								print("</td>");
							}
							print("</tr>");
						}
						
					

			}
			print("</table>");
			footer();
			
		print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");
		}
		

	
	function footer()
	{
		print("<table align = \"center\" valign = \"middle\"  style=\"width:280mm;empty-cells: show;text-align:center;font-family:angsana new;font-size:14px;\">");
		print("<tr style=\"border:0px;\">");
			print("<td colspan=\"3\" style=\"border:0px;\">");
				print("<br>....................................................<br>");
				print("ผู้ทำใบสั่งงาน");
			print("</td>");

			print("<td >");
				print("<br>....................................................<br>");
				print("ผู้ตรวจสอบ");
			print("</td>");

			print("<td colspan=\"4\">");
				print("<br>....................................................<br>");
				print("ผู้อนุมัติ");
			print("</td>");

			print("<td colspan=\"5\">");
				print("<br>....................................................<br>");
				print("ผู้จัดรถขนส่ง");
			print("</td>");
		print("</tr>");
		print("<tr style=\"border:0px;\">");
			print("<td colspan=\"14\" style=\"border:0px;\">");
				print("<div style=\"float: right;margin-top: 5px;\">FM-SW-W09</div>");
			print("</td>");
		print("</tr>");
		print("</table>");

	}
	
	?>

			
			
	
	</html>