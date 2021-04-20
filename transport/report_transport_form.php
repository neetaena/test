
		<form action="report_transport.php" name="a" method = "POST" target="_blank">
		<center><font color="#000000" face="angsana new"><h1><b>รายงานการขนส่งสินค้า</b></h1></center></font>
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td colspan = "2" align = "center" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				ระหว่างวันที่	
			</td>
			<td colspan = "2" align = "left" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "text" name = "datein" id = "datein" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<script type="text/javascript">
							 jQuery('#datein').datetimepicker({
							 timepicker:false,
							 format:'Y-m-d'
							 });
				</script>
			</td>
			<td colspan = "2" align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				ถึง	
			</td>
			<td colspan = "2" align = "left" style = "width:65mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "text" name = "dateout" id="dateout" style = "width:50mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<script type="text/javascript">
							 jQuery('#dateout').datetimepicker({
							 timepicker:false,
							 format:'Y-m-d'
							 });
				</script>
			</td>
		</tr>	
		</table>
		
		<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
		<tr>
				<center><input type = "submit" name = "summit2" value = "ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;">
		</tr>
		</table>

			
			
		