<meta http-equiv="Content-Type" content = "text/html; charset=utf-8" />
<html>
	<head>
		<title>
		รายการใบสั่งขาย รอจัดส่งสินค้าให้กับลูกค้า 
		</title>
		<style type="text/css">
			.head_table
			{
				empty-cells: show;
				font-family:'angsana new';
				font-size:16px;
				text-align: center;
				font-weight: bold;
				
			}
			.body_table{
				empty-cells: show;
				font-family:'angsana new';
				font-size:14px;
			}
		</style>
	</head>
	<?php
		@ini_set('display_errors', '0');
		include("../include/mySqlFunc.php");
		query("USE transport");
			function nextPage(){
				print ("</table>");
				//print("<div style=\"float: right;margin-top: 5px;\">FM-SW-W09</div>");
				print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");

			}	
		$start = $_POST['date_start'];
		$end = $_POST['date_end'];
	?>
	<form action = "" name = "insertquarity" method = "POST">
	<?php
		function head($wood){
			global $start,$end;
	?>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:250mm;empty-cells: show;">
			<tr>
				<td align = "center" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;"><b>
				<?php print("บริษัท วนชัย กรุ๊ป จำกัด (มหาชน)<br>รายการใบสั่งขาย$wood รอจัดส่งสินค้าให้กับลูกค้า<br>"); 
					print("รหว่างวันที่ ".printShortThaiDate($start)." ถึง ".printShortThaiDate($end))?>
				</td>
			</tr>
		
			<tr>
				<td align = "left" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;"><b>
					<?php
						print "";
					?>
				</td>
			</tr>
		</table>
	<?php
	}
		function headdetail(){
			print("<table  bgcolor =\"#FFFFFF\" border = \"1\" cellspacing = \"0\" cellpadding = \"2\" align =\"center\" valign = \"middle\" style=\"width:250mm;empty-cells: show;\">");
			print("<tr >");
				print("<td class=\"head_table\">");
					print("วันออกเอกสาร");
				print("</td>");
				print("<td class=\"head_table\">");
					print("กำหนดวันส่ง");
				print("</td>");
				print("<td class=\"head_table\">");
					print("ลูกค้า");
				print("</td>");
				print("<td class=\"head_table\">");
					print("สถานที่จัดส่ง");
				print("</td>");
				print("<td class=\"head_table\">");
					print("ราคา");
				print("</td>");
				print("<td class=\"head_table\">");
					print("จังหวัด");
				print("</td>");
				print("<td class=\"head_table\">");
					print("เลขที่ใบสั่งขาย");
				print("</td>");
				print("<td class=\"head_table\">");
					print("รายละเอียด");
				print("</td>");
				print("<td class=\"head_table\">");
					print("แผ่น");
				print("</td>");
				print("<td class=\"head_table\">");
					print("ตั้ง");
				print("</td>");
				print("<td class=\"head_table\">");
					print("ม.<sup>3");
				print("</td>");
				print("<td class=\"head_table\">");
					print("ชื่อ Sell");
				print("</td>");
				print("<td class=\"head_table\">");
					print("หมายเหตุ");
				print("</td>");
			print("</tr>");
				
		}
	?>
	<?php
			
			$get_type = getlist("SELECT * FROM another_data WHERE type='2'");
			for ($ty=0; $ty <sizeof($get_type) ; $ty++) { 
				head($get_type[$ty]['size_code']);
				headdetail();
				$where_data ="";
				$code_item = explode(",", $get_type[$ty]['product']);
				for ($c=0; $c < sizeof($code_item); $c++) { 
					if(empty($where_data))
					{
						$where_data = " item_number like '".$code_item[$c]."' and delivery_date between '$start' and '$end'";
					}else{
						$where_data .= " or item_number like '".$code_item[$c]."' and delivery_date between '$start' and '$end'";
					}
				}

			
			$count = 1;
			$getdata = getlist("SELECT * FROM production_order WHERE $where_data  order by delivery_date asc");
			
			for($i=0;$i<sizeof($getdata);$i++){
				
				print("<tr>");
				print("<td style=\"width:15mm;text-align:center;\" class=\"body_table\">");
					//print $getdata[$i]['item_number']; //เลขที่ใบสั่งขาย
					//print $getdata[$i]['crate_date']; //เลขที่ใบสั่งขาย
					print printShortNumDate($getdata[$i]['delivery_date']); //ทดสอบ
				print("</td>");
				print("<td style=\"width:15mm;text-align:center;\" class=\"body_table\">");
					print printShortNumDate($getdata[$i]['delivery_date']); //วันกำหนดส่ง
				print("</td>");
				print("<td style=\"width:30mm;\" class=\"body_table\">");
					$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[$i]['name']."'");
					print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
				print("</td>");
				print("<td style=\"width:30mm;\" class=\"body_table\">");
						$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata[$i]['delivery_name']."'");
					print $get_delivery_name[0]['detailship'];//สถานที่จัดส่ง
				print("</td>");
				print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
					print("");
				print("</td>");
				print("<td style=\"width:10mm;\" class=\"body_table\">");
					print $getdata[$i]['country']; //วันกำหนดส่ง
				print("</td>");
				print("<td style=\"width:10mm;\" class=\"body_table\">");
					print $getdata[$i]['number']; //เลขที่ใบสั่งขาย
				print("</td>");
				print("<td style=\"width:30mm;\" class=\"body_table\">");
					query("USE productionax");
							$query_description = getlist("SELECT * from itemdescription where itemID ='".$getdata[$i]['item_number']."'");					
									print $query_description[0]['detail'];//รายการ
					query("USE transport");
				print("</td>");
				print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
					print ABS($getdata[$i]['quantity']);//แผ่น
				print("</td>");
				print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
						$tung = 0;
						$count_num_item = utf8_strlen($getdata[$i]['item_number']);
						if($count_num_item==19)
						{

							$MB = strpos($getdata[$i]['item_number'], "MB");
							$PB = strpos($getdata[$i]['item_number'], "PB");
							if($MB !== FALSE)//ไม้บัว
							{
								$code = substr($getdata[$i]['item_number'], 7,4);
								$get_code = getlist("SELECT * FROM another_data WHERE product='MB'");
								for ($t=0; $t < sizeof($get_code); $t++) 
								{
										if($code==$get_code[$t]['size_code'])
										{
											$tung = $get_code[$t]['tung'];
										}
								}
							}else if($PB !== FALSE)//ไม้พื้น
							{
								$code = substr($getdata[$i]['item_number'], 7,4);
								$get_code = getlist("SELECT * FROM another_data WHERE product='PB'");
								for ($t=0; $t < sizeof($get_code); $t++) { 
									if($code==$get_code[$t]['size_code'])
									{
										$tung = $get_code[$t]['tung'];
									}
								}
							}else{
								print "";
							}

						}else if($count_num_item==15){
							$PM = strpos($getdata[$i]['item_number'], "PM");
							$PP = strpos($getdata[$i]['item_number'], "PP");
							$LM = strpos($getdata[$i]['item_number'], "LM");
							$LP = strpos($getdata[$i]['item_number'], "LP");
							if($PM !== FALSE || $PP !== FALSE)//ไม้บัว
							{
								
								$get_code = getlist("SELECT * FROM another_data WHERE product='PM'");

								for ($t=0; $t < sizeof($get_code); $t++) 
								{
									$count_code = utf8_strlen($get_code[$t]['size_code']);
									$code = substr($getdata[$i]['item_number'], 4,$count_code);
										if($code==$get_code[$t]['size_code'])
										{
											$tung = $get_code[$t]['tung'];
										}
								}
							}else if($LM !== FALSE || $LP !== FALSE)//ไม้พื้น
							{
								$get_code = getlist("SELECT * FROM another_data WHERE product='LM'");
								for ($t=0; $t < sizeof($get_code); $t++) 
								{
									$count_code = utf8_strlen($get_code[$t]['size_code']);
									$code = substr($getdata[$i]['item_number'], 4,$count_code);
										if($code==$get_code[$t]['size_code'])
										{
											$tung = $get_code[$t]['tung'];
										}
								}
							}else{
								print "";
							}

						}else if($count_num_item==20){//ไม้บัวกับ Flooring
							//$data1 = substr($getdata[$i]['item_number'], 3,2);
							$bj = strpos($getdata[$i]['item_number'], "BJ");
							$fl = substr_compare ($getdata[$i]['item_number'], "F", 0, 2 );
							if($bj !== FALSE)//ไม้บัว
							{
								$code = substr($getdata[$i]['item_number'], 3,5);
								$code2 = substr($getdata[$i]['item_number'], 3,7);//เฉพาะ SN301-1
								$get_code = getlist("SELECT * FROM another_data WHERE product='BJ'");
								for ($t=0; $t < sizeof($get_code); $t++) {
									if($get_code[$t]['size_code'] !="SN301-1")
									{
										if($code==$get_code[$t]['size_code'])
										{
											$tung = $get_code[$t]['tung'];
										}
									}else
									{
										if($code2==$get_code[$t]['size_code'])
										{
											$tung = $get_code[$t]['tung'];
										}
									}
									
								}
							}else if($fl !== FALSE)//ไม้พื้น
							{
								$item = substr($getdata[$i]['item_number'], 0,2);
								$code = substr($getdata[$i]['item_number'], 3,6);
								$get_code = getlist("SELECT * FROM another_data WHERE product='".$item."'");
								for ($t=0; $t < sizeof($get_code); $t++) { 
									if($code==$get_code[$t]['size_code'])
									{
										$tung = $get_code[$t]['tung'];
									}
							}
							}else{
								print "";
							}
							
							//$data1 = substr($getdata[$i]['item_number'], 7,2);
						}
						if(!empty($tung))
						{
							$total = ABS($getdata[$i]['quantity'])/$tung;
						}else{
							$total = 0;
						}
						
						print number_format($total,1) ;
					
					
					//

				print("</td>");
				print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
					$count_num_item = utf8_strlen($getdata[$i]['item_number']);

						if($get_type[$ty]['tung'] == '1' || $get_type[$ty]['tung'] == '2'){
						$s1 = substr($getdata[$i]['item_number'],7,4);
						$s2 = substr($getdata[$i]['item_number'],11,4);
						$s3 = substr($getdata[$i]['item_number'],15,4);
						//print $s1.$s2.$s3; 
						$query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '5'");
						$query2=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s2' AND orderby_pb = '6'");
						$query3=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s3' AND orderby_pb = '7'");
						$num_query = $query1[0]['data_detail']*$query2[0]['data_detail']*$query3[0]['data_detail'];
						$q = ($num_query/1000000000)*ABS($getdata[$i]['quantity']);
				/*---------------------------- calculator Q MDF---------------------------*/
				/*---------------------------- calculator Q ปิดผิวกระดาษ1---------------------------*/
					}elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '3'){
						$s1 = substr($getdata[$i]['item_number'],4,5);
						//print $s1;
						$query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
						$numget=explode("x",$query1[0]['data_detail']);
						$num_query =$numget[0]*$numget[1]*$numget[2];
						$q = ($num_query/1000000000)*ABS($getdata[$i]['quantity']);
				/*---------------------------- calculator Q ไม้พื้น1---------------------------*/
					}elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '4'){
						$s1 = substr($getdata[$i]['item_number'],3,6);

						$query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
						$numget=explode("x",$query1[0]['data_detail']);
						$num_query =$numget[1]*$numget[2];
						if($s1=='089205')
						{
								$box = ABS($getdata[$i]['quantity'])/8;
								$q = ($num_query/1000000)*$box*8;
						}else if($s1=='129305' || $s1=='122505' || $s1=='129005'){
							$box = ABS($getdata[$i]['quantity'])/7;
							$q = ($num_query/1000000)*$box*7;
						}
						else if($s1=='122510'){
							$box = ABS($getdata[$i]['quantity'])/16;
							$q = ($num_query/1000000)*$box*16;
						}
						else if($s1=='129805'){
							$box = ABS($getdata[$i]['quantity'])/5;
							$q = ($num_query/1000000)*$box*5;
						}
						else if($s1=='082060' || $s1=='0820000'){
							$box =ABS($getdata[$i]['quantity'])/1;
							$q = ($num_query/1000000)*$box*1;
						}
				/*---------------------------- calculator Q ปิดผิวเฟอร์นิเจอร์1---------------------------*/
					}elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '5'){
						$s1 = substr($getdata[$i]['item_number'],4,5);
						$query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
						$numget=explode("x",$query1[0]['data_detail']);
						$num_query =$numget[0]*$numget[1]*$numget[2];
						$q = ($num_query/1000000000)*$getdata[$i]['quantity'];
				/*---------------------------- calculator Q ไม้บัว1---------------------------*/
					}elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '6'){
						$s1 = substr($getdata[$i]['item_number'],8,5);
						$query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
						$numget=explode("x",$query1[0]['data_detail']);
						$num_query =$numget[0]*$numget[1]*$numget[2];
						$q = ($num_query/1000000000)*$getdata[$i]['quantity'];
						$q = Null;//ไม้บัวไม่มีการคิดคิว
					}

		print number_format($q,2);
/*--------------------------------------------------------------------------------------------------------------------*/
					
				print("</td>");
				print("<td style=\"width:15mm;\" class=\"body_table\">");
					print($getdata[$i]['sell_name']);
				print("</td>");
				print("<td style=\"width:30mm;\" class=\"body_table\">");
				$get_delivery_note= getlist("SELECT * FROM shipping as sp INNER JOIN production_order as po on sp.id_ship=po.delivery_name WHERE id_order='".$getdata[$i]['id_order']."' and detailship like '%บาร์โค๊ต%' or id_order='".$getdata[$i]['id_order']."' and detailship like '%ชั่วคราว%' or id_order='".$getdata[$i]['id_order']."' and detailship like '%ไม้หมอน%' or id_order='".$getdata[$i]['id_order']."' and detailship like '%พร้อม%'");
				if(!empty($get_delivery_note[0]['detailship']))
				{
					print($get_delivery_note[0]['detailship']);
				
				}else{
					print("");
				}
				print("</td>");
			print("</tr>");
				
					/*if($count > 19){
						$count = 1;
						 nextPage();
						head($get_type[$ty]['size_code']);
						headdetail();
					}
					$count ++;*/
				}
			}
	
	?>

			
			</table>	
			
	</html>