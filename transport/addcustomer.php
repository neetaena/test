<?php
include("../include/mySqlFunc.php");
	query("USE transport");
	if(!empty($_POST['summit'])){
	//print_r($_POST);
	 $a = query("INSERT INTO customer SET  namecustomer = '".trim($_POST['namecustomer'])."'
					,address = '".trim($_POST['address'])."'
					,phonenumber= '".trim($_POST['phonenumber'])."'
					,status = '1'");

		if($a){
			$message = "บันทึกข้อมูลสำเร็จ";
		}else{
			 $message = "ล้มเหลว ไม่สามารถบันทึกข้อมูลได้";
	        }

	             print "<script type='text/javascript'>alert('$message');</script>";
	             print "<script>window.opener.location.reload();</script>";
	            // print "<script>window.close();</script>";
		
	}
	
?>
<html >
<body bgcolor= "FFFFFF">
	<center><font color="#000000" face="angsana new"><h1><b>เพิ่มข้อมูลลูกค้า</b></h1></center></font><br>
	<form action = "" name = "insertquarity" method = "POST">
	    <table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:140mm;empty-cells: show;">
			<tr>
				<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:26px;">
					<b>ชื่อลูกค้า</b>
				</td>
				<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:26px;">
        		<input type="text" name="namecustomer" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:20px;" required="">
	    
				</td>
			</tr>
			<tr>
				<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:26px;">
					<b>ที่อยู่</b>
				</td>
				<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:20px;">
					<textarea name="address" style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:20px;resize: none;" required></textarea>
				</td>
			</tr>
			<tr>
				<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:26px;">
					<b>เบอร์โทรศัพท์</b>
				</td>
				<td align = "center" style = "width:70mm;empty-cells: show;font-family:angsana new;font-size:26px;">
					<input type="text" name="phonenumber"style = "width:80mm;empty-cells: show;font-family:angsana new;font-size:20px;">
				</td>
			</tr>
				<td colspan = "2" align = "center" style = "width:200mm;empty-cells: show;font-family:angsana new;font-size:22px;"><br>
					<input type="submit" name="summit" value = "ยืนยัน" style = "width:40mm;empty-cells: show;font-family:angsana new;font-size:20px;">
					<br>
				</td>
		    </tr>
	</form>

</body>	   
</html>
			
			
			
			
			

 



