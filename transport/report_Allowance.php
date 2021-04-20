
		<style type="text/css">
		.body_table
		{
			empty-cells: show;font-family:angsana new;font-size:20px;padding-left:5px;
		}
	</style>
		<div>
		รายงานข้อมูลเบี้ยเลี้ยง
	</div>
	<?php
query("USE transport");
  if(!empty($_POST['reset_data']))
      {
        //$_POST['company']='';
      }
     
print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
 print("<a onclick = \"window.open('add/add_allowance.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=600,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\">เพิ่มข้อมูลเบี้ยเลี้ยง</a> ");
print("<div style=\"float:right;margin-bottom:10px;\">");

    print ("<label for=\"\">ค้นหาตามสถานที่จัดส่ง</label>");
    print ("<input type = \"text\" name = \"search\" style = \"width:60mm;\">");
    print ("<input type = \"submit\" name = \"summit_data\" value = \"ค้นหา\" >");
    print ("<input type = \"submit\" name = \"reset_data\" value = \"Clear\" >");
    print("</div>");
print ("</form>");
       $rowsperpage = 15; // how many items per page
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

             $sql =getlist("SELECT *  from allowance as al  inner join shipping as sh on al.id_ship = sh.id_ship GROUP BY al.id_ship");
        
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
        
          $query_data =getlist("SELECT *  from allowance as al  inner join shipping as sh on al.id_ship = sh.id_ship GROUP BY al.id_ship limit $currentpage1,$rowsperpage ");
      
      }
      elseif (empty($_POST['reset_data']) and !empty($_POST['summit_data'])) 
      {  
 
          $query_data =getlist("SELECT *  from allowance as al  inner join shipping as sh on al.id_ship = sh.id_ship where status = '1' and detailship like '%".$_POST['search']."%' GROUP BY al.id_ship");
        
          print("<div class=\"page-a\" style=\"font-size:30px;\"><b>");
          print("<br>ผลลัพธ์จากค้นหา  \"".$_POST['search']."\" <br>");
          print("จำนวนทั้งหมด ".sizeof($query_data)." รายการ");
          print("<b></div>");
        }



        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\">");
					//print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>ลำดับ</b></td>");
						//print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>ต้นทาง<b></td>");
						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>สถานที่ที่ส่ง<b></td>");
						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>ประเภทรถ<b></td>");
						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>เบี้ยเลี้ยงเที่ยว1<b></td>");
						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b>เบี้ยเลี้ยงเที่ยว2<b></td>");
            if($_SESSION["permission"]==1 || $_SESSION["permission"]>=5){
						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b><b></td>");
						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><b><b></td>");
                }


            print("</tr>");
              
                for($i=0;$i<sizeof($query_data);$i++)
                {
                   $get_detail =getlist("SELECT *  from allowance as al  inner join car_head as ch on al.typecar = ch.id_hcar where id_ship='".$query_data[$i]['id_ship']."'");
                  
                  print("<tr class=\"body_table\" style=\"border:1px groove;\">");
        						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");//สถานที่ที่ส่ง
                        print($query_data[$i]['detailship']);
                    print("</td>");
        						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");//ประเภทรถ
                        for ($j=0; $j < sizeof($get_detail); $j++) { 
                          print($get_detail[$j]['detailhcar']);
                          if(!empty($get_detail[$j+1]['detailhcar'])){
                            print("<br>");
                          }
                        }
                    print("</td>");
        						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");//เบี้ยเลี้ยงเที่ยว 1
                        for ($j=0; $j < sizeof($get_detail); $j++) { 
                          print($get_detail[$j]['dis_1']);
                          if(!empty($get_detail[$j+1]['dis_1'])){
                            print("<br>");
                          }
                        }
                    print("</td>");
        						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");//เบี้ยเลี้ยงเที่ยว 2
                        for ($j=0; $j < sizeof($get_detail); $j++) { 
                          print($get_detail[$j]['dis_2']);
                          if(!empty($get_detail[$j+1]['dis_2'])){
                            print("<br>");
                          }
                        }
                    print("</td>");
                    if($_SESSION["permission"]==1 || $_SESSION["permission"]>=5)
                    {
  						      print("<td align = \"left\" style = \"width:10mm;empty-cells: \" class=\"body_table\">");
  							    print("<a onclick = \"window.open('add/add_detail_shipping.php?id_ship=".$query_data[$i]['id_ship']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=600,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">แก้ไข</a> </td>");

  						      print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><a href=\"delete_data.php?delete_allowance=".$query_data[$i]['id_allowance']."\" onclick=\"return confirm('คุณต้องการลบหรือไม่')\">ลบ</a></td>");
                    
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
                     echo " <a class=\"page-a\" href='index.php?path=report_Allowance&currentpage=1&page=2'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=report_Allowance&currentpage=$prevpage'><</a> ";
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
                           echo " <a class=\"page-a\" href='index.php?path=report_Allowance&currentpage=$x'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=report_Allowance&currentpage=$nextpage'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=report_Allowance&currentpage=$totalpages'>>></a> ";
                  } // end if
            } // end else
          }
        ?>
