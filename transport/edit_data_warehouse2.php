<html>
<head>
	<title>แก้ไขข้อมูลคลังสินค้า</title>
	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
	 <link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
		<script type="text/javascript" src="datetimepicker/jquery.js"></script>
		<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script>
$(function() {
    $( "#customers" ).autocomplete({
        source: 'search_customer.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
		minLength: 2,
		
    });
});

$(function() {
    $( "#Sendlocation" ).autocomplete({
        source: 'search_location.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
		minLength: 1,
		
    });
});
</script>
</head>
<body style="background-color: #d1d4d8;">

<?php 
@session_start();
	@ini_set('display_errors', '0');
include("../include/mySqlFunc.php");
query("USE transport");
$id =$_GET['id_product'];
$query_location = getlist("SELECT DISTINCT id_ship FROM insertdatawarehouse as idw inner join productionorder as pro on pro.id_warehouse = idw.idwarehouse inner JOIN shipping as sh on idw.Sendlocation = sh.id_ship where idwarehouse ='$id'");

$query_num = getlist("SELECT * FROM insertdatawarehouse as idw INNER JOIN customer as cus on idw.customers = cus.id_customer "
										."INNER JOIN type_production as tp on idw.id_pro = tp.id_production INNER JOIN placecar as pla on idw.start = pla.IDPLACE "
										."INNER JOIN shipping as sp ON sp.id_ship= idw.sendlocation inner join productionorder as pro on idw.IDwarehouse = pro.id_warehouse where idwarehouse ='$id' and id_ship ='".$query_location[0]['id_ship']."'");
