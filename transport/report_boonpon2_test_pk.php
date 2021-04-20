<?php
	//include("../include/mySqlFunc.php");
	//query("USE transport");
	@ini_set('display_errors', '0');
	$datein = $_GET['datein'];
	$dateout = $_GET['dateout'];
	$namedriver = $_GET['namedriver'];
	$department = $_GET['department'];

	if(!empty($_GET['delete_note'])){

   	$result = query("DELETE FROM driver_note where note_id='".$_GET['delete_note']."'");
		if(!empty($result)){
			 
  			header("location:report_boonpon2.php?datein=".$datein."&dateout=".$dateout."&department=$department&namedriver=$namedriver");
		}

	}

	if(!empty($namedriver))
	{
		//$getDriver = getlist("SELECT * FROM driver WHERE id_driver = '".$namedriver."' and type_user='$department' and status='1'");
		//$getDriver = getlist("SELECT * FROM driver AS dr JOIN insertdata_transport AS it ON dr.id_driver=it.nameDriver JOIN  production_order AS po ON it.boonpon_id=po.boonpon_id  JOIN car_detail AS cd ON cd.id_car=it.id_car WHERE po.delivery_date between '$datein' AND '$dateout' AND nameDriver = '".$namedriver."' and type_user='$department'");

		$getDriver = getlist("SELECT * FROM production_order AS po JOIN insertdata_transport AS it ON po.boonpon_id=it.boonpon_id JOIN car_detail AS cd ON cd.id_car=it.idcar WHERE nameDriver = '".$namedriver."' AND po.delivery_date between '$datein' AND '$dateout' AND cd.type_zone='1' GROUP BY nameDriver");

	}else
	{
		//$getDriver = getlist("SELECT * FROM driver where type_user='$department' and status='1'");
		$getDriver = getlist("SELECT * FROM production_order AS po JOIN insertdata_transport AS it ON po.boonpon_id=it.boonpon_id JOIN car_detail AS cd ON cd.id_car=it.idcar WHERE po.delivery_date between '$datein' AND '$dateout' AND cd.type_zone='1' GROUP BY nameDriver");

		//print("SELECT * FROM production_order AS po JOIN insertdata_transport AS it ON po.boonpon_id=it.boonpon_id JOIN car_detail AS cd ON cd.id_car=it.idcar WHERE po.delivery_date between '$datein' AND '$dateout' AND cd.type_zone='1' ");
	}
	
	$cut_start_date = explode("-", $datein);
	$DateStart = $cut_start_date[2];	//วันเริ่มต้น
	$MonthStart = $cut_start_date[1];	//เดือนเริ่มต้น
	$YearStart = $cut_start_date[0];	//ปีเริ่มต้น

	$cut_end_date = explode("-", $dateout);
	$DateEnd = $cut_end_date[2];	//วันสิ้นสุด
	$MonthEnd = $cut_end_date[1];	//เดือนสิ้นสุด
	$YearEnd = $cut_end_date[0];	//ปีสิ้นสุด

	$End = mktime(0,0,0,$MonthEnd,$DateEnd,$YearEnd);
	$Start = mktime(0,0,0,$MonthStart ,$DateStart ,$YearStart);

	$DateNum=ceil(($End -$Start)/86400); // 28

	

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
				
			}

			.header-style{
				empty-cells: show;
				font-family:angsana new;
				font-size:16px;
			}

			@media print 
			{ 

	 			.not-show{ display: none !important; } 
		}
		</style>
	</head>
	<?php 


	function head($name)
	{
		global $department,$datein,$dateout;
	?>
	<form action = "" name = "insertquarity" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:280mm;empty-cells: show;">
		
		<tr  align = "center" style = "width:15mm;empty-cells: show;font-family:angsana new;font-size:18px;">

			<td>
			<?php
				
					print("<b>รายงานการใช้รถขนส่งบุญพร<br>");
					print("ระหว่างวันที่ ".printShortSlateThaiDate($datein)." ถึง ".printShortSlateThaiDate($dateout)."<br>");
					print("ขับโดย ".$name."</b>");
				
			?>
				
			</td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "0" cellpadding = "1" align = "center" valign = "middle" style="width:280mm;empty-cells: show;    border: 1px groove;">
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
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>โครงการ
			</td>
			 <td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
                <b>รวม
            </td>
			<!--
			<td align = "center" rowspan="1" style = "width:20mm;" class='header-style'>
				<b>หมายเหตุ
			</td>
			-->
		</tr>
	<?php
	}

	$DateNum = $DateNum+1;
