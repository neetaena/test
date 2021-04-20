<html>
<head>
	<title>แก้ไขข้อมูลคนขับรถ</title>
		<link href = "assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
		<style type="text/css">
			.head_form{
				font-size: 20px;
				text-align: center;
			}
		</style>
</head>
<body style="background-color: #d1d4d8;">
<?php 
@ini_set('display_errors', '0');
include("../include/mySqlFunc.php");
query("USE transport");


     function calculate_age($birthday){
        $today = date("Y-m-d");   //จุดต้องเปลี่ยน
        list($byear, $bmonth, $bday)= explode("-",$birthday);       //จุดต้องเปลี่ยน
        list($tyear, $tmonth, $tday)= explode("-",$today);                //จุดต้องเปลี่ยน
        $mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear); 
        $mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear );
        $mage = ($mnow - $mbirthday);


        $u_y=date("Y", $mage)-1970;
        $u_m=date("m",$mage)-1;
        $u_d=date("d",$mage)-1;

        $show[0] = !empty($u_y) ? "$u_y   ปี" : "";
        $show[1] = !empty($u_m) ? "$u_m   เดือน" : "";
        $show[2] = !empty($u_d) ? "$u_d   วัน" : "";
        $age ="";
        for ($s=0; $s < sizeof($show); $s++) { 
              if(!empty($show[$s]))
                  {
                      if(empty($age))
                      {
                          $age =   $show[$s];
                      }else{
                          $age .= " ".$show[$s];
                      }
                  }
        }
        
        return $age;
    }

