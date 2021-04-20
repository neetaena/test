<?php
    @session_start();
    error_reporting (E_ALL ^ E_NOTICE);
    include("../../include/mySqlFunc.php");
    query("USE transport");
?>
<!DOCTYPE html>
<html>
<head>
   
    <script type="text/javascript" src="../datetimepicker/jquery.js"></script>
    <link rel="stylesheet" type = "text/css" href = "../datetimepicker/jquery.datetimepicker.css">
    <script type="text/javascript" src="../datetimepicker/jquery.datetimepicker.js"></script>
    <style type="text/css">
        th,tr,td,input,textarea,select{
            font-family: 'angsana new';
            font-size: 20px;

        }
        .head_form{
            text-align: center;
            font-size: 25px;
        }
    </style>
</head>
<body>
               
<?php
$available_date = empty($_GET['available_date']) ? date('Y-m-d') : $_GET['available_date'];

if(!empty($_POST['submit_min'])){
    $available_date = $_POST['available_date'];
    $car_type = $_POST['car_type'];
    $available_number = $_POST['available_number'];
    $available_id = $_POST['available_id'];
    $repair_number = $_POST['repair_number'];
    $note = $_POST['note'];
    $total = $_POST['total'];
    $stop_employee = $_POST['stop_employee'];
    $out_employee = $_POST['out_employee'];
    for ($i=0; $i < sizeof($car_type); $i++) { 

        if(!empty($available_id[$i])){
            $sql = query("UPDATE car_available SET available_date='".$available_date."',car_type='".$car_type[$i]."',available_number='".$available_number[$i]."',repair_number='".$repair_number[$i]."',note='".$note[$i]."',total='".$total[$i]."',out_employee='".$out_employee[$i]."',stop_employee='".$stop_employee[$i]."' where available_id='".$available_id[$i]."'");
        }else{
            $sql = query("INSERT INTO car_available SET available_date='".$available_date."',car_type='".$car_type[$i]."',available_number='".$available_number[$i]."',repair_number='".$repair_number[$i]."',note='".$note[$i]."',total='".$total[$i]."',out_employee='".$out_employee[$i]."',stop_employee='".$stop_employee[$i]."'");
           
        }
    }
    

      
       if(!empty($sql)){
        $message = "บันทึกสำเร็จ";
         print "<script type='text/javascript'>alert('$message');</script>";
         print "<script>window.opener.location.reload();</script>";
         print "<script>window.close();</script>";
        }else{
            $message = "ล้มเหลว";
             print "<script type='text/javascript'>alert('$message');</script>";
        }
    }


