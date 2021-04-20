
<?php
	@session_start();
	@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");
	$path=!empty($_GET['path']) ? $_GET['path'].".php" : "content.php";

	if(!empty($_GET['id_order'])){

   	$result = query("DELETE FROM production_order where id_order='".$_GET['id_order']."'");
		if(!empty($result)){
			  $message = "ลบข้อมูลสำเร็จ";
  			print "<script type='text/javascript'>alert('$message');</script>";
		}

	}


?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรแกรมจัดการขนส่งสินค้า</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel = "stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
	<script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
	<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>
	<link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="datetimepicker/jquery.js"></script>
	<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>

<body>
<header >
<style type="text/css">
	.body_table
	{
		width:50mm;
		height:8mm;
		empty-cells: show;
		font-family:'angsana new';
		font-size:22px;
	}
</style>

</header>
<body>

<?php
	query("USE transport");
	$code = $_GET['code_data'];
	//$code = "VSDP17001868";
	$get_data = getlist("SELECT * FROM production_order where number LIKE '$code'");
	//print("SELECT * FROM production_order where number LIKE '$code'");
	if(!empty($_POST['summit'])){
		
		 date_default_timezone_set("Asia/Bangkok");
    		$date_time =  date("Y-m-d H:i:s");
		
				$new_voucher = $_POST['voucher'];
					$customer = $_POST['customer'];
					$Sendlocation = $_POST['ship_send'];
					$date_send = $_POST['datetimeout1'];
					$note = $_POST['note'];
					$country = $_POST['country'];
					$posttime = $_POST['Posttime'];
					$id_pro = $_POST['id_pro'];
					$sell_name = $_POST['sell_name'];
					$customer_receive_id = $_POST['customer_receive_id'];

					$id = $_POST['id_order'];
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
					$price = $_POST['price'];
					$submit_date = $_POST['submit_date'];
					$warehouse_id = $_POST['warehouse_id'];

					$data_check = strpos($get_data[0]['number'],"ABPS");
						if($data_check !== FALSE)
						{
							$up = ",number='".$voucher."'";
						}else{
							$up = "";
						}
					for($f=0;$f<sizeof($id);$f++)
					{
						$sql = query("UPDATE production_order SET name='$customer',item_number='".$id_stock_import[$f]."',quantity='".$quantity[$f]."',delivery_date='$date_send',delivery_name='$Sendlocation',note='$note',invoice=\"".$invoice[$f]."\",country='$country',number='".$new_voucher."',crate_date='".$date_time."',sell_name='$sell_name',status_data='1',gule='".$glue1[$f]."',grade='".$grade[$f]."',posttime='".$posttime."',plate='".$plate_select[$f]."',type_w='".$type_wood[$f]."',counts='".$counts[$f]."',product_id='".$id_pro."',type_mark='".$type_mark[$f]."',mark_name='".$marking[$f]."',side='".$side[$f]."',price='".$price[$f]."',submit_date='".$submit_date[$f]."',warehouse_id='$warehouse_id',customer_receive='$customer_receive_id' WHERE id_order='".$id[$f]."'");



					}
						query("UPDATE production_order SET country='$country' WHERE delivery_name='$ship_send'");
						
						$message =  "แก้ไขข้อมูลสำเร็จ";
						print "<script type='text/javascript'>alert('$message');</script>";
						print "<script>window.opener.location.reload();</script>";
						print "<script>window.close();</script>";
	
	}

	
