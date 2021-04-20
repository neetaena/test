<style type="text/css">
  img:hover{
     -webkit-box-shadow: 2px 2px 3px 3px #58daf9;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
      -moz-box-shadow:    2px 2px 3px 3px #58daf9;  /* Firefox 3.5 - 3.6 */
      box-shadow:         2px 2px 2px 2px #58daf9;  /*
  }
</style>
<?php
include 'function.php';
query("USE transport");
if(!empty($_POST['id_type']))
{
	$_POST['id_type'] = $_POST['id_type'] ;
}else if(!empty($_GET['type']))
{
	$_POST['id_type'] = $_GET['type'];
}

print ("<form action = \"\" name = \"search_data\" method = \"POST\" class=\"search_form\">");
print("<div style=\"float:right;margin-bottom:10px;\">");
print ("เลือกประเภท ");
    print("<select name=\"id_type\" style=\"width:200px;\" >");
                  $get_acc = getlist("SELECT * FROM  type_production");
                      print("<option value = \"\">เลือกประเภท</option>");
                      for($i=0;$i<sizeof($get_acc);$i++){
                        $selected =$get_acc[$i]['id_production'] == $_POST['id_type']  ? "selected=\"selected\"" : "";
                        print("<option value = \"".$get_acc[$i]['id_production']."\"".$selected.">".$get_acc[$i]['detail_production']."</option>");
                      }
             print("</select>");


    print ("<label for=\"\">ค้นหาตามวันที่จัดส่ง</label>");
   print ("<input type = \"date\" value='".$_POST['date_search']."' name = \"date_search\" style = \"width:60mm;\">");
    print ("<label for=\"\">เลขที่ใบสั่งขาย</label>");
    
     print ("<input type = \"text\" value='".$_POST['search']."' name = \"search\" style = \"width:60mm;\">");
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

      $where = "";
      $search[0] = !empty($_POST['id_type']) ? "product_id like '".$_POST['id_type']."'" : "";
      $search[1] = !empty($_POST['date_search']) ? "delivery_date like '%".$_POST['date_search']."%'" : "";
      $search[2] = !empty($_POST['search']) ? "number like '%".$_POST['search']."%'" : "";
      
      

      $where_data = "";
      for($i=0;$i<sizeof($search);$i++)
      {
        if(!empty($search[$i])){
           if(!empty($where_data))
            {
              $where_data .= " and ".$search[$i];
            }else{
              $where_data = "WHERE ".$search[$i];
            }
        }
       
      }
      //print $where_data;
                 $sql =getlist("SELECT * from production_order   $where_data GROUP BY data_number");
        
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
     		$query_data =getlist("SELECT * from production_order GROUP BY data_number order by delivery_date desc limit $currentpage1,$rowsperpage ");

			
      }
      elseif (empty($_POST['reset_data']) and !empty($_POST['summit_data'])) 
      {  

              $query_data =getlist("SELECT * from  production_order    $where_data  GROUP BY data_number ");

    
          print("<div class=\"page-a\" style=\"font-size:30px;\"><b>");
          print("<br><br>ผลลัพธ์จากค้นหา  \"".$_POST['search']."\" <br>");
          print("จำนวนทั้งหมด ".sizeof($query_data)." รายการ");
          print("<b></div>");
        }

        print("<table style=\"width:100%;empty-cells: show;font-size:18px;margin-bottom:50px;\" border = \"1\" cellspacing = \"0\" cellpadding = \"0\" align = \"center\" valign = \"middle\" border: 1px groove;\">");
                print("<tr class=\"header_table\">");
                   print("<th style=\"text-align:center;\">");
                    print("เลขที่ใบสั่งขาย");
                  print("</th>");
                  print("<th style=\"text-align:center;\">");
                    print("ชื่อลูกค้า");
                  print("</th>");
                    print("<th style=\"text-align:center;\">");
                    print("สถานที่จัดส่ง");
                  print("</th>");
                  print("<th style=\"text-align:center\">");
                    print("จังหวัด");
                  print("</th>");                  
                 print("</th>");
                   print("<th style=\"text-align:center\">");
                    print("วันที่จัดส่ง");
                  print("</th>");
                  print("</th>");
                   print("<th style=\"text-align:center\">");
                    print("เลข Invoice");
                  print("</th>");
                  print("<th style=\"text-align:center\">");
                    print("รายละเอียด");
                  print("</th>");
                  print("<th style=\"text-align:center\">");
                    print("กลุ่ม");
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
                   print("<td style = \"width:12%;padding-left: 5px;\" >");
                   print("<a onclick = \"window.open('insertdatawarehouse_copy.php?code_data=".$query_data[$i]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1300,height=850,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\"><img src=\"image/copy.png\" title=\"copy ข้อมูล\" width=\"20px\" height=\"20px\"></a> ");
                      print($query_data[$i]['number']);//เลขที่ใบสั่งขาย
                    print("</td>");

                    print("<td style = \"width:20%;padding-left: 5px;\" >");
                    $get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$query_data[$i]['name']."'");
                   print $get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
                      //print($query_data[$i]['name']);//ชื่อลูกค้า
                    print("</td>");
                   
                   print("<td style = \"width:20%;padding-left: 5px;text-align:center;\" >");
                   $get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$query_data[$i]['delivery_name']."'");
                    print $get_delivery_name[0]['detailship'];//สถานที่จัดส่ง
                      //print($query_data[$i]['delivery_name']);//สถานที่จัดส่ง
                    print("</td>");


                     print("<td style = \"width:5%;padding-left: 5px;text-align:center;\" >");
                    $get_delivery_country = getlist("SELECT * FROM production_order WHERE delivery_name='".$query_data[$i]['delivery_name']."'");
                   
                    print $get_delivery_name[0]['country'];//สถานที่จัดส่ง
                      //print($query_data[$i]['delivery_name']);//สถานที่จัดส่ง
                    print("</td>");

                    print("<td style = \"width:8%;padding-left: 5px;text-align:center;\" >");
                      print($query_data[$i]['delivery_date']);//วันที่จัดส่ง
                    print("</td>");
                    
                     print("<td style = \"width:7%;padding-left: 5px;text-align:center;\" >");
                     $invoice = getlist("SELECT * FROM production_order  WHERE data_number='".$query_data[$i]['data_number']."'");
                      for($in=0; $in < sizeof($invoice); $in++) 
                      {
                        print $invoice[$in]['invoice'];
                        if(!empty($invoice[$in+1]['item_number']))
                          {
                            print("<br>");
                          } 
                      }
                    print("</td>");
                     print("<td style = \"width:25%;padding-left: 5px;\" >");
                       
                    
                          for($in=0; $in < sizeof($invoice); $in++) { 
                                        
                          
                          show_description($invoice[$in]['id_order'],$invoice[$in]['product_id']);
                          
                          
                          if(!empty($invoice[$in+1]['product_id']))
                          {
                            print("<br>");
                          }
                          }
                        
                    print("</td>");

                    print("<td style = \"width:8%;padding-left: 5px;\" >");
                      print(strtoupper($query_data[$i]['warehouse_id']) );//วันที่จัดส่ง
                    print("</td>"); 

                    print("<td style = \"width:8%;text-align:center;\">");
                    print("<a onclick = \"window.open('insertdatawarehouse_edit.php?code_data=".$query_data[$i]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1300,height=850,top=45 ,left=250') \" style=\"cursor:pointer;color:#43ad04;\"><img src=\"image/edit_2.png\" title=\"แก้ไข\" width=\"30px\" height=\"30px\"></a> ");
                    print("</td>");
                      print("<td style = \"width:5%;text-align:center;\">");
                     print("<a onclick=\"if(confirm('คุณต้องการที่จะลบข้อมูลนี้ใช่หรือไม่'))window.open('delete_data.php?delete_number=".$query_data[$i]['data_number']."' , '','nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=350,top=200,left=700 '); else ''\"  style=\"cursor:pointer;color:red;\"><img src=\"image/delete.png\" title=\"ลบ\" width=\"30px\" height=\"30px\"></a>");
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
                     echo " <a class=\"page-a\" href='index.php?path=report_warehouse2&currentpage=1&page=2&type=".$_POST['id_type']."'><<</a> ";
                     $prevpage = $currentpage - 1;
                     echo " <a class=\"page-a\" href='index.php?path=report_warehouse2&currentpage=$prevpage&type=".$_POST['id_type']."'><</a> ";
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
                           echo " <a class=\"page-a\" href='index.php?path=report_warehouse2&currentpage=$x&type=".$_POST['id_type']."'>$x</a> ";
                           } // end else
                    } // end if
                  } // end for
                if ($currentpage != $totalpages)
                  {
                      $nextpage = $currentpage + 1;

                     echo " <a class=\"page-a\" href='index.php?path=report_warehouse2&currentpage=$nextpage&type=".$_POST['id_type']."'>></a> ";
                     echo " <a class=\"page-a\" href='index.php?path=report_warehouse2&currentpage=$totalpages&type=".$_POST['id_type']."'>>></a> ";
                  } // end if
            } // end else
          }
          
        ?>
