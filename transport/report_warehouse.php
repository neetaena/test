<div style="float : left;">
		รายงานข้อมูลคลังสินค้า
	</div>
	<div  style="float : right; margin-right: 10px;">
		<?php
		//$sql = getlist("select * from car_detail where status = '1'");
		//print("จำนวนข้อมูลท้งหมด ".sizeof($sql)." คัน");
	?>
	</div>
	<div style="margin-top : 50px;">
		<?php
		query("USE transport");
		if(empty($_GET['page'])){
		$_GET['page']="1";
		}
	
					$n = $_GET['page'];
					$h = ($n *10)-10;
					$num_page = 10;
					$query_datawarehouse = getlist("SELECT idwarehouse,invoicedsales,cus.namecustomer,sp.detailship,pla.Nameplace,datetimeout,Posttime,"
										."tp.detail_production from insertdatawarehouse as idw INNER JOIN customer as cus on idw.customers = cus.id_customer "
											."INNER JOIN type_production as tp on idw.id_pro = tp.id_production INNER JOIN placecar as pla on idw.start = pla.IDPLACE "
											."INNER JOIN shipping as sp ON idw.sendlocation = sp.id_ship where idw.status ='1' order by dateimport desc limit $h,$num_page");
					
						
					print ("<table  bgcolor = \"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"0\" align = \center\" valign = \"middle\" style=\"width:280mm;empty-cells: show;\">");
						print("<tr>");
						print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b>เลขที่ใบสั่งขาย</b></td>");
						print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b>ชื่อลูกค้า</b></td>");
						print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b>ชื่อสินค้า</b></td>");
						print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b>สถานที่จัดส่ง</b></td>");
						print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b>สถานที่เริ่มจัดส่ง</b></td>");
						print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b>วันที่ส่งของ</b></td>");
						//print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b>เวลา</b></td>");
						
						print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b></b></td>");
						print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\"><b></b></td>");
						
						print("</tr>");

						
					for($i=0;$i<sizeof($query_datawarehouse);$i++){
					
						print("<tr>");
							print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\">".$query_datawarehouse[$i]['invoicedsales']."</td>");//เลขที่ใบสั่งขาย
							print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\">".$query_datawarehouse[$i]['namecustomer']."</td>");//ชื่อลูกค้า
							print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\">".$query_datawarehouse[$i]['detail_production']."</td>");//ชื่อสินค้า
							print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\">".$query_datawarehouse[$i]['detailship']."</td>");//สถานที่จัดส่ง
							print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\">".$query_datawarehouse[$i]['Nameplace']."</td>");//สถานที่เริ่มจัดส่ง
							print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\">".$query_datawarehouse[$i]['datetimeout']." : ".$query_datawarehouse[$i]['Posttime']."</td>");//วันที่ส่งของ
							//print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;\">".$query_datawarehouse[$i]['Posttime']."</td>");//เวลา
							
							print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px;\"><a href=\"edit_data_warehouse2.php?id_product=".$query_datawarehouse[$i]['idwarehouse']."\">แก้ไข</a></td>");
							print("<td align = \"left\" style = \"width:10mm;empty-cells: show;font-family:angsana new;font-size:26px;\"><a href=\"delete_data.php?delete_prodcut=".$query_datawarehouse[$i]['idwarehouse']."\" onclick=\"return confirm('คุณต้องการลบข้อมูลนี้หรอไม่่')\">ลบ</a></td>");
							
						print("</tr>");
					}
					print("</table>");					
					
						$limit = 10;
						$get_page = getlist("SELECT idwarehouse,invoicedsales,cus.namecustomer,sp.detailship,pla.Nameplace,datetimeout,Posttime,"
										."tp.detail_production from insertdatawarehouse as idw INNER JOIN customer as cus on idw.customers = cus.id_customer "
											."INNER JOIN type_production as tp on idw.id_pro = tp.id_production INNER JOIN placecar as pla on idw.start = pla.IDPLACE "
											."INNER JOIN shipping as sp ON idw.sendlocation = sp.id_ship where idw.status ='1'");
						$numPageTotal=ceil(sizeof($get_page)/$limit);
						print("หน้าที่  ");
						for($i=0;$i<$numPageTotal;$i++){
						 if($i+1 != $_GET['page'])
						 {
						    print("<a href=\"index.php?path=report_warehouse&page=".($i+1)."\">".($i+1)."</a>&nbsp;|&nbsp;");
							
						  }
						 else 
						 {
							print(($i+1)."&nbsp;|&nbsp;");
						 }
						 
						 if(($i+1)%40 == 0){
						  print("<br />");
						 }
						}		
				?>
	</div>