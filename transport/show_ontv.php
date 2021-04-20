<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
</head>
<?php
include("../include/mySqlFunc.php");
query("USE transport");
include'function.php';
?>
<style type="text/css">
.body_table{
	width:0mm;
	empty-cells: show;
	font-family:angsana new;
	font-size:28px; 
	text-align: left; 
	padding-left: 5px;
}
.body_table:hover img{
	cursor:pointer;
}
td{
	line-height:24px;
}
div.test{
    white-space:nowrap; 
    width:100px; 
    overflow:hidden; 
}
div.test:hover{
    text-overflow:inherit;
    overflow:visible;
}
div.test2{
    white-space:nowrap; 
    width:106px; 
    overflow:hidden; 
}
div.test2:hover{
    text-overflow:inherit;
    overflow:visible;
}
p{
	background-color:#fff200;
}
</style>
<body bgcolor="FFFFFF">
<?php
if(!empty($_POST['summit'])){$today=$_POST['datestart'];}else{$today = date("Y-m-d");}
if(empty($_POST['summit']))
{
	if(date('H')<11){$count=0;}else{$count=1;}
	$today2=date("2019-09-08");
	//code check ว่าวันพรุ่งนี้มีข้อมูลไหม ถ้าไม่มีก็ + 1 วนใหม่
	for($c=$count;$c<=5;$c++)
	{
		$cutdate=add_date($today,$c,0,0);//เพิ่มวัน ตามตัวแปร $c
		$ex=explode(" ",$cutdate); // เอาช่องว่างออก คือตัด HH:mm:SSSS ออก
		$_POST['datestart']=$ex[0]; // เอา array ตำแหน่งที่ได้มาไปโชว์
		$get=getlist("SELECT * FROM production_order WHERE delivery_date='".$_POST['datestart']."'");
		if(!empty($get)){break;}
	}
}
else
{
	$get=getlist("SELECT * FROM production_order WHERE delivery_date='".$today."'");
}
?>
<br>
<center>
<font color="#000000"face="angsana new"style="font-size:30px;">
	<b>ตารางการจัดส่ง วันที่ <?php print(printShortSlateThaiDate($_POST['datestart']));?></b>
</font>
</center>

<form action=""name="insertquarity"method="POST"style="margin-top:-20px;">
<table bgcolor="#FFFFFF"border="0"cellspacing="0"cellpadding="0"align="center"valign="middle">	
<br>
	<tr>	
		<td align="center"style="width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;">
			<b>วันที่ส่งของ </b>
			<?php print("<input type=\"date\"name=\"datestart\"id=\"datestart\"value=\"".$_POST['datestart']."\"style=\"width:50mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:20px;\">");?>
			<script type="text/javascript">
				jQuery('#datestart').datetimepicker({
				timepicker:false,
				format:'Y-m-d'
				});
			</script>
		</td>
		<td colspan="2"align="left"style="width:30mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			<input type="submit"name="summit"value="ค้นหา"style="width:20mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:22px;"onkeydown="if(event.keyCode==13){this.form.submit();return false;}">	
		</td>
	</tr>
