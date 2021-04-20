
<?php

require_once('fpdf/fpdf.php');
require_once('fpdf/Fpdi.php');
define('FPDF_FONTPATH','fpdf/font/');
  @session_start();
    date_default_timezone_set("Asia/Bangkok");
    include("../../include/mySqlFunc.php");
    query("USE transport");
       $id_ship = $_GET['id_ship'];

    $data_pdf = getlist("SELECT * FROM shipping where id_ship='$id_ship'");
    $file ="file/".iconv("utf-8", "tis-620",$data_pdf[0]['file_data']);
     if(!empty($_POST['out'])){
         print "<script>window.close();</script>";
         //print "<script> open(location, '_self').close();</script>";
          
      }
    print("<form action=\"\" name=\"import_data\" method=\"POST\" enctype=\"multipart/form-data\" accept-charset=\"utf-8\" style='text-align:center;margin-top:20px;'>");
  print("<input type=\"submit\" name=\"out\" value=\"ออก\" class=\"btn btn-primary\" style='width: 20%;font-size: 24px;cursor:pointer'>");
  print("</form>");
//$file = $data_pdf[0]['path']."/".$data_pdf[0]['filename'];

    function getNumPagesPdf($filepath) {
        $fp = @fopen(preg_replace("/\[(.*?)\]/i", "", $filepath), "r");
        $max = 0;
        if (!$fp) {
            return "Could not open file: $filepath";
        } else {
            while (!@feof($fp)) {
                $line = @fgets($fp, 255);
                if (preg_match('/\/Count [0-9]+/', $line, $matches)) {
                    preg_match('/[0-9]+/', $matches[0], $matches2);
                    if ($max < $matches2[0]) {
                        $max = trim($matches2[0]);
                        break;
                    }
                }
            }
            @fclose($fp);
        }

        return $max;
    }


try {
  $pagecount = getNumPagesPdf($file);
  // initiate FPDI

  $pdf = new FPDI();
 $pdf->setSourceFile($file);
  $pdf->AddFont('angsa','','angsa.php');
  $pdf->SetFont('angsa','',13);
  $pdf->SetTitle($data_pdf[0]['file_data'],true);
  $counter = 1;
while ( $counter <= $pagecount) {
  // add a page
  $pdf->AddPage();
  $tplIdx = $pdf->importPage($counter);
  $pdf->useTemplate($tplIdx, -5, 0, 213);//ระยะของการแสดงเนื้อหา FIle (ซ้ายขวา,สูงต่ำ,ซูมเข้าออก)
  $pdf->SetTextColor(255, 0, 0);//สีของตัวอักษร
  $pdf->SetXY(8, 2);//รัยะของตัวอักษร
  //$pdf->MultiCell( 195  , 4,iconv( 'UTF-8','TIS-620','เอกสารที่พิมพ์ออกจากไฟล์นี้เป็นเอกสารฉบับไม่ควบคุม เอกสารฉบับทางการและปัจจุบันจะอยู่ในรูปแบบไฟล์อิเล็กทรอนิกส์ ซึ่งสามารถตรวจสอบได้ จากระบบเครือข่ายสารสนเทศ ของศูนย์ควบคุมเอกสารกลางของบริษัทฯ ห้ามแจกจ่ายเอกสารนี้ไปยังภายนอก โดยไม่ได้รับอนุญาตจาก QMR ก่อน'),0,'C','');

  $counter++;
}
$pdf->Output();
}catch( Exception $e ){
    
     $data_pdf = getlist("SELECT * FROM shipping where id_ship='$id_ship'");
     // print ("http://my-vngs.com/main/pr/".$data_pdf[0]['pdf_path']."/".$data_pdf[0]['pdf_name']);
      print("<iframe  src=\"https://my-vngs.com/main/transport/file/".$data_pdf[0]['file_data']."\" style=\"width:100%; height:100%;\" frameborder=\"0\"></iframe>");

}



//เอกสารฉบับนี้เป็นเอกสารฉบับไม่ควบคุม เอกสารฉบับทางการจะอยู่ในรูปแบบไฟล์อิเลคทรอนิคส์และเป็นปัจจุบัน ซึ่งสามารถตรวจสอบได้จากระบบเครือข่ายสารสนเทศของศูนย์ควบคุมเอกสารกลางของบริษัท ห้ามแจกจ่ายเอกสารนี้ไปยังภายนอก โดยไม่ได้รับอนุญาติจาก QMR ก่อน

        
 
      //print("<iframe id=\"printable\" src=\"http://docs.google.com/gview?url=http://182.52.104.34/main/hr/".$data_pdf[0]['path']."/".$data_pdf[0]['filename']."&embedded=true\" style=\"width:100%; height:100%;\" frameborder=\"0\"></iframe>");
print("<form action=\"\" name=\"import_data\" method=\"POST\" enctype=\"multipart/form-data\" accept-charset=\"utf-8\" style='text-align:center;margin-top:20px;'>");

if(strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile')){
         
      }else{
        print("<input type=\"submit\" name=\"out\" value=\"ออก\" class=\"btn btn-primary\" style='width: 20%;font-size: 24px;'>");
      }
print("</form>");
  ?>
