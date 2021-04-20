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
	<link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="datetimepicker/jquery.js"></script>
	<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
	
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
$check_data = getlist("SELECT * FROM gas_ngv WHERE boonpon_id='$boonpon_id' and data_number='$data_number'");
	    if(!empty($_POST['summit']))
	    {
	       
	       $cradit = $_POST['cradit'];
	        $total_cradit = $_POST['total_cradit'];
	        $money = $_POST['money'];
	        $total_money = $_POST['total_money'];
	        $total_data = $_POST['total_data'];
	        $detail_weight= $_POST['detail_weight'];
	        $note = $_POST['note'];

	        $gas_weight = $_POST['gas_weight'];
			$wood_weight = $_POST['wood_weight'];
			$distanct = $_POST['distanct'];
			$pressure_gas = $_POST['pressure_gas'];
			$pump_gas = $_POST['pump_gas'];
	       	$pump_gas_other = $_POST['pump_gas_other'];

	       	$date_check = $_POST['date_check'];
	       	$time_check = $_POST['time_check'];

	       	$motor_way = $_POST['motor_way'];
	       	$repair = $_POST['repair'];



	       		if(!empty($pump_gas_other)){
	       			$gas_new = $pump_gas.",".$pump_gas_other;
	       		}else{
	       			$gas_new = $pump_gas;
	       		}
	          if(empty($check_data)){
	          	 $sql = query("INSERT INTO gas_ngv SET detail_credit='$cradit',credit='$total_cradit',detail_cash='$money',cash='$total_money',num_of_paper='$total_data',note='$note',boonpon_id='$boonpon_id',data_number='$data_number',gas_weight='$gas_weight',wood_weight='$wood_weight',distanct='$distanct',pressure_gas='$pressure_gas',pump_gas='$gas_new',detail_weight='$detail_weight',time_check='$time_check',date_check='$date_check',motor_way='$motor_way',repair='$repair'");
	          	  $message = "เพิ่มข้อมูลสำเร็จ";
	          }else{
	          	$sql = query("UPDATE gas_ngv SET detail_credit='$cradit',credit='$total_cradit',detail_cash='$money',cash='$total_money',num_of_paper='$total_data',note='$note',gas_weight='$gas_weight',wood_weight='$wood_weight',distanct='$distanct',pressure_gas='$pressure_gas',pump_gas='$gas_new',detail_weight='$detail_weight',time_check='$time_check',date_check='$date_check',motor_way='$motor_way',repair='$repair' where boonpon_id='$boonpon_id' and data_number='$data_number'");
	          	 $message = "แก้ไขข้อมูลสำเร็จ";
	          }
	              
	                if($sql)
	                {
	                	 print "<script type='text/javascript'>alert('$message');</script>";
	                    print "<script>window.opener.location.reload();</script>";
	                    print "<script>window.close();</script>";

	                }else{
	                    $message = "ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
	                     print "<script type='text/javascript'>alert('$message');</script>";
	                }
	          
	    }
	    $total_data =0;
		$_POST['cradit'] = empty($_POST['cradit']) ? $check_data[0]['detail_credit']:$_POST['cradit'];
		$_POST['money'] = empty($_POST['money']) ? $check_data[0]['detail_cash']:$_POST['money'];
		$_POST['note'] = empty($_POST['note']) ? $check_data[0]['note']:$_POST['note'];
		$_POST['gas_weight'] = empty($_POST['gas_weight']) ? $check_data[0]['gas_weight']:$_POST['gas_weight'];
		$_POST['wood_weight'] = empty($_POST['wood_weight']) ? $check_data[0]['wood_weight']:$_POST['wood_weight'];
		$_POST['distanct'] = empty($_POST['distanct']) ? $check_data[0]['distanct']:$_POST['distanct'];

		$_POST['pressure_gas'] = empty($_POST['pressure_gas']) ? $check_data[0]['pressure_gas']:$_POST['pressure_gas'];
		
		$_POST['detail_weight'] = empty($_POST['detail_weight']) ? $check_data[0]['detail_weight']:$_POST['detail_weight'];
		$_POST['weeight_gas'] = empty($_POST['weeight_gas']) ? $check_data[0]['weeight_gas']:$_POST['weeight_gas'];

		$_POST['motor_way'] = empty($_POST['motor_way']) ? $check_data[0]['motor_way']:$_POST['motor_way'];
		$_POST['repair'] = empty($_POST['repair']) ? $check_data[0]['repair']:$_POST['repair'];

		$pump = explode(",",  $check_data[0]['pump_gas']);

		$_POST['pump_gas'] = empty($_POST['pump_gas']) ? $pump[0]:$_POST['pump_gas'];
		$_POST['pump_gas_other'] = empty($_POST['pump_gas_other']) ? $pump[1]:$_POST['pump_gas_other'];

	   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
	    print("<table style=\"width:80%;\" align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"2\" style=\"font-size:35px;\">");
	    			print("เพิ่ม / แก้ไขค่าใช้จ่าย Gas NGV<br>");
	    		print("</td>");
	    	print("</tr>");
	  		print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("บัตรเครดิต");
		            print("</td>");
		            print("<td>");
		         		print("<input name = \"cradit\" value = \"".$_POST['cradit']."\" style=\"width:230px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" >");
		         		$new_cradit = explode("+", $_POST['cradit']);
		         		for ($i=0; $i < sizeof($new_cradit); $i++) { 
		         			$total_cradit +=$new_cradit[$i];
		         			if(!empty($new_cradit[$i])){
		         				$total_data +=1;
		         			}
		         			
		         		}

		         		print("<input name = \"total_cradit\" value = \"".$total_cradit."\" style=\"width:130px;\" readonly>");
		            print("</td>");
		    print("</tr>");
		  

      		print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("เงินสด");
		            print("</td>");
		            print("<td>");
		         		print("<input name = \"money\" value = \"".$_POST['money']."\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" style=\"width:230px;\" OnKeyPress=\"return chkNumber(this)\">");

		         		$newl_monay = explode("+", $_POST['money']);
		         		for ($i=0; $i < sizeof($newl_monay); $i++) { 
		         			$total_money = $total_money + $newl_monay[$i];
		         			if(!empty($newl_monay[$i]))
		         			{
		         				$total_data +=1;
		         			}
		         		}

		         		print("<input name = \"total_money\" value = \"".$total_money."\" style=\"width:130px;\" readonly>");
		            print("</td>");
		    print("</tr>"); 
		      print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("น้ำหนัก Gas ทั้งหมด");
		            print("</td>");
		            print("<td>");
		         		print("<input name = \"detail_weight\" value = \"".$_POST['detail_weight']."\" style=\"width:230px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" >");
		         		$new_weeight = explode("+", $_POST['detail_weight']);
		         		for ($i=0; $i < sizeof($new_weeight); $i++) { 
		         			$total_gas +=$new_weeight[$i];
		         		        			
		         		}

		         		print("<input name = \"gas_weight\" value = \"".$total_gas."\" style=\"width:130px;\" readonly>");
		            print("</td>");
		    print("</tr>");

		    print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("จำนวนบิลค่า Gas");
		            print("</td>");
		            print("<td >");
		         		print("<input name = \"total_data\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$total_data."\" style=\"width:360px;\">");
		            print("</td>");
		    print("</tr>");        

		    print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("หมายเหตุ");
		        print("</td>");
		        print("<td>");
		    			print("<textarea name = \"note\" value = \"\" style=\"width:360px;resize: none !important;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
								print($_POST['note']);
						print("</textarea>");
				print("</td>");
		    print("</tr>");     
	        
	    	

	    print("</table>");


	     //----------------------------

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
		         	print("<select name = \"pump_gas\" style = \"width:80%;\" class=\"text_fide\" onchange='this.form.submit();'>");
						print("<option value = '' ></option>");
						
						$get_pum = getlist("SELECT * FROM pum_gas ");
							for ($i=0; $i < sizeof($get_pum); $i++) { 
									$selected=$_POST['pump_gas']==$get_pum[$i]['pum_name'] ? "selected=\"selected\"" : "";
						       		print("<option value='".$get_pum[$i]['pum_name']."' ".$selected.">".$get_pum[$i]['pum_name']."</option>");
								}
						
					print("</select>");
					if($_POST['pump_gas']=='อื่นๆ'){
						print("<input name = \"pump_gas_other\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['pump_gas_other']."\" style=\"width:80%;\">");
					}
					
		        print("</td>");
		        print("<td>");
		            print("แรงดันแก๊สหลังวิ่งเข้าโรงงาน");
		            print("</td>");
		            print("<td >");
		         		print("<input name = \"pressure_gas\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['pressure_gas']."\" style=\"width:80%;\"> บาร์");
		        print("</td>");
		    print("</tr>");  

		    print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("วันที่ทำการเช็ค");
		            print("</td>");
		            print("<td >");
		         		print("<input type='date' name = \"date_check\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['date_check']."\" style=\"width:100%;\">");
		        print("</td>");

		          print("<td>");
		            print("เวลาที่แช็ค");
		            print("</td>");
		            print("<td >");
		         		print("<input name = \"time_check\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['time_check']."\" style=\"width:80%;\" maxlength='5'>");
		        print("</td>");
		     print("</tr>");   

		     print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("ค่าทางด่วน");
		            print("</td>");
		            print("<td >");
		         		print("<input type='text' name = \"motor_way\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['motor_way']."\" style=\"width:100%;\">");
		        print("</td>");

		          print("<td>");
		            print("ค่าปะยาง/ซ่อมต่างๆ");
		            print("</td>");
		            print("<td >");
		         		print("<input name = \"repair\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['repair']."\" style=\"width:80%;\" maxlength='5'>");
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