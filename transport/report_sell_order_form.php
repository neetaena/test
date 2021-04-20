<?php
	query("USE transport");


	print("<div style=\"text-align:center;\">รายงานใบสั่งขาย ส่ง SEll</div>");

print("<form action = \"report_sell_order2.php\" name = \"import_stock\" method = \"POST\" target=\"_BLANK\">");
	print("<table align=\"center\" style=\"width : 100mm;text-align: center;font-size: 23px;\">");

	print("<tr class=\"searh_report\" >");
			print("<td colspan=\"\" style=\"padding-top: 10px;\">");
			print("ระหว่าง วันที่<input  type = \"date\" name = \"date_start\" value = \"".$_POST['date_start']."\" style=\"width: 200px;\" >");	
			print("</td>");

			print("<td colspan=\"\" style=\"padding-top: 10px;\">");
			print("ถึง<input  type = \"date\" name = \"date_end\" value = \"".$_POST['date_end']."\" style=\"width: 200px;\" >");	
			print("</td>");
		print("</tr>");
	
		print("<tr class=\"searh_report\" >");
			print("<td colspan=\"2\" style=\"padding-top: 10px;\">");
			print("<input  type = \"submit\" name = \"submit_date\" value = \"ค้นหา\" style=\"width: 200px;\" >");	
			print("</td>");
		print("</tr>");

	
	print("</table>");	
print("</form>");

print("<div style=\"text-align:center;\">รายงานใบสั่งขาย ส่ง SEll(Excel)</div>");
print("<form action = \"excel_sell_order2.php\" name = \"import_stock\" method = \"POST\" target=\"_BLANK\">");
	print("<table align=\"center\" style=\"width : 100mm;text-align: center;font-size: 23px;\">");

	print("<tr class=\"searh_report\" >");
			print("<td colspan=\"\" style=\"padding-top: 10px;\">");
			print("ระหว่าง วันที่<input  type = \"date\" name = \"date_start\" value = \"".$_POST['date_start']."\" style=\"width: 200px;\" >");	
			print("</td>");

			print("<td colspan=\"\" style=\"padding-top: 10px;\">");
			print("ถึง<input  type = \"date\" name = \"date_end\" value = \"".$_POST['date_end']."\" style=\"width: 200px;\" >");	
			print("</td>");
		print("</tr>");
	
		print("<tr class=\"searh_report\" >");
			print("<td colspan=\"2\" style=\"padding-top: 10px;\">");
			print("<input  type = \"submit\" name = \"submit_date\" value = \"สร้าง Excel\" style=\"width: 200px;\" >");	
			print("</td>");
		print("</tr>");

	
	print("</table>");	
print("</form>");


?>	