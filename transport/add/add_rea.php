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
                if ((vchar<'0' || vchar>'9') && (vchar != '.') && (vchar != 'x')) return false;
                ele.onKeyPress=vchar;
            }   
</script>
<?php
@session_start();
    error_reporting (E_ALL ^ E_NOTICE);
    include("../../include/mySqlFunc.php");
    date_default_timezone_set("Asia/Bangkok");
    query("USE transport");
    $get_ream_id = $_GET['ream_id'];
    $get_ream  = getlist("SELECT * FROM ream_asset where ream_id='$get_ream_id'");
    if(!empty($_POST['summit']))
    {
        $date_ream = $_POST['date_ream'];
        $place_id = $_POST['place_id'];
        $list_select = $_POST['list_select'];
        $quantity = $_POST['quantity'];
        $unit = $_POST['unit'];
        $date_time =  date("Y-m-d H:i:s");
        $asset_id = $_POST['asset_id'];
        $datejuarnal = explode("-", $date_ream);
                        $datejn = "";
                        for ($j=0; $j < sizeof($datejuarnal); $j++) { 
                            $datejn .= $datejuarnal[$j];
                        }
                        $rest = substr($datejn, 2, 8);//ตัดปี 2017 ให้เป็น 17 เฉยๆ
                        $juarnal = getlist("SELECT * FROM ream_asset where ream_id like '$rest%' order by asset_id desc");
                        if(!empty($juarnal))
                        {
                            $n4 = $juarnal[0]['ream_id']+1; //คือค่าเลขใบเบิกตัวถัดไป
                        }else{
                            $n4 = $rest."001";
                        }
                           
        for ($i=0; $i < sizeof($list_select); $i++) { 
             if(!empty($list_select[$i])){
                if(empty($get_ream)){
                      query("INSERT INTO ream_asset SET license_name='$place_id',ream_id='$n4',ream_date='$date_ream',list_data='$list_select[$i]',quantity='$quantity[$i]',unit='$unit[$i]',create_date_time='$date_time'");

                  }else{
                    query("UPDATE ream_asset SET license_name='$place_id',ream_id='$n4',ream_date='$date_ream',list_data='$list_select[$i]',quantity='$quantity[$i]',unit='$unit[$i]',create_date_time='$date_time' WHERE asset_id='".$asset_id[$i]."'");
                  }

              
             }
        }
          $message = "แก้ไขข้อมูลสำเร็จ";
                    
                   print "<script type='text/javascript'>alert('$message');</script>";
                   print "<script>window.opener.location.reload();</script>";
       

    }

   print("<form action = \"\" name = \"import_data\" method = \"POST\">");
    print("<table style=\"width:70%;\" align=\"center\">");
    	print("<tr style=\"text-align:center;\">");
    		print("<td colspan=\"2\" style=\"font-size:25px !important;\">");
    			print("บันทึกการเบิก<br>");
    		print("</td>");
    	print("</tr>");

        print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("วันที่");
            print("</td>");
            print("<td>");
            $new_date = empty($get_ream[0]['ream_date']) ? date('Y-m-d') : $get_ream[0]['ream_date'];
            $_POST['date_ream'] = empty($_POST['date_ream']) ? $new_date: $_POST['date_ream'];
                     print("<input type='date' name='date_ream' value='".$_POST['date_ream']."' style=\"width:50mm;height:7mm;\"  required>");
            print("</td>");
        print("</tr>");
    	
        print("<tr style=\"text-align:center;\">");
        print("<td>");
            print("ทะเบียน");
            print("</td>");
            print("<td>");
            $_POST['place_id'] = empty($_POST['place_id']) ? $get_ream[0]['license_name']:$_POST['place_id'];
                print("<input type = \"text\" name = \"place_id\" id=\"place_id\" value = \"".$_POST['place_id']."\" style = \"width:50mm;height:7mm;empty-cells: show;font-family:angsana new;font-size:25px;\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" onchange = \"this.form.submit();\" required>");
               print("<input type = \"hidden\" name = \"license_plate\"  id = \"namedriver\" value = \"".$_POST['license_plate']."\" >");
            print("</td>");
        print("</tr>");

     print("</table>");

     $list_data = array("หัวสเตย์","สายสเตย์","ผ้าใบ","ไม้หมอนยาว","ไม้หมอนสั้น","เสื้อสะท้อนแสง","กรวยสะท้อนแสง","หมวกเซฟตี้");
     print("<table style=\"width:70%;\" align=\"center\">");
        print("<tr style=\"text-align:center;\">");
            print("<td>");
                print("รายการ");
            print("</td>");
            print("<td>");
                print("จำนวน");
            print("</td>");
            print("<td>");
                print("หน่วย");
            print("</td>");
        print("</tr>");
        $num = isset($get_ream) ? sizeof($get_ream) : 5;
        for ($i=0; $i < $num; $i++) { 

            $_POST['list_select'][$i] = empty($_POST['list_select'][$i]) ? $get_ream[$i]['list_data'] : $_POST['list_select'][$i];
            $_POST['quantity'][$i] = empty($_POST['quantity'][$i]) ? $get_ream[$i]['quantity'] : $_POST['quantity'][$i];
            $_POST['unit'][$i] = empty($_POST['unit'][$i]) ? $get_ream[$i]['unit'] : $_POST['unit'][$i];
            print("<tr style=\"text-align:center;\">");
                print("<td>");
                    print("<select name = \"list_select[]\" style = \"width:300px;height:8mm;\" class=\"text_fide\" >");
                            print("<option value=''></option>");
                                for($k=0;$k<sizeof($list_data);$k++){
                                    $selected = $_POST['list_select'][$i] == $list_data[$k] ? "selected=\"selected\"" : "";
                                    print("<option value = \"".$list_data[$k]."\"".$selected.">".$list_data[$k]."</option>");
                                }
                        print("</select>");
                print("</td>");
                print("<td>");
                     print("<input type='text' name = \"quantity[]\" value = \"".$_POST['quantity'][$i]."\" style='height:8mm;' OnKeyPress=\"return chkNumber(this)\">");
                print("</td>");
                print("<td>");
                     print("<input type='text' name = \"unit[]\" value = \"".$_POST['unit'][$i]."\" style='height:8mm;'>");
                     print("<input type='hidden' name = \"asset_id[]\" value = \"".$get_ream[$i]['asset_id']."\" style='height:8mm;'>");
                print("</td>");
            print("</tr>");

        }
            
            print("<tr style=\"text-align:center;\">");
                print("<td style=\"text-align:center;\" colspan=\"3\">");

                    print("<br><input type=\"submit\" name=\"summit\" value=\"ตกลง\" style=\"width:120px;cursor:pointer\">");
                    print("</td>");
            print("</tr>");
     print("</table>");

    print("</form>");
?>
            <script type="text/javascript">
                        function make_autocom2(autoObj,showObj){
                        var mkAutoObj=autoObj;
                        var mkSerValObj=showObj;
                        new Autocomplete(mkAutoObj, function() {
                        this.setValue = function(id) {     
                            document.getElementById(mkSerValObj).value = id;
                        }
                        if ( this.isModified )
                            this.setValue("");
                            if ( this.value.length < 1 && this.isNotClick )
                                return ;   
                                return "../autoComplete/get_license.php?&q=" +encodeURIComponent(this.value);
                            });
                        }
                        make_autocom2("place_id","namedriver");
                    </script>