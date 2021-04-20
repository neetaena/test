<link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />

    <!-- Page-Level CSS -->
	<script type="text/javascript" src="datetimepicker/jquery.js"></script>

<link rel="stylesheet" href="css/jquery-ui.css">
  	<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>

<script type="text/javascript">
				function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
						ele.onKeyPress=vchar;
						}	

                 $(function() {
                        $( ".serach_vngb" ).autocomplete({
                            source: 'autoComplete/gdata_vngb.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
                            minLength: 1,
                            
                        });
                    });

                 $(function() {
                        $( ".serach_driver" ).autocomplete({
                            source: 'autoComplete/get_driver_check.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
                            minLength: 1,
                            
                        });
                    });

                 $(function() {
                        $( ".serach_license" ).autocomplete({
                            source: 'autoComplete/get_license_check.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
                            minLength: 1,
                            
                        });
                    });

</script>
	<style type="text/css">
		.input_body{
			width:90mm;
			height:10mm;
			empty-cells: show;
			font-family:angsana new;
			
		}
		.font-style-20{
			font-size:20px;
		}
		.font-style-25{
			font-size:25px;
		}

	</style>
<?php
	@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");
	$getdate = $_GET['datedata'];
	$ty_user = $_GET['type_user'];
	$warehouse_id = $_GET['warehouse_id'];
	$boonpon_id = $_GET['boonpon_id'];
	$idcar= $_GET['idcar'];
	
	if(!empty($_POST['summit'])){

		$up = $_POST['up'];
		$down = $_POST['down'];
		$final = $_POST['final'];
		$type_customer = $_POST['type_customer'];
		$vngb_id = $_POST['vngb_id'];
		$check_data = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id = '$boonpon_id'");
		$get_type_car = getlist("SELECT * FROM car_detail WHERE id_car='".$_POST['car']."'");
		if(!empty($check_data)){
			$a = query("UPDATE insertdata_transport SET nameDriver = '".$_POST['namedriver']."'
						,typecar = '".$get_type_car[0]['typecar']."'
						,idcar = '".$_POST['car']."'
						,runperday = '".$_POST['runperday']."',up='$up',down='$down',final='$final',type_customer='$type_customer',boonpon_id='".$_POST['boonpon_id']."',up_down_rate='$vngb_id' WHERE id_transport = '".$check_data[0]['id_transport']."'");

		}else{
			$a = query("INSERT into insertdata_transport SET nameDriver = '".$_POST['namedriver']."'
						,typecar = '".$get_type_car[0]['typecar']."'
						,idcar = '".$_POST['car']."'
						,runperday = '".$_POST['runperday']."',up='$up',down='$down',final='$final',type_customer='$type_customer',boonpon_id='".$_POST['boonpon_id']."',up_down_rate='$vngb_id'");
		}
		
	
		if($a){
			
			query("UPDATE production_order SET boonpon_id='".$_POST['boonpon_id']."' WHERE warehouse_id='".$warehouse_id."' and delivery_date='$getdate'");
			print "<script>window.opener.location.reload();</script>";
			print "<script>window.close();</script>";
		}else{
			print "<b style='color:red'>ลงข้อมูลไม่ถูกต้อง</b>";
		}
	}
?>
<table bgcolor = "#aaaaaa" border = "1" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:180mm;height:10mm;empty-cells: show;background-color: #aaa;margin-top: 6px;">
	<form action = "" name = "insertquarity" method = "POST">
		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>เลขที่ใบสั่งขาย</b>
			</td>
			<td align = "center" class="input_body">
			<?php
			$juarnal = getlist("SELECT * FROM production_order where data_number ='".$_GET['id']."' and delivery_date='$getdate'");
				//$getinvoice = getlist("SELECT * FROM insertdatawarehouse where IDwarehouse = '".$_GET['id']."' and status = '1'");
			?>
				<input type = "text" name = "invoicedsales" value = "<?php print $juarnal[0]['number'];?>" class="input_body font-style-20" readonly>
				
			</td>
		</tr>
		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>ชื่อลูกค้า</b>

			</td>
			<td align = "center">
				<?php
					$get_customer = getlist("SELECT * FROM production_order as po inner join customer as c on po.name=c.id_customer WHERE data_number='".$_GET['id']."' and delivery_date='$getdate'");
				?>
				<input type = "text" name = "invoicedsales" value = "<?php print $get_customer[0]['namecustomer'];?>"  class="input_body font-style-20" readonly>
				
			</td>
		</tr>
		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>รถบ้านบึงมาจากลูกค้า</b>
			</td>
			<td align = "center" class="input_data2">
				
				<?php
					
						print("<input type = \"text\" name = \"sub_vngb_name\" id=\"sub_vngb_name\" value = \"".$_POST['sub_vngb_name']."\" style = \"width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" class='serach_vngb'>");

						$get_suplier = getlist("SELECT * FROM supplier_vngb WHERE supplier_name='".$_POST['sub_vngb_name']."' limit 1");
						print("<input type = \"hidden\" name = \"Sendlocation\"  id = \"Sendlocation\" value = \"".$get_suplier[0]['vngb_id']."\">");

				?>
				<!--<input type = "hidden" name = "vngb_id"  id = "vngb_id" value = "<?php print $_POST['vngb_id'];?>" required>-->
				<script type="text/javascript">
					/*	function make_autocom2(autoObj,showObj){
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
								return "autoComplete/get_vngb_sub.php?&q=" +encodeURIComponent(this.value);
							});
						}
						make_autocom2("sub_vngb_name","vngb_id");*/
					</script>
			</td>
		</tr>
			<tr>
			<td align = "center" class="input_body font-style-25">
				<b>เลขที่ใบขนส่งบุญพร</b>
			</td>
			<td align = "center" class="body_table">
			<?php
		
				
						
				$_POST['boonpon_id'] = empty($_POST['boonpon_id']) ? $juarnal[0]['boonpon_id'] : $_POST['boonpon_id'];
				print("<input type = \"text\" name = \"boonpon_id\" value = \"".$_POST['boonpon_id']."\" class=\"input_body font-style-20\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
			?>
			</td>
		</tr>
		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>ชื่อคนขับรถ</b>
			</td>
			<td align = "center" class="input_body">
				<?php




				$driver = getlist("SELECT * FROM insertdata_transport where boonpon_id ='".$juarnal[0]['boonpon_id']."'");
				$_POST['namedriver'] = empty($_POST['namedriver']) ? $driver[0]['nameDriver']:$_POST['namedriver'];

				$data = getlist("SELECT * from driver where id_driver='".$_POST['namedriver']."'");	

					

						$_POST['place_id'] = empty($_POST['place_id']) ? $data[0]['namedriver1'] : $_POST['place_id'];
						print("<input type = \"text\" name = \"place_id\" id=\"place_id\" value = \"".$_POST['place_id']."\" style = \"width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" class=' serach_driver' onchange = \"this.form.submit();\">");

						$get_driver = getlist("SELECT * FROM driver WHERE namedriver1='".$_POST['place_id']."' limit 1");
						print("<input type = \"hidden\" name = \"namedriver\"  id = \"namedriver\" value = \"".$get_driver[0]['id_driver']."\">");

				?>
				<!--<input type = "hidden" name = "namedriver"  id = "namedriver" value = "<?php print $_POST['namedriver'];?>" required>-->
			</td>
		</tr>
					<script type="text/javascript">
						/*function make_autocom2(autoObj,showObj){
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
						make_autocom2("place_id","namedriver");*/
					</script>
		
		<!--<tr>
			<td align = "center" class="input_body font-style-25">
				<b>ประเภทรถ</b>
			</td>
			<td align = "center" class="input_body">
				<select name = "typecar" class="input_body font-style-20" onchange="this.form.submit();">
				<option value = ''>เลือกประเภทรถ</option>
				<?php
				$_POST['typecar'] = empty($_POST['typecar']) ? $driver[0]['typecar']:$_POST['typecar'];
					if($ty_user==2)
						{
							$gettypecar = getlist("SELECT * from car_head  WHere type_user='2'");
						}else{
							$gettypecar = getlist("SELECT * from car_head  WHere type_user='1'");
						}
					for($i=0;$i<sizeof($gettypecar);$i++){
						$selected = $gettypecar[$i]['id_hcar']==$_POST['typecar'] ? "selected=\"selected\"" : "";
						print("<option value = \"".$gettypecar[$i]['id_hcar']."\"".$selected.">".$gettypecar[$i]['detailhcar']."</option>");
					}
				?>
				
			</td>
		</tr>-->

		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>ทะเบียนรถ</b>
			</td>
			<td align = "center" class="input_body">
			
				<?php
						
						$_POST['car'] = empty($_POST['car']) ? $driver[0]['idcar']:$_POST['car'];
						$data_search = getlist("SELECT * from car_detail where id_car='".$_POST['car']."'");

						

				$_POST['license_name'] = empty($_POST['license_name']) ? $data_search[0]['licenceplates']."  ".$data_search[0]['licenceplate2'] : $_POST['license_name'];
					
				print("<input type = \"text\" name = \"license_name\" id=\"license_name\" value = \"".trim($_POST['license_name'])."\" style = \"width:90mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:20px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" class='serach_license'>");

					$get_license = getlist("SELECT * FROM car_detail WHERE licenceplates='".$_POST['license_name']."' limit 1");
						print("<input type = \"hidden\" name = \"car\"  id = \"car\" value = \"".$get_license[0]['id_car']."\">");
				?>
				<!--<input type = "hidden" name = "car"  id = "car" value = "<?php print $_POST['car'];?>" required>-->
			</td>
		</tr>
					<script type="text/javascript">
						/*function make_autocom2(autoObj,showObj){
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
						make_autocom2("license_name","car");*/
					</script>
		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>ชนิดเชื้อเพลิง</b>
			</td>
			<td align = "center" class="input_body">
				
				
				<?php
						
						
						$get_fule = getlist("SELECT * from car_detail where id_car ='".$_POST['car']."'");
						
				?>
				<input type = "text" name = "type_fule" value = "<?php print $get_fule[0]['typefule'];?>" class="input_body font-style-20" readonly>
				
			</td>
		</tr>
	
		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>ที่มาของรถ</b>
			</td>
			<td align = "center" class="input_body">
				<select name = "Sourcescar" class="input_body font-style-20">
				
				<?php
						
						query("USE transport");
						$data = getlist("select * from placecar where IDPLACE = '1' and status = '1' ");
						for($i=0;$i<sizeof($data);$i++){
							$selected = $data[$i]['IDPLACE']==$_POST['Sourcescar'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$data[$i]['IDPLACE']."\"".$selected.">".$data[$i]['Nameplace']."</option>");
						}
				?>
			</td>
		</tr>
		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>เที่ยววิ่ง</b>
			</td>
			<td align = "center" class="input_body">
				<select name = "runperday" class="input_body font-style-20" >
					<?php   
					$_POST['runperday'] = empty($_POST['runperday']) ? $driver[0]['runperday'] : $_POST['runperday'];
							$run	= array("1","2");
							for($i=0;$i<sizeof($run);$i++){
							$selected = $run[$i]==$_POST['runperday'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$run[$i]."\"".$selected.">".$run[$i]."</option>");
						}
					?>
				</select>
			</td>
		</tr>

		<tr>
			<td align = "center" class="input_body font-style-25">
				<b>ประเภทที่ส่ง</b>
			</td>
			<td align = "center" class="input_body">
				<select name = "type_customer" class="input_body font-style-20">
				
				<?php
						
						query("USE transport");

						$_POST['type_customer'] = empty($_POST['type_customer']) ? $driver[0]['type_customer'] : $_POST['type_customer'];
						$type_customer_data = array("ปกติ","โครงการ");
						for($i=0;$i<sizeof($type_customer_data);$i++){
							$selected = $type_customer_data[$i] ==$_POST['type_customer'] ? "selected=\"selected\"" : "";
							print("<option value = \"".$type_customer_data[$i]."\"".$selected.">".$type_customer_data[$i]."</option>");
						}
				?>
			</td>
		</tr>


			<tr>
			<td align = "center" class="input_body font-style-25">
				<b>อัตราเบี้ยเลี้ยง</b>
			</td>
			<td align = "center" class="input_body font-style-20">
				
				
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
			<td align = "center" class="input_body font-style-25" colspan="2">
				<b>การเติมน้ำมัน (ลิตร)</b>
			</td>
			
		</tr>

<?php
		print("<tr>");
			print("<td align = \"center\" class=\"input_body font-style-25\">");
				print("<b>มาตราฐาน</b>");

			print("</td>");
			print("<td align = \"center\" class=\"input_body\">");
			$get_full = getlist("SELECT * FROM supplier_vngb WHERE vngb_id='".$get_suplier[0]['vngb_id']."'");
			$get_standard = getlist("SELECT * FROM fule_detail WHERE car_type='".$get_fule[0]['typecar']."' and id_ship='".$get_customer[0]['delivery_name']."'");
			$_POST['standard'] = empty($_POST['standard']) ? $get_standard[0]['standard'] : $_POST['standard'];
				print("<input type = \"text\" name = \"standard\" value = \"".$_POST['standard']."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\" readonly>");
			print("</td>");
		print("</tr>");
			print("<tr>");
			print("<td align = \"center\" class=\"body_table\">");
				print("<b>เพิ่ม / ลด</b>");
			print("</td>");
			print("<td align = \"center\" class=\"body_table\">");
			$up_down = $get_full[0]['averang'];
			$plus = strpos($up_down,"+");
			$minus = strpos($up_down,"-");
				if($plus !== FALSE)
					{
						$plus_minus = explode("+", $up_down);
						$_POST['final'] = $_POST['standard']+$plus_minus[1];
					}
				if($minus !== FALSE)
					{
						$plus_minus = explode("-", $up_down);
						$_POST['final'] = $_POST['standard']-$plus_minus[1];
					}
			
				print("<input type = \"text\" name = \"up\" value = \"".$up_down."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\" readonly>");
			print("</td>");
		print("</tr>");
		/*print("<tr>");
			print("<td align = \"center\" class=\"input_body font-style-25\">");
				print("<b>เพิ่ม</b>");
			print("</td>");
			print("<td align = \"center\" class=\"input_body\">");
			$_POST['up'] = empty($_POST['up']) ? $driver[0]['up'] : $_POST['up'];
				print("<input type = \"text\" name = \"up\" value = \"".$_POST['up']."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\">");
			print("</td>");
		print("</tr>");
		print("<tr>");
			print("<td align = \"center\" class=\"input_body font-style-25\">");
				print("<b>ลด</b>");
			print("</td>");
			print("<td align = \"center\" class=\"input_body\">");
			$_POST['down'] = empty($_POST['down']) ? $driver[0]['down'] : $_POST['down'];
				print("<input type = \"text\" name = \"down\" value = \"".$_POST['down']."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\">");
			print("</td>");
		print("</tr>");*/
		print("<tr>");
			print("<td align = \"center\" class=\"input_body font-style-25\">");
				print("<b>สุทธิ</b>");
			print("</td>");
			print("<td align = \"center\" class=\"input_body\">");
		//	$_POST['final'] = ($_POST['standard']+$_POST['up'])-$_POST['down'];
				print("<input type = \"text\" name = \"final\" value = \"".$_POST['final']."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\"  OnKeyPress=\"return chkNumber(this)\">");
			print("</td>");
		print("</tr>");
?>
			
		<tr>
			<td colspan = "2" align = "center" style = "width:140mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<input type = "submit" name = "summit" value = "ยืนยันการแก้ไข" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:25px;">
					
			</td>
		</tr>
	
	</form>
	</table>