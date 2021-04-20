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

$driver_id = $_GET['driver_id'];
$note_date = $_GET['note_date'];
$license = $_GET['license'];
if(!empty($license )){
	$get_note = getlist("SELECT * FROM driver_note where  license='$license' and note_date='$note_date' ");
}else{
	$get_note = getlist("SELECT * FROM driver_note where driver_id='$driver_id' and note_date='$note_date' ");
}

	    if(!empty($_POST['summit']))
	    {
	    	$note = $_POST['note'];
	    	$note2 = $_POST['note2'];
	    	$note_new = $note."@#".$note2;
	       
	       	if(!empty($get_note)){
	       		$result = query("UPDATE driver_note SET note_description='$note_new' where note_id='".$get_note[0]['note_id']."'");
	       	}else{
	       		$result = query("INSERT INTO driver_note SET note_description='$note_new',driver_id='$driver_id',note_date='$note_date',license='$license'");
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
	    print("<table style=\"width:70%;\" align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"2\" style=\"font-size:30px;\">");
	    			$get_driver = getlist("SELECT * FROM driver where id_driver='$driver_id'");
	    			print("เพิ่มหมายเหตุ ".printShortSlateThaiDate($note_date)."<br>");
	    			print($get_driver[0]['namedriver1']);
	    		print("</td>");
	    	print("</tr>");

	    	$cut_note = explode("@#",  $get_note[0]['note_description']);
	    	$_POST['note'] = empty($_POST['note']) ? $cut_note[0] : $_POST['note'];
	    	$_POST['note2'] = empty($_POST['note2']) ? $cut_note[1] : $_POST['note2'];



		$note_descripteion = array("ไม่มีงาน","คนขับลา","รถซ่อม","วันหยุด","อื่นๆ");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td>");
	    		print("<b>รายละเอียดหมายเหตุ</b>");
	    		print("</td>");
	    		print("<td>");

	    			print("<select name = \"note\" style = \"width:300px;\" class=\"text_fide\" onchange='this.form.submit();'>");
							print("<option value = '' >เลือกหมายเหตุ</option>");
					
								for($k=0;$k<sizeof($note_descripteion);$k++){
									$selected = $_POST['note'] == $note_descripteion[$k] ? "selected=\"selected\"" : "";
									print("<option value = \"".$note_descripteion[$k]."\"".$selected.">".$note_descripteion[$k]."</option>");
								}
						print("</select>");
					print("</td>");
	    	print("</tr>");
	    	if($_POST['note']=='อื่นๆ' || $_POST['note']=='คนขับลา'){
	    	print("<tr style=\"text-align:center;\">");
	    	print("<td>");
	    		print("<b>เพิ่มเติม</b>");
	    		print("</td>");
	    		print("<td>");
	            
	    				print("<textarea name = \"note2\" value = \"\" style=\"width:300px;resize: none !important;height:30mm;\" required>");
								print($_POST['note2']);
						print("</textarea>");
	    		print("</td>");
	    	print("</tr>");
	    }

	    	print("<tr style=\"text-align:center;\">");
	    		print("<td style=\"text-align:center;\" colspan=\"2\">");

	    			print("<input type=\"submit\" name=\"summit\" value=\"ตกลง\" style=\"width:120px;cursor:pointer\">");
	    			print("</td>");
	    	print("</tr>");

	    print("</table>");
	    print("</form>");
	?>
</body>
</html>