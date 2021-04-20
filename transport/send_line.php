<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
include("../include/mySqlFunc.php");
    query("USE warehouse");

$Token = $_GET['token'];
$message = $_GET['ma'];

 $v = line_notify($Token, $message);
 print $v;
print "<script>window.close();</script>";
?>