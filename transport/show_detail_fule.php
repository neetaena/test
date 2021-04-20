<?php
	@session_start();
	@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");
?>
<!DOCTYPE html>
<html>
<head>
	<title>เพิ่มขนาด</title>
	<style type="text/css">
		th,tr,td,input,textarea,select{
			font-family: 'angsana new';
			font-size: 25px;

		}

		.wheight-px{
			width: 60px;
			text-align: center;
		}
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
	<script type="text/javascript">
	function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.')&& (vchar != '-')&& (vchar != '+')) return false;
						ele.onKeyPress=vchar;
						}	
</script>
</head>
<body>
	<?php

function selectNum($str)
{
$b="0123456789";

$n=strlen($str);
$x=strlen($b);
$newstr="";
for($i=0;$i<=$n;$i++)
{
	for($j=0;$j<=$x;$j++)
	{
		if($str[$i]==$b[$j])
		{
			$newstr.=$b[$j];
		}
	}
}
return $newstr;
}

	$id_ship = $_GET['id_ship'];
	$boonpon_id =$_GET['boonpon_id'];
if(!empty($_POST['summit1']) || !empty($_POST['summit_print'])){

		$up = $_POST['up'];
		$fill_oil = $_POST['fill_oil'];
		$final = $_POST['final'];
		$check_data = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id = '".$boonpon_id."'");
		$get_type_car = getlist("SELECT * FROM car_detail WHERE id_car='".$_POST['car']."'");
		if(!empty($check_data)){
			$a = query("UPDATE insertdata_transport SET up='$up',fill_oil='$fill_oil',final='$final' WHERE boonpon_id = '".$boonpon_id."'");


		}else{
			$a = query("INSERT into insertdata_transport SET up='$up',fill_oil='$fill_oil',final='$final',boonpon_id = '".$boonpon_id."'");

		}

		if(!empty($_POST['summit_print'])){
		  echo "<script type='text/javascript'>window.location.href = \"print_ream_oil.php?boonpon_id=".$boonpon_id."&id_ship=".$id_ship."\";</script>";
		}else{
			print "<script>window.opener.location.reload();</script>";
			print "<script>window.close();</script>";
		}

}

$get_shiiping = getlist("SELECT * FROM shipping WHERE id_ship='$id_ship'");
$get_data_transport = getlist("SELECT * FROM insertdata_transport WHERE boonpon_id='$boonpon_id'");
$get_standard = getlist("SELECT * FROM fule_detail as f inner join car_head as c on f.car_type=c.id_hcar WHERE car_type='".$get_data_transport[0]['typecar']."' and id_ship='$id_ship'");
	   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
	    print("<table  align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"9\" style=\"font-size:25px;\">");
	    			print("<b>รายละเอียดการใช้งานเชื้อเพลิง(ดีเซล)</b><br>");
	    			print("สถานที่จัดส่ง <b>".$get_shiiping[0]['detailship']."</b> ประเภทรถ <b>".$get_standard[0]['detailhcar']."</b>");
	    		print("</td>");
	    	print("</tr>");

	    	print("<tr>");
			print("<td align = \"center\" class=\"input_body font-style-25\">");
				print("<b>มาตราฐาน</b>");
			print("</td>");
			print("<td align = \"center\" class=\"input_body\">");
			
			$_POST['standard'] = empty($_POST['standard']) ? $get_standard[0]['standard'] : $_POST['standard'];
				print("<input type = \"text\" name = \"standard\" value = \"".$_POST['standard']."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\" readonly>");
			print("</td>");
		print("</tr>");
		print("<tr>");
			print("<td align = \"center\" class=\"input_body font-style-25\">");
				print("<b>น้ำมันที่ควรเติมเพิ่ม</b>");
			print("</td>");
			print("<td align = \"center\" class=\"input_body\">");
			$_POST['up'] = empty($_POST['up']) ? $get_data_transport[0]['up'] : $_POST['up'];
				print("<input type = \"text\" name = \"up\" value = \"".$_POST['up']."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\" >");
			print("</td>");
		print("</tr>");
		print("<tr>");
			print("<td align = \"center\" class=\"input_body font-style-25\">");
				print("<b>คนขับเติมมา</b>");
			print("</td>");
			print("<td align = \"center\" class=\"input_body\">");
			$_POST['down'] = empty($_POST['fill_oil']) ? $get_data_transport[0]['fill_oil'] : $_POST['fill_oil'];
				print("<input type = \"text\" name = \"fill_oil\" value = \"".$_POST['fill_oil']."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" OnKeyPress=\"return chkNumber(this)\"  placeholder=\"เช่น +7 , -7\">");
			print("</td>");

			$up_down = $_POST['up'];
			$plus = strpos($up_down,"+");
			$minus = strpos($up_down,"-");

			$a=$_POST['up']; //ข้อความที่จะเอามาทำ
			$b="0123456789";
						$n=strlen($a);
						$x=strlen($b);
						$newstr="";
						for($i=0;$i<=$n;$i++)
						{
							for($j=0;$j<=$x;$j++)
							{
								if($a[$i]==$b[$j])
								{
									$newstr.=$b[$j];
								}
							}
						}

			if($minus !== FALSE){
				
						$_POST['final'] = $_POST['standard']-($_POST['fill_oil']+$newstr);
			}else{
					$_POST['final'] = $_POST['standard']+($newstr-$_POST['fill_oil']);
			}
						

			
						
						
				

		print("</tr>");
		print("<tr>");
			print("<td align = \"center\" class=\"input_body font-style-25\">");
				print("<b>สุทธิ</b>");
			print("</td>");
			print("<td align = \"center\" class=\"input_body\">");
			//$_POST['final'] = $_POST['standard']+($_POST['up']-$_POST['fill_oil']);
				print("<input type = \"text\" name = \"final\" value = \"".$_POST['final']."\" class=\"input_body font-style-25\" style = \"text-align: center;font-weight: bold;\"  onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\"  OnKeyPress=\"return chkNumber(this)\">");
			print("</td>");
		print("</tr>");


		print("<tr>");
			print("<td  colspan='2' align = \"center\" style = \"width:140mm;empty-cells: show;font-family:angsana new;font-size:22px;\">");
				print("<input type = \"submit\" name = \"summit1\" value = \"บันทึก\" style =\"width:40mm;empty-cells: show;font-family:angsana new;font-size:25px;cursor:pointer\">");
				print("<input type = \"submit\" name = \"summit_print\" value = \"บันทึกและปริ้น\" style =\"width:40mm;empty-cells: show;font-family:angsana new;font-size:25px;cursor:pointer\">");
			print("</td>");
		print("</tr>");
	

	    print("</table>");

	
    


	?>

</body>
</html>