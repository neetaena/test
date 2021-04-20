
		<style type="text/css">
		.body_table
		{
			empty-cells: show;font-family:angsana new;font-size:20px;padding-left:5px;
		}
	</style>
		<div>
		ข้อมูลรถพร้อมใช้งาน
	</div>
	<?php
query("USE transport");
  if(!empty($_POST['reset_data']))
      {
        //$_POST['company']='';
      }
     

     if(!empty($_GET['available_id'])){
        $get_delete = getlist("SELECT * FROM car_available where available_id='".$_GET['available_id']."'");
        if(!empty($get_delete)){
          query("DELETE FROM car_available where available_id='".$_GET['available_id']."'");
        }
     }
print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
 print("<a onclick = \"window.open('add/add_available.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=830,height=530,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\">เพิ่มข้อมูลรถพร้อมใช้งาน</a> ");
print("<div style=\"float:right;margin-bottom:10px;\">");

    print ("<label for=\"\">วันที่</label>");
    print ("<input type = \"date\" name = \"search\" style = \"width:60mm;\">");
    print ("<input type = \"submit\" name = \"summit_data\" value = \"ค้นหา\" >");
    print ("<input type = \"submit\" name = \"reset_data\" value = \"Clear\" >");
    print("</div>");
print ("</form>");
       $rowsperpage = 15; // how many items per page
      $range = 3;// how many pages to show in page link

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

             $sql =getlist("SELECT * FROM `car_available` ");
        
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
        
          $query_data =getlist("SELECT * FROM `car_available` group by available_date order by available_date desc limit $currentpage1,$rowsperpage ");
      
      }
      elseif (empty($_POST['reset_data']) and !empty($_POST['summit_data'])) 
      {  
 
          $query_data =getlist("SELECT * FROM `car_available` where available_date like '".$_POST['search']."' group by available_date order by available_date");
        
          print("<div class=\"page-a\" style=\"font-size:30px;\"><b>");
          print("<br>ผลลัพธ์จากค้นหา  \"".$_POST['search']."\" <br>");
          print("จำนวนทั้งหมด ".sizeof($query_data)." รายการ");
          print("<b></div>");
        }



        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\">");
					//print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>ลำดับ</b></td>");
						//print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>ต้นทาง<b></td>");
						print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b>วันที่<b></td>");
						print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b>ประเภทรถ<b></td>");
						print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b>จำนวนรถพร้อมใช้งาน<b></td>");
            print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b>จำนวนรถซ่อม<b></td>");
            print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b>หมายเหตุ<b></td>");
						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b><b></td>");
						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b><b></td>");



            print("</tr>");
              
                for($i=0;$i<sizeof($query_data);$i++)
                {
                  $get_detail = getlist("SELECT * FROM `car_available` where available_date like '".$query_data[$i]['available_date']."'");
                  $m = 1;
                  for ($j=0; $j < sizeof($get_detail); $j++) { 
                      print("<tr class=\"body_table\" style=\"border:1px groove;\">");
                      if($m==1){
                        print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\" rowspan='".sizeof($get_detail)."'>");//สถานที่ที่ส่ง
                            print($get_detail[$j]['available_date']);
                        print("</td>");
                       
                      }
                      print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");//สถานที่ที่ส่ง
                      $type = getlist("SELECT * FROM car_type_available where car_type_id='".$get_detail[$j]['car_type']."'");
                          print($type[0]['car_type_name']." : <b>".$type[0]['car_type_fule']."</b>");
                      print("</td>");
                      print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");//สถานที่ที่ส่ง
                          print($get_detail[$j]['available_number']);
                      print("</td>");
                      print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");//สถานที่ที่ส่ง
                          print($get_detail[$j]['repair_number']);
                      print("</td>");
                      print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");//สถานที่ที่ส่ง
                          print($get_detail[$j]['note']);
                      print("</td>");
          
                      if($m==1){
                      print("<td align = \"left\" style = \"width:10mm;text-align:center; \" class=\"body_table\" rowspan='".sizeof($get_detail)."'>");
                      print("<a onclick = \"window.open('add/add_available.php?available_date=".$get_detail[$j]['available_date']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=830,height=530,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">แก้ไข</a> </td>");

                       print("<td style = \"width:5%;text-align:center;\" rowspan='".sizeof($get_detail)."'>");
                       print("<a href=\"index.php?path=manage_car_available&currentpage=".$_GET['currentpage']."&available_id=".$get_detail[$j]['available_id']."\" onclick=\"return confirm('คุณต้องการลบข้อมูลกาวนี้ใช่หรือไม่?')\"><img src=\"image/delete.png\" title=\"ลบ\" width=\"30px\" height=\"30px\"></a>");
                      print("</td>");   
                        $m = 0;
                      }
                      
                    
                     
                     print("</tr>");
                  }
                  
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
                     echo " <a class=\"page-a\" href='index.php?path=manage_car_available&currentpage=1&page=2'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=manage_car_available&currentpage=$prevpage'><</a> ";
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
                           echo " <a class=\"page-a\" href='index.php?path=manage_car_available&currentpage=$x'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=manage_car_available&currentpage=$nextpage'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=manage_car_available&currentpage=$totalpages'>>></a> ";
                  } // end if
            } // end else
          }
        ?>
