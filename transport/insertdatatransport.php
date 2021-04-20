<?php
//@ini_set('display_errors', '0');
include 'function.php';
?>
<style type="text/css">
.body_table
{
	width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;
}
.body_table:hover img
{
	cursor:pointer;
}
tr:hover{
	background-color: #eeeff0;
}
</style>
<body bgcolor= "FFFFFF">
<?php
if(empty($_POST['datestart']))
{
	$_POST['datestart'] = date('Y-m-d');
}
else
{
	$_POST['datestart'] = $_POST['datestart'];
}
?>
<center><font color="#000000" face="angsana new">
	<h1><b>ตารางการจัดส่ง วันที่ <?php print(printShortSlateThaiDate($_POST['datestart'])); ?></b></h1>
</center></font>
<form action = "" name = "insertquarity" method = "POST">
<?php
	 //print("<a onclick=\"window.open('check_driver_car.php','','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=600,top=45,left=250')\" style=\"cursor:pointer;color:blue;\">เพิ่มหมายเหตุรถขนส่ง</a> ");
	 print("&nbsp;");
	 print("<a href=\"check_driver_car_3.php\" target=\"_blank\" style=\"color:blue;\">เพิ่มหมายเหตุรถขนส่ง</a> ");
	 //print("<a onclick=\"window.open('check_driver_car_3.php','','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=600,top=45,left=250')\" style=\"cursor:pointer;color:blue;\">เทส</a> ");
	 print("&nbsp;");
	 print("<a onclick=\"window.open('show_ontv.php','','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=600,top=45,left=250')\" style=\"cursor:pointer;color:blue;\">ดูตาราง</a> ");
