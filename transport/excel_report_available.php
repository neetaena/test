<?php
@ini_set('display_errors', '0');
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="รายงานสรุปรถบุญพร สระบุรี.xls"');#ชื่อไฟล์
include("../include/mySqlFunc.php");

    query("USE transport");
            query("SET character_set_results=utf8");
            query("SET character_set_client='utf8'");
            query("SET character_set_connection='utf8'");
            query("collation_connection = tis620_thai_ci");
            query("collation_database = tis620_thai_ci");
            query("collation_server = tis620_thai_ci");        
            set_time_limit(0);  
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"

xmlns="http://www.w3.org/TR/REC-html40">

<HTML>

<HEAD>

<meta http-equiv="Content-type" content="text/html; charset = utf-8" />
<style type="text/css">
    .head_table{
        empty-cells: show;font-family:angsana new;font-size:14px;
    }

</style>
</HEAD><BODY>
<?php 
$date_data = $_GET['date_data'];
        include('report_available_data.php');
?>

</BODY>

</HTML>
 