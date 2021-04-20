<?php
//ส่วนของการเชื่อมต่อฐานข้อมูล MySQL
/*$objConnect = mysql_connect("server-vng","root","0894841471") or die("Error Connect to Database"); // Conect to MySQL
$objDB = mysql_select_db("transport");*/
//include("../include/mySqlFunc.php");
	query("USE transport");
	query("SET NAMES UTF8");
	if(!empty($_POST['summit']))
	{
		//ทำการเปิดไฟล์ CSV เพื่อนำข้อมูลไปใส่ใน MySQL
		$path = "upload/";
		$target_file = $path . basename($_FILES["fileToUpload"]["name"]);//อ่านชื่อไฟล์
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);//หานามสกุลไฟล์ โดยแบ่งออกเป็น 3 อาเรย์ 1 dirname = path , basename =name+type file
		$upload_insert =1;
		$date_data =$_POST['date_data'];
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $path.$_FILES["fileToUpload"]["name"])) 
			{
				query("DELETE FROM production_order WHERE status_data='0'");
				$objCSV = fopen( $path.$_FILES["fileToUpload"]["name"], "r");
				while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) 
				{
				        //นำข้อมูลใส่ในตาราง member
						if($objArr[2]=="On order")
						{
							// $objArr[0] คือ name
							// objArr[3] คือ item_number
							// $objArr[4] คือ number
							// $objArr[6] คือ quanity
							// $objArr[8] คือ delivery_name
							// $objArr[9] คือ delivery_date
							// $objArr[10] คือ Crate date and  time
							// $objArr[11] คือ Sell Name
							// $objArr[12] คือ Unit Price
							$data1 = strpos($objArr[9],"-");
							if($data1 !== FALSE)
							{
								$objArr[0]=iconv("tis-620", "utf-8", $objArr[0]);
								$objArr[8]=iconv("tis-620", "utf-8", $objArr[8]);
								$objArr[11] =iconv("tis-620", "utf-8", $objArr[11]);

								$get_cus = getlist("SELECT * FROM customer WHERE namecustomer like '".$objArr[0]."' limit 1");
								if(!empty($get_cus[0]['id_customer']))
								{
									$name_cus = $get_cus[0]['id_customer'];
								}else{
									query("INSERT INTO customer SET namecustomer='".$objArr[0]."',status='1'");
									$getmax = getlist("SELECT max(id_customer) as id_cus FROM customer ");
									$name_cus = $getmax[0]['id_cus'];
								}
								
								$get_ship = getlist("SELECT * FROM shipping WHERE detailship like '".$objArr[8]."' limit 1");
								if(!empty($get_ship[0]['id_ship']))
								{
									$name_ship = $get_ship[0]['id_ship'];
								}else{
									query("INSERT INTO shipping SET detailship='".$objArr[8]."',statusship='1'");
									$getmaxship = getlist("SELECT max(id_ship) as id_ship FROM shipping ");
									$name_ship = $getmaxship[0]['id_ship'];
								}
								$get_ship_cus = getlist("SELECT * FROM shipping WHERE detailship like '".$objArr[0]."' limit 1");
								if(empty($get_ship_cus[0]['id_ship']))
								{
									query("INSERT INTO shipping SET detailship='".$objArr[0]."',statusship='1'");
								}
								$new_quantity = 0;
								$cut_quantity = explode(",", $objArr[6]);
								for($q=0;$q<sizeof($cut_quantity);$q++)
								{
									if($new_quantity==0)
									{
										$new_quantity=$cut_quantity[$q];
									}else{
										$new_quantity .=$cut_quantity[$q];
									}
								}

								$check_line = getlist("SELECT line_number FROM production_order WHERE number='".$objArr[4]."' order by line_number DESC");
								if(!empty($check_line[0]['line_number']))
								{
									$line = $check_line[0]['line_number']+1;
								}else{
									$line = 1;
								}

							// $objArr[0] คือ name
							// objArr[3] คือ item_number
							// $objArr[4] คือ number
							// $objArr[6] คือ quanity
							// $objArr[8] คือ delivery_name
							// $objArr[9] คือ delivery_date
							// $objArr[10] คือ Crate date and  time
							// $objArr[11] คือ Sell Name
							// $objArr[12] คือ Unit Price
									$chack_update = getlist("SELECT * FROM production_addition WHERE number='".$objArr[4]."' and line_number='".$line."'");
							   	if(!empty($chack_update[0]['number']))
							   	{
									$strSQL = query("INSERT INTO production_order (name,item_number,number,quantity,delivery_date,delivery_name,crate_date,sell_name,unit_price,line_number,note,invoice,boonpon_id,country) VALUES ('".$name_cus."','".$objArr[3]."','".$objArr[4]."','".$new_quantity."','".$chack_update[0]['delivery_date']."','".$chack_update[0]['delivery_name']."','".$objArr[10]."','".$objArr[11]."','".$objArr[12]."','$line','".$chack_update[0]['note']."','".$chack_update[0]['invoice']."','".$chack_update[0]['boonpon_id']."','".$chack_update[0]['country']."')");

							 			/*query("INSERT INTO production_transport (name,item_number,number,quantity,delivery_date,delivery_name,crate_date,sell_name,unit_price,line_number,note,invoice,boonpon_id,country) VALUES ('".$name_cus."','".$objArr[3]."','".$objArr[4]."','".$new_quantity."','".$chack_update[0]['delivery_date']."','".$chack_update[0]['delivery_name']."','".$objArr[10]."','".$objArr[11]."','".$objArr[12]."','$line','".$chack_update[0]['note']."','".$chack_update[0]['invoice']."','".$chack_update[0]['boonpon_id']."','".$chack_update[0]['country']."')");*/

							   	}else
							   	{
							   			$strSQL = query("INSERT INTO production_order (name,item_number,number,quantity,delivery_date,delivery_name,crate_date,sell_name,unit_price,line_number) VALUES ('".$name_cus."','".$objArr[3]."','".$objArr[4]."','".$new_quantity."','".$objArr[9]."','".$name_ship."','".$objArr[10]."','".$objArr[11]."','".$objArr[12]."','$line')");

							   			$check_tran = getlist("SELECT * FROM production_transport WHERE number='".$objArr[4]."' and line_number='".$line."'");
							   			if(empty($check_tran[0]['number']))
							   			{
							   				query("INSERT INTO production_transport (name,item_number,number,quantity,delivery_date,delivery_name,crate_date,sell_name,unit_price,line_number) VALUES ('".$name_cus."','".$objArr[3]."','".$objArr[4]."','".$new_quantity."','".$objArr[9]."','".$name_ship."','".$objArr[10]."','".$objArr[11]."','".$objArr[12]."','$line')");
							   			}
							 			
							   	}
							 

							 	$message =  "อัพโหลดข้อมูลสำเร็จ";
							 	if($upload_insert==1)
							 	{
							 		query("INSERT INTO upload_data (file_name,upload_date) VALUES ('".$_FILES["fileToUpload"]["name"]."','".$date_data."')");
							 		$upload_insert =0;
							 	}

							}else{
								$message =  "รูปแบบของวันที่ไม่ถูกต้อง กรุณาทำให้อยู่ในรูปแบบ 2017-12-01 (ปี-เดือน-วัน)";
							}
							
							
						}

				 }
				fclose($objCSV);
				unset($_POST);
				
			}else
			{
				$message =  "ไม่สามารถเพิ่มข้อมูลได้";
			}
			print "<script type='text/javascript'>alert('$message');</script>";
			
	}


