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
			font-size: 20px;

		}
	</style>
</head>
<body>
	<?php

	    if(!empty($_POST['summit']))
	    {
	       
	        $product_id = $_POST['product_id'];
	        $gule_data = $_POST['gule_data'];
	        $gule_orderby = $_POST['gule_orderby'];
	       
	            $check_data = getlist("SELECT * FROM production_gule WHERE gule_description='$gule_data' and product_id='$product_id'");
	            if(empty($check_data))
	            {
	                $sql = query("INSERT INTO production_gule SET gule_description='$gule_data',product_id='$product_id',gule_orderby='$gule_orderby'");
	                
	                if($sql)
	                {
	                    $message = "เพิ่มข้อมูลสำเร็จ";
	                    
	                  unset($_POST);

	                }else{
	                    $message = "ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
	                }
	            }else{
	                 $message = "ข้อมูลนี้มีในระบบอยู่แล้ว กรุณากรอกใหม่";
	            }

	           
	             print "<script type='text/javascript'>alert('$message');</script>";
	             print "<script>window.opener.location.reload();</script>";

	    }
	   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
	    print("<table style=\"width:50%;\" align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"2\" style=\"font-size:35px;\">");
	    			print("เพิ่มข้อมูลกาว<br>");
	    		print("</td>");
	    	print("</tr>");
	  		print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("ชนิดไม้");
		            print("</td>");
		            print("<td>");
		           
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
	    		print("ชื่อกาว");
	    		print("</td>");
	    		print("<td>");
	            
	    				print("<textarea name = \"gule_data\" value = \"\" style=\"width:231px;resize: none !important;\" required>");
								print($_POST['gule_data']);
						print("</textarea>");
	    		print("</td>");
	    	print("</tr>");

	    	print("<tr style=\"text-align:center;\">");
	    	print("<td>");
	    		print("การเรียงลำดับ");
	    		print("</td>");
	    		print("<td>");
	            
	    				print("<input name = \"gule_orderby\" value = \"".$_POST['gule_orderby']."\" style=\"width:231px;\">");
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