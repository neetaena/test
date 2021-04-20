<?php
@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	include 'function.php';
	query("USE transport");
	$date = $_GET['datedata'];
	$getdata2 = getlist("SELECT * FROM  production_order where warehouse_id ='".$_GET['warehouse_id']."' and delivery_date='$date'");

	if(!empty($getdata2[0]['boonpon_id'])){
		$getdata3 = getlist("SELECT * FROM  production_order as po inner join type_production as tp on product_id=id_production where boonpon_id ='".$getdata2[0]['boonpon_id']."' and delivery_date='$date'");
	}else{
		$getdata3 = getlist("SELECT * FROM  production_order as po inner join type_production as tp on product_id=id_production where warehouse_id ='".$_GET['warehouse_id']."' and delivery_date='$date'");
	}
	
	$get_transaction = getlist("SELECT * from insertdata_transport where boonpon_id = '".$getdata2[0]['boonpon_id']."'");
?>
<div style="font-size: 22px;font-weight:  bold;text-align: center;font-family:angsana new;"><!--บริษัท วนชัย กร๊ป จำกัด (มหาชน)<br>Vanachai Group Public Co.,Ltd.--></div>
<div style="font-size: 22px;font-weight: bold;text-align: center;font-family:angsana new;"><!--ใบอนุญาตนำสินค้าออก--></div>
<table align="center" style="margin-top:120px;margin-bottom: 8px;">
	<tr>
		<td style="width: 190px;">
			
		</td>
		<td style="width: 300px;">
			
		</td>
		<td style="height: 10px;font-family:angsana new;font-size: 20px;padding-left: 15px;">
			<?php print printShortThaiDate($getdata3[0]['delivery_date']);?>
		</td>
	</tr>
