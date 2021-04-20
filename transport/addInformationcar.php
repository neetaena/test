<?php
	@session_start();
	@ini_set('display_errors', '0');

	include("../include/mySqlFunc.php");
	query("USE transport");
	if(!empty($_POST['summit'])){
		if(!empty($_POST['licenceplates']))
		{
			
				$a = query("INSERT INTO car_detail SET licenceplates = '".$_POST['licenceplates']."'
						,licenceplate2 = '".$_POST['licenceplates2']."'
						,typecar = '".$_POST['typecar']."'
						,typefule = '".$_POST['typefule']."'
						,date_register = '".$_POST['date_register']."'
						,car_max_weight = '".$_POST['car_max_weight']."'
						,car_size = '".$_POST['car_size']."'
						,type_site='".$_POST['type_site']."'
						,status = '1'");
		
		}
		if($a){
			$message =  "เพิ่มข้อมูลสำเร็จ";
			print "<script>window.opener.location.reload();</script>";
				unset($_POST);
		}else{
			$message =  "ไม่สามารถเพิ่มข้อมูลได้";
		}
		print "<script type='text/javascript'>alert('$message');</script>";
	}
?>
<html>
	<link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="datetimepicker/jquery.js"></script>
	<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
	<body bgcolor= "FFFFFF">
	<center><font color="#000000" face="angsana new"><h1><b>ลงข้อมูลรถ</b></h1></center></font>
	<form action = "" name = "insertquarity" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style ="width:180mm;height:10mm;empty-cells: show;">
		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>ประเภทรถ</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<select name = "typecar" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" onchange="this.form.submit();" required="">
				<option value = ''>เลือกประเภทรถ</option>
				<?php
				$ty_user = $_SESSION["permission"]==2 ? "2":"1";
					$gettypecar = getlist("SELECT * from car_head WHERE type_user='$ty_user'");
					for($i=0;$i<sizeof($gettypecar);$i++){
						$selected = $gettypecar[$i]['id_hcar']==$_POST['typecar'] ? "selected=\"selected\"" : "";
						print("<option value = \"".$gettypecar[$i]['id_hcar']."\"".$selected.">".$gettypecar[$i]['detailhcar']."</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;" >
				<b>ทะเบียนรถ</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<input type = "text" name = "licenceplates" value="<?php print $_POST['licenceplates']; ?>" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" required>
			</td>
		</tr>
		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>ทะเบียนรถพ่วง</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<input type = "text" name = "licenceplates2" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">
			</td>
		</tr>
	
		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>เชื้อเพลิง</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;">
				

				<select name = "typefule" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" required="">
				<option value = ''>เลือกประเภทรถ</option>
				<?php
				
					$get_fule = getlist("SELECT * from fule_head");
					for($i=0;$i<sizeof($get_fule);$i++){
						$selected = $get_fule[$i]['typefule']==$_POST['typefule'] ? "selected=\"selected\"" : "";
						print("<option value = \"".$get_fule[$i]['typefule']."\"".$selected.">".$get_fule[$i]['typefule']."</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>วันที่จดทะเบียน</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;">
				<?php
				
					print("<input type = \"text\" name = \"date_register\" id = \"datestart\" value=\"".$_POST['date_register']."\" style = \"width:100%;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\">");
				?>
				
				<script type="text/javascript">
					 jQuery('#datestart').datetimepicker({
					 timepicker:false,
					 format:'Y-m-d'
					 });
				</script>

			</td>
		</tr>

		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>ขนาดที่วางสินค้า</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;">
				
				<select name = "car_size" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" required="">
				<option value = ''>เลือกขนาด</option>
				<?php
				
					$size_car  = array("ปกติ","หางสั้น","หางยาว");
					for($i=0;$i<sizeof($size_car);$i++){
						$selected = $size_car[$i]==$_POST['car_size'] ? "selected=\"selected\"" : "";
						print("<option value = \"".$size_car[$i]."\"".$selected.">".$size_car[$i]."</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>น้ำหนักบรรทุกสูงสุด</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;">
				<input type = "text" name = "car_max_weight" style = "width:90%;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">ตัน

			</td>
		</tr>
		<?php
		$type_size = array("1"=>"รถสระบุรี","2"=>"รถบ้านบึง","3"=>"อื่นๆ");
			print("<tr>");
				print("<td align = \"center\" style = \"width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;\">");
					print("<b>สังกัด</b>");
				print("</td>");
				print("<td align = \"center\" style = \"width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;\">");
					print("<select name=\"type_site\" style=\"width: 90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onchange=\"this.form.submit();\">");

						while (list($key, $value) = each($type_size)) {
							$selected=$_POST['type_site']==$key ? "selected=\"selected\"" : "";
						       print("<option value='$key' ".$selected.">$value</option>");
						}
					print("</select>");
				print("</td>");
			print("</tr>");
		?>
			
		<tr>
			<td colspan = "2" align = "center" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;">
				
			</td>
		</tr>
	
	</form>
	</table>

</html>