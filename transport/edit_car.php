<html>
<head>
	<title>แก้ไขข้อมูลรถ</title>
	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
	 <link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="datetimepicker/jquery.js"></script>
	<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
	 <style type="text/css">
	 	.font-style{
	 		width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;
	 	}
	 </style>
</head>

<body style="background-color: #d1d4d8;">
<?php 
include("../include/mySqlFunc.php");
query("USE transport");
$id =$_GET['idcar'];
$query_car = getlist("SELECT * FROM car_detail where id_car='$id'");
	if(!empty($_POST['summit'])){
		$licenceplates = $_POST['licenceplates'];
		$licenceplates2 = $_POST['licenceplates2'];
		$typecar = $_POST['typecar'];
		$typefule = $_POST['typefule'];
		$status = $_POST['status'];
		$date_register = $_POST['date_register'];
		$car_max_weight = $_POST['car_max_weight'];
		$car_size = $_POST['car_size'];
		$type_site = $_POST['type_site'];

		$a = query("UPDATE car_detail SET licenceplates = '$licenceplates' , licenceplate2 = '$licenceplates2', "
				."typecar = '$typecar',typefule = '$typefule',status = '$status',date_register = '$date_register',car_max_weight ='$car_max_weight',car_size = '$car_size',type_site='$type_site' where id_car = '$id'");
			if($a){
				$message =  "แก้ไขข้อมูลสำเร็จ";
						print "<script type='text/javascript'>alert('$message');</script>";
						  print "<script>window.opener.location.reload();</script>";
							print "<script>window.close();</script>";
	
			}else{
				$message = "ไม่เรียบร้อย";
			}
			print "<script type='text/javascript'>alert('$message');</script>";
	}
//print shrink2fitCell($query_driver[0]['namedriver1'],32,18);

	$_POST['car_max_weight'] = empty($_POST['car_max_weight']) ? $query_car[0]['car_max_weight'] : $_POST['car_max_weight'];
	$_POST['car_size'] = empty($_POST['car_size']) ? $query_car[0]['car_size'] : $_POST['car_size'];
	$_POST['date_register'] = empty($_POST['date_register']) ? $query_car[0]['date_register'] : $_POST['date_register'];
 ?>
<form action="" method="POST" name = "edit_car" >
<div class="container">
<div style="text-align:center;font-family:angsana new;font-size:30px; margin-top:20px; margin-bottom:20px;"><b>ฟอร์มแก้ไขข้อมูลรถ</b></div>
    <table class="center" align="center">
		<tr>
			<td class="font-style"> <b>เลขทะเบียน </b></td>
			<td colspan = "2" align = "height:8mm;">
            <input name = "licenceplates" type = "text" id = "name_driver" size = "25" maxlength = "50"  value = "<?php print $query_car[0]['licenceplates'];?>" class="font-style" required>
          </td>
		</tr>
		<tr>
			<td class="font-style"><b>เลขทะเบียนพ่วง</b></td>
			<td colspan="2" align = "height:8mm;">
            <input name="licenceplates2" type = "text" id = "personalid" size = "25" maxlength = "50"  value = "<?php print $query_car[0]['licenceplate2'];?>" class="font-style">
          </td>
		</tr>
		<tr>
			<td class="font-style">
				<b>ประเภท</b>
			</td>
			<td colspan = "2">
			
			<select name = "typecar" class="font-style" required> 
			<?php 
				$sql = getlist("select detailhcar , typecar from car_detail as cd inner join car_head as ch on cd.typecar = ch.id_hcar where id_car ='$id'"); 
					print("<option value = \"".$sql[0]['typecar']."\"".$selected.">".$sql[0]['detailhcar']."</option>");
			?>
			<?php 
				$quey_typecar = getlist("select * from car_head where id_hcar !='".$sql[0]['typecar']."'"); 
				for($i =0;$i<sizeof($quey_typecar);$i++){
					print("<option value = \"".$quey_typecar[$i]['id_hcar']."\"".$selected.">".$quey_typecar[$i]['detailhcar']."</option>");
			 }?>
			</select>
          </td>
		</tr>
		<tr>
			<td class="font-style"><b>เชื้อเพลิง</b></td>
			<td colspan="2">
            

            <select name = "typefule" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" onchange="this.form.submit();" required="">
				<option value = ''>เลือกประเภทรถ</option>
				<?php
				$_POST['typefule'] = empty($_POST['typefule']) ? $query_car[0]['typefule'] : $_POST['typefule'];
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
			<td class="font-style">
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
			<td class="font-style">
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
			<td class="font-style">
				<b>น้ำหนักบรรทุกสูงสุด</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;">
				<input type = "text" name = "car_max_weight" style = "width:90%;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">ตัน

			</td>
		</tr>

		<?php
		$type_size = array("1"=>"รถสระบุรี","2"=>"รถบ้านบึง","3"=>"อื่นๆ");
			print("<tr>");
				print("<td class=\"font-style\">");
					print("<b>สังกัด</b>");
				print("</td>");
				print("<td align = \"center\" style = \"width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;\">");
					print("<select name=\"type_site\" style=\"width: 90mm;\" onchange=\"this.form.submit();\">");

						while (list($key, $value) = each($type_size)) {
							$selected=$_POST['type_site']==$key ? "selected=\"selected\"" : "";
						       print("<option value='$key' ".$selected.">$value</option>");
						}
					print("</select>");
				print("</td>");
			print("</tr>");
		?>
		<tr>
			<td class="font-style"><b>สถานะ</b></td>
			<td colspan="2">
			<select name="status" class="font-style"> 
				  <option value="1" selected>1</option>
				  <option value="0">0</option> 
			</select>
          </td>
		</tr>
		<tr>
			<td colspan = "10" align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ยืนยันการแก้ไข" style = "width:40mm;empty-cells:show;font-family:angsana new;font-size:25px;">	
			</td>
		</tr>
    </table>
	<div style = "color:red; text-align:center">**เมื่อแก้ไขเสร็จสิ้นระบบจะกลับไปยังหน้ารายงาน</div>
	</div>
</form>
</body>
</html>