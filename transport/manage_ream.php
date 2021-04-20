	<style type="text/css">
		.body_table
		{
			empty-cells: show;font-family:angsana new;font-size:20px;
		}
	</style>
		<div>
		รายงานข้อมูลคนขับรถ
	</div>
	<?php
query("USE transport");

if(!empty($_GET['delete_id'])){
  $check_empty = getlist("SELECT * FROM ream_asset where asset_id='".$_GET['delete_id']."'");
  if(!empty($check_empty)){
    query("DELETE FROM ream_asset where asset_id='".$_GET['delete_id']."'");
    $message = "ลบข้อมูลสำเร็จ";
    print "<script type='text/javascript'>alert('$message');</script>";
  }
  
}

 print("<a onclick = \"window.open('add/add_rea.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=380,top=45 ,left=250') \" style=\"cursor:pointer;color:blue;\">เพิ่มการเบิก</a> ");
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

          $data[0] = !empty($_POST['license_name']) ? " license_name  like '".$_POST['license_name']."'" : "";
          $data[1] = !empty($_POST['list_data']) ? " list_data like '".$_POST['list_select']."' " : "";
          $data[2] = !empty($_POST['quantity']) ? " quantity like '".$_POST['quantity']."' " : "";
          $data[3] = !empty($_POST['date_ream']) ? " date_ream like '".$_POST['date_ream']."' " : "";
          $data[4] = !empty($_POST['unit']) ? " unit like '".$_POST['unit']."' " : "";
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
             $sql =getlist("SELECT * from ream_asset $where_data");
        
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
        
          $query_data =getlist("SELECT * from ream_asset  limit $currentpage1,$rowsperpage ");
      
      }
      elseif (empty($_POST['reset_data']) and !empty($_POST['summit_data'])) 
      {  
 
          $query_data =getlist("SELECT * from ream_asset  $where_data ");
        
      
        }
        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\" >");
						print("<td align = \"left\" style = \"width:35mm;text-align:center;\" class=\"body_table\"><b>ทะเบียน</b></td>");
						print("<td align = \"left\" style = \"width:35mm;text-align:center;\" class=\"body_table\"><b>วันที่</b></td>");
						print("<td align = \"left\" style = \"width:20mm;text-align:center;\" class=\"body_table\"><b>รายการ</b></td>");
						print("<td align = \"left\" style = \"width:20mm;text-align:center;\" class=\"body_table\"><b>จำนวน</b></td>");
						print("<td align = \"left\" style = \"width:25mm;text-align:center;\" class=\"body_table\"><b>หน่วย</b></td>");
            print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b></b></td>");
						print("<td align = \"left\" style = \"width:10mm;text-align:center;\" class=\"body_table\"><b></b></td>");
                  
                print("</tr>");


  $list_data = array("สเตย์","ผ้าใบ","ไม้หมอนยาว","ไม้หมอนสั้น","เสื้อสะท้อนแสง","กรวยสะท้อนแสง","หมวกเซฟตี้");
        print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
         print("<tr class=\"header_table\" >");
                print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"text\" name = \"license_name\" style = \"width:100%;\" value='".$_POST['license_name']."'></td>");
               
                print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"date\" name = \"date_ream\" style = \"width:100%;    height: 33px;\" value='".$_POST['date_ream']."'></td>");
                 print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\">");
                  print("<select name = \"list_select\" style = \"width:100%;\" class=\"text_fide\" >");
                            print("<option value=''></option>");
                                for($k=0;$k<sizeof($list_data);$k++){
                                    $selected = $_POST['list_select'] == $list_data[$k] ? "selected=\"selected\"" : "";
                                    print("<option value = \"".$list_data[$k]."\"".$selected.">".$list_data[$k]."</option>");
                                }
                        print("</select>");
                  print("</td>");
                print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"text\" name = \"quantity\" style = \"width:100%;\" value='".$_POST['quantity']."'></td>");
                print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"text\" name = \"unit\" style = \"width:100%;\" value='".$_POST['unit']."'></td>");
                print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"submit\" name = \"summit_data\" value = \"ค้นหา\" style = \"width:100%;\"></td>");
                print("<td align = \"left\" style = \"text-align:center;\" class=\"body_table\"><input type = \"submit\" name = \"reset_data\" value = \"Clear\" style = \"width:100%;\"></td>");
                  
                print("</tr>");
         print ("</form>");
                for($i=0;$i<sizeof($query_data);$i++)
                {
                  
                  print("<tr class=\"body_table\" style=\"border:1px groove;\">");
						print("<td align = \"left\" style = \"width:35mm;\" class=\"body_table\">".$query_data[$i]['license_name']."</td>");
						print("<td align = \"left\" style = \"width:35mm;\" class=\"body_table\">".$query_data[$i]['ream_date']."</td>");
						print("<td align = \"left\" style = \"width:20mm;\" class=\"body_table\">".$query_data[$i]['list_data']."</td>");
            print("<td align = \"left\" style = \"width:20mm;\" class=\"body_table\">".$query_data[$i]['quantity']."</td>");
						print("<td align = \"left\" style = \"width:20mm;\" class=\"body_table\">".$query_data[$i]['unit']."</td>");

						print("<td align = \"left\" style = \"width:10mm;\" class=\"body_table\">");
						 print("<a onclick = \"window.open('add/add_rea.php?ream_id=".$query_data[$i]['ream_id']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=380,top=45 ,left=250') \" style=\"cursor:pointer;color:green;\">แก้ไข</a> </td>");
            print("<td align = \"center\" style = \"width:10mm;\" class=\"body_table\">");
						  print("<a href=\"index.php?path=manage_ream&currentpage=".$_GET['currentpage']."&delete_id=".$query_data[$i]['asset_id']."\" onclick=\"return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?')\" style=\"cursor:pointer;color:red;\"><i class=\"ace-icon fa fa-trash-o bigger-120\"></i></a>");
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
                     echo " <a class=\"page-a\" href='index.php?path=manage_ream&currentpage=1&page=2'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=manage_ream&currentpage=$prevpage'><</a> ";
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
                           echo " <a class=\"page-a\" href='index.php?path=manage_ream&currentpage=$x'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=manage_ream&currentpage=$nextpage'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=manage_ream&currentpage=$totalpages'>>></a> ";
                  } // end if
            } // end else
          }
        ?>
