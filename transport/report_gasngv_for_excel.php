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
				print("<a href=\"excel_report_transport_for_excel.php?datein=".$datein."&dateout=".$dateout."&excel=1\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
		}
		for ($s=0; $s < $DateNum; $s++) 
		{ 
				$new_date_add= add_date($datein,$s,0,0);
				$new_date =explode(" ", $new_date_add);
				$get_type = getlist("SELECT * FROM production_order WHERE delivery_date = '".$new_date[0]."' group by product_id");
				
	
			for ($t=0; $t < sizeof($get_type); $t++) {
				$boonpon_id_data = array();
				$get_boonpon = getlist("SELECT boonpon_id FROM production_order WHERE delivery_date = '".$new_date[0]."' and product_id='".$get_type[$t]['product_id']."' GROUP BY boonpon_id");
				for ($p=0; $p <sizeof($get_boonpon) ; $p++) { 
					if(!empty($get_boonpon[$p]['boonpon_id'])){
						if(!in_array($get_boonpon[$p]['boonpon_id'],$boonpon_id_data)){
						$boonpon_id_data[] = $get_boonpon[$p]['boonpon_id'];
						}
					}
					
				}

				if(!empty($boonpon_id_data)){
				print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:350mm;empty-cells: show;\">");
				print("<tr>");
					print("<td  class='font-style' colspan='11'>");
					$get_type_name = getlist("SELECT * FROM type_production WHERE id_production='".$get_type[$t]['product_id']."'");
						print("เรื่องรายงานค่าใช้จ่าย Gas NGV ประจำวันที่ ".printlongSlateThaiDate($new_date[0])." ".$get_type_name[0]['detail_production']);
					print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td  class='font-style' colspan='11'>");
						print("เรียนเจ้าหน้าที่บริหารงาน บริษัทบุญพร ขนส่ง ");
					
					print("</td>");
				print("</tr>");
				
			print("</table>");
			print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:350mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"center\" class='font-style' style='width:2%;' ><b> ");
						print("ลำดับ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("ทะเบียนรถ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("พขร.");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:9%;'><b>");
						print("ประเภทรถ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:7%;'><b>");
						print("เลขที่ใบกำกับภาษี/ใบส่งของ");
					print("</td>");

					print("<td align = \"center\" class='font-style'  style='width:20%;'><b>");
						print("ชื่อลูกค้า");
					print("</td>");
					print("<td align = \"center\" class='font-style'  style='width:10%;'><b>");
						print("สถานที่จัดส่ง");
					print("</td>");
		
			
					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("ใบกำกับ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:5%;' ><b>");
						print("ใบส่งของ");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("ใบโอนสินค้า");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("ผู้รับ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("หมายเหตุ");
					print("</td>");

				print("</tr>");
				
				$num=1;
		

				for ($i=0; $i < sizeof($boonpon_id_data); $i++) 
				{
					
						$get_data = getlist("SELECT * FROM production_order WHERE delivery_date = '".$new_date[0]."' and boonpon_id='".$boonpon_id_data[$i]."' and product_id='".$get_type[$t]['product_id']."'");

						$get_transport = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$boonpon_id_data[$i]."'");
						$get_driver = getlist("SELECT * FROM driver WHERE id_driver='".$get_transport[0]['nameDriver']."'");
						$get_car_detail = getlist("SELECT * FROM car_detail as cd inner join car_head as ch on cd.typecar=ch.id_hcar WHERE id_car='".$get_transport[0]['idcar']."'");

						print("<tr>");
		//---------------------------------------------------------------ลำดับ---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:center;'>");
								print($num);
								$num++;
							print("</td>");
		//---------------------------------------------------------------ทะเบียน---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:center;padding-left:2px;'>");
								print($get_car_detail[0]['licenceplates']." ".$get_car_detail[0]['licenceplate2']);
							print("</td>");
		//---------------------------------------------------------------พขร.---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:left;'>");
								print($get_driver[0]['namedriver1']);
							print("</td>");
		//---------------------------------------------------------------ประเภทรถ---------------------------------------------------------------
							print("<td class='font-style' style='text-align:center;'>");
								

								print($get_car_detail[0]['detailhcar']);
							print("</td>");
		//---------------------------------------------------------------invoice---------------------------------------------------------------
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

									print($get_custoemr[0]['detailship']);
									if(!empty($ship[$c+1])){
										print "<br>";
									}
							}
								
							print("</td>");
					//---------------------------------------------------------------ประเภทรถ---------------------------------------------------------------
							print("<td class='font-style' style='text-align:center;'>");
								print("");
							print("</td>");
							print("<td class='font-style' style='text-align:center;'>");
								print("");
							print("</td>");
							print("<td class='font-style' style='text-align:center;'>");
								print("");
							print("</td>");
							print("<td class='font-style' style='text-align:center;'>");
								print("");
							print("</td>");
							print("<td class='font-style' style='text-align:center;'>");
								print("");
							print("</td>");

						print("</tr>");
					
				}
				
			print("</table>");
				}
			
		}
	}
		
?>