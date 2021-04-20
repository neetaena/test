<style type="text/css">
	.input_data{
		width:50mm;
		
		empty-cells: show;
		font-family:angsana new;
		font-size:22px;
	}
	.input_data2{
		width:90mm;
		
		empty-cells: show;
		font-family:angsana new;
		font-size:22px;
	}
	.text_fide{
		empty-cells: show;
		font-family:angsana new;
		font-size:22px;
	}
</style>

<script type="text/javascript">
	function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
						ele.onKeyPress=vchar;
						}	

                $(function() {
                        $( ".serach_customer" ).autocomplete({
                            source: 'autoComplete/gdata_customer.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
                            minLength: 1,
                            
                        });
                    });

                 $(function() {
                        $( ".serach_delivery" ).autocomplete({
                            source: 'autoComplete/gdata_delivery.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
                            minLength: 1,
                            
                        });
                    });
</script>
<?php

	query("USE transport");
	 date_default_timezone_set("Asia/Bangkok");
    $date_time =  date("Y-m-d H:i:s");
	if(!empty($_POST['summit'])){
			$voucher_run = getlist("SELECT * FROM production_order WHERE data_number like 'ABPS%' order by id_order desc limit 1");
						if(!empty($voucher_run[0]['data_number']))
						{
								$text1 = substr($voucher_run[0]['data_number'], 0,4);
								$number_v = substr($voucher_run[0]['data_number'], 4,8);

								$voucher_num = $number_v+1;
								$new_voucher_new = $text1.$voucher_num;
						}else{
							$new_voucher_new ="ABPS18001";
						}
					$new_voucher = $_POST['voucher'];
					$customer = $_POST['customers'];
					$Sendlocation = $_POST['Sendlocation'];
					$date_send = $_POST['datetimeout1'];
					$note = $_POST['note'];
					$country = $_POST['country'];
					$posttime = $_POST['Posttime'];
					$id_order = $_POST['id_pro'];
					$sell_name = $_POST['sell_name'];
					$customer_receive_id = $_POST['customer_receive_id'];

					
					$invoice = $_POST['taxinvoice1'];
					$id_stock_import = $_POST['Orders'];
					$glue1 = $_POST['glue1'];
					$quantity = $_POST['quantity'];
					$plate_select = $_POST['plate_select'];
					$grade = $_POST['grade'];
					$counts = $_POST['counts'];;
					$type_wood = $_POST['type_wood'];
					$type_mark = $_POST['type_mark'];
					$marking = $_POST['marking'];
					$side = $_POST['side'];
					$price = 0;//$_POST['price'];
					$box = $_POST['box'];
					$submit_date = $_POST['submit_date'];
					$warehouse_id = $_POST['warehouse_id'];
					$note_order = $_POST['note_order'];
					$po_number = $_POST['po_number'];
					$customer_mark = $_POST['customer_mark'];
					$palette = $_POST['palette'];
					$scrap = $_POST['scrap'];
					$type_bj = $_POST['type_bj'];
			


				if(!empty($customer) && !empty($Sendlocation))
				{
					for($f=0;$f<sizeof($id_stock_import);$f++)
					{
						if(!empty($id_stock_import[$f]))
						{
							$check_boonpon_id = getlist("SELECT * FROM production_order WHERE warehouse_id='$warehouse_id' and delivery_date='$date_send'");
							if(!empty($check_boonpon_id[0]['boonpon_id'])){
								$boonpon_id = ",boonpon_id='".$check_boonpon_id[0]['boonpon_id']."'";
							}else{
								$boonpon_id = "";
							}

							$sql = query("INSERT INTO production_order SET name='$customer',item_number='".$id_stock_import[$f]."',quantity='".$quantity[$f]."',delivery_date='$date_send',delivery_name='$Sendlocation',note='$note',invoice=\"".$invoice."\",country='$country',number='".$new_voucher."',crate_date='".$date_time."',sell_name='$sell_name',status_data='1',gule='".$glue1[$f]."',grade='".$grade[$f]."',posttime='".$posttime."',plate='".$plate_select[$f]."',type_w='".$type_wood[$f]."',counts='".$counts[$f]."',product_id='".$id_order."',type_mark='".$type_mark[$f]."',mark_name='".$marking[$f]."',side='".$side[$f]."',price='".$price[$f]."',submit_date='".$submit_date[$f]."',warehouse_id='$warehouse_id',box_name='".$box[$f]."',data_number='$new_voucher_new',customer_receive='$customer_receive_id',note_order='".$note_order[$f]."',po_number='".$po_number."',customer_mark='".$customer_mark[$f]."',scrap='".$scrap[$f]."',type_bj='".$type_bj[$f]."',palette='".$palette[$f]."'$boonpon_id");
						}
					
					}
					query("UPDATE production_order SET country='$country' WHERE delivery_name='$Sendlocation'");
					//query("UPDATE shipping SET country='$country' WHERE id_ship='$Sendlocation'");
					
						$message =  "เพิ่มข้อมูลสำเร็จ";
						unset($_POST);
						
						print("<meta http-equiv='refresh' content='0; url= index.php?path=insertdatawarehouse'>");
				
				}else{
					$message =  "กรุณาเลือกชื่อลูกค้า หรือชื่อสถานที่จัดส่งให้ถูกต้อง";	
				}
					
						
						
			print "<script type='text/javascript'>alert('$message');</script>";
	}

