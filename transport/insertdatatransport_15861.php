<?php
	//@ini_set('display_errors', '0');
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
</style>
	<body bgcolor= "FFFFFF">
		<?php
			if(empty($_POST['datestart']))
					{
						$_POST['datestart'] = date('Y-m-d');
					}else{
						$_POST['datestart'] = $_POST['datestart'];
					}
		?>
	<center><font color="#000000" face="angsana new"><h1><b>ตารางการจัดส่ง วันที่ <?php print(printShortSlateThaiDate($_POST['datestart'])); ?></b></h1></center></font>
	<form action = "" name = "insertquarity" method = "POST">
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
					print("<a href=\"report_transport_all.php?delivery_date=".$_POST['datestart']."\" target='BLANK' style='color:#091fcc;'>ใบสั่งขน<br>ส่งสินค้า</a>");
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
$getdata = getlist("SELECT number,name,delivery_date,item_number,delivery_name,note,posttime,boonpon_id,warehouse_id,data_number FROM production_order as po inner join type_production as tp on product_id=id_production where $where   GROUP BY warehouse_id order by invoice");


			
			for($i=0;$i<sizeof($getdata);$i++){
				//ค้นหาชื่อคนขับทะเบียนรถ
				$get_transaction = getlist("SELECT * from insertdata_transport where boonpon_id = '".$getdata[$i]['boonpon_id']."'");

				//ค้นหาข้อมูลสินค้าที่ต้องจัดส่ง
				$invoice = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE warehouse_id='".$getdata[$i]['warehouse_id']."' and delivery_date='".$_POST['datestart']."'");

				if(!empty($invoice)){
		?>
			<tr align = "center">
				
			
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
						print(strtoupper($invoice_data[$n]) );
						if(!empty($invoice_data[$n+1])){
							print("<br>");
						}
					}

		
				?>
			</td>
			<td style="text-align: left;padding-left: 5px;">
				<?php
						$bua = array(6,7,13,14,15,16);
						$floor = array(4,8,9,11,12,17,18,21);
						$rubber = array(19,20,21,22);
						$kaindl = array(23,24);
						$paper = array(3,5);
					for($in=0; $in < sizeof($invoice); $in++) { 

						if(in_array($invoice[$in]['product_id'],$bua)){
							print "บัวตัวจบ ".$invoice[$in]['plate']." ".$invoice[$in]['item_number']." ".$invoice[$in]['mark_name'].$invoice[$in]['box_name'];//รายการ	
						}elseif(in_array($invoice[$in]['product_id'],$paper)){
							print $invoice[$in]['type_w']." ".$invoice[$in]['item_number']." ".$invoice[$in]['type_mark']."".$invoice[$in]['mark_name'].$invoice[$in]['side']." ".$invoice[$in]['plate']." ".$invoice[$in]['gule'];//รายการ	
						}elseif($invoice[$in]['product_id']==4 or $invoice[$in]['product_id']==11 or $invoice[$in]['product_id']==12 or $invoice[$in]['product_id']==17){

								print $invoice[$in]['mark_name']." ".$invoice[$in]['item_number']." ".$invoice[$in]['plate']." เซาะ ".$invoice[$in]['type_w']." ".$invoice[$in]['customer_mark'];//รายการ	
							//}
										
						}elseif($invoice[$in]['product_id'] ==8 || $invoice[$in]['product_id'] ==18){
										print $invoice[$in]['mark_name']." ".$invoice[$in]['item_number']." ".$invoice[$in]['gule']." ".$invoice[$in]['side']." ".$invoice[$in]['plate']." เซาะ ".$invoice[$in]['type_w'];//รายการ	
						}elseif(in_array($invoice[$in]['product_id'],$kaindl)){
										print $invoice[$in]['mark_name']." ".$invoice[$in]['item_number']." ".$invoice[$in]['side']." ".$invoice[$in]['plate'];//รายการ	
						}elseif(in_array($invoice[$in]['product_id'],$rubber)){
										print $invoice[$in]['mark_name']." ".$invoice[$in]['item_number'];//รายการ	
						}else{
							print  $invoice[$in]['detail_production']." ".$invoice[$in]['item_number']." ".$invoice[$in]['gule'];//รายการ	
						}
						
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
				
				for ($in=0; $in < sizeof($invoice); $in++) {

					print  $invoice[$in]['counts'];//รายการ
						
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
				$get_id = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id like '".$getdata[$i]['boonpon_id']."'");

					//คนขับ
					if(!empty($get_transaction[0]['nameDriver'])){
						$getdriver = getlist("select * from driver where id_driver = '".$get_id[0]['nameDriver']."'");
						print $getdriver[0]['namedriver1'];
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td class="body_table">
				<?php
					if(!empty($get_transaction[0]['idcar'])){
						
						$getcar = getlist("select * from car_detail where id_car = '".$get_id[0]['idcar']."'");
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
					if(!empty($get_transaction[0]['idcar'])){
						$gethcar = getlist("select * from car_head where id_hcar = '".$get_id[0]['typecar']."'");
						print $gethcar[0]['detailhcar'];//ประเภทรถ
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td class="body_table">
				<?php
					if(!empty($get_transaction[0]['final'])){
						$check_standard = getlist("SELECT * FROM fule_detail WHERE id_ship='".$getdata[$i]['delivery_name']."' and car_type='".$get_id[0]['typecar']."'");

						$final_oil = ($check_standard[0]['standard']+$get_transaction[0]['up'])-$get_transaction[0]['down'];
						$color  = $final_oil==$check_standard[0]['standard'] ? "color:blue;" : "color:red;";

						print("<a onclick = \"window.open('show_detail_fule.php?boonpon_id=".$getdata[$i]['boonpon_id']."&id_ship=".$get_delivery_name[0]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=320,top=45 ,left=250') \" style=\"cursor:pointer;$color\">".$final_oil."</a> ");
						//print "<b style='$color'>".$get_transaction[0]['final']."</b>";//เชื้อเพลิง
					}else{
						print "&nbsp";
					}
				?>
			</td>
			<td class="body_table">
				<?php
					if(!empty($getdata[$i]['boonpon_id'])){

						
						print "<img src = \"image/edit.png\" width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('insertdata_tranedit.php?id=".$getdata[$i]['data_number']."&datedata=".$getdata[$i]['delivery_date']."&type_user=".$_SESSION["permission"]."&warehouse_id=".$getdata[$i]['warehouse_id']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">"."&nbsp";
						
					}else{
						
						if(!empty($getdata[$i]['warehouse_id'])){
							print "<img src = \"image/false.png\"  width=\"20mm;\" height=\"20mm;\" onclick = \"window.open('insertdata_transport3.php?id=".$getdata[$i]['number']."&datedata=".$getdata[$i]['delivery_date']."&type_user=".$_SESSION["permission"]."&warehouse_id=".$getdata[$i]['warehouse_id']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=220,left=450 ')\">";
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
