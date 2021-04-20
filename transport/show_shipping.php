	<style type="text/css">
		.body_table
		{
			empty-cells: show;font-family:angsana new;font-size:20px;
		}
	</style>
		<div>
		รายงานข้อมูลสถานที่จัดส่ง
	</div>
	<?php
query("USE transport");
  if(!empty($_POST['reset_data']))
      {
        //$_POST['company']='';
      }
     
print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
$add_shippin = array(3,5,10);

 print("<a onclick = \"window.open('addplace.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=650,height=450,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\">เพิ่มสถานที่จัดส่ง</a> ");

print("<div style=\"float:right;margin-bottom:10px;\">");

    print ("<label for=\"\">ค้นหาตามสถานที่จัดส่ง</label>");
    print ("<input type = \"text\" name = \"search\" style = \"width:60mm;\">");
    print ("<input type = \"submit\" name = \"summit_data\" value = \"ค้นหา\" >");
    print ("<input type = \"submit\" name = \"reset_data\" value = \"Clear\" >");
    print("</div>");
print ("</form>");
       $rowsperpage = 10; // how many items per page
      $range = 10;// how many pages to show in page link

      if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage']))
      {

         // cast var as int
         $currentpage = (int) $_GET['currentpage'];
      }
      else
      {
         // default page num
         $currentpage = 1;
      } // end if
      // the offset of the list, based on current page
      $offset = ($currentpage - 1) * $rowsperpage;

             $sql =getlist("SELECT * from shipping where statusship = '1'");
        
      $numrows = sizeof($sql);
      $totalpages = ceil($numrows / $rowsperpage);

      if ($currentpage > $totalpages) 
      {
         // set current page to last page
         $currentpage = $totalpages;
      } // end if
      // if current page is less than first page...
      if ($currentpage < 1) 
      {
         // set current page to first page
         $currentpage = 1;
      } // end if
      $currentpage1 = ($currentpage*$rowsperpage)-$rowsperpage;
      $today = date('Y-m-d');
      if(empty($_POST['summit_data']))
      {
        
          $query_data =getlist("SELECT * from shipping where statusship = '1' limit $currentpage1,$rowsperpage ");
      
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
						 // print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>ชื่อลูกค้าตามใบกำกับ<b></td>");
						  print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>ชื่อสถานที่จัดส่ง<b></td>");
						  print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>อำเภอ<b></td>");
						  print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>จังหวัด<b></td>");
						  //print("<td align = \"left\" style = \"width:35mm;text-align:center;\" class=\"body_table\"><b>เกรด<b></td>");
              print("<td align = \"left\" style = \"width:8%;text-align:center;\" class=\"body_table\"><b>ระยะทาง(Km.)<b></td>");
               print("<td align = \"left\" style = \"width:12%;\" class=\"body_table\"><b>ประเภทรถ<b></td>");
              print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>มาตราฐานน้ำมันดีเซล(ลิตร)<b></td>");
             // print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>มาตราฐาน NGV(Kg)<b></td>");
           
             
              print("<td align = \"left\" style = \"width:8%;text-align:center;\" class=\"body_table\"><b>เบี้ยเลี้ยงเที่ยว1(บาท)<b></td>");
              print("<td align = \"left\" style = \"width:8%;text-align:center;\" class=\"body_table\"><b>เบี้ยเลี้ยงเที่ยว2(บาท)<b></td>");
             //    print("<td align = \"left\" style = \"width:10%;text-align:center;\" class=\"body_table\"><b>ค่าขนส่งส่วนต่าง<b></td>");

              print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><b><b></td>");
              print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><b><b></td>");
                  
                print("</tr>");
              
                for($i=0;$i<sizeof($query_data);$i++)
                {
                  
                  print("<tr class=\"body_table\" style=\"border:1px groove;\">");
                  		//print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">".($i+1)."</td>");
                  		//	print("<td align = \"left\" style = \"width:120mm;padding-left:10px;\" class=\"body_table\">".$query_data[$i]['customer_ship']."</td>");
      						print("<td align = \"left\" style = \"width:120mm;padding-left:10px;\" class=\"body_table\">".$query_data[$i]['detailship']);
                  if($query_data[$i]['file_data']){
                   print("<a onclick = \"window.open('add/read_pdf.php?id_ship=".$query_data[$i]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1200,height=800,top=45 ,left=250') \" style=\"cursor:pointer;color:red;font-size:25px;\"> --> <img src='image/maps2.png' width='50'></a>");
                  }
                   print("</td>");

      						print("<td align = \"left\" style = \"width:120mm;padding-left:10px;\" class=\"body_table\">".$query_data[$i]['district']."</td>");
      						print("<td align = \"left\" style = \"width:120mm;padding-left:10px;\" class=\"body_table\">".$query_data[$i]['country']."</td>");
      						//print("<td align = \"left\" style = \"width:35mm;text-align:center;\" class=\"body_table\">".$query_data[$i]['grade']."</td>");
                  print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">".$query_data[$i]['distanct']);
                  if($query_data[$i]['edit_status']==1){
                  	 print(" <i class=\"fa fa-star\" aria-hidden=\"true\" style='color: red;' title='แก้ไขแล้ว'></i>");
                  }
                 

                  print("</td>");
                    $get_detail =getlist("SELECT *  from allowance as al  inner join car_head as ch on al.typecar = ch.id_hcar where id_ship='".$query_data[$i]['id_ship']."'");
                  print("<td align = \"left\" style = \"width:10mm;\" order by cartype asc class=\"body_table\">");//ประเภทรถ
                     $data = array("รถเทรลเลอร์/พ่วง","รถสิบล้อเปลือย","รถสิบล้อตู้");
                    for ($f=0; $f < sizeof($data); $f++) { 
                      print($data[$f]);
                      if(($d+1) !=  sizeof($data) ){
                        print("<br>");
                      }
                    }
                       /* for ($j=0; $j < sizeof($get_detail); $j++) { 
                          print($get_detail[$j]['detailhcar']);
                          if(!empty($get_detail[$j+1]['detailhcar'])){
                            print("<br>");
                          }
                        }*/
                    print("</td>");
                  $check_data = getlist("SELECT * FROM fule_detail as f inner join car_head as c on f.car_type=c.id_hcar where id_ship='".$query_data[$i]['id_ship']."' and fule_name='ดีเซล' order by car_type asc");
                  print("<td align = \"left\" style = \"width:10mm;padding-left:7px;\" class=\"body_table\">");//มาตราฐาน(ลิตร)
                    	
                    for ($d=0; $d < sizeof($check_data); $d++) { 
                    	 print($check_data[$d]['standard']);

                    	if(($d+1) !=  sizeof($check_data) ){
                    		print("<br>");
                   	 	}
                    }
                  print("</td>");

                  /* $check_ngv = getlist("SELECT * FROM fule_detail as f inner join car_head as c on f.car_type=c.id_hcar where id_ship='".$query_data[$i]['id_ship']."' and fule_name='NGV'");
                  print("<td align = \"left\" style = \"width:10mm;padding-left:7px;\" class=\"body_table\">");//มาตราฐาน(ลิตร)
                      
                    for ($d=0; $d < sizeof($check_ngv); $d++) { 
                       print($check_ngv[$d]['standard']);

                      if(!empty($check_ngv[$d+1]['standard'])){
                        print("<br>");
                      }
                    }
                  print("</td>");*/
            
                    print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">");//เบี้ยเลี้ยงเที่ยว 1
                        for ($j=0; $j < sizeof($get_detail); $j++) { 
                          print($get_detail[$j]['dis_1']);
                          if(($j+1) !=  sizeof($get_detail) ){
                            print("<br>");
                          }
                        }
                    print("</td>");
                    print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">");//เบี้ยเลี้ยงเที่ยว 2
                        for ($j=0; $j < sizeof($get_detail); $j++) { 
                          
                  
                              print($get_detail[$j]['dis_2']);


                          if(($j+1) !=  sizeof($get_detail) ){
                            print("<br>");
                          }
                        }
                    print("</td>");


               /*   print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">");//มาตราฐาน(ลิตร)
                     print("<a onclick = \"window.open('edit_price_trasport.php?id_ship=".$query_data[$i]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=550,height=350,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\">".number_format($query_data[$i]['price_of_transport'])."</a> </td>");
                    //print(number_format($query_data[$i]['price_of_trasport']));
                  print("</td>");*/
                  $edit = array(2,5,10);
                  if(in_array($_SESSION['permission'], $edit)){
      				    print("<td style = \"width:5%;text-align:center;\">");
      						 print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$query_data[$i]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=600,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">แก้ไข</a> </td>");

      						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><a href=\"delete_data.php?delete_shipping=".$query_data[$i]['id_ship']."\" onclick=\"return confirm('คุณต้องการลบหรือไม่')\">ลบ</a></td>");
                  }
                print("</tr>");
                }
              print("</table>");


            if(empty($_POST['submit']) && empty($_POST['company']))
            {


             if ($numrows<1)
              {

              }
            ELSE {
                echo "<div class=\"body_table page-top\"> Page ".$currentpage." of ".$totalpages."</div>";
                if ($currentpage > 1) 
                {
                     echo " <a class=\"page-a\" href='index.php?path=show_shipping&currentpage=1&page=2'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=show_shipping&currentpage=$prevpage'><</a> ";
                } // end if
                for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++)
                  {
                     if (($x > 0) && ($x <= $totalpages))
                      {
                         if ($x == $currentpage)
                          {
                          echo " [<b>$x</b>] ";
                          }
                        else
                          {
                           echo " <a class=\"page-a\" href='index.php?path=show_shipping&currentpage=$x'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=show_shipping&currentpage=$nextpage'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=show_shipping&currentpage=$totalpages'>>></a> ";
                  } // end if
            } // end else
          }
        ?>