?>

	<link rel="stylesheet" href="css/jquery-ui.css">
  	<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>
<script type="text/javascript">
			$(function() {
				$(".marking_show").autocomplete({
					source: 'autoComplete/get_marking.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
					minLength: 2,
					
				});
			});

			$(function() {
				$(".plate_show").autocomplete({
					source: 'autoComplete/get_platebox.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
					minLength: 2,
					
				});
			});
</script>

<html>
	<body bgcolor= "FFFFFF">
	<center><font color="#000000" face = "angsana new"><h1><b>ลงข้อมูล(คลังสินค้า)</b></h1></center></font>
	<form action = "" name = "insertquarity" method = "POST" >
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;height:2mm;empty-cells: show;">
		<tr>
			<td align = "right" class="input_data">
				<b>เลขที่ใบสั่งขาย&nbsp;&nbsp;&nbsp;</b>
			</td>
			<?php
				/*$voucher_run = getlist("SELECT * FROM production_order WHERE number like 'ABPS%' order by id_order desc limit 1");
						if(!empty($voucher_run[0]['number']))
						{
								$text1 = substr($voucher_run[0]['number'], 0,4);
								$number_v = substr($voucher_run[0]['number'], 4,8);

								$voucher_num = $number_v+1;
								$new_voucher = $text1.$voucher_num;
						}else{
							$new_voucher ="ABPS17000100";
						}
						$_POST['voucher']= empty($_POST['voucher']) ? $new_voucher : $_POST['voucher'];*/

			?>
			<td align = "center" style = "width:90mm;" class="text_fide">
				<input type = "text" name = "voucher" value = "<?php print $_POST['voucher'];?>" class="input_data2" required>
			</td>
			</tr>
			<tr>
				<td align = "right" class="input_data">
				<b>เลขที่ใบกำกับภาษี&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" style = "width:20mm;" class="text_fide">
				<input type = "text" name = "taxinvoice1" value = "<?php print $_POST['taxinvoice1'];?>" style = "width:90mm;" class="text_fide" required>
			</td>
			
				
			
			
		</tr>

		<tr>
			<td align = "right" class="input_data">
				<b>ชื่อลูกค้า&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" style = "width:90mm;empty-cells:show;font-family:angsana new;font-size:22px;">
			
	
				<?php
				print("<textarea name = \"name_id\" id=\"name_id\" style=\"width: 90mm;resize:none;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" class='serach_customer'>");
								print $_POST['name_id'];
							//print $get_data[0]['name'];
						print("</textarea>");


						$get_customer1 = getlist("SELECT * FROM customer where namecustomer='".$_POST['name_id']."'");
						print("<input type = \"hidden\" name = \"customers\"  id = \"customers\" value = \"".$get_customer1[0]['id_customer']."\">");
				?>
				
			</td>
		</tr>
				<script type = "text/javascript">

				/*	function make_autocom(autoObj,showObj){
					var mkAutoObj=autoObj;
					var mkSerValObj=showObj;
					new Autocomplete(mkAutoObj, function() {
					this.setValue = function(id) {     
						document.getElementById(mkSerValObj).value = id;
					}
					if ( this.isModified )
						this.setValue("");
						if ( this.value.length < 1 && this.isNotClick )
							return ;   
							return "autoComplete/gdata.php?&q=" +encodeURIComponent(this.value);
						});
					}
					make_autocom("name_id","customers");*/
				</script>
		<tr>
			<td align = "right" class="input_data">
				<b>ชื่อผู้รับสินค้า&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" style = "width:90mm;empty-cells:show;font-family:angsana new;font-size:22px;">
			
	
				<?php
				$_POST['customer_receive_name'] = empty($_POST['customer_receive_name']) ? $_POST['name_id'] : $_POST['customer_receive_name'];
				$_POST['customer_receive_id'] = empty($_POST['customer_receive_id']) ? $_POST['customers'] : $_POST['customer_receive_id'];
				print("<textarea name = \"customer_receive_name\" id=\"customer_receive_name\" style=\"width: 90mm;resize:none;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" class='serach_customer'>");
								print $_POST['customer_receive_name'];
							//print $get_data[0]['name'];
						print("</textarea>");

						$get_customer2 = getlist("SELECT * FROM customer where namecustomer='".$_POST['customer_receive_name']."'");
						print("<input type = \"hidden\" name = \"customer_receive_id\"  id = \"customer_receive_id\" value = \"".$get_customer2[0]['id_customer']."\">");
				?>
				<!--<input type = "hidden" name = "customer_receive_id"  id = "customer_receive_id" value = "<?php print $_POST['customer_receive_id'];?>">-->
			</td>
		</tr>
				<script type = "text/javascript">
					/*function make_autocom(autoObj,showObj){
					var mkAutoObj=autoObj;
					var mkSerValObj=showObj;
					new Autocomplete(mkAutoObj, function() {
					this.setValue = function(id) {     
						document.getElementById(mkSerValObj).value = id;
					}
					if ( this.isModified )
						this.setValue("");
						if ( this.value.length < 1 && this.isNotClick )
							return ;   
							return "autoComplete/gdata.php?&q=" +encodeURIComponent(this.value);
						});
					}
					make_autocom("customer_receive_name","customer_receive_id");*/
				</script>
		<tr>
			<td align = "right" class="input_data">
				<b>สถานที่จัดส่ง&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" class="input_data2">
				
				<?php
					print("<textarea name = \"place_id\" id=\"place_id\" style=\"width: 90mm;resize:none;\" onchange = \"this.form.submit();\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" class='serach_delivery' required>");
						
                    		print$_POST['place_id'];//สถานที่จัดส่ง
							
						print("</textarea>");
				$get_delivery = getlist("SELECT * FROM shipping WHERE detailship='".$_POST['place_id']."'");
						print("<input type = \"hidden\" name = \"Sendlocation\"  id = \"Sendlocation\" value = \"".$get_delivery[0]['id_ship']."\">");

				?>
				<!--<input type = "hidden" name = "Sendlocation"  id = "Sendlocation" value = "<?php print $_POST['Sendlocation'];?>" required>-->
			</td>
		</tr>
					<script type="text/javascript">
					/*	function make_autocom2(autoObj,showObj){
						var mkAutoObj=autoObj;
						var mkSerValObj=showObj;
						new Autocomplete(mkAutoObj, function() {
						this.setValue = function(id) {     
							document.getElementById(mkSerValObj).value = id;
						}
						if ( this.isModified )
							this.setValue("");
							if ( this.value.length < 1 && this.isNotClick )
								return ;   
								return "autoComplete/gdata2.php?&q=" +encodeURIComponent(this.value);

							});
						}
						make_autocom2("place_id","Sendlocation");*/
					</script>

		<?php
	/*	print("<tr class=\"body_table\">");
					print("<td align = \"right\" class=\"input_data\">");
						print("<b>จังหวัด &nbsp;&nbsp;&nbsp;</b> ");
					print("</td>");
					print("<td colspan=\"2\" class=\"input_data2\">");
						$get_country = getlist("SELECT country FROM shipping where id_ship like '".$_POST['Sendlocation']."' limit 1");
						
						$_POST['country'] = empty($_POST['country']) ? $get_country[0]['country'] : $_POST['country'];
						print("<input type = \"text\" name = \"country\" value = \"".$_POST['country']."\" style=\"width: 90mm;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" readonly>");
					print("</td>");
					print("</td>");
				print("</tr>");*/
			print("<tr align = \"right\"  class=\"input_data\">");
					print("<td>");
						print("<b>ชื่อ Sell&nbsp;&nbsp;&nbsp;</b>");
					print("</td>");
					print("<td   class=\"input_data2\">");
						print("<input type = \"text\" name = \"sell_name\" value = \"".$_POST['sell_name']."\" style=\"width: 90mm;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
				print("</tr>");
		?>
			
		<tr>
			<td align = "right" class="input_data">
				<b>วันที่ส่งของ&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" class="input_data2">
				<input type = "text" name = "datetimeout1" class="datetimeout input_data2" value = "<?php print $_POST['datetimeout1'];?>" onchange ="this.form.submit();" required>
				<script type="text/javascript">
					 $('.datetimeout').datetimepicker({
					 timepicker:false,
					 format:'Y-m-d'
					 });
			 </script>
			</td>
		</tr>
		<tr>
			<td align = "right" class="input_data">
				<b>เวลาส่ง&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" class="input_data2">
				<input type = "text" name = "Posttime" value = "<?php print $_POST['Posttime'];?>" class="input_data2">
			</td>
		</tr>
		<?php
			print("<tr align = \"right\" class=\"input_data\">");
					print("<td>");
						print("<b>หมายเหตุ &nbsp;&nbsp;&nbsp;</b>");
					print("</td>");
					print("<td >");
						print("<input type = \"text\" name = \"note\" value = \"".$_POST['note']."\" style=\"width: 90mm;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
				print("</tr>");


			/*	$datejuarnal = explode("-", $_POST['datetimeout1']);
						$datejn = "";
						for ($j=0; $j < sizeof($datejuarnal); $j++) { 
							$datejn .= $datejuarnal[$j];
						}
						//print $datejn;
						$rest = substr($datejn, 2, 8);//ตัดปี 2017 ให้เป็น 17 เฉยๆ
						$juarnal = getlist("SELECT * FROM production_order where boonpon_id like '$rest%' order by boonpon_id desc");
						if(!empty($juarnal))
						{
							$n4 = $juarnal[0]['boonpon_id']+1; //คือค่าเลขใบเบิกตัวถัดไป
						}else{
							$n4 = $rest."01";
						}
							$_POST['boonpon_id'] = empty($_POST['boonpon_id']) ? $n4 : $_POST['boonpon_id'];
*/
					print("<tr align = \"right\" class=\"input_data\">");
					print("<td>");
						print("<b>เลขจัดกลุ่มขนส่ง &nbsp;&nbsp;&nbsp;</b>");
					print("</td>");
					print("<td >");
						print("<input type = \"text\" name = \"warehouse_id\" value = \"".$_POST['warehouse_id']."\" style=\"width: 90mm;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" required>");
					print("</td>");
				print("</tr>");
		?>
		<tr>
			<td align = "right" class="input_data">
				<b>สินค้า&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" class="input_data2">
				<select name = "id_pro" style = "width:90mm;empty-cells: show;font-family:angsana new;font-size:20px;"onchange="this.form.submit();" >
					<option value = '' >เลือกสินค้า</option>
					<?php
							$get_pro = getlist("SELECT * FROM type_production order by sort_by asc");
							for($i=0;$i<sizeof($get_pro);$i++){
								$selected = $_POST['id_pro'] == $get_pro[$i]['id_production'] ? "selected=\"selected\"" : "";
								print("<option value = \"".$get_pro[$i]['id_production']."\"".$selected.">".$get_pro[$i]['detail_production']."</option>");
							}
					?>
				</select>
			</td>
		</tr>
		<?php
			print("<tr align = \"right\"  class=\"input_data\">");
					print("<td>");
						print("<b>PO Number&nbsp;&nbsp;&nbsp;</b>");
					print("</td>");
					print("<td   class=\"input_data2\">");
						print("<input type = \"text\" name = \"po_number\" value = \"".$_POST['po_number']."\" style=\"width: 90mm;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
				print("</tr>");
			print("<tr class=\"input_data\" align = \"right\">");
					print("<td>");
						print("<b>จำนวน item </b>&nbsp;&nbsp;&nbsp; ");
					print("</td>");
					print("<td colspan=\"2\">");
					
						print("<input type = \"text\" name = \"number_data\" value = \"".$_POST['number_data']."\" style=\"width: 90mm;\"  maxlength=\"2\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" placeholder=\"1-99\" onchange = \"this.form.submit();\">");
					print("</td>");
				print("</tr>");
		?>
		<tr>
			<td colspan = "2" align = "right" style = "width:140mm;height:4mm;" class="text_fide">
				<b>&nbsp;&nbsp;&nbsp;</b>
			</td>
		</tr>

	</table>
								
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;empty-cells: show;">
		<tr>
			<!--<td align = "center" style = "width:30mm;" class="text_fide">
				<b>เลขที่ใบกำกับภาษี</b>
			</td>-->
			<?php 
			$close = array(3,5);
			$bua = array(6,7,13,14,15,16);
			$floor = array(4,8,9,11,12,17,18,21);
			$rubber = array(19,20,22);
			$kaindl = array(23,24);
			$fer = array(25);

					if(in_array($_POST['id_pro'],$close))
					{
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>ชนิดไม้</b>");
						print("</td>");
						$id_pro_new = $_POST['id_pro'];
					}elseif(in_array($_POST['id_pro'],$bua)){
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
						print("<b>โปรไฟล์</b>");
						print("</td>");
						$id_pro_new = "6";
					}elseif(in_array($_POST['id_pro'],$floor) || in_array($_POST['id_pro'],$kaindl)){
						
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>ลาย</b>");
						print("<td>");
						$id_pro_new = "8";
					}elseif(in_array($_POST['id_pro'],$rubber)){
						
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>ลาย</b>");
						print("<td>");
						$id_pro_new = 19;
					}elseif(in_array($_POST['id_pro'],$fer)){
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
						print("<b>โปรไฟล์</b>");
						print("</td>");
						$id_pro_new = 25;
					}else{
						$id_pro_new = $_POST['id_pro'];
					}
			
				print("<td align = \"center\" style = \"width:80mm;\" class=\"text_fide\">");
					print("<b>รายละเอียดขนาด</b>");
				print("</td>");

					if(in_array($_POST['id_pro'],$bua) || in_array($_POST['id_pro'],$fer)){
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>สี</b>");
						print("</td>");
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>กล่อง</b>");
						print("</td>");

					}elseif($_POST['id_pro'] =='5')
					{
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>ลาย</b>");
						print("</td>");
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>เพลท</b>");
						print("</td>");
					}elseif($_POST['id_pro'] =='3'){
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>ชนิดลาย</b>");
						print("</td>");
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>ลาย</b>");
						print("</td>");
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>หน้า</b>");
						print("</td>");
					}elseif(in_array($_POST['id_pro'],$floor) || in_array($_POST['id_pro'],$kaindl)){
						
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>เพลท/กล่อง</b>");
						print("</td>");
						if(!in_array($_POST['id_pro'],$kaindl)){
						print("<td align =\"center\" style = \"width:5mm;\" class=\"text_fide\">");
							print("<b>เซาะ</b>");
						print("</td>");
						}
					}

					$not_show = array(6,7,17,19,20,22,21,23,24,25);
					$check = data_in_array($_POST['id_pro'],$not_show);
					if($check==0){
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>กาว</b>");
						print("</td>");
					}

					$ac = array(4,8,9,11,12,18);//ใช้เฉาะไม้ต่างประเทศ
					$check_ac = data_in_array($_POST['id_pro'],$ac);
					if($check_ac==1){
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>AC</b>");
						print("</td>");
					}


					
			?>
				
			<td align = "center" style = "width:20mm;" class="text_fide">
				<b>เกรด</b>
			</td>
			<?php
			$not_show_quantity = array(4,6,7,17,19,20,22,21,23,24);
				if($not_show_quantity==1){
						print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<b>จำนวนกล่อง</b>");
						print("</td>");
						print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<b>จำนวนเส้น</b>");
						print("</td>");
					}else if($_POST['id_pro']==8){
						print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<b>จำนวนกล่อง</b>");
						print("</td>");
						print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<b>จำนวนแผ่น</b>");
						print("</td>");
					}else if($_POST['id_pro']==25){
						print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<b>จำนวนกล่อง</b>");
						print("</td>");

					}else{
						print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<b>จำนวนตั้ง</b>");
						print("</td>");
						print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<b>จำนวนแผ่น</b>");
						print("</td>");
					}

			?>
		
			<?php
				if(in_array($_POST['id_pro'],$bua)){
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>พาเลท</b>");
						print("</td>");
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>เศษ</b>");
						print("</td>");

					}
			?>
		<!--	<td align = "center" style = "width:15mm;" class="text_fide">
				<b>ราคา</b>
			</td>-->
			<td align = "center" style = "width:15mm;" class="text_fide">
				<b>กำหนดส่ง</b>
			</td>
			<?php
				

				$cus_mark =  array(4,17);
				$check_cus_mark = data_in_array($_POST['id_pro'],$cus_mark);
				if($check_cus_mark==1){
					print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>ลายลูกค้า</b>");
						print("</td>");
				}

				if($check_ac==1){
					print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>ตู้</b>");
						print("</td>");
				}

				if(in_array($_POST['id_pro'],$bua)){
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>type</b>");
						print("</td>");

					}
			?>
			
			
		</tr>	
		<?php

		$size=getlist("SELECT * FROM production_size WHERE product_id = '".$id_pro_new."' order by abs(size_description) asc");
		$gule_data=getlist("SELECT * FROM production_gule WHERE product_id = '".$id_pro_new."' and status=1 order by gule_orderby asc");
						
			for($i=0;$i<$_POST['number_data'];$i++){
		?>
		<tr>
			<!--<td align = "center" style = "width:20mm;" class="text_fide">
				<input type = "text" name = "taxinvoice1[]" value = "<?php print $_POST['taxinvoice1'][$i];?>" style = "width:35mm;" class="text_fide" required>
			</td>-->
			<?php 
//------------------------------------ ไม้ปิดผิวกระดาษ -- ไม้ปิดผิวเฟอร์นิเจอร์(ปิด3) ที่ใช้ชนิดไม้ ในการปิด------------------------------
			
				if(in_array($_POST['id_pro'],$close))
				{
					print("<td align = \"center\" style = \"width:10mm;\" class=\"text_fide\">");
						print("<select name = \"type_wood[]\" style = \"width:25mm;\" class=\"text_fide\" required>");
							print("<option value = '' >ชนิด</option>");
								$ty_w = array("ไม้MDF","ไม้PB");
								for($k=0;$k<sizeof($ty_w);$k++){
									print("<option value = \"".$ty_w[$k]."\"".$selected.">".$ty_w[$k]."</option>");
								}
						print("</select>");
					print("</td>");
				}elseif(in_array($_POST['id_pro'],$bua)){
					print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<select name = \"plate_select[]\" style = \"width:25mm;\" class=\"text_fide\">");
							print("<option value = '' >โปรไฟล์</option>");
						
								$get_plate = getlist("SELECT * FROM production_plate WHERE product_id='".$id_pro_new."' order by ABS(plate_name) asc");
								for($k=0;$k<sizeof($get_plate);$k++){
									$selected = $_POST['plate_select'][$i] == $get_plate[$k]['plate_name'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_plate[$k]['plate_name']."\"".$selected.">".$get_plate[$k]['plate_name']."</option>");
								}
						print("</select>");
					print("</td>");
				}elseif(in_array($_POST['id_pro'],$floor) || in_array($_POST['id_pro'],$kaindl)){
						
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
							/*print("<select name = \"marking[]\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<option value = '' >ลาย</option>");
							$get_plate = getlist("SELECT * FROM production_marking WHERE product_id='".$_POST['id_pro']."'");
							for($k=0;$k<sizeof($get_plate);$k++){
								print("<option value = \"".$get_plate[$k]['mark_name']."\"".$selected.">".$get_plate[$k]['mark_name']."</option>");
							}
							print("</select>");*/
							print("<input name = \"marking[]\" id=\"marking[]\" value = \"".$_POST['marking'][$i]."\" style=\"width:18mm;\" class=\"text_fide marking_show\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" >");
						
						print("<td>");
					
				}elseif(in_array($_POST['id_pro'],$rubber)){
						
						print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
						
							print("<select name = \"marking[]\" style = \"width:25mm;\" class=\"text_fide\">");
							print("<option value = '' >ลาย</option>");
							
									$get_plate = getlist("SELECT * FROM production_marking WHERE product_id='".$id_pro_new."' order by ABS(mark_name) asc");
									for($k=0;$k<sizeof($get_plate);$k++){
										$selected = $_POST['marking'][$i] == $get_plate[$k]['mark_name'] ? "selected=\"selected\"" : "";
										print("<option value = \"".$get_plate[$k]['mark_name']."\"".$selected.">".$get_plate[$k]['mark_name']."</option>");
									}
							
							print("</select>");
						
						print("<td>");
					
				}elseif(in_array($_POST['id_pro'],$fer)){
					print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<select name = \"plate_select[]\" style = \"width:25mm;\" class=\"text_fide\">");
							print("<option value = '' >โปรไฟล์</option>");
						
								$get_plate = getlist("SELECT * FROM production_plate WHERE product_id='".$id_pro_new."' order by ABS(plate_name) asc");
								for($k=0;$k<sizeof($get_plate);$k++){
									$selected = $_POST['plate_select'][$i] == $get_plate[$k]['plate_name'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_plate[$k]['plate_name']."\"".$selected.">".$get_plate[$k]['plate_name']."</option>");
								}
						print("</select>");
					print("</td>");
				}


						print("<td>");
							print("<select name = \"Orders[]\" style=\"width:30mm;\" class=\"text_fide\" required>");
							print("<option value = \"\">เลือกขนาด</option>");
								
									for($s=0; $s<sizeof($size);$s++)
									{
										$selected = $_POST['Orders'][$i] == $size[$s]['size_description'] ? "selected=\"selected\"" : "";
										print("<option value = \"".$size[$s]['size_description']."\"".$selected.">".$size[$s]['size_description']."</option>"); 
									}
							print("</select>");
						print("</td>");
						
						
	
//-------------------------------------------------------------- ไม้บัวในประเทศ -- ไม้บัวต่างประเทศ ---------------------------------
			if(in_array($_POST['id_pro'],$bua) || in_array($_POST['id_pro'],$fer)){
				print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"marking[]\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<option value = '' >สี</option>");
						
								$get_plate = getlist("SELECT * FROM production_marking WHERE product_id='".$id_pro_new."' order by ABS(mark_name) asc");
								for($k=0;$k<sizeof($get_plate);$k++){
									$selected = $_POST['marking'][$i] == $get_plate[$k]['mark_name'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_plate[$k]['mark_name']."\"".$selected.">".$get_plate[$k]['mark_name']."</option>");
								}
						
					print("</select>");
				print("</td>");	

				print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"box[]\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<option value = '' >กล่อง</option>");
						
								$get_plate = getlist("SELECT * FROM production_box WHERE product_id='".$id_pro_new."' order by ABS(box_orderby) asc");
								for($k=0;$k<sizeof($get_plate);$k++){
									$selected = $_POST['box'][$i] == $get_plate[$k]['box_name'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_plate[$k]['box_name']."\"".$selected.">".$get_plate[$k]['box_name']."</option>");
								}
						
					print("</select>");
				print("</td>");	
//---------------------------------------------------------------ไม้ปิดผิวเฟอร์นิเจอร์(ปิด3)-------------------------------
			}elseif(!empty($_POST['id_pro']) and  $_POST['id_pro'] =='5')
				{
				print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
				print("<select name = \"marking[]\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<option value = '' >ลาย</option>");
					
							$get_plate = getlist("SELECT * FROM production_marking WHERE product_id='".$id_pro_new."'");
							for($k=0;$k<sizeof($get_plate);$k++){
								print("<option value = \"".$get_plate[$k]['mark_name']."\"".$selected.">".$get_plate[$k]['mark_name']."</option>");
							}
					
				print("</select>");
				print("</td>");

				print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"plate_select[]\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<option value = '' >เลือกเพลท</option>");
					
							$get_plate = getlist("SELECT * FROM production_plate WHERE product_id='".$id_pro_new."'");
							for($k=0;$k<sizeof($get_plate);$k++){
								$selected = $_POST['plate_select'][$i] == $get_plate[$k]['plate_name'] ? "selected=\"selected\"" : "";
								print("<option value = \"".$get_plate[$k]['plate_name']."\"".$selected.">".$get_plate[$k]['plate_name']."</option>");
							}
					
					print("</select>");
				print("</td>");
//----------------------------------------------------------- ปิดกระดาษ ------------------------------------------------------
				}elseif($_POST['id_pro'] =='3'){
					print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"type_mark[]\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<option value = '' >ลาย</option>");
						
								$get_type_mark = getlist("SELECT * FROM another_data WHERE product_id='".$id_pro_new."' and type='1'");
								for($k=0;$k<sizeof($get_type_mark);$k++){
									$selected = $_POST['type_mark'][$i] == $get_type_mark[$k]['size_code'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_type_mark[$k]['size_code']."\"".$selected.">".$get_type_mark[$k]['size_code']."</option>");
								}
						
					print("</select>");
					print("</td>");

					print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"marking[]\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<option value = '' >ลาย</option>");
						
								$get_plate = getlist("SELECT * FROM production_marking WHERE product_id='".$id_pro_new."' order by ABS(mark_name) asc");
								for($k=0;$k<sizeof($get_plate);$k++){
									$selected = $_POST['marking'][$i] == $get_plate[$k]['mark_name'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_plate[$k]['mark_name']."\"".$selected.">".$get_plate[$k]['mark_name']."</option>");
								}
						
					print("</select>");
					print("</td>");

					print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"side[]\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<option value = '' >หน้า</option>");
						
								$get_side = array(""=>"หน้าเดียว","/D"=>"สองหน้า");
								while (list($key, $value) = each($get_side)) {
									$selected=$_POST['report']==$key ? "selected=\"selected\"" : "";
						       		print("<option value='$key' ".$selected.">$value</option>");
								}
						
					print("</select>");
					print("</td>");
//----------------------------------------------------------------- ไม้พื้น ---------------------------------------------------------
				}elseif(in_array($_POST['id_pro'],$floor) || in_array($_POST['id_pro'],$kaindl)){
	//onchange = \"this.form.submit();\"
					
					print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
						
						print("<input name = \"plate_select[]\" id=\"plate_select[]\" value = \"".$_POST['plate_select'][$i]."\" style=\"width:18mm;\" class=\"text_fide plate_show\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" >");

					print("</td>");
					if(!in_array($_POST['id_pro'],$kaindl)){
					print("<td align =\"center\" style = \"width:5mm;\" class=\"text_fide\">");
						print("<select name = \"type_wood[]\" style = \"width:15mm;\" class=\"text_fide\" >");
							print("<option value = '' >เซาะ</option>");
								$number_s = array("1","2","3","4");
								for($k=0;$k<sizeof($number_s);$k++){
									$selected = $_POST['type_wood'][$i] == $number_s[$k] ? "selected=\"selected\"" : "";
									print("<option value = \"".$number_s[$k]."\"".$selected.">".$number_s[$k]."</option>");
								}
						print("</select>");
					print("</td>");
					}
				}
//----------------------------------------------------------------ไม้บัวไม่มีกาว--------------------------------------------------------
				$not_show = array(6,7,17,19,20,22,21,23,24,25);
				$check = data_in_array($_POST['id_pro'],$not_show);
				if($check==0){
						print("<td>");
						$width_mdf = $_POST['id_pro']==2 ? "width:40mm;": "width:20mm;";
							print("<select name = \"glue1[]\" style=\"$width_mdf\" class=\"text_fide\">");
							print("<option value = \"\">กาว</option>");
			
									for($s=0; $s<sizeof($gule_data);$s++)
									{
										$selected = $_POST['glue1'][$i] == $gule_data[$s]['gule_description'] ? "selected=\"selected\"" : "";
										print("<option value = \"".$gule_data[$s]['gule_description']."\"".$selected.">".$gule_data[$s]['gule_description']."</option>"); 
									}
								
							print("</select>");
						print("</td>");

				}

				$ac = array(4,8,9,11,18);
					$check = data_in_array($_POST['id_pro'],$ac);
					if($check==1){
						print("<td>");
							print("<select name = \"side[]\" style=\"width:15mm;\" class=\"text_fide\">");
							print("<option value = \"\">AC</option>");
			
									$ac_data = array("AC1","AC2","AC3","AC4","AC5");
					
									for($k=0;$k<sizeof($ac_data);$k++){
										$selected = $_POST['side'][$i] == $ac_data[$k] ? "selected=\"selected\"" : "";
										print("<option value = \"".$ac_data[$k]."\"".$selected.">".$ac_data[$k]."</option>");
									}
								
							print("</select>");
						print("</td>");
					}
			?>
	
						

			<td align = "center" style = "width:20mm;" class="text_fide">
				<select name = "grade[]" style = "width:15mm;" class="text_fide" required>
					
					<?php
							$grade_data = array("A","B","C","LG");
					
							for($k=0;$k<sizeof($grade_data);$k++){
								$selected = $_POST['grade'][$i] == $grade_data[$k] ? "selected=\"selected\"" : "";
								print("<option value = \"".$grade_data[$k]."\"".$selected.">".$grade_data[$k]."</option>");
							}
						
					?>
				</select>
			</td>
			
			
			
			<td align = "center" style = "width:10mm;" class="text_fide">
				<input type = "text" name = "counts[]" value = "<?php print $_POST['counts'][$i];?>" style = "width:20mm;" class="text_fide" OnKeyPress="return chkNumber(this)" >
			</td>
		
			<?php
				if($_POST['id_pro'] !=25){
				print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
						print("<input type = \"text\" name = \"quantity[]\" value = \"".$_POST['quantity'][$i]."\" style = \"width:20mm;\" class=\"text_fide\" OnKeyPress=\"return chkNumber(this)\" required>");
					print("</td>");
				}

				if(in_array($_POST['id_pro'],$bua)){
					print("<td align = \"center\" style = \"width:10mm;\" class=\"text_fide\">");
						print("<input type = \"text\" name = \"palette[]\" value = \"".$_POST['palette'][$i]."\" style = \"width:20mm;\" class=\"text_fide\" OnKeyPress=\"return chkNumber(this)\" >");
					print("</td>");

					print("<td align = \"center\" style = \"width:10mm;\" class=\"text_fide\">");
						print("<input type = \"text\" name = \"scrap[]\" value = \"".$_POST['scrap'][$i]."\" style = \"width:20mm;\" class=\"text_fide\" OnKeyPress=\"return chkNumber(this)\" >");
					print("</td>");
				}
			?>
			<!--<td align = "center" style = "width:15mm;" class="text_fide">
				<input type = "text" name = "price[]" value = "<?php print $_POST['price'][$i];?>" style = "width:20mm;" class="text_fide" OnKeyPress="return chkNumber(this)" required>
			</td>-->
			<td align = "center" style = "width:15mm;" class="text_fide">

			<?php
				$_POST['submit_date'][$i] = empty($_POST['submit_date'][$i]) ? $_POST['datetimeout1'] : $_POST['submit_date'][$i];
			?>

				<input type = "text" name = "submit_date[]" class="datetimeout" value = "<?php print $_POST['submit_date'][$i];?>" style = "width:20mm;" class="text_fide" required>
			</td>

			<?php
				
				if($check_cus_mark==1){
					print("<td align =\"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<input name = \"customer_mark[]\" value = \"".$_POST['customer_mark'][$i]."\" style=\"width:25mm;\" class=\"text_fide \"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" >");
						
						print("</td>");
				}

				if($check==1){
					print("<td align =\"center\" style = \"width:15mm;\" class=\"text_fide\">");
							print("<input name = \"note_order[]\" value = \"".$_POST['note_order'][$i]."\" style=\"width:25mm;\" class=\"text_fide \"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" >");
						
						print("</td>");
				}

				if(in_array($_POST['id_pro'],$bua)){
					print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
						print("<input type = \"text\" name = \"type_bj[]\" value = \"".$_POST['type_bj'][$i]."\" style = \"width:20mm;\" class=\"text_fide\" >");
					print("</td>");
				}

			?>
			<script type="text/javascript">
					 $('.datetimeout').datetimepicker({
					 timepicker:false,
					 format:'Y-m-d'
					 });
			 </script>
			
		<tr>
		<?php


			}
		?>
		<tr >
			<td colspan = "10" align = "center" style = "width:140mm;" class="text_fide">
				<input type = "submit" name = "summit" value = "ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					
			</td>
		</tr>
	</table>
	</form>

</html>