print("<form action = \"\" name = \"upload_data\" method = \"POST\" enctype=\"multipart/form-data\">");

print("<table class=\"uploadFile\"  bgcolor = \"#FFFFFF\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:140mm;empty-cells: show;font-size:20px;\">");
print("<tr>");
	print("<td colspan=\"2\" style=\"text-align:center;font-size:25px;\">");
			print("<b>เลือกไฟล์ที่ต้องการ</b>");
		print("</td>");
print("</tr>");	
print("<tr>");
		print("<td>");
			print("เลือกวันที่");
		print("</td>");
		print("<td>");
			print("<input type = \"text\" name =\"date_data\" value=\"".$_POST['date_data']."\" id = \"date_search\" style=\"width:250px;\" onchange=\"this.form.submit();\">");
				print("<script type=\"text/javascript\">
						 jQuery('#date_search').datetimepicker({
						 timepicker:false,
						 format:'Y-m-d'
						 });
				 </script>");
		print("</td>");
print("</tr>");

print("<tr>");
	print("<td>");
			print("เลือกไฟล์ที่ต้องการ");
		print("</td>");
	print("<td>");
			print("<input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" accept=\".csv\" >");
		print("</td>");
		
print("</tr>");
print("<tr>");
	print("<td colspan=\"2\" style=\"text-align:center;\">");
	print("<br>");
	print("</td>");
print("</tr>");
print("<tr>");
		print("<td colspan=\"2\" style=\"text-align:center;\">");
			print("<input  type = \"submit\" name = \"summit\" value = \"ยืนยัน\" style=\"width: 200px;\" >");
			print("</td>");
		print("</tr>");
print("<table>");
print("</form>");

print("<div style=\"color:red;font-size:18px;text-align:center;margin-top:10px;\"> กรุณาตรวจสอบช้อมูลก่อนอัพโหลด<a href=\"https://drive.google.com/file/d/0B_Dpw3J9R2FCVWd6NUlpczY0alk/view?usp=sharing\" target=\"BLANK\">ตัวอย่าง Template (คลิก)</a></div>")
?>