

	<!--              Excel -----------------------------------------------   -->
	<form action="report_gas_ngv_for_excel.php" name="aa" method = "POST" target="_blank">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานค่า Gas NGV (excel)</b></h1></center></font>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td colspan = "2" align = "center" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				ระหว่างวันที่	
			</td>
			<td colspan = "2" align = "left" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "text" name = "datein"  class="date" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:20px;">
	
			</td>
			<td colspan = "2" align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				ถึง	
			</td>
			<td colspan = "2" align = "left" style = "width:65mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "text" name = "dateout" class="date" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				
			</td>
		</tr>	
		</table>
		
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
				<center><input type = "submit" name = "summit3" value = "ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;">
		</tr>
		</table>
			
			
		<script type="text/javascript">
							 jQuery('.date').datetimepicker({
							 timepicker:false,
							 format:'Y-m-d'
							 });
				</script>