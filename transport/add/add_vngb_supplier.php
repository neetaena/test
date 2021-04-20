<link rel="stylesheet" type = "text/css" href = "../datetimepicker/jquery.datetimepicker.css">
            <script type="text/javascript" src="../datetimepicker/jquery.js"></script>
            <script type="text/javascript" src="../datetimepicker/jquery.datetimepicker.js"></script>
             <link href="../assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
             <script type="text/javascript" src = "../../autoComplete/autocomplete.js"></script>
        <link rel="stylesheet" href="../../autoComplete/autocomplete.css"  type="text/css"/>
<script type="text/javascript">
    function chkNumber(ele)
            {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar<'0' || vchar>'9') && (vchar != '+') && (vchar != '-')) return false;
                ele.onKeyPress=vchar;
            }   
</script>
<?php
@session_start();
    error_reporting (E_ALL ^ E_NOTICE);
    include("../../include/mySqlFunc.php");
    date_default_timezone_set("Asia/Bangkok");
    query("USE transport");
    $vngb_id = $_GET['vngb_id'];
    $get_ream  = getlist("SELECT * FROM `supplier_vngb` where vngb_id='$vngb_id'");
    if(!empty($_POST['summit']))
    {
        $supplier_name = $_POST['supplier_name'];
        $average = $_POST['average'];
        $go_vngs = $_POST['go_vngs'];
        $back_vngb = $_POST['back_vngb'];
        $country = $_POST['country'];
        $district = $_POST['district'];
        $average_taylor = $_POST['average_taylor'];

            if(empty($get_ream)){
                      query("INSERT INTO `supplier_vngb` SET supplier_name='$supplier_name',averang='$average',go_vngs='$go_vngs',back_vngb='$back_vngb',country='$country',country='$country',district='$district',average_taylor='$average_taylor'");

            }else{
                    query("UPDATE supplier_vngb SET supplier_name='$supplier_name',averang='$average',go_vngs='$go_vngs',back_vngb='$back_vngb',country='$country',country='$country',district='$district',average_taylor='$average_taylor' where vngb_id='$vngb_id'");
            }
        
          $message = "บันทึกข้อมูลสำเร็จ";
                    
                   print "<script type='text/javascript'>alert('$message');</script>";
                   print "<script>window.opener.location.reload();</script>";
                   print "<script>window.close();</script>";
       

    }

   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
    print("<table style=\"width:70%;\" align=\"center\">");
    	print("<tr style=\"text-align:center;\">");
    		print("<td colspan=\"2\" style=\"font-size:25px !important;\">");
    			print("เพิ่ม / แก้ไข ชื่อลุกค้าบ้านบึง<br>");
    		print("</td>");
    	print("</tr>");

        print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("ชื่อลูกค้าบ้านบึง");
            print("</td>");
            print("<td>");
             $_POST['supplier_name'] = empty($_POST['supplier_name']) ? $get_ream[0]['supplier_name']:$_POST['supplier_name'];
                print("<textarea name = \"supplier_name\" value = \"\" style=\"width:231px;resize: none !important;height:20mm;\" required>");
                                print($_POST['supplier_name']);
                        print("</textarea>");
            print("</td>");
        print("</tr>");

         print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("อำเภอ");
            print("</td>");
            print("<td>");
            $_POST['district'] = empty($_POST['district']) ? $get_ream[0]['district']:$_POST['district'];
                print("<input type = \"text\" name = \"district\" id=\"average\" value = \"".$_POST['district']."\" style = \"width:231px;height:7mm;empty-cells: show;font-family:angsana new;font-size:25px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\"  required>");
            print("</td>");
        print("</tr>");


         print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("จังหวัด");
            print("</td>");
            print("<td>");
            $_POST['country'] = empty($_POST['country']) ? $get_ream[0]['country']:$_POST['country'];
                print("<input type = \"text\" name = \"country\" id=\"country\" value = \"".$_POST['country']."\" style = \"width:231px;height:7mm;empty-cells: show;font-family:angsana new;font-size:25px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\"  required>");
            print("</td>");
        print("</tr>");

         print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("ระยะทาง กลับ บ้านบึง");
            print("</td>");
            print("<td>");
            $_POST['back_vngb'] = empty($_POST['back_vngb']) ? $get_ream[0]['back_vngb']:$_POST['back_vngb'];
                print("<input type = \"text\" name = \"back_vngb\" id=\"back_vngb\" value = \"".$_POST['back_vngb']."\" style = \"width:231px;height:7mm;empty-cells: show;font-family:angsana new;font-size:25px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\"  required>");
            print("</td>");
        print("</tr>");

         print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("ระยะทาง ลูกค้า->สระบุรี");
            print("</td>");
            print("<td>");
            $_POST['go_vngs'] = empty($_POST['go_vngs']) ? $get_ream[0]['go_vngs']:$_POST['go_vngs'];
                print("<input type = \"text\" name = \"go_vngs\" id=\"go_vngs\" value = \"".$_POST['go_vngs']."\" style = \"width:231px;height:7mm;empty-cells: show;font-family:angsana new;font-size:25px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\"  required>");
            print("</td>");
        print("</tr>");

    	
        print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("เพิ่ม / ลด สิบล้อ<t style='color:red'>*</t>");
            print("</td>");
            print("<td>");
            $_POST['average'] = empty($_POST['average']) ? $get_ream[0]['averang']:$_POST['average'];
                print("<input type = \"text\" name = \"average\" id=\"average\" value = \"".$_POST['average']."\" style = \"width:231px;height:7mm;empty-cells: show;font-family:angsana new;font-size:25px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\"  required>");
                print("<br><t style='color:red'>* เช่น +5 หรือ -5</t>");
            print("</td>");
        print("</tr>");

        print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("เพิ่ม / ลด เทเลอร์<t style='color:red'>*</t>");
            print("</td>");
            print("<td>");
            $_POST['average_taylor'] = empty($_POST['average_taylor']) ? $get_ream[0]['average_taylor']:$_POST['average_taylor'];
                print("<input type = \"text\" name = \"average_taylor\" id=\"average_taylor\" value = \"".$_POST['average_taylor']."\" style = \"width:231px;height:7mm;empty-cells: show;font-family:angsana new;font-size:25px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" OnKeyPress=\"return chkNumber(this)\"  required>");
                print("<br><t style='color:red'>* เช่น +5 หรือ -5</t>");
            print("</td>");
        print("</tr>");

         print("<tr style=\"text-align:center;\">");
                print("<td style=\"text-align:center;\" colspan=\"2\">");

                    print("<br><input type=\"submit\" name=\"summit\" value=\"ตกลง\" style=\"width:120px;cursor:pointer\">");
                    print("</td>");
            print("</tr>");

     print("</table>");

        
            
           
     print("</table>");

    print("</form>");
?>
