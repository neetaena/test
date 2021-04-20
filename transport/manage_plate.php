<div class="col-md-6">
<?php
query("USE transport");
if(!empty($_GET['delete_plate'])){
  query("DELETE FROM production_plate where id_plate='".$_GET['delete_plate']."'");
  $message = "ลบข้อมูลสำเร็จ";
  print "<script type='text/javascript'>alert('$message');</script>";
  print("<meta http-equiv='refresh' content='0; url= index.php?path=manage_plate&currentpage=".$_GET['currentpage']."'>");
}

print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
print("<div style=\"float:right;margin-bottom:10px;\">");

    print ("<label for=\"\">ค้นหาเพลท</label>");
    print ("<input type = \"text\" name = \"search\" style = \"width:60mm;\">");
    print ("<input type = \"submit\" name = \"summit_data\" value = \"ค้นหา\" >");
    print ("<input type = \"submit\" name = \"reset_data\" value = \"Clear\" >");
    print("</div>");
    print("<div style=\"float:left;padding:10px 20px 10px 10px;\">");
     print("<a onclick = \"window.open('add/add_plate.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=700,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;font-size:25px;\"><i class=\"ace-icon fa fa-plus-square\"></i> Add</a> ");
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

             $sql =getlist("SELECT * from production_plate ");
        
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
     		$query_data =getlist("SELECT * from production_plate as p inner join type_production as t on p.product_id=t.id_production  limit $currentpage1,$rowsperpage ");
			
			
      }
      else
      {  
              $query_data =getlist("SELECT * from  production_plate as p inner join type_production as t on p.product_id=t.id_production where plate_name like '%".$_POST['search']."%'");

          print("<div class=\"page-a\" style=\"font-size:30px;\"><b>");
          print("<br><br>ผลลัพธ์จากค้นหา  \"".$_POST['search']."\" <br>");
          print("จำนวนทั้งหมด ".sizeof($query_data)." รายการ");
          print("<b></div>");
        }

        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\">");
                   print("<th style=\"text-align:center;\">");
                    print("ชื่อเพลท");
                  print("</th>");
                
                    print("<th style=\"text-align:center;\">");
                    print("ชนิดไม้");
                  print("</th>");
                 
                  print("<th style=\"text-align:center\">");
                    print("");
                  print("</th>");
                  
                   print("<th style=\"text-align:center\">");
                    print("");
                  print("</th>");
                  
                  
                  
                print("</tr>");
              
                for($i=0;$i<sizeof($query_data);$i++)
                {
                  
                  print("<tr class=\"body_table\" style=\"border:1px groove;\">");
                    print("<td style = \"width:20%;padding-left: 5px;\" >");
                      print($query_data[$i]['plate_name']);//เลขที่ใบสั่งขาย
                    print("</td>");

                   

                    print("<td style = \"width:10%;padding-left: 5px;text-align:center;\" >");
                      print $query_data[$i]['detail_production'];//สถานที่จัดส่ง
                    print("</td>");

                                      
                    print("<td style = \"width:5%;text-align:center;\">");
                    print("<a onclick = \"window.open('edit/edit_plate.php?id_plate=".$query_data[$i]['id_plate']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=700,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\"><img src=\"image/edit_2.png\" title=\"แก้ไข\" width=\"30px\" height=\"30px\"></a> ");
                    print("</td>");

                     print("<td style = \"width:5%;text-align:center;\">");
                     print("<a href=\"index.php?path=manage_plate&currentpage=".$_GET['currentpage']."&delete_plate=".$query_data[$i]['id_plate']."\" onclick=\"return confirm('คุณต้องการลบข้อมูลกาวนี้ใช่หรือไม่?')\"><img src=\"image/delete.png\" title=\"ลบ\" width=\"30px\" height=\"30px\"></a>");
                    print("</td>");   
                   
                  
                print("</tr>");
                }
              print("</table>");


            if(empty($_POST['summit_data']) && empty($_POST['search']))
            {


             if ($numrows<1)
              {

              }
            ELSE {
                echo "<div class=\"body_table page-top\"> Page ".$currentpage." of ".$totalpages."</div>";
                if ($currentpage > 1) 
                {
                     echo " <a class=\"page-a\" href='index.php?path=manage_plate&currentpage=1&page=2&type=".$_POST['id_type']."'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=manage_plate&currentpage=$prevpage&type=".$_POST['id_type']."'><</a> ";
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
                           echo " <a class=\"page-a\" href='index.php?path=manage_plate&currentpage=$x&type=".$_POST['id_type']."'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=manage_plate&currentpage=$nextpage&type=".$_POST['id_type']."'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=manage_plate&currentpage=$totalpages&type=".$_POST['id_type']."'>>></a> ";
                  } // end if
            } // end else
          }
          
        ?>
</div>
<?php
  include ('manage_marking.php');
?>