    <style type="text/css">
        .body_table
        {
            empty-cells: show;font-family:angsana new;font-size:20px;
        }
    </style>
    <link href="assets/font-awesome/css/font-awesome.css" rel = "stylesheet" />
        <div>
        รายงานข้อมูลสถานที่จัดส่ง
    </div>

    <?php
        @session_start();
    @ini_set('display_errors', '0');
    include("../include/mySqlFunc.php");
query("USE transport");
  if(!empty($_POST['reset_data']))
      {
        //$_POST['company']='';
      }
  
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="รายงานการออก PR.xls"');
   
print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");


        
      $today = date('Y-m-d');
      if(empty($_POST['summit_data']))
      {
        
          $query_data =getlist("SELECT * from shipping where statusship = '1'");
      
      }
      elseif (empty($_POST['reset_data']) and !empty($_POST['summit_data'])) 
      {  
 
          $query_data =getlist("SELECT * from shipping where statusship = '1' and detailship like '%".$_POST['search']."%' ");
        
          print("<div class=\"page-a\" style=\"font-size:30px;\"><b>");
          print("<br>ผลลัพธ์จากค้นหา  \"".$_POST['search']."\" <br>");
          print("จำนวนทั้งหมด ".sizeof($query_data)." รายการ");
          print("<b></div>");
        }
        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\">");
                        //print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>ลำดับ</b></td>");
                        //  print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>ชื่อลูกค้าตามใบกำกับ<b></td>");
                          print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>ชื่อสถานที่จัดส่ง<b></td>");
                          print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>อำเภอ<b></td>");
                          print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>จังหวัด<b></td>");
                          //print("<td align = \"left\" style = \"width:35mm;text-align:center;\" class=\"body_table\"><b>เกรด<b></td>");
              print("<td align = \"left\" style = \"width:8%;text-align:center;\" class=\"body_table\"><b>ระยะทาง(Km.)<b></td>");
                          // print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>มาตราฐาน NGV(Kg)<b></td>");
           
             
            /*  print("<td align = \"left\" style = \"width:8%;text-align:center;\" class=\"body_table\"><b>เบี้ยเลี้ยงเที่ยว1(บาท)<b></td>");
              print("<td align = \"left\" style = \"width:8%;text-align:center;\" class=\"body_table\"><b>เบี้ยเลี้ยงเที่ยว2(บาท)<b></td>");*/
             //    print("<td align = \"left\" style = \"width:10%;text-align:center;\" class=\"body_table\"><b>ค่าขนส่งส่วนต่าง<b></td>");

              print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\">รถเทรลเลอร์/พ่วง</td>");
              print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\">รถสิบล้อเปลือย</td>");
              print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\">รถสิบล้อตู้</td>");
                  
                print("</tr>");
              
                for($i=0;$i<sizeof($query_data);$i++)
                {
                  
                  print("<tr class=\"body_table\" style=\"border:1px groove;\">");
                        //print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">".($i+1)."</td>");
                           // print("<td align = \"left\" style = \"width:120mm;padding-left:10px;\" class=\"body_table\">".$query_data[$i]['customer_ship']."</td>");
                            print("<td align = \"left\" style = \"width:120mm;padding-left:10px;\" class=\"body_table\">".$query_data[$i]['detailship']."</td>");
                            print("<td align = \"left\" style = \"width:120mm;padding-left:10px;\" class=\"body_table\">".$query_data[$i]['district']."</td>");
                            print("<td align = \"left\" style = \"width:120mm;padding-left:10px;\" class=\"body_table\">".$query_data[$i]['country']."</td>");
                            //print("<td align = \"left\" style = \"width:35mm;text-align:center;\" class=\"body_table\">".$query_data[$i]['grade']."</td>");
                  print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">".$query_data[$i]['distanct']);
                  if($query_data[$i]['edit_status']==1){
                     print(" <i class=\"fa fa-star\" aria-hidden=\"true\" style='color: red;' title='แก้ไขแล้ว'></i>");
                  }

                  print("</td>");
                 
                 $data =  array(2,3,4 );
                 for ($l=0; $l < sizeof($data); $l++) { 
                   $check_data = getlist("SELECT * FROM fule_detail as f inner join car_head as c on f.car_type=c.id_hcar where id_ship='".$query_data[$i]['id_ship']."' and fule_name='ดีเซล' and car_type='".$data[$l]."'");
                    print("<td align = \"left\" style = \"width:10mm;padding-left:7px;\" class=\"body_table\">");//มาตราฐาน(ลิตร)
                      print($check_data[0]['standard']);
                    print("</td>");
                 }
                  


                  
                print("</tr>");
                }
              print("</table>");


      
        ?>
