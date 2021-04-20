<div class="col-md-6">
<?php
query("USE transport");
if(!empty($_GET['delete_gule'])){
  query("DELETE FROM production_gule where gule_id='".$_GET['delete_gule']."'");
  $message = "ลบข้อมูลสำเร็จ";
  print "<script type='text/javascript'>alert('$message');</script>";
}

print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
print("<div style=\"float:right;margin-bottom:10px;\">");

    print ("<label for=\"\">ค้นหาชื่อกาว</label>");
    print ("<input type = \"text\" name = \"search\" style = \"width:60mm;\">");
    print ("<input type = \"submit\" name = \"summit_data_gule\" value = \"ค้นหา\" >");
    print ("<input type = \"submit\" name = \"reset_data\" value = \"Clear\" >");
    print("</div>");
    print("<div style=\"float:left;padding:10px 20px 10px 10px;\">");
     print("<a onclick = \"window.open('add/add_gule.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=700,height=300,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;font-size:25px;\"><i class=\"ace-icon fa fa-plus-square\"></i> Add</a> ");
    print("</div>");
print ("</form>");
       $rowsperpage = 15; // how many items per page
      $range = 10;// how many pages to show in page link

      if (isset($_GET['currentpage_gule']) && is_numeric($_GET['currentpage_gule']))
      {

         // cast var as int
         $currentpage_gule = (int) $_GET['currentpage_gule'];
      }
      else
      {
         // default page num
         $currentpage_gule = 1;
      } // end if
      // the offset of the list, based on current page
      $offset = ($currentpage_gule - 1) * $rowsperpage;

             $sql =getlist("SELECT * from production_gule ");
        
      $numrows = sizeof($sql);
      $totalpages = ceil($numrows / $rowsperpage);

      if ($currentpage_gule > $totalpages) 
      {
         // set current page to last page
         $currentpage_gule = $totalpages;
      } // end if
      // if current page is less than first page...
      if ($currentpage_gule < 1) 
      {
         // set current page to first page
         $currentpage_gule = 1;
      } // end if
      $currentpage_gule1 = ($currentpage_gule*$rowsperpage)-$rowsperpage;
      $today = date('Y-m-d');
    
      if(empty($_POST['summit_data_gule']))
      {
     		$query_data =getlist("SELECT * from production_gule as p inner join type_production as t on p.product_id=t.id_production  limit $currentpage_gule1,$rowsperpage ");
			
			
      }
      else
      {  
              $query_data =getlist("SELECT * from  production_gule as p inner join type_production as t on p.product_id=t.id_production  where gule_description like '%".$_POST['search']."%'");

          print("<div class=\"page-a\" style=\"font-size:30px;\"><b>");
          print("<br><br>ผลลัพธ์จากค้นหา  \"".$_POST['search']."\" <br>");
          print("จำนวนทั้งหมด ".sizeof($query_data)." รายการ");
          print("<b></div>");
        }

        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\">");
                   print("<th style=\"text-align:center;\">");
                    print("ขนาด");
                  print("</th>");
                  print("<th style=\"text-align:center;\">");
                    print("การจัดเรียง");
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
                      print($query_data[$i]['gule_description']);//เลขที่ใบสั่งขาย
                    print("</td>");

                    print("<td style = \"width:10%;text-align:center;\" >");
                      print($query_data[$i]['gule_orderby']);//ชื่อลูกค้า
                    print("</td>");

                    print("<td style = \"width:10%;padding-left: 5px;text-align:center;\" >");
                      print $query_data[$i]['detail_production'];//สถานที่จัดส่ง
                    print("</td>");

                                      
                    print("<td style = \"width:5%;text-align:center;\">");
                    print("<a onclick = \"window.open('edit/edit_gule.php?gule_id=".$query_data[$i]['gule_id']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=600,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\"><img src=\"image/edit_2.png\" title=\"แก้ไข\" width=\"30px\" height=\"30px\"></a> ");
                    print("</td>");
                      print("<td style = \"width:5%;text-align:center;\">");
                     print("<a href=\"index.php?path=manage_size&currentpage_gule=".$_GET['currentpage_gule']."&delete_gule=".$query_data[$i]['gule_id']."\" onclick=\"return confirm('คุณต้องการลบข้อมูลกาวนี้ใช่หรือไม่?')\"><img src=\"image/delete.png\" title=\"ลบ\" width=\"30px\" height=\"30px\"></a>");
                    print("</td>");   
                   
                  
                print("</tr>");
                }
              print("</table>");


            if(empty($_POST['summit_data_gule']) && empty($_POST['search']))
            {


             if ($numrows<1)
              {

              }
            ELSE {
                echo "<div class=\"body_table page-top\"> Page ".$currentpage_gule." of ".$totalpages."</div>";
                if ($currentpage_gule > 1) 
                {
                     echo " <a class=\"page-a\" href='index.php?path=manage_size&currentpage_gule=1&page=2'><<</a> ";
                     $prevpage = $currentpage_gule - 1;
                     echo " <a class=\"page-a\" href='index.php?path=manage_size&currentpage_gule=$prevpage'><</a> ";
                } // end if
                for ($x = ($currentpage_gule - $range); $x < (($currentpage_gule + $range) + 1); $x++)
                  {
                     if (($x > 0) && ($x <= $totalpages))
                      {
                         if ($x == $currentpage_gule)
                          {
                          echo " [<b>$x</b>] ";
                          }
                        else
                          {
                           echo " <a class=\"page-a\" href='index.php?path=manage_size&currentpage_gule=$x'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage_gule != $totalpages)
                  {
                      $nextpage = $currentpage_gule + 1;

                     echo " <a class=\"page-a\" href='index.php?path=manage_size&currentpage_gule=$nextpage'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=manage_size&currentpage_gule=$totalpages'>>></a> ";
                  } // end if
            } // end else
          }
          
        ?>
</div>
