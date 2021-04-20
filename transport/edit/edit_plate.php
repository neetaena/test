<?php
	@session_start();
	error_reporting (E_ALL ^ E_NOTICE);
	include("../../include/mySqlFunc.php");
	query("USE transport");
?>
<!DOCTYPE html>
<html>
<head>
	<title>แก้ไขข้อมูลกาว</title>
	<style type="text/css">
		th,tr,td,input,textarea,select{
			font-family: 'angsana new';
			font-size: 20px;

		}
	</style>
</head>
<body>
	<?php
	$id_plate =$_GET['id_plate'];
$get_plate= getlist("SELECT * FROM production_plate WHERE id_plate='$id_plate'");
	    if(!empty($_POST['summit']))
	    {
	       
	       $product_id = $_POST['product_id'];
	        $plate_name = $_POST['plate_name'];
	       
	       
	          
	                $sql = query("UPDATE production_plate SET plate_name='$plate_name',product_id='$product_id' WHERE id_plate='$id_plate'");
	                
	                if($sql)
	                {
	                    $message = "เพิ่มข้อมูลสำเร็จ";
	                    
	                   
	                    print "<script>window.opener.location.reload();</script>";
	                    print "<script>window.close();</script>";

	                }else{
	                    $message = "ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
	                }
	          

	           
	             print "<script type='text/javascript'>alert('$message');</script>";

	    }
	   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
	    print("<table style=\"width:50%;\" align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"2\" style=\"font-size:35px;\">");
	    			print("แก้ไขข้อมูลเพลท<br>");
	    		print("</td>");
	    	print("</tr>");
	  		print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("ชนิดไม้");
		            print("</td>");
		            print("<td>");
		           $_POST['product_id'] = empty($_POST['product_id']) ? $get_plate[0]['product_id'] : $_POST['product_id'];
		            print("<select name = \"product_id\" style=\"width:231px;\" required>");
		                                  print("<option value=''>เลือกชนิดไม้</option>");
		                    $type_wood = getlist("SELECT *  FROM type_production");
		                    for ($u=0; $u < sizeof($type_wood); $u++) 
		                    { 
		                        $selected=$_POST['product_id']==$type_wood[$u]['id_production'] ? "selected=\"selected\"" : "";
		                         print("<option value = \"".$type_wood[$u]['id_production']."\"".$selected.">".$type_wood[$u]['detail_production']."</option>");
		                    }
		            print("</select>");
		            print("</td>");
		    print("</tr>");

      

	    	print("<tr style=\"text-align:center;\">");
	    	print("<td>");
	    		print("ขนาดไม้");
	    		print("</td>");
	    		print("<td>");
		           $_POST['plate_name'] = empty($_POST['plate_name']) ? $get_plate[0]['plate_name'] : $_POST['plate_name'];
	            
	    				print("<textarea name = \"plate_name\" value = \"\" style=\"width:231px;resize: none !important;\" required>");
								print($_POST['plate_name']);
						print("</textarea>");
	    		print("</td>");
	    	print("</tr>");

	    	
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td style=\"text-align:center;\" colspan=\"2\">");

	    			print("<br><input type=\"submit\" name=\"summit\" value=\"ตกลง\" style=\"width:120px;\">");
	    			print("</td>");
	    	print("</tr>");

	    print("</table>");
	    print("</form>");


	?>

</body>
</html>