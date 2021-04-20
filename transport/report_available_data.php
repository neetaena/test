<?php

		if(empty($_GET['excel'])){
			print("<div class=\"container\">");
				print("<a href=\"excel_report_available.php?date_data=".$date_data."&excel=1\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
		}

				//$get_type = getlist("SELECT * FROM production_order WHERE delivery_date = '".$new_date[0]."' group by product_id");
				
				$query_data = getlist("SELECT * FROM `car_available` where available_date like '$date_data'  group by available_date ");
				// and type_site='1' คือ รถสระบุรี

			
				print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:280mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='5' style='font-size:20px;'>");
						print("<b>รายงานสรุปรถบุญพร สระบุรี</b>");
					print("</td>");
				print("</tr>");
				print("<td align = \"center\" class='font-style' colspan='5' style='font-size:18px;'><b>");
						print("ประจำวันที่ ".printlongSlateThaiDate($date_data));
					print("</td>");
				print("</tr>");
			print("</table>");
			print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:280mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" rowspan='2'><b>วันที่<b></td>");
					print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" rowspan='2'><b>ประเภทรถ<b></td>");
					print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" rowspan='2'><b>เชื้อเพลิง<b></td>");
					print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" rowspan='2'><b>จำนวนรถพร้อมใช้งาน<b></td>");
			        print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" rowspan='2'><b>จำนวนรถซ่อม<b></td>");
			        print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" rowspan='2'><b>จำนวนรวม<b></td>");
			        print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" colspan='2'><b>ไม่มีคนขับ<b></td>");
			        print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" rowspan='2'><b>หมายเหตุ<b></td>");
				print("</tr>");
				print("<tr>");
					 print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" ><b>ลาออก<b></td>");
					  print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"font-style\" ><b>หยุดงาน<b></td>");
				print("</tr>");
				$num=1;
		

				 for($i=0;$i<sizeof($query_data);$i++)
                {
                  $get_detail = getlist("SELECT * FROM `car_available` where available_date like '".$query_data[$i]['available_date']."'");
                  $m = 1;
                  $number_q  = 0;
                  $number_repair  = 0;
                  $total_quantity = 0;
                  $out = 0;
                  $stop = 0;
                  $total = 0;
                  for ($j=0; $j < sizeof($get_detail); $j++) { 
                      print("<tr class=\"font-style\" style=\"border:1px groove;\">");
	                      if($m==1){
	                        print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\" rowspan='".sizeof($get_detail)."'>");//สถานที่ที่ส่ง
	                            print($get_detail[$j]['available_date']);
	                        print("</td>");
	                       $m = 0;
	                      }
	                      print("<td align = \"left\" style = \"width:10mm;padding-left:5px;\" class=\"body_table\">");//สถานที่ที่ส่ง
	                      $type = getlist("SELECT * FROM car_type_available where car_type_id='".$get_detail[$j]['car_type']."'");
	                          print($type[0]['car_type_name']);
	                      print("</td>");
	                      print("<td align = \"left\" style = \"width:10mm;padding-left:5px;\" class=\"body_table\">");//สถานที่ที่ส่ง
	                      $type = getlist("SELECT * FROM car_type_available where car_type_id='".$get_detail[$j]['car_type']."'");
	                          print($type[0]['car_type_fule']);
	                      print("</td>");
	                      print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">");//สถานที่ที่ส่ง
	                          print($get_detail[$j]['available_number']);
	                          $number_q += $get_detail[$j]['available_number'];
	                      print("</td>");
	                      print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">");//สถานที่ที่ส่ง
	                          print($get_detail[$j]['repair_number']);
	                          $number_repair += $get_detail[$j]['repair_number'];
	                      print("</td>");

	                       print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">");//สถานที่ที่ส่ง
	                          print($get_detail[$j]['repair_number']+$get_detail[$j]['available_number']);
	                          $total_quantity += $get_detail[$j]['repair_number']+$get_detail[$j]['available_number'];
	                          $total += $total_quantity;
	                      print("</td>");

	                       print("<td align = \"left\" style = \"width:10mm;padding-left:5px;\" class=\"body_table\">");//สถานที่ที่ส่ง
	                          print($get_detail[$j]['out_employee']);
	                          $out += $get_detail[$j]['out_employee'];
	                      print("</td>");

	                       print("<td align = \"left\" style = \"width:10mm;padding-left:5px;\" class=\"body_table\">");//สถานที่ที่ส่ง
	                          print($get_detail[$j]['stop_employee']);
	                          $stop += $get_detail[$j]['stop_employee'];
	                      print("</td>");

	                      print("<td align = \"left\" style = \"width:10mm;padding-left:5px;\" class=\"body_table\">");//สถานที่ที่ส่ง
	                          print($get_detail[$j]['note']);
	                      print("</td>");
          
                     print("</tr>");
                 		}
                 		 print("<tr class=\"font-style\" style=\"border:1px groove;\">");
                 		 		 print("<th align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\" colspan='3'>");
                 		 		 	print("รวม");
                 		 		 print("</th>");
                 		 		 print("<th align = \"left\" style = \"width:10mm;padding-left:5px;text-align:center;\" class=\"body_table\">");//สถานที่ที่ส่ง
                 		 		 	print($number_q);
                 		 		 print("</th>");
                 		 		  print("<th align = \"left\" style = \"width:10mm;padding-left:5px;text-align:center;\" class=\"body_table\">");//สถานที่ที่ส่ง
                 		 		  	print($number_repair);
                 		 		 print("</th>");
                 		 		  print("<th align = \"left\" style = \"width:10mm;padding-left:5px;text-align:center;\" class=\"body_table\">");//สถานที่ที่ส่ง
                 		 		  	print($number_q+$number_repair);
                 		 		 print("</th>");
                 		 

                 		 		 print("<th align = \"left\" style = \"width:10mm;padding-left:5px;text-align:center;\" class=\"body_table\">");//สถานที่ที่ส่ง
                 		 		  	print($out);
                 		 		 print("</th>");
 
                 		 		 print("<th align = \"left\" style = \"width:10mm;padding-left:5px;text-align:center;\" class=\"body_table\">");//สถานที่ที่ส่ง
                 		 		  	print($stop);
                 		 		 print("</th>");
                 		 		  print("<th align = \"left\" style = \"width:10mm;padding-left:5px;text-align:center;\" class=\"body_table\">");//
                 		 		   print("</th>");
                 		 print("</tr>");
                 		
                }
				
				
			print("</table>");
				
			
		
	
		
?>