</table>
</form>
<table bgcolor="#FFFFFF"border="1"cellspacing="0"cellpadding="0"align="center"valign="middle"style="width:100%;empty-cells:show; border:groove;" class="table table-bordered">
	<tr align="center">
		<td class="body_table"style="font-size:22px;width:12%;text-align:center;"><b>ทะเบียนรถ</td>
		<td class="body_table"style="font-size:22px;width:12%;text-align:center;"><b>ชื่อคนขับ</td>
		<!--<td class="body_table"style="font-size:22px;width:20%;text-align:center;"><b>ชื่อลูกค้า</td>		-->
		<td class="body_table"style="font-size:22px;width:32%;text-align:center;"><b>สถานที่จัดส่ง</td>
		<td class="body_table"style="font-size:22px;width:10%;text-align:center;"><b>ชนิดไม้</td>
		<td class="body_table"style="font-size:22px;width:20%;text-align:center;"><b>หมายเหตุ</td>
	</tr>
	<?php
	$search[0]=!empty($_POST['product_id'])?"product_id='".$_POST['product_id']."'":"";
	$search[1]=!empty($_POST['datestart'])?"delivery_date='".$_POST['datestart']."'":"";
	$where="";
    for($s=0;$s<sizeof($search);$s++) 
    { 
    	if(!empty($search[$s]))
    	{
    		if(empty($where))
    		{
    			$where=$search[$s];
    		}
    		else
    		{
    			$where.= " and ".$search[$s];
    		}
    	}
    }
	$invoice = getlist("SELECT DISTINCT (po.boonpon_id) AS boonpon_id 
		FROM production_order AS po 
		INNER JOIN type_production AS tp 
		ON product_id = id_production 
		INNER JOIN insertdata_transport AS it 
		ON po.boonpon_id = it.boonpon_id 
		INNER JOIN car_detail AS cd 
		ON it.idcar = cd.id_car 
		WHERE $where 
		AND cd.typecar!=6 
		AND po.boonpon_id!=0 
		GROUP BY po.boonpon_id 
		ORDER by cd.typecar,licenceplates,type_zone");
	for($i=0;$i<sizeof($invoice);$i++)
	{
		$getdata=getlist("SELECT name,delivery_date,item_number,delivery_name,note,posttime,po.boonpon_id,nameDriver,warehouse_id,data_number,alis_name,licenceplates,type_zone,cd.typecar,SUM(counts) AS counts 
			FROM production_order AS po 
			INNER JOIN type_production AS tp 
			ON product_id = id_production  
			INNER JOIN insertdata_transport AS it 
			ON po.boonpon_id = it.boonpon_id  
			INNER JOIN car_detail AS cd 
			ON it.idcar = cd.id_car 
			WHERE po.boonpon_id ='".$invoice[$i]['boonpon_id']."'  
			AND cd.typecar!=6 
			AND po.delivery_date='".$_POST['datestart']."' 
			GROUP BY delivery_name,warehouse_id,product_id 
			ORDER BY cd.typecar,licenceplates,type_zone");
	
		if(!empty($invoice))
		{
			print("<tr align=\"center\">");
			if($getdata[0]['typecar']==2)
			{
				print("<td class=\"body_table\"style=\"background-color:#66a6f5;\">");
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
				print("<td class=\"body_table\"style=\"background-color:#f96a6a;\">");
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
	//ชื่อคนขับ
	$find_word="นาย";
	$getdriver=getlist("select namedriver1 from driver where id_driver='".$getdata[0]['nameDriver']."'");
	$driver_name=strpos($getdriver[0]['namedriver1'],$find_word);
		if($driver_name!==FALSE){
			$word_cut_nai=substr($getdriver[0]['namedriver1'],9);
			$word_cut_space=explode(" ",$word_cut_nai);
			if($getdata[0]['type_zone']==0){
				print("<td class=\"body_table\"style=\"background-color:#fff200;\">");
				print($word_cut_space[0]);
				
			}else{
				print("<td class=\"body_table\">");
				print($word_cut_space[0]);
			}
		}else{
			if($getdata[0]['type_zone']==0){
				print("<td class=\"body_table\"style=\"background-color:#fff200;\">");
				print($getdriver[0]['namedriver1']);
			}else{
				print("<td class=\"body_table\">");
				print($getdriver[0]['namedriver1']);
			}
		}
		print("</td>");
	//ชื่อลูกค้า
		/*print("<td class=\"body_table\">");
		for($j=0;$j<sizeof($getdata);$j++)
		{
			$get_customer_name=getlist("SELECT namecustomer FROM customer WHERE id_customer='".$getdata[$j]['name']."'");
			if($getdata[0]['type_zone']==0){
				print("<div class=\"test2\"style=\"text-overflow:clip;\">");
				print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
				print("</div>");
			}else{
				print("<div class=\"test2\"style=\"text-overflow:clip;\">");
				print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
				print("</div>");
			}
			if(!empty($getdata[$j+1]['name'])&&$getdata[$j]['name']==$getdata[$j+1]['name']){break;}
			else if(!empty($getdata[$j+1]['name'])){print("<br>");}
		}
		print("</td>");	*/
	//สถานที่จัดส่ง		
		print("<td class=\"body_table\">");
		for($j=0;$j<sizeof($getdata);$j++)
		{		
			$get_delivery_name=getlist("SELECT detailship FROM shipping WHERE id_ship='".$getdata[$j]['delivery_name']."'");
			if($getdata[0]['type_zone']==0){
				print($get_delivery_name[0]['detailship']);
			}else{
				print($get_delivery_name[0]['detailship']);
			}
			if(!empty($getdata[$j+1]['delivery_name'])&&$getdata[$j]['delivery_name']==$getdata[$j+1]['delivery_name'])
			{//	break;
			}
			else if(!empty($getdata[$j+1]['delivery_name'])){print("<br>");}
		}
		print("</td>");
	//ชนิดไม้
		print("<td class=\"body_table\">");		
		print("<div class=\"test\"style=\"text-overflow:clip;\">");
		for($j=0;$j<sizeof($getdata);$j++)
		{	
			//$getdata[$j]['counts'] คือจำนวนตั้งไม้ที่ต้องบรรทุก 
			if($getdata[$j]['alis_name']=="ไม้PB"){
				print("<font color=\"red\">");
				print("(".$getdata[$j]['counts'].")".$getdata[$j]['alis_name']);
				print("</font>");
			}else if($getdata[$j]['alis_name']=="ไม้พื้น"){
				print("<font color=\"blue\">");
				print("(".$getdata[$j]['counts'].")".$getdata[$j]['alis_name']);
				print("</font>");
			}else if($getdata[$j]['alis_name']=="ไม้ปิดผิวกระดาษ"){
				print("<font color=\"deep-green\">");
				print("(".$getdata[$j]['counts'].")".$getdata[$j]['alis_name']);
				print("</font>");
			}else if($getdata[$j]['alis_name']=="ไม้ปิดผิวเฟอร์นิเจอร์"){
				print("<font color=\"#000000\">");
				print("(".$getdata[$j]['counts'].")".$getdata[$j]['alis_name']);
				print("</font>");
			}else if($getdata[$j]['alis_name']=="ไม้MDF"){
				print("<font color=\"#008000\">");
				print("(".$getdata[$j]['counts'].")".$getdata[$j]['alis_name']);
				print("</font>");
			}else if($getdata[$j]['alis_name']=="ไม้บัว"){
				print("<font color=\"#330033\">");
				print("(".$getdata[$j]['counts'].")".$getdata[$j]['alis_name']);
				print("</font>");
			}
			if(!empty($getdata[$j+1]['alis_name'])&&$getdata[$j]['alis_name']==$getdata[$j+1]['alis_name']){break;}
			else if(!empty($getdata[$j+1]['alis_name'])){print("<br>");}
		}
		print("</div>");
		print("</td>");
		//หมายเหตุ
		print("<td class=\"body_table\"style=\"font-size:22px;\">");
		for($j=0;$j<sizeof($getdata);$j++)
		{	
			print($getdata[$j]['note']);
			print($getdata[$j]['posttime']);
			if(!empty($getdata[$j+1]['note'])||!empty($getdata[$j+1]['posttime'])){print("<br>");}
		}
		print("</td>");
	print("</tr>");
	}	
	}
	$table2=getlist("SELECT licence_check_driver,note_check_driver,detail,id_check_driver FROM check_driver_car WHERE date_time='".$_POST['datestart']."'");
	for($i=0;$i<sizeof($table2);$i++)
	{
		print("<tr>");
		print("<td colspan='1'style=\"padding-left:2mm;\">");
		print($table2[$i]['licence_check_driver']);
		print("</td>");
		print("<td colspan='2'style=\"padding-left:2mm;\">");
		print($table2[$i]['note_check_driver']);
		if(!empty($table2[$i]['detail'])){
			print("&nbsp;&nbsp;&nbsp;(");
			print($table2[$i]['detail']);
			print(")");
		}
		print("</td>");
		print("<td style=\"text-align:center;\">");
		print("<button type=\"button\"class=\"btn btn-warning\"><a onclick=\"window.open('edit_showontv.php?id_check_driver=".$table2[$i]['id_check_driver']."','','menubar=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=450,top=45 ,left=250')\"style=\"cursor:pointer;color:#000000;\"><div id=\"btn\">แก้ไขข้อมูล</div></a></button> ");
		print("</td>");
		print("<td style=\"text-align:center;\">");
		print("<button type=\"button\"class=\"btn btn-danger\"><a href=\"JavaScript:if(confirm('คุณต้องการลบข้อมูลนี่ใช่หรือไม่')==true){window.location='".$_SERVER["PHP_SELF"]."?path=show_ontv&id_check_driver=".$table2[$i]['id_check_driver']."';}\"><font color=\"white\"><div id=\"btn\">ลบข้อมูล</div></font></button>");
  		print("</td>");
		print("</tr>");
	}
	if($_GET['id_check_driver']){
		$del = query("DELETE FROM check_driver_car where id_check_driver='".$_GET['id_check_driver']."'");
		if(!empty($del)){
			print"<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');</script>";
			print("<META HTTP-EQUIV='Refresh'CONTENT='0;URL=show_ontv.php'>");
		}else{
			print"<script type='text/javascript'>alert('ลบข้อมูลไม่สำเร็จ');</script>";
		}
	}
	?>
</table>		
<div style="padding-bottom:20mm;"></div>
<META HTTP-EQUIV='Refresh'CONTENT='300;URL=show_ontv.php'>