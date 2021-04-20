<?php
@ini_set('display_errors', '0');
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="ใบส่งของชั่วคราว.xls"');#ชื่อไฟล์
include("../include/mySqlFunc.php");
include 'function.php';
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
        table, tr, td {
            font-family:angsana new;
            font-size: 16px;
             border-collapse: collapse;
        }
        .table_bo{
            margin-right: 50px;
            float: right;
             font-family:angsana new;
        }
    </style>
</HEAD><BODY>
<?php 

    $date = $_GET['datedata'];
    //$getdata2 = getlist("SELECT * FROM  production_order where number ='".$_GET['id']."'");
    $warehouse_id = $_GET['warehouse_id'];
    $getdata2 = getlist("SELECT * FROM  production_order where warehouse_id ='".$_GET['warehouse_id']."' and delivery_date='$date'");
    $get_number = getlist("SELECT * from production_order as po inner join type_production as tp on product_id=id_production  where warehouse_id ='".$getdata2[0]['warehouse_id']."' and delivery_date='$date'  group by invoice");

    $get_transaction = getlist("SELECT * from insertdata_transport where boonpon_id = '".$getdata2[0]['boonpon_id']."'");
?>

<?php  
    function head($getdata)
    {
        Global $get_transaction;
 ?>
<div style="font-size: 20px;font-weight:  bold;text-align: center;font-family:angsana new;margin-top: 5px;">บริษัท วนชัย กรุ๊ป จำกัด (มหาชน)</div>
<div style="font-size: 20px;font-weight: bold;text-align: center;font-family:angsana new;">ใบส่งของชั่วคราว</div>

<table  align="center" style="width: 180mm;border: 0px groove !important" border="0">

<tr style="border: 0px;">
<td colspan="5" style="border: 0px groove;text-align: right;font-size: 18px;">
        <?php 
        
            print("เลขที่ ");
                $n =0;
                $te =array();
                    for ($t=0; $t < sizeof($getdata); $t++) { 
                        $result = data_in_array($getdata[$t]['invoice'],$te);
                        if(empty($result)){
                            array_push($te, $getdata[$t]['invoice']);
                        }
                    }
                    $te = array_unique($te);

                for($y=0;$y<sizeof($te);$y++)
                {
                    if($n==0)
                    {
                        print $te[$y]; //รายการสินค้า
                        $n=1;
                    }else
                    {
                        $new = substr($te[$y], 8,12);
                        print(" - ".$new);
                    }
                    
                }
            $date_now = date('Y-m-d');
            print "<br>วันที่ ".printShortThaiDateAndYear($getdata[0]['delivery_date']);?>
    </td>   
</tr>
</table>


<table  align="center" style="width: 180mm;" cellspacing = "0" cellpadding = "0">

<tr >
    <td colspan="3" class="border_temporary" style="height: 22mm;font-size: 18px;border:1px groove">
        <?php 
    $get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata[0]['name']."'");
                    //print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
            print("<b>ลูกค้า</b> ".$get_customer_name[0]['namecustomer']."<br>");
            print("<b>ที่อยู่</b>  ".$get_customer_name[0]['address']);
        ?>
    </td>
    <td colspan="2" class="border_temporary" style="font-size: 18px;border:1px groove">
        <?php 
            $get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata[0]['delivery_name']."'");
            
                    //print $get_delivery_name[0]['detailship'];//สถานที่จัดส่ง
            print("<b>สถานที่ส่งมอบ </b> ".$get_delivery_name[0]['detailship']." ".$get_delivery_name[0]['country']);
            print("<br><b>เลขที่ PO </b> ".$getdata[0]['po_number']);
        ?>
    </td>
</tr>
<tr>
    <td style="text-align: center;border:1px groove">
        <?php
        print("<b>การขนส่ง</b><br>");
        print("&emsp;");
        ?>
    </td>
    <td style="text-align: center;border:1px groove">
        <?php
        print("<b>ทะเบียนรถ</b><br>");
        $getcar = getlist("SELECT * from car_detail where id_car = '".$get_transaction[0]['idcar']."'");
                                if($getcar[0]['typecar'] == 2 ){
                                    print "".$getcar[0]['licenceplates']."/";
                                    print $getcar[0]['licenceplate2'];
                                }else{
                                    
                                    print $getcar[0]['licenceplates'];
                                }
        
        ?>
    </td>
    <td style="text-align: center;border:1px groove">
        <?php
        $getdriver = getlist("select * from driver where id_driver = '".$get_transaction[0]['nameDriver']."'");
        print("<b>ผู้ขับรถ</b>");
        print "<br>".$getdriver[0]['namedriver1'];
        ?>
    </td>
    <td style="text-align: center;border:1px groove">
        <?php
        print("<b>พนักงานตรวจสินค้า<b><br>");
        print("&emsp;");
        ?>
    </td>
    <td style="text-align: center;border:1px groove">
        <?php
        print("<b>พนักงานจ่ายสินค้า</b><br>");
        print("&emsp;");
        ?>
    </td>
