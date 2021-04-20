
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript" src = "../autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="../autoComplete/autocomplete.css"  type="text/css"/>
<script type="text/javascript">
			$(function() {
				$(".search_license").autocomplete({
					source: 'autoComplete/get_license_check.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วยนะ
					minLength: 2,
					
				});
			});

			$(function() {
				$(".search_driver").autocomplete({
					source: 'autoComplete/get_driver_check.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
					minLength: 2,
					
				});
			});
</script>
<style type="text/css">
	.input_data{
		width:50mm;
		
		empty-cells: show;
		font-family:angsana new;
		font-size:22px;
	}
	.input_data2{
		width:90mm;
		
		empty-cells: show;
		font-family:angsana new;
		font-size:22px;
	}
	.text_fide{
		empty-cells: show;
		font-family:angsana new;
		font-size:22px;
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
	<body bgcolor= "FFFFFF">
	<center><font color="#000000" face = "angsana new"><h1><b>ฟอร์มการตรวจสอบของเหลวและอื่นๆ</b></h1></center></font>
	
<?php
	query("USE transport");
	include 'part_liquid.php';
?>
 
<script type="text/javascript">
					 $('.datetimeout').datetimepicker({
					 timepicker:false,
					 format:'Y-m-d'
					 });
			 </script>