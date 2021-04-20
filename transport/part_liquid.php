<?php

	date_default_timezone_set("Asia/Bangkok");
    $date_time =  date("Y-m-d H:i:s");
    if(!empty($_POST['summit'])){
    	$license_id = $_POST['license_id'];
		$driver_id = $_POST['driver_id'];
		$gas_bar = $_POST['gas_bar'];
		$date_check = $_POST['date_check'];
		$time_check = $_POST['time_check'];
		$note = $_POST['note'];


		for ($p=0; $p < sizeof($license_id); $p++) { 
			if(!empty($license_id[$p])){
				query("INSERT INTO  liquid SET license='".$license_id[$p]."',gas_bar='".$gas_bar[$p]."',date_check='".$date_check[$p]."',time_check='".$time_check[$p]."',note='".$note[$p]."',driver_id='".$driver_id[$p]."'");
			}
		}


    }


	print("<form action = \"\" name = \"insertquarity\" method = \"POST\" >");
		print("<table  bgcolor = \"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding =\"2\" align = \"center\" valign = \"middle\" style=\"width:60%;height:2mm;empty-cells: show;\">");
			print("<tr>");
				print("<td align = \"center\" class=\"text_fide\" colspan='6'>");
					print("จำนวนแถว ");
					$_POST['row'] = empty($_POST['row']) ? 5 : $_POST['row'];
					print("<input type = \"text\" name = \"row\"   value = \"".$_POST['row']."\" style=\"width:10%;\" OnKeyPress=\"return chkNumber(this)\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
				print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td align = \"center\" class=\"text_fide\" >");
					print("<b>ทะเบียนรถ</b>");
				print("</td>");
				print("<td align = \"center\" class=\"text_fide\">");
					print("พนักงานขับรถ");
				print("</td>");
				print("<td align = \"center\" class=\"text_fide\">");
					print("ระดับGAS(บาร์)");
				print("</td>");
				print("<td align = \"center\" class=\"text_fide\">");
					print("วันตรวจ");
				print("</td>");
				print("<td align = \"center\" class=\"text_fide\">");
					print("เวลาที่ตรวจ");
				print("</td>");
				print("<td align = \"center\" class=\"text_fide\">");
					print("หมายเหตุ");
				print("</td>");

			print("</tr>");	

			for ($i=0; $i < $_POST['row']; $i++) 
			{ 
			
				print("<tr>");
					print("<td align = \"center\" class=\"input_data2\" style=\"width:15%;\">");
						
						print("<input name = \"license_name[]\"  value = \"".$_POST['license_name'][$i]."\" style='width:100%' class=\"search_license \" onchange = \"this.form.submit();\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" >");
					$get_license_id = getlist("SELECT * FROM car_detail WHERE licenceplates LIKE '".$_POST['license_name'][$i]."'");
					print("<input type = \"hidden\" name = \"license_id[]\"  value = \"".$get_license_id[0]['id_car']."\" required>");
					print("</td>");

					
					print("<td align = \"center\" class=\"input_data2\" style=\"width:style=\"width:20%;\">");
							print("<input name = \"driver[]\"  value = \"".$_POST['driver'][$i]."\" style=\"width:100%;\" class=\"text_fide search_driver\" onchange = \"this.form.submit();\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" >");
					$get_driver_id = getlist("SELECT * FROM driver WHERE namedriver1 LIKE '".$_POST['driver'][$i]."'");
						print("<input type = \"hidden\" name = \"driver_id[]\"  value = \"".$get_driver_id[0]['id_driver']."\" required>");
					print("</td>");

					print("<td align = \"center\" class=\"input_data2\" style=\"width:15%;\">");
						print("<input type = \"text\" name = \"gas_bar[]\"   value = \"".$_POST['gas_bar'][$i]."\" style=\"width:100%;\" OnKeyPress=\"return chkNumber(this)\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
					print("</td>");

					print("<td style=\"width:12%;\">");
						$_POST['date_check'][$i] = empty($_POST['date_check'][$i]) ? $get_data[0]['delivery_date'] : $_POST['date_check'][$i];
							print("<input type = \"text\" name = \"date_check[]\" class=\"datetimeout input_data2\" value = \"".$_POST['date_check'][$i]."\" style=\"width: 100%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
							
					print("</td>");

					print("<td align = \"center\" class=\"input_data2\" style=\"width:10%;\"> ");
						print("<input type = \"text\" name = \"time_check[]\"   value = \"".$_POST['time_check'][$i]."\" style='width:100%' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" maxlength='5' OnKeyPress=\"return chkNumber(this)\">");
					print("</td>");

					print("<td align = \"center\" class=\"input_data2\" style=\"width:25%;\">");
						print("<input type = \"text\" name = \"note[]\"   value = \"".$_POST['note'][$i]."\" style='width:100%' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" maxlength='256'>");
					print("</td>");
				print("</tr>");	
			}
				
				print("<tr >");
					print("<td colspan = \"10\" align = \"center\" style = \"width:140mm;\" class=\"text_fide\">");
						print("<input type = \"submit\" name = \"summit\" value = \"ยืนยัน\" style = \"width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;\">");
							
					print("</td>");
				print("</tr>");
					
		print("</table>");
	print("</form>");
?>