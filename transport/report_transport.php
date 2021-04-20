<meta http-equiv = "Content-Type" content="text/html; charset = utf-8" />
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
				font-size:16px;"
			}
		</style>
	</head>
<?php
@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");
	//@ini_set('display_errors', '0');

		$datein = $_POST['datein'];
		$dateout = $_POST['dateout'];

		$get_boonpon_id = getlist("SELECT boonpon_id,delivery_date FROM production_order WHERE delivery_date between '$datein' and '$dateout' GROUP BY boonpon_id,delivery_date");

		//$getDriver = getlist("SELECT * FROM insertdata_transport as it INNER JOIN production_order as po on it.boonpon_id=po.boonpon_id WHERE delivery_date between '$datein' and '$dateout'");
	
	
	print("<div class=\"container\">");
				print("<a href=\"excel_report_transport_for_acc.php?datein=".$datein."&dateout=".$dateout."\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");

		print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:350mm;empty-cells: show;\">");
			print("<tr>");
				print("<td align = \"center\" class='font-style'><b>บริษัท วนชัย กรุ๊ป จำกัด (มหาชน)<br>");
					print("รายงานการขนส่งสินค้า โดย รถข่นส่งบุญพรข่นส่ง");
				print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td align = \"center\" class='font-style'><b>");
					print("ระหว่างวันที่ ".printlongSlateThaiDate($datein)."  ถึง  ".printlongSlateThaiDate($dateout));
				
				print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td align = \"left\" class='font-style'><b>");
					
				print("</td>");
			print("</tr>");
		print("</table>");
		print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:350mm;empty-cells: show;\">");
			print("<tr>");
				print("<td align = \"center\" class='font-style' style='width:2%;'><b> ");
					print("ลำดับ");
				print("</td>");
				print("<td align = \"center\" class='font-style'  style='width:20%;'><b>");
					print("ชื่อลูกค้า");
				print("</td>");
				print("<td align = \"center\" class='font-style'  style='width:10%;'><b>");
					print("สถานที่จัดส่ง");
				print("</td>");
				print("<td align = \"center\" class='font-style'  style='width:5%;'><b>");
					print("ระยะทาง");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width7%;'><b>");
					print("เลขที่ใบกำกับภาษี/ใบส่งของ");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:18%;'><b>");
					print("รายละเอียด");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:4%;'><b>");
					print("ตั้ง");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:4%;'><b>");
					print("แผ่น");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:4%;'><b>");
					print("คิว(MDF/PB)");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:4%;'><b>");
					print("เลขที่");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:9%;'><b>");
					print("ประเภทรถ");
				print("</td>");
				
				print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
					print("ทะเบียนรถ");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
					print("ประเภทเชื้อเพลิง");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
					print("วันที่ส่งสินค้า");
				print("</td>");
				print("<td align = \"center\" class='font-style' style='width:5%;'><b>");
					print("จำนวนน้ำมันที่เติม(ลิตร)");
				print("</td>");
			print("</tr>");
			$num=1;
			for ($i=0; $i < sizeof($get_boonpon_id); $i++) 
			{ 
				if(!empty($get_boonpon_id[$i]['boonpon_id']))
				{
					print("<tr>");
	//---------------------------------------------------------------ลำดับ---------------------------------------------------------------
						print("<td  class='font-style' style='text-align:center;'>");
							print($num);
							$num++;
						print("</td>");
	//---------------------------------------------------------------ชื่อลูกค้า---------------------------------------------------------------
						print("<td class='font-style' style='padding-left:5px;'>");
						$get_data = getlist("SELECT * FROM production_order as p inner join type_production as t on p.product_id=t.id_production WHERE boonpon_id='".$get_boonpon_id[$i]['boonpon_id']."' and delivery_date ='".$get_boonpon_id[$i]['delivery_date']."'");

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
	//---------------------------------------------------------------ระยะทาง---------------------------------------------------------------
						print("<td  class='font-style' style='text-align:center;'>");
						
							
						for($c=0;$c<sizeof($ship);$c++)
						{
								$get_custoemr = getlist("SELECT * FROM shipping WHERE id_ship='".$ship[$c]."'");

								print($get_custoemr[0]['distanct']);
								if(!empty($ship[$c+1])){
									print "<br>";
								}
						}
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
	//---------------------------------------------------------------คำอธิบาย---------------------------------------------------------------
						print("<td  class='font-style'  style='padding-left:5px;'>");

							for($in=0; $in < sizeof($get_data); $in++) { 


								if($get_data[$in]['product_id']==6){
											print "บัวตัวจบ ".$get_data[$in]['plate']." ".$get_data[$in]['item_number']." ".$get_data[$in]['mark_name'].$get_data[$in]['box_name'];//รายการ	
									}elseif($get_data[$in]['product_id']==4 or $get_data[$in]['product_id'] ==8){
										print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['plate']." เซาะ ".$get_data[$in]['type_w'];//รายการ	
									}elseif($get_data[$in]['product_id']==3 or $get_data[$in]['product_id'] ==5){
										print $get_data[$in]['type_w']." ".$get_data[$in]['item_number']." ".$get_data[$in]['type_mark']."".$get_data[$in]['mark_name'].$get_data[$in]['side']." ".$get_data[$in]['plate']." ".$get_data[$in]['gule'];//รายการ	
									}else{
										print  $get_data[$in]['detail_production']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule'];//รายการ	
									}


								
								if(!empty($get_data[$in+1]['detail_production']))
								{
									print("<br>");
								}
								
							}

							
						print("</td>");
	//---------------------------------------------------------------ตั้ง---------------------------------------------------------------
						print("<td  class='font-style' style='text-align:center;'>");
						
							
							for ($in=0; $in < sizeof($get_data); $in++) {

								print  $get_data[$in]['counts'];//รายการ
									
									if(!empty($get_data[$in+1]['counts']))
									{
										print("<br>");
									}
									
								}
						print("</td>");
	//---------------------------------------------------------------แผ่น---------------------------------------------------------------
						print("<td  class='font-style' style='text-align:center;'>");
						
							for ($in=0; $in < sizeof($get_data); $in++) { 
								print number_format(ABS($get_data[$in]['quantity'])); //แผ่น
								if(!empty($get_data[$in+1]['quantity']))
								{
									print("<br>");
								}
							}
						print("</td>");
	//---------------------------------------------------------------คิว---------------------------------------------------------------
						print("<td  class='font-style' style='text-align:center;'>");
					
								for ($g=0; $g < sizeof($get_data); $g++) 
								{
										if($get_data[$g]['product_id']==1 || $get_data[$g]['product_id']==2){
											$size_data = explode("x", $get_data[$g]['item_number']);
											$q = (($size_data[0]*$size_data[1]*$size_data[2])/1000000000)*$get_data[$g]['quantity'];
											print  number_format($q,2);//แผ่น
											$total_q += $q;

											$total_quantity += $get_data[$g]['quantity'];
											if(!empty($get_data[$g+1]['quantity'])){
												print("<br>");
											}
										}
								
						
								}
						print("</td>");
	//---------------------------------------------------------------เลขที่---------------------------------------------------------------
						print("<td  class='font-style' style='text-align:center;'>");
							print $get_boonpon_id[$i]['boonpon_id'];
						print("</td>");
	//---------------------------------------------------------------ประเภทรถ---------------------------------------------------------------
						print("<td class='font-style' style='text-align:center;'>");
							$get_transport = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$get_boonpon_id[$i]['boonpon_id']."'");
							
							$get_car_detail = getlist("SELECT * FROM car_detail as cd inner join car_head as ch on cd.typecar=ch.id_hcar WHERE id_car='".$get_transport[0]['idcar']."'");

							print($get_car_detail[0]['detailhcar']);
						print("</td>");
	//---------------------------------------------------------------ทะเบียน---------------------------------------------------------------
						print("<td  class='font-style' style='text-align:center;'>");
						
							
							print($get_car_detail[0]['licenceplates']." ".$get_car_detail[0]['licenceplate2']);
						print("</td>");
	//---------------------------------------------------------------เชื้อเพลิง---------------------------------------------------------------
						print("<td class='font-style' style='text-align:center;'>");
							print($get_car_detail[0]['typefule']);
						print("</td>");
	//---------------------------------------------------------------วันที่ส่ง---------------------------------------------------------------
						print("<td  class='font-style' style='text-align:center;'>");
							print(printShortSlateThaiDate($get_boonpon_id[$i]['delivery_date']));
						print("</td>");
	//---------------------------------------------------------------จำนวนน้ำมัน---------------------------------------------------------------
						print("<td class='font-style' style='text-align:center;'>");
							print($get_transport[0]['final']);
							//print($get_boonpon_id[$i]['boonpon_id']);
						print("</td>");
					print("</tr>");
				}
			}
			
		print("</table>");
		
