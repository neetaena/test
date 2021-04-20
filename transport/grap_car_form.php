		<link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
			<script type="text/javascript" src="datetimepicker/jquery.js"></script>
			<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
			 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
			 <script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
		<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>
		<form action="" name="test" method = "POST">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานกราฟการใช้งานรถ บุญพรสระบุรี </b></h1></center></font>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
		<?php  

			$date_today = date("Y-m-d");
			$cut_date = explode("-", $date_today);
			$_POST['year'] = empty($_POST['year']) ? $cut_date[0] : $_POST['year'];
			$_POST['month'] = empty($_POST['month']) ? $cut_date[1] : $_POST['month'];
			$_POST['show'] = empty($_POST['show']) ? 1 : $_POST['show'];
			print("<tr>");	
			print("<td colspan = \"2\" align = \"center\" style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
				print("ปี	");
			print("</td>");
			print("<td colspan = \"2\" align = \"left\" style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");

				print("<select name=\"year\" style=\"width: 80%;\" onchange=\"this.form.submit();\">");
				print("<option value='' ></option>");
						for ($i=2017; $i <=2022 ; $i++) { 
							$selected=$_POST['year']==$i ? "selected=\"selected\"" : "";
						       print("<option value='$i' ".$selected.">$i</option>");
						}
					print("</select>");

			print("</td>");
			print("</tr>");	

			print("<tr>");	
				print("<td colspan = \"2\" align = \"center\" style = \"width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
					print("เดือน");
				print("</td>");
				print("<td colspan = \"2\" align = \"left\" style = \"width:65mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
					print("<select name=\"month\" style=\"width: 80%;\" onchange=\"this.form.submit();\">");
				 $monthx = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");

							while (list($key, $value) = each($monthx)) {
								$selected=$_POST['month']==$key ? "selected=\"selected\"" : "";
							       print("<option value='$key' ".$selected.">$value</option>");
							}
						print("</select>");
				
				print("</td>");
			print("</tr>");	

			print("<tr>");	
				print("<td colspan = \"2\" align = \"center\" style = \"width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
					print("รูปแบบการแสดง");
				print("</td>");
				print("<td colspan = \"2\" align = \"left\" style = \"width:65mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
					print("<select name=\"show\" style=\"width: 80%;\" onchange=\"this.form.submit();\">");
				 $show = array("1"=>"แสดงเฉพาะเดือน","2"=>"แสดงเฉพาะปี","3"=>"แสดงทั้งเดือนและปี");

							while (list($key, $value) = each($show)) {
								$selected=$_POST['show']==$key ? "selected=\"selected\"" : "";
							       print("<option value='$key' ".$selected.">$value</option>");
							}
						print("</select>");
				
				print("</td>");
			print("</tr>");	

				?>
				<input type = "hidden" name = "license_plate"  id = "namedriver" value = "<?php print $_POST['license_plate'];?>" required>
			</td>
		</tr>
		</table>

		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
	

			<tr>
				<?php
					print("<center><input   type = \"button\" name = \"summit\" value = \"ยืนยัน\" style=\"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\"  onclick = \"window.open('report_grap.php?month=".$_POST['month']."&year=".$_POST['year']."&show=".$_POST['show']."') \" target=\"_BLANK\"></center>");
				?>
			</tr>
		</table>

	</form>

<!------------------------------------------------------------------------------------------------------------->
<form action="" name="test" method = "POST">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานรถพร้อมใช้งานรถ บุญพรสระบุรี </b></h1></center></font>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
			<?php  

				$_POST['date_data'] = empty($_POST['date_data']) ? $date_today: $_POST['date_data'];
			print("<td   align = \"center\" style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
				print("วัน	");
			print("</td>");
			print("<td  align = \"left\" style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");

				print("	<input type = \"date\" name = \"date_data\"  id = \"namedriver\" value = \"".$_POST['date_data']."\" style=\"width: 80%;\" onchange=\"this.form.submit();\">");

			print("</td>");
			print("</tr>");	

		?>
			
			</td>
		</tr>
		</table>

		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
	

			<tr>
				<?php
					print("<center><input   type = \"button\" name = \"summit\" value = \"ยืนยัน\" style=\"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\"  onclick = \"window.open('report_available.php?date_data=".$_POST['date_data']."') \" target=\"_BLANK\"></center>");
				?>
			</tr>
		</table>

	</form>



	<script type="text/javascript">
							 jQuery('.datepicker').datetimepicker({
							 timepicker:false,
							 format:'Y-m-d'
							 });
				</script>