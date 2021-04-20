<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"

xmlns="http://www.w3.org/TR/REC-html40">

<?php 
    session_start();
    include("../include/mySqlFunc.php");
    query("USE transport");
    require_once 'Classes/PHPExcel.php';
    include 'Classes/PHPExcel/Writer/Excel2007.php';

 query("SET character_set_results=tis620");
            query("SET character_set_client='tis620'");
            query("SET character_set_connection='tis620'");
            query("collation_connection = tis620_thai_ci");
            query("collation_database = tis620_thai_ci");
            query("collation_server = tis620_thai_ci");    
            set_time_limit(10);  

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
/*$s=0;
// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex($s);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Something');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Name of Sheet 1');

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Second sheet');
*/
$name = $arrayName = array('MDF','PB','Flooring','บัว','เฟอร์นิเจอร์');
for ($i=0; $i < sizeof($name); $i++) { 
    $objPHPExcel->setActiveSheetIndex($i);
    headdetail();
    $objPHPExcel->getActiveSheet()->setTitle($name[$i]);
    if(!empty($name[$i+1]))
    {
        $objPHPExcel->createSheet();
    }
}

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="name_of_file.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

   function headdetail(){
    print("<TABLE  x:str BORDER=\"1\">");
        print("<tr>");
                    print("<td align = \"center\" rowspan=\"2\" style = \"width:10mm;\" class=\"head_table\" >");
                        print("ที่");
                    print("</td>");
                    print("<td align = \"center\" rowspan=\"2\" style = \"width:20mm;\" class=\"head_table\" >");
                        print("เลขที่ใบสั่ง (ขาย / โอน) ");
                    print("</td>");
                    print("<td align = \"center\" rowspan=\"2\" style = \"width:20mm;\" class=\"head_table\" >");
                        print("เลขที่ใบโอน/ส่งของ ใบกำกับภาษี");
                    print("</td>");
                    
                    print("<td align = \"center\" rowspan=\"2\" style = \"width:30mm;\" class=\"head_table\" >");
                        print("รายการสินค้า");
                    print("</td>");
                    
                    print("<td align = \"center\" rowspan=\"2\" style = \"width:30mm;\" class=\"head_table\" >");
                        print("ชื่อลูกค้า");
                    print("</td>");
                    print("<td align = \"center\" colspan=\"3\" style = \"width:30mm;\" class=\"head_table\" >");
                        print("จำนวน");
                    print("</td>");
                    print("<td align = \"center\" rowspan=\"2\" style = \"width:10mm;\" class=\"head_table\" >");
                        print("ล็อคไม้");
                    print("</td>");
                    print("<td align = \"center\" rowspan=\"2\" style = \"width:30mm;\" class=\"head_table\" >");
                        print("สถานที่จัดส่ง");
                    print("</td>");
                    print("<td align = \"center\" colspan=\"2\" style = \"width:30mm;\" class=\"head_table\" >");
                        print("บรรทุกโดย");
                    print("</td>");
                    print("<td align = \"center\" rowspan=\"2\" style = \"width:20mm;\" class=\"head_table\" >");
                        print("หมายเหตุ");
                    print("</td>");
                print("<tr>");
                    print("<td align =\"center\" style = \"width:10mm;\" class=\"head_table\">ตั้ง</td> ");
                    print("<td align =\"center\" style = \"width:10mm;\" class=\"head_table\">แผ่น</td> ");
                    print("<td align =\"center\" style = \"width:10mm;\" class=\"head_table\">เศษ</td>");
                    print("<td align =\"center\" style = \"width:15mm;\" class=\"head_table\">พขร.</td> ");
                    print("<td align =\"center\" style = \"width:15mm;\" class=\"head_table\">ทะเบียน</td>");
                print("</tr>");
        print("</table>");
        } 
        ?>