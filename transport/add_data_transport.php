<script type="text/javascript">
	function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
						ele.onKeyPress=vchar;
						}	
</script>
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
	<script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
	<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>


<?php
	query("USE transport");
	$code = $_GET['code_data'];
	//$code = "VSDP17001868";
	if(!empty($_POST['summit'])){
		
		
					
					$voucher_run = getlist("SELECT * FROM production_transport WHERE number like 'ABPS%' order by id_order desc limit 1");
						if(!empty($voucher_run[0]['number']))
						{
								$text1 = substr($voucher_run[0]['number'], 0,4);
								$number_v = substr($voucher_run[0]['number'], 4,8);

								$voucher_num = $number_v+1;
								$new_voucher = $text1.$voucher_num;
						}else{
							$new_voucher ="ABPS17000100";
						}
					
					$customer = $_POST['customer'];
					$ship_send = $_POST['ship_send'];
					$date_send = $_POST['date_send'];
					$note = $_POST['note'];
					$country = $_POST['country'];

					$id_order = $_POST['id_order'];
					$id_stock_import = $_POST['id_stock_import'];
					$quantity = $_POST['quantity'];
					$invoice = $_POST['invoice'];
					$sell_name = $_POST['sell_name'];
				if(!empty($customer))
				{
					for($f=0;$f<sizeof($id_stock_import);$f++)
					{
						if(!empty($id_stock_import[$f]))
						{
							$sql = query("INSERT INTO production_order SET name='$customer',item_number='".$id_stock_import[$f]."',quantity='".$quantity[$f]."',delivery_date='$date_send',delivery_name='$ship_send',note='$note',invoice=\"".$invoice[$f]."\",country='$country',number='".$new_voucher."',crate_date='".date('Y-m-d')."',sell_name='$sell_name',status_data='1'");

						query("INSERT INTO production_transport SET name='$customer',item_number='".$id_stock_import[$f]."',quantity='".$quantity[$f]."',delivery_date='$date_send',delivery_name='$ship_send',note='$note',invoice=\"".$invoice[$f]."\",country='$country',number='".$new_voucher."',crate_date='".date('Y-m-d')."',sell_name='$sell_name'");
						}
						
					
					}
					query("UPDATE production_order SET country='$country' WHERE delivery_name='$ship_send'");
					query("UPDATE production_transport SET country='$country' WHERE delivery_name='$ship_send'");
						$message =  "เพิ่มข้อมูลสำเร็จ";
						unset($_POST);
						
						print("<meta http-equiv='refresh' content='0; url= index.php?path=add_data_transport'>");
				
				}else{
					$message =  "กรุณาเลือกชื่อลูกค้าให้ถูกต้อง";	
				}
					
						
						
			print "<script type='text/javascript'>alert('$message');</script>";
	}

	
