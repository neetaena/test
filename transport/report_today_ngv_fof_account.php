<?php


		if(empty($_GET['excel'])){
			print("<div class=\"container\">");
				print("<a href=\"excel_report_gas_ngv_for_account.php?datein=".$datein."&dateout=".$dateout."&excel=1&today=2\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
		}

				$boonpon_id_data = array();
				$get_boonpon = getlist("SELECT p.boonpon_id FROM production_order as p inner join insertdata_transport as it on p.boonpon_id=it.boonpon_id inner join car_detail as c on it.idcar=c.id_car WHERE delivery_date between '".$datein."' and '$dateout' and typefule='NGV'  and type_site='1' GROUP BY boonpon_id");

				for ($p=0; $p <sizeof($get_boonpon) ; $p++) { 
					if(!empty($get_boonpon[$p]['boonpon_id'])){
						if(!in_array($get_boonpon[$p]['boonpon_id'], $boonpon_id_data))
						{
							
							$boonpon_id_data[] = $get_boonpon[$p]['boonpon_id'];
							
						}
					}
				}
	
			
				if(!empty($boonpon_id_data)){
				print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:350mm;empty-cells: show;\">");
				print("<tr>");
					print("<td  class='font-style' colspan='11'>");
					$get_type_name = getlist("SELECT * FROM type_production WHERE id_production='".$get_type[$t]['product_id']."'");
						print("เรื่องรายงานค่าใช้จ่าย Gas NGV ประจำวันที่ ".printlongSlateThaiDate($datein));
					print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td  class='font-style' colspan='11'>");
						print("เรียนเจ้าหน้าที่บริหารงาน บริษัทบุญพร ขนส่ง  ");
					
					print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='11'><b>");
						print("แผนกพัสดุและคลังสินค้าขอรายงานค่าใช้จ่าย Gas NGV ประจำวันที่ ".printlongSlateThaiDate($datein));
					print("</td>");
				print("</tr>");
			print("</table>");
			print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:350mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"center\" class='font-style' style='width:2%;' rowspan='2'><b> ");
						print("ลำดับ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("วันที่ขนส่ง");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:8%;' rowspan='2'><b>");
						print("พขร.");
					print("</td>");

					/*print("<td align = \"center\" class='font-style' style='width:9%;' rowspan='2'><b>");
						print("ประเภทรถ");
					print("</td>");*/

					/*print("<td align = \"center\" class='font-style' style='width:7%;' rowspan='2'><b>");
						print("เลขที่ใบกำกับภาษี/ใบส่งของ");
					print("</td>");*/

					print("<td align = \"center\" class='font-style'  style='width:17%;' rowspan='2'><b>");
						print("ชื่อลูกค้า");
					print("</td>");
					print("<td align = \"center\" class='font-style'  style='width:10%;' rowspan='2'><b>");
						print("สถานที่จัดส่ง");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("ประเถทสินค้า");
					print("</td>");

						print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("น้ำหนักบรรทุก");
					print("</td>");
			
					print("<td align = \"center\" class='font-style' style='width:5%;' colspan='3'><b>");
						print("ค่าเติมGasรวมVat7%(บาท)");
					print("</td>");
					
				
					
					print("<td align = \"center\" class='font-style' style='width:5%;' colspan='2'><b>");
						print("แก๊สที่ใช้(Kg)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' colspan='2'><b>");
						print("ระยะทาง(Km)");
					print("</td>");
		
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("อัตราใช้แก๊ส(Km/Kg)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("ปั้มที่เติม");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("แรงดันแก๊สก่อนวิ่ง(บาร์)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("หมายเหตุ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("เลขที่ Invoice");
					print("</td>");
		
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("ทะเบียนรถ");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("Invoice เครดิต");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("Invoice เงินสด");
					print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td align = \"center\" class='font-style' style='width:3%;'><b>");
						print("บัตรเครดิต");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:3%;'><b>");
						print("ใช้เงินสด.");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:3%;'><b>");
						print("รวม(บาท).");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:3%;'><b>");
						print("มาตราฐาน.");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:3%;'><b>");
						print("ใช้จริง.");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:3%;'><b>");
						print("มาตราฐาน.");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:3%;'><b>");
						print("ใช้จริง.");
					print("</td>");


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

				for ($i=0; $i < sizeof($boonpon_id_data); $i++) 
				{
					
						$get_data = getlist("SELECT * FROM production_order WHERE delivery_date between '".$datein."' and '$dateout' and boonpon_id='".$boonpon_id_data[$i]."'");

						$get_transport = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$boonpon_id_data[$i]."'");
						$get_driver = getlist("SELECT * FROM driver WHERE id_driver='".$get_transport[0]['nameDriver']."'");
						$get_car_detail = getlist("SELECT * FROM car_detail as cd inner join car_head as ch on cd.typecar=ch.id_hcar WHERE id_car='".$get_transport[0]['idcar']."' ");

						
						print("<tr>");

						
		//---------------------------------------------------------------ลำดับ---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:center;'>");
								print($num);
								$num++;
							print("</td>");
		//---------------------------------------------------------------ทะเบียน---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:center;padding-left:2px;'>");
								print(printNumDate($get_data[0]['delivery_date']));
							print("</td>");

							if(empty($get_data)){
				
								$get_note = getlist("SELECT * FROM driver_note WHERE driver_id = '".$get_transport[0]['nameDriver']."' and note_date = '".$get_data[0]['delivery_date']."'");
								 
								if($get_note)
								{
									print("<td colspan='15' class='font-style' style = \"text-align:center;\">");
								print("<a onclick = \"window.open('add/add_note_driver.php?license=".$get_car_detail[0]['licenceplates']."&note_date=".$get_data[0]['delivery_date']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$get_note[0]['note_description']."</a> ");

								print("</td>");
								}else{
									 
									print("<td colspan='15' style = \"text-align:center;\" class='font-style'>");
									 print("<a onclick = \"window.open('add/add_note_driver.php?license=".$get_car_detail[0]['licenceplates']."&note_date=".$get_data[0]['delivery_date']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\"  class='excel'>เพิ่มหมายเหตุ</a> ");
									 print("</td>");
								}
				
						}else{
		//---------------------------------------------------------------พขร.---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:left;'>");
								print($get_driver[0]['namedriver1']);
							print("</td>");
		//---------------------------------------------------------------ประเภทรถ---------------------------------------------------------------
							/*print("<td class='font-style' style='text-align:center;'>");
								

								print($get_car_detail[0]['detailhcar']);
							print("</td>");*/
		//---------------------------------------------------------------invoice---------------------------------------------------------------
							/*print("<td  class='font-style'  style='padding-left:5px;'>");

								$invoice = array();

								for ($p=0; $p <sizeof($get_data) ; $p++) { 
									if(!in_array($get_data[$p]['invoice'],$invoice)){
										$invoice[] = $get_data[$p]['invoice'];
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
							
							$customer = array();

							for ($p=0; $p <sizeof($get_data) ; $p++) { 
								if(!in_array($get_data[$p]['name'],$customer)){
									$customer[] = $get_data[$p]['name'];
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

							for ($p=0; $p <sizeof($get_data) ; $p++) { 
								if(!in_array($get_data[$p]['delivery_name'],$ship)){
									$ship[] = $get_data[$p]['delivery_name'];
								}
							}
							
							for($c=0;$c<sizeof($ship);$c++)
							{
									$get_custoemr = getlist("SELECT * FROM shipping WHERE id_ship='".$ship[$c]."'");

									print($get_custoemr[0]['country']);
									if(!empty($ship[$c+1])){
										print "<br>";
									}
							}
								
							print("</td>");

							print("<td class='font-style' style='text-align:center;'>");
									$type_product = array();

								for ($p=0; $p <sizeof($get_data) ; $p++) { 
									if(!in_array($get_data[$p]['product_id'],$type_product)){
										$type_product[] = $get_data[$p]['product_id'];
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

							print("</td>");

							$check_data = getlist("SELECT * FROM gas_ngv WHERE boonpon_id='".$boonpon_id_data[$i]."' and data_number='".$get_data[0]['data_number']."'");
			//------------------------------------------นน.บรรทุก-------------------------
							print("<td class='font-style' style='text-align:center;'>");
								print($check_data[0]['wood_weight']);
								$weight_wood +=$check_data[0]['wood_weight'];
							print("</td>");
					//---------------------------------------------------------------ประเภทรถ---------------------------------------------------------------
							print("<td class='font-style' style='text-align:center;'>");

								
								if(!empty($check_data)){
									print("<a onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".number_format($check_data[0]['credit'],2)."</a> ");

									$totol_cradit += $check_data[0]['credit']; 
								}else{
									print("<a class='excel' onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\">เพิ่ม</a> ");
								}
								
								 
							
							print("</td>");
							print("<td class='font-style' style='text-align:center;'>");
								
								if(!empty($check_data)){
									print("<a onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".number_format($check_data[0]['cash'],2)."</a> ");
									$totol_money += $check_data[0]['cash']; 
								}else{
									print("<a class='excel' onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\">เพิ่ม</a> ");
								}
							
							print("</td>");
							print("<td class='font-style' style='text-align:center;'>");
								if(!empty($check_data)){
									print("<a onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".($check_data[0]['credit']+$check_data[0]['cash'])."</a> ");
									$total_all += ($check_data[0]['credit']+$check_data[0]['cash']);
								}else{
									print("<a class='excel' onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\">เพิ่ม</a> ");
								}
								

							
							print("</td>");

							
			
//----------------------------------------------------แก๊สมาตราฐาน--------------
							print("<td class='font-style' style='text-align:center;'>");
									$get_gas = getlist("SELECT * FROM fule_detail WHERE fule_name='NGV' and id_ship='".$ship[0]."' and car_type='".$get_car_detail[0]['id_hcar']."'");
									print($get_gas[0]['standard']);
									$gas_stan += $get_gas[0]['standard'];
							print("</td>");
//------------------------------------------------แก๊สใช้จริง-------------------------
							print("<td class='font-style' style='text-align:center;'>");
									print(number_format($check_data[0]['gas_weight'],2));
									$gas_true += $check_data[0]['gas_weight'];
							print("</td>");
						


			//------------------------------------------ระยะทาง standrad-------------------------
							print("<td class='font-style' style='text-align:center;'>");
						
								for($c=0;$c<sizeof($ship);$c++)
								{
									$get_custoemr = getlist("SELECT * FROM shipping WHERE id_ship='".$ship[$c]."'");
									$distanct_stan += ($get_custoemr[0]['distanct']*2);
									print($get_custoemr[0]['distanct']*2);
									if(!empty($ship[$c+1])){
										print "<br>";
									}
								}
							print("</td>");
			//---------------------------------------------ระยะทางที่วิ่งได้-----
							
							print("<td class='font-style' style='text-align:center;'>");
							$distanct_true += $check_data[0]['distanct'];
									print($check_data[0]['distanct']);

							print("</td>");
		
								print("<td class='font-style' style='text-align:center;'>");
									$average = $check_data[0]['distanct']/$check_data[0]['gas_weight'];
									if($average > 0){
										print(number_format($average,2));	
										$gas_averange += $average;
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
									print("<a onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$check_data[0]['note']."</a> ");
								}else{
									print("<a class='excel' onclick = \"window.open('edit/edit_gas_ngv_2.php?boonpon_id=".$boonpon_id_data[$i]."&data_number=".$get_data[0]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\">เพิ่ม</a> ");
								}	

							
							print("</td>");
							}
							print("<td  class='font-style'  style='padding-left:5px;'>");

								$invoice = array();

								for ($p=0; $p <sizeof($get_data) ; $p++) { 
									if(!in_array($get_data[$p]['invoice'],$invoice)){
										$invoice[] = $get_data[$p]['invoice'];
									}
								}
								
								for($c=0;$c<sizeof($invoice);$c++)
								{
										print($invoice[$c]);
										if(!empty($invoice[$c+1])){
											print "<br>";
										}
								}

								
							print("</td>");
							print("<td  class='font-style' style='text-align:center;padding-left:2px;'>");
								print($get_car_detail[0]['licenceplates']." ".$get_car_detail[0]['licenceplate2']);
							print("</td>");
							print("<td class='font-style' style='text-align:center;'>");
							$get_detail_ngv = getlist("SELECT distinct (credit_invoice) as credit_invoice  FROM gas_ngv_detail WHERE gas_ngv_id='".$check_data[0]['gas_id']."' ");
									for($c=0;$c<sizeof($get_detail_ngv);$c++)
									{
										
										print($get_detail_ngv[$c]['credit_invoice']);
										if(!empty($get_detail_ngv[$c+1]['credit_invoice'])){
											print "<br>";
										}
									}
							print("</td>");

							print("<td class='font-style' style='text-align:center;'>");
							$get_detail_invoice = getlist("SELECT distinct (money_invoice) as money_invoice  FROM gas_ngv_detail WHERE gas_ngv_id='".$check_data[0]['gas_id']."' ");
									for($c=0;$c<sizeof($get_detail_invoice);$c++)
									{
										
										print($get_detail_invoice[$c]['money_invoice']);
										if(!empty($get_detail_invoice[$c+1]['money_invoice'])){
											print "<br>";
										}
									}
							print("</td>");


						print("</tr>");
					
				}
				print("<tr>");
					print("<td class='font-style' style='text-align:center;' colspan='6'>");
							print("รวม");
						print("</td>");
						//-----------น้ำหนักบรรทุก----
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($weight_wood,2));
						print("</td>");
						//--------------บัตรเครดิต---
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($totol_cradit,2));
						print("</td>");
						//--------------ใช้เงินสด.---
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($totol_money,2));
						print("</td>");
						//---------------------รวม(บาท).---
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($total_all,2));
						print("</td>");
						//---------------มาตราฐาน.---
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($total_row_distanct,2));
						print("</td>");
						//---------------------ใช้จริง.------
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($gas_true,2));
						print("</td>");
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($distanct_stan,2));
						print("</td>");
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($distanct_true,2));
						print("</td>");
				
						print("<td class='font-style' style='text-align:center;'>");
						$newaverage = $distanct_true/$gas_true;
							print(number_format($newaverage,2));
						print("</td>");
						print("<td class='font-style' style='text-align:center;'>");
							
						print("</td>");
						print("<td class='font-style' style='text-align:center;'>");
							print(number_format($total_pressure_gas,2));
						print("</td>");
						
						print("<td class='font-style' style='text-align:center;'>");
							
						print("</td>");
				print("</tr>");
			print("</table>");
		
			
		}
	
		
?>