<?php
include("../include/mySqlFunc.php");
query("USE transport");
//$get = getlist("SELECT * FROM customer WHERE id_customer=\"476\"");
//print($get[0]['namecustomer']);
?>

<?php
include 'function.php';
?>
<style type="text/css">
	.body_table
	{
		width:0mm;empty-cells: show;font-family:angsana new;font-size:18px;
	}
	.body_table:hover img
	{
		cursor:pointer;
	}
</style>

<body bgcolor= "FFFFFF">
	<?php
	if(empty($_POST['datestart']))
	{
		$_POST['datestart'] = date('Y-m-d');
	}
	else
	{
		$_POST['datestart'] = $_POST['datestart'];
	}
	?>
<center><font color="#000000" face="angsana new"><h1><b>ตารางการจัดส่ง วันที่ <?php print(printShortSlateThaiDate($_POST['datestart'])); ?></b></h1></center></font>
<form action = "" name = "insertquarity" method = "POST">


<table bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" ">
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
	<?php
	if(!empty($_POST['datestart']))
	{
		$_POST['datestart'] = $_POST['datestart'];
	}
	else
	{
		$_POST['datestart'] = date("Y-m-d");
	}
	if(!empty($_POST['datestart']))
	{
	?>
	<table  bgcolor = "#FFFFFF" border = "1" cellspacing = "1" cellpadding = "2" align = "center" valign = "middle" style="width:100%;empty-cells: show;">
	<tr align = "center">
	<td class="body_table"><b>
		ชื่อลูกค้า
	</td>
			
	<!--<td class="body_table"><b>
		วันที่ส่ง/เวลา
	</td>-->
	
	<td class="body_table"><b>
		สถานที่จัดส่ง
	</td>
	
	
	
	<td class="body_table"><b>
		ชื่อคนขับ
	</td>
	
	<td class="body_table"><b>
		ทะเบียนรถ
	</td>


			
	<!--<td class="body_table"><b>
		วันที่ส่ง/เวลา
	</td>-->
	
	

	</tr>
	<?php
	$show_transport =1;

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
	$getdata = getlist("SELECT number,name,delivery_date,item_number,delivery_name,note,posttime,boonpon_id,warehouse_id,data_number FROM production_order as po inner join type_production as tp on product_id=id_production where $where   GROUP BY warehouse_id order by invoice");
			
	for($i=0;$i<sizeof($getdata);$i++)
	{
		//ค้นหาชื่อคนขับทะเบียนรถ
		$get_transaction = getlist("SELECT * from insertdata_transport where boonpon_id = '".$getdata[$i]['boonpon_id']."'");

		//ค้นหาข้อมูลสินค้าที่ต้องจัดส่ง
		$invoice = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE warehouse_id='".$getdata[$i]['warehouse_id']."' and delivery_date='".$_POST['datestart']."'");

		if(!empty($invoice))
		{
	?>
	<tr align = "center">						
	<td class="body_table">
	<?php
	$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[$i]['name']."'");
	print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
	?>
	</td>
			
	<!--<td class="body_table">
	<?php
	print $getdata[$i]['delivery_date'];//วันที่ส่ง/เวลา
	?>
	</td>-->

	<td class="body_table">
	<?php				
	if(!empty($getdata[$i]['customer_receive']))
	{
		if($getdata[$i]['customer_receive'] != $getdata[$i]['name'])
		{
			$get_customer_receive = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[$i]['customer_receive']."'");
			print $get_customer_receive[0]['namecustomer'];//สถานที่จัดส่ง
		}
	}
	$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata[$i]['delivery_name']."'");
	print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$get_delivery_name[0]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=650,top=45 ,left=250') \" style=\"cursor:pointer;color:#000;\">".$get_delivery_name[0]['detailship']."</a> ");
	
	$check_allowance = getlist("SELECT * FROM allowance WHERE id_ship='".$getdata[$i]['delivery_name']."'");
	if(empty($check_allowance))
	{
		print("<img src=\"image/shocked.png\" width=\"15\" height=\"15\" title='ไม่มีข้อมูลเบี้ยเลี้ยง'>");										
	}	
	?>
	</td>
	
	<td class="body_table">
	<?php
	$get_id = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id like '".$getdata[$i]['boonpon_id']."'");
	//คนขับ
	if(!empty($get_transaction[0]['nameDriver']))
	{
		$getdriver = getlist("select * from driver where id_driver = '".$get_id[0]['nameDriver']."'");
		print $getdriver[0]['namedriver1'];
	}
	else
	{
		print "&nbsp";
	}
	?>
	</td>
	
	<td class="body_table">
	<?php
	if(!empty($get_transaction[0]['idcar']))
	{					
		$getcar = getlist("select * from car_detail where id_car = '".$get_id[0]['idcar']."'");
		if($get_transaction[0]['typecar'] == 1 OR $get_transaction[0]['typecar'] == 3)
		{
			print $getcar[0]['licenceplates'];
		}
		else
		{
			print $getcar[0]['licenceplates']."<br>";
			print $getcar[0]['licenceplate2'];//ทะเบียนรถ
		}
	}
	else
	{
		print "&nbsp";
	}
	?>
	</td>	

<!-------------------------------------- อันที่ 2 --------------------------------------------------------->
	
















	</tr>
	<?php	
	}	
	}
	?>
</table>

	<?php
	}
	else
	{
		print "ไม่มีรายการส่งสินค้าในวันนี้";
	}	
	?>		
<div style="padding-bottom: 20mm; "></div>