?>

	<center><font color="#000000" face="angsana new"><h1><b>ลงข้อมูล(คลังสินค้า)</b></h1></center></font>
	<form action = "" name = "insertquarity" method = "POST" >
	<?php 

		print("<table align=\"center\" style=\"margin-bottom: 15px;\">");
			print("<tr class=\"body_table\">");
					print("<td>");
						print("เลขที่ใบสั่งขาย");
					print("</td>");
					print("<td colspan=\"2\">");
						$voucher_run = getlist("SELECT * FROM production_transport WHERE number like 'ABPS%' order by id_order desc limit 1");
						if(!empty($voucher_run[0]['number']))
						{
								$text1 = substr($voucher_run[0]['number'], 0,4);
								$number_v = substr($voucher_run[0]['number'], 4,8);

								$voucher_num = $number_v+1;
								$new_voucher = $text1.$voucher_num;
						}else{
							$new_voucher ="ABPS17000100";
						}
						$_POST['voucher']= empty($_POST['voucher']) ? $new_voucher : $_POST['voucher'];
						print("<input type = \"text\" name = \"voucher\" value = \"".$_POST['voucher']."\" style=\"width: 250px;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" >");
					print("</td>");
				print("</tr>");

			print("<tr class=\"body_table\">");
					print("<td>");
						print("ชื่อลูกค้า");
					print("</td>");
					print("<td colspan=\"2\">");
						//print("<input type = \"text\" name = \"customer\" value = \"".$get_data[0]['name']."\" style=\"width: 190px;\" onchange=\"this.form.submit();\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
						print("<textarea name = \"customer_name\" id=\"customer_name\" style=\"width: 250px;resize:none;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\"onchange = \"this.form.submit();\" >");
								print $_POST['customer_name'];
							//print $get_data[0]['name'];
						print("</textarea>");
						print("<input type = \"text\" name = \"customer\" id=\"customer\" value = \"".$_POST['customer']."\" style=\"width: 250px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" hidden>");
						

					print("</td>");
				print("</tr>");
				?>
					<script type="text/javascript">
						function make_autocom3(autoObj,showObj){
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
								return "autoComplete/gdata4.php?&q=" +encodeURIComponent(this.value);
							});
						}
						make_autocom3("customer_name","customer");
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
				print("<tr class=\"body_table\">");
					print("<td>");
						print("จังหวัด ");
					print("</td>");
					print("<td colspan=\"2\">");
						$get_country = getlist("SELECT country FROM production_transport where delivery_name like '".$_POST['ship_send']."' limit 1");
						$_POST['country'] = !empty($get_country[0]['country']) ? $get_country[0]['country'] : $_POST['country'];
						print("<input type = \"text\" name = \"country\" value = \"".$_POST['country']."\" style=\"width: 250px;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
					print("</td>");
				print("</tr>");

				print("<tr class=\"body_table\">");
					print("<td>");
						print("ชื่อ Sell");
					print("</td>");
					print("<td colspan=\"2\">");
						print("<input type = \"text\" name = \"sell_name\" value = \"".$_POST['sell_name']."\" style=\"width: 250px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
				print("</tr>");

			print("<tr class=\"body_table\">");
					print("<td>");
						print("วันที่ส่งของ ");
					print("</td>");
					print("<td colspan=\"2\">");
						print("<input type = \"date\" name = \"date_send\" value = \"".$_POST['date_send']."\" style=\"width: 250px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
				print("</tr>");

			print("<tr class=\"body_table\">");
					print("<td>");
						print("หมายเหตุ ");
					print("</td>");
					print("<td colspan=\"2\">");
						print("<input type = \"text\" name = \"note\" value = \"".$_POST['note']."\" style=\"width: 250px;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");
				print("</tr>");
				print("<tr class=\"body_table\">");
					print("<td>");
						print("จำนวน item ");
					print("</td>");
					print("<td colspan=\"2\">");
					
						print("<input type = \"text\" name = \"number_data\" value = \"".$_POST['number_data']."\" style=\"width: 250px;\"  maxlength=\"2\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" placeholder=\"1-99\" onchange = \"this.form.submit();\">");
					print("</td>");
				print("</tr>");
			print("<tr class=\"body_table\">");
						print("<td>");
							print("Invoice");
						print("</td>");
						print("<td>");
							print("Item Number");
						print("</td>");
						print("<td>");	
							print("รายละเอียด");
						print("</td>");
						print("<td>");	
							print("จำนวนแผ่น");
						print("</td>");
					
			print("</tr>");

			for($i=0;$i<$_POST['number_data'];$i++)
			{
				//query("USE transport");
					print("<tr class=\"body_table\">");
					print("<td>");
						
							print("<input type = \"text\" name = \"invoice[]\" class=\"search_box\" value = \"".$_POST['invoice'][$i]."\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" style=\"width:50mm;\" >");//รหัสพัสดุ
						print("</td>");
						print("<td>");
						
							print("<input type = \"text\" name = \"id_stock_import[]\" class=\"search_box\" value = \"".$_POST['id_stock_import'][$i]."\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" style=\"width:50mm;\" >");//รหัสพัสดุ
						print("</td>");
						print("<td>");	
				query("USE productionax");
							$query_description = getlist("SELECT * from itemdescription where itemID ='".$_POST['id_stock_import'][$i]."'");					
							print("<input type = \"text\" name = \"list_import[]\" value = \"".$query_description[0]['detail']."\" style=\"width:100mm;\" disabled >");//รายการ
						print("</td>");
						print("<td>");	
				query("USE transport");
							print("<input type = \"text\" name = \"quantity[]\" value = \"".$_POST['quantity'][$i]."\" OnKeyPress=\"return chkNumber(this)\" style=\"width:20mm;text-align:center;\">");//รายการ
						print("</td>");
						
					print("</tr>");
			}
				print("<tr class=\"body_table\">");

					print("<td colspan=\"3\" style=\"text-align:center;margin-top:15px;\">");
				print("<br><input type = \"submit\" name = \"summit\" value = \"ยืนยัน\" style = \"width:40mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:18px;\">");
				print("</td>");
				print("</tr>");
	?>
	</form>

