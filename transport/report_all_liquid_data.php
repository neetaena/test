<?php

		if(empty($_GET['excel'])){
			print("<div class=\"container\">");
				print("<a href=\"excel_report_all_liquid.php?datein=".$datein."&dateout=".$dateout."&excel=1&license_plate=$license_plate\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
		}
			print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:280mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='11'>");
						print("ตารางการตรวจสอบของเหลวและอื่นๆ ของรถขนส่งสินค้าประจำวัน บริษัท บุญพรขนส่ง จำกัด");
					print("</td>");
				print("</tr>");
				
			print("</table>");
			print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:280mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"center\" class='font-style' style='width:2%;' rowspan='2'><b> ");
						print("ลำดับ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("ทะเบียนรถ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:8%;' rowspan='2'><b>");
						print("ชื่อ-นามสกุล");
					print("</td>");

			
					print("<td align = \"center\" class='font-style' style='width:5%;' colspan='3'><b>");
						print("ระดับGAS.ที่เติมเข้ามา(Bar)");
					print("</td>");
					
					print("<td align = \"center\" class='font-style' style='width:5%;' rowspan='2'><b>");
						print("วันที่ทำการตรวจเช็ค");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:8%;' rowspan='2'><b>");
						print("เวลาที่ทำการตรวจเช็ค");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:8%;' rowspan='2'><b>");
						print("ลงชื่อพนักงานขับรถ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:8%;' rowspan='2'><b>");
						print("ลงชื่อผู้ตรวจสอบ");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:8%;' rowspan='2'><b>");
						print("หมายเหตุ");
					print("</td>");

					
				print("</tr>");
				print("<tr>");
					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("ต่ำ(60-165)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("กลาง(166-185)");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
						print("สูง(186-200)");
					print("</td>");

				print("</tr>");
				$num=1;
	

				//$liquid = getlist("SELECT p.boonpon_id FROM production_order as p inner join insertdata_transport as i on p.boonpon_id=i.boonpon_id inner join car_detail as c on i.idcar=c.id_car WHERE delivery_date between '".$datein."' and '$dateout' and typefule='NGV' GROUP BY p.boonpon_id");

				$liquid = getlist("SELECT * FROM gas_ngv as  p inner join insertdata_transport as i on p.boonpon_id=i.boonpon_id  inner join car_detail as c on i.idcar=c.id_car WHERE date_check between '$datein' and '$dateout' ");

				 //print("SELECT * FROM gas_ngv as  p inner join insertdata_transport as i on p.boonpon_id=i.boonpon_id  inner join car_detail as c on i.idcar=c.id_car WHERE date_check between '$datein' and '$dateout' ");

				for ($i=0; $i < sizeof($liquid); $i++) 
				{
					$gas_max = "";
					$gas_center = "";
					$gas_min = "";
					print("<tr>");
		//---------------------------------------------------------------ลำดับ---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:center;'>");
								print($num);
								$num++;
							print("</td>");
		//---------------------------------------------------------------ทะเบียน---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:center;padding-left:2px;'>");
								print($liquid[$i]['licenceplates']);
							print("</td>");
		//---------------------------------------------------------------พขร.---------------------------------------------------------------
							print("<td  class='font-style' style='text-align:left;padding-left:5px;'>");

							$name = getlist("SELECT * FROM driver WHERE id_driver='".$liquid[$i]['nameDriver']."'");
								print($name[0]['namedriver1']);
							print("</td>");

							if($liquid[$i]['pressure_gas']>=186){
								$gas_max = $liquid[$i]['pressure_gas'];
							}elseif($liquid[$i]['pressure_gas']>=166){
								$gas_center = $liquid[$i]['pressure_gas'];
							}else{
								$gas_min = $liquid[$i]['pressure_gas'];
							}

							print("<td class='font-style' style='text-align:center;'>");
								print($gas_min);
							print("</td>");

							print("<td class='font-style' style='text-align:center;'>");
								print($gas_center);
							print("</td>");

							print("<td class='font-style' style='text-align:center;'>");
								print($gas_max);
							print("</td>");

							print("<td class='font-style' style='padding-left:5px;'>");
								print($liquid[$i]['date_check']);
							print("</td>");


							print("<td class='font-style' style='padding-left:5px;'>");
								print($liquid[$i]['time_check']);
							print("</td>");

							print("<td class='font-style' style='padding-left:5px;'>");
								
							print("</td>");

							print("<td class='font-style' style='text-align:center;'>");
								
							print("</td>");
							print("<td class='font-style' style='padding-left:5px;'>");
								print($liquid[$i]['note']);
							print("</td>");



						print("</tr>");
					
				}
					
		
					print("</tr>");
			print("</table>");
				
			
		
		
?>