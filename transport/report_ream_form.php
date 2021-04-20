			<link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="datetimepicker/jquery.js"></script>
	<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
	 <script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
	<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>
		<link rel="stylesheet" href="css/jquery-ui.css">
  	<script src="jquery/jquery-ui.js"></script>
		<style type="text/css">
			td{
				font-size:22px;
				
				empty-cells: show;
			}
		</style>
		<script type="text/javascript">
			 $(function() {
                        $( ".serach_license" ).autocomplete({
                            source: 'autoComplete/get_license_check.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
                            minLength: 1,
                            
                        });
                    });
		</script>
		<form action="" name="a" method = "POST">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานการเบิกวัสดุประจำรถ</b></h1></center></font>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td  align = "center" >
				ระหว่างวันที่	
			</td>
			<td align = "left" >
				<input type = "text" name = "datein" class="datedata" style="width: 50mm;" value="<?php print $_POST['datein']; ?>" onchange="this.form.submit();" required="">
				
			</td>
			<td  align = "center" >
				ถึง	
			</td>
			<td  align = "left">
				<input type = "text" name = "dateout" class="datedata" value="<?php print $_POST['dateout']; ?>" style="width: 50mm;" onchange="this.form.submit();"  required="">
				<script type="text/javascript">
							 jQuery('.datedata').datetimepicker({
							 timepicker:false,
							 format:'Y-m-d'
							 });
				</script>
			</td>
		</tr>	
		
		<tr>
			


			<td  align = "center" >
				เลขทะเบียน
			</td>
			<td align = "left">
				
				<?php
					
						print("<input type = \"text\" name = \"place_id\" id=\"place_id\" value = \"".$_POST['place_id']."\" style = \"width:50mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" class='serach_license'>");

						$get_license = getlist("SELECT * FROM car_detail WHERE licenceplates='".$_POST['place_id']."' limit 1");
						print("<input type = \"hidden\" name = \"namedriver\"  id = \"namedriver\" value = \"".$get_license[0]['id_car']."\">");

				?>
				<!--<input type = "hidden" name = "namedriver"  id = "namedriver" value = "<?php print $_POST['namedriver'];?>" required>-->
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
								return "autoComplete/get_license.php?&q=" +encodeURIComponent(this.value);
							});
						}
						make_autocom2("place_id","namedriver");*/
					</script>
	
		<tr>
				<td colspan="4" style="text-align:center;padding-top: 10px;">
			<?php
				print("<input   type = \"button\" name = \"summit\" value = \"ยืนยัน\" style=\"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\"  onclick = \"window.open('report_ream.php?datein=".$_POST['datein']."&dateout=".$_POST['dateout']."&department=1&namedriver=".$_POST['place_id']."') \" target=\"_BLANK\">");
			?>
			</td>
		</tr>
		</table>
