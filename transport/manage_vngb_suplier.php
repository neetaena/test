	<style type="text/css">
		.body_table
		{
			empty-cells: show;font-family:angsana new;font-size:20px;
		}
	</style>
		<div>
		ข้อมูลรถบ้านบึงวิ่งต่อสระบุรี
	</div>
	<?php
query("USE transport");

if(!empty($_GET['delete_id'])){
  $check_empty = getlist("SELECT * FROM supplier_vngb where vngb_id='".$_GET['delete_id']."'");
  if(!empty($check_empty)){
    query("DELETE FROM supplier_vngb where vngb_id='".$_GET['delete_id']."'");
    $message = "ลบข้อมูลสำเร็จ";
    print "<script type='text/javascript'>alert('$message');</script>";
  }
  
}

 print("<a onclick = \"window.open('add/add_vngb_supplier.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=360,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\">เพิ่มลูกค้าบ้านบึง</a> ");
print("<div style=\"float:right;margin-bottom:10px;\">");

     print("</div>");
    

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

          $data[0] = !empty($_POST['supplier_name']) ? " supplier_name  like '%".trim($_POST['supplier_name'])."%'" : "";
          $data[1] = !empty($_POST['district']) ? " district  like '%".trim($_POST['district'])."%'" : "";
          $data[2] = !empty($_POST['country']) ? " country  like '%".trim($_POST['country'])."%'" : "";
          $data[3] = !empty($_POST['averang']) ? " averang like '".trim($_POST['averang'])."' " : "";
          $data[4] = !empty($_POST['average_taylor']) ? " average_taylor like '".trim($_POST['average_taylor'])."' " : "";


          $where_data ="";

          for ($s=0; $s < sizeof($data); $s++) { 
              if(!empty($data[$s]))
                  {
                      if(empty($where_data))
                      {
                          $where_data =   " where ".$data[$s];
                      }else{
                          $where_data .= " and ".$data[$s];
                      }
                  }
          }
             $sql =getlist("SELECT * FROM supplier_vngb $where_data");
        
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
        
          $query_data =getlist("SELECT * from supplier_vngb  limit $currentpage1,$rowsperpage ");
      
      }
      elseif (empty($_POST['reset_data']) and !empty($_POST['summit_data'])) 
      {  
 
          $query_data =getlist("SELECT * from supplier_vngb  $where_data ");
        
      
        }
        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\" >");
            print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>ชื่อลุกค้าบ้านบึง</b></td>");
            print("<td align = \"left\" style = \"width:10%;text-align:center;\" class=\"body_table\"><b>อำเภอ</b></td>");
						print("<td align = \"left\" style = \"width:10%;text-align:center;\" class=\"body_table\"><b>จังหวัด</b></td>");
						
            print("<td align = \"left\" style = \"width:10%;text-align:center;\" class=\"body_table\"><b>ระยะทาง กลับ บ้านบึง</b></td>");
            print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>ระยะทาง ลูกค้า->สระบุรี</b></td>");
            print("<td align = \"left\" style = \"width:15%;text-align:center;\" class=\"body_table\"><b>ส่วนต่าง</b></td>");
            print("<td align = \"left\" style = \"width:10%;text-align:center;\" class=\"body_table\"><b>น้ำมัน เพิ่ม / ลด สิบล้อ</b></td>");
            print("<td align = \"left\" style = \"width:10%;text-align:center;\" class=\"body_table\"><b>น้ำมัน เพิ่ม / ลด เทเลอร์</b></td>");

            print("<td align = \"left\" style = \"width:5%;text-align:center;\" class=\"body_table\"><b></b></td>");
						print("<td align = \"left\" style = \"width:5%;text-align:center;\" class=\"body_table\"><b></b></td>");
                  
                print("</tr>");


        print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
         print("<tr class=\"header_table\" >");
              print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"text\" name = \"supplier_name\" style = \"width:100%;\" value='".$_POST['supplier_name']."'></td>");
               
                
              print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"text\" name = \"district\" style = \"width:100%;\" value='".$_POST['district']."'></td>");
              print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"text\" name = \"country\" style = \"width:100%;\" value='".$_POST['country']."'></td>");

               
                

                print("<td align = \"left\" style = \"width:5%;text-align:center;\" class=\"body_table\"></td>");
                print("<td align = \"left\" style = \"width:5%;text-align:center;\" class=\"body_table\"></td>");
                print("<td align = \"left\" style = \"width:5%;text-align:center;\" class=\"body_table\"></td>");
                 print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"text\" name = \"averang\" style = \"width:100%;\" value='".$_POST['averang']."'></td>");
                 print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"text\" name = \"average_taylor\" style = \"width:100%;\" value='".$_POST['average_taylor']."'></td>");

                print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"submit\" name = \"summit_data\" value = \"ค้นหา\" style = \"width:100%;\"></td>");
                print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"submit\" name = \"reset_data\" value = \"Clear\" style = \"width:100%;\"></td>");
                  
                print("</tr>");
         print ("</form>");
                for($i=0;$i<sizeof($query_data);$i++)
                {
                  
                  print("<tr class=\"body_table\" style=\"border:1px groove;\">");
            print("<td align = \"left\"  class=\"body_table\">".$query_data[$i]['supplier_name']."</td>");
            print("<td align = \"left\"  class=\"body_table\">".$query_data[$i]['district']."</td>");
						print("<td align = \"left\"  class=\"body_table\">".$query_data[$i]['country']."</td>");
           
            print("<td align = \"left\"  class=\"body_table\">".$query_data[$i]['back_vngb']."</td>");
            print("<td align = \"left\"  class=\"body_table\">".$query_data[$i]['go_vngs']."</td>");
						print("<td align = \"left\"  class=\"body_table\">".($query_data[$i]['back_vngb']-$query_data[$i]['go_vngs'])."</td>");
             print("<td align = \"left\"  class=\"body_table\">".$query_data[$i]['averang']."</td>");
             print("<td align = \"left\"  class=\"body_table\">".$query_data[$i]['average_taylor']."</td>");

						print("<td align = \"left\" class=\"body_table\">");
						 print("<a onclick = \"window.open('add/add_vngb_supplier.php?vngb_id=".$query_data[$i]['vngb_id']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=600,height=360,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">แก้ไข</a> </td>");
            print("<td align = \"center\"  class=\"body_table\">");
						  print("<a href=\"index.php?path=manage_vngb_suplier&currentpage=".$_GET['currentpage']."&delete_id=".$query_data[$i]['vngb_id']."\" onclick=\"return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?')\" style=\"cursor:pointer;color:red;\"><i class=\"ace-icon fa fa-trash-o bigger-120\"></i></a>");
            print("</td>");
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
                     echo " <a class=\"page-a\" href='index.php?path=manage_vngb_suplier&currentpage=1&page=2'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=manage_vngb_suplier&currentpage=$prevpage'><</a> ";
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
                           echo " <a class=\"page-a\" href='index.php?path=manage_vngb_suplier&currentpage=$x'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=manage_vngb_suplier&currentpage=$nextpage'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=manage_vngb_suplier&currentpage=$totalpages'>>></a> ";
                  } // end if
            } // end else
          }
        ?>
