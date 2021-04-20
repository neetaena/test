<html>
<head>
	<title>แก้ไขข้อมูลลูกค้า</title>
	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
	 <style type="text/css">
	 	.center{
	 		font-family:angsana new;font-size:20px;
	 	}
	 </style>
</head>
<body style="background-color: #d1d4d8;font-family:'angsana new';font-size:20px;">
<?php 
include("../include/mySqlFunc.php");
query("USE transport");
$id =$_GET['id_customer'];
$query_customer = getlist("SELECT * FROM customer where id_customer='$id'");
	if(!empty($_POST['summit'])){
		$namecustomer = $_POST['namecustomer'];
		$address = $_POST['address'];
		$phonenumber = $_POST['phonenumber'];
	
		$a = query("UPDATE customer SET namecustomer = '$namecustomer' , address = '$address', "
				."phonenumber = '$phonenumber' where id_customer = '$id'");
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
<form action="" method="POST" name = "edit_customer" >
<div class="container">
<div style="text-align:center;font-family:angsana new;font-size:30px; margin-top:20px; margin-bottom:20px;"><b>ฟอร์มแก้ไขข้อมูลลูกค้า</b></div>
    <table class="center" align="center">
		<tr>
			<td> ชื่อลูกค้า </td>
			<td colspan = "2" align = "height:8mm;">
            <?php
            print("<textarea name = \"namecustomer\" value = \"\" style=\"width: 90mm;resize: none !important;font-size:20px;\">");
				print $query_customer[0]['namecustomer'];
			print("</textarea>");
            ?>
          </td>
		</tr>
		<tr>
			<td>ที่อยู่</td>
			<td colspan="2" align = "height:8mm;">
            <?php
            print("<textarea name = \"address\" value = \"\" style=\"width: 100%;resize: none !important;font-size:20px;\">");
				print $query_customer[0]['address'];			
			print("</textarea>");
            ?>
          </td>
		</tr>
		<tr>
			<td>
				เบอกร์โทร
			</td>
			<td colspan = "2">
			
		 	<input name="phonenumber" type = "text" id = "personalid" style="width: 100%;font-size:20px;"  value = "<?php print $query_customer[0]['phonenumber'];?>">
			</select>
          </td>
		</tr>

		<tr>
			<td colspan = "10" align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:22px;margin-top:15px;">
				<input type = "submit" name = "summit" value = "ยืนยันการแก้ไข" style = "width:40mm;height:8mm;empty-cells:show;font-family:angsana new;font-size:18px;">	
			</td>
		</tr>
    </table>
	</div>
</form>
</body>
</html>