<?php
//connect ฐานข้อมูล
//@ini_set('display_errors', '0');
//include("../include/mySqlFunc.php");
query("USE transport");
   
    $day = array();
    $d=cal_days_in_month(CAL_GREGORIAN,$mount,$year);
    for ($s=1; $s <= $d; $s++) { 
         array_push($day,$s);
    }
   // $day = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21); // ตัวแปรแกน x
    $y2556 = array(); //ตัวแปรแกน y
    $y2561 = array(); //ตัวแปรแกน y
    

//sql สำหรับดึงข้อมูล จาก ฐานข้อมูล
    //SELECT DISTINCT(p.boonpon_id) as boonpon_id FROM `production_order` as p INNER JOIN insertdata_transport as i ON p.boonpon_id=i.boonpon_id WHERE delivery_date='2018-11-29' and typecar between '2' and '3'



    $mount_1 = $mount;
    $mount_description ="";
    $month_check = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");

    while (list($key, $value) = each($month_check)) {
           if($key==$mount_1) {
                $mount_description = $value;
                continue;
           }
    }
 

for ($i=1; $i <= $d; $i++) { 

    if($i <10){
        $date_new = $year."-".$mount_1."-0".$i;
    }else{
        $date_new = $year."-".$mount_1."-".$i;
    }
    $result = getlist("SELECT DISTINCT(p.boonpon_id) as boonpon_id FROM `production_order` as p INNER JOIN insertdata_transport as i ON p.boonpon_id=i.boonpon_id WHERE delivery_date  like '$date_new' ");//and typecar between '2' and '3'
   //array_push คือการนำค่าที่ได้จาก sql ใส่เข้าไปตัวแปร array
     array_push($y2556,sizeof($result));

     $car_available = getlist("SELECT sum(available_number) as available_number FROM `car_available`WHERE available_date like '$date_new'");
       array_push($y2561,$car_available[0]['available_number']);

}
?>
  
        <script>
 $(function () {
        $('#container').highcharts({
            chart: {
                type: 'line' //รูปแบบของ แผนภูมิ ในที่นี้ให้เป็น line
            },
            title: {
                text: 'ปริมาณการใช้งานรถประจำเดือน : <?= $mount_description ?>' //
            },
            subtitle: {
                text: 'BOONPORN TRANSPORT'
            },
            xAxis: {
                categories: ['<?= implode("','", $day); //นำตัวแปร array แกน x มาใส่ ในที่นี้คือ เดือน?>']
            },
            yAxis: {
                title: {
                    text: 'จำนวนการใช้งานรถ(ครั้ง)'
                }
            },
            tooltip: {

               /* headerFormat : '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat : '<tr><td style="color:{series.color};padding: 0">{series.name} :</td>'+
                    '<td style="padding:0"><b>{point.y:.1f} คัน</b></td></tr>',
                footerFormat : '</table>',*/
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
    </head> 
    <body> 
      <div id="container" style="min-width: 320px; height: 380px; margin: 0 auto"></div>     
      <span style="font-size: 16;color: red;">**ตามกราฟเป็นข้อมูลการใช้งานรถของบริษัท บุญพร สระบุรี เท่านั่น  </span>
    </body>
