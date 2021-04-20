<?php
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);       
// เชื่อมต่อฐานข้อมูล
include("../../include/mySqlFunc.php");
query("USE transport");
query('SET NAMES utf8');//แสดงข้อมูลรองรับภาษาไทย
	$pagesize = 10; // จำนวนรายการที่ต้องการแสดง

	   
    $param =$_GET['term'];  //รับParamที่ส่งมา ชื่อ term
    $query1 = getlist("SELECT * FROM driver WHERE namedriver1 LIKE '%$param%' limit 0 , $pagesize");  //ค้นหาข้อมูลพนักงานในเทเบิล employee
    for ($x=0;$x<sizeof($query1);$x++)
	{  
       $data[] = $query1[$x]['namedriver1'] ;    
    }  
     echo json_encode($data);

?>