</tr>
<tr>
    <td style="text-align: center;border:1px groove">
        <?php
        print("<b>ลำดับ</b>");
        ?>
    </td>
    
    <td colspan="2" style="text-align: center;border:1px groove">
        <?php
        print("<b>ชื่อสินค้า</b>");
        ?>
    </td>
    <td style="text-align: center;border:1px groove">
                <?php
                    print("<b>ปริมาณ</b>");
                    ?>
    </td>
    <td style="text-align: center;border:1px groove">
        <?php
        print("<b>หน่วย</b>");
        ?>
    </td>

</tr>
<?php 
}



for($n=0;$n<sizeof($get_number);$n++)
{
    $quality = 0;
    $count = 1;
    $getdata = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production  where invoice ='".$get_number[$n]['invoice']."' and delivery_date='$date'");
        head($getdata);
        for($i=0;$i<sizeof($getdata);$i++)
        {
        ?>
        <tr >
            <td style="text-align: center;height: 6mm;border-left: 1px groove">
                <?php
                print($i+1);
                ?>
            </td>
            
            <td colspan="2" style="border-right: 1px groove;">
                <?php
                            
                                   show_description_for_temporary($getdata[$i]['id_order'],$getdata[$i]['product_id']);
                        
                            ?>
            </td>
            <td style="text-align: center;border-right: 1px groove;">
                    <?php
                   $box = array(4,11,12,17,19,20,8,18,9,22,23,24);
                    $line = array(6,7,13,15,16);
                    if(in_array($getdata[$i]['product_id'], $box)){
                        print(number_format(ABS($getdata[$i]['counts'])) );
                        $quality += $getdata[$i]['counts'];
                    }else{
                        print(number_format(ABS($getdata[$i]['quantity'])) );
                        $quality += $getdata[$i]['quantity'];
                    }
                
                ?>  
            </td>
            <td style="text-align: center;border-right: 1px groove">
                    <?php
                  if(in_array($getdata[$i]['product_id'], $box)){
                        print("กล่อง");
                    }elseif (in_array($getdata[$i]['product_id'], $line)) {
                        print("เส้น");
                    }else{
                        print("แผ่น");
                    }
                
                ?>  
            </td>

        </tr>
        <?php 
                $count ++;
               

        }
                for($k=$count;$k<=6;$k++)
                {
                ?>
                <tr style="height: 6mm;">
                    <td style="text-align: center;border-left: 1px groove">
                        &emsp;
                    </td>
                    
                    <td colspan="2" style="border-right: 1px groove;">
                    &emsp;
                    </td>
                    <td style="text-align: center;border-right: 1px groove;">
                    &emsp;
                    </td>
                    <td style="text-align: center;border-right: 1px groove">
                        &emsp;
                    </td>

                </tr>
                <?php
                }
                ?>
        <tr>
            <td colspan="5" style="border:1px groove">
                <?php
                print("<b>กำหนดส่งมอบวันที่</b>  ".printShortThaiDateAndYear($getdata[0]['delivery_date']));
                print("&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>รวม</b>&emsp;&emsp;&emsp;&emsp;");
                
                 if(in_array($getdata[0]['product_id'], $box)){
                        print("<b>".number_format(ABS($quality)) ."   &emsp;&emsp;&emsp; กล่อง</b>");
                    }elseif (in_array($getdata[0]['product_id'], $line)) {
                        print("<b>".number_format(ABS($quality)) ."   &emsp;&emsp;&emsp; เส้น</b>");
                    }else{
                       print("<b>".number_format(ABS($quality)) ."   &emsp;&emsp;&emsp; แผ่น</b>");
                    }
                ?>
            </td>

        </tr>
        <tr>
            <td colspan="5" style="border:1px groove">
                <?php
                print("<br>");
                print("&emsp;&emsp;&emsp;&emsp;&emsp;");
                print("&emsp;&emsp;");
                print("<br>");
                print("&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ผู้รับสินค้า&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;");
                print("ผู้ออกเอกสาร&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;");
                print("ผู้อนุมัติ<br>");
                print("&emsp;&emsp;&emsp;&emsp;&emsp;วันที่ ......../......../........&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;");
                print("วันที่ ......../......../........&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;");
                print("วันที่ ......../......../........<br>");
                ?>
            </td>
            
    </tr>
</table>

    <?php 
        if(!empty($get_number[$n+1]['num']))
        {
            print("<div style=\"page-break-before:always;page-break-after:always;\"></div>");
        }
    } 



?>
            </table>    

</BODY>

</HTML>
 