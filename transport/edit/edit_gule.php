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
	$id =$_GET['gule_id'];
$get_gule = getlist("SELECT * FROM production_gule WHERE gule_id='$id'");
	    if(!empty($_POST['summit']))
	    {
	       
	       $product_id = $_POST['product_id'];
	        $gule_data = $_POST['gule_data'];
	        $gule_orderby = $_POST['gule_orderby'];
	       
	          
	                $sql = query("UPDATE production_gule SET gule_description='$gule_data',product_id='$product_id',gule_orderby='$gule_orderby' WHERE gule_id='$id'");
	                
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
	    			print("แก้ไขข้อมูลกาว<br>");
	    		print("</td>");
	    	print("</tr>");
	  		print("<tr style=\"text-align:center;\">");
		        print("<td>");
		            print("ชนิดไม้");
		            print("</td>");
		            print("<td>");
		           $_POST['product_id'] = empty($_POST['product_id']) ? $get_gule[0]['product_id'] : $_POST['product_id'];
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
		           $_POST['gule_data'] = empty($_POST['gule_data']) ? $get_gule[0]['gule_description'] : $_POST['gule_data'];
	            
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
		           $_POST['gule_orderby'] = empty($_POST['gule_orderby']) ? $get_gule[0]['gule_orderby'] : $_POST['gule_orderby'];
	            
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