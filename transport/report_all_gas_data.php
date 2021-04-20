<?php
$date_incut = explode("-", $datein);
		$date_outcut = explode("-", $dateout);

		$DateStart = $date_incut[2];	//วันเริ่มต้น
		$MonthStart = $date_incut[1];	//เดือนเริ่มต้น
		$YearStart = $date_incut[0];	//ปีเริ่มต้น

		$DateEnd = $date_outcut[2];	//วันสิ้นสุด
		$MonthEnd = $date_outcut[1];	//เดือนสิ้นสุด
		$YearEnd = $date_outcut[0];	//ปีสิ้นสุด

		$End = mktime(0,0,0,$MonthEnd,$DateEnd,$YearEnd);
		$Start = mktime(0,0,0,$MonthStart ,$DateStart ,$YearStart);

		$DateNum=ceil(($End -$Start)/86400)+1; // 28
		if(empty($_GET['excel'])){
			print("<div class=\"container\">");
				print("<a href=\"excel_report_gas_ngv.php?datein=".$datein."&dateout=".$dateout."&excel=1&license_plate=$license_plate&today=1\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
		}
		$boonpon_id_all = array();
	
		$new_date_add= add_date($datein,$s,0,0);
		$new_date =explode(" ", $new_date_add);
		$get_type = getlist("SELECT * FROM production_order WHERE delivery_date between '".$datein."' and '$dateout' group by product_id");
				
	
			for ($t=0; $t < 1; $t++) {
				$boonpon_id_data = array();
				$get_boonpon = getlist("SELECT p.boonpon_id,nameDriver FROM production_order as p inner join insertdata_transport as it on p.boonpon_id=it.boonpon_id inner join car_detail as c on it.idcar=c.id_car WHERE delivery_date between '".$datein."' and '$dateout'  and idcar='$license_plate' GROUP BY boonpon_id");
				

				for ($p=0; $p <sizeof($get_boonpon) ; $p++) { 
					if(!empty($get_boonpon[$p]['boonpon_id'])){
						if(!in_array($get_boonpon[$p]['boonpon_id'], $boonpon_id_all))
						{
							//$boonpon_id_all[] = $get_boonpon[$p]['boonpon_id'];
							if(!in_array($get_boonpon[$p]['boonpon_id'],$boonpon_id_data)){
							$boonpon_id_data[] = $get_boonpon[$p]['boonpon_id'];
							}
						}
					}
					
					
				}
				if(!empty($boonpon_id_data)){
				print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:350mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='12'>");
					$get_type_name = getlist("SELECT * FROM type_production WHERE id_production='".$get_type[$t]['product_id']."'");
						print("รายงานการใช้เชื้อเพลิง แยกตามทะเบียนรถ");
					print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='12'>");
					$get_car_detail = getlist("SELECT * FROM car_detail as cd inner join car_head as ch on cd.typecar=ch.id_hcar WHERE id_car='$license_plate'");

					$get_driver = getlist("SELECT * FROM driver WHERE id_driver='".$get_boonpon[0]['nameDriver']."'");

								print("ทะเบียนรถ ".$get_car_detail[0]['licenceplates']." "."".$get_car_detail[0]['licenceplate2']." ประเภทรถ ".$get_car_detail[0]['detailhcar']." เชื้อเพลิง ".$get_car_detail[0]['typefule']);	
					print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='12'><b>");
						print("ระหว่างวันที่ ".printlongSlateThaiDate($datein)."  ถึง ".printlongSlateThaiDate($dateout));
					print("</td>");
				print("</tr>");
			print("</table>");
			print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:350mm;empty-cells: show;\">");
				print("<tr>");
					/*print("<td align = \"center\" class='font-style' style='width:2%;' rowspan='2'><b> ");
						print("ลำดับ");
					print("</td>");*/

					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("วันที่ขนส่ง");
					print("</td>");

					/*print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("เลข invoice");
					print("</td>");*/

					print("<td align = \"center\" class='font-style' style='width:8%;' rowspan='2'><b>");
						print("พขร.");
					print("</td>");

					/*print("<td align = \"center\" class='font-style' style='width:9%;' rowspan='2'><b>");
						print("ประเภทรถ");
					print("</td>");*/

					/*print("<td align = \"center\" class='font-style' style='width:7%;' rowspan='2'><b>");
						print("เลขที่ใบกำกับภาษี/ใบส่งของ");
					print("</td>");*/

					print("<td align = \"center\" class='font-style'  style='width:14%;' rowspan='2'><b>");
						print("ชื่อลูกค้า");
					print("</td>");
					print("<td align = \"center\" class='font-style'  style='width:7%;' rowspan='2'><b>");
						print("สถานที่จัดส่ง");
					print("</td>");
					/*print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("ประเถทสินค้า");
					print("</td>");*/

						/*print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("น้ำหนักบรรทุก");
					print("</td>");*/
			
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("ค่าเติมGas(บาท)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("จำนวนบิล");
					print("</td>");
				
					
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("แก๊สที่ใช้(Kg)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("ระยะทาง(Km)");
					print("</td>");
					
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("อัตราใช้แก๊ส(Km/Kg)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:8%;' rowspan='2'><b>");
						print("ปั้มที่เติม");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("แรงดันก่อนวิ่ง(บาร์)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("หมายเหตุ");
					print("</td>");
				print("</tr>");
				print("<tr>");
					/*print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("บัตรเครดิต");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("ใช้เงินสด.");
					print("</td>");
					/*print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("รวม(บาท).");
					print("</td>");*/

					/*print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("มาตราฐาน.");
					print("</td>");*/
					/*print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("ใช้จริง.");
					print("</td>");*/

					/*print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("มาตราฐาน.");
					print("</td>");*/
					/*print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("ใช้จริง.");
					print("</td>");*/


				print("</tr>");
				$num=1;
				
				$weight_wood = 0;
				$distanct_stan =0;
				$distanct_true =0;
				$gas_stan = 0;
				$gas_true = 0;
				$gas_averange = 0;
				$totol_cradit = 0;
				$totol_money = 0;
				$total_all = 0;
				$totol_weight = 0;
				$total_pressure_gas =0;
				$num_of_paper = 0;
				for ($i=0; $i < $DateNum; $i++) 
				{
					$new_date_add= add_date($datein,$i,0,0);
					$new_date =explode(" ", $new_date_add);
						$get_data = getlist("SELECT * FROM production_order as p inner join insertdata_transport as it on p.boonpon_id=it.boonpon_id WHERE delivery_date ='".$new_date[0]."' and idcar='$license_plate' and p.boonpon_id !=' ' GROUP BY p.boonpon_id");
/*
						print("SELECT * FROM production_order as p inner join insertdata_transport as it on p.boonpon_id=it.boonpon_id WHERE  delivery_date ='".$new_date[0]."'  and idcar='$license_plate' GROUP BY p.id_order");
						print("<br>");
*/						
						$row = 1;
						


						if(empty($get_data[0]['boonpon_id'])){
				
								$get_note = getlist("SELECT * FROM driver_note WHERE license = '".$get_car_detail[0]['licenceplates']."' and note_date = '".$new_date[0]."'");

								 print("<tr>");
								 	print("<td  class='font-style' style='text-align:center;padding-left:2px;' >");
														print(printNumDate($new_date[0]));
									print("</td>");
								if($get_note)
								{
									$note_data = explode("@#", $get_note[0]['note_description']);
									print("<td colspan='11' class='font-style' style = \"text-align:center;\">");
								print("<a onclick = \"window.open('add/add_note_driver.php?license=".$get_car_detail[0]['licenceplates']."&note_date=".$new_date[0]."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$note_data[0]." ".$note_data[1]."</a> ");

								print("</td>");
								}else{
									 
									print("<td colspan='11' style = \"text-align:center;\" class='font-style'>");
									 print("<a onclick = \"window.open('add/add_note_driver.php?license=".$get_car_detail[0]['licenceplates']."&note_date=".$new_date[0]."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\"  class='excel'>เพิ่มหมายเหตุ</a> ");

									 									
									 print("</td>");

								}
							print("</tr>");
						}else{

								for ($k=0; $k < sizeof($get_data); $k++) 
								{ 
					
									$get_data_2 = getlist("SELECT* FROM production_order as p inner join insertdata_transport as it on p.boonpon_id=it.boonpon_id WHERE  delivery_date ='".$new_date[0]."'  and idcar='$license_plate' and p.boonpon_id='".$get_data[$k]['boonpon_id']."'");
									$get_transport = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$get_data[$k]['boonpon_id']."'");
									$get_driver = getlist("SELECT * FROM driver WHERE id_driver='".$get_transport[0]['nameDriver']."'");
									
									print("<tr>");

									


					//---------------------------------------------------------------ทะเบียน---------------------------------------------------------
										if($row==1){
												print("<td  class='font-style' style='text-align:center;padding-left:2px;' rowspan='".sizeof($get_data)."'>");
														print(printNumDate($new_date[0]));
												print("</td>");
												$row = 0;
										}

					//---------------------------------------------------------------เลข invoice.---------------------------------------------------------------
										/*print("<td  class='font-style'  style='padding-left:5px;'>");
			
											$invoice = array();
			
											for ($p=0; $p <sizeof($$get_data_2) ; $p++) { 
												if(!in_array($$get_data_2[$p]['invoice'],$invoice)){
													$invoice[] = $$get_data_2[$p]['invoice'];
												}
											}
											
											for($c=0;$c<sizeof($invoice);$c++)
											{
													print($invoice[$c]);
													if(!empty($invoice[$c+1])){
														print "<br>";
													}
											}
			
											
										print("</td>");*/
										
					//---------------------------------------------------------------ชื่อลูกค้า---------------------------------------------------------------
										print("<td class='font-style' style='padding-left:5px;'>");
											print($get_driver[0]['namedriver1']);
										print("</td>");
										print("<td class='font-style' style='padding-left:5px;'>");
										
										$customer = array();

										for ($p=0; $p <sizeof($get_data_2) ; $p++) { 
											if(!in_array($get_data_2[$p]['name'],$customer)){
												$customer[] = $get_data_2[$p]['name'];
											}
										}
										
										for($c=0;$c<sizeof($customer);$c++)
										{
												$get_custoemr = getlist("SELECT * FROM customer WHERE id_customer='".$customer[$c]."'");

												print($get_custoemr[0]['namecustomer']);
												if(!empty($customer[$c+1])){
													print "<br>";
												}
										}
											
										print("</td>");
					//---------------------------------------------------------------สถานที่จัดส่ง---------------------------------------------------------------

										print("<td class='font-style' style='padding-left:5px;'>");

										$ship = array();

										for ($p=0; $p <sizeof($get_data_2) ; $p++) { 
											$get_custoemr = getlist("SELECT * FROM shipping WHERE id_ship='".$get_data_2[$p]['delivery_name']."'");

											if(!in_array($get_custoemr[0]['country'],$ship)){
												$ship[] =$get_custoemr[0]['country'];
											}
										}
										
										for($c=0;$c<sizeof($ship);$c++)
										{
												

												print($ship[$c]);
												if(!empty($ship[$c+1])){
													print "<br>";
												}
										}
										/*$get_custoemr = getlist("SELECT * FROM shipping WHERE id_ship='".$get_data_2[0]['delivery_name']."'");
											print($get_custoemr[0]['country']);*/
										print("</td>");

										/*print("<td class='font-style' style='text-align:center;'>");
												$type_product = array();

											for ($p=0; $p <sizeof($get_data_2) ; $p++) { 
												if(!in_array($get_data_2[0]['product_id'],$type_product)){
													$type_product[] = $get_data_2[0]['product_id'];
												}
											}
											
											for($c=0;$c<sizeof($type_product);$c++)
											{
												$product = getlist("SELECT * FROM type_production WHERE id_production='".$type_product[$c]."'");
													print($product[0]['detail_production']);
													if(!empty($type_product[$c+1])){
														print "<br>";
													}
											}

										print("</td>");*/

										$check_data = getlist("SELECT * FROM gas_ngv WHERE boonpon_id='".$get_data[$k]['boonpon_id']."' and data_number='".$get_data[$k]['data_number']."'");
						//------------------------------------------นน.บรรทุก-------------------------
										/*print("<td class='font-style' style='text-align:center;'>");
											print($check_data[0]['wood_weight']);
											$weight_wood +=$check_data[0]['wood_weight'];
										print("</td>");*/
								//---------------------------------------------------------------ประเภทรถ---------------------------------------------------------------
										print("<td class='font-style' style='text-align:center;'>");

											
											if(!empty($check_data)){
												print("<a onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$get_data[$k]['boonpon_id']."&data_number=".$get_data[$k]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".number_format($check_data[0]['credit']+$check_data[0]['cash'],2)."</a> ");

												$total_all += ($check_data[0]['credit']+$check_data[0]['cash']); 
												//$totol_money += $check_data[0]['cash'];
											}else{
												print("<a class='excel' onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$get_data[$k]['boonpon_id']."&data_number=".$get_data[$k]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\">เพิ่ม</a> ");
											}
											
											 
										
										print("</td>");
										/*print("<td class='font-style' style='text-align:center;'>");
											
											if(!empty($check_data)){
												print("<a onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$get_data[$k]['boonpon_id']."&data_number=".$get_data[$k]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".number_format($check_data[0]['cash'],2)."</a> ");
												 
											}else{
												print("<a class='excel' onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$get_data[$k]['boonpon_id']."&data_number=".$get_data[$k]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\">เพิ่ม</a> ");
											}
										
										print("</td>");*/

										print("<td class='font-style' style='text-align:center;'>");
											
											if(!empty($check_data)){
												print("<a onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=700,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$check_data[0]['num_of_paper']."</a> ");
												$num_of_paper += $check_data[0]['num_of_paper'];
											}else{
												print("<a class='excel' onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=700,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\">เพิ่ม</a> ");
											}
											

										
										print("</td>");

			//------------------------------------------------แก๊สใช้จริง-------------------------
										print("<td class='font-style' style='text-align:center;'>");
												print(number_format($check_data[0]['gas_weight'],2));
												$gas_true += $check_data[0]['gas_weight'];
										print("</td>");
									



										
										print("<td class='font-style' style='text-align:center;'>");
										$distanct_true += $check_data[0]['distanct'];
												print($check_data[0]['distanct']);

										print("</td>");
				
											print("<td class='font-style' style='text-align:center;'>");
												$average = $check_data[0]['distanct']/$check_data[0]['gas_weight'];
												if($average > 0){
													print(number_format($average,2));	
													$gas_averange += $average;
													//print "<br>".$gas_averange;
												}
												
										print("</td>");
								//--------------------------------------------------ปั้มแก๊ซ--------------------------------------
										print("<td class='font-style' style='text-align:center;'>");
											print($check_data[0]['pump_gas']);

										print("</td>");

										print("<td class='font-style' style='text-align:center;'>");
										$total_pressure_gas += $check_data[0]['pressure_gas'];
												print($check_data[0]['pressure_gas']);

										print("</td>");

										

										print("<td class='font-style' style='text-align:center;'>");
											if(!empty($check_data)){
												print("<a onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$get_data[$k]['boonpon_id']."&data_number=".$get_data[$k]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$check_data[$k]['note']."</a> ");
											}else{
												print("<a class='excel' onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$get_data[$k]['boonpon_id']."&data_number=".$get_data[$k]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\">เพิ่ม</a> ");
											}	

										if(!empty($check_data[0]['cash'])){
											print(": เงินสด");
										}
										print("</td>");
										

									print("</tr>");
								}
							}
					
				}
					print("<tr>");
						print("<td class='font-style' style='text-align:center;' colspan='4'>");
							print("รวม");
						print("</td>");
						//-----------น้ำหนักบรรทุก----
						/*print("<td class='font-style' style='text-align:center;'>");
							print(number_format($weight_wood,2));
						print("</td>");*/
						//--------------บัตรเครดิต---
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($total_all,2));
						print("</td>");
						//--------------ใช้เงินสด.---
						/*print("<td class='font-style' style='text-align:center;'>");
							print(number_format($totol_money,2));
						print("</td>");*/

						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($num_of_paper,2));
						print("</td>");
						
						//---------------------รวม(บาท).---
						/*print("<td class='font-style' style='text-align:center;'>");
							print(number_format($total_all,2));
						print("</td>");*/
						//---------------มาตราฐาน.---
						/*print("<td class='font-style' style='text-align:center;'>");
							print(number_format($total_row_distanct,2));
						print("</td>");*/
						//---------------------ใช้จริง.------
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($gas_true,2));
						print("</td>");
						/*print("<td class='font-style' style='text-align:center;'>");
							print(number_format($distanct_stan,2));
						print("</td>");*/
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($distanct_true,2));
						print("</td>");
						print("<td class='font-style' style='text-align:center;'>");
							$new_average = $distanct_true/$gas_true;
								print(number_format($new_average,2));
						print("</td>");
						print("<td class='font-style' style='text-align:center;'>");
						
						print("</td>");
						print("<td class='font-style' style='text-align:center;'>");
							//print(number_format($total_pressure_gas));
						print("</td>");
						print("<td class='font-style' style='text-align:center;'>");
							
						print("</td>");
					
					print("</tr>");
			print("</table>");
				}
			
		
	}
		
?>