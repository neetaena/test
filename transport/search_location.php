<?php  
header('content-type: text/html; charset: utf-8');//รองรับภาษาไทย

  include("../include/mySqlFunc.php");
	query("USE transport");
     query('SET NAMES utf8');//แสดงข้อมูลรองรับภาษาไทย
    $param =$_GET['term'];  //รับParamที่ส่งมา ชื่อ term
    $query1 = getlist("SELECT * FROM shipping WHERE detailship LIKE '%$param%' ");  //ค้นหาข้อมูลพนักงานในเทเบิล employee
    for ($x=0;$x<sizeof($query1);$x++)
	{  
       $data[] = $query1[$x]['detailship'] ;    
    }  
     echo json_encode($data);

?>