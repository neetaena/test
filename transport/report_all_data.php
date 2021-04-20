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

		$date_in = $_POST['datein'];
		$date_out = $_POST['dateout'];
		$product_id = $_POST['product_id'];
			function nextPage(){
				print ("</table>");
				print("<div style=\"float: right;margin-top: 5px;\">FM-SW-W09</div>");
				print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");

			}	
			
			/*print("<div class=\"container\">");
				print("<a href=\"excel_report_transport.php?datein=".$date_in."&dateout=$date_out&product_id=$product_id\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");*/
		
		function head($wood){
			global $date_in,$date_out;

		print("<table  bgcolor = \"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:180mm;empty-cells: show;\">");
			print("<tr>");
				print("<td align = \"center\" style = \"width:30mm;\" class='font-style'><b>");
				print("บริษัท วนชัย กรุ๊ป จำกัด (มหาชน)<br>ใบสั่งงานขนส่ง");
					print $wood;
				print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td align = \"center\" style = \"width:30mm;\" class='font-style'><b>");
						if(!empty($date_in)){
							
							print  printShortSlateThaiDate($date_in)." ถึง ".printShortSlateThaiDate($date_out);
						}
				print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td align = \"left\" style = \"width:30mm;\" class='font-style'><b>");
				
				print("</td>");
			print("</tr>");
		print("</table>");
	}
		function headdetail($product){

		print("<table  bgcolor = \"#FFFFFF\" border =\"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:280mm;empty-cells: show;border: 1px groove;\">");
				print("<tr>");
					print("<td align = \"center\" rowspan=\"2\" style = \"width:10mm;\" class='font-style'>");
						print("ที่");
					print("</td>");
					print("<td align = \"center\" rowspan=\"2\" style = \"width:10mm;\" class='font-style'>");
						print("วันที่ส่งของ");
					print("</td>");
					print("<td align = \"center\" rowspan=\"2\" style = \"width:20mm;\" class='font-style'>");
						print("เลขที่ใบสั่ง (ขาย / โอน) ");
					print("</td>");
					print("<td align = \"center\" rowspan=\"2\" style = \"width:20mm;\" class='font-style'>");
						print("เลขที่ใบโอน/ส่งของใบกำกับภาษี");
					print("</td>");
					
					print("<td align = \"center\" rowspan=\"2\" style = \"width:30mm;\" class='font-style'>");
						print("รายการสินค้า");
					print("</td>");
					
					print("<td align = \"center\" rowspan=\"2\" style = \"width:30mm;\" class='font-style'>");
						print("ชื่อลูกค้า");
					print("</td>");

						$not_show = array(4,6,7,8);
						$check = data_in_array($product,$not_show);
						if($check==1){
							print("<td align = \"center\" colspan=\"4\" style = \"width:30mm;\" class='font-style'>");
								print("จำนวน");
							print("</td>");
						}else{
							print("<td align = \"center\" colspan=\"3\" style = \"width:30mm;\" class='font-style'>");
								print("จำนวน");
							print("</td>");
						}
					
					print("<td align = \"center\" rowspan=\"2\" style = \"width:10mm;\" class='font-style'>");
						print("ช่องวางไม้");
					print("</td>");
					print("<td align = \"center\" rowspan=\"2\" style = \"width:30mm;\" class='font-style'>");
						print("สถานที่จัดส่ง");
					print("</td>");
					print("<td align = \"center\" colspan=\"2\" style = \"width:30mm;\" class='font-style'>");
						print("บรรทุกโดย");
					print("</td>");
					print("<td align = \"center\" rowspan=\"2\" style = \"width:20mm;\" class='font-style'>");
						print("หมายเหตุ");
					print("</td>");
					print("<td align = \"center\" rowspan=\"2\" style = \"width:9mm;\" class='font-style'>");
						print("เวลา");
					print("</td>");
					
					if($product==1 || $product==2){
					
					print("<td align = \"center\" rowspan=\"2\" style = \"width:10mm;\" class='font-style'>");
						print("คิว");
					print("</td>");
					
					}
					
					print("<td align = \"center\" rowspan=\"2\" style = \"width:3mm;\" class='font-style'>");
						print("กลุ่ม");
					print("</td>");
				print("<tr>");
						if($check==1){
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>แผ่น</td>");
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>กล่อง</td>");
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>พาเลท</td>");
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>เศษกล่อง</td>");
						}else{
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>แผ่น</td>");
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>(ตั้ง)</td>");
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>เศษ(แผ่น)</td>");
						}
					
					print("<td align = \"center\" style = \"width:15mm;\" class='font-style'>พขร.</td> ");
					print("<td align = \"center\" style = \"width:15mm;\" class='font-style'>ทะเบียน</td>");
				print("</tr>");

			}
	
	$where_data = "";
	$search[0] = !empty($date_in) ? "delivery_date between '$date_in' and '$date_out'" : "";
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
			$not_show = array(4,6,7,8);
			$check_fl = data_in_array($get_type[$ty]['product_id'],$not_show);

				$cut_start_date = explode("-", $date_in);
				$DateStart = $cut_start_date[2];	//วันเริ่มต้น
				$MonthStart = $cut_start_date[1];	//เดือนเริ่มต้น
				$YearStart = $cut_start_date[0];	//ปีเริ่มต้น

				$cut_end_date = explode("-", $date_out);
				$DateEnd = $cut_end_date[2];	//วันสิ้นสุด
				$MonthEnd = $cut_end_date[1];	//เดือนสิ้นสุด
				$YearEnd = $cut_end_date[0];	//ปีสิ้นสุด

				$End = mktime(0,0,0,$MonthEnd,$DateEnd,$YearEnd);
				$Start = mktime(0,0,0,$MonthStart ,$DateStart ,$YearStart);

				$DateNum=ceil(($End -$Start)/86400); // 28
				$DateNum = $DateNum+1;
			for ($d=0; $d < $DateNum; $d++) 
			{ 
					$new_date = add_date($date_in,$d,0,0);
					$cut_new_date = explode(" ", $new_date);

			$getdata1 = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE delivery_date ='".$cut_new_date[0]."'  and  product_id='".$get_type[$ty]['product_id']."' group by warehouse_id    order by invoice asc");
			
			$next =1;
			for($i=0;$i<sizeof($getdata1);$i++)
			{
				$m = 1;
				$get_new = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production  WHERE warehouse_id ='".$getdata1[$i]['warehouse_id']."' and  product_id='".$get_type[$ty]['product_id']."' and delivery_date ='".$cut_new_date[0]."' ");
				$total_quantity = 0;
				$total_court=0;
				$total_q = 0;
				if(!empty($get_new) && $getdata1[$i]['warehouse_id'] !=""){

					//print $getdata1[$i]['boonpon_id']."<br>";
						print("<tr>");
							print("<td align = \"center\"  style = \"width:10mm;\" class='font-style'>");
								
									print $next;//ที่
									$next++;
								
							print("</td>");
							print("<td align = \"center\"  style = \"width:10mm;\" class='font-style'>");
								
								print(printShortSlateThaiDate($getdata1[$i]['delivery_date']));
								
							print("</td>");


							print("<td align = \"center\" style = \"width:20mm;\" class='font-style'>");
						
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

							print("</td>");
							print("<td align = \"center\" style = \"width:20mm;\" class='font-style'>");
								
			
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
									
								
							print("</td>");
							print("<td align = \"center\" style = \"width:38mm;empty-cells: show;font-family:angsana new;font-size:14px;text-align: left;\">");
								
									for ($g=0; $g < sizeof($get_new); $g++) 
									{
										if($getdata1[$i]['product_id']==6 || $getdata1[$i]['product_id']==7){
											print "บัวตัวจบ ".$get_new[$g]['plate']." ".$get_new[$g]['item_number']." ".$get_new[$g]['mark_name'].$get_new[$g]['box_name'];//รายการ	
										}elseif($getdata1[$i]['product_id']==3 or $getdata1[$i]['product_id'] ==5){
											print $get_new[$g]['type_w']." ".$get_new[$g]['item_number']." ".$get_new[$g]['type_mark']."".$get_new[$g]['mark_name'].$get_new[$g]['side']." ".$get_new[$g]['plate']." ".$get_new[$g]['gule'];//รายการ	
										}elseif($getdata1[$i]['product_id']==4 ){
											print $get_new[$g]['mark_name']." ".$get_new[$g]['item_number']." ".$get_new[$g]['plate']." เซาะ ".$get_new[$g]['type_w'];//รายการ	
										}elseif($getdata1[$i]['product_id'] ==8){
											print $get_new[$g]['mark_name']." ".$get_new[$g]['item_number']." ".$get_new[$g]['gule']." ".$get_new[$g]['side']." ".$get_new[$g]['plate']." เซาะ ".$get_new[$g]['type_w'];//รายการ	
										}else{
											print  $get_new[$g]['detail_production']." ".$get_new[$g]['item_number']." ".$get_new[$g]['gule'];//รายการ	
										}
										
										if(empty($getdata1[$i]['warehouse_id'])){
											
											print("<a onclick = \"window.open('insertdatawarehouse2.php?code_data=".$getdata1[$i]['number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1300,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\"><v style='color:red;'>จัดกลุ่ม</v></a>");
										}
										
										if(!empty($get_new[$g+1]['detail_production']))
										{
											print("<br>");
										}
									}
									
								
							print("</td>");
				
							print("<td  style = \"width:35mm;empty-cells: show;font-family:angsana new;font-size:14px;padding-left: 2px;\">");
									//print $get_new[$g]['name'];
									$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata1[$i]['name']."'");
								print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
								
							print("</td>");
	//////////////////////////////////////////////จำนวนแผ่น/////////////////////////////////////////////////////////////-->		
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>");
								
										for ($g=0; $g < sizeof($get_new); $g++) {
											print  number_format($get_new[$g]['quantity']);//แผ่น
											$total_quantity += $get_new[$g]['quantity'];
											if(!empty($get_new[$g+1]['quantity'])){
												print("<br>");
											}
										}

										//print number_format(ABS($getdata1[$g]['quantity']));//แผ่น
									
								
							print("</td>");
	//////////////////////////////////////////////ตั้ง/////////////////////////////////////////////////////////////-->
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>");
							
								//print number_format($get_new[$g]['counts']) ;
									for ($g=0; $g < sizeof($get_new); $g++) {
											print  number_format($get_new[$g]['counts']);//แผ่น
											$total_court += $get_new[$g]['counts'];
											if(!empty($get_new[$g+1]['counts'])){
												print("<br>");
											}
										}
							
								
							print("</td>");
	//////////////////////////////////////////////พาเลท/////////////////////////////////////////////////////////////-->					
							print("<td align = \"center\" style = \"width:10mm;\" class='font-style'>");
								print ""; 
							print("</td>");
	//////////////////////////////////////////////เศษกล่อง/////////////////////////////////////////////////////////////-->
	
									print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
											print("");
											
									print("</td>");
								
								if($check_fl==1){
									print("<td align = \"center\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:14px;\">");
											
											
											
									print("</td>");
								}


	//////////////////////////////////////////////ช่องวางไม้/////////////////////////////////////////////////////////////-->
							print("<td align = \"center\"   style = \"width:30mm;\" class='font-style'>");
								
									
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

								
							print("</td>");
							print("<td align = \"center\"   style = \"width:15mm;\" class='font-style'>");
								
									//บรรทุกโดย

								$get_transaction = getlist("SELECT * from insertdata_transport where boonpon_id = '".$getdata1[$i]['boonpon_id']."'");
									if(!empty($get_transaction[0]['nameDriver'])){
										$getdriver = getlist("select * from driver where id_driver = '".$get_transaction[0]['nameDriver']."'");
										print $getdriver[0]['namedriver1'];
									}else{
										print "&nbsp";
									}
								
							print("</td>");
							print("<td align = \"center\"   style = \"width:15mm;\" class='font-style'>");
								
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
								
							print("</td>");
							print("<td align = \"center\"  style = \"width:20mm;\" class='font-style'>");//-- หมายเหตุ
							//print $get_new[$g]['note']; 

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
									

								 
							print("</td>");
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
						
							print("<td align = \"center\"  style = \"\" class='font-style'>");//<!-- หมายเหตุ -->
								 //print $get_new[$g]['note']; 

								
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
						print("<td align = \"center\"  style = \"empty-cells: show;font-family:angsana new;font-size:14px;\">");
								 //print $get_new[$g]['note']; 
									print(" ".$getdata1[$i]['warehouse_id']);

								 
							print("</td>");
						print("</tr>");
					
						if(sizeof($get_new)>1){
							print("<tr class='font-style'>");
								print("<td colspan='5'>");
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
								
								if($get_type[$ty]['product_id']==1 || $get_type[$ty]['product_id']==2){
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
									print("<td colspan='9'>");
									print("");
								print("</td>");
								}
							print("</tr>");
						}
						
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
			print("<td colspan=\"13\" style=\"border:0px;\">");
				print("<div style=\"float: right;margin-top: 5px;\">FM-SW-W09</div>");
			print("</td>");
		print("</tr>");
		print("</table>");

	}
	
	print("</html>");