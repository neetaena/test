<?php
?>
<center><font color="#000000" face="angsana new"><h1><b>ลงข้อมูลค่าเบี้ยเลี้ยง</b></h1></center></font>
<form action = "" name = "insertplace" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;empty-cells: show;">
		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<b>ชื่อลูกค้า</b>     
            </td>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<select name = "namecustomer" style = "width:70mm;font-family:angsana new;font-size:22px;" onchange="this.form.submit();">
				<option value = "">กรุณาเลือกชื่อลูกค้า</option>
				<?php
						query("USE transport");
						$data = getlist("select * from customer where status = '1'");
						for($i=0;$i<sizeof($data);$i++){
							$selected = $data[$i]['id_customer']==$_POST['namecustomer'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$data[$i]['id_customer']."\"".$selected.">".$data[$i]['namecustomer']."</option>");
						}
				?>
				</select>
	        </td>
		</tr>
		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<b> สถานที่จัดส่ง</b>
			</td>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<select name = "shipping_cus" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<option value = "">กรุณาเลือก</option>
					<?php
						
						query("USE transport");
						$data = getlist("select * from shipping where id_cus = '".$_POST['namecustomer']."' and statusship = '1'");
						for($i=0;$i<sizeof($data);$i++){
							$selected = $data[$i]['id_ship']==$_POST['shipping'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$data[$i]['id_ship']."\"".$selected.">".$data[$i]['detailship']."</option>");
						}
					?>
				</select>
	        </td>
		</tr>
		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>ระยะทางการส่ง</b>
			</td>
			<td>
				<input type="text" name="distance" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>