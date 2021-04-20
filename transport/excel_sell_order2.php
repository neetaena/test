<?php
@ini_set('display_errors', '0');
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="Report_Sell_Order.xls"');#ชื่อไฟล์
include("../include/mySqlFunc.php");
    query("USE transport");
            query("SET character_set_results=tis620");
            query("SET character_set_client='tis620'");
            query("SET character_set_connection='tis620'");
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
        $start = $_POST['date_start'];
        $end = $_POST['date_end'];
function head($wood){ 
    global $start,$end;
    ?>
<table  bgcolor = "#FFFFFF" border = "0" cellspacing = "0" cellpadding = "2" align = "center" valign = "middle" style="width:250mm;empty-cells: show;">
            <tr>
                <td colspan="14" align = "center" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;"><b>
                <?php   $wood=iconv("tis-620", "utf-8", $wood);
                print("บริษัท วนชัย กรุ๊ป จำกัด (มหาชน)<br>รายการใบสั่งขาย$wood รอจัดส่งสินค้าให้กับลูกค้า<br>"); 
                    print("ระหว่างวันที่ ".printShortThaiDate($start)." ถึง ".printShortThaiDate($end))?>
                </td>
            </tr>
        
            <tr>
                <td colspan="14" align = "left" style = "width:30mm;empty-cells: show;font-family:angsana new;font-size:20px;"><b>
                    <?php
                        print "";
                    ?>
                </td>
            </tr>
        </table>
    <?php
}
    function headdetail(){
    print("<TABLE  x:str BORDER=\"1\">");
    print("<tr >");
            print("<td class=\"head_table\">");
                    print("วันที่ส่งลูกค้า");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("วันออกเอกสาร");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("กำหนดวันส่ง");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("ลูกค้า");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("สถานที่จัดส่ง");
                print("</td>");
                
                print("<td class=\"head_table\">");
                    print("จังหวัด");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("เลขที่ใบสั่งขาย");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("ราคา");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("รายละเอียด");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("แผ่น");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("ตั้ง");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("ม.<sup>3");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("ชื่อ Sell");
                print("</td>");
                print("<td class=\"head_table\">");
                    print("หมายเหตุ");
                print("</td>");
            print("</tr>");
        }


            $get_type = getlist("SELECT * FROM another_data WHERE type='2'");
    for ($ty=0; $ty <sizeof($get_type) ; $ty++) 
    {
               
                $where_data ="";
                $code_item = explode(",", $get_type[$ty]['product']);
                for ($c=0; $c < sizeof($code_item); $c++) { 
                    if(empty($where_data))
                    {
                        $where_data = " item_number like '".$code_item[$c]."' and delivery_date between '$start' and '$end'";
                    }else{
                        $where_data .= " or item_number like '".$code_item[$c]."' and delivery_date between '$start' and '$end'";
                    }
                }

            $count = 1;
            $getdata1 = getlist("SELECT * FROM production_order WHERE $where_data GROUP BY number order by delivery_date asc");
            if(!empty($getdata1))
        {
            head($get_type[$ty]['size_code']);
            headdetail();
            for($i=0;$i<sizeof($getdata1);$i++)
            {
                $m = 1;
                $get_new = getlist("SELECT * FROM production_order WHERE number ='".$getdata1[$i]['number']."'");

                for ($g=0; $g < sizeof($get_new); $g++) 
                { 
                    if($m==1)
                    {
                
                print("<tr>");
                print("<td style=\"width:15mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                    print printShortNumDate($get_new[$g]['delivery_date']); //วันกำหนดส่ง
                print("</td>");
                print("<td style=\"width:15mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                    //print $get_new[$g]['item_number']; //เลขที่ใบสั่งขาย
                    print printShortNumDate($get_new[$g]['crate_date']); //เลขที่ใบสั่งขาย
                    //print $get_new[$g]['delivery_date']; //ทดสอบ
                print("</td>");
                print("<td style=\"width:15mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                    //print $get_new[$g]['delivery_date']; //วันกำหนดส่ง
                    print printShortNumDate($get_new[$g]['delivery_date']);
                print("</td>");
                print("<td style=\"width:30mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                    $get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$get_new[$g]['name']."'");
                    $get_customer_name[0]['namecustomer']=iconv("tis-620", "utf-8", $get_customer_name[0]['namecustomer']);
                    print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
                print("</td>");
                print("<td style=\"width:30mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                        $get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$get_new[$g]['delivery_name']."'");
                        $get_delivery_name[0]['detailship']=iconv("tis-620", "utf-8", $get_delivery_name[0]['detailship']);
                    print $get_delivery_name[0]['detailship'];//สถานที่จัดส่ง
                print("</td>");
               
                print("<td style=\"width:10mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                $get_new[$g]['country']=iconv("tis-620", "utf-8", $get_new[$g]['country']);
                    print $get_new[$g]['country']; //วันกำหนดส่ง
                print("</td>");
                print("<td style=\"width:10mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                    print $get_new[$g]['number']; //เลขที่ใบสั่งขาย
                print("</td>");
                 print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
                    print("");
                print("</td>");
                print("<td style=\"width:30mm;\" class=\"body_table\">");
                    query("USE productionax");
                        $query_description = getlist("SELECT * from itemdescription where itemID ='".$get_new[$g]['item_number']."'");    
                        $query_description[0]['detail']=iconv("tis-620", "utf-8", $query_description[0]['detail']);              
                                    print $query_description[0]['detail'];//รายการ
                    query("USE transport");
                print("</td>");
                print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
                    print ABS($get_new[$g]['quantity']);//แผ่น
                print("</td>");
                print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
                        $tung = 0;
                        $count_num_item = utf8_strlen($get_new[$g]['item_number']);
                        if($count_num_item==19)
                        {

                            $MB = strpos($get_new[$g]['item_number'], "MB");
                            $PB = strpos($get_new[$g]['item_number'], "PB");
                            if($MB !== FALSE)//ไม้บัว
                            {
                                $code = substr($get_new[$g]['item_number'], 7,4);
                                $get_code = getlist("SELECT * FROM another_data WHERE product='MB'");
                                for ($t=0; $t < sizeof($get_code); $t++) 
                                {
                                        if($code==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                }
                            }else if($PB !== FALSE)//ไม้พื้น
                            {
                                $code = substr($get_new[$g]['item_number'], 7,4);
                                $get_code = getlist("SELECT * FROM another_data WHERE product='PB'");
                                for ($t=0; $t < sizeof($get_code); $t++) { 
                                    if($code==$get_code[$t]['size_code'])
                                    {
                                        $tung = $get_code[$t]['tung'];
                                    }
                                }
                            }else{
                                print "";
                            }

                        }else if($count_num_item==15){
                            $PM = strpos($get_new[$g]['item_number'], "PM");
                            $PP = strpos($get_new[$g]['item_number'], "PP");
                            $LM = strpos($get_new[$g]['item_number'], "LM");
                            $LP = strpos($get_new[$g]['item_number'], "LP");
                            if($PM !== FALSE || $PP !== FALSE)//ไม้บัว
                            {
                                
                                $get_code = getlist("SELECT * FROM another_data WHERE product='PM'");

                                for ($t=0; $t < sizeof($get_code); $t++) 
                                {
                                    $count_code = utf8_strlen($get_code[$t]['size_code']);
                                    $code = substr($get_new[$g]['item_number'], 4,$count_code);
                                        if($code==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                }
                            }else if($LM !== FALSE || $LP !== FALSE)//ไม้พื้น
                            {
                                $get_code = getlist("SELECT * FROM another_data WHERE product='LM'");
                                for ($t=0; $t < sizeof($get_code); $t++) 
                                {
                                    $count_code = utf8_strlen($get_code[$t]['size_code']);
                                    $code = substr($get_new[$g]['item_number'], 4,$count_code);
                                        if($code==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                }
                            }else{
                                print "";
                            }

                        }else if($count_num_item==20){
                            //$data1 = substr($get_new[$g]['item_number'], 3,2);
                            $bj = strpos($get_new[$g]['item_number'], "BJ");
                            $fl = substr_compare ($get_new[$g]['item_number'], "F", 0, 2 );
                            if($bj !== FALSE)//ไม้บัว
                            {
                                $code = substr($get_new[$g]['item_number'], 3,5);
                                $code2 = substr($get_new[$g]['item_number'], 3,7);//เฉพาะ SN301-1
                                $get_code = getlist("SELECT * FROM another_data WHERE product='BJ'");
                                for ($t=0; $t < sizeof($get_code); $t++) {
                                    if($get_code[$t]['size_code'] !="SN301-1")
                                    {
                                        if($code==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                    }else
                                    {
                                        if($code2==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                    }
                                    
                                }
                            }else if($fl !== FALSE)//ไม้พื้น
                            {
                                $item = substr($get_new[$g]['item_number'], 0,2);
                                $code = substr($get_new[$g]['item_number'], 3,6);
                                $get_code = getlist("SELECT * FROM another_data WHERE product='".$item."'");
                                for ($t=0; $t < sizeof($get_code); $t++) { 
                                    if($code==$get_code[$t]['size_code'])
                                    {
                                        $tung = $get_code[$t]['tung'];
                                    }
                                }
                            }else{
                                print "";
                            }
                            
                            //$data1 = substr($get_new[$g]['item_number'], 7,2);
                        }
                        if(!empty($tung))
                        {
                            $total = ABS($get_new[$g]['quantity'])/$tung;
                        }else{
                            $total = 0;
                        }
                        
                        print number_format($total,1) ;
                    
                    
                    //

                print("</td>");
                print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
                    if($get_type[$ty]['tung'] == '1' || $get_type[$ty]['tung'] == '2'){
                        $s1 = substr($get_new[$g]['item_number'],7,4);
                        $s2 = substr($get_new[$g]['item_number'],11,4);
                        $s3 = substr($get_new[$g]['item_number'],15,4);
                        //print $s1.$s2.$s3; 
                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '5'");
                        $query2=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s2' AND orderby_pb = '6'");
                        $query3=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s3' AND orderby_pb = '7'");
                        $num_query = $query1[0]['data_detail']*$query2[0]['data_detail']*$query3[0]['data_detail'];
                        $q = ($num_query/1000000000)*ABS($get_new[$g]['quantity']);
                /*---------------------------- calculator Q MDF---------------------------*/
                /*---------------------------- calculator Q ปิดผิวกระดาษ1---------------------------*/
                    }elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '3'){
                        $s1 = substr($get_new[$g]['item_number'],4,5);
                        //print $s1;
                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
                        $numget=explode("x",$query1[0]['data_detail']);
                        $num_query =$numget[0]*$numget[1]*$numget[2];
                        $q = ($num_query/1000000000)*ABS($get_new[$g]['quantity']);
                /*---------------------------- calculator Q ไม้พื้น1---------------------------*/
                    }elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '4'){
                        $s1 = substr($get_new[$g]['item_number'],3,6);

                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
                        $numget=explode("x",$query1[0]['data_detail']);
                        $num_query =$numget[1]*$numget[2];
                        if($s1=='089205')
                        {
                                $box = ABS($get_new[$g]['quantity'])/8;
                                $q = ($num_query/1000000)*$box*8;
                        }else if($s1=='129305' || $s1=='122505' || $s1=='129005'){
                            $box = ABS($get_new[$g]['quantity'])/7;
                            $q = ($num_query/1000000)*$box*7;
                        }
                        else if($s1=='122510'){
                            $box = ABS($get_new[$g]['quantity'])/16;
                            $q = ($num_query/1000000)*$box*16;
                        }
                        else if($s1=='129805'){
                            $box = ABS($get_new[$g]['quantity'])/5;
                            $q = ($num_query/1000000)*$box*5;
                        }
                        else if($s1=='082060' || $s1=='0820000'){
                            $box =ABS($get_new[$g]['quantity'])/1;
                            $q = ($num_query/1000000)*$box*1;
                        }
                /*---------------------------- calculator Q ปิดผิวเฟอร์นิเจอร์1---------------------------*/
                    }elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '5'){
                        $s1 = substr($get_new[$g]['item_number'],4,5);
                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
                        $numget=explode("x",$query1[0]['data_detail']);
                        $num_query =$numget[0]*$numget[1]*$numget[2];
                        $q = ($num_query/1000000000)*$get_new[$g]['quantity'];
                /*---------------------------- calculator Q ไม้บัว1---------------------------*/
                    }elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '6'){
                        $s1 = substr($get_new[$g]['item_number'],8,5);
                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
                        $numget=explode("x",$query1[0]['data_detail']);
                        $num_query =$numget[0]*$numget[1]*$numget[2];
                        $q = ($num_query/1000000000)*$get_new[$g]['quantity'];
                        $q = Null;//ไม้บัวไม่มีการคิดคิว
                    }

        print number_format($q,2);
                print("</td>");

                print("<td style=\"width:15mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                 $get_new[$g]['sell_name']=iconv("tis-620", "utf-8", $get_new[$g]['sell_name']);             
                    print($get_new[$g]['sell_name']);
                print("</td>");

                print("<td style=\"width:30mm;\" class=\"body_table\" rowspan=\"".sizeof($get_new)."\">");
                 
                $get_delivery_note[0]['detailship']=iconv("tis-620", "utf-8", $get_delivery_note[0]['detailship']);
               $note1 = strpos($get_delivery_name[0]['detailship'],"บาร์โค๊ต");
               $note2 = strpos($get_delivery_name[0]['detailship'],"ชั่วคราว");
               $note3 = strpos($get_delivery_name[0]['detailship'],"ไม้หมอน");
                $note4 = strpos($get_delivery_name[0]['detailship'],"พร้อม");
                
                
               if($note1 !== FALSE || $note2 !== FALSE || $note3 !== FALSE || $note4 !== FALSE)
               {
                   print($get_delivery_name[0]['detailship']);
                }else
                 {
                     print("");
                 }
               
                print("</td>");
            print("</tr>");
                
                        $m=0;
                    }else//------------------------------------------------------else----------------------------------------------------
                    {
                        print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
                            print("");
                        print("</td>");
                         print("<td style=\"width:30mm;\" class=\"body_table\">");
                    query("USE productionax");
                        $query_description = getlist("SELECT * from itemdescription where itemID ='".$get_new[$g]['item_number']."'");    
                        $query_description[0]['detail']=iconv("tis-620", "utf-8", $query_description[0]['detail']);              
                                    print $query_description[0]['detail'];//รายการ
                    query("USE transport");
                print("</td>");
                print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
                    print ABS($get_new[$g]['quantity']);//แผ่น
                print("</td>");
                print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
                        $tung = 0;
                        $count_num_item = utf8_strlen($get_new[$g]['item_number']);
                        if($count_num_item==19)
                        {

                            $MB = strpos($get_new[$g]['item_number'], "MB");
                            $PB = strpos($get_new[$g]['item_number'], "PB");
                            if($MB !== FALSE)//ไม้บัว
                            {
                                $code = substr($get_new[$g]['item_number'], 7,4);
                                $get_code = getlist("SELECT * FROM another_data WHERE product='MB'");
                                for ($t=0; $t < sizeof($get_code); $t++) 
                                {
                                        if($code==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                }
                            }else if($PB !== FALSE)//ไม้พื้น
                            {
                                $code = substr($get_new[$g]['item_number'], 7,4);
                                $get_code = getlist("SELECT * FROM another_data WHERE product='PB'");
                                for ($t=0; $t < sizeof($get_code); $t++) { 
                                    if($code==$get_code[$t]['size_code'])
                                    {
                                        $tung = $get_code[$t]['tung'];
                                    }
                                }
                            }else{
                                print "";
                            }

                        }else if($count_num_item==15){
                            $PM = strpos($get_new[$g]['item_number'], "PM");
                            $PP = strpos($get_new[$g]['item_number'], "PP");
                            $LM = strpos($get_new[$g]['item_number'], "LM");
                            $LP = strpos($get_new[$g]['item_number'], "LP");
                            if($PM !== FALSE || $PP !== FALSE)//ไม้บัว
                            {
                                
                                $get_code = getlist("SELECT * FROM another_data WHERE product='PM'");

                                for ($t=0; $t < sizeof($get_code); $t++) 
                                {
                                    $count_code = utf8_strlen($get_code[$t]['size_code']);
                                    $code = substr($get_new[$g]['item_number'], 4,$count_code);
                                        if($code==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                }
                            }else if($LM !== FALSE || $LP !== FALSE)//ไม้พื้น
                            {
                                $get_code = getlist("SELECT * FROM another_data WHERE product='LM'");
                                for ($t=0; $t < sizeof($get_code); $t++) 
                                {
                                    $count_code = utf8_strlen($get_code[$t]['size_code']);
                                    $code = substr($get_new[$g]['item_number'], 4,$count_code);
                                        if($code==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                }
                            }else{
                                print "";
                            }

                        }else if($count_num_item==20){
                            //$data1 = substr($get_new[$g]['item_number'], 3,2);
                            $bj = strpos($get_new[$g]['item_number'], "BJ");
                            $fl = substr_compare ($get_new[$g]['item_number'], "F", 0, 2 );
                            if($bj !== FALSE)//ไม้บัว
                            {
                                $code = substr($get_new[$g]['item_number'], 3,5);
                                $code2 = substr($get_new[$g]['item_number'], 3,7);//เฉพาะ SN301-1
                                $get_code = getlist("SELECT * FROM another_data WHERE product='BJ'");
                                for ($t=0; $t < sizeof($get_code); $t++) {
                                    if($get_code[$t]['size_code'] !="SN301-1")
                                    {
                                        if($code==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                    }else
                                    {
                                        if($code2==$get_code[$t]['size_code'])
                                        {
                                            $tung = $get_code[$t]['tung'];
                                        }
                                    }
                                    
                                }
                            }else if($fl !== FALSE)//ไม้พื้น
                            {
                                $item = substr($get_new[$g]['item_number'], 0,2);
                                $code = substr($get_new[$g]['item_number'], 3,6);
                                $get_code = getlist("SELECT * FROM another_data WHERE product='".$item."'");
                                for ($t=0; $t < sizeof($get_code); $t++) { 
                                    if($code==$get_code[$t]['size_code'])
                                    {
                                        $tung = $get_code[$t]['tung'];
                                    }
                                }
                            }else{
                                print "";
                            }
                            
                            //$data1 = substr($get_new[$g]['item_number'], 7,2);
                        }
                        if(!empty($tung))
                        {
                            $total = ABS($get_new[$g]['quantity'])/$tung;
                        }else{
                            $total = 0;
                        }
                        
                        print number_format($total,1) ;
                    
                    
                    //

                print("</td>");
                print("<td style=\"width:10mm;text-align:center;\" class=\"body_table\">");
                    if($get_type[$ty]['tung'] == '1' || $get_type[$ty]['tung'] == '2'){
                        $s1 = substr($get_new[$g]['item_number'],7,4);
                        $s2 = substr($get_new[$g]['item_number'],11,4);
                        $s3 = substr($get_new[$g]['item_number'],15,4);
                        //print $s1.$s2.$s3; 
                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '5'");
                        $query2=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s2' AND orderby_pb = '6'");
                        $query3=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s3' AND orderby_pb = '7'");
                        $num_query = $query1[0]['data_detail']*$query2[0]['data_detail']*$query3[0]['data_detail'];
                        $q = ($num_query/1000000000)*ABS($get_new[$g]['quantity']);
                /*---------------------------- calculator Q MDF---------------------------*/
                /*---------------------------- calculator Q ปิดผิวกระดาษ1---------------------------*/
                    }elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '3'){
                        $s1 = substr($get_new[$g]['item_number'],4,5);
                        //print $s1;
                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
                        $numget=explode("x",$query1[0]['data_detail']);
                        $num_query =$numget[0]*$numget[1]*$numget[2];
                        $q = ($num_query/1000000000)*ABS($get_new[$g]['quantity']);
                /*---------------------------- calculator Q ไม้พื้น1---------------------------*/
                    }elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '4'){
                        $s1 = substr($get_new[$g]['item_number'],3,6);

                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
                        $numget=explode("x",$query1[0]['data_detail']);
                        $num_query =$numget[1]*$numget[2];
                        if($s1=='089205')
                        {
                                $box = ABS($get_new[$g]['quantity'])/8;
                                $q = ($num_query/1000000)*$box*8;
                        }else if($s1=='129305' || $s1=='122505' || $s1=='129005'){
                            $box = ABS($get_new[$g]['quantity'])/7;
                            $q = ($num_query/1000000)*$box*7;
                        }
                        else if($s1=='122510'){
                            $box = ABS($get_new[$g]['quantity'])/16;
                            $q = ($num_query/1000000)*$box*16;
                        }
                        else if($s1=='129805'){
                            $box = ABS($get_new[$g]['quantity'])/5;
                            $q = ($num_query/1000000)*$box*5;
                        }
                        else if($s1=='082060' || $s1=='0820000'){
                            $box =ABS($get_new[$g]['quantity'])/1;
                            $q = ($num_query/1000000)*$box*1;
                        }
                /*---------------------------- calculator Q ปิดผิวเฟอร์นิเจอร์1---------------------------*/
                    }elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '5'){
                        $s1 = substr($get_new[$g]['item_number'],4,5);
                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
                        $numget=explode("x",$query1[0]['data_detail']);
                        $num_query =$numget[0]*$numget[1]*$numget[2];
                        $q = ($num_query/1000000000)*$get_new[$g]['quantity'];
                /*---------------------------- calculator Q ไม้บัว1---------------------------*/
                    }elseif(!empty($get_type[$ty]['tung']) AND $get_type[$ty]['tung'] == '6'){
                        $s1 = substr($get_new[$g]['item_number'],8,5);
                        $query1=getlist("SELECT * FROM type_production_detail WHERE id_production = '".$get_type[$ty]['tung']."' AND code_detail = '$s1' AND orderby_pb = '3'");
                        $numget=explode("x",$query1[0]['data_detail']);
                        $num_query =$numget[0]*$numget[1]*$numget[2];
                        $q = ($num_query/1000000000)*$get_new[$g]['quantity'];
                        $q = Null;//ไม้บัวไม่มีการคิดคิว
                    }

                    print number_format($q,2);
                        print("</td>");
                         print("</tr>");
                    }

                    
                }
            }
        }
    }
    
    ?>

            
            </table>    

</BODY>

</HTML>
 