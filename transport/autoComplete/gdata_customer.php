<?php
header("Content-type:text/html; charset=UTF-8");          
// เชื่อมต่อฐานข้อมูล
include("../../include/mySqlFunc.php");
query("USE transport");
/*$q = urldecode($_GET["q"]);

	$pagesize = 50; // จำนวนรายการที่ต้องการแสดง
	$row = getList("select * from customer WHERE namecustomer LIKE '%$q%' limit 0 , $pagesize");
	for($i=0;$i<sizeof($row);$i++){
		echo "<li onselect=\"this.setText('".$row[$i]['namecustomer']."').setValue('".$row[$i]['id_customer']."');\">".$row[$i]['namecustomer']."</li>";
	}
*/
	    // uery('SET NAMES utf8');//แสดงข้อมูลรองรับภาษาไทย
    $param =$_GET['term'];  //รับParamที่ส่งมา ชื่อ term
    $query1 = getlist("SELECT * FROM customer WHERE namecustomer LIKE '%$param%' ");  //ค้นหาข้อมูลพนักงานในเทเบิล employee
    for ($x=0;$x<sizeof($query1);$x++)
	{  
       $data[] = $query1[$x]['namecustomer'] ;    
    }  
     echo json_encode($data);

?>