print("<div class=\"head_form\">เพิ่ม / แก้ไข ข้อมูลรถพร้อมใช้งาน บุญพร-สระบุรี</div>");
print("<form action = \"\" name = \"insert_data\" method = \"POST\">");
print("<table align=\"center\" style=\"width : 80%;\">");
        $get_item = getlist("SELECT * FROM car_available where available_date='$available_date'");

        $get_item[0]['available_date'] = empty($get_item[0]['available_date']) ? date('Y-m-d') : $get_item[0]['available_date'];
        $_POST['available_date'] = empty($_POST['available_date']) ? $get_item[0]['available_date']:$_POST['available_date'];
   



     print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>วันที่</label>");
            print("</td >");
            print("<td  class=\"td_searchform\" colspan='4'>");
              
                
                print("<input type = \"date\" name =\"available_date\" value=\"".$_POST['available_date']."\" style='width:65%;' >");
 
            print("</td >");
     print("</tr>");


        print("<tr class=\"searh_report\" style='text-align:center;font-weight: bold;'>");
               print("<td  class=\"td_searchform\" rowspan='2'>");
                print("<label>ประเภทรถ</label>");
            print("</td >");
             print("<td  class=\"td_searchform\" rowspan='2'>");
                    print("<label>เชื้อเพลิง</label>");
                print("</td >");
                 print("<td  class=\"td_searchform\" rowspan='2'>");
                    print("<label>พร้อมใช้งาน</label>");
                print("</td >");
                 print("<td  class=\"td_searchform\" rowspan='2'>");
                    print("<label>ที่ซ่อม</label>");
                print("</td >");
                print("<td  class=\"td_searchform\" rowspan='2'>");
                    print("<label>รวม(คัน)</label>");
                print("</td >");
                print("<td  class=\"td_searchform\" colspan='2'>");
                    print("<label>ไม่มีคนขับ</label>");
                print("</td >");
                 print("<td  class=\"td_searchform\" rowspan='2'>");
                    print("<label>หมายเหตุ</label>");
                print("</td >");
        print("</tr>");
        print("<tr class=\"searh_report\" style='text-align:center;font-weight: bold;'>");
                 print("<td  class=\"td_searchform\" >");
                    print("<label>ลาออก</label>");
                print("</td >");
                 print("<td  class=\"td_searchform\" >");
                    print("<label>หยุดงาน</label>");
                print("</td >");
        print("</tr>");
     $type = getlist("SELECT * FROM car_type_available ");
     for ($i=0; $i < sizeof($type); $i++) { 

        $_POST['car_type'][$i] = empty($_POST['car_type'][$i]) ? $get_item[$i]['car_type']:$_POST['car_type'][$i];
        $_POST['available_number'][$i] = empty($_POST['available_number'][$i]) ? $get_item[$i]['available_number']:$_POST['available_number'][$i];
        $_POST['repair_number'][$i] = empty($_POST['repair_number'][$i]) ? $get_item[$i]['repair_number']:$_POST['repair_number'][$i];
        $_POST['total'][$i] = empty($_POST['total'][$i]) ? $get_item[$i]['total']:$_POST['total'][$i];
        $_POST['out_employee'][$i] = empty($_POST['out_employee'][$i]) ? $get_item[$i]['out_employee']:$_POST['out_employee'][$i];
        $_POST['stop_employee'][$i] = empty($_POST['stop_employee'][$i]) ? $get_item[$i]['stop_employee']:$_POST['stop_employee'][$i];

          print("<tr class=\"searh_report\">");
            print("<td  class=\"td_searchform\"  style='width:20%;'>");
                print("<input type = \"hidden\" name =\"available_id[]\" value=\"".$get_item[$i]['available_id']."\" style='width:10%;' >");
                print("<input type = \"hidden\" name =\"car_type[]\" value=\"".$type[$i]['car_type_id']."\" style='width:5%;' >");
                print("<input type = \"text\" name =\"detailhcar[]\" value=\"".$type[$i]['car_type_name']."\" style='width:100%;' readonly>");
                
            print("</td >");
             print("<td  class=\"td_searchform\" style='width:10%;'>");
             print("<input type = \"text\" name =\"car_type_fule[]\" value=\"".$type[$i]['car_type_fule']."\" style='width:95%;text-align:center;' readonly>");
               print("</td >");
   
           
                print("<td  class=\"td_searchform\" style='width:16%;'>");
                  
                    print("<input type = \"text\" name =\"available_number[]\" value=\"".$_POST['available_number'][$i]."\" style='width:95%;text-align:center;' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
     
                print("</td >");
                 print("<td  class=\"td_searchform\" style='width:10%;'>");
                  
                    print("<input type = \"text\" name =\"repair_number[]\" value=\"".$_POST['repair_number'][$i]."\" style='width:95%;text-align:center;' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
     
                print("</td >");
                 print("<td  class=\"td_searchform\" style='width:10%;'>");
                  $total = $_POST['available_number'][$i]+$_POST['repair_number'][$i];
                    print("<input type = \"text\" name =\"total[]\" value=\"".$total."\" style='width:95%;text-align:center;' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" readonly>");
     
                print("</td >");
               

                print("<td  class=\"td_searchform\" style='width:10%;'>");
                  
                    print("<input type = \"text\" name =\"out_employee[]\" value=\"".$_POST['out_employee'][$i]."\" style='width:95%;' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
     
                print("</td >");
                print("<td  class=\"td_searchform\" style='width:10%;'>");
                  
                    print("<input type = \"text\" name =\"stop_employee[]\" value=\"".$_POST['stop_employee'][$i]."\" style='width:95%;' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
     
                print("</td >");
                 print("<td  class=\"td_searchform\" style='width:20%;'>");
                  
                    print("<input type = \"text\" name =\"note[]\" value=\"".$_POST['note'][$i]."\" style='width:95%;' onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\">");
     
                print("</td >");
         print("</tr>");

     }

    

        print("<script type=\"text/javascript\">
                         jQuery('.date').datetimepicker({
                         timepicker:false,
                         format:'Y-m-d'
                         });
                 </script>");
        print("<tr  class=\"searh_report\">");
            print("<td colspan=\"8\" style=\"text-align: center; padding-top: 10px;\">");
                print("<input  type = \"submit\" name = \"submit_min\" value = \"ตกลง\" style=\"width: 200px;\" >");    
                print("<br><label style=\"color:red;text-align:center;\">*กรุณาตรวจสอบข้อมูลให้ถุกต้องก่อนที่จะลงข้อมูล</label>");
            print("</td >");
        print("</tr>");

    print("</table>");              
print("</form>");

?>