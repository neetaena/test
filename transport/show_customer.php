	<style type="text/css">
		.body_table
		{
			empty-cells: show;font-family:angsana new;font-size:20px;
		}
    .header_table{
      text-align: :center;
    }
	</style>
		<div>
		รายงานข้อมูลลูกค้า
	</div>
	<?php
query("USE transport");
  if(!empty($_POST['reset_data']))
      {
        //$_POST['company']='';
      }
     
print("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
if($_SESSION["id_user"]==32 || $_SESSION["permission"] >=2){
 print("<a onclick = \"window.open('addcustomer.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=750,height=500,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\">เพิ่มชื่อลูกค้า</a> ");
print("<div style=\"float:right;margin-bottom:10px;\">");
}

    print ("<label for=\"\">ค้นหาตามชื่อลูกค้า ที่อยู่ หรือ เบอร์โทรศัพท์</label>");
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

             $sql =getlist("SELECT * from customer where status = '1'");
        
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
        
          $query_data =getlist("SELECT * from customer where status = '1' limit $currentpage1,$rowsperpage ");
      
      }
      elseif (empty($_POST['reset_data']) and !empty($_POST['summit_data'])) 
      {  
 
          $query_data =getlist("SELECT * from customer where status = '1' and namecustomer like '%".$_POST['search']."%' or status = '1' and address like '%".$_POST['search']."%' or status = '1' and phonenumber like '%".$_POST['search']."%'");
        
          print("<div class=\"page-a\" style=\"font-size:30px;\"><b>");
          print("<br>ผลลัพธ์จากค้นหา  \"".$_POST['search']."\" <br>");
          print("จำนวนทั้งหมด ".sizeof($query_data)." รายการ");
          print("<b></div>");
        }
        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\" >");
                		print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b>ลำดับ</b></td>");
						        print("<td align = \"left\" style = \"width:35mm;text-align:center;\" class=\"body_table\"><b>ชื่อลูกค้า<b></td>");
						        print("<td align = \"left\" style = \"width:35mm;text-align:center;\" class=\"body_table\"><b>ที่อยู่<b></td>");
						        print("<td align = \"left\" style = \"width:20mm;text-align:center;\" class=\"body_table\"><b>เบอร์โทรศัพท์<b></td>");
						        print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b><b></td>");
						        print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b><b></td>");
                          
                print("</tr>");
              
                for($i=0;$i<sizeof($query_data);$i++)
                {
                  $num = ($i+1)+(($currentpage*$rowsperpage)-15);
                  print("<tr class=\"body_table\" style=\"border:1px groove;\">");
                  print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\">".($num)."</td>");
						      print("<td align = \"left\" style = \"width:35mm;\" class=\"body_table\">".$query_data[$i]['namecustomer']."</td>");
						      print("<td align = \"left\" style = \"width:35mm;\" class=\"body_table\">".$query_data[$i]['address']."</td>");
						      print("<td align = \"left\" style = \"width:20mm;\" class=\"body_table\">".$query_data[$i]['phonenumber']."</td>");

						      print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");
						       print("<a onclick = \"window.open('edit_customer.php?id_customer=".$query_data[$i]['id_customer']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no,      status=no,resizable=no,width=1100,height=600,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">แก้ไข</a> </td>");

						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\"><a href=\"delete_data.php?delete_customer=".$query_data[$i]['id_customer']."\" onclick=\"return confirm('คุณต้องการลบหรือไม่')\">ลบ</a></td>");
                  
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
                     echo " <a class=\"page-a\" href='index.php?path=show_customer&currentpage=1&page=2'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=show_customer&currentpage=$prevpage'><</a> ";
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
                           echo " <a class=\"page-a\" href='index.php?path=show_customer&currentpage=$x'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=show_customer&currentpage=$nextpage'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=show_customer&currentpage=$totalpages'>>></a> ";
                  } // end if
            } // end else
          }
        ?>