</table>
<table border="0" style="margin-left: 60px;">
<tr>
		<td style="height: 15px;border: none;text-align: center;font-size: 16px;font-family:angsana new;">
			<!--<b>เลขทะเบียน</b>-->
		</td>
		<td rowspan="6" style="width: 460px;border-bottom: none;border-top: none;font-size: 20px;font-family:angsana new;">
			<!--<b>รายการสินค้า</b>-->
			<?php 
			print("<div style='padding-left:80px;'>");
			$total_q = 0;
			$box = array(4,11,12,17,19,20,8,18,9,22,23,24,25);
			$line = array(6,7,13,15,16);
			for($i=0;$i<sizeof($getdata3);$i++)
			{

								show_description($getdata3[$i]['id_order'],$getdata3[$i]['product_id']);
								
								if(in_array($getdata3[$i]['product_id'], $box)){
									$unit = " กล่อง";
									print(" จำนวน ".number_format($getdata3[$i]['counts']).$unit);
								}else if(in_array($getdata3[$i]['product_id'], $line)){
									$unit = " เส้น";
									print(" จำนวน ".number_format($getdata3[$i]['quantity']).$unit);
								}else{
									$unit = " แผ่น";
									print(" จำนวน ".number_format($getdata3[$i]['quantity']).$unit);
								}
								
					
												
									if(!empty($getdata3[$in+1]['detail_production']))
									{
										print("<br>");
									}
//--------------------------------------------------------  คำนวณ คิว --------------------------------
								$data_p = array(1,2,3,6,7);
								$check_pro = data_in_array($getdata3[$i]['product_id'],$data_p);
								
								if($check_pro==1){

									
											$size_data = explode("x", $getdata3[$i]['item_number']);
											$q = (($size_data[0]*$size_data[1]*$size_data[2])/1000000000)*$getdata3[$i]['quantity'];
											$total_q += $q;

											$total_quantity += $getdata3[$i]['quantity'];
											
										
								}elseif($getdata3[$i]['product_id']==5){
                                       
                                            $size_data = explode("x", $getdata3[$i]['item_number']);
                                            $q = ((1230*2450*$size_data[0])/1000000000)*$getdata3[$i]['quantity'];
                                            
                                            //print  number_format($q,2);//แผ่น
                                            $total_q += $q;

                                            $total_quantity += $getdata3[$i]['quantity'];
                                            
                                        

                                }else{
									
										switch ($getdata3[$i]['item_number']) {
											case '8x192x1205':
												$q = ((192*1205)/1000000)*8*$getdata3[$i]['counts'];
												break;
											case '12x193x1205':
												$q = ((193*1205)/1000000)*7*$getdata3[$i]['counts'];
												break;
											case '12x125x1205':
												$q = ((125*1205)/1000000)*7*$getdata3[$i]['counts'];
												break;
											case '12x125x1210':
												$q = ((125*1210)/1000000)*16*$getdata3[$i]['counts'];
												break;
											case '12x190x1205':
												$q = ((190*1205)/1000000)*7*$getdata3[$i]['counts'];
												break;
											case '12x298x1205':
												$q = ((298*1205)/1000000)*5*$getdata3[$i]['counts'];
												break;
											case '8x1220x1260':
												$q = ((1220*1278)/1000000)*1*$getdata3[$i]['quantity'];
												break;
											case '8x1220x1900':
												$q = ((1220*1900)/1000000)*1*$getdata3[$i]['quantity'];
												break;
											default:
												$q =0;
												break;

										}
											$total_q += $q;

											$total_quantity += $get_new[$i]['quantity'];
											
									
								}


								
				
			}
			print("</div>");
			query("USE transport");
			
				$get_delivery_name = getlist("SELECT * FROM shipping WHERE id_ship='".$getdata3[0]['delivery_name']."'");
				$get_customer_name = getlist("SELECT * FROM customer WHERE id_customer='".$getdata3[0]['name']."'");
			print("<div style='text-align: center;    padding-left: 70px;'>");
				print "<b>ชื่อลูกค้า </b> ".$get_customer_name[0]['namecustomer'];//ชื่อลูกค้า
				print "<br><b>สถานที่จัดส่ง </b>". $get_delivery_name[0]['detailship'];//สถานที่จัดส่ง
			print("</div>");	
			print("<div style='text-align: right;'>");
				print("รวม ".number_format($total_q,2)." คิว");
			print("</div>");	
			?>
		</td>
		<td style="height: 15px;border: none;text-align: center;font-size: 16px;font-family:angsana new;">
			<!--<b>บันทึกยามรักษาการณ์</b>-->
		</td>
	</tr>
	<tr >
		<td style="height: 70px;border: none;text-align:center;font-size: 20px;font-family:angsana new;" rowspan="3">
		<?php
			print("<div style=''>");
			if(!empty($getdata2[0]['boonpon_id'])){
			$getcar = getlist("select * from car_detail where id_car = '".$get_transaction[0]['idcar']."'");
								if($get_transaction[0]['typecar'] == 1 OR $get_transaction[0]['typecar'] == 3){
									print $getcar[0]['licenceplates'];
								}else{
									print $getcar[0]['licenceplates']." / ";
									print $getcar[0]['licenceplate2'];
								}
							}
			print("</div>");					
			print("<div style='padding-top: 67px;padding-bottom: 36px'>");
			if(!empty($getdata2[0]['boonpon_id'])){
								$getdriver = getlist("select * from driver where id_driver = '".$get_transaction[0]['nameDriver']."'");
					print $getdriver[0]['namedriver1'];
			}
			print("</div>");
			print("<div style=''>");;

					$n =0;
				$br =1;
				$te =array();
					for ($t=0; $t < sizeof($getdata3); $t++) { 

						$result = data_in_array($getdata3[$t]['invoice'],$te);
						if(empty($result)){
							array_push($te, $getdata3[$t]['invoice']);
						}
					}
					$te = array_unique($te);

							sort($te);
						$cut_invoice = array();
						for($s=0;$s<sizeof($te);$s++){
							$cut =substr($te[$s], 0,8);
							if(!in_array($cut,$cut_invoice)){
							$cut_invoice[] = $cut;
							}
						}

						for ($l=0; $l < sizeof($cut_invoice); $l++) 
						{ 
							$m = 1;
							$u = 0;
							for($i=0;$i<sizeof($te);$i++)
							{
								$data3 = strpos($te[$i],$cut_invoice[$l]);
									if($data3 !== FALSE)
									{
										if($m==1)
										{
											print strtoupper($te[$i]);
											$m=2;
										}else{
											print substr($te[$i], 8,8);

										}
										
										if(!empty($te[$i+1])){
											print ",";
										}
										$u += 1;
										//print($u);
										if($u>=3){
												print("<br>");
												$u = 0;
										}
									}

									
								
							}

						}
			print("</div>");
		?>
		</td>
		
		<td style="height: 15px;border: none;">
		
		</td>
	</tr>
	<tr>
		<td style="border-bottom: none;border-right: none;  border-left: none;text-align: center;font-size: 16px;font-family:angsana new;">
			<!--<b>ชื่อผู้รับ/ผู้นำของออก</b>-->
		</td>
		<td style="border-bottom: none;border-right: none;  border-left: none;text-align: center;font-size: 16px;font-family:angsana new;">
			<!--<b>ผ่านออกเวลา</b>-->
		</td>
		
	</tr>
	<tr>
		<!--<td style="height: 0px;border: none;text-align:center;font-size: 16px;font-family:angsana new;">
			<?php 
					$getdriver = getlist("select * from driver where id_driver = '".$get_transaction[0]['nameDriver']."'");
					//print $getdriver[0]['namedriver1'];
			?>
		</td>-->
		<td style="height: 0px;border: none;">
			
		</td>
		
	</tr>
	<tr>
		<td style="border-bottom: none;border-right: none;  border-left: none;text-align: center;font-size: 16px;font-family:angsana new;">
			<!--<b>ผ่านออกตามใบส่งของเลขที่</b>-->
		</td>
			
		<td style="border-bottom: none;border-right: none;  border-left: none;text-align: center;font-size: 16px;font-family:angsana new;">
			<!--<b>ยามรักษาการณ์</b>-->
		</td>
	</tr>
	<tr>
		<!--<td style="height: 20px;border: none;font-size: 16px;font-family:angsana new;">
			<?php
				$n =0;
				$br =1;
				$te =array();
					for ($t=0; $t < sizeof($getdata3); $t++) { 
						$result = data_in_array($getdata3[$t]['invoice'],$te);
						if(empty($result)){
							array_push($te, $getdata3[$t]['invoice']);
						}
					}
					$te = array_unique($te);

				for($y=0;$y<sizeof($te);$y++)
				{
					if($n==0)
					{
						//print $te[$y]; //รายการสินค้า
						$n=1;
					}else
					{
						$new = substr($te[$y], 8,12);
						//print(",".$new);
					}

					if($br==2){
						//print("<br>");
					}
					$br++;
					
				}
			 ?>
		</td>-->
		
		
	</tr>
</table>
