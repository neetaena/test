<?php
	@session_start();
	@ini_set('display_errors', '0');
	include("../../include/mySqlFunc.php");
	query("USE transport");
?>
<!DOCTYPE html>
<html>
<head>
	<title>แก้ไขข้อมูล GAS NGV</title>
	<style type="text/css">
		th,tr,td,input,textarea,select{
			font-family: 'angsana new';
			font-size: 20px;

		}
	</style>

	<script type="text/javascript">
	function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.') && (vchar != '+')) return false;
						ele.onKeyPress=vchar;
						}	
	</script>

</head>
<body>
	<?php
	$boonpon_id =$_GET['boonpon_id'];
	$data_number =$_GET['data_number'];
$check_data = getlist("SELECT * FROM gas_ngv_head as gh inner join gas_ngv_detail as gd on gh.gas_ngv_id=gd.gas_ngv_id WHERE boonpon_id='$boonpon_id' and data_number='$data_number'");
	    if(!empty($_POST['summit']))
	    {
	       
	       	$money_cradit = $_POST['money_cradit'];
	        $kg_cradit = $_POST['kg_cradit'];
	        $money_cash = $_POST['money_cash'];
	        $kg_cash = $_POST['kg_cash'];
	        $note = $_POST['note'];

	        $distanct = $_POST['distanct'];
	        $wood_weight = $_POST['wood_weight'];
	        $pump_gas = $_POST['pump_gas'];
			$pressure_gas = $_POST['pressure_gas'];
			$gas_detail_id = $_POST['gas_detail_id'];
	       
	          if(empty($check_data)){
	          	 $sql = query("INSERT INTO gas_ngv_head SET wood_weight='$wood_weight',distanct_true='$distanct',pump_gas='$pump_gas',pressure_gas='$pressure_gas',boonpon_id='$boonpon_id',data_number='$data_number',note_gas='".$note."'");
	          	 $data_datail = getlist("SELECT max(gas_ngv_id) as gas_ngv_id FROM gas_ngv_head");
	          	 for ($t=0; $t < sizeof($money_cradit); $t++) { 
	          	 	if(!empty($money_cradit[$t]) || !empty($money_cash[$t])){
	          	 		query("INSERT INTO gas_ngv_detail SET money='".$money_cradit[$t]."',gas_weight='".$kg_cradit[$t]."',money_cash='".$money_cash[$t]."',kg_cash='".$kg_cash[$t]."',gas_ngv_id='".$data_datail[0]['gas_ngv_id']."'");
	          	 	}
	          	 }
	          	  $message = "เพิ่มข้อมูลสำเร็จ";
	          }else{
	          	$sql = query("UPDATE gas_ngv_head SET wood_weight='$wood_weight',distanct_true='$distanct',pump_gas='$pump_gas',pressure_gas='$pressure_gas',boonpon_id='$boonpon_id',note_gas='".$note."' where boonpon_id='$boonpon_id' and data_number='$data_number'");
	          	for ($t=0; $t < sizeof($gas_detail_id); $t++) { 
	          	 	query("UPDATE gas_ngv_detail SET money='".$money_cradit[$t]."',gas_weight='".$kg_cradit[$t]."',money_cash='".$money_cash[$t]."',kg_cash='".$kg_cash[$t]."' where gas_detail_id='".$gas_detail_id[$t]."'");
	          	 }
	          	 $message = "แก้ไขข้อมูลสำเร็จ";
	          }
	              
	                if($sql)
	                {
	                	 print "<script type='text/javascript'>alert('$message');</script>";
	                    print "<script>window.opener.location.reload();</script>";
	                    //print "<script>window.close();</script>";

	                }else{
	                    $message = "ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
	                     print "<script type='text/javascript'>alert('$message');</script>";
	                }
	          

	           
	            

	    }
	    $total_data =0;
		$_POST['distanct'] = empty($_POST['distanct']) ? $check_data[0]['distanct_true']:$_POST['distanct'];
		$_POST['wood_weight'] = empty($_POST['wood_weight']) ? $check_data[0]['wood_weight']:$_POST['wood_weight'];
		$_POST['pump_gas'] = empty($_POST['pump_gas']) ? $check_data[0]['pump_gas']:$_POST['pump_gas'];
		$_POST['pressure_gas'] = empty($_POST['pressure_gas']) ? $check_data[0]['pressure_gas']:$_POST['pressure_gas'];
		$_POST['note'] = empty($_POST['note']) ? $check_data[0]['note_gas']:$_POST['note'];
		$_POST['row'] = empty($_POST['row']) ? 5:$_POST['row'];


	   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
	    print("<table style=\"width:90%;\" align=\"center\"  border =\"1\" cellspacing = \"0\" cellpadding = \"2\">");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"6\" style=\"font-size:35px;\">");
	    			print("เพิ่ม / แก้ไข การใช้ Gas NGV<br>");
	    		print("</td>");
	    	print("</tr>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"3\" style=\"font-size:20px;\">");
	    			print("บัตรเครดิต(รวม Vat)");
	    		print("</td>");
	    		print("<td colspan=\"3\" style=\"font-size:20px;\">");
	    			print("เงินสด(รวม Vat) "); 
	    			print("<input name = \"row\" value = \"".$_POST['row']."\" style=\"width:20%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" >");
	    		print("</td>");
	    	print("</tr>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td>");
	    			print("บิลที่");
	    		print("</td>");
	    		print("<td>");
	    			print("บาท");
	    		print("</td>");
	    		print("<td>");
	    			print("กก.");
	    		print("</td>");
	    		print("<td>");
	    			print("บิลที่");
	    		print("</td>");
	    		print("<td>");
	    			print("บาท");
	    		print("</td>");
	    		print("<td>");
	    			print("กก.");
	    		print("</td>");
	    	print("</tr>");
	    	$total_money_data =0;
	    	$total_kg_data =0;
	    	$total_bli =0;

	    	for ($i=0; $i < $_POST['row']; $i++) { 
	    		$_POST['money_cradit'][$i] = empty($_POST['money_cradit'][$i]) ? $check_data[$i]['money']:$_POST['money_cradit'][$i];
	    		$_POST['kg_cradit'][$i] = empty($_POST['kg_cradit'][$i]) ? $check_data[$i]['gas_weight']:$_POST['kg_cradit'][$i];

	    		$_POST['money_cash'][$i] = empty($_POST['money_cash'][$i]) ? $check_data[$i]['money_cash']:$_POST['money_cash'][$i];
	    		$_POST['kg_cash'][$i] = empty($_POST['kg_cash'][$i]) ? $check_data[$i]['kg_cash']:$_POST['kg_cash'][$i];

	    		print("<tr style=\"text-align:center;\">");
	    			  print("<td style=\"width:10%;\">");
	    			  	print($i+1);
		         	  print("</td>");
		              print("<td>");
		         		print("<input name = \"money_cradit[]\" value = \"".$_POST['money_cradit'][$i]."\" style=\"width:99%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" onchange = \"this.form.submit();\">");
		         		print("<input type = \"hidden\" name = \"gas_detail_id[]\" value='".$check_data[$i]['gas_detail_id']."'  required>");
		            print("</td>");
		              print("<td>");
		         		print("<input name = \"kg_cradit[]\" value = \"".$_POST['kg_cradit'][$i]."\" style=\"width:99%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" onchange = \"this.form.submit();\">");
		            print("</td>");
		              print("<td style=\"width:10%;\">");
		         		print($i+1);
		            print("</td>");
		              print("<td>");
		         		print("<input name = \"money_cash[]\" value = \"".$_POST['money_cash'][$i]."\" style=\"width:99%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" onchange = \"this.form.submit();\">");
		            print("</td>");
		              print("<td>");
		         		print("<input name = \"kg_cash[]\" value = \"".$_POST['kg_cash'][$i]."\" style=\"width:99%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" onchange = \"this.form.submit();\">");
		            print("</td>");
	    		print("</tr>");
	    	}
	    	print("<tr style=\"text-align:center;\" >");
	    	for ($p=0; $p < sizeof($_POST['money_cradit']); $p++) { 
	    		if(!empty($_POST['money_cradit'][$p])){
	    			$total_money_data += $_POST['money_cradit'][$p];
	    			$total_kg_data += $_POST['kg_cradit'][$p];
	    			$total_bl +=1;
	    		}
	    	}

	    	for ($p=0; $p < sizeof($_POST['money_cash']); $p++) { 
	    		if(!empty($_POST['money_cash'][$p])){
	    			$total_money_data += $_POST['money_cash'][$p];
	    			$total_kg_data += $_POST['kg_cash'][$p];
	    			$total_bl +=1;
	    		}
	    	}
	    		print("<td colspan=\"2\">");
		        	print("รวมบิล : ".$total_bl);
		        print("</td>");
		        print("<td colspan=\"2\">");
		        	print("รวมเงิน : ".$total_money_data);
		        print("</td>");
		        print("<td colspan=\"2\">");
		        	print("รวมน้ำหนักแก๊ส : ".$total_kg_data);
		        print("</td>");
	    	print("</tr>"); 
	    	 print("<tr style=\"text-align:center;\" >");
		        print("<td >");
		            print("หมายเหตุ");
		        print("</td>");
		        print("<td colspan=\"5\">");
		    			print("<textarea name = \"note\" value = \"\" style=\"width:99%;resize: none !important;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
								print($_POST['note']);
						print("</textarea>");
				print("</td>");
		    print("</tr>"); 
	  		

	     print("<table style=\"width:90%;\" align=\"center\" border='0'>");
	     	print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("ระยะทางวิ่งจริง");
		            print("</td>");
		            print("<td >");
		         		print("<input name = \"distanct\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['distanct']."\" style=\"width:100%;\">");
		        print("</td>");

		          print("<td>");
		            print("น้ำหนักบรรทุก");
		            print("</td>");
		            print("<td >");
		         		print("<input name = \"wood_weight\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['wood_weight']."\" style=\"width:80%;\" > ตัน");
		        print("</td>");
		     print("</tr>");     
		    print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("ปั้มแก๊สที่เติมก่อนเข้าโรงงาน");
		            print("</td>");
		            print("<td >");
		         		//print("<input name = \"pump_gas\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['pump_gas']."\" style=\"width:80%;\" > กม.");

		         		print("<select name = \"pump_gas\" style = \"width:80%;\" class=\"text_fide\">");
						print("<option value = '' ></option>");
						
								$get_side = array("A"=>"A","B"=>"B");
								while (list($key, $value) = each($get_side)) {
									$selected=$_POST['report']==$key ? "selected=\"selected\"" : "";
						       		print("<option value='$key' ".$selected.">$value</option>");
								}
						
					print("</select>");

		        print("</td>");
		        print("<td>");
		            print("แรงดันแก๊สหลังวิ่งเข้าโรงงาน");
		            print("</td>");
		            print("<td >");
		         		print("<input name = \"pressure_gas\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['pressure_gas']."\" style=\"width:80%;\"> บาร์");
		        print("</td>");
		    print("</tr>");     

		    print("<tr style=\"text-align:center;\">");
	    		print("<td style=\"text-align:center;\" colspan=\"6\">");

	    			print("<br><input type=\"submit\" name=\"summit\" value=\"ตกลง\" style=\"width:50%;cursor:pointer\">");
	    			print("</td>");
	    	print("</tr>");

	     print("</table>");


	    print("</form>");


	?>

</body>
</html>