$id_driver = $_GET['iddriver'];
$get_driver = getlist("SELECT * FROM driver where id_driver='$id_driver'");
if(!empty($_POST['submit_min'])){
    $namedriver1 = $_POST['namedriver1'];
    $personalid = $_POST['personalid'];
    $licence_driver = $_POST['licence_driver'];
    $type_driver = $_POST['type_driver'];
    $date_last = $_POST['date_last'];
    $birthday = $_POST['birthday'];
    $start_day = $_POST['start_day'];
    $date_out = $_POST['date_out'];
    $status = $_POST['status'];

       $sql =   query("UPDATE driver SET namedriver1='$namedriver1',personalid='$personalid',licence_driver='$licence_driver',type_driver='$type_driver',date_last='$date_last',birthday='$birthday',start_day='$start_day',date_out='$date_out',status='$status'  where id_driver='$id_driver'");
                  
                            $path = "image_person";
                            /*for($i=0;$i<sizeof($data);$i++)
                            {
                                if(!empty($data[$i]))
                                {
                                    $path .= "/".iconv("utf-8", "tis-620",$data[$i]);
                                    $path1 .= "/".$data[$i];
                                }
                            }*/
                            
                            
                            $target_file = $path ."/".$_FILES["fileToUpload"]["name"];//อ่านชื่อไฟล์
                            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);//หานามสกุลไฟล์ โดยแบ่งออกเป็น 3 อาเรย์ 1 dirname = path , basename =name+type file
                            if(!@mkdir($path,0,true)){ //เป็นการตรวจสอบ folder ว่ามีหรือไม่ถ้ามีจะเข้าไปที่ if ที่เป็นจริง ถ้าไม่มีระบบจะสร้าง folder ให้และกระโดดไปทำงาน ที่ else

                            }
                            $check_name_file = getlist("SELECT * FROM image_person WHERE image_name='".$_FILES["fileToUpload"]["name"][$img]."'");
                            if(sizeof($check_name_file)==0)
                            {
                                //print $_FILES["fileToUpload"]["tmp_name"][$img];
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                                {
                                
                                    $check_image = getlist("SELECT * FROM image_person WHERE driver_id='$id_driver'");
                                    if(empty($check_image)){
                                        query("INSERT INTO image_person SET image_name='".$_FILES["fileToUpload"]["name"]."',image_path='".$path."',driver_id='$id_driver'");
                                    }else{
                                        query("UPDATE image_person SET image_name='".$_FILES["fileToUpload"]["name"]."',image_path='".$path."',driver_id='$id_driver' WHERE image_id='".$check_image[0]['image_id']."'");
                                    }
                                    
                          
                                  $message = "อัพโหลดสำเร็จ.";              
                                } else {
                                    $message = "ไม่สามารถอัพโหลดไฟลืได้";
                                    //print "<script type='text/javascript'>alert('$message');</script>";
                                }

                                }else{
                                    $message = "ชื่อไฟล์นี้มีการอัพโหลดเข้ามาแล้ว หากต้องการัพโหลดไฟล์นี้กรุณาเปลี่ยนชื่อไฟล์";
                                        
                                }
                            
       if(!empty($sql)){
        $message = "บันทึกสำเร็จ";
         print "<script type='text/javascript'>alert('$message');</script>";
         print "<script>window.opener.location.reload();</script>";
           //  print "<script>window.close();</script>";
        }else{
            $message = "ล้มเหลว";
             print "<script type='text/javascript'>alert('$message');</script>";
        }

}
print("<div class=\"head_form\">แก้ไขข้อมูลคนขับรถ</div>");
print("<form action = \"\" name = \"insert_data\" method = \"POST\" enctype=\"multipart/form-data\" accept-charset=\"utf-8\">");
print("<table align=\"center\" style=\"width : 80%;\">");
        
        $_POST['namedriver1'] = empty($_POST['namedriver1']) ? $get_driver[0]['namedriver1']:$_POST['namedriver1'];
        $_POST['personalid'] = empty($_POST['personalid']) ? $get_driver[0]['personalid']:$_POST['personalid'];
        $_POST['licence_driver'] = empty($_POST['licence_driver']) ? $get_driver[0]['licence_driver']:$_POST['licence_driver'];
        $_POST['type_driver'] = empty($_POST['type_driver']) ? $get_driver[0]['type_driver']:$_POST['type_driver'];
        $_POST['date_last'] = empty($_POST['date_last']) ? $get_driver[0]['date_last']:$_POST['date_last'];
        $_POST['birthday'] = empty($_POST['birthday']) ? $get_driver[0]['birthday']:$_POST['birthday'];
        $_POST['start_day'] = empty($_POST['start_day']) ? $get_driver[0]['start_day']:$_POST['start_day'];
        $_POST['posonal_date'] = empty($_POST['posonal_date']) ? $get_driver[0]['posonal_date']:$_POST['posonal_date'];
        $_POST['status'] = empty($_POST['status']) ? $get_driver[0]['status']:$_POST['status'];


        print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>ชื่อ-นามสกุล</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
                print("<input type='text' name='namedriver1' value='".$_POST['namedriver1']."'>");
            print("</td >");
              print("<td  class=\"td_searchform\" rowspan='8' style='text-align:right'>");
              $get_image = getlist("SELECT * FROM image_person WHERE driver_id='$id_driver'");
                    print("<img src=\"".$get_image[0]['image_path']."/".$get_image[0]['image_name']."\"  height=\"200\" width=\"150\">");
                    print("<br>อายุ : ".calculate_age($get_driver[0]['birthday']));
                    print("<br>อายุงาน :  ".calculate_age($get_driver[0]['start_day']));
                    print("<br><input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" accept=\"image/*\"  >");
           
            print("</td >");
        print("</tr>");

        print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>หมายเลขบัตรประชาชน</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
                print("<input type='text' name='personalid' value='".$_POST['personalid']."'>");
            print("</td >");
           
        print("</tr>");

        print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>วันหมดอายุ</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
                print("<input type='date' name='posonal_date' value='".$_POST['posonal_date']."' class='date' style='width: 199px;'>");
            print("</td >");
        print("</tr>");

        print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>เลขที่ใบอณุญาติ</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
                print("<input type='text' name='licence_driver' value='".$_POST['licence_driver']."'>");
            print("</td >");
        print("</tr>");

        print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>ประเภทใบอนุญาติ</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
                print("<input type='text' name='type_driver' value='".$_POST['type_driver']."'>");
            print("</td >");
        print("</tr>");

        print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>วันหมดอายุ</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
                print("<input type='date' name='date_last' value='".$_POST['date_last']."' class='date' style='width: 199px;'>");
            print("</td >");
        print("</tr>");

        print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>วันเกิด</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
                print("<input type='date' name='birthday' value='".$_POST['birthday']."' class='date' style='width: 199px;'>");
            print("</td >");
        print("</tr>");

        print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>วันเข้างาน</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
                print("<input type='date' name='start_day' value='".$_POST['start_day']."' class='date' style='width: 199px;'>");
            print("</td >");
        print("</tr>");

         print("<tr class=\"searh_report\" >");
            print("<td  class=\"td_searchform\">");
                print("<label>วันที่ออก</label>");
            print("</td >");
            print("<td  class=\"td_searchform\">");
            $status_data = array("1"=>"กำลังทำงาน","0"=>"ออกจากงานแล้ว");
                print("<select name = \"status\"  style='width: 199px;height:10mm;' class=\"text_fide\">");
                                while (list($key, $value) = each($status_data)) {
                                    $selected=$_POST['status']==$key ? "selected=\"selected\"" : "";
                                    print("<option value='$key' ".$selected.">$value</option>");
                                }
                        
                    print("</select>");
            print("<br>");
                print("<input type='date' name='date_out' value='".$_POST['date_out']."' class='date' style='width: 199px;'>");
            print("</td >");
           
        print("</tr>");




     /*   print("<script type=\"text/javascript\">
                         jQuery('.date').datetimepicker({
                         timepicker:false,
                         format:'Y-m-d'
                         });
                 </script>");*/
        print("<tr  class=\"searh_report\">");
            print("<td colspan=\"4\" style=\"text-align: center; padding-top: 10px;\">");
                print("<input  type = \"submit\" name = \"submit_min\" value = \"ตกลง\" style=\"width: 200px;\" >");    
                print("<br><label style=\"color:red;text-align:center;\">*กรุณาตรวจสอบข้อมูลให้ถุกต้องก่อนที่จะลงข้อมูล</label>");
            print("</td >");
        print("</tr>");

    print("</table>");              
print("</form>");


?>

</body>
</html>