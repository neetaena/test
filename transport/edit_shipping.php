<html>
<head>
	<title>แก้ไขข้อมูลสถานที่จัดส่ง</title>
	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
</head>
<body style="background-color: #d1d4d8;">
<?php 
include("../include/mySqlFunc.php");
query("USE transport");
$id =$_GET['id_ship'];
$query_car = getlist("SELECT * FROM shipping where id_ship='$id'");
	if(!empty($_POST['summit'])){
		
		$name_ship = $_POST['name_ship'];
		$grade =  $_POST['grade'];
		$distance = $_POST['distance'];
		$ratefule = $_POST['ratefule'];
		$ratefule2 = $_POST['ratefule2'];
		
		$a = query("UPDATE shipping SET detailship = '$name_ship' ,distanct='$distance',oil_track='$ratefule',oil_talor='$ratefule2',statusship='1'  where id_ship = '$id'");
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
 ?>
<form action="" method="POST" name = "edit_car" >
<div class="container">
<div style="text-align:center;font-family:angsana new;font-size:30px; margin-top:20px; margin-bottom:20px;"><b>ฟอร์มแก้ไขข้อมูลสถานที่จัดส่ง</b></div>
    <table class="center" align="center" style="font-family:angsana new;font-size: 20px;">
		<tr>
			<td  align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">  <b>ชื่อสถานที่จัดส่ง</b></td>
			<td colspan = "2" align = "height:8mm;">
            <input name = "name_ship" type = "text" id = "name_ship" size = "25" maxlength = "50"  value = "<?php print $query_car[0]['detailship'];?>">
          </td>
		</tr>
			<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>ระยะทางการส่ง</b>
			</td>
			<td>
				<input type="text" name="distance" value = "<?php print $query_car[0]['distanct'];?>" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
			<td align = "center"  style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>เกรดการขนส่ง</b>
			</td>
			<td>
				<input type="text" name="grade" value = "<?php print $query_car[0]['grade'];?>" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<b>อัตราเชื้อเพลิง(สิบล้อ)</b>
			</td>
			<td>
				<input type="text" name="ratefule" value = "<?php print $query_car[0]['oil_track'];?>" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<b>อัตราเชื้อเพลิง(เทเลอร์)</b>
			</td>
			<td>
				<input type="text" name="ratefule2" value = "<?php print $query_car[0]['oil_talor'];?>" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		
		<tr>
			<td colspan = "10" align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ยืนยันการแก้ไข" style = "width:40mm;height:8mm;empty-cells:show;font-family:angsana new;font-size:18px;">	
			</td>
		</tr>
    </table>
	<div style = "color:red; text-align:center">**เมื่อแก้ไขเสร็จสิ้นระบบจะกลับไปยังหน้ารายงาน</div>
	</div>
</form>
</body>
</html>