<?php
	include("../include/mySqlFunc.php");
	query("USE transport");
	@ini_set('display_errors', '0');
	$datein = $_GET['datein'];
	$dateout = $_GET['dateout'];
	$namedriver = $_GET['namedriver'];
	$department = $_GET['department'];
	if(!empty($namedriver))
	{
		$getDriver = getlist("SELECT * FROM driver WHERE id_driver = '".$namedriver."' and type_user='$department'");
	}else
	{
		$getDriver = getlist("SELECT * FROM driver where type_user='$department'");
	}
	
?>
<meta http-equiv = "Content-Type" content="text/html; charset = utf-8" />
<html>
	<head>
		<title>
		รายงานการขับรถส่งสินค้า
		</title>
		<style type="text/css">
			.body-style{
				empty-cells: show;
				font-family:angsana new;
				font-size:16px;
				border-bottom:1px solid;
			}

			.header-style{
				empty-cells: show;
				font-family:angsana new;
				font-size:20px;
			}
		</style>
	</head>
	<?php 

	function head($name)
	{
		global $department,$datein,$dateout;
	?>
	<form action = "" name = "insertquarity" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:240mm;empty-cells: show;">
		
		<tr align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:22px;">

			<td>
			<?php
				
					print("<b>รายงานการใช้รถขนส่งบุญพร<br>");
					print("ระหว่างวันที่ ".printShortSlateThaiDate($datein)." ถึง ".printShortSlateThaiDate($dateout)."<br>");
					print("ขับโดย ".$name."</b>");
				
			?>
				
			</td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:240mm;empty-cells: show;">
		<tr>
			<td align = "center" rowspan="1" style = "width:15mm;" class='header-style'>
				<b>ลำดับ
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>วันที่ส่ง
			</td>
			<td align = "center" rowspan="1" style = "width:30mm;" class='header-style'>
				<b>ลูกค้า
			</td>
			<td align = "center" rowspan="1" style = "width:40mm;" class='header-style'>
				<b>สถานที่ส่ง
			</td>
			<td align = "center" rowspan="1" style = "width:25mm;" class='header-style'>
				<b>ประเภทรถที่ขับ
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>ทะเบียน
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>เที่ยวที่
			</td>
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>อัตราเบี้ยเลี้ยง
			</td>
		</tr>
	<?php
	}

	for($d=0;$d<sizeof($getDriver);$d++)
	{

	
		$c = 1;
		$price = 0;
		$getdata = getlist("SELECT * FROM production_order as p JOIN insertdata_transport  as i ON p.boonpon_id = i.boonpon_id WHERE delivery_date between '$datein' AND '$dateout' AND i.nameDriver = '".$getDriver[$d]['id_driver']."' GROUP BY p.boonpon_id");
		

		if(!empty($getdata)){
		head($getDriver[$d]['namedriver1']);
		for($i=0;$i<sizeof($getdata);$i++){
	?>
		<tr>
			<td align = "center" style = "width:10mm;" class='body-style'">
				<?php
					
						print ($i+1);
					
				?>
			</td>	
			<td align = "center" style = "width:20mm;" class='body-style'">
				<?php
					if(!empty($getdata[$i]['delivery_date'])){
						print printShortNumDate($getdata[$i]['delivery_date']);//วันที่ส่ง
					}
				?>	
			</td>		
			<td  style = "width:50mm;padding-left: 5px;" class='body-style'">
				<?php
					if(!empty($getdata[$i]['name'])){
						$placeAddCus = getlist("SELECT * FROM customer WHERE id_customer = '".$getdata[$i]['name']."'");//ลูกค้า
						print $placeAddCus[0]['namecustomer'];
					}
				?>
			</td>
			<td align = "center" style = "width:50mm;" class='body-style'">
				<?php
					if(!empty($getdata[$i]['delivery_name'])){
						$placeCus = getlist("SELECT * FROM shipping WHERE id_ship = '".$getdata[$i]['delivery_name']."'");
						print $placeCus[0]['detailship'];//สถานที่ส่ง
					}
				?>	
			</td>	
			<td align = "center" style = "width:25mm;" class='body-style'">
				<?php
					if(!empty($getdata[$i]['delivery_name'])){
						$placeCus = getlist("SELECT * FROM car_head WHERE id_hcar = '".$getdata[$i]['typecar']."'");
						print $placeCus[0]['detailhcar'];//ประเภทรถที่ขับ
					}
				?>	
			</td>	
			<td align = "center" style = "width:20mm;" class='body-style'">
				<?php
					
						$placeCus1 = getlist("SELECT * FROM car_detail WHERE id_car = '".$getdata[$i]['idcar']."'");
						print $placeCus1[0]['licenceplates']."&nbsp;&nbsp;".$placeCus1[0]['licenceplate2'];//ทะเบียน
					
				?>	
			</td>	
			<td align = "center" style = "width:20mm;" class='body-style'">
				<?php
					
						print($getdata[$i]['runperday']);
					
				?>	
			</td>	
			<td align = "center" style = "width:30mm;" class='body-style'">
				<?php	
						if(!empty($getdata[$i]['runperday']) AND $getdata[$i]['runperday'] == 1)
						{//อัตราเบี้ยเลี้ยง
							
							$getprice = getlist("SELECT dis_1 FROM allowance WHERE typecar = '".$getdata[$i]['typecar']."' and id_ship = '".$getdata[$i]['delivery_name']."'");
								 
								if($getprice)
								{
									$price+=$getprice[0]['dis_1'];


								//print $getprice[0]['dis_1'];
								 print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$getdata[$i]['delivery_name']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$getprice[0]['dis_1']."</a> ");
								}else{
									
									 print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$getdata[$i]['delivery_name']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">เพิ่มเบี้ยเลี้ยง</a> ");
								}
								
							
						}elseif(!empty($getdata[$i]['runperday']) AND $getdata[$i]['runperday'] == 2){
							
							$getprice = getlist("SELECT dis_2 FROM allowance WHERE typecar = '".$getdata[$i]['typecar']."' and id_ship = '".$getdata[$i]['delivery_name']."'");
								 
								if($getprice)
								{
									$price+=$getprice[0]['dis_2'];
								//print $getprice[0]['dis_2'];
								print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$getdata[$i]['delivery_name']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$getprice[0]['dis_2']."</a> ");
								}else{
									 

									 print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$getdata[$i]['delivery_name']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">เพิ่มเบี้ยเลี้ยง</a> ");
								}
							
						}
				?>
			</td>
		</tr>
	<?php
		$c++;
		
		}
		?>
			<tr>
				
				<td align = "center" colspan = "7" style = "width:150mm;" class='body-style'">
					รวม
				</td>	
				<td align = "center" style = "width:30mm;" class='body-style'">
					<?php
						print $price;
					?>
				</td>
			</tr>
		<?php
		print("</table>");

	}
	print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");

}
	
	?>
			
	
		
