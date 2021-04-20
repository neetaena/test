<?php
	@session_start();
	error_reporting (E_ALL ^ E_NOTICE);
	include("../../include/mySqlFunc.php");
	query("USE transport");
?>
<!DOCTYPE html>
<html>
<head>
	<title>เพิ่มข้อมูลเบี้ยเลี้ยง</title>
	<style type="text/css">
		th,tr,td,input,textarea,select{
			font-family: 'angsana new';
			font-size: 20px;

		}

		.wheight-px{
			width: 100%;
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
<script type="text/javascript" src = "../../autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="../../autoComplete/autocomplete.css"  type="text/css"/>
</head>
<body>
	<?php
	
	    if(!empty($_POST['summit']))
	    {
	       

	        //ข้อมูลชุดที่ 3
	        $id_ship = $_POST['Sendlocation']
	        $id_car = $_POST['id_car'];
	        $money1 = $_POST['money1'];
	        $money2 = $_POST['money2'];



	        for ($j=0; $j < sizeof($id_car); $j++) { 
	     
	        		$check_data_allowance = getlist("SELECT * FROM allowance WHERE id_ship='$id_ship' and typecar='".$id_car[$j]."'");
		        	if(!empty($check_data_allowance)){
		        		query("UPDATE allowance SET dis_1='".$money1[$j]."',dis_2='".$money2[$j]."' WHERE id_allowance='".$check_data_allowance[0]['id_allowance']."'");
		        	}else{
		        		if(!empty($money1[$j]) || !empty($money2[$j])){
		        			query("INSERT INTO allowance SET id_ship='$id_ship',typecar='".$id_car[$j]."',dis_1='".$money1[$j]."',dis_2='".$money2[$j]."' ");
		        		}
		        	}
	        	
	        }

	            $message = "บันทึกข้อมูลสำเร็จ";
	             print "<script type='text/javascript'>alert('$message');</script>";
	             print "<script>window.opener.location.reload();</script>";
	            // print "<script>window.close();</script>";

	    }
	   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
	    print("<table  align=\"center\" border='0'>");
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td colspan=\"3\" style=\"font-size:35px;\">");
	    			print("เพิ่มข้อมูลเบี้ยเลี้ยง<br>");
	    		print("</td>");
	    	print("</tr>");
	    	?>

			<tr>
				<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;">
					<b> สถานที่จัดส่ง</b>
				</td>
				<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:24px;" colspan="2">
					<input type = "text" name = "place_id"  id = "place_id" value = "<?php print $_POST['place_id'];?>"  style = "width:70mm;height:10mm;empty-cells: show;font-family:angsana new;font-size:22px;" onchange = "this.form.submit();">
					<input type = "hidden" name = "Sendlocation"  id = "Sendlocation" value = "<?php print $_POST['Sendlocation'];?>">
		        </td>
			</tr>
		<script type="text/javascript">
						function make_autocom2(autoObj,showObj){
						var mkAutoObj=autoObj;
						var mkSerValObj=showObj;
						new Autocomplete(mkAutoObj, function() {
						this.setValue = function(id) {     
							document.getElementById(mkSerValObj).value = id;
						}
						if ( this.isModified )
							this.setValue("");
							if ( this.value.length < 1 && this.isNotClick )
								return ;   
								return "../autoComplete/gdata2.php?&q=" +encodeURIComponent(this.value);
							});
						}
						make_autocom2("place_id","Sendlocation");
					</script>
	    	<?php

	  		print("<tr style=\"text-align:center;\">");
		        print("<td >");
		            print("<b>ประเภทรถ</b>");
		        print("</td>");
		        print("<td>");
		            print("<b>เที่ยว 1</b>");
		        print("</td>");
		        print("<td>");
		            print("<b>เที่ยว 2</b>");
		        print("</td>");
		    print("</tr>");

		    $get_type = getlist("SELECT * FROM car_head WHERE type_user='1'");
		    for ($t=0; $t < sizeof($get_type); $t++) { 
		    	print("<tr style=\"text-align:center;\">");
			        print("<td >");
			            print("<input type='text' name = \"detailhcar[]\" value = \"".$get_type[$t]['detailhcar']."\" readonly style='padding-left: 5px;'>");
			            print("<input type='hidden' name = \"id_car[]\" value = \"".$get_type[$t]['id_hcar']."\" >");
			           
			        print("</td>");
			        print("<td>");
			            print("<input type='text' name = \"money1[]\" value = \"".$_POST['money1'][$t]."\" class='wheight-px' OnKeyPress=\"return chkNumber(this)\">");
			        print("</td>");
			        print("<td>");
			           print("<input type='text' name = \"money2[]\" value = \"".$_POST['money2'][$t]."\" class='wheight-px' OnKeyPress=\"return chkNumber(this)\">");
			        print("</td>");
		    	print("</tr>");
		    }
		    

   
	        
	    	print("<tr style=\"text-align:center;\">");
	    		print("<td style=\"text-align:center;\" colspan=\"5\">");

	    			print("<br><input type=\"submit\" name=\"summit\" value=\"ตกลง\" style=\"width:120px;cursor:pointer\">");
	    			print("</td>");
	    	print("</tr>");

	    print("</table>");
	    print("</form>");


	?>

</body>
</html>