?>

	<center><font color="#000000" face="angsana new"><h1><b>แก้ไขข้อมูล(คลังสินค้า)</b></h1></center></font>
	<form action = "" name = "insertquarity" method = "POST" >
	<?php 

		print("<table align=\"center\" style=\"margin-bottom: 15px;\">");
			print("<tr class=\"body_table\">");
					print("<td>");
						print("เลขที่ใบสั่งขาย");
					print("</td>");
					print("<td colspan=\"12\">");
						$data1 = strpos($get_data[0]['number'],"ABPS");
						if($data1 !== false)
						{
							$read = "";
						}else{
							$read = "readonly";
						}
						$_POST['voucher'] = empty($_POST['voucher']) ? $get_data[0]['number'] : $_POST['voucher'];
						print("<input type = \"text\" name = \"voucher\" value = \"".$_POST['voucher']."\" style=\"width: 250px;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" $read>");
					print("</td>");
				print("</tr>");

			print("<tr class=\"body_table\">");
					print("<td>");
						print("ชื่อลูกค้า");
					print("</td>");
					print("<td colspan=\"2\">");
						//print("<input type = \"text\" name = \"customer\" value = \"".$get_data[0]['name']."\" style=\"width: 190px;\" onchange=\"this.form.submit();\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
						print("<textarea name = \"customer_name\" style=\"width: 250px;resize:none;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" readonly>");
						 $get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$get_data[0]['name']."'");
                   		print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
							//print $get_data[0]['name'];
						print("</textarea>");
						print("<input type = \"text\" name = \"customer\" value = \"".$get_data[0]['name']."\" style=\"width: 250px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" hidden>");
					print("</td>");
				print("</tr>");
				print("<tr class=\"body_table\">");
				print("<td >");
					print("ชื่อผู้รับสินค้า");
				print("</td>");
				print("<td colspan=\"2\">");
			
				 $get_customer_receive = getlist("SELECT * FROM customer WHERE id_customer='".$get_data[0]['customer_receive']."'");
				
				$_POST['customer_receive_name'] = empty($_POST['customer_receive_name']) ? $get_customer_receive[0]['namecustomer'] : $_POST['customer_receive_name'];

				$_POST['customer_receive_id'] = empty($_POST['customer_receive_id']) ? $get_data[0]['customer_receive'] : $_POST['customer_receive_id'];

				print("<textarea name = \"customer_receive_name\" id=\"customer_receive_name\" style=\"width: 250px;resize:none;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" >");
								print $_POST['customer_receive_name'];
							//print $get_data[0]['name'];
						print("</textarea>");
			
				print("<input type = \"hidden\" name = \"customer_receive_id\"  id = \"customer_receive_id\" value = \"".$_POST['customer_receive_id']."\">");
				print("</td>");
				print("</tr>");
					?>
				<script type = "text/javascript">
					function make_autocom(autoObj,showObj){
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
					make_autocom("customer_receive_name","customer_receive_id");
				</script> 
				<?php

			print("<tr class=\"body_table\">");
					print("<td>");
						print("สถานที่จัดส่ง ");
					print("</td>");
					print("<td colspan=\"2\">");
						$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$get_data[0]['delivery_name']."'");
						$_POST['ship_send_name'] = empty($_POST['ship_send_name']) ? $get_delivery_name[0]['detailship'] : $_POST['ship_send_name'];
						print("<textarea name = \"ship_send_name\" id=\"ship_send_name\" style=\"width: 250px;resize:none;\" onchange = \"this.form.submit();\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" >");
						
                    		print$_POST['ship_send_name'];//สถานที่จัดส่ง
							
						print("</textarea>");
					//print("<input type = \"text\" name = \"ship_send_name\"  id = \"ship_send_name\" value =\"".$_POST['ship_send_name']."\"  style = \"width:250px;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;\" onchange = \"this.form.submit();\">");
						$_POST['ship_send'] = empty($_POST['ship_send']) ? $get_data[0]['delivery_name'] :$_POST['ship_send'];
						print("<input type = \"text\" name = \"ship_send\" id=\"ship_send\" value = \"".$_POST['ship_send']."\" style=\"width: 250px;\" hidden>");

					print("</td>");
				print("</tr>"); ?>
					<script type="text/javascript">
						function make_autocom2(autoObj,showObj){
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
						make_autocom2("ship_send_name","ship_send");
					</script>
				<?php
				/*print("<tr class=\"body_table\">");
					print("<td>");
						print("จังหวัด ");
					print("</td>");
					print("<td colspan=\"2\">");
						$_POST['country'] = empty($_POST['country']) ? $get_data[0]['country'] : $_POST['country'];
						print("<input type = \"text\" name = \"country\" value = \"".$_POST['country']."\" style=\"width: 250px;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
					print("</td>");
				print("</tr>");*/
				print("<tr class=\"body_table\">");
					print("<td>");
						print("ชื่อ Sell");
					print("</td>");
					print("<td   >");
					$_POST['sell_name'] = empty($_POST['sell_name']) ? $get_data[0]['sell_name'] : $_POST['sell_name'];
						print("<input type = \"text\" name = \"sell_name\" value = \"".$_POST['sell_name']."\" style=\"width: 250px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
				print("</tr>");
				print("<tr  class=\"body_table\">");
					print("<td>");
						print("วันที่ส่งของ");
					print("</td>");
					print("<td>");
					$_POST['datetimeout1'] = empty($_POST['datetimeout1']) ? $get_data[0]['delivery_date'] : $_POST['datetimeout1'];
						print("<input type = \"text\" name = \"datetimeout1\" class=\"datetimeout input_data2\" value = \"".$_POST['datetimeout1']."\" style=\"width: 250px;\">");
						
					print("</td>");
				print("</tr>");
				print("<tr class=\"body_table\">");
					print("<td >");
						print("เวลาส่ง");
					print("</td>");
					print("<td >");
					$_POST['Posttime'] = empty($_POST['Posttime']) ? $get_data[0]['posttime'] : $_POST['Posttime'];
						print("<input type =\"text\" name = \"Posttime\" value = \"".$_POST['Posttime']."\" style=\"width: 250px;\">");
					print("</td>");
				print("</tr>");
			
					print("<tr class=\"body_table\">");
							print("<td>");
								print("หมายเหตุ</b>");
							print("</td>");
							print("<td >");

					$_POST['note'] = empty($_POST['note']) ? $get_data[0]['note'] : $_POST['note'];

								print("<input type = \"text\" name = \"note\" value = \"".$_POST['note']."\" style=\"width: 250px;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
							print("</td>");
						print("</tr>");

				print("<tr class=\"body_table\">");
					print("<td>");
						print("เลขจัดกลุ่มขนส่ง &nbsp;&nbsp;&nbsp;");
					print("</td>");
					print("<td >");
					$_POST['warehouse_id'] =empty($_POST['warehouse_id']) ? $get_data[0]['warehouse_id']:$_POST['warehouse_id'];
						print("<input type = \"text\" name = \"warehouse_id\" value = \"".$_POST['warehouse_id']."\" style=\"width: 250px;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\"  required>");
					print("</td>");
				print("</tr>");
				
				print("<tr class=\"body_table\">");
					print("<td >");
						print("สินค้า");
					print("</td>");
					print("<td>");
						print("<select name = \"id_pro\" style = \"width:250px;empty-cells: show;font-family:angsana new;font-size:20px;\"onchange=\"this.form.submit();\" >");
							print("<option value = '' >เลือกสินค้า</option>");
						$_POST['id_pro'] = empty($_POST['id_pro']) ? $get_data[0]['product_id'] : $_POST['id_pro'];
									$get_pro = getlist("SELECT * FROM type_production WHERE 1");
									for($i=0;$i<sizeof($get_pro);$i++){
										$selected = $_POST['id_pro'] == $get_pro[$i]['id_production'] ? "selected=\"selected\"" : "";
										print("<option value = \"".$get_pro[$i]['id_production']."\"".$selected.">".$get_pro[$i]['detail_production']."</option>");
									}
							
						print("</select>");
					
				
				print("</td>");
				print("</tr>");
				print("<tr class=\"body_table\">");
							print("<td>");
								print("จำนวน item ");
							print("</td>");
							print("<td colspan=\"2\">");
						$_POST['number_data'] = empty($_POST['number_data']) ? sizeof($get_data): $_POST['number_data'];
							
								print("<input type = \"text\" name = \"number_data\" value = \"".$_POST['number_data']."\" style=\"width: 250px;\"  maxlength=\"2\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" placeholder=\"1-99\" onchange = \"this.form.submit();\">");
							print("</td>");
						print("</tr>");
			print("</table>");
			print("<table align=\"center\" style=\"margin-bottom: 15px;\">");
			print("<tr class=\"body_table\">");
							print("<td align = \"center\" style = \"width:30mm;\" class=\"text_fide\">");
							print("เลขที่ใบกำกับภาษี");
						print("</td>");
						
								if(!empty($_POST['id_pro']) and $_POST['id_pro'] =='3' or $_POST['id_pro'] =='5')
								{
									print("<td align =\"center\" style = \"width:10mm;\" class=\"text_fide\">");
									print("<b>ชนิดไม้</b>");
								print("<td>");
								}
					
								print("<td align = \"center\"  style=\"font-family:angsana new;font-size:22px;\">รายละเอียดขนาด</td>");

					
								if(!empty($_POST['id_pro']) and  $_POST['id_pro'] =='5')
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
								}
								
						
							print("<td align = \"center\" style = \"width:10mm;\" class=\"text_fide\">");
							print("<b>กาว</b>");
						print("</td>");
						print("<td align = \"center\" style =\"width:20mm;\"");
							print("<b>เกรด</b>");
						print("</td>");
						print("<td align = \"center\" style = \"width:15mm;\" >");
							print("<b>จำนวนตั้ง</b>");
						print("</td>");
						print("<td align = \"center\" style = \"width:15mm;\">");
							print("<b>จำนวนแผ่น</b>");
						print("</td>");
						print("<td align = \"center\" style = \"width:15mm;\" >");
							print("<b>ราคา</b>");
						print("</td>");
						print("<td align = \"center\" style = \"width:15mm;\">");
							print("<b>กำหนดส่ง</b>");
						print("</td>");
					
			print("</tr>");
		$size=getlist("SELECT * FROM production_size WHERE product_id = '".$_POST['id_pro']."' order by size_orderby asc");
		$gule_data=getlist("SELECT * FROM production_gule WHERE product_id = '".$_POST['id_pro']."' order by gule_orderby asc");
			for($i=0;$i<sizeof($get_data);$i++)
			{
				print("<tr class=\"body_table\">");
					print("<td align = \"center\" style = \"width:30mm;\" class=\"text_fide\">");
						$_POST['taxinvoice1'][$i] = empty($_POST['taxinvoice1'][$i]) ? $get_data[$i]['invoice'] : $_POST['taxinvoice1'][$i];

						print("<input type = \"text\" name = \"taxinvoice1[]\" value = \"".$_POST['taxinvoice1'][$i]."\" style =\"width:35mm;\" class=\"text_fide\" required>");

						$_POST['id_order'][$i] = empty($_POST['id_order'][$i]) ? $get_data[$i]['id_order'] : $_POST['id_order'][$i];
						print("<input type = \"text\" name = \"id_order[]\" value = \"".$_POST['id_order'][$i]."\" style=\"width: 250px;\" hidden>");
					print("</td>");

				if(!empty($_POST['id_pro']) and $_POST['id_pro'] =='3' or $_POST['id_pro'] =='5')
				{
					$_POST['type_wood'][$i] = empty($_POST['type_wood'][$i]) ? $get_data[$i]['type_w'] : $_POST['type_wood'][$i];
					print("<td align = \"center\" style = \"width:10mm;\" class=\"text_fide\">");
						print("<select name = \"type_wood[]\" style = \"width:25mm;\" class=\"text_fide\" required>");
							print("<option value = '' >ชนิด</option>");
					
							$ty_w = array("ไม้MDF","ไม้PB");
							for($k=0;$k<sizeof($ty_w);$k++){
								$selected = $_POST['type_wood'][$i] == $ty_w[$k] ? "selected=\"selected\"" : "";
								print("<option value = \"".$ty_w[$k]."\"".$selected.">".$ty_w[$k]."</option>");
							}
					
						print("</select>");
					print("<td>");
				}
							
			?>
			<td align = "center" style = "width:50mm;" class="text_fide">

							<select name = "Orders[]" style="width:100%;" class="text_fide" required>
							<option value = "">เลือกขนาด</option>
								<?php 
								$_POST['Orders'][$i] = empty($_POST['Orders'][$i]) ? $get_data[$i]['item_number'] : $_POST['Orders'][$i];
									for($s=0; $s<sizeof($size);$s++)
									{
										$selected = $_POST['Orders'][$i] == $size[$s]['size_description'] ? "selected=\"selected\"" : "";
										print("<option value = \"".$size[$s]['size_description']."\"".$selected.">".$size[$s]['size_description']."</option>"); 
									}
								?>
							</select>
						
			</td>
			<?php
			if(!empty($_POST['id_pro']) and  $_POST['id_pro'] =='5')
				{
				print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
				print("<select name = \"marking[]\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<option value = '' >ลาย</option>");

					$_POST['marking'][$i] = empty($_POST['marking'][$i]) ? $get_data[$i]['mark_name'] : $_POST['marking'][$i];
							$get_plate = getlist("SELECT * FROM production_marking WHERE product_id='".$_POST['id_pro']."'");
							for($k=0;$k<sizeof($get_plate);$k++){
								$selected = $_POST['marking'][$i] == $get_plate[$k]['mark_name'] ? "selected=\"selected\"" : "";
								print("<option value = \"".$get_plate[$k]['mark_name']."\"".$selected.">".$get_plate[$k]['mark_name']."</option>");
							}
					
				print("</select>");
				print("</td>");

				print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
				print("<select name = \"plate_select[]\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<option value = '' >เลือกเพลท</option>");
						$_POST['plate_select'][$i] = empty($_POST['plate_select'][$i]) ? $get_data[$i]['plate'] : $_POST['plate_select'][$i];
							$get_plate = getlist("SELECT * FROM production_plate WHERE product_id='".$_POST['id_pro']."'");
							for($k=0;$k<sizeof($get_plate);$k++){
								$selected = $_POST['plate_select'][$i] == $get_plate[$k]['plate_name'] ? "selected=\"selected\"" : "";
								print("<option value = \"".$get_plate[$k]['plate_name']."\"".$selected.">".$get_plate[$k]['plate_name']."</option>");
							}
					
				print("</select>");
				print("</td>");
				}elseif($_POST['id_pro'] =='3'){
					print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"type_mark[]\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<option value = '' >ลาย</option>");

						$_POST['type_mark'][$i] = empty($_POST['type_mark'][$i]) ? $get_data[$i]['type_mark'] : $_POST['type_mark'][$i];
								$get_type_mark = getlist("SELECT * FROM another_data WHERE product_id='".$_POST['id_pro']."' and type='1'");
								for($k=0;$k<sizeof($get_type_mark);$k++){
									$selected = $_POST['type_mark'][$i] == $get_type_mark[$k]['size_code'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_type_mark[$k]['size_code']."\"".$selected.">".$get_type_mark[$k]['size_code']."</option>");
								}
						
					print("</select>");
					print("</td>");

					print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"marking[]\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<option value = '' >ลาย</option>");
						$_POST['marking'][$i] = empty($_POST['marking'][$i]) ? $get_data[$i]['mark_name'] : $_POST['marking'][$i];
								$get_plate = getlist("SELECT * FROM production_marking WHERE product_id='".$_POST['id_pro']."' order by ABS(mark_name) asc");
								for($k=0;$k<sizeof($get_plate);$k++){
									$selected = $_POST['marking'][$i] == $get_plate[$k]['mark_name'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_plate[$k]['mark_name']."\"".$selected.">".$get_plate[$k]['mark_name']."</option>");
								}
						
					print("</select>");
					print("</td>");

					print("<td align = \"center\" style = \"width:25mm;\" class=\"text_fide\">");
					print("<select name = \"side[]\" style = \"width:25mm;\" class=\"text_fide\">");
						print("<option value = '' >ลาย</option>");
						$_POST['side'][$i] = empty($_POST['side'][$i]) ? $get_data[$i]['side'] : $_POST['side'][$i];
								$get_side = array(""=>"หน้าเดียว","/D"=>"สองหน้า");
								while (list($key, $value) = each($get_side)) {
									$selected=$_POST['side']==$key ? "selected=\"selected\"" : "";
						       		print("<option value='$key' ".$selected.">$value</option>");
								}
						
					print("</select>");
					print("</td>");
					
				}
			?>
	
				<td>
								<select name = "glue1[]" style="width:30mm;" class="text_fide">
								<option value = "">กาว</option>
									<?php 
									$_POST['glue1'][$i] = empty($_POST['glue1'][$i]) ? $get_data[$i]['gule'] : $_POST['glue1'][$i];
										for($s=0; $s<sizeof($gule_data);$s++)
										{
											$selected = $_POST['glue1'][$i] == $gule_data[$s]['gule_description'] ? "selected=\"selected\"" : "";
											print("<option value = \"".$gule_data[$s]['gule_description']."\"".$selected.">".$gule_data[$s]['gule_description']."</option>"); 
										}
									?>
								</select>
							</td>

				<td align = "center" style = "width:20mm;" class="text_fide">
					<select name = "grade[]" style = "width:15mm;" class="text_fide" required>
						
						<?php
						$_POST['grade'][$i] = empty($_POST['grade'][$i]) ? $get_data[$i]['grade'] : $_POST['grade'][$i];
								query("USE warehouse2");

								$get_grade = getlist("SELECT detail_quality FROM type_quality");
								for($k=0;$k<sizeof($get_grade);$k++){
									$selected = $_POST['grade'][$i] == $get_grade[$k]['detail_quality'] ? "selected=\"selected\"" : "";
									print("<option value = \"".$get_grade[$k]['detail_quality']."\"".$selected.">".$get_grade[$k]['detail_quality']."</option>");
								}
								query("USE transport");
						?>
					</select>
				</td>
				
				<?php
				
				print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
				$_POST['counts'][$i] = empty($_POST['counts'][$i]) ? $get_data[$i]['counts'] : $_POST['counts'][$i];
					print("<input type = \"text\" name = \"counts[]\" value = \"".$_POST['counts'][$i]."\" style = \"width:20mm;text-align:center;\" class=\"text_fide\">");
				print("</td>");
				print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
				$_POST['quantity'][$i] = empty($_POST['quantity'][$i]) ? $get_data[$i]['quantity'] : $_POST['quantity'][$i];
					print("<input type = \"text\" name = \"quantity[]\" value = \"".$_POST['quantity'][$i]."\" style = \"width:20mm;text-align:center;\" class=\"text_fide\" required>");
				print("</td>");
				print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
				$_POST['price'][$i] = empty($_POST['price'][$i]) ? $get_data[$i]['price'] : $_POST['price'][$i];
					print("<input type = \"text\" name = \"price[]\" value = \"".$_POST['price'][$i]."\" style = \"width:20mm;text-align:center;\" class=\"text_fide\" OnKeyPress=\"return chkNumber(this)\" required>");
				print("</td>");
				print("<td align = \"center\" style = \"width:15mm;\" class=\"text_fide\">");
				$_POST['submit_date'][$i] = empty($_POST['submit_date'][$i]) ? $get_data[$i]['submit_date'] : $_POST['submit_date'][$i];
					print("<input type = \"text\" name = \"submit_date[]\" class=\"datetimeout\" value = \"".$_POST['submit_date'][$i]."\" style = \"width:20mm;\" class=\"text_fide\" required>");
				print("</td>");
				 print("<td align = \"center\" style = \"\" class=\"text_fide\">");
                     print("<a href=\"insertdatawarehouse2.php?code_data=".$code."&id_order=".$get_data[$i]['id_order']."\" onclick=\"return confirm('คุณต้องการลบข้อมูลกาวนี้ใช่หรือไม่?')\"><img src=\"image/delete.png\" title=\"ลบ\" width=\"30px\" height=\"30px\"></a>");
                    print("</td>");

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
				print("<tr class=\"body_table\">");

					print("<td colspan=\"15\" style=\"text-align:center;margin-top:15px;\">");
				print("<br><input type = \"submit\" name = \"summit\" value = \"ยืนยัน\" style = \"width:40mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:18px;\">");
				print("</td>");
				print("</tr>");
	?>
	</form>
	</body>

</html>


