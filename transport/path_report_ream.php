<?php

$datein = $_GET['datein'];
$dateout = $_GET['dateout'];
$namedriver = $_GET['namedriver'];

$search[0] = !empty($namedriver) ? "license_name ='".$namedriver."'" : "";
$search[1] = !empty($datein) ? "ream_date between '".$datein."' and '".$dateout."'" : "";
  $where_data ="";
        for ($s=0; $s < sizeof($search); $s++) { 
              if(!empty($search[$s]))
                  {
                      if(empty($where_data))
                      {
                          $where_data =   " where ".$search[$s];
                      }else{
                          $where_data .= " and ".$search[$s];
                      }
                  }
        }
	print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:280mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"center\"  colspan='14'>");
						print("รายงานการเบิกวัสดุประจำรถ");
					print("</td>");
				print("</tr>");

				print("<tr>");
					print("<td align = \"center\"  colspan='14'><b>");
						print("ระหว่างวันที่ ".printlongSlateThaiDate($datein)."  ถึง ".printlongSlateThaiDate($dateout));
					print("</td>");
				print("</tr>");
			print("</table>");
print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:280mm;empty-cells: show;font-size:20px;font-family: angsana new;\">");
				print("<tr>");
	
					print("<td align = \"center\"  style='width:5%;' ><b>");
						print("ทะเบียน");
					print("</td>");

					print("<td align = \"center\"  style='width:8%;'><b>");
						print("วันที่");
					print("</td>");

					print("<td align = \"center\"   style='width:14%;'><b>");
						print("รายการ");
					print("</td>");
					print("<td align = \"center\"   style='width:7%;'><b>");
						print("จำนวน");
					print("</td>");
			
					print("<td align = \"center\" style='width:5%;'><b>");
						print("หน่วย");
					print("</td>");
				print("</tr>");
				$get_data = getlist("SELECT * FROM ream_asset $where_data");
				//print("SELECT * FROM ream_asset $where_data");
				for ($k=0; $k < sizeof($get_data); $k++) 
				{
						print("<tr>");
							print("<td>");
								print($get_data[$k]['license_name']);
							print("</td>");
							print("<td>");
								print($get_data[$k]['ream_date']);
							print("</td>");
							print("<td>");
								print($get_data[$k]['list_data']);
							print("</td>");
							print("<td>");
								print($get_data[$k]['quantity']);
							print("</td>");
							print("<td>");
								print($get_data[$k]['unit']);
							print("</td>");
				
						print("</tr>");
				}
print("</table>");

?>