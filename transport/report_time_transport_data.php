<?php
 function TimeDiff($strTime1,$strTime2)
		 {
					return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
		 }
$sq = date('Y-m-d H:i:s');
$aaaeee = date('Y-m-d H:i:s', strtotime('+120 minutes', strtotime($sq)));// บวกเวลา ไปอีก 120 นาที ( จากเวลาปัจจุบัน )


		if(empty($_GET['excel'])){
			print("<div class=\"container\">");
				print("<a href=\"excel_report_time_transport.php?datein=".$datein."&dateout=".$dateout."&excel=1\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
		}

		$ok_driver =0;
		$not_driver=0;
		$drop_ok =0;
		$drop_not_ok = 0;
		$total_round =0;
	$get_time = getlist("SELECT * FROM `production_order` as p INNER JOIN gas_ngv as g ON p.boonpon_id=g.boonpon_id WHERE delivery_date BETWEEN '".$datein."' and '".$dateout."'  GROUP BY  p.boonpon_id");

	for ($g=0; $g < sizeof($get_time); $g++) { 
		if(!empty($get_time[$g]['to_customer']) ){
			$new_time_drop = date('H:i:s', strtotime('+120 minutes', strtotime($get_time[$g]['due_customer'])));// บวกเวลา ไปอีก 120 นาที ( จากเวลาปัจจุบัน )

			$diff_due = TimeDiff($get_time[$g]['due_customer'],$get_time[$g]['to_customer']);
	 		$diff_drop = TimeDiff($new_time_drop,$get_time[$g]['start_down']);
//print($new_time_drop.$get_time[$g]['start_down']." ".$diff_drop."<br>");
			if($diff_drop <= 0){
				$drop_ok+=1;
			}else{
				$drop_not_ok +=1;
			}

			
			if($diff_due <=0){
				$ok_driver+=1;
			}else{
				$not_driver +=1;
			}
			$total_round +=1;
		}
	}
	// 
	
			
				print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:180mm;empty-cells: show;\">");
				print("<tr style='text-align:center;'>");
					print("<td  class='font-style' style='font-size:20px;' colspan='4'>");
					//$get_type_name = getlist("SELECT * FROM type_production WHERE id_production='".$get_type[$t]['product_id']."'");
						print("<b>รายงานเวลาไปส่งสินค้าลูกค้า <br> ระหว่างวันที่ ".printlongSlateThaiDate($datein)." ถึง ".printlongSlateThaiDate($dateout)."</b>");
					print("</td>");
				print("</tr>");
				
			print("</table>");
			print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:180mm;empty-cells: show;\">");
				print("<tr>");
					print("<td align = \"center\" class='font-style' style='width:20%;'><b> ");
						print("จำนวนเที่ยววิ่งทั้งหมด");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:25%;'><b>");
						print("รายการ");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:15%;'><b>");
						print("ประเภท");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:15%;'><b>");
						print("เที่ยว");
					print("</td>");

					print("<td align = \"center\" class='font-style' style='width:15%;'><b>");
						print(" %");
					print("</td>");

				print("</tr>");

				print("<tr>");
					print("<td align = \"center\" class='font-style' rowspan='4'><b> ");
						print($total_round);
					print("</td>");

					print("<td  class='font-style' style='padding-left:5px;' rowspan='2'><b>");
						print("ไปถึงก่อนเวลาที่ลูกค้านัดหมาย");
					print("</td>");

					print("<td align = \"center\" class='font-style' ><b>");
						print("ทัน");
					print("</td>");

					print("<td align = \"center\" class='font-style' ><b>");
						print($ok_driver);
					print("</td>");

					$percent_ok =($ok_driver/$total_round)*100;
					print("<td align = \"center\" class='font-style'><b>");
						print(number_format($percent_ok,2)."%");
					print("</td>");

				print("</tr>");


				print("<tr>");
				
					print("<td align = \"center\" class='font-style' ><b>");
						print("ไม่ทัน");
					print("</td>");
					print("<td align = \"center\" class='font-style'><b>");
						print($not_driver);
					print("</td>");
					$percent_not_ok =($not_driver/$total_round)*100;
					print("<td align = \"center\" class='font-style' ><b>");
						print(number_format($percent_not_ok,2)."%");
					print("</td>");

				print("</tr>");

				print("<tr>");
					
					print("<td class='font-style' style='padding-left:5px;'  rowspan='2'><b>");
						print("ลูกค้าลงสินค้า นับจากเวลานัด");
					print("</td>");

					print("<td align = \"center\" class='font-style' ><b>");
						print("ภายใน 2 ซม.");
					print("</td>");

					print("<td align = \"center\" class='font-style' ><b>");

						print($drop_ok);
					print("</td>");
					$percent_drop_ok =($drop_ok/$total_round)*100;
					print("<td align = \"center\" class='font-style' ><b>");
							print(number_format($percent_drop_ok,2)."%");
					print("</td>");

				print("</tr>");

				print("<tr>");
					print("<td align = \"center\" class='font-style' ><b>");
						print("เกิน 2 ซม.");
					print("</td>");
								print("<td align = \"center\" class='font-style' ><b>");
						print($drop_not_ok);
					print("</td>");
					$percent_drop_not_ok =($drop_not_ok/$total_round)*100;
					print("<td align = \"center\" class='font-style' ><b>");
						print(number_format($percent_drop_not_ok,2)."%");
					print("</td>");

				print("</tr>");
			
				$num=1;
		
	
			print("</table>");
				

?>
