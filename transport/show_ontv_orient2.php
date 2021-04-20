<?php
include("../include/mySqlFunc.php");
query("USE transport");
?>

<?php
include 'function.php';
?>
<style type="text/css">
	/*@media screen and (min-width: 320px) and (max-width: 767px) and (orientation: portrait) {
  html {
    transform: rotate(-90deg);
    transform-origin: left top;
    width: 100vh;
    overflow-x: hidden;
    position: absolute;
    top: 100%;
    left: 0;
  }
}*/

@media screen {
	html
	{
		transform: rotate(90deg);
	
	}
}

	table.a {
  /*table-layout: fixed;*/
  /*width: 500; */
  /*margin-left:20;*/ 
  	position: fixed;
  	left: 285px;
	top: -280px;
	background: white;
	height: 0px;
	width: 690px;
}

	.body_table{
	empty-cells: show;font-family:angsana new; text-align: left; padding-left: 5px;

	}

	.body_table:hover img{
	cursor:pointer;
	}

	td { 
	line-height: 24px; 	
	}

	div.test {
    white-space: nowrap; 
    width: 65px; 
    overflow: hidden; 
    /*border: 1px solid #000000;*/
	}

	div.test:hover {
    text-overflow: inherit;
    overflow: visible;
	}

	div.test2 {
    white-space: nowrap; 
    width: 106px; 
    overflow: hidden; 
    /*border: 1px solid #000000;*/
	}

	div.test2:hover {
    text-overflow: inherit;
    overflow: visible;
	}

	p{ background-color: #fff200; }


</style>
<body bgcolor= "FFFFFF">
	<?php
	if (date('H') < 11) {
   		$count =0;
	}else{
		$count =1;
	}

	$today = date("Y-m-d");
	//$today = date("2019-05-25");
	// code check ว่าวันพรุ่งนี้มีข้อมูลไหม ถ้าไม่มีก็ + 1 วนใหม่
	for($c=$count;$c<=5;$c++)
	{
		$cutdate = add_date($today,$c,0,0); //เพิ่มวัน ตามตัวแปร $c
		$ex = explode(" ", $cutdate); // เอาช่องว่างออก คือตัด HH:mm:SSSS ออก
		$_POST['datestart'] = $ex[0]; // เอา array ตำแหน่งที่ได้มาไปโชว์
		$get = getlist("SELECT * FROM production_order WHERE delivery_date = '".$_POST['datestart']."'" );
		if(!empty($get))
		{break;}
	}
	
	?>
	<br>
<!--<center><font color="#000000" face="angsana new" style="font-size : 30px;"><b>ตารางการจัดส่ง วันที่ <?php print(printShortSlateThaiDate($_POST['datestart'])); ?></b></center></font>-->
<form action = "" name = "insertquarity" method ="POST"  >

<table bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "0" align = "center" valign = "middle">
	<tr>
	<script type="text/javascript">
	jQuery('#datestart').datetimepicker({
	timepicker:false,
	format:'Y-m-d'
	});
	</script>
	</tr>
</table>
</form>

	<table  class="a" bgcolor="#FFFFFF" border="1" cellspacing="0" cellpadding="0" style=" empty-cells:show; border:groove;">

	<tr>
	<td colspan=6 class="body_table" style="font-size: 28px; text-align: center;">ตารางการจัดส่งวันที่ <?php print(printShortSlateThaiDate($_POST['datestart'])); ?>
	</td>
		
	</tr>
	<tr align = "center">

	<td class="body_table" style="font-size: 16px; width:10%; text-align: center;"><b>
		ทะเบียนรถ
	</td>

	<td class="body_table" style="font-size: 16px; width:8%; text-align: center;"><b>
		ชื่อคนขับ
	</td>

	<td class="body_table" style="font-size: 16px; width:10%; text-align: center;"><b>
		ชื่อลูกค้า
	</td>
			
	<td class="body_table" style="font-size: 16px; width:22%; text-align: center;"><b>
		สถานที่จัดส่ง
	</td>

	<td class="body_table" style="font-size: 16px; width:5%; text-align: center;"><b>
		ชนิดไม้
	</td>

	<td class="body_table" style="font-size: 16px; width:45%; text-align: center;"><b>
		หมายเหตุ
	</td>

	</tr>
	<?php

	$search[0] = !empty($_POST['product_id']) ? "product_id='".$_POST['product_id']."'" : "";
	$search[1] = !empty($_POST['datestart']) ? "delivery_date='".$_POST['datestart']."'" : "";
	$where = "";
    
    for($s=0; $s < sizeof($search); $s++) 
    { 
    	if(!empty($search[$s]))
    	{
        	if(empty($where))
        	{
            	$where = $search[$s];
            }
            else
            {
            	$where .= " and ".$search[$s];
            }
        }
    }
	$invoice = getlist("SELECT DISTINCT (po.boonpon_id) AS boonpon_id FROM production_order as po inner join type_production as tp on product_id=id_production  inner join insertdata_transport as it on po.boonpon_id=it.boonpon_id  inner join car_detail as cd on it.idcar=cd.id_car where $where AND cd.typecar != 6 AND po.boonpon_id != 0 GROUP BY po.boonpon_id order by cd.typecar,licenceplates,type_zone");
	
	for($i=0;$i<sizeof($invoice);$i++)
	{
		$getdata = getlist("SELECT name,delivery_date,item_number,delivery_name,note,posttime,po.boonpon_id,nameDriver,warehouse_id,data_number,alis_name,licenceplates,type_zone,cd.typecar FROM production_order as po inner join type_production as tp on product_id=id_production  inner join insertdata_transport as it on po.boonpon_id=it.boonpon_id  inner join car_detail as cd on it.idcar=cd.id_car where po.boonpon_id='".$invoice[$i]['boonpon_id']."'  AND cd.typecar != 6  AND po.delivery_date='".$_POST['datestart']."' GROUP BY warehouse_id, product_id order by cd.typecar,licenceplates,type_zone ");

		if(!empty($invoice))
		{
	?>
	<tr align = "center">	

	<!-- ทะเบียนรถ -->
	<?php
	if($getdata[0]['typecar']==2)
	{
		print("<td class=\"body_table\" style=\"background-color: #66a6f5; font-size:20px;\">");
		if($getdata[0]['type_zone']==0)
		{
			print("<font color=\"yellow\">");
			print($getdata[0]['licenceplates']);
			print("</font>");
		}
		else if($getdata[0]['type_zone']!=0)
		{
			print($getdata[0]['licenceplates']);
		}
		print("</td>");
	}
	else if($getdata[0]['typecar']!=2)
	{
		print("<td class=\"body_table\" style=\"background-color: #f96a6a; font-size:20px;\">");
		if($getdata[0]['type_zone']==0)
		{
			print("<font color=\"yellow\">");
			print($getdata[0]['licenceplates']);
			print("</font>");
		}
		else if($getdata[0]['type_zone']!=0)
		{
			//print("<font color=\"yellow\">");
			print($getdata[0]['licenceplates']);
			//print("</font>");
		}
		print("</td>");
	}
	?>
	<!-- ชื่อคนขับ -->
	<!--<td class="body_table">-->
	<?php
	$find_word = "นาย";
	
		$getdriver = getlist("select * from driver where id_driver = '".$getdata[0]['nameDriver']."'");
		//print $getdriver[0]['namedriver1'];
		
		$driver_name = strpos($getdriver[0]['namedriver1'],$find_word);
		if($driver_name !== FALSE)
		{
			$word_cut_nai = substr($getdriver[0]['namedriver1'],9);
		//	print($word_cut_nai);

			$word_cut_space = explode(" ", $word_cut_nai);
			//print($word_cut_space[0]);


			if($getdata[0]['type_zone']==0)
			{
				//print("<font color=\"red\">");
				print("<td class=\"body_table\" style=\"background-color: #fff200; font-size:20px;\">");
				print($word_cut_space[0]);
				//print("</font>");
			}
			else
			{
				print("<td class=\"body_table\" style=\"font-size:20px;\">");
				print($word_cut_space[0]);
			}
		}
		else
		{
			if($getdata[0]['type_zone']==0)
			{
				print("<td class=\"body_table\" style=\"background-color: #fff200; font-size:20px;\">");
				print($getdriver[0]['namedriver1']);
			}
			else
			{
				print("<td class=\"body_table\">");
				print($getdriver[0]['namedriver1']);
			}	
		}
	?>
	
	</td>

	<!-- ชื่อลูกค้า -->
	
	<?php
		print("<td class=\"body_table\" style=\"font-size:20px;\">");
	for($j=0;$j<sizeof($getdata);$j++)
	{
		$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[$j]['name']."'");
		if($getdata[0]['type_zone']==0)
		{
		
			print("<div class=\"test2\" style=\"text-overflow:clip;\">");
			//print("<p>");
			print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
			//print("</p>");
			print("</div>");
		}
		else
		{
			
			print("<div class=\"test2\" style=\"text-overflow:clip;\">");
			print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
			print("</div>");
		}
		//print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
		if(!empty($getdata[$j+1]['name']) && $getdata[$j]['name'] == $getdata[$j+1]['name'])
		{
			break;
		}
		else if(!empty($getdata[$j+1]['name']))
		{
			print("<br>");
		}
	}
	?>
	
	</td>
			
	<!-- สถานที่จัดส่ง -->		
	<?php		
	print("<td class=\"body_table\" style=\"font-size:20px;\">");
	for($j=0;$j<sizeof($getdata);$j++)
	{		
	
		$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata[$j]['delivery_name']."'");
		if($getdata[0]['type_zone']==0)
		{
			
			print($get_delivery_name[0]['detailship']);
		}
		else
		{
		
			print($get_delivery_name[0]['detailship']);
		}
		
		if(!empty($getdata[$j+1]['delivery_name']) && $getdata[$j]['delivery_name'] == $getdata[$j+1]['delivery_name'])
		{
			break;
		}
		else if(!empty($getdata[$j+1]['delivery_name']))
		{
			print("<br>");
		}

	}	
	?>
	</td>
	
	<!-- ชนิดไม้ -->
	<td class="body_table" style="font-size:20px;">
	<div class="test" style="text-overflow:clip;">
	<?php
	for($j=0;$j<sizeof($getdata);$j++)
	{	

	if($getdata[$j]['alis_name']=="ไม้PB")
	{

		print("<font color=\"red\">");
		print($getdata[$j]['alis_name']);
		print("</font>");
	}
	else if($getdata[$j]['alis_name']=="ไม้พื้น")
	{
		print("<font color=\"blue\">");
		print($getdata[$j]['alis_name']);
		print("</font>");
	}
	else if($getdata[$j]['alis_name']=="ไม้ปิดผิวกระดาษ")
	{
		print("<font color=\"deep-green\">");
		print($getdata[$j]['alis_name']);
		print("</font>");
	}
	else if($getdata[$j]['alis_name']=="ไม้ปิดผิวเฟอร์นิเจอร์")
	{
		print("<font color=\"#000000\">");
		print($getdata[$j]['alis_name']);
		print("</font>");
	}
	else if($getdata[$j]['alis_name']=="ไม้MDF")
	{
		print("<font color=\"#008000\">");
		print($getdata[$j]['alis_name']);
		print("</font>");
	}
	else if($getdata[$j]['alis_name']=="ไม้บัว")
	{
		print("<font color=\"#330033\">");
		print($getdata[$j]['alis_name']);
		print("</font>");
	}
	if(!empty($getdata[$j+1]['alis_name']) && $getdata[$j]['alis_name'] == $getdata[$j+1]['alis_name'])
	{
		break;
	}
	else if(!empty($getdata[$j+1]['alis_name']))
	{
		print("<br>");
	}
	}

	?>
	</div>
	</td>

	<!-- หมายเหตุ -->
	<td class="body_table" style="font-size: 20px;">
	
	<?php
	for($j=0;$j<sizeof($getdata);$j++)
	{	
	print($getdata[$j]['note']);
	print($getdata[$j]['posttime']);
	if(!empty($getdata[$j+1]['note']) || !empty($getdata[$j+1]['posttime']))
	{
		print("<br>");
	}
	}
	?>

	</td>
	</tr>
	<?php	
	}	
	}

	$today2 = date("Y-m-d");
	$cut = explode(" ", $today2);
	$_POST['date'] = $cut[0]; // เอา array ตำแหน่งที่ได้มาไปโชว์
	$table2 = getlist("SELECT * FROM check_driver_car WHERE date_time='".$_POST['datestart']."'");

	?>
	<!--<tr>
	<td colspan="3" style="text-align:center;">
		ทะเบียนรถที่ว่างงาน
	</td>
	<td colspan="3" style="text-align:center;">
		หมายเหตุ
	</td>
	</tr>-->
	<?php
	/* หมายเหตุเกี่ยวกับ ทะเบียนรถ
	for($i=0; $i<sizeof($table2); $i++)
	{
		print("<tr>");
		print("<td colspan='2'>");
		print($table2[$i]['licence_check_driver']);
		print("</td>");
		print("<td colspan='4'>");
		print($table2[$i]['note_check_driver']);
		if(!empty($table2[$i]['detail']))
		{
			print("&nbsp;&nbsp;&nbsp;(");
			print($table2[$i]['detail']);
			print(")");
		}
		print("</td>");
		print("</tr>");
	}*/
	?>
