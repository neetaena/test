<?php
	include("../include/mySqlFunc.php");
	query("USE transport");
	@ini_set('display_errors', '0');
	if(!empty($_POST['namedriver']))
	{
		$getDriver = getlist("SELECT * FROM driver WHERE id_driver = '".$_POST['namedriver']."' and type_user='1'");
	}else
	{
		$getDriver = getlist("SELECT * FROM driver where type_user='1'");
	}
	
?>
<meta http-equiv = "Content-Type" content="text/html; charset = utf-8" />
<html>
	<head>
		<title>
		รายงานการขับรถส่งสินค้า
		</title>
	</head>
	<?php 
	/*for($i=0;$i<sizeof($getdata);$i++){
	print("typecar =".$getdata[$i]['typecar']."' AND placestart = '".$getdata[$i]['start']."' AND p_end = '".$getdata[$i]['Sendlocation']."<br>") ;
	}*/
	function head($name)
	{
	?>
	<form action = "" name = "insertquarity" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:240mm;empty-cells: show;">
		<tr align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			<td><b>รายงานการขับรถส่งสินค้า</b></td>
		</tr>
		<tr align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			<td><b>พนักงานขับรถ</b>&nbsp;&nbsp;<?php  print $name;?></td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:240mm;empty-cells: show;">
		<tr>
			<td align = "center" rowspan="1" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>ลำดับ
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>วันที่ส่ง
			</td>
			<td align = "center" rowspan="1" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>ลูกค้า
			</td>
			<td align = "center" rowspan="1" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>สถานที่ส่ง
			</td>
			<td align = "center" rowspan="1" style = "width:25mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>ประเภทรถที่ขับ
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>ทะเบียน
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				<b>อัตราเบี้ยเลี้ยง
			</td>
		</tr>
	<?php
	}
	for($d=0;$d<sizeof($getDriver);$d++)
	{

	head($getDriver[$d]['namedriver1']);
		$c = 1;
		$price = 0;
		$where2 = !empty($_POST['namedriver']) ? "AND insertdata_transport.nameDriver = '".$_POST['namedriver']."'" : "";
		$getdata = getlist("SELECT * FROM production_transport as p JOIN insertdata_transport  as i ON p.number = i.number WHERE delivery_date between '".$_POST['datein']."' AND '".$_POST['dateout']."' AND i.nameDriver = '".$getDriver[$d]['id_driver']."' GROUP BY p.number");
		
		for($i=0;$i<sizeof($getdata);$i++){
	?>
		<tr>
			<td align = "center" style = "width:10mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					
						print ($i+1);
					
				?>
			</td>	
			<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					if(!empty($getdata[$i]['delivery_date'])){
						print printShortNumDate($getdata[$i]['delivery_date']);//วันที่ส่ง
					}
				?>	
			</td>		
			<td align = "center" style = "width:60mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					if(!empty($getdata[$i]['name'])){
						$placeAddCus = getlist("SELECT * FROM customer WHERE id_customer = '".$getdata[$i]['name']."'");//ลูกค้า
						print $placeAddCus[0]['namecustomer'];
					}
				?>
			</td>
			<td align = "center" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					if(!empty($getdata[$i]['delivery_name'])){
						$placeCus = getlist("SELECT * FROM shipping WHERE id_ship = '".$getdata[$i]['delivery_name']."'");
						print $placeCus[0]['detailship'];//สถานที่ส่ง
					}
				?>	
			</td>	
			<td align = "center" style = "width:25mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					if(!empty($getdata[$i]['delivery_name'])){
						$placeCus = getlist("SELECT * FROM car_head WHERE id_hcar = '".$getdata[$i]['typecar']."'");
						print $placeCus[0]['detailhcar'];//ประเภทรถที่ขับ
					}
				?>	
			</td>	
			<td align = "center" style = "width:20mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php
					
						$placeCus1 = getlist("SELECT * FROM car_detail WHERE id_car = '".$getdata[$i]['idcar']."'");
						print $placeCus1[0]['licenceplates']."&nbsp;&nbsp;".$placeCus1[0]['licenceplate2'];//ทะเบียน
					
				?>	
			</td>	
			<td align = "center" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
				<?php	
						if(!empty($getdata[$i]['runperday']) AND $getdata[$i]['runperday'] == 1){//อัตราเบี้ยเลี้ยง
							
							$getprice = getlist("SELECT dis_1 FROM allowance WHERE typecar = '".$getdata[$i]['typecar']."' AND placestart = '1' AND p_end = '".$getdata[$i]['delivery_name']."'");
								 
								if($getprice)
								{
									$price+=$getprice[0]['dis_1'];
								print $getprice[0]['dis_1'];
								}else{
									 print("<a onclick = \"window.open('insertallownce_on_report.php?shipping=".$getdata[$i]['delivery_name']."&typecar=".$getdata[$i]['typecar']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=600,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">เพิ่มเบี้ยเลี้ยง</a> </td>");
								}
								
							
						}elseif(!empty($getdata[$i]['runperday']) AND $getdata[$i]['runperday'] == 2){
							
							$getprice = getlist("SELECT dis_2 FROM allowance WHERE typecar = '".$getdata[$i]['typecar']."' AND placestart = '1' AND p_end = '".$getdata[$i]['delivery_name']."'");
							$price+=$getprice[0]['dis_2'];
								print $getprice[0]['dis_2'];
							
						}
				?>
			</td>
		</tr>
	<?php
		$c++;
		
		}
		?>
			<tr>
				
				<td align = "center" colspan = "6" style = "width:150mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
					รวม
				</td>	
				<td align = "center" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:16px;border-bottom:1px solid;">
					<?php
						print $price;
					?>
				</td>
			</tr>
		<?php
	}
	
	?>
			
	</table>
		
