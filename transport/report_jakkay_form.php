		<style type="text/css">
			td{
				font-size:22px;
				
				empty-cells: show;
			}
		</style>
		<form action="" name="a" method = "POST">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานการขับรถส่งสินค้า</b></h1></center></font>
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
				
				พนักงานขับรถ
			</td>
			<td align = "left" >
				
				<select name = "namedriver" style="width: 50mm;" onchange="this.form.submit();">
					<option value = ''>กรุณาเลือก</option>
					<?php
						query("USE transport");
						$data = getlist("SELECT * from driver where status = '1' and type_user='2'");
						for($i=0;$i<sizeof($data);$i++){
							$selected = $data[$i]['id_driver']==$_POST['namedriver'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$data[$i]['id_driver']."\"".$selected.">".$data[$i]['namedriver1']."</option>");
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
				<td colspan="4" style="text-align:center;padding-top: 10px;">
			<?php
				print("<input   type = \"button\" name = \"summit\" value = \"ยืนยัน\" style=\"width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;\"  onclick = \"window.open('report_jakkay.php?datein=".$_POST['datein']."&dateout=".$_POST['dateout']."&department=".$_POST['department']."&namedriver=".$_POST['namedriver']."') \" target=\"_BLANK\">");
			?>
			</td>
		</tr>
		</table>
