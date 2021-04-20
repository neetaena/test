<style type="text/css">
	.body_table{
		width:90mm;height:10mm;empty-cells: show;font-family:'angsana new';font-size:25px;
	}
</style>
<?php
@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");
	$getdate = $_GET['datedata'];
	$ty_user = $_GET['type_user'];
	$warehouse_id = $_GET['warehouse_id'];

	if(!empty($_POST['summit'])){
		$check_data = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$_POST['boonpon_id']."'");
		if(empty($check_data)){
			$a = query("INSERT into insertdata_transport SET number = '".$_GET['id']."'
						,nameDriver = '".$_POST['namedriver']."'
						,typecar = '".$_POST['typecar']."'
						,idcar = '".$_POST['car']."'
						,runperday = '".$_POST['runperday']."'
						,status = '1',boonpon_id='".$_POST['boonpon_id']."'");

			}
			query("UPDATE production_order SET boonpon_id='".$_POST['boonpon_id']."' WHERE warehouse_id='".$_GET['warehouse_id']."'");
			//query("UPDATE production_order SET boonpon_id='".$_POST['boonpon_id']."' WHERE number='".$_GET['id']."'");
			print "<script>window.opener.location.reload();</script>";
			print "<script>window.close();</script>";
		
	}
	//$get_data = getlist("SELECT * FROM ");
?>
<table bgcolor = "#aaaaaa" border = "1" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;">
	<form action = "" name = "insertquarity" method = "POST">
		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:'angsana new';font-size:25px;">
				<b>เลขที่ใบสั่งขาย</b>

			</td>
			<td align = "center" class="body_table">
				<input type = "text" name = "invoicedsales" value = "<?php print $_GET['id'];?>" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" readonly>
				
			</td>
		</tr>
		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:'angsana new';font-size:25px;">
				<b>เลขที่ใบขนส่งบุญพร</b>
			</td>
			<td align = "center" class="body_table">
			<?php
			$datejuarnal = explode("-", $getdate);
						$datejn = "";
						for ($j=0; $j < sizeof($datejuarnal); $j++) { 
							$datejn .= $datejuarnal[$j];
						}
						$rest = substr($datejn, 2, 8);//ตัดปี 2017 ให้เป็น 17 เฉยๆ
						//print $rest;
						//$juarnal = getlist("SELECT * FROM production_order where number='".$_GET['id']."'");
						$juarnal = getlist("SELECT  boonpon_id FROM production_order WHERE boonpon_id like '$rest%' order by boonpon_id  desc limit 1");

						if(!empty($juarnal))
						{
							$n4 = $juarnal[0]['boonpon_id']+1; //คือค่าเลขใบเบิกตัวถัดไป
							//print($rest);
						}else{
							$n4 = $rest."01";
							
						}

						
							$_POST['boonpon_id'] = empty($_POST['boonpon_id']) ?$n4 : $_POST['boonpon_id'];

				print("<input type = \"text\" name = \"boonpon_id\" value = \"".$_POST['boonpon_id']."\" style = \"width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
			?>
			</td>
		</tr>
		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>ชื่อคนขับรถ</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<select name = "namedriver" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" onchange="this.form.submit();" required="">
				<option value = ''>กรุณาเลือก</option>
				<?php
//---------------------------------------------------- กำหนดค่า ---------------------------------------------------						
						$check_id = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$_POST['boonpon_id']."'");

						if(!empty($check_id)){
							$_POST['namedriver'] = empty($_POST['namedriver']) ? $check_id[0]['nameDriver'] : $_POST['namedriver'];
							$_POST['typecar'] = empty($_POST['typecar']) ? $check_id[0]['typecar'] : $_POST['typecar'];
							$_POST['car'] = empty($_POST['car']) ? $check_id[0]['idcar'] : $_POST['car'];
							$_POST['runperday'] = empty($_POST['runperday']) ? $check_id[0]['runperday'] : $_POST['runperday'];
						}else{
							$get_name = getlist("SELECT * FROM insertdata_transport WHERE nameDriver='".$_POST['namedriver']."' order by id_transport desc limit 1");
							$_POST['typecar'] = empty($_POST['typecar']) ? $get_name[0]['typecar'] : $_POST['typecar'];
						}
//---------------------------------------------------- กำหนดค่า ---------------------------------------------------
						
						if($ty_user==2)
						{
							$data = getlist("SELECT * from driver where status = '1' and type_user='2'");	
						}else{
							$data = getlist("SELECT * from driver where status = '1' and type_user='1'");	
						}
						
						for($i=0;$i<sizeof($data);$i++){
							$selected = $data[$i]['id_driver']==$_POST['namedriver'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$data[$i]['id_driver']."\"".$selected.">".$data[$i]['namedriver1']."</option>");
						}

				?>
			</td>
		</tr>
		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>ประเภทรถ</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<select name = "typecar" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" onchange="this.form.submit();" required="">
				<option value = ''>เลือกประเภทรถ</option>
				<?php
					

					if($ty_user==2)
						{
							$gettypecar = getlist("SELECT * from car_head  WHere type_user='2' ");
						}else{
							$gettypecar = getlist("SELECT * from car_head  WHere type_user='1'");
						}
					
					for($i=0;$i<sizeof($gettypecar);$i++){
						$selected = $gettypecar[$i]['id_hcar']==$_POST['typecar'] ? "selected=\"selected\"" : "";
						print("<option value = \"".$gettypecar[$i]['id_hcar']."\"".$selected.">".$gettypecar[$i]['detailhcar']."</option>");
					}
				?>
				
			</td>
		</tr>

		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>ทะเบียนรถ</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<select name = "car" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" required="">
				<option value = ''>กรุณาเลือก</option>
				<?php
						
						query("USE transport");
						$data = getlist("SELECT * from car_detail where typecar = '".$_POST['typecar']."' and  status = '1' order by licenceplates asc");
						for($i=0;$i<sizeof($data);$i++){
							$selected = $data[$i]['id_car']==$_POST['car'] ? "selected=\"selected\"" : "";
							 print("<option value = \"".$data[$i]['id_car']."\"".$selected.">".$data[$i]['licenceplates']."  ".$data[$i]['licenceplate2']."</option>");
						}
				?>
			</td>
		</tr>

		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>ที่มาของรถ</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<select name = "Sourcescar" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				
				<?php
						
						query("USE transport");
						$data = getlist("select * from placecar where IDPLACE = '1' and status = '1' OR IDPLACE = '2' and status = '1'");
						for($i=0;$i<sizeof($data);$i++){
							$selected = $data[$i]['IDPLACE']==$_POST['Sourcescar'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$data[$i]['IDPLACE']."\"".$selected.">".$data[$i]['Nameplace']."</option>");
						}
				?>
			</td>
		</tr>
		<tr>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:25px;">
				<b>เที่ยววิ่ง</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;">
				<select name = "runperday" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" >
					     <option value = "">กรุณาเลือกสถานะ</option>
					<?php   
							$run	= array("1","2");
							for($i=0;$i<sizeof($data);$i++){
							$selected = $run[$i]==$_POST['runperday'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$run[$i]."\"".$selected.">".$run[$i]."</option>");
						}
					?>
				</select>
			</td>
		</tr>
			
		<tr>
			<td colspan = "2" align = "center" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:18px;">
					
			</td>
		</tr>
	
	</form>
	</table>