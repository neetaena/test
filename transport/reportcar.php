
		<style type="text/css">
		.body_table
		{
			empty-cells: show;font-family:angsana new;font-size:20px;padding-left:5px;
		}
	</style>
		<div>
		รายงานข้อมูลรถ
	</div>
	<?php
query("USE transport");
  if(!empty($_POST['reset_data']))
      {
        //$_POST['company']='';
      }
     
print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
 print("<a onclick = \"window.open('addinformationcar.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=600,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\">เพิ่มข้อมูลรถ</a> ");
print("<div style=\"float:right;margin-bottom:10px;\">");

    print ("<label for=\"\">ค้นหาตามเลขทะเบียน</label>");
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

             $sql =getlist("SELECT * from car_detail as ca INNER JOIN car_head as ch on ca.typecar=ch.id_hcar where status = '1'");
         
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
        
          $query_data =getlist("SELECT * from car_detail as ca INNER JOIN car_head as ch on ca.typecar=ch.id_hcar where status = '1' limit $currentpage1,$rowsperpage ");

      
      }
      elseif (empty($_POST['reset_data']) and !empty($_POST['summit_data'])) 
      {  
 
          $query_data =getlist("SELECT * from car_detail as ca INNER JOIN car_head as ch on ca.typecar=ch.id_hcar where status = '1' and licenceplates like '%".$_POST['search']."%' or  licenceplate2 like '%".$_POST['search']."%'");
        
          print("<div class=\"page-a\" style=\"font-size:30px;\"><b>");
          print("<br>ผลลัพธ์จากค้นหา  \"".$_POST['search']."\" <br>");
          print("จำนวนทั้งหมด ".sizeof($query_data)." รายการ");
          print("<b></div>");
        }
        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\">");
						//print("<td align = \"left\" style = \"width:10mm;empty-cells: \" class=\"body_table\"><b>ลำดับ</b></td>");
						print("<td align = \"left\"  class=\"body_table\"><b>เลขทะเบียน</b></td>");
						print("<td align = \"left\"  class=\"body_table\"><b>เลขทะเบียนพ่วง</b></td>");
						print("<td align = \"left\"  class=\"body_table\"><b>ประเภท</b></td>");
            print("<td align = \"left\"  class=\"body_table\"><b>วันที่จดทะเบียน</b></td>");
            print("<td align = \"left\"  class=\"body_table\"><b>ขนาดที่วางสินค้า</b></td>");
            print("<td align = \"left\"  class=\"body_table\"><b>น้ำหนักบรรทุกสูงสุด</b></td>");
						print("<td align = \"left\"  class=\"body_table\"><b>เชื้อเพลิง</b></td>");
            print("<td align = \"left\"  class=\"body_table\"><b>สังกัด</b></td>");
						//print("<td align = \"left\\" class=\"body_table\"><b>รหัส</b></td>");
						print("<td align = \"left\"class=\"body_table\"><b></b></td>");
						print("<td align = \"left\" class=\"body_table\"><b></b></td>");
                  
                print("</tr>");
              
                for($i=0;$i<sizeof($query_data);$i++)
                {
                  
                  print("<tr class=\"body_table\" style=\"border:1px groove;\">");

                  //print("<td align = \"left\" style = \"width:10mm;empty-cells: \" class=\"body_table\">".(($i+1)."</td>");
							print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\">".$query_data[$i]['licenceplates']."</td>");
							print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\">".$query_data[$i]['licenceplate2']."</td>");
							print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\">".$query_data[$i]['detailhcar']."</td>");

              print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\">".$query_data[$i]['date_register']."</td>");
              print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\">".$query_data[$i]['car_size']."</td>");
              print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\">".$query_data[$i]['car_max_weight']."</td>");

							print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\">".$query_data[$i]['typefule']."</td>");

             $type_size = array("1"=>"รถสระบุรี","2"=>"รถบ้านบึง","3"=>"อื่นๆ");
              if(!empty($query_data[$i]['type_site'])){
                 while (list($key, $value) = each($type_size)) {
                  if($query_data[$i]['type_site']==$key){
                      print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\">".$value."</td>");
                   }
                }
              }else{
                print("<td align = \"left\" style = \"width:10%;empty-cells: \" class=\"body_table\"></td>");
              }
							//print("<td align = \"left\" style = \"width:10mm;empty-cells: \" class=\"body_table\">".$query_data[$i]['cartype']."</td>");
							print("<td align = \"left\" style = \"width:5%;empty-cells: \" class=\"body_table\">");
							 print("<a onclick = \"window.open('edit_car.php?idcar=".$query_data[$i]['id_car']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1100,height=600,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">แก้ไข</a> </td>");

							print("<td align = \"left\" style = \"width:5%;empty-cells: \" class=\"body_table\"><a href=\"delete_data.php?delete_car=".$query_data[$i]['id_car']."\" onclick=\"return confirm('คุณต้องการลบหรือไม่')\">ลบ</a></td>");
                  
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
                     echo " <a class=\"page-a\" href='index.php?path=reportcar&currentpage=1&page=2'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=reportcar&currentpage=$prevpage'><</a> ";
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
                           echo " <a class=\"page-a\" href='index.php?path=reportcar&currentpage=$x'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=reportcar&currentpage=$nextpage'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=reportcar&currentpage=$totalpages'>>></a> ";
                  } // end if
            } // end else
          }
        ?>
