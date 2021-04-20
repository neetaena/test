		<link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
			<script type="text/javascript" src="datetimepicker/jquery.js"></script>
			<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
			 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
			 <script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
		<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>
		<form action="" name="test" method = "POST">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานการใช้เชื้อเพลิง </b></h1></center></font>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
		<?php  
			print("<td colspan = \"2\" align = \"center\" style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
				print("ระหว่างวันที่	");
			print("</td>");
			print("<td colspan = \"2\" align = \"left\" style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
				print("<input type = \"text\" name = \"datein\"  class=\"datepicker\" style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:20px;\" value=\"".$_POST['datein']."\" onchange = \"this.form.submit();\">");
				
			print("</td>");
			print("<td colspan = \"2\" align = \"center\" style = \"width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
				print("ถึง");
			print("</td>");
			print("<td colspan = \"2\" align = \"left\" style = \"width:65mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
				print("<input type = \"text\"  name = \"dateout\"  class=\"datepicker\" value='".$_POST['dateout']."' style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onchange = \"this.form.submit();\">");
			
			print("</td>");
		print("</tr>");	

			/*print("<tr>");
			print("<td  colspan = \"2\" align = \"center\" style = \"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\" >");
				print("ทะเบียนรถ");
			print("</td>");
			print("<td align = \"left\">");

			print("<input type = \"text\" name = \"place_id\" id=\"place_id\" value = \"".$_POST['place_id']."\" style = \"width:50mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\">");*/

				?>
				<input type = "hidden" name = "license_plate"  id = "namedriver" value = "<?php print $_POST['license_plate'];?>" required>
			</td>
		</tr>
		</table>

		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
	

	
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
								return "autoComplete/get_license.php?&q=" +encodeURIComponent(this.value);
							});
						}
						make_autocom2("place_id","namedriver");
					</script>

			<tr>
				<?php
					print("<center><input   type = \"button\" name = \"summit\" value = \"ยืนยัน\" style=\"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\"  onclick = \"window.open('report_all_liquid.php?datein=".$_POST['datein']."&dateout=".$_POST['dateout']."&license_plate=".$_POST['license_plate']."') \" target=\"_BLANK\"></center>");
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