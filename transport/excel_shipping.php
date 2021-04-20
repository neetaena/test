<?php
@ini_set('display_errors', '0');
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="Report_Sell_Order.xls"');#ชื่อไฟล์
include("../include/mySqlFunc.php");
    query("USE transport");
                query("SET character_set_results=utf8");
            query("SET character_set_client='utf8'");
            query("SET character_set_connection='utf8'");
            query("collation_connection = tis620_thai_ci");
            query("collation_database = tis620_thai_ci");
            query("collation_server = tis620_thai_ci");    
            set_time_limit(10);  
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"

xmlns="http://www.w3.org/TR/REC-html40">

<HTML>

<HEAD>

<meta http-equiv="Content-type" content="text/html; charset = utf-8" />

</HEAD><BODY>
<?php 
$get_shiiping = getlist("SELECT * FROM shipping");
    print("<TABLE  x:str BORDER=\"1\">");
        print("<tr >");
                print("<td class=\"head_table\">");
                    print("ลำดับ");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("id");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("ชื่อสถานที่จัดส่ง");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("จังหวัด");
                print("</td>");
            print("</tr>");
      for ($i=0; $i < sizeof($get_shiiping); $i++) { 
         print("<tr >");
                print("<td class=\"head_table\">");
                    print($i+1);
                print("</td>");
                print("<td class=\"head_table\">");
                    print($get_shiiping[$i]['id_ship']);
                print("</td>");
                print("<td class=\"head_table\">");
                    print($get_shiiping[$i]['detailship']);
                print("</td>");
                print("<td class=\"head_table\">");
                    print($get_shiiping[$i]['country']);
                print("</td>");
            print("</tr>");
      }
            
             print("</table>");

print("</BODY>");

print("</HTML>");
 