print("<div class=\"container\">");
				print("<a href=\"excel_report_boonpon2_2.php?datein=".$datein."&dateout=".$dateout."&department=$department&namedriver=$namedriver\" target=\"blank\" style=\"cursor:pointer;color:#43ad04;float:right;margin-top:10px;\" class=\"excel\"> <img src=\"image/excel.png\" title=\"Export to excel\" width=\"50px\" height=\"50\"></a> ");
			print("</div>");
			
	for($d=0;$d<sizeof($getDriver);$d++)
	{
		
	$price = 0;
		$c = 1;
		
		
		$getdriver_name = getlist("SELECT * FROM driver WHERE id_driver = '".$getDriver[$d]['nameDriver']."' ");
		//print("SELECT * FROM driver WHERE id_driver = '".$getDriver[$d]['nameDriver']."' ");
		head($getdriver_name[0]['namedriver1']);
		for($i=0;$i<$DateNum;$i++){

			$new_date = add_date($datein,$i,0,0);
			$cut_new_date = explode(" ", $new_date);
			$getdata = getlist("SELECT * FROM production_order as p JOIN insertdata_transport  as i ON p.boonpon_id = i.boonpon_id WHERE delivery_date = '".$cut_new_date[0]."' AND i.nameDriver = '".$getdriver_name[0]['id_driver']."' GROUP BY p.boonpon_id");
			//print("SELECT * FROM production_order as p JOIN insertdata_transport  as i ON p.boonpon_id = i.boonpon_id WHERE delivery_date = '".$cut_new_date[0]."' AND i.nameDriver = '".$getDriver[$d]['id_driver']."' GROUP BY p.boonpon_id<br>");

	
		print("<tr>");
			print("<td align = \"center\" style = \"width:10mm;\" class='body-style' >");
	
						print ($i+1);
					
			print("</td>");
			print("<td align = \"center\" style = \"width:20mm;\" class='body-style'>");
						print printShortNumDate($cut_new_date[0]);//วันที่ส่ง
			print("</td>");	

			if(empty($getdata)){
				
					$get_note = getlist("SELECT * FROM driver_note WHERE driver_id = '".$getdriver_name[0]['id_driver']."' and note_date = '".$cut_new_date[0]."'");
								 
								if($get_note)
								{
									print("<td colspan='9' style = \"padding-left:5px;\" class='body-style'>");
									$cut_note = explode("@#", $get_note[0]['note_description']);
								print("<a onclick = \"window.open('add/add_note_driver.php?driver_id=".$getdriver_name[0]['id_driver']."&note_date=".$cut_new_date[0]."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$cut_note[0]." ".$cut_note[1]."</a> ");

								print("<a href=\"report_boonpon2.php?datein=".$datein."&dateout=".$dateout."&department=$department&namedriver=$namedriver&delete_note=".$get_note[0]['note_id']."\" onclick=\"return confirm('คุณต้องการลบข้อมูลกาวนี้ใช่หรือไม่?')\"><img src=\"image/delete.png\" title=\"ลบ\" width=\"12px\" height=\"12px\" class='not-show'></a>");
								print("</td>");
								}else{
									 
									print("<td colspan='9' style = \"text-align:center;\" class='body-style'>");
									 print("<a onclick = \"window.open('add/add_note_driver.php?driver_id=".$getdriver_name[0]['id_driver']."&note_date=".$cut_new_date[0]."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\" class='not-show'>เพิ่มหมายเหตุ</a> ");
									 print("</td>");
								}
				
			}else{
			print("<td  style = \"width:60mm;padding-left: 5px;\" class='body-style'>");

			$number_run_in_show = array();//ตรวจสอบจำนวนเที่ยวการเดินรถของพนักงาน ว่าเดินรถกี่เที่ยว
			for ($g=0; $g < sizeof($getdata); $g++) {
						
				$check = data_in_array($getdata[$g]['runperday'],$number_run_in_show);
				if($check==0){
				array_push($number_run_in_show, $getdata[$g]['runperday']);
				 }
						
			}
				if(sizeof($number_run_in_show)==2){
					for ($j=0; $j < sizeof($getdata); $j++) { 
						$placeAddCus = getlist("SELECT * FROM customer WHERE id_customer = '".$getdata[$j]['name']."'");//ลูกค้า
						print $placeAddCus[0]['namecustomer'];
						if (!empty($getdata[$j+1]['name'])) {
							print("<br>");
						}
					}

				}else{
					$customer = array();
					for ($g=0; $g < sizeof($getdata); $g++) {
						 $check = data_in_array($getdata[$g]['name'],$customer);
						 if($check==0){
						 	array_push($customer, $getdata[$g]['name']);
						 }
						
					}

					
					for ($j=0; $j < sizeof($customer); $j++) { 
						$placeAddCus = getlist("SELECT * FROM customer WHERE id_customer = '".$customer[$j]."'");//ลูกค้า
						print $placeAddCus[0]['namecustomer'];
						if (!empty($customer[$j+1])) {
							print("<br>");
						}
					}
				}
					
						
		
			print("</td>");
			print("<td align = \"center\" style = \"width:40mm;\" class='body-style'>");

				
				$plus =array();
				if(sizeof($number_run_in_show)==2){
					for ($j=0; $j < sizeof($getdata); $j++) { 
						$placeCus = getlist("SELECT * FROM shipping WHERE id_ship = '".$getdata[$j]['delivery_name']."'");
						print $placeCus[0]['detailship'];//สถานที่ส่ง
						$data1 = strpos($placeCus[0]['detailship'],"โครงการ");

		                    if($data1 !== FALSE){
		                        $plus[$j] = 150;
		                    }else{
		                        $plus[$j] = 0;
		                    }

						if (!empty($getdata[$j+1]['delivery_name'])) {
							print("<br>");
						}
					}

				}else{
					$shiiping = array();
					for ($g=0; $g < sizeof($getdata); $g++) {
						 $check = data_in_array($getdata[$g]['delivery_name'],$shiiping);
						 if($check==0){
						 	array_push($shiiping, $getdata[$g]['delivery_name']);
						 }
						
					}
					
					for ($j=0; $j < sizeof($shiiping); $j++) { 
						$deyale_ship = getlist("SELECT * FROM shipping WHERE id_ship = '".$shiiping[$j]."'");
						print $deyale_ship[0]['detailship'];//สถานที่ส่ง
						
							$data1 = strpos($deyale_ship[0]['detailship'],"โครงการ");

		                    if($data1 !== FALSE){
		                        $plus[$j] = 150;
		                    }else{
		                        $plus[$j] = 0;
		                    }
						if (!empty($shiiping[$j+1])) {
							print("<br>");
						}
					}
				}
					
			
			print("</td>");	
			print("<td align = \"center\" style = \"width:25mm;\" class='body-style'>");

				for ($n=0; $n < sizeof($getdata); $n++) { 
						$placeCus = getlist("SELECT * FROM car_head WHERE id_hcar = '".$getdata[$n]['typecar']."'");

						print $placeCus[0]['detailhcar'];//ประเภทรถที่ขับ

						if(!empty($getdata[$n+1]['typecar'])){
							print("<br>");
						}
					}

					

			print("</td>");
			print("<td align = \"center\" style = \"width:20mm;\" class='body-style'>");

			if(sizeof($number_run_in_show)==2){
				for ($n=0; $n < sizeof($getdata); $n++) { 

						$placeCus1 = getlist("SELECT * FROM car_detail WHERE id_car = '".$getdata[$n]['idcar']."'");
						print $placeCus1[0]['licenceplates']."&nbsp;&nbsp;".$placeCus1[0]['licenceplate2'];//ทะเบียน

						if(!empty($getdata[$n+1]['idcar'])){
							print("<br>");
						}
					}
			}else{
				$license = array();
					for ($g=0; $g < sizeof($getdata); $g++) {
						
						 $check = data_in_array($getdata[$g]['idcar'],$license);
						 if($check==0){
						 	array_push($license, $getdata[$g]['idcar']);
						 }
						
					}
					for ($n=0; $n < sizeof($license); $n++) { 

						$placeCus1 = getlist("SELECT * FROM car_detail WHERE id_car = '".$license[$n]."'");
						print $placeCus1[0]['licenceplates']."&nbsp;&nbsp;".$placeCus1[0]['licenceplate2'];//ทะเบียน

						if(!empty($license[$n+1])){
							print("<br>");
						}
					}
			}
					

			print("</td>");	
			print("<td align = \"center\" style = \"width:20mm;\" class='body-style'>");

						
					$number_run = array();
					for ($g=0; $g < sizeof($getdata); $g++) {
						
						 $check = data_in_array($getdata[$g]['runperday'],$number_run);
						 if($check==0){
						 	array_push($number_run, $getdata[$g]['runperday']);
						 }
						
					}
					for ($n=0; $n < sizeof($number_run); $n++) { 
						print $number_run[$n];//ประเภทรถที่ขับ
						if(!empty($number_run[$n+1])){
							print("<br>");
						}
					}

			print("</td>");

			print("<td align = \"center\" style = \"width:30mm;\" class='body-style'>");

					$totol_line = 0;
					$minus =0;
					if($placeCus1[0]['typefule']=='ดีเซล'){
								$minus = 20;
					}else{
								$minus = 0;
					}
					for ($n=0; $n < sizeof($getdata); $n++) 
					{ 
						if(!empty($getdata[$n]['runperday']) AND $getdata[$n]['runperday'] == 1)
						{//อัตราเบี้ยเลี้ยง
							
							$getprice = getlist("SELECT dis_1 FROM allowance WHERE typecar = '".$getdata[$n]['typecar']."' and id_ship = '".$getdata[$n]['delivery_name']."'");
								 


								if($getprice)
								{
									$totol_line += $getprice[0]['dis_1']+$plus[$n]-$minus;
									


								//print $getprice[0]['dis_1'];
								 print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$getdata[$n]['delivery_name']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$getprice[0]['dis_1']."</a> ");
								}else{
									
									 print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$getdata[$n]['delivery_name']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\" >เพิ่มเบี้ยเลี้ยง</a> ");
								}
								
							
						}elseif(!empty($getdata[$n]['runperday']) AND $getdata[$n]['runperday'] == 2){
							
							$getprice = getlist("SELECT dis_2 FROM allowance WHERE typecar = '".$getdata[$n]['typecar']."' and id_ship = '".$getdata[$n]['delivery_name']."'");
								 
								if($getprice)
								{
									$totol_line += $getprice[0]['dis_2']+$plus[$n]-$minus;
									//$price+=$totol_line;
								//print $getprice[0]['dis_2'];
								print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$getdata[$n]['delivery_name']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$getprice[0]['dis_2']."</a> ");
								}else{
									 

									 print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$getdata[$n]['delivery_name']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\" >เพิ่มเบี้ยเลี้ยง</a> ");
								}
							
						}else{
							print($getdata[$n]['runperday']);
						}
						if(!empty($getdata[$n+1]['runperday'])){
							print("<br>");
						}
						
						//print($price);
					}
			print("</td>");

			print("<td align = \"center\" style = \"width:20mm;\" class='body-style'>");
				for ($y=0; $y < sizeof($plus); $y++) { 
					print($plus[$y]);
					if($plus[$y+1]==0){
						print("<br>");
					}
				}
			print("</td>");

			//รวม
			print("<td align = \"center\" style = \"width:20mm;\" class='body-style'>");
                print($totol_line);
                $price+=$totol_line;
            print("</td>");

            //หมายเหตุ
			/*print("<td align = \"center\" style = \"width:20mm;\" class='body-style'>");

								if($getdata[0]['note'])
								{
									
								print("<a onclick = \"window.open('add/add_note_transport.php?boonpon_id=".$getdata[0]['boonpon_id']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$getdata[0]['note']."</a> ");
						
								}else{
									 			
									 print("<a onclick = \"window.open('add/add_note_transport.php?boonpon_id=".$getdata[0]['boonpon_id']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=300,top=45 ,left=250')\" class='not-show' style=\"cursor:pointer;color:#f51cce;\">เพิ่มหมายเหตุ</a> ");

								}
			print("</td>");*/
			}

		print("</tr>");

		$c++;
		
		}
	
			print("<tr>");
				
				print("<td align = \"center\" colspan = \"8\" style = \"width:150mm;\" class='body-style'>");
					print("รวม");
				print("</td>");
				print("<td align = \"center\" colspan = \"3\" style = \"width:30mm;\" class='body-style'>");
						print number_format($price);
					
				print("</td>");
			print("</tr>");
	
		print("</table>");

	
	print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");

}
	
	?>
			
	
		