?>
<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
	<tr>
		<td align = "center" style = "width:60mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
			<b>วันที่ส่งของ</b>
		</td>

		<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
		<?php	
			print("<input type = \"text\" name = \"datestart\" id = \"datestart\" value=\"".$_POST['datestart']."\" style = \"width:50mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\">");
		?>
				
			<script type="text/javascript">
				jQuery('#datestart').datetimepicker({
				timepicker:false,
				format:'Y-m-d'
			});
			</script>
		</td>


		<td align = "center" style = "width:30mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
			<b>ชนิดไม้</b>
		</td>

		<td align = "center" style = "width:60mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
		<?php
		    print("<select name = \"product_id\" style=\"width:231px;\">");
		        print("<option value=''>เลือกชนิดไม้</option>");
		        $type_wood = getlist("SELECT *  FROM type_production order by sort_by asc");
		        for ($u=0; $u < sizeof($type_wood); $u++) 
		                    { 
		                        $selected=$_POST['product_id']==$type_wood[$u]['id_production'] ? "selected=\"selected\"" : "";
		                         print("<option value = \"".$type_wood[$u]['id_production']."\"".$selected.">".$type_wood[$u]['detail_production']."</option>");
		                    }
		            print("</select>");
			?>
			</td>

			<td colspan = "2" align = "left" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ค้นหา" style = "width:20mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }" >
					
			</td>
		</tr>
	</table>
	</form>
	<?php
			if(!empty($_POST['datestart'])){
				$_POST['datestart'] = $_POST['datestart'];
			}else{
				$_POST['datestart'] = date("Y-m-d");
			}
		if(!empty($_POST['datestart'])){
	?>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "1" cellpadding = "2" align = "center" valign = "middle" style="width:100%;height:10mm;empty-cells: show;">
		<tr align = "center">
			<!--<td class="body_table"><b>
				ลำดับ
			</td>-->
			<td class="body_table"><b>
				เลข Invoice
			</td>
			<td class="body_table"><b>
				รายละเอียด
			</td>
			<td class="body_table"><b>
				ตั้ง/กล่อง
			</td>
			<td class="body_table"><b>
				แผ่น
			</td>
			<td class="body_table"><b>
				ชื่อลูกค้า
			</td>
			
			<td class="body_table"><b>
				วันที่ส่ง/เวลา
			</td>
			<td class="body_table"><b>
				สถานที่จัดส่ง
			</td>
			<td class="body_table"><b>
				หมายเหตุ
			</td>
			<!--<td class="body_table"><b>
				ระยะทางขนส่ง
			</td>-->
			<td class="body_table"><b>
				ชื่อคนขับ
			</td>
			<td class="body_table"><b>
				ทะเบียนรถ
			</td>
			<td class="body_table"><b>
				เลขขนส่ง
			</td>
			<td class="body_table"><b>
				ประเภทรถ
			</td>
			<td class="body_table"><b>
				เชื้อเพลิง
			</td>
			<td class="body_table"><b>
				
				<?php
					print("<a href=\"reporttransportorder.php?id=".$_POST['datestart']."&product_id=".$_POST['product_id']."\" target='BLANK' style='color:#091fcc;'>ใบสั่งงาน</a>");
				?>
			</td>
			<td class="body_table"><b>
				<?php  
					print("<a href=\"report_transport_all.php?delivery_date=".$_POST['datestart']."&product=".$_POST['product_id']."\" target='BLANK' style='color:#091fcc;'>ใบสั่งขน<br>ส่งสินค้า</a>");
				?>

			</td>
			<td class="body_table"><b>
				<?php
				print("<a href=\"report_invoice_all.php?delivery_date=".$_POST['datestart']."\" target='BLANK' style='color:#091fcc;'>ใบกำกับ</a>");
				?>
			</td>
			<td class="body_table"><b>
				ใบอนุญาติ<br>นำสินค้าออก
			</td>
			<td class="body_table"><b>
				ใบส่งของ<br>ชั่วคราว
			</td>
		</tr>
		<?php
		$show_transport =1;

		$search[0] = !empty($_POST['product_id']) ? "product_id='".$_POST['product_id']."'" : "";
		$search[1] = !empty($_POST['datestart']) ? "delivery_date='".$_POST['datestart']."'" : "";

		 $where = "";
        for ($s=0; $s < sizeof($search); $s++) { 
          if(!empty($search[$s])){
            if(empty($where)){
              $where = $search[$s];
            }else{
                $where .= " and ".$search[$s];
            }
          }
      }	

      		if(!empty($_POST['summit'])){
			$getdata = getlist("SELECT number,name,delivery_date,item_number,delivery_name,note,posttime,boonpon_id,warehouse_id,data_number,sum(status_edit) as edit FROM production_order as po inner join type_production as tp on product_id=id_production where $where   GROUP BY warehouse_id order by invoice");
			}else{
				print("<tr>");
					print("<td colspan='17' style='text-align:center;'>");
						print("<h2  style='color:red;'> ** เพื่อการทำงานที่เร็วขึ้นกรุณา เลือกไม้และวันที่ ที่คุณต้องการค้นหา **<h2>");
						print("<h2  style='color:red;'> ** หากไม่เลือกชนิดไม้ไดเลย และกด <b>ค้นหา</b> ระบบจะแสดงข้อมูลการข่นส่งทั้งหมดมาให้ **<h2>");
					print("<td>");
				print("</tr>");
			}


			
			for($i=0;$i<sizeof($getdata);$i++){
				//ค้นหาชื่อคนขับทะเบียนรถ
				if(!empty($getdata[$i]['boonpon_id'])){
				$get_transaction = getlist("SELECT * from insertdata_transport where boonpon_id = '".$getdata[$i]['boonpon_id']."'");
				}

				//ค้นหาข้อมูลสินค้าที่ต้องจัดส่ง
				$invoice = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE warehouse_id='".$getdata[$i]['warehouse_id']."' and delivery_date='".$_POST['datestart']."' ");

				if(!empty($invoice)){

					if($getdata[$i]['edit']>0 && !empty($getdata[$i]['boonpon_id'])){
						$color_back =  "background-color:#f29c9c;";
					}else{
						$color_back ="";
					}
					
					print("<tr align = \"center\" style='$color_back'>");
		?>
			
				
			
			<td  style="text-align: left;padding-left: 5px;">
				<?php
					

					$invoice_data = array();
					for ($g=0; $g < sizeof($invoice); $g++) {
						 $check = data_in_array($invoice[$g]['invoice'],$invoice_data);
						 if($check==0){
						 	array_push($invoice_data, $invoice[$g]['invoice']);
						 }
						
					}

					for ($n=0; $n < sizeof($invoice_data); $n++) { 
						//เลข Invoice
						print(strtoupper($invoice_data[$n]) );
						if(!empty($invoice_data[$n+1])){
							print("<br>");
						}
					}

		
				?>
			</td>
			<td style="text-align: left;padding-left: 5px;">
				<?php
			//---------------------------------------------แสดงข้อมูลรายละเอียด-------------------------------------			
					for($in=0; $in < sizeof($invoice); $in++) { 
						//รายละเอียด	
						show_description($invoice[$in]['id_order'],$invoice[$in]['product_id']);

						if(empty($invoice[$in]['warehouse_id'])){
							
							print("<a onclick = \"window.open('insertdatawarehouse2.php?code_data=".$invoice[$in]['number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1300,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\"><v style='color:red;'>จัดกลุ่ม</v></a>");
						}
						
						if(!empty($invoice[$in+1]['detail_production']))
						{
							print("<br>");
						}
						
					}
				?>
			</td>
			<td class="body_table">
				<?php
				$item_array = array();
				for ($in=0; $in < sizeof($invoice); $in++) {
					//ตั้ง/กล่อง
					print  $invoice[$in]['counts'];
						if(!in_array($invoice[$in]['detail_production'],$item_array)){
										$item_array[] = $invoice[$in]['detail_production'];
									}
						if(!empty($invoice[$in+1]['detail_production']))
						{
							print("<br>");
						}
						
					}
				?>
			</td>
			<td class="body_table">
				<?php
				for ($in=0; $in < sizeof($invoice); $in++) { 
						print ABS($invoice[$in]['quantity']); //แผ่น
						if(!empty($invoice[$in+1]['detail_production']))
						{
							print("<br>");
						}
					}
					
				?>
			</td>
			
			<td class="body_table">
				<?php
				$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[$i]['name']."'");
					print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
					
				?>
			</td>
			
			<td class="body_table">
				<?php
					print $getdata[$i]['delivery_date'];//วันที่ส่ง/เวลา
				?>
			</td>

			<td class="body_table">
				<?php
				/*	$send_der = "";
					for ($in=0; $in < sizeof($invoice); $in++) {
						if(!empty($invoice[$in]['customer_receive'])){
							if($invoice[$in]['customer_receive'] != $invoice[$in]['name']){
								$get_customer_receive = getlist("SELECT * FROM customer WHERE id_customer='".$invoice[$in]['customer_receive']."'");
								print $get_customer_receive[0]['namecustomer'];//ชื่อผู้รับ
							}
						}
						$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$invoice[$in]['delivery_name']."'");
					
							print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$get_delivery_name[0]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$get_delivery_name[0]['detailship']."</a> ");
							$check_allowance = getlist("SELECT * FROM allowance WHERE id_ship='".$invoice[$in]['delivery_name']."'");
							if(empty($check_allowance)){
								print("<img src=\"image/shocked.png\" width=\"15\" height=\"15\" title='ไม่มีข้อมูลเบี้ยเลี้ยง'>");
													
							}
							$slad = !empty($send_der) ? " / " : "";
							$send_der .=" $slad ".$get_delivery_name[0]['detailship'];
							if(!empty($invoice[$in+1]['delivery_name']))
							{
								print("<br>");
							}
					}
				*/


					if(!empty($getdata[$i]['customer_receive'])){
						if($getdata[$i]['customer_receive'] != $getdata[$i]['name']){
							$get_customer_receive = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[$i]['customer_receive']."'");
							print $get_customer_receive[0]['namecustomer'];//ชื่อผู้รับ
						}
					}
					$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata[$i]['delivery_name']."'");
				
						print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$get_delivery_name[0]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$get_delivery_name[0]['detailship']."</a> ");
						$check_allowance = getlist("SELECT * FROM allowance WHERE id_ship='".$getdata[$i]['delivery_name']."'");
						if(empty($check_allowance)){
							print("<img src=\"image/shocked.png\" width=\"15\" height=\"15\" title='ไม่มีข้อมูลเบี้ยเลี้ยง'>");
												
						}

					$send_der = $get_delivery_name[0]['detailship'];
					
				?>
			</td>
			<td class="body_table">
				<?php
					print $getdata[$i]['note'];//หมายเหตุ
					if(!empty($getdata[$i]['posttime'])){
						print(" ".$getdata[$i]['posttime']);
					}
					
				?>
			</td>
		
			<td class="body_table">
				<?php
				
					//คนขับif(!empty($getdata[$i]['boonpon_id'])){
					if(!empty($getdata[$i]['boonpon_id'])){
						$getdriver = getlist("select * from driver where id_driver = '".$get_transaction[0]['nameDriver']."'");
						print $getdriver[0]['namedriver1'];
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td class="body_table">
				<?php
					if(!empty($getdata[$i]['boonpon_id'])){
						
						$getcar = getlist("select * from car_detail where id_car = '".$get_transaction[0]['idcar']."'");
						if($get_transaction[0]['typecar'] == 1 OR $get_transaction[0]['typecar'] == 3){
							print $getcar[0]['licenceplates'];
						}else{
							print $getcar[0]['licenceplates']."<br>";
							print $getcar[0]['licenceplate2'];//ทะเบียนรถ
						}
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td class="body_table">
				<?php
				
					if(!empty($getdata[$i]['boonpon_id'])){
						
						print $getdata[$i]['boonpon_id'];
						//print $getdata[$i]['warehouse_id'];
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td class="body_table">
				<?php
					if(!empty($getdata[$i]['boonpon_id'])){
						$gethcar = getlist("select * from car_head where id_hcar = '".$get_transaction[0]['typecar']."'");
						print $gethcar[0]['detailhcar'];//ประเภทรถ
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td class="body_table">
				<?php
					
						$check_standard = getlist("SELECT * FROM fule_detail WHERE id_ship='".$getdata[$i]['delivery_name']."' and car_type='".$get_transaction[0]['typecar']."'");

						$final_oil = ($check_standard[0]['standard']+$get_transaction[0]['up'])-$get_transaction[0]['down'];
						$color  = $final_oil==$check_standard[0]['standard'] ? "color:blue;" : "color:red;";

						print("<a onclick = \"window.open('show_detail_fule.php?boonpon_id=".$getdata[$i]['boonpon_id']."&id_ship=".$get_delivery_name[0]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=870,height=444,top=45 ,left=250') \" style=\"cursor:pointer;$color\">".$final_oil."</a> ");
						//print "<b style='$color'>".$get_transaction[0]['final']."</b>";//เชื้อเพลิง
				
				?>
			</td>
			<td class="body_table">
				<?php
					if(!empty($getdata[$i]['boonpon_id'])){

						
						print "<img src = \"image/edit.png\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('insertdata_tranedit.php?id=".$getdata[$i]['data_number']."&datedata=".$getdata[$i]['delivery_date']."&type_user=".$_SESSION["permission"]."&warehouse_id=".$getdata[$i]['warehouse_id']."&boonpon_id=".$getdata[$i]['boonpon_id']."&id_car=".$get_transaction[0]['idcar']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">"."&nbsp";
						
					}else{
						
						if(!empty($getdata[$i]['warehouse_id'])){
							print "<img src = \"image/false.png\"  width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('insertdata_transport4.php?id=".$getdata[$i]['number']."&datedata=".$getdata[$i]['delivery_date']."&type_user=".$_SESSION["permission"]."&warehouse_id=".$getdata[$i]['warehouse_id']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">";
						//สถานะ
						}else{
							print("คลังต้องจัด<br>กลุ่มก่อน");
						}
						
					}
					if($show_transport==1)
					{
						print "<img src = \"image/report_icon.png\" title=\"ใบสั่งงานขนส่ง\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('reporttransportorder.php?id=".$getdata[$i]['delivery_date']."&product_id=".$_POST['product_id']."')\">";
						$show_transport=0;
					}
					
				?>
			</td>
			<td class="body_table"><b>
				<?php
				
					if(!empty($getdata[$i]['boonpon_id'])){
						
						print "<img src = \"image/printer.png\" title=\"ใบสั่งขนส่งสินค้า\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('ordersshipping.php?id=".$getdata[$i]['boonpon_id']."&date_send=".$_POST['datestart']."')\">";
					}else{
						if(!empty($getdata[$i]['warehouse_id'])){
						print "<img src = \"image/false.png\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('insertdata_transport3.php?id=".$getdata[$i]['number']."&datedata=".$getdata[$i]['delivery_date']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">";
						}else{
							print("คลังต้องจัด<br>กลุ่มก่อน");
						}
					}
				?>
			</td>
			<td class="body_table"><b>
				<?php
					if(!empty($getdata[$i]['boonpon_id'])){
						
						print "<img src = \"image/printer.png\" title=\"ใบกำกับการขนส่ง\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('transporinvoice.php?id=".$getdata[$i]['boonpon_id']."')\">";
					}else{
						if(!empty($getdata[$i]['warehouse_id'])){
						print "<img src = \"image/false.png\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('insertdata_transport3.php?id=".$getdata[$i]['number']."&datedata=".$getdata[$i]['delivery_date']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">";
						//ใบกำกับ
						}else{
							print("คลังต้องจัด<br>กลุ่มก่อน");
						}
					}
				?>
			</td>
			<td class="body_table"><b>
				<?php
					//if(!empty($getdata[$i]['boonpon_id'])){
						
						print "<img src = \"image/printer.png\" title=\"ใบอนุญาตินำสินค้าออก\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('product_out.php?id=".$getdata[$i]['number']."&datedata=".$getdata[$i]['delivery_date']."&warehouse_id=".$getdata[$i]['warehouse_id']."')\">";
					/*}else{
						if(!empty($getdata[$i]['warehouse_id'])){
						print "<img src = \"image/false.png\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('insertdata_transport3.php?id=".$getdata[$i]['number']."&datedata=".$getdata[$i]['delivery_date']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">";
						//ใบกำกับ
						}else{
							print("คลังต้องจัด<br>กลุ่มก่อน");
						}
					}*/
				?>
			</td>
			<td class="body_table"><b>
				<?php
					//if(!empty($getdata[$i]['boonpon_id'])){
						
						print "<img src = \"image/printer.png\" title=\"ใบส่งของชั่วคราว\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('product_temporary.php?id=".$getdata[$i]['number']."&datedata=".$getdata[$i]['delivery_date']."&warehouse_id=".$getdata[$i]['warehouse_id']."')\">";
					/*}else{
						if(!empty($getdata[$i]['warehouse_id'])){
						print "<img src = \"image/false.png\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('insertdata_transport3.php?id=".$getdata[$i]['number']."&datedata=".$getdata[$i]['delivery_date']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">";
						//ใบกำกับ
						}else{
							print("คลังต้องจัด<br>กลุ่มก่อน");
						}
					}*/
			/*$item_detail = "";
			for($t=0;$t<sizeof($item_array);$t++){
				if(empty($item_detail)){
						$item_detail = $item_array[$t];
				}else{
				}
			}*/
			
			
				?>
			</td>
			<td class="body_table"><b>
			<?php
					$Token = $getdriver[0]['token_line'];
			$message = printShortDate($_POST['datestart'])." ".$getdriver[0]['namedriver1']." ขับรถทะเบียน ".$getcar[0]['licenceplates']." ลูกค้า : ".$get_customer_name[0]['namecustomer']." ".$invoice[0]['alis_name']." ส่งที่ : ".$send_der." *** ".$getdata[$i]['note']." ".$getdata[$i]['posttime'];

				//print("<a href=\"\"   onclick = \"line_notify($Token, $message)\">oooot</a>");
		//	print "<img src = \"image/line.png\" title=\"ส่ง LIne\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('send_line.php?token=".$Token."&ma=$message')\"  , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=870,height=444,top=45 ,left=250') \">";
				if(!empty($getdata[$i]['boonpon_id']) && !empty($Token)){
					print "<img src = \"image/line.png\"  width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('send_line.php?token=".$Token."&ma=$message' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">";


				}
			?>
			</td>
		</tr>
		<?php	
			}	
			}
		?>
	</table>
	<?php
		}else{
			print "ไม่มีรายการส่งสินค้าในวันนี้";
		}	



	?>		
<div style="padding-bottom: 20mm; "></div>
