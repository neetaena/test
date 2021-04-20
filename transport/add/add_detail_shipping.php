<?php
	@session_start();
	error_reporting (E_ALL ^ E_NOTICE);
	include("../../include/mySqlFunc.php");
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
	</style>
	<script type="text/javascript">
	function chkNumber(ele)
						{
						var vchar = String.fromCharCode(event.keyCode);
						if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
						ele.onKeyPress=vchar;
						}	
</script>
</head>
<body>
	<?php
	date_default_timezone_set("Asia/Bangkok");
	$id_ship = $_GET['id_ship'];
$get_shiiping = getlist("SELECT * FROM shipping WHERE id_ship='$id_ship'");
	    if(!empty($_POST['summit']))
	    {

	       	//ข้อมูลชุดที่ 1
	        $distanct = $_POST['distanct'];
	        $country = $_POST['country'];
	        $district = $_POST['district'];
	        $detailship = $_POST['detailship'];

	        $date_time =  date("Y-m-d H:i:s");

	        //ข้อมูลชุดที่ 2
	        $fule = $_POST['fule'];
	        $id_car_data = $_POST['id_car_data'];
	        $standard = $_POST['standard'];
	        $ngv = $_POST['ngv'];
	
	        //ข้อมูลชุดที่ 3
	        $allowance = $_POST['allowance'];
	        $money1 = $_POST['money1'];
	        $money2 = $_POST['money2'];
	        $customer_ship = $_POST['customer_ship'];
	        $map_url = addslashes($_POST['map_url']);

	        $edit_status = $_SESSION['permission']==10 ? 1 : 0;
	        query("UPDATE shipping SET distanct='$distanct',country='$country',district='$district',detailship='$detailship',edit_status='$edit_status',edit_time='$date_time',map_url='$map_url' WHERE id_ship='$id_ship'");

	        for ($i=0; $i < sizeof($fule); $i++) { 

	        	if(!empty($standard))
	        	{
	        		$check_data_fule = getlist("SELECT * FROM fule_detail WHERE id_ship='$id_ship' and fule_name='ดีเซล' and car_type='".$id_car_data[$i]."'");
	        		if(!empty($check_data_fule)){
	        		query("UPDATE fule_detail SET standard='".$standard[$i]."',fule_name='ดีเซล' WHERE id_dfule='".$check_data_fule[0]['id_dfule']."'");
	        		
	        		}else{
	        		query("INSERT INTO fule_detail SET standard='".$standard[$i]."',fule_name='ดีเซล',id_ship='$id_ship',car_type='".$id_car_data[$i]."'");
	        		}
	        	}

	        	if(!empty($ngv))
	        	{
	        		$check_data_fule = getlist("SELECT * FROM fule_detail WHERE id_ship='$id_ship' and fule_name='NGV' and car_type='".$id_car_data[$i]."'");
	        		if(!empty($check_data_fule)){
	        		query("UPDATE fule_detail SET standard='".$ngv[$i]."',fule_name='NGV' WHERE id_dfule='".$check_data_fule[0]['id_dfule']."'");
	        		
	        		}else{
	        		query("INSERT INTO fule_detail SET standard='".$ngv[$i]."',fule_name='NGV',id_ship='$id_ship',car_type='".$id_car_data[$i]."'");
	        		}
	        	}
	        }

	       for ($j=0; $j < sizeof($id_car_data); $j++) {
	     
	        		$check_data_allowance = getlist("SELECT * FROM allowance WHERE id_ship='$id_ship' and typecar='".$id_car_data[$j]."'");
		        	if(!empty($check_data_allowance)){
		        		query("UPDATE allowance SET dis_1='".$money1[$j]."',dis_2='".$money2[$j]."' WHERE id_allowance='".$check_data_allowance[0]['id_allowance']."'");
		        	}else{
		        		if(!empty($money1[$j]) || !empty($money2[$j])){
		        			query("INSERT INTO allowance SET id_ship='$id_ship',typecar='".$id_car_data[$j]."',dis_1='".$money1[$j]."',dis_2='".$money2[$j]."' ");
		        		}
		        	}
	        	
	        }



	        if($_FILES["pdfToUpload"]["name"])
					{
						
						$path = "../file";	
						$file_name = $id_ship."_".basename(iconv("utf-8", "tis-620",$_FILES["pdfToUpload"]["name"]));
						$name_insert_db = $id_ship."_".$_FILES["pdfToUpload"]["name"];
						$target_file = $path ."/".$file_name;//อ่านชื่อไฟล์
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);//หานามสกุลไฟล์ โดยแบ่งออกเป็น 3 อาเรย์ 1 dirname = path , basename =name+type file
						if(!@mkdir($path,0,true)){ //เป็นการตรวจสอบ folder ว่ามีหรือไม่ถ้ามีจะเข้าไปที่ if ที่เป็นจริง ถ้าไม่มีระบบจะสร้าง folder ให้และกระโดดไปทำงาน ที่ else

						}
							if (move_uploaded_file($_FILES["pdfToUpload"]["tmp_name"], $target_file)) 
							{

							query("UPDATE shipping SET file_data='$name_insert_db' WHERE id_ship='$id_ship'");
							
							
					      				        
						    } 
						
					}


				if($_FILES["imageToUpload"]["name"])
					{
						
						$path = "../image/map";	
						$file_name = $id_ship."_".basename(iconv("utf-8", "tis-620",$_FILES["imageToUpload"]["name"]));
						$name_insert_db = $id_ship."_".$_FILES["imageToUpload"]["name"];
						$target_file = $path ."/".$file_name;//อ่านชื่อไฟล์
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);//หานามสกุลไฟล์ โดยแบ่งออกเป็น 3 อาเรย์ 1 dirname = path , basename =name+type file
						if(!@mkdir($path,0,true)){ //เป็นการตรวจสอบ folder ว่ามีหรือไม่ถ้ามีจะเข้าไปที่ if ที่เป็นจริง ถ้าไม่มีระบบจะสร้าง folder ให้และกระโดดไปทำงาน ที่ else

						}
							if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) 
							{

							query("UPDATE shipping SET image_map='$name_insert_db' WHERE id_ship='$id_ship'");
							
							
					      				        
						    } 
						
					}



	            $message = "บันทึกข้อมูลสำเร็จ";
	             print "<script type='text/javascript'>alert('$message');</script>";
	             print "<script>window.opener.location.reload();</script>";
	             print "<script>window.close();</script>";

	    }
	   print("<form action = \"\" name = \"import_data\" method = \"POST\" enctype=\"multipart/form-data\">");
	    print("<table  align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"9\" style=\"font-size:35px;\">");
	    			print("เพิ่ม/แก้ไข รายละเอียดสถานที่จัดส่ง<br>");
	    		print("</td>");
	    	print("</tr>");

	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"9\" style=\"font-size:30px;\">");
	    		$_POST['distanct'] = empty($_POST['distanct']) ? $get_shiiping[0]['distanct'] : "";
	    		$_POST['country'] = empty($_POST['country']) ? $get_shiiping[0]['country'] : "";
	    		$_POST['detailship'] = empty($_POST['detailship']) ? $get_shiiping[0]['detailship'] : "";
	    		$_POST['district'] = empty($_POST['district']) ? $get_shiiping[0]['district'] : "";

	    	//	$_POST['customer_ship'] = empty($_POST['customer_ship']) ? $get_shiiping[0]['customer_ship'] : "";
	    		$check_pro_data = getlist("SELECT country From production_order WHERE delivery_name='".$get_shiiping[0]['id_ship']."'");
	    		//print("<t style='font-size:20px'>ชื่อลูกค้าตามใบกำกับ</t> ");
	    		//print("<input type='text' name = \"customer_ship\" value = \"".$_POST['customer_ship']."\" class='wheight-px' style='width:350px;' > <br>");

	    			print("<t style='font-size:20px'>ชื่อสถานที่</t> ");
	    			print("<input type='text' name = \"detailship\" value = \"".$_POST['detailship']."\" class='wheight-px' style='width:350px;' > <br>");
	    			
	    			print(" <t style='font-size:20px'>อำเภอ</t>");
	    			print("<input type='text' name = \"district\" value = \"".$_POST['district']."\" class='wheight-px' style='width:130px;' > ");
	    			print(" <t style='font-size:20px'>จังหวัด</t>");
	    			print("<input type='text' name = \"country\" value = \"".$_POST['country']."\" class='wheight-px' style='width:130px;'> ");

	    			print(" <t style='font-size:20px'>ระยะทาง</t>");
	    			print("<input type='text' name = \"distanct\" value = \"".$_POST['distanct']."\" class='wheight-px' OnKeyPress=\"return chkNumber(this)\"> Km");
	    		print("</td>");
	    	print("</tr>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td >");
	    			print("");
	    		print("</td>");
	    		print("<td colspan='2'>");
	    			print("<b>เชื้อเพลิงมาตรฐาน</b>");
	    		print("</td>");
	    		print("<td colspan='2'>");
	    			print("<b>เบี้ยเลี้ยง</b>");
	    		print("</td>");
	    	print("</tr>");
	    	print("<tr style=\"text-align:center;\">");
	    		/*print("<td >");
	    			print("<b>เชื่อเพลิง</b>");
	    		print("</td>");*/
	    		print("<td>");
	    			print("<b>ประเภทรถ</b>");
	    		print("</td>");

	    		print("<td>");
	    			print("<b>NGV</b>");
	    		print("</td>");

	    		print("<td>");
	    			print("<b>ดีเซล</b>");
	    		print("</td>");
	    		
		        print("<td>");
		            print("<b>เที่ยว 1</b>");
		        print("</td>");
		        print("<td>");
		            print("<b>เที่ยว 2</b>");
		        print("</td>");
	    	print("</tr>");

		       	$get_fule = getlist("SELECT * FROM fule_head WHERE id_fule='1'");
		       
		       	for ($f=0; $f < 1; $f++) { 
		       		
		       		print("<tr >");
		            $get_type_car = getlist("SELECT * FROM car_head WHERE type_user='1'");

		            	for ($g=0; $g < sizeof($get_type_car); $g++) { 
		            	//print("<td >");
		            		
		            		//print("<input type='hidden' name = \"fule_id[]\" value = \"".$get_fule_detail[0]['id_dfule']."\" readonly>");
		            	//print("</td>");
		            	 print("<td>");
		            	 print("<input type='hidden' name = \"fule[]\" value = \"".$get_fule[$f]['typefule']."\" style='padding-left: 5px;width:15mm;' readonly>");
		             		print("<input type='text' name = \"type_car_data[]\" value = \"".$get_type_car[$g]['detailhcar']."\" style='padding-left: 5px;' readonly>");
		            		print("<input type='hidden' name = \"id_car_data[]\" value = \"".$get_type_car[$g]['id_hcar']."\" readonly>");
			            print("</td>");

			            print("<td style='text-align:center;'>");
		            	$get_ngv_detail = getlist("SELECT * FROM fule_detail WHERE id_ship='$id_ship' and fule_name='NGV' and car_type='".$get_type_car[$g]['id_hcar']."'");
		       		
		             	$_POST['ngv'][$g] = empty($_POST['ngv'][$g]) ? $get_ngv_detail[0]['standard']:$_POST['ngv'][$g];
		            	print("<input type='text' name = \"ngv[]\" value = \"".$_POST['ngv'][$g]."\" class='wheight-px' OnKeyPress=\"return chkNumber(this)\" >");
			            print("</td>");


		            	print("<td style='text-align:center;'>");
		            	$get_fule_detail = getlist("SELECT * FROM fule_detail WHERE id_ship='$id_ship' and fule_name='".$get_fule[$f]['typefule']."' and car_type='".$get_type_car[$g]['id_hcar']."'");
		       		
		             	$_POST['standard'][$g] = empty($_POST['standard'][$g]) ? $get_fule_detail[0]['standard']:$_POST['standard'][$g];
		            	print("<input type='text' name = \"standard[]\" value = \"".$_POST['standard'][$g]."\" class='wheight-px' OnKeyPress=\"return chkNumber(this)\" >");
			            print("</td>");

			             
//-----------------------------------------------------------------------เบ้ยเลี้ยง----------------------------------------
					$get_money = getlist("SELECT * FROM allowance WHERE id_ship='$id_ship' and typecar='".$get_type_car[$g]['id_hcar']."'");			            
			            
			        print("<td>");
			        $_POST['money1'][$g] = empty($_POST['money1'][$g]) ? $get_money[0]['dis_1']:$_POST['money1'][$g];
			            print("<input type='text' name = \"money1[]\" value = \"".$_POST['money1'][$g]."\" class='wheight-px' OnKeyPress=\"return chkNumber(this)\">");
			        print("</td>");
			        print("<td>");
			        $_POST['money2'][$g] = empty($_POST['money2'][$g]) ? $get_money[0]['dis_2']:$_POST['money2'][$g];
			           print("<input type='text' name = \"money2[]\" value = \"".$_POST['money2'][$g]."\" class='wheight-px' OnKeyPress=\"return chkNumber(this)\">");
			        print("</td>");
			             print("</tr>");
			         }
		            
		        }

		    print("</table>");
			print("<table  align=\"center\" border='0'>");
			print("<tr style=\"text-align:center;\">");
		    	print("<td colspan=\"5\" style=\"font-size:30px;\">");
		    	print("<b style='color:#ff0c00;vertical-align: top;'>link แผนที่ </b>");
		    	print("<textarea name=\"map_url\" id=\"map_url\" style='width: 397px; height: 80px;'>".$get_shiiping[0]['map_url']."</textarea>");
		    	print("</td>");
		  print("</tr>");

		    print("<tr style=\"text-align:center;\">");
		    	print("<td colspan=\"5\" style=\"font-size:30px;\">");
		    	print("<t style='color:#ff0c00;'>เลือกไฟล์ PDF </b><input type=\"file\" name=\"pdfToUpload\" id=\"pdfToUpload\" accept=\".pdf\"    >");
		    	if($get_shiiping[0]['file_data']){
                   print("<a onclick = \"window.open('../add/read_pdf.php?id_ship=".$get_shiiping[0]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1200,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:red;font-size:25px;\"> --> <img src='../image/maps2.png' width='50'></a>");
                  }
		    	print("</td>");
		  print("</tr>");
  		print("<tr>");

		    	print("<td colspan=\"5\" style=\"font-size:30px;\">");
		    	print("<t style='color:#0e1ee0;'>เลือกภาพ JPG/PNG  </b><input type=\"file\" name=\"imageToUpload\" id=\"imageToUpload\" accept=\"jpg,png\"    >");
		    	if($get_shiiping[0]['image_map']){
                   print("<a onclick = \"window.open('../add/read_image.php?id_ship=".$get_shiiping[0]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1200,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:red;font-size:25px;\"> --> <img src='../image/maps2.png' width='50'></a>");
                  }
		    	print("</td>");
		     print("</tr>");

	        	if($_SESSION["permission"]==1 || $_SESSION["permission"]>=5){
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td style=\"text-align:center;\" colspan=\"9\">");

	    			print("<br><input type=\"submit\" name=\"summit\" value=\"ตกลง\" style=\"width:120px;cursor:pointer\">");
	    			print("</td>");
	    	print("</tr>");
	    	}

	    print("</table>");
	    print("</form>");


	?>

</body>
</html>