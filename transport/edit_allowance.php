<html>
<head>
	<title>แก้ไขข้อมูลเบี้ยเลี้ยง</title>
	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
	 <link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
		<script type="text/javascript" src="datetimepicker/jquery.js"></script>
		<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
</head>
<body style="background-color: #d1d4d8;">
<?php
include("../include/mySqlFunc.php");
	query("USE transport");
	$id_allowance1 = $_GET['id_allowance'];
	$query_allowance= getlist("SELECT *  from allowance  where id_allowance ='$id_allowance1'");
	
	if(!empty($_POST['summit'])){
		print ("<pre>");
		print_r($_POST);
		print ("</pre>");
		$id_cus =$_POST['namecustomer'];
		$id_shiping =$_POST['shipping_cus']; 
		$id_car =$_POST['typecar'] ;
		$id_allo1 =$_POST['allowance1']; 
		$id_allo2 =$_POST['allowance2'];
		
		$q = query("UPDATE allowance set p_end='$id_shiping',typecar='$id_car',dis_1='$id_allo1',dis_2='$id_allo2' where id_allowance='$id_allowance1'");
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
?>

<center><font color="#000000" face="angsana new"><h1><b>แก้ไขข้อมูลเบี้ยเลี้ยง</b></h1></center></font>
<form action = "" name = "insertplace" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;empty-cells: show;">

		<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<b> สถานที่จัดส่ง</b>
			</td>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<select name = "shipping_cus" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				
					<?php
					query("USE transport");
	
							$data = getlist("SELECT * from shipping where id_ship = '".$query_allowance[0]['p_end']."' and statusship = '1'");
							if(!empty($_POST['namecustomer']))
							{
								$_POST['namecustomer'] = $query_allowance[0]['p_end'];
							}
							for($i=0;$i<sizeof($data);$i++){
								$selected = $data[$i]['id_ship']==$_POST['namecustomer'] ? "selected=\"selected\"" : "";
								print("<option value = \"".$data[$i]['id_ship']."\"".$selected.">".$data[$i]['detailship']."</option>");
							}
						
					?>
				</select>
	        </td>
		</tr>
		<tr>
			<td align = "center" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>ประเภทรถ</b>
			</td>
			<td align = "center" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<select name = "typecar" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;"">
				
				<?php
					
					if(!empty($query_allowance[0]['typecar']))
					{
						$_POST['typecar'] = $query_allowance[0]['typecar'];
					}
					
					$get_car = getlist("SELECT * FROM car_head where type_user=1");
					for($i=0;$i<sizeof($get_car);$i++){
						$selected = $get_car[$i]['id_hcar'] == $_POST['typecar'] ? "selected=\"selected\"" : "";
						print("<option value = \"".$get_car[$i]['id_hcar']."\"".$selected.">".$get_car[$i]['detailhcar']."</option>");
					}
				?>
				</select>
				
			</td>
		</tr>
		<tr>
		<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>ค่าเบี้ยเลี้ยงเที่ยววิ่ง1</b>
			</td>
			<td>
				<input type="text" name="allowance1" value="<?php print $query_allowance[0]['dis_1']; ?>" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
		<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>ค่าเบี้ยเลี้ยงเที่ยววิ่ง2</b>
			</td>
			<td>
				<input type="text" name="allowance2" value="<?php print $query_allowance[0]['dis_2'] ?>" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
		<td colspan = "2" align = "center" style = "width:200mm;empty-cells: show;font-family:angsana new;font-size:24px;"><br>
				<input type="submit" name="summit" value ="ยืนยันการแก้ไข" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:20px;">
		     </td>
	    </tr>
</form>
	</body>
</html>