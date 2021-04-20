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
	<link rel="stylesheet" type = "text/css" href = "../datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="../datetimepicker/jquery.js"></script>
	<script type="text/javascript" src="../datetimepicker/jquery.datetimepicker.js"></script>
	
	<style type="text/css">
		th,tr,td,input,textarea,select{
			font-family: 'angsana new';
			font-size: 20px;

		}
		.cradit{
			background-color: #d7f5b9;
		}
		.money{
			background-color: #f6f935;
		}
	</style>

	<script type="text/javascript">
	function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.')  && (vchar != '+') ) return false;
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
	        $invoice_cradit = $_POST['invoice_cradit'];
			$time_cradit = $_POST['time_cradit'];
			$coordinates_cradit = $_POST['coordinates_cradit'];
	        $money = $_POST['money'];
	        $invoice_money  = $_POST['invoice_money'];
			$time_money  = $_POST['time_money'];
			$coordinates_money  = $_POST['coordinates_money'];

	        $total_cradit = 0;
	        
	        $total_money = 0;
	        $total_data = $_POST['total_data'];
	        $detail_weight= $_POST['detail_weight'];
	        $note = $_POST['note'];

	        $gas_weight = $_POST['gas_weight'];
			$wood_weight = $_POST['wood_weight'];
			$distanct = $_POST['distanct'];
			$pressure_gas = $_POST['pressure_gas'];
			$pump_gas = $_POST['pump_gas'];
	       	$pump_gas_other = $_POST['pump_gas_other'];
	       	$row =$_POST['row'];

	       	$date_check = $_POST['date_check'];
	       	$time_check = $_POST['time_check'];

	       	$motor_way_detail = $_POST['motor_way_detail'];
	       	$motor_way = $_POST['motor_way'];
	       	$repair_detail = $_POST['repair_detail'];
	       	$repair = $_POST['repair'];

	       	$gas_detail_id = $_POST['gas_detail_id'];

	       	$to_customer = $_POST['to_customer'];
			$due_customer = $_POST['due_customer'];
			$start_down = $_POST['start_down'];
			$finish_down = $_POST['finish_down'];
			$type_customer = $_POST['type_customer'];
			$type_customer_detail = $_POST['type_customer_detail'];
			$total_slab = $_POST['total_slab'];
	       	for ($p=0; $p < $row; $p++) { 
	       		if(!empty($cradit[$p])){
	       			$total_cradit += $cradit[$p];
	       		
	       		}
	       		if(!empty($money[$p])){
	       			$total_money += $money[$p];
	       			
	       		}
	       	}

	       	if(!empty($type_customer_detail)){
	       			$type_customer_new = $type_customer.",".$type_customer_detail;
	       		}else{
	       			$type_customer_new = $type_customer;
	       		}


	       		if(!empty($pump_gas_other)){
	       			$gas_new = $pump_gas.",".$pump_gas_other;
	       		}else{
	       			$gas_new = $pump_gas;
	       		}
	       		
	          if(empty($check_data)){
	          	 $sql = query("INSERT INTO gas_ngv SET credit='$total_cradit',cash='$total_money',num_of_paper='$total_data',note='$note',boonpon_id='$boonpon_id',data_number='$data_number',gas_weight='$gas_weight',wood_weight='$wood_weight',distanct='$distanct',pressure_gas='$pressure_gas',pump_gas='$gas_new',detail_weight='$detail_weight',time_check='$time_check',date_check='$date_check',motor_way='$motor_way',repair='$repair',motor_way_detail='$motor_way_detail',repair_detail='$repair_detail',to_customer='$to_customer',due_customer='$due_customer',start_down='$start_down',finish_down='$finish_down',type_customer='$type_customer_new',total_slab='$total_slab'");
	          	  $message = "เพิ่มข้อมูลสำเร็จ";
	          }else{
	          	$sql = query("UPDATE gas_ngv SET credit='$total_cradit',cash='$total_money',num_of_paper='$total_data',note='$note',gas_weight='$gas_weight',wood_weight='$wood_weight',distanct='$distanct',pressure_gas='$pressure_gas',pump_gas='$gas_new',detail_weight='$detail_weight',time_check='$time_check',date_check='$date_check',motor_way='$motor_way',repair='$repair',motor_way_detail='$motor_way_detail',repair_detail='$repair_detail',to_customer='$to_customer',due_customer='$due_customer',start_down='$start_down',finish_down='$finish_down',type_customer='$type_customer_new',total_slab='$total_slab' where boonpon_id='$boonpon_id' and data_number='$data_number'");
	          	 $message = "แก้ไขข้อมูลสำเร็จ";
	          }

	        for ($k=0; $k < $row; $k++) { 
	        	if(!empty($gas_detail_id[$k])){
	        		query("UPDATE gas_ngv_detail SET cradit='".$cradit[$k]."',credit_invoice='".$invoice_cradit[$k]."',credit_time='".$time_cradit[$k]."',money='".$money[$k]."',money_invoice='".$invoice_money[$k]."',money_time='".$time_money[$k]."',coordinates_credit='".$coordinates_cradit[$k]."',coordinates_money='".$coordinates_money[$k]."' WHERE gas_detail_id='".$gas_detail_id[$k]."'");
	        	}else{
	        		$get_id =  getlist("SELECT * FROM gas_ngv WHERE boonpon_id='$boonpon_id' and data_number='$data_number'");
	        		query("INSERT INTO gas_ngv_detail SET cradit='".$cradit[$k]."',credit_invoice='".$invoice_cradit[$k]."',credit_time='".$time_cradit[$k]."',money='".$money[$k]."',money_invoice='".$invoice_money[$k]."',money_time='".$time_money[$k]."',coordinates_credit='".$coordinates_cradit[$k]."',coordinates_money='".$coordinates_money[$k]."',gas_ngv_id='".$get_id[0]['gas_id']."'");
	        	}
	       		
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
	
		$_POST['note'] = empty($_POST['note']) ? $check_data[0]['note']:$_POST['note'];
		$_POST['gas_weight'] = empty($_POST['gas_weight']) ? $check_data[0]['gas_weight']:$_POST['gas_weight'];
		$_POST['wood_weight'] = empty($_POST['wood_weight']) ? $check_data[0]['wood_weight']:$_POST['wood_weight'];
		$_POST['distanct'] = empty($_POST['distanct']) ? $check_data[0]['distanct']:$_POST['distanct'];

		$_POST['pressure_gas'] = empty($_POST['pressure_gas']) ? $check_data[0]['pressure_gas']:$_POST['pressure_gas'];
		
		$_POST['detail_weight'] = empty($_POST['detail_weight']) ? $check_data[0]['detail_weight']:$_POST['detail_weight'];
		$_POST['weeight_gas'] = empty($_POST['weeight_gas']) ? $check_data[0]['weeight_gas']:$_POST['weeight_gas'];

		$_POST['motor_way'] = empty($_POST['motor_way']) ? $check_data[0]['motor_way']:$_POST['motor_way'];
		$_POST['repair'] = empty($_POST['repair']) ? $check_data[0]['repair']:$_POST['repair'];
		$_POST['motor_way_detail'] = empty($_POST['motor_way_detail']) ? $check_data[0]['motor_way_detail']:$_POST['motor_way_detail'];
		$_POST['repair_detail'] = empty($_POST['repair_detail']) ? $check_data[0]['repair_detail']:$_POST['repair_detail'];
		$_POST['time_check'] = empty($_POST['time_check']) ? $check_data[0]['time_check']:$_POST['time_check'];
		$_POST['date_check'] = empty($_POST['date_check']) ? $check_data[0]['date_check']:$_POST['date_check'];

		$_POST['to_customer'] = empty($_POST['to_customer']) ? $check_data[0]['to_customer']:$_POST['to_customer'];
		$_POST['due_customer'] = empty($_POST['due_customer']) ? $check_data[0]['due_customer']:$_POST['due_customer'];
		$_POST['start_down'] = empty($_POST['start_down']) ? $check_data[0]['start_down']:$_POST['start_down'];
		$_POST['finish_down'] = empty($_POST['finish_down']) ? $check_data[0]['finish_down']:$_POST['finish_down'];
		$_POST['slab'] = empty($_POST['slab']) ? $check_data[0]['total_slab']:$_POST['slab'];


		$pump = explode(",",  $check_data[0]['pump_gas']);
		$type_c = explode(",",  $check_data[0]['type_customer']);

		$_POST['pump_gas'] = empty($_POST['pump_gas']) ? $pump[0]:$_POST['pump_gas'];
		$_POST['pump_gas_other'] = empty($_POST['pump_gas_other']) ? $pump[1]:$_POST['pump_gas_other'];

		$_POST['type_customer'] = empty($_POST['type_customer']) ? $type_c[0]:$_POST['type_customer'];
		$_POST['type_customer_detail'] = empty($_POST['type_customer_detail']) ? $type_c[1]:$_POST['type_customer_detail'];

	   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
	    print("<table style=\"width:90%;\" align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"8\" style=\"font-size:35px;\">");
	    			print("เพิ่ม / แก้ไขค่าใช้จ่าย Gas NGV<br>");
	    		print("</td>");
	    	print("</tr>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"8\">");
	    		$_POST['row'] = empty($_POST['row']) ? 3:$_POST['row'];
	    			print("จำนวนแถว <input name='row' type='text' value='".$_POST['row']."' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
	    		print("</td>");
	    	print("</tr>");
 			print("<tr style=\"text-align:center;\">");
 				print("<td style='width:15%'>");
		            print("บัตรเครดิต");
		        print("</td>");
		        print("<td style='width:15%'>");
		            print("Invoice");
		        print("</td>");
		        print("<td style='width:10%'>");
		            print("เวลาเติม");
		        print("</td>");
		        print("<td style='width:10%'>");
		            print("ความถูกต้องของพิกัด");
		        print("</td>");

		        print("<td style='width:15%'>");
		            print("เงินสด");
		        print("</td>");
		        print("<td style='width:15%'>");
		            print("Invoice");
		        print("</td>");
		         print("<td style='width:10%'>");
		            print("เวลาเติม");
		        print("</td>");
		        print("<td style='width:10%'>");
		            print("ความถูกต้องของพิกัด");
		        print("</td>");
 			print("</tr>");
 			$total_money_data = 0;
 			$get_data_detail = getlist("SELECT * FROM gas_ngv_detail WHERE gas_ngv_id='".$check_data[0]['gas_id']."'");
 			for ($i=0; $i <$_POST['row']; $i++) { 
 				$_POST['cradit'][$i] = empty($_POST['cradit'][$i]) ? $get_data_detail[$i]['cradit']:$_POST['cradit'][$i];
				$_POST['invoice_cradit'][$i] = empty($_POST['invoice_cradit'][$i]) ? $get_data_detail[$i]['credit_invoice']:$_POST['invoice_cradit'][$i];
				$_POST['time_cradit'][$i] = empty($_POST['time_cradit'][$i]) ? $get_data_detail[$i]['credit_time']:$_POST['time_cradit'][$i];
				$_POST['coordinates_cradit'][$i] = empty($_POST['coordinates_cradit'][$i]) ? $get_data_detail[$i]['coordinates_cradit']:$_POST['coordinates_cradit'][$i];

				$_POST['money'][$i] = empty($_POST['money'][$i]) ? $get_data_detail[$i]['money']:$_POST['money'][$i];
				$_POST['invoice_money'][$i] = empty($_POST['invoice_money'][$i]) ? $get_data_detail[$i]['money_invoice']:$_POST['invoice_money'][$i];
				$_POST['time_money'][$i] = empty($_POST['time_money'][$i]) ? $get_data_detail[$i]['money_time']:$_POST['time_money'][$i];
				$_POST['coordinates_money'][$i] = empty($_POST['coordinates_money'][$i]) ? $get_data_detail[$i]['coordinates_money']:$_POST['coordinates_money'][$i];

 				print("<tr style=\"text-align:center;\">");
	 				print("<td>");
			           print("<input name = \"cradit[]\" value = \"".$_POST['cradit'][$i]."\" style=\"width:100%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" class='cradit'>");
			            print("<input type='hidden' name = \"gas_detail_id[]\" value = \"".$get_data_detail[$i]['gas_detail_id']."\" ");

			            $total_money_data = $total_money_data + $_POST['cradit'][$i];

			        print("</td>");
			        print("<td>");
			            print("<input name = \"invoice_cradit[]\" value = \"".$_POST['invoice_cradit'][$i]."\" style=\"width:100%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\"  class='cradit'>");
			        print("</td>");
			        print("<td>");
			           print("<input name = \"time_cradit[]\" value = \"".$_POST['time_cradit'][$i]."\" style=\"width:100%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" class='cradit'>");
			        print("</td>");

			         print("<td>");
			           print("<select name = \"coordinates_cradit[]\" style = \"width:80%;\" class=\"text_fide\" class='cradit'>");
						$get_side = array("YES"=>"YES","NO"=>"NO");
								while (list($key, $value) = each($get_side)) {
									$selected=$_POST['coordinates_cradit'][$i]==$key ? "selected=\"selected\"" : "";
						       		print("<option value='$key' ".$selected.">$value</option>");
								}
						
						print("</select>");
			        print("</td>");

			        print("<td>");
			            print("<input name = \"money[]\" value = \"".$_POST['money'][$i]."\" style=\"width:100%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" class='money'>");
			            $total_money_data = $total_money_data + $_POST['money'][$i];
			        print("</td>");
			        print("<td>");
			            print("<input name = \"invoice_money[]\" value = \"".$_POST['invoice_money'][$i]."\" style=\"width:100%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\"  class='money'>");
			        print("</td>");
			        print("<td>");
			            print("<input name = \"time_money[]\" value = \"".$_POST['time_money'][$i]."\" style=\"width:100%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" class='money'>");
			        print("</td>");

			        print("<td>");
			          print("<select name = \"coordinates_money[]\" style = \"width:80%;\" class=\"text_fide\"  class='money'>");
						$get_side = array("YES"=>"YES","NO"=>"NO");
								while (list($key, $value) = each($get_side)) {
									$selected=$_POST['coordinates_money'][$i]==$key ? "selected=\"selected\"" : "";
						       		print("<option value='$key' ".$selected.">$value</option>");
								}
						
						print("</select>");
			        print("</td>");
 				print("</tr>");
 			}



	  		/*print("<tr style=\"text-align:center;\">");
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
		    print("</tr>"); */

			   for ($p=0; $p < $_POST['row']; $p++) { 
		       		if(!empty($_POST['cradit'][$p])){
		       			$total_data += 1;
		       		}
		       		if(!empty($_POST['money'][$p])){
		       			
		       			$total_data += 1;
		       		}
		       	}
		      print("<tr style=\"text-align:center;\">");
		        print("<td colspan='2'>");
		            print("น้ำหนัก Gas ทั้งหมด");
		            print("</td>");
		            print("<td  colspan='6'>");
		         		print("<input name = \"detail_weight\" value = \"".$_POST['detail_weight']."\" style=\"width:230px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" >");
		         		$new_weeight = explode("+", $_POST['detail_weight']);
		         		for ($i=0; $i < sizeof($new_weeight); $i++) { 
		         			$total_gas +=$new_weeight[$i];
		         		        			
		         		}

		         		print("<input name = \"gas_weight\" value = \"".$total_gas."\" style=\"width:130px;\" readonly>");
		            print("</td>");
		    print("</tr>");

		    print("<tr style=\"text-align:center;\">");
		        print("<td  colspan='2'>");
		            print("จำนวนบิลค่า Gas");
		            print("</td>");
		            print("<td  colspan='4'>");
		         		print("<input name = \"total_data\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$total_data."\" style=\"width:360px;\">");
		            print("</td>");
		            print("<td  colspan='4' rowspan='2 '>");
		            	print("<b style='font-size:30px;color:#690707;'>".$total_money_data."/".$total_gas."</b><br>");
		            $total_average =	$total_money_data/$total_gas;
		            			print("<b style='font-size:40px;color:red;'>".number_format($total_average,2)."</b>");
		            print("</td>");
		    print("</tr>");        

		    print("<tr style=\"text-align:center;\">");
		        print("<td  colspan='2'>");
		            print("หมายเหตุ");
		        print("</td>");
		        print("<td  colspan='4'>");
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
						
						//$get_side = array("JN บ้านป่า"=>"JN บ้านป่า","มิตรฯทับกวาง"=>"มิตรฯทับกวาง","พริสร พระลาน"=>"พริสร พระลาน","พริสร 9 พระบาท"=>"พริสร 9 พระบาท","อื่นๆ"=>"อื่นๆ");
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
		             print("<td  style='text-align:left;'>");
		         		print("<input name = \"motor_way_detail\" value = \"".$_POST['motor_way_detail']."\" style=\"width:75%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" >");
		         		$new_motor = explode("+", $_POST['motor_way_detail']);
		         		for ($i=0; $i < sizeof($new_motor); $i++) { 
		         			$total_motor_way +=$new_motor[$i];
		         					         			
		         		}

		         		print("<input type='text' name = \"motor_way\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$total_motor_way."\" style=\"width:20%;\" readonly>");

		           
		        print("</td>");

		          print("<td>");
		            print("ค่าปะยาง/เช็คลมยาง");
		            print("</td>");
		            print("<td>");
		            print("<input name = \"repair_detail\" value = \"".$_POST['repair_detail']."\" style=\"width:75%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" >");
		         		$new_repair = explode("+", $_POST['repair_detail']);
		         		for ($i=0; $i < sizeof($new_repair); $i++) { 
		         			$total_repair +=$new_repair[$i];
		         			
		         			
		         		}

		         		print("<input name = \"repair\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$total_repair."\" style=\"width:20%;\" readonly>");
		        print("</td>");
		     print("</tr>");   
		     print("<tr style=\"text-align:center;\">");

		          print("<td>");
		            print("สลับยาง/เปลี่ยนยาง");
		            print("</td>");
		            print("<td>");
		            print("<input name = \"slab\" value = \"".$_POST['slab']."\" style=\"width:75%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" >");
		         		$new_repair = explode("+", $_POST['slab']);
		         		if(!empty($_POST['slab'])){
		         			for ($i=0; $i < sizeof($new_repair); $i++) { 
		         			$total_slab +=$new_repair[$i];
		         			
		         			}
		         		}else{
		         			$total_slab = 0;
		         		}
		         		

		         		print("<input name = \"total_slab\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$total_slab."\" style=\"width:20%;\" readonly>");
		        print("</td>");
		     print("</tr>");

			print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("เวลาไปถึงลูกค้า");
		            print("</td>");
		             print("<td  style='text-align:left;'>");
		         		print("<input  type=\"time\" name = \"to_customer\" value = \"".$_POST['to_customer']."\" style=\"width:75%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" maxlength='5'>");
		   
		         		           
		        print("</td>");

		          print("<td>");
		            print("เวลาลูกค้านัดหมาย");
		            print("</td>");
		            print("<td>");
		            print("<input  type=\"time\" name = \"due_customer\" value = \"".$_POST['due_customer']."\" style=\"width:75%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" maxlength='5'>");
		
		        print("</td>");
		     print("</tr>");   
		     print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("เวลาเริ่มลงสินค้า");
		            print("</td>");
		             print("<td  style='text-align:left;'>");
		         		print("<input type=\"time\" name = \"start_down\" value = \"".$_POST['start_down']."\" style=\"width:75%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" maxlength='5'>");
		   
		         		          
		        print("</td>");

		          print("<td>");
		            print("เวลาลงสินค้าเสร็จ");
		            print("</td>");
		            print("<td>");
		            print("<input  type=\"time\" name = \"finish_down\" value = \"".$_POST['finish_down']."\" style=\"width:75%;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\" maxlength='5'>");
		
		        print("</td>");
		     print("</tr>");   
		      print("<tr style=\"text-align:center;\">");
		        	print("<td>");
		            print("ประเภทลูกค้า");
		            print("</td>");
		             print("<td  style='text-align:left;'>");
		         		print("<select name = \"type_customer\" style = \"width:80%;\" class=\"text_fide\" onchange='this.form.submit();'>");
						print("<option value = '' ></option>");
						
						$get_side = array("โรงงาน/โกดัง"=>"โรงงาน/โกดัง","โครงการ"=>"โครงการ","อื่นๆ"=>"อื่นๆ");
								while (list($key, $value) = each($get_side)) {
									$selected=$_POST['type_customer']==$key ? "selected=\"selected\"" : "";
						       		print("<option value='$key' ".$selected.">$value</option>");
								}
						
					print("</select>");
					if($_POST['type_customer']=='อื่นๆ'){
						print("<input name = \"type_customer_detail\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" value = \"".$_POST['type_customer_detail']."\" style=\"width:80%;\">");
					}
		         		           
		        	print("</td>");

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