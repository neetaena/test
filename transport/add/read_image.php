<style type="text/css">
  a{
    position:  absolute;;
    border: 1px solid #000;
    padding: 7px 7px;
    font-size: 20px;
    background-color: bisque;
  }
  a:hover{
    background-color: #ec974e;
  }
</style>
<?php
  @session_start();
    date_default_timezone_set("Asia/Bangkok");
    //@ini_set('display_errors', '0');
    include("../../include/mySqlFunc.php");
    query("USE transport");
       $id_ship = $_GET['id_ship'];

      if(!empty($_POST['out'])){
          print "<script>window.close();</script>";
      }
       $data_image = getlist("SELECT * FROM shipping where id_ship='$id_ship'");
    $file ="image/map/".iconv("utf-8", "tis-620",$data_image[0]['image_map']);

    $url = $_SERVER['PHP_SELF'] .$_SERVER['REQUEST_URI'];
    for ($i=0; $i < sizeof($data_image) ; $i++) { 
     // $file = iconv("utf-8", "tis-620","../image/map/".$data_image[$i]['image_map']);
      print("<div style='text-align:center;margin-top:5px;'><img src=\"../image/map/".$data_image[$i]['image_map']."\" style='width: 80%;'>");

      print("</div>");
    }
print("<form action=\"\" name=\"import_data\" method=\"POST\" enctype=\"multipart/form-data\" accept-charset=\"utf-8\" style='text-align:center;margin-top:20px;'>");
 if(strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile')){
         
      }else{
        print("<input type=\"submit\" name=\"out\" value=\"ออก\" class=\"btn btn-primary\" style='width: 20%;font-size: 24px;'>");
      }

print("</form>");