$sql2 = getlist("select pro.grade,tp.id_production,detail_production From insertdatawarehouse as idw "
												."inner join productionorder as pro on idw.idwarehouse = pro.id_warehouse "
												."inner join type_production as tp on idw.id_pro = tp.id_production where idwarehouse ='$id' and sendlocation ='".$query_location[0]['id_ship']."'"); 
	//print("id_location".$query_location[0]['id_ship']."<br>");
	//print("sql2//".$sql2[0]['id_production']."<br>");
	//print("sql2//".$sql2[0]['grade']."<br>");
	//print("product_name//".$_POST['product_name']."<br>");
	//print("customer /".$_POST['customer']);
	/*print "<pre>";
	Print_r($_POST);
	print "</pre>";*/
	if(!empty($_POST['summit'])){
		
			query("delete from insertdatawarehouse where idwarehouse ='$id'");
			query("delete from productionorder where id_warehouse ='$id'");
			$query_idcus = getlist("select id_customer from customer where namecustomer ='".$_POST['customers']."'");
			$query_idship = getlist("select id_ship from shipping where detailship ='".$_POST['Sendlocation']."'");
				for($k = 0; $k < sizeof($_POST['taxinvoice']); $k++)
				{
					$stringData.=$_POST['taxinvoice'][$k];
					if(!empty($_POST['taxinvoice'][$k+1]))
					{
						$stringData.=",";
					}
				}
			
		 $a = query("INSERT INTO insertdatawarehouse SET invoicedsales = '".$_POST['invoicedsales']."'
					,taxinvoice = '".$stringData."'
					,slipinvoice = '".$_POST['slipinvoice']."'
					,customers = '".$query_idcus[0]['id_customer']."'
					,Sendlocation = '".$query_idship[0]['id_ship']."'
					,start = '1'
					,datetimeout = '".$_POST['datetimeout1']."'
					,Posttime = '".$_POST['Posttime']."'
					,dateimport = '".date("Y-m-d")."'
					,id_pro = '".$_POST['product_name']."'
					,status = '1'");
		
			$geta = getlist("select MAX(IDwarehouse) AS idware from insertdatawarehouse where status = '1'");
			if($_POST['product_name'] =='1' or $_POST['product_name'] =='2'){
				for($i=0;$i<sizeof($_POST['taxinvoice']);$i++){
					if(!empty($_POST['taxinvoice'][$i])){
						$b = query("INSERT into productionorder SET id_warehouse = '".$geta[0]['idware']."'
							,detail_order = '".$_POST['Orders'][$i]."(".$_POST['Orders1'][$i]."x".$_POST['Orders2'][$i].")'
							,thick = '".$_POST['Orders'][$i]."'
							,width = '".$_POST['Orders1'][$i]."'
							,long_wood = '".$_POST['Orders2'][$i]."'
							,glue = '".$_POST['glue'][$i]."'
							,grade = '".$_POST['grade'][$i]."'
							,plate = '".$_POST['plate'][$i]."'
							,numset = '".$_POST['numset'][$i]."'
							,status = '1'
							,texinvoice = '".$_POST['taxinvoice'][$i]."'
							,balance = '".$_POST['balance'][$i]."'
							,dateimport = '".$_POST['datetimeout'][$i]."'");
							
							
						}
				}
			}else
			{
				for($i=0;$i<sizeof($_POST['taxinvoice']);$i++){
					if(!empty($_POST['taxinvoice'][$i])){
						$b = query("INSERT into productionorder SET id_warehouse = '".$geta[0]['idware']."'
							,detail_order = '".$_POST['Orders4'][$i]."'
							,grade = '".$_POST['grade'][$i]."'
							,plate = '".$_POST['plate'][$i]."'
							,numset = '".$_POST['numset'][$i]."'
							,status = '1'
							,texinvoice = '".$_POST['taxinvoice'][$i]."'
							,balance = '".$_POST['balance'][$i]."'
							,dateimport = '".$_POST['datetimeout'][$i]."'");
							
							
						}
				}
			}
		if($a== true and $b==true){
			header('Location: index.php?path=report_warehouse');
		}else{
			print "ไม่เรียบร้อย";
		}
	}
?>


	<center><font color="#000000" face="angsana new"><h1><b>แก้ไขข้อมูล(คลังสินค้า)</b></h1></center></font>
	<form action = "" name = "insertquarity" method = "POST" >
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;height:8mm;empty-cells: show;">
		<tr>
			<td align = "right" style = "width:50mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>เลขที่ใบสั่งขาย&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				  <input name="invoicedsales" type="text" id="invoicedsales" size="25" maxlength="50"  value="<?php print $query_num[0]['invoicedsales'];?>" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>

		<tr>
			<td align = "right" style = "width:50mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>เลขที่ใบโอน&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			 <input name="slipinvoice" type="text" id="slipinvoice" size="25" maxlength="50"  value="<?php print $query_num[0]['slipinvoice'];?>" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
			<td align = "right" style = "width:50mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>ชื่อลูกค้า&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td style = "width:50mm;height:8mm;empty-cells:show;font-family:angsana new;font-size:22px;">
			<input name="customers" type="text" id="customers" size="25" maxlength="50"  value="<?php if(!empty($_POST['customers'])){ print $_POST['customers'];}else{print $query_num[0]['namecustomer'];} ?>" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">

			</td>
		</tr>
		<tr>
			<td align = "right" style = "width:50mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>ที่อยู่&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<?php
				if(!empty($_POST['customers'])){
					$getdata = getlist("select * from customer where namecustomer = '".$_POST['customers']."' and status = '1'");
					print "<input type = \"text\" name = \"address\" value = \"".$getdata[0]['address']."\" style = \"width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;\">";
				}else{
					$sql12 = getlist("select address from insertdatawarehouse as idw inner join customer as cus on cus.id_customer = idw.customers where idwarehouse ='$id' ");
					print "<input type = \"text\" name = \"address\" value = \"".$sql12[0]['address']."\" style = \"width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;\">";
				}
				?>
			</td>
		</tr>
		<tr>
			<td align = "right" style = "width:50mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>สถานที่จัดส่ง&nbsp;&nbsp;&nbsp;</b>
			</td>
			
			<td  style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			<?php $sql12 = getlist("select detailship from shipping where id_ship ='".$query_location[0]['id_ship']."'");  ?>
			 <input name="Sendlocation" type="text" id="Sendlocation" size="25" maxlength="50"  value="<?php if(!empty($_POST['Sendlocation'])){ print $_POST['Sendlocation'];}else{print $sql12[0]['detailship'];} ?>" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
			
				
			</td>
		</tr>
		<tr>
			<td align = "right" style = "width:50mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>วันที่ส่งของ&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input name="datetimeout1" type="date" class="datetimeout" size="25" maxlength="50"  value="<?php print $query_num[0]['datetimeout'];?>" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">

			</td>
		</tr>
		<tr>
			<td align = "right" style = "width:50mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>เวลาส่ง&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td align = "center" style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				 <input name="Posttime" type="text" id="postime" size="25" maxlength="50"  value="<?php print $query_num[0]['Posttime'];?>"  style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
			<td align = "right" style = "width:50mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>สินค้า&nbsp;&nbsp;&nbsp;</b>
			</td>
			<td  style = "width:90mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<select name="product_name" id="product_name" style="width: 340px;" onchange="this.form.submit();"> 
					<?php 
						
						if(empty($_POST['product_name'])){
							
									print("<option value = \"".$sql2[0]['id_production']."\"".$selected.">".$query_num[0]['detail_production']."</option>");
									$quey_nameproduct = getlist("select id_production,detail_production from type_production where id_production !='".$sql2[0]['id_production']."'"); 
									for($i =0; $i<sizeof($quey_nameproduct);$i++)
									{
										print("<option value = \"".$quey_nameproduct[$i]['id_production']."\"".$selected.">".$quey_nameproduct[$i]['detail_production']."</option>");
									 }
						}else{
							$quey_nameproduct = getlist("select id_production,detail_production from type_production "); 
							for($y =0; $y<sizeof($quey_nameproduct);$y++)
							{
								$selected = $quey_nameproduct[$y]['id_production']==$_POST['product_name'] ? "selected=\"selected\"" : "";
								print("<option value = \"".$quey_nameproduct[$y]['id_production']."\"".$selected.">".$quey_nameproduct[$y]['detail_production']."</option>");
							 }
						}
					 ?>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan = "2" align = "right" style = "width:140mm;height:4mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>&nbsp;&nbsp;&nbsp;</b>
			</td>
		</tr>
	</table>
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;height:8mm;empty-cells: show;">
		<tr>
			<td align = "center" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>เลขที่ใบกำกับภาษี</b>
			</td>
			<td align = "center" style = "width:80mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<?php 
					if(!empty($_POST['product_name'])){
						if($_POST['product_name'] =='1' or $_POST['product_name'] =='2'){
							print("<td  style=\"width:26mm;font-family:angsana new;font-size:22px;\"><b>ความหนา</b>");
							print("<td  style=\"width:27mm;font-family:angsana new;font-size:22px;\"><b>ความกว้าง</b>");
							print("<td  style=\"width:27mm;font-family:angsana new;font-size:22px;\"><b>ความยาว</b>");
						}else{
							print("<td align = \"center\"  style=\"font-family:angsana new;font-size:22px;\"><b>รายละเอียดขนาด</b>");
						}
					}else{
						if($sql2[0]['id_production']==1 or $sql2[0]['id_production']==2){
							
							print("<td  style=\"width:26mm;font-family:angsana new;font-size:22px;\"><b>ความหนา</b>");
							print("<td  style=\"width:27mm;font-family:angsana new;font-size:22px;\"><b>ความกว้าง</b>");
							print("<td  style=\"width:27mm;font-family:angsana new;font-size:22px;\"><b>ความยาว</b>");
						}else{
							print("<td align = \"center\"  style=\"font-family:angsana new;font-size:22px;\"><b>รายละเอียดขนาด</b>");
						}
						
					}
				?>
			</td>
			<td align = "center" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>กาว</b>
			</td>
			<td align = "center" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>เกรด</b>
			</td>
			<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>จำนวนตั้ง</b>
			</td>
			<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>จำนวนแผ่น</b>
			</td>
			<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>คงเหลือ</b>
			</td>
			<td align = "center" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>วันที่จัดส่ง</b>
			</td>
			
		</tr>	
		<?php
			query("USE transport");
			$size_loop = getlist("select * from productionorder where id_warehouse ='$id'");
			$count = 1;
			for($i=0;$i<sizeof($size_loop);$i++)
			{
		?>
		<tr>
			<td align = "center" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input name="taxinvoice[]" type="text" id="taxinvoice[]" size="25" maxlength="50"  value="<?php print $size_loop[$i]['texinvoice'];?>" style = "width:35mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
			<td align = "center" style = "width:80mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				
				<?php 
				if(!empty($_POST['product_name'])){
					if($_POST['product_name'] =='1' or $_POST['product_name'] =='2')
					{

						query("USE warehouse2");
						$thick=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$_POST['product_name']."' and orderby_pb = '5'");
						$width=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$_POST['product_name']."' and orderby_pb = '6'");	
						$long=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$_POST['product_name']."' and orderby_pb = '7'");	
						?>
							<td>
							<select name = "Orders[]" style="width:26mm;font-family:angsana new;font-size:18px;">
							<option value = "<?php print($size_loop[$i]['thick']); ?>"><?php print($size_loop[$i]['thick']); ?></option>
								<?php 
								for($t=0; $t<sizeof($thick);$t++)
								{
										print("<option value = \"".$thick[$t]['code_detail']."\"".$selected.">".$thick[$t]['code_detail']."</option>"); 
								}?>
							</select>
							</td>
							<td>
							<select name = "Orders1[]" style="width:27mm;font-family:angsana new;font-size:18px;">
							<option value = "<?php print ($size_loop[$i]['width']); ?>"><?php print($size_loop[$i]['width']); ?></option>
								<?php 
								for($w=0; $w<sizeof($width);$w++)
								{
										print("<option value = \"".$width[$w]['code_detail']."\"".$selected.">".$width[$w]['code_detail']."</option>"); 
								}?>
							</select>
							</td>
							
							<td>
							<select name = "Orders2[]" style="width:17mm;font-family:angsana new;font-size:18px;">
							<option value = "<?php print($size_loop[$i]['long_wood']); ?>"><?php print($size_loop[$i]['long_wood']); ?></option>
								<?php 
								for($l=0; $l<sizeof($long);$l++)
								{
										print("<option value = \"".$long[$l]['code_detail']."\"".$selected.">".$long[$l]['code_detail']."</option>"); 
								}?>
							</select>
							</td>
							<td>

							<?php
							print("<input type = \"text\" name = \"glue[]\"  value = \"".print $_POST['glue'][$i]."\" style = \"width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;\">"); ?>
							</td>
						<?php }
						else{
									query("USE warehouse2");
									$size=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$_POST['product_name']."' and orderby_pb = '3'");
								?>
							<td>
										<select name = "Orders4[]" style="width:80mm;font-family:angsana new;font-size:18px;">
										<option  value = "<?php print($size_loop[$i]['detail_order'])?>"><?php print ($size_loop[$i]['detail_order']); ?></option>
										<?php 
										for($s=0; $s<sizeof($size);$s++)
										{
												print("<option value = \"".$size[$s]['data_detail']."\"".$selected.">".$size[$s]['data_detail']."</option>"); 
										}?>
									</select>
							</td>
							<td>
							<input type = "text" name = "glue[]"  value = "<?php print $size_loop[$i]['glue'];?>" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
							</td>
						<?php 
						} 
					}else {
							if($sql2[0]['id_production']==1 or $sql2[0]['id_production']==2){
								
								?>
									<td>
										<select name = "Orders[]" style="width:26mm;font-family:angsana new;font-size:18px;">
										<option value = "<?php print($size_loop[$i]['thick']); ?>"><?php print($size_loop[$i]['thick']); ?></option>
											<?php 
											query("USE warehouse2");
											$thick=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$sql2[0]['id_production']."' and orderby_pb = '5'");//ความหนา
											for($t=0; $t<sizeof($thick);$t++)
											{
													//$selected = $thick[$t]['code_detail']==$thick[$t]['code_detail'] ? "selected=\"selected\"" : "";
													print("<option value = \"".$thick[$t]['code_detail']."\"".$selected.">".$thick[$t]['code_detail']."</option>"); 
											}?>
										</select>
									</td>
									<td>
										<select name = "Orders1[]" style="width:27mm;font-family:angsana new;font-size:18px;">
										<option value = "<?php print ($size_loop[$i]['width']); ?>"><?php print($size_loop[$i]['width']); ?></option>
											<?php 
											$width=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$sql2[0]['id_production']."' and orderby_pb = '6'");	//ความกว้าง
											for($w=0; $w<sizeof($width);$w++)
											{
												
													print("<option value = \"".$width[$w]['code_detail']."\"".$selected.">".$width[$w]['code_detail']."</option>"); 
											}?>
										</select>
									</td>
									
									<td>
										<select name = "Orders2[]" style="width:17mm;font-family:angsana new;font-size:18px;">
										<option value = "<?php print($size_loop[$i]['long_wood']); ?>"><?php print($size_loop[$i]['long_wood']); ?></option>
											<?php 
											$long=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$sql2[0]['id_production']."' and orderby_pb = '7'");	//ความยาว
											for($l=0; $l<sizeof($long);$l++)
											{
													
													print("<option value = \"".$long[$l]['code_detail']."\"".$selected.">".$long[$l]['code_detail']."</option>"); 
											}?>
										</select>
									</td>
									<td>
							<input type = "text" name = "glue[]"  value = "<?php print $size_loop[$i]['glue'];?>" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;" >
							</td>
								<?php
							}else
								{
									print "<td>";
											print "<select name = \"Orders4[]\" style=\"width:80mm;font-family:angsana new;font-size:18px;\">";
											print "<option  value = \"".$size_loop[$i]['detail_order']."\">".$size_loop[$i]['detail_order']."</option>";
											
												query("USE warehouse2");
												$size=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$sql2[0]['id_production']."' and orderby_pb = '3'");
												for($s=0; $s<sizeof($size);$s++)
												{
														print("<option value = \"".$size[$s]['data_detail']."\"".$selected.">".$size[$s]['data_detail']."</option>"); 
												}
							
											print "</select>";
									print "</td>";
										print "<td>";
										
										print "<input type =\"text\" name = \"glue[]\"   style =\"width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;\" value =\"".$size_loop[$i]['glue']."\">";
										print "</td>";
								} 
							
						}
				
						
						?>
			</td>
			<td align = "center" style = "width:20mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<select name = "grade[]" style = "width:20mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:20px;" >
					
					<?php
							print "<option value = \"".$sql2[$i]['grade']."\"".$selected.">".$sql2[$i]['grade']."</option>";//เกรด
							query("USE warehouse2");
							$get_grade = getlist("SELECT detail_quality FROM type_quality where detail_quality !='".$sql2[$i]['grade']."'");
							for($k=0;$k<sizeof($get_grade);$k++){
								print("<option value = \"".$get_grade[$k]['detail_quality']."\"".$selected.">".$get_grade[$k]['detail_quality']."</option>");
							}
					?>
				</select>
			</td>
			<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				 <input name="plate[]" type="text" id="plate[]" size="25" maxlength="50"  value="<?php print $size_loop[$i]['plate'];?>" style = "width:29mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
			<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			 <input name="numset[]" type="text" id="numset[]" size="25" maxlength="50"  value="<?php print $size_loop[$i]['numset'];?>" style = "width:29mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
			<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "text" name = "balance[]" value = "<?php print $size_loop[$i]['balance'];?>" style = "width:29mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
			<td align = "center" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				 <input name="datetimeout[]" type="text" class="datetimeout" size="25" maxlength="50"  value="<?php print $size_loop[$i]['dateimport'];?>" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
					<script type="text/javascript">
					 $('.datetimeout').datetimepicker({
					 timepicker:false,
					 format:'Y-m-d'
					 });
			 </script>
			</td>
		<tr>
		<?php
								$count++;
											if($count > 20){
												$count=1;
											}
			
			
			}
			for($k=$count;$k<7;$k++){
									?>
											<tr>
												<td align = "center" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
													<input name="taxinvoice[]" type="text" id="taxinvoice[]" size="25" maxlength="50" style = "width:35mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
												</td>
												<td>
													
														<?php 
													if(!empty($_POST['product_name']))
													{
														if($_POST['product_name'] =='1' or $_POST['product_name'] =='2')
														{
														query("USE warehouse2");
														$thick=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$_POST['product_name']."' and orderby_pb = '5'");
														$width=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$_POST['product_name']."' and orderby_pb = '6'");	
														$long=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$_POST['product_name']."' and orderby_pb = '7'");	
														?>
																<td>
																<select name = "Orders[]" style="width:26mm;font-family:angsana new;font-size:18px;">
																<option value = "">เลือกความหนา</option>
																	<?php 
																	for($t=0; $t<sizeof($thick);$t++)
																	{
																			print("<option value = \"".$thick[$t]['code_detail']."\"".$selected.">".$thick[$t]['code_detail']."</option>"); 
																	}?>
																</select>
																</td>
																<td>
																<select name = "Orders1[]" style="width:27mm;font-family:angsana new;font-size:18px;">
																<option value = "">เลือกความกว้าง</option>
																	<?php 
																	for($w=0; $w<sizeof($width);$w++)
																	{
																			print("<option value = \"".$width[$w]['code_detail']."\"".$selected.">".$width[$w]['code_detail']."</option>"); 
																	}?>
																</select>
																</td>
																
																<td>
																<select name = "Orders2[]" style="width:17mm;font-family:angsana new;font-size:18px;">
																<option value = "">เลือกความยาว</option>
																	<?php 
																	for($l=0; $l<sizeof($long);$l++)
																	{
																			print("<option value = \"".$long[$l]['code_detail']."\"".$selected.">".$long[$l]['code_detail']."</option>"); 
																	}?>
																</select>
																</td>
																<td>
																<input type = "text" name = "glue[]"  value = "<?php print $_POST['glue'];?>" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
																</td>
														<?php 
														}else
														{
															query("USE warehouse2");
																$size=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$_POST['product_name']."' and orderby_pb = '3'");
														?>
															<td>
																<select name = "Orders4[]" style="width:80mm;font-family:angsana new;font-size:18px;">
																<option value = "">เลือกขนาด</option>
																	<?php 
																	for($s=0; $s<sizeof($size);$s++)
																	{
																			print("<option value = \"".$size[$s]['data_detail']."\"".$selected.">".$size[$s]['data_detail']."</option>"); 
																	}?>
																</select>
															</td>
															<td>
							<input type = "text" name = "glue[]"  value = "<?php print $_POST['glue'];?>" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
							</td>
														<?php
														}
													}
													else
													{
														if($sql2[0]['id_production'] =='1' or $sql2[0]['id_production'] =='2')
														{
														query("USE warehouse2");
														$thick=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$sql2[0]['id_production']."' and orderby_pb = '5'");
														$width=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$sql2[0]['id_production']."' and orderby_pb = '6'");	
														$long=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$sql2[0]['id_production']."' and orderby_pb = '7'");	
														?>
																<td>
																<select name = "Orders[]" style="width:26mm;font-family:angsana new;font-size:18px;">
																<option value = "">เลือกความหนา</option>
																	<?php 
																	for($t=0; $t<sizeof($thick);$t++)
																	{
																			print("<option value = \"".$thick[$t]['code_detail']."\"".$selected.">".$thick[$t]['code_detail']."</option>"); 
																	}?>
																</select>
																</td>
																<td>
																<select name = "Orders1[]" style="width:27mm;font-family:angsana new;font-size:18px;">
																<option value = "">เลือกความกว้าง</option>
																	<?php 
																	for($w=0; $w<sizeof($width);$w++)
																	{
																			print("<option value = \"".$width[$w]['code_detail']."\"".$selected.">".$width[$w]['code_detail']."</option>"); 
																	}?>
																</select>
																</td>
																
																<td>
																<select name = "Orders2[]" style="width:17mm;font-family:angsana new;font-size:18px;">
																<option value = "">เลือกความยาว</option>
																	<?php 
																	for($l=0; $l<sizeof($long);$l++)
																	{
																			print("<option value = \"".$long[$l]['code_detail']."\"".$selected.">".$long[$l]['code_detail']."</option>"); 
																	}?>
																</select>
																</td>
																<td>
																	<input type = "text" name = "glue[]"  value = "<?php print $_POST['glue'];?>" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
																	</td>
															<?php 
														}else{
															
														
																query("USE warehouse2");
																$size=getlist("SELECT * FROM type_production_detail WHERE status_pb = '1' and id_production = '".$sql2[0]['id_production']."' and orderby_pb = '3'");
															
															
													?>
															<td>
																<select name = "Orders4[]" style="width:80mm;font-family:angsana new;font-size:18px;">
																<option value = "">เลือกขนาด</option>
																	<?php 
																	for($s=0; $s<sizeof($size);$s++)
																	{
																			print("<option value = \"".$size[$s]['data_detail']."\"".$selected.">".$size[$s]['data_detail']."</option>"); 
																	}?>
																</select>
															</td>
															<td>
																	<input type = "text" name = "glue[]"  value = "<?php print $_POST['glue'];?>" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
																	</td>
															<?php 
														}
													} ?>

												</td>
												<td align = "center" style = "width:20mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
													<select name = "grade[]" style = "width:20mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:20px;" >
														<option value = '' >เลือกเกรด</option>
														<?php
																query("USE warehouse2");
																$get_grade = getlist("SELECT detail_quality FROM type_quality ");
																for($u=0;$u<sizeof($get_grade);$u++){
																	print("<option value = \"".$get_grade[$u]['detail_quality']."\"".$selected.">".$get_grade[$u]['detail_quality']."</option>");
																}
														?>
													</select>
												</td>
												<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
													 <input name="plate[]" type="text" id="plate[]" size="25" maxlength="50"  style = "width:29mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
												</td>
												<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
												 <input name="numset[]" type="text" id="numset[]" size="25" maxlength="50"  style = "width:29mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
												</td>
												<td align = "center" style = "width:10mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
													<input type = "text" name = "balance[]" style = "width:29mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
												</td>
												<td align = "center" style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
													 <input name="datetimeout[]" type="text" class="datetimeout" size="25" maxlength="50"  style = "width:30mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:22px;">
														<script type="text/javascript">
														 $('.datetimeout').datetimepicker({
														 timepicker:false,
														 format:'Y-m-d'
														 });
												 </script>
												</td>
											</tr>
			<?php	} ?>
		
		<tr >
			<td colspan = "10" align = "center" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ยืนยันการแก้ไข" style = "width:40mm;height:8mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					
			</td>
		</tr>
	</table>
	
	</form>
	</body>
</html>
