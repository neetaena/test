<?php
@ini_set('display_errors', '0');
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="รายงานการขับรถ.xls"');#ชื่อไฟล์
include("../include/mySqlFunc.php");

    //query("USE transport");
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
      .body-style{
                empty-cells: show;
                font-family:angsana new;
                font-size:16px;
                
            }

            .header-style{
                empty-cells: show;
                font-family:angsana new;
                font-size:16px;
            }

            @media print 
            { 

                .not-show{ display: none !important; } 
        }
</style>
</HEAD><BODY>
<?php
function nextPage()
{        
    print("<div style=\”page-break-before:always;page-break-after:always;\”></div>");
}   
query('USE transport');
include 'report_boonpon2_test_pk.php';
?>
          

</BODY>

</HTML>
 