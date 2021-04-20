	<style type="text/css">
		.style-font{
			empty-cells: show;font-family:angsana new;font-size:22px;
		}
	</style>
		<form action="report_all_data.php" name="a" method = "POST" target="_blank">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานข้อมูลการส่งของทั้งหมด</b></h1></center></font>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td colspan = "2" align = "center" style = "width:50mm;" class="style-font">
				ระหว่างวันที่	
			</td>
			<td colspan = "2" align = "left" style = "width:50mm;" class="style-font">
				<input type = "text" name = "datein" class="datepicker style-font" style = "width:50mm;" required="">
				
			</td>
			<td colspan = "2" align = "center" style = "width:15mm;" class="style-font">
				ถึง	
			</td>
			<td colspan = "2" align = "left" style = "width:50mm;" class="style-font">
				<input type = "text" name = "dateout" class="datepicker style-font" style = "width:50mm;" required>
				
			</td>
		</tr>	
		<tr>
			<td colspan = "2" align = "center" style = "width:15mm;" class="style-font">
				ชนิดไม้

			</td>
			<td align = "center" style = "width:50mm;height:10mm;" class="style-font">
			<?php
				
		            print("<select name = \"product_id\" style=\"width:50mm;\">");
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
		</tr>
		</table>
		
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
				<center><input type = "submit" name = "summit2" value = "ยืนยัน" style = "width:40mm;" class="style-font">
		</tr>
		</table>
</form>
			
<!-- _________________________________________________________________ __________________________________________________-->		

<form action="report_all_pedding.php" name="a" method = "POST" target="_blank">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานสินค้ารอจัดส่ง</b></h1></center></font>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td colspan = "2" align = "center" style = "width:50mm;" class="style-font">
				ระหว่างวันที่	
			</td>
			<td colspan = "2" align = "left" style = "width:50mm;" class="style-font">
				<input type = "text" name = "datein" class="datepicker style-font" style = "width:50mm;" required="">
			
			</td>
			<td colspan = "2" align = "center" style = "width:15mm;" class="style-font">
				ถึง	
			</td>
			<td colspan = "2" align = "left" style = "width:50mm;" class="style-font">
				<input type = "text" name = "dateout" class="datepicker style-font" style = "width:50mm;" required>
				
			</td>
		</tr>	
		<tr>
			<td colspan = "2" align = "center" style = "width:15mm;" class="style-font">
				ชนิดไม้

			</td>
			<td align = "center" style = "width:50mm;height:10mm;" class="style-font">
			<?php
				
		            print("<select name = \"product_id\" style=\"width:50mm;\">");
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
		</tr>
		</table>
		
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
				<center><input type = "submit" name = "summit2" value = "ยืนยัน" style = "width:40mm;" class="style-font">
		</tr>
		</table>
</form>

<script type="text/javascript">
							 jQuery('.datepicker').datetimepicker({
							 timepicker:false,
							 format:'Y-m-d'
							 });
				</script>