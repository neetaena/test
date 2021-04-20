<?php
$id = $_GET['id'];
			$product_id = $_GET['product_id'];
			if(empty($_GET['excel'])){
				print("<div class=\"container\">");
				print("<a href=\"excel_report_transport.php?id=".$id."&product_id=$product_id&excel=1\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
			}
			
		?>
	<form action = "" name = "insertquarity" method = "POST">
	<?php
		function head($wood){
			global $id;
	?>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;empty-cells: show;">
			<tr>
				<td align = "center" style = "width:30mm;" class='font-style' colspan="16"><b>
				บริษัท วนชัย กรุ๊ป จำกัด (มหาชน)<br>
					ใบสั่งงานขนส่ง<?php 


					print $wood; ?> 
				</td>
			</tr>
			<tr>
				<td align = "center" style = "width:30mm;" class='font-style' colspan="16"><b>
					<?php
						if(!empty($_GET['id'])){
							
							print  printlongSlateThaiDate($id);
						}
					?>
				</td>
			</tr>
			<tr>
				<td align = "left" style = "width:30mm;" class='font-style'><b>
					<?php
						
					?>
				</td>
			</tr>
		</table>
	<?php

	}


	$not_show = array(4,8,9,11,12,17,18,19,20,21,22,25);
		$bua = array(6,7,13,14,15,16);
		function headdetail($product){

			global $not_show,$bua;

	?>
		<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:300mm;empty-cells: show;border: 1px groove;">
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
					<?php
						$too = array(8);
						
						$check_too = data_in_array($product,$too);
						if($check_too==1){
							print("<td align = \"center\" rowspan=\"2\" style = \"width:20mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
								print("ตู้");
							print("</td>");
						}
						

					
						if(in_array($product,$bua)){
							print("<td align =\"center\" rowspan=\"2\" colspan='2' style = \"width:3mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
									print("รายการสินค้า");
								print("</td>");
						}else{
							print("<td align = \"center\" rowspan=\"2\" style = \"width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
								print("รายการสินค้า");
							print("</td>");
						}
					?>
					
				
					
					<td align = "center" rowspan="2" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						ชื่อลูกค้า
					</td>
					<?php
						
						$check = data_in_array($product,$not_show);
						if($check==1 || in_array($product,$bua)){
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
					
					<td align = "center" rowspan="2" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						คิว
					</td>
					
					<td align = "center" rowspan="2" style = "width:3mm;empty-cells: show;font-family:angsana new;font-size:14px;">
						กลุ่ม
					</td>

					<?php

					$cus_mark =  array(4);
						$check_cus_mark = data_in_array($product,$cus_mark);
						if($check_cus_mark==1){
							print("<td align =\"center\" rowspan=\"2\" style = \"width:3mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
									print("ลายลูกค้า");
								print("</td>");
						}

					?>
				<tr>
					
					<?php
							
						if($check==1){
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">แผ่น</td>");
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">กล่อง</td>");
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">พาเลท</td>");
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">เศษกล่อง</td>");
						}elseif(in_array($product,$bua)){
							print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">เส้น</td>");
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
	?>
	<?php
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
				//print $get_type[$ty]['product_id']."sasadsa";
			head($get_type[$ty]['detail_production']);
			headdetail($get_type[$ty]['product_id']);
			$not_show = array(4,6,7,8,9,11,12,17,18,19,20,21,22,15,25);
			$check_fl = data_in_array($get_type[$ty]['product_id'],$not_show);
			$getdata1 = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE delivery_date='$id'  and  product_id='".$get_type[$ty]['product_id']."' group by warehouse_id    order by invoice asc");

			

			$next =1;
			for($i=0;$i<sizeof($getdata1);$i++)
			{
				$m = 1;
				$get_new = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production  WHERE warehouse_id ='".$getdata1[$i]['warehouse_id']."' and  product_id='".$get_type[$ty]['product_id']."' and  delivery_date='$id' order by invoice asc");

				
				
				$total_quantity = 0;
				$total_court=0;
				$total_q = 0;
				if(!empty($get_new) && $getdata1[$i]['warehouse_id'] !=""){

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
							<?php
							//print $get_new[$i]['product_id'];
										$too = array(8);
										$check_too = data_in_array($get_new[0]['product_id'],$too);
										if($check_too==1){
											print("<td align = \"center\"  style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
												for ($n=0; $n < sizeof($get_new); $n++) { 
													print($get_new[$n]['note_order']);
													
													if(!empty($get_new[$n+1]['note_order'])){
														print("<br>");
													}
												}
											print("</td>");
								}
							?>
							
								<?php
									print("<td align = \"center\" style = \"width:38mm;empty-cells: show;font-family:angsana new;font-size:14px;text-align: left;\">");
									for ($g=0; $g < sizeof($get_new); $g++) 
									{
										show_description($get_new[$g]['id_order'],$getdata1[$i]['product_id']);
										if(empty($getdata1[$i]['warehouse_id'])){
											
											print("<a onclick = \"window.open('insertdatawarehouse2.php?code_data=".$getdata1[$i]['number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1300,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\"><v style='color:red;'>จัดกลุ่ม</v></a>");
										}
										
										if(!empty($get_new[$g+1]['detail_production']))
										{
											print("<br>");
										}
									}
										
									print("</td>");

									if(in_array($getdata1[$i]['product_id'],$bua)){
									print("<td align = \"center\" style = \"width:7mm;empty-cells: show;font-family:angsana new;font-size:14px;text-align: left;\">");

											for ($n=0; $n < sizeof($get_new); $n++) { 
													print($get_new[$n]['type_bj']);
													
													if(!empty($get_new[$n+1]['type_bj'])){
														print("<br>");
													}
											}
									print("</td>");
									}

								?>
							
				
							<td  style = "width:35mm;empty-cells: show;font-family:angsana new;font-size:14px;padding-left: 2px;">
								<?php
									//print $get_new[$g]['name'];
									

									$customer_name_data = array();
									for ($g=0; $g < sizeof($get_new); $g++) {
										//print $get_new[$g]['number'];//เลขที่ใบโอน/ส่งของ
										array_push($customer_name_data, $get_new[$g]['name']);
									}
									
									$new_customer_data= array_unique($customer_name_data);
									for ($n=0; $n < sizeof($new_customer_data); $n++) { 
										$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$new_customer_data[$n]."'");
										print($get_customer_name[0]['namecustomer']);
										if(!empty($new_customer_data[$n+1])){
											print("<br>");
										}
									}
								?>
							</td>
	<!--//////////////////////////////////////////////จำนวนแผ่น/////////////////////////////////////////////////////////////-->		
							<td align = "center" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									

										for ($g=0; $g < sizeof($get_new); $g++) {
											print  number_format($get_new[$g]['quantity']);//แผ่น
											$total_quantity += $get_new[$g]['quantity'];
											if(!empty($get_new[$g+1]['item_number'])){
												print("<br>");
											}
										}

										//print number_format(ABS($getdata1[$g]['quantity']));//แผ่น
									
								?>
							</td>
	<!--//////////////////////////////////////////////ตั้ง/////////////////////////////////////////////////////////////-->
							<td align = "center" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
							
								$type_size = array("16.7x1220x2440","18x1220x2440","12x1220x2440","15x1220x2440","23x1220x2440","32x4x8");
								$type_product_tung = array(1,2,5,3);
/*
								if(in_array($getdata1[$i]['product_id'], $type_product_tung)){

									for ($g=0; $g < sizeof($get_new); $g++) {
											if(in_array($get_new[$g]['item_number'], $type_size)){
												print  number_format($get_new[$g]['counts']);//แผ่น
												$total_court += $get_new[$g]['counts'];
											}else{
												$get_size = getlist("SELECT * FROM `production_size` WHERE size_description='".$get_new[$g]['item_number']."' and product_id='".$getdata1[$i]['product_id']."'");
												$tung = $get_new[$g]['quantity']/$get_size[0]['size_tung'];
												print  number_format($tung);//แผ่น
												$total_court += $tung;
										
											}

											if(!empty($get_new[$g+1]['item_number'])){
												print("<br>");
											}
										}

									
								}else{*/
									for ($g=0; $g < sizeof($get_new); $g++) {
											print  number_format($get_new[$g]['counts']);//แผ่น
											$total_court += $get_new[$g]['counts'];
											if(!empty($get_new[$g+1]['item_number'])){
												print("<br>");
											}
										}
								//}
							
								?>
							</td>
	<!--//////////////////////////////////////////////พาเลท/////////////////////////////////////////////////////////////-->					
							<td align = "center" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									for ($g=0; $g < sizeof($get_new); $g++) {
											print  number_format($get_new[$g]['palette']);//แผ่น
											$total_palette += $get_new[$g]['palette'];
											if(!empty($get_new[$g+1]['item_number'])){
												print("<br>");
											}
										}
								?>
							</td>
	<!--//////////////////////////////////////////////เศษกล่อง/////////////////////////////////////////////////////////////-->
						<?php
								
									print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
										for ($g=0; $g < sizeof($get_new); $g++) {
											print  number_format($get_new[$g]['scrap']);//แผ่น
											$total_scrap += $get_new[$g]['scrap'];
											if(!empty($get_new[$g+1]['item_number'])){
												print("<br>");
											}
										}
											
									print("</td>");
								
								if($check_fl==1){
									print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
											
											
											
									print("</td>");
								}

							?>
	<!--//////////////////////////////////////////////ช่องวางไม้/////////////////////////////////////////////////////////////-->
							<td align = "center"   style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php

									
									
									//print $get_new[$g]['delivery_name'];//สถานที่จัดส่ง

									$delivery_name_data = array();
									for ($g=0; $g < sizeof($get_new); $g++) {
										//print $get_new[$g]['number'];//เลขที่ใบโอน/ส่งของ
										array_push($delivery_name_data, $get_new[$g]['delivery_name']);
									}
									//$new_delivery_name_data = array();
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
									if(!empty($getdata1[$i]['boonpon_id'])){
										$getdriver = getlist("select * from driver where id_driver = '".$get_transaction[0]['nameDriver']."'");
										print $getdriver[0]['namedriver1'];
									}else{
										print "&nbsp";
									}

								?>
							</td>
							<td align = "center"   style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:14px;">
								<?php
									if(!empty($getdata1[$i]['boonpon_id'])){//ทะเบียน
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
										print((string)$new_note[$n]);
										
										if(!empty($new_note[$n+1])){
											print("<br>");
										}
									}
									

								 
							print("</td>");
							
							print("<td align = \"center\" style = \"empty-cells: show;font-family:angsana new;font-size:14px;\">");
								
												$post_time = array();
												for ($g=0; $g < sizeof($get_new); $g++) {
													
													array_push($post_time, $get_new[$g]['posttime']);
												}
												
												$new_postime= array_unique($post_time);
												for ($n=0; $n < sizeof($new_postime); $n++) { 
													print($new_postime[$n]).".";
												
													if(!empty($new_postime[$n+1])){
														print("<br>");
													}
												}
											
											
							print("</td>");

			

						
						
							print("<td align = \"center\"  style = \"empty-cells: show;font-family:angsana new;font-size:14px;\">");
								$data_p = array(1,2,3,6,7,13,15,16);
								$check_pro = data_in_array($getdata1[$i]['product_id'],$data_p);
								
								if($check_pro==1){
									for ($g=0; $g < sizeof($get_new); $g++) {
											for ($g=0; $g < sizeof($get_new); $g++) {
											$size_data = explode("x", $get_new[$g]['item_number']);
											$q = (($size_data[0]*$size_data[1]*$size_data[2])/1000000000)*$get_new[$g]['quantity'];
											
											print  number_format($q,2);//แผ่น
											$total_q += $q;

										
											if(!empty($get_new[$g+1]['quantity'])){
												print("<br>");
											}
										}
									}
								}elseif($getdata1[$i]['product_id']==5){
										for ($g=0; $g < sizeof($get_new); $g++) {
											$size_data = explode("x", $get_new[$g]['item_number']);
											$q = ((1230*2450*$size_data[0])/1000000000)*$get_new[$g]['quantity'];
											
											print  number_format($q,2);//แผ่น
											$total_q += $q;

											
											if(!empty($get_new[$g+1]['quantity'])){
												print("<br>");
											}
										}

								}else{
									for ($g=0; $g < sizeof($get_new); $g++) {
										switch ($get_new[$g]['item_number']) {
											case '8x192x1205':
												$q = ((192*1205)/1000000)*8*$get_new[$g]['counts'];
												break;
											case '12x193x1205':
												$q = ((193*1205)/1000000)*7*$get_new[$g]['counts'];
												break;
											case '12x125x1205':
												$q = ((125*1205)/1000000)*7*$get_new[$g]['counts'];
												break;
											case '12x125x1210':
												$q = ((125*1210)/1000000)*16*$get_new[$g]['counts'];
												break;
											case '12x190x1205':
												$q = ((190*1205)/1000000)*7*$get_new[$g]['counts'];
												break;
											case '12x298x1205':
												$q = ((298*1205)/1000000)*5*$get_new[$g]['counts'];
												break;
											case '8x1220x1260':
												$q = ((1220*1278)/1000000)*1*$get_new[$g]['quantity'];
												break;
											case '8x1220x1900':
												$q = ((1220*1900)/1000000)*1*$get_new[$g]['quantity'];
												break;
											default:
												$q =0;
												break;

										}
										print  number_format($q,2);//แผ่น
											$total_q += $q;

											
											if(!empty($get_new[$g+1]['quantity'])){
												print("<br>");
											}
									}
								}
						
								
							print("</td>");
						
						print("<td align = \"center\"  style = \"empty-cells: show;font-family:angsana new;font-size:14px;\">");
								 //print $get_new[$g]['note']; 
									print(" ".$getdata1[$i]['warehouse_id']);

								 
							print("</td>");
							$cus_mark =  array(4);
						$check_cus_mark = data_in_array($getdata1[$i]['product_id'],$cus_mark);
							if($check_cus_mark==1){
								print("<td align = \"center\"  style = \"empty-cells: show;font-family:angsana new;font-size:14px;\">");
								 //print $get_new[$g]['note']; 
								for ($g=0; $g < sizeof($get_new); $g++) {
									print($get_new[$g]['customer_mark']);
									if(!empty($get_new[$g+1]['customer_mark']))
										{
											print("<br>");
										}
								 }
							print("</td>");

							}
						print("</tr>");

					
						if(sizeof($get_new)>1){
							print("<tr class='font-style' style = \"empty-cells: show;font-family:angsana new;font-size:14px;\">");
								if(in_array($getdata1[$i]['product_id'],$bua)){
									$row_footer = 5;
								}else{
									$row_footer = 4;
								}

								print("<td colspan='$row_footer'>");
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
								
								if($check_pro==1){
									print("<td colspan='7'>");
										print("");
									print("</td>");
									print("<td style='text-align:center;'>");
										print(number_format($total_q,2));
									print("</td>");
									print("<td>");
										print("");
									print("</td>");
								}elseif($getdata1[$i]['product_id']==5){
									print("<td colspan='7'>");
										print("");
									print("</td>");
									print("<td style='text-align:center;'>");
										print(number_format($total_q,2));
									print("</td>");
									print("<td>");
										print("");
									print("</td>");
								}else{
									print("<td colspan='8'>");
										print("");
									print("</td>");
									print("<td style='text-align:center;'>");
										print(number_format($total_q,2));
									print("</td>");
									print("<td colspan='2'>");
										print("");
									print("</td>");
								}
							print("</tr>");
						}
						
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
			print("<td colspan=\"3\" style=\"text-align:center\">");
				print("<br>....................................................<br>");
				print("ผู้ทำใบสั่งงาน");
			print("</td>");

			print("<td colspan=\"2\" style=\"text-align:center\">");
				print("<br>....................................................<br>");
				print("ผู้ตรวจสอบ");
			print("</td>");

			print("<td colspan=\"5\" style=\"text-align:center\">");
				print("<br>....................................................<br>");
				print("ผู้อนุมัติ");
			print("</td>");

			print("<td colspan=\"5\" style=\"text-align:center\">");
				print("<br>....................................................<br>");
				print("ผู้จัดรถขนส่ง");
			print("</td>");
		print("</tr>");
		print("<tr style=\"border:0px;\">");
			print("<td colspan=\"15\" style=\"border:0px;text-align:right\">");
				print("<div style=\"float: right;margin-top: 5px;\">FM-SW-W09</div>");
			print("</td>");
		print("</tr>");
		print("</table>");

	}
	?>