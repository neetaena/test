<?php
@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");

	query("USE transport");
	if(!empty($_POST['summit'])){
		$getALL = getlist("SELECT * FROM allowance WHERE placestart = '1' AND p_end = '".$_POST['Sendlocation']."' AND typecar = '".$_POST['typecar']."'");
		if(empty($getALL)){
			$a = query("INSERT INTO allowance SET placestart = '1'
					,p_end = '".$_POST['Sendlocation']."'
					,typecar = '".$_POST['typecar']."'
					,dis_1= '".$_POST['distance']."'
					,dis_2 = '".$_POST ['distance2']."'") ;
			if($a){
				$message =  "เรียบร้อย";
			}else{
				$message =  "ไม่สามารถเพิ่มข้อมูลได้";
			}
		}else{
			$message =  "ไม่สามารถเพิ่มข้อมูลได้";
		}
		print "<script type='text/javascript'>alert('$message');</script>";
	}
?>
<script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>

<center><font color="#000000" face="angsana new"><h1><b>ลงข้อมูลค่าเบี้ยเลี้ยง</b></h1></center></font>
<form action = "" name = "insertplace" method = "POST">
	<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;empty-cells: show;">
				<tr>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<b> สถานที่จัดส่ง</b>
			</td>
			<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
				<input type = "text" name = "place_id"  id = "place_id" value = "<?php print $_POST['place_id'];?>"  style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;" onchange = "this.form.submit();">
				<input type = "hidden" name = "Sendlocation"  id = "Sendlocation" value = "<?php print $_POST['Sendlocation'];?>">
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
								return "autoComplete/gdata2.php?&q=" +encodeURIComponent(this.value);
							});
						}
						make_autocom2("place_id","Sendlocation");
					</script>
		<tr>
			<td align = "center" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<b>ประเภทรถ</b>
			</td>
			<td align = "center" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;">
				<select name = "typecar" style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;"">
				<option value = ''>เลือกประเภทรถ</option>
				<?php
					$gettypecar = getlist("select * from car_head where type_user=1");
					for($i=0;$i<sizeof($gettypecar);$i++){
						$selected = $gettypecar[$i]['id_hcar']==$_POST['typecar'] ? "selected=\"selected\"" : "";
						print("<option value = \"".$gettypecar[$i]['id_hcar']."\"".$selected.">".$gettypecar[$i]['detailhcar']."</option>");
					}
				?>
				
			</td>
		</tr>
		<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>ค่าเบี้ยเลี้ยงเที่ยววิ่ง1</b>
			</td>
			<td>
				<input type="text" name="distance" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
		<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">			  
				<b>ค่าเบี้ยเลี้ยงเที่ยววิ่ง2</b>
			</td>
			<td>
				<input type="text" name="distance2" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:22px;">
			</td>
		</tr>
		<tr>
		<td colspan = "2" align = "center" style = "width:200mm;empty-cells: show;font-family:angsana new;font-size:24px;"><br>
				<input type="submit" name="summit" value ="ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:20px;">
		     </td>
	    </tr>
</form>