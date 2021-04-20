	<link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="datetimepicker/jquery.js"></script>
	<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
	 <script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>
<style type="text/css">
	.body_table{
		width:90mm;height:10mm;empty-cells: show;font-family:'angsana new';font-size:25px;
	}
</style>
<script type="text/javascript">
	function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
						ele.onKeyPress=vchar;
						}	
</script>
<?php
@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");
	$getdate = $_GET['datedata'];
	$ty_user = $_GET['type_user'];
	$warehouse_id = $_GET['warehouse_id'];

	if(!empty($_POST['summit'])){

		$up = $_POST['up'];
		$down = $_POST['down'];
		$final = $_POST['final'];
		$type_customer = $_POST['type_customer'];
		if(!empty($_POST['car']) && $_POST['namedriver']){
			$check_data = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$_POST['boonpon_id']."'");
			if(empty($check_data)){
				$get_type_car = getlist("SELECT * FROM car_detail WHERE id_car='".$_POST['car']."'");
			$a = query("INSERT into insertdata_transport SET number = '".$_GET['id']."'
						,nameDriver = '".$_POST['namedriver']."'
						,typecar = '".$get_type_car[0]['typecar']."'
						,idcar = '".$_POST['car']."'
						,runperday = '".$_POST['runperday']."'
						,status = '1',boonpon_id='".$_POST['boonpon_id']."',up='$up',down='$down',final='$final',type_customer='$type_customer'");
				
			}else{
				$a = query("UPDATE insertdata_transport SET nameDriver = '".$_POST['namedriver']."'
						,typecar = '".$get_type_car[0]['typecar']."'
						,idcar = '".$_POST['car']."'
						,runperday = '".$_POST['runperday']."',up='$up',down='$down',final='$final',type_customer='$type_customer',boonpon_id='".$_POST['boonpon_id']."' WHERE id_transport = '".$check_data[0]['id_transport']."'");
			}
			if($a){
				query("UPDATE production_order SET boonpon_id='".$_POST['boonpon_id']."' WHERE warehouse_id='".$_GET['warehouse_id']."' and delivery_date='$getdate'");
			}


			//query("UPDATE production_order SET boonpon_id='".$_POST['boonpon_id']."' WHERE number='".$_GET['id']."'");
			print "<script>window.opener.location.reload();</script>";
			print "<script>window.close();</script>";
		}else{
			$message =  "กรุณากรอกชื่อคนขับ หรือ ทะเบียนรถให้ถูกต้อง";
				print "<script type='text/javascript'>alert('$message');</script>";
		}
		
		
	}
	//$get_data = getlist("SELECT * FROM ");
?>
<table bgcolor = "#aaaaaa" border = "1" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;background-color: #aaa;margin-top: 6px;">
	<form action = "" name = "insertquarity" method = "POST">
		<tr>
			<td align = "center" class="body_table">
				<b>เลขที่ใบสั่งขาย</b>

			</td>
			<td align = "center" class="body_table">
				<input type = "text" name = "invoicedsales" value = "<?php print $_GET['id'];?>" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" readonly>
				
			</td>
		</tr>
		<tr>
			<td align = "center" class="body_table">
				<b>ชื่อลูกค้า</b>

			</td>
			<td align = "center" class="body_table">
				<?php
					$get_customer = getlist("SELECT * FROM production_order as po inner join customer as c on po.name=c.id_customer WHERE number='".$_GET['id']."'");
				?>
				<input type = "text" name = "invoicedsales" value = "<?php print $get_customer[0]['namecustomer'];?>" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" readonly>
				
			</td>
		</tr>
		<tr>
			<td align = "center" class="body_table">
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
						$juarnal = getlist("SELECT  MAX(boonpon_id) as boonpon_id FROM production_order WHERE boonpon_id like '$rest%' ");

						if(!empty($juarnal[0]['boonpon_id']))
						{
							$n4 = $juarnal[0]['boonpon_id']+1; //คือค่าเลขใบเบิกตัวถัดไป
							//print($rest);
						}else{
							$n4 = $rest."01";
							
						}

						
							$_POST['boonpon_id'] = empty($_POST['boonpon_id']) ?$n4 : $_POST['boonpon_id'];

				print("<input type = \"text\" name = \"boonpon_id\" value = \"".$_POST['boonpon_id']."\" style = \"width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" required>");
			?>
			</td>
		</tr>
	
				<?php
//---------------------------------------------------- กำหนดค่า ---------------------------------------------------						
						$check_id = getlist("SELECT * FROM insertdata_transport as it inner join driver as d on it.nameDriver=d.id_driver inner join car_detail as cd on it.idcar=cd.id_car WHERE boonpon_id='".$_POST['boonpon_id']."' ");
						if(!empty($check_id)){
							$_POST['namedriver'] = empty($_POST['namedriver']) ? $check_id[0]['nameDriver'] : $_POST['namedriver'];
							$_POST['typecar'] = empty($_POST['typecar']) ? $check_id[0]['typecar'] : $_POST['typecar'];
							$_POST['car'] = empty($_POST['car']) ? $check_id[0]['idcar'] : $_POST['car'];
							$_POST['runperday'] = empty($_POST['runperday']) ? $check_id[0]['runperday'] : $_POST['runperday'];
							$_POST['place_id'] = empty($_POST['place_id']) ? $check_id[0]['namedriver1'] : $_POST['place_id'];
							$_POST['license_name'] = empty($_POST['license_name']) ? $check_id[0]['licenceplates'] : $_POST['license_name'];
						}else{
							$get_name = getlist("SELECT * FROM insertdata_transport WHERE nameDriver='".$_POST['namedriver']."' order by id_transport desc limit 1");
							$_POST['typecar'] = empty($_POST['typecar']) ? $get_name[0]['typecar'] : $_POST['typecar'];
						}
//---------------------------------------------------- กำหนดค่า ---------------------------------------------------

				?>
		
		<tr>
			<td align = "center" class="body_table">
				<b>ชื่อคนขับรถ</b>
			</td>
			<td align = "center" class="input_data2">
				
				<?php
					
						print("<input type = \"text\" name = \"place_id\" id=\"place_id\" value = \"".$_POST['place_id']."\" style = \"width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\">");

				?>
				<input type = "hidden" name = "namedriver"  id = "namedriver" value = "<?php print $_POST['namedriver'];?>" required>
			</td>
		</tr>
					<script type="text/javascript">
						function make_autocom2(autoObj,showObj){
						var mkAutoObj=autoObj;
						var mkSerValObj=showObj;
						new Autocomplete(mkAutoObj, function() {
						this.setValue = function(id) {     
							document.getElementById(mkSerValObj).value = id;
						}
						if ( this.isModified )
							this.setValue("");
							if ( this.value.length < 1 && this.isNotClick )
								return ;   
								return "autoComplete/get_driver.php?&q=" +encodeURIComponent(this.value);
							});
						}
						make_autocom2("place_id","namedriver");
					</script>

		<!--<tr>
			<td align = "center" class="body_table">
				<b>ประเภทรถ</b>
			</td>
			<td align = "center" class="body_table">
				<select name = "typecar" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" onchange="this.form.submit();" required="">
				<option value = ''>เลือกประเภทรถ</option>
				<?php
					

					if($ty_user==1)
						{
							$gettypecar = getlist("SELECT * from car_head  WHere type_user='1'");
						}else{
							
							$gettypecar = getlist("SELECT * from car_head  WHere type_user='2' ");
						}
					
					for($i=0;$i<sizeof($gettypecar);$i++){
						$selected = $gettypecar[$i]['id_hcar']==$_POST['typecar'] ? "selected=\"selected\"" : "";
						print("<option value = \"".$gettypecar[$i]['id_hcar']."\"".$selected.">".$gettypecar[$i]['detailhcar']."</option>");
					}
				?>
				
			</td>
		</tr>-->



		<tr>
			<td align = "center" class="body_table">
				<b>ทะเบียนรถ</b>
			</td>
			<td align = "center" class="input_data2">
				
				<?php
					
				print("<input type = \"text\" name = \"license_name\" id=\"license_name\" value = \"".trim($_POST['license_name'])."\" style = \"width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\">");
				?>
				<input type = "hidden" name = "car"  id = "car" value = "<?php print $_POST['car'];?>" required>
			</td>
		</tr>
					<script type="text/javascript">
						function make_autocom2(autoObj,showObj){
						var mkAutoObj=autoObj;
						var mkSerValObj=showObj;
						new Autocomplete(mkAutoObj, function() {
						this.setValue = function(id) {     
							document.getElementById(mkSerValObj).value = id;
						}
						if ( this.isModified )
							this.setValue("");
							if ( this.value.length < 1 && this.isNotClick )
								return ;   
								return "autoComplete/get_license.php?&q=" +encodeURIComponent(this.value);
							});
						}
						make_autocom2("license_name","car");
					</script>
		<tr>
			<td align = "center" class="body_table">
				<b>ชนิดเชื้อเพลิง</b>
			</td>
			<td align = "center" class="body_table">
				
				
				<?php
						
						
						$get_fule = getlist("SELECT * from car_detail where id_car ='".$_POST['car']."'");
						
				?>
				<input type = "text" name = "type_fule" value = "<?php print $get_fule[0]['typefule'];?>" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" readonly>
				
			</td>
		</tr>

		<tr>
			<td align = "center" class="body_table">
				<b>ที่มาของรถ</b>
			</td>
			<td align = "center" class="body_table">
				<select name = "Sourcescar" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" >
				
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
			<td align = "center" class="body_table">
				<b>เที่ยววิ่ง</b>
			</td>
			<td align = "center" style = "width:90mm;height:10mm;empty-cells:show;font-family:angsana new;font-size:25px;">
				<select name = "runperday" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" onchange ="this.form.submit();">
					  
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
			<td align = "center" class="body_table">
				<b>ประเภทที่ส่ง</b>
			</td>
			<td align = "center" class="body_table">
				<select name = "type_customer" class="body_table font-style-20">
				
				<?php
						
						query("USE transport");
						$type_customer_data = array("ปกติ","โครงการ");
						for($i=0;$i<sizeof($type_customer_data);$i++){
							$selected = $type_customer_data[$i] ==$_POST['type_customer'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$type_customer_data[$i]."\"".$selected.">".$type_customer_data[$i]."</option>");
						}
				?>
			</td>
		</tr>


		<tr>
			<td align = "center" class="body_table">
				<b>อัตราเบี้ยเลี้ยง</b>
			</td>
			<td align = "center" class="body_table">
				
				
				<?php
						
						
						$get_allowance = getlist("SELECT * from allowance where typecar ='".$get_fule[0]['typecar']."' and id_ship='".$get_customer[0]['delivery_name']."'");
						if($_POST['runperday']==1){
							$money = $get_allowance[0]['dis_1'];
						}else if($_POST['runperday']==2){
							$money = $get_allowance[0]['dis_'];
						}
						
				?>
				<input type = "text" name = "type_fule" value = "<?php print $money;?>" style = "width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;" readonly>
				
			</td>
		</tr>

		<tr>
			<td align = "center" class="body_table" colspan="2">
				<b>การเติมน้ำมัน (ลิตร)</b>
			</td>
			
		</tr>

<?php
		print("<tr>");
			print("<td align = \"center\" class=\"body_table\">");
				print("<b>มาตราฐาน</b>");
			print("</td>");
			print("<td align = \"center\" class=\"body_table\">");
			$get_standard = getlist("SELECT * FROM fule_detail WHERE car_type='".$get_fule[0]['typecar']."' and id_ship='".$get_customer[0]['delivery_name']."'");
			$_POST['standard'] = $get_standard[0]['standard'];
				print("<input type = \"text\" name = \"standard\" value = \"".$_POST['standard']."\" class=\"body_table\" style = \"text-align: center;font-weight: bold;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\" readonly>");
			print("</td>");
		print("</tr>");
		print("<tr>");
			print("<td align = \"center\" class=\"body_table\">");
				print("<b>เพิ่ม</b>");
			print("</td>");
			print("<td align = \"center\" class=\"body_table\">");
				print("<input type = \"text\" name = \"up\" value = \"".$_POST['up']."\" class=\"body_table\" style = \"text-align: center;font-weight: bold;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\">");
			print("</td>");
		print("</tr>");
		print("<tr>");
			print("<td align = \"center\" class=\"body_table\">");
				print("<b>ลด</b>");
			print("</td>");
			print("<td align = \"center\" class=\"body_table\">");
				print("<input type = \"text\" name = \"down\" value = \"".$_POST['down']."\" class=\"body_table\" style = \"text-align: center;font-weight: bold;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\">");
			print("</td>");
		print("</tr>");
		print("<tr>");
			print("<td align = \"center\" class=\"body_table\">");
				print("<b>สุทธิ</b>");
			print("</td>");
			print("<td align = \"center\" class=\"body_table\">");
			$_POST['final'] = ($_POST['standard']+$_POST['up'])-$_POST['down'];
				print("<input type = \"text\" name = \"final\" value = \"".$_POST['final']."\" class=\"body_table\" style = \"text-align: center;font-weight: bold;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\"  OnKeyPress=\"return chkNumber(this)\">");
			print("</td>");
		print("</tr>");

		$check_double = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='".$_POST['boonpon_id']."'");

		if(!empty($check_double[0]['boonpon_id'])){
			$confirm = "onClick=\"confirm('เลขที่บุญพรนี้มีในระบบอยู่แล้ว หากต้องการบันทึกข้อมูลให้กด YES\nหากไม่ต้องการให้กด NO แล้วทำการเปลี่ยนเลขใบพรใหม่')\"";
		}else{
			$confirm = "";
		}
		

		print("<tr>");
			print("<td colspan = \"2\" align = \"center\" style = \"width:140mm;empty-cells:show;font-family:angsana new;font-size:22px;\">");
				print("<input type = \"submit\" name = \"summit\" value = \"ยืนยัน\" $confirm style = \"width:40mm;empty-cells: show;font-family:angsana new;font-size:25px;text-align: center;\">");
					
			print("</td>");
		print("</tr>");
	?>
	</form>
	</table>
	  <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>