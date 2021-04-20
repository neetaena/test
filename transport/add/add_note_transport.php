<?php
	@session_start();
	error_reporting (E_ALL ^ E_NOTICE);
	include("../../include/mySqlFunc.php");
	query("USE transport");
?>
<!DOCTYPE html>
<html>
<head>
	<title>เพิ่มหมายเหตุ</title>
	<style type="text/css">
		th,tr,td,input,textarea,select{
			font-family: 'angsana new';
			font-size: 20px;

		}
	</style>
</head>
<body>
	<?php

$boonpon_id = $_GET['boonpon_id'];

$get_note = getlist("SELECT * FROM insertdata_transport where boonpon_id='$boonpon_id'");
	    if(!empty($_POST['summit']))
	    {
	    	$note = $_POST['note'];
	       
	       	if(!empty($get_note)){
	       		$result = query("UPDATE insertdata_transport SET note='$note' where boonpon_id='".$boonpon_id."'");
	       	}
	        
	        if($result){
	        	 $message = "บันทึกข้อมูลสำเร็จ";
	        }else{
	        	 $message = "ล้มเหลว ไม่สามารถบันทึกข้อมูลได้";
	        }

	             print "<script type='text/javascript'>alert('$message');</script>";
	             print "<script>window.opener.location.reload();</script>";
	             print "<script>window.close();</script>";
	    }

	
	   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
	    print("<table style=\"width:50%;\" align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"2\" style=\"font-size:30px;\">");
	    			$get_driver = getlist("SELECT * FROM driver where id_driver='$driver_id'");
	    			print("เพิ่มหมายเหตุ <br>");
	    			
	    		print("</td>");
	    	print("</tr>");

	    	print("<tr style=\"text-align:center;\">");
	    	print("<td>");
	    		print("<b>หมายเหตุ</b>");
	    		print("</td>");
	    		print("<td>");
	            $_POST['note'] = empty($_POST['note']) ? $get_note[0]['note'] : $_POST['note'];
	    				print("<textarea name = \"note\" value = \"\" style=\"width:300px;resize: none !important;height:30mm;\" >");
								print($_POST['note']);
						print("</textarea>");
	    		print("</td>");
	    	print("</tr>");

	    	print("<tr style=\"text-align:center;\">");
	    		print("<td style=\"text-align:center;\" colspan=\"2\">");

	    			print("<br><input type=\"submit\" name=\"summit\" value=\"ตกลง\" style=\"width:120px;cursor:pointer\">");
	    			print("</td>");
	    	print("</tr>");

	    print("</table>");
	    print("</form>");


	?>

</body>
</html>