</table>
<br>
	<?php
		/*$today2 = date("Y-m-d");
		$cut = explode(" ", $today2);
		$_POST['date'] = $cut[0]; // เอา array ตำแหน่งที่ได้มาไปโชว์
		$table2 = getlist("SELECT * FROM check_driver_car WHERE date_time= '".$_POST['date']."'");

		print("<table style=\"width:20%;\" border=1px;>");
		print("<tr>");
		print("<td colspan='2' style=\"text-align:center\">ตารางแสดงรถที่ไม่มีงาน/ซ่อม</td>");
		print("</tr>");
		print("<tr>");
		print("<td style=\"text-align:center\">ทะเบียนรถ</td>");
		print("<td style=\"text-align:center\">หมายเหตุ</td>");
		print("</tr>");
		for($i=0; $i<sizeof($table2); $i++)
		{
		print("<tr>");
		print("<td>");
		print($table2[$i]['licence_check_driver']);
		print("</td>");
		print("<td>");
		print($table2[$i]['note_check_driver']);
		print("</td>");
		print("</tr>");
		}
		print("</table>");*/
	/*}
	else
	{
		print "ไม่มีรายการส่งสินค้าในวันนี้";
	}	*/
	?>		
<div style="padding-bottom: 20mm; "></div>

<META HTTP-EQUIV='Refresh' CONTENT = '1800;URL=show_ontv_orient2.php'>

