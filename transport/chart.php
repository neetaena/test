<?php
//connect ฐานข้อมูล
//@ini_set('display_errors', '0');
//include("../include/mySqlFunc.php");
//query("USE transport");
    $monthx = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); // ตัวแปรแกน x
    $y2556 = array(); //ตัวแปรแกน y
    $y2561 = array(); //ตัวแปรแกน y



//sql สำหรับดึงข้อมูล จาก ฐานข้อมูล
    //SELECT DISTINCT(p.boonpon_id) as boonpon_id FROM `production_order` as p INNER JOIN insertdata_transport as i ON p.boonpon_id=i.boonpon_id WHERE delivery_date='2018-11-29' and typecar between '2' and '3'


for ($i=1; $i <= 12; $i++) { 

    if($i <10){
        $date_new = $year."-0".$i;
    }else{
        $date_new = $year."-".$i;
    }
    $result = getlist("SELECT DISTINCT(p.boonpon_id) as boonpon_id FROM `production_order` as p INNER JOIN insertdata_transport as i ON p.boonpon_id=i.boonpon_id WHERE delivery_date  like '$date_new%' and typecar ");//between '2' and '3'

   //array_push คือการนำค่าที่ได้จาก sql ใส่เข้าไปตัวแปร array
     array_push($y2556,sizeof($result));

     $car_available = getlist("SELECT sum(available_number) as available_number FROM `car_available`WHERE available_date like '$date_new%'");
     
       array_push($y2561,$car_available[0]['available_number']);

}

?>
        <script>
 $(function () {
        $('#container2').highcharts({
            chart: {
                type: 'line' //รูปแบบของ แผนภูมิ ในที่นี้ให้เป็น line
            },
            title: {
                text: 'ปริมาณการใช้งานรถประจำปี : <?= $year ?>' //
            },
            subtitle: {
                text: 'BOONPORN TRANSPORT'
            },
            xAxis: {
                categories: ['<?= implode("','", $monthx); //นำตัวแปร array แกน x มาใส่ ในที่นี้คือ เดือน?>']
            },
            yAxis: {
                title: {
                    text: 'จำนวนการใช้งานรถ(ครั้ง)'
                }
            },
            tooltip: {
                shared : true,
                useHTML :true

            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                },
                column:{
                    pointPadding : 0.2,
                 borderWidth :0
                } 
            },
            series: [   {
                                name: 'รถใช้งานจริง',
                                data: [<?= implode(',', $y2556) // ข้อมูล array แกน y ?>]
                        }, {
                                name: 'รถพร้อมใช้งาน',
                                data: [<?= implode(',', $y2561) // ข้อมูล array แกน y ?>]
                        }
                    ]
            }


            );
    });
        </script>
  
    <body> 
      <div id="container2" style="min-width: 320px; height: 380px; margin: 0 auto"></div>    
     <!-- <span style="font-size: 16;color: red;">**ตามกราฟเป็นข้อมูลการใช้งานรถของบริษัท บุญพร สระบุรี เท่านั่น  </span>   -->
    </body>
