
<meta http-equiv = "Content-Type" content="text/html; charset = utf-8" />
<html>
	<head>
		<title>
		ใบเบิกน้ำมัน
		</title>
		<link type="text/css" href="assets/bootstrap/bootstrap.css" rel = "stylesheet" />
		<style type="text/css">
			@media print { 

			 .excel{ display: none !important; } 
			}

			.font-style{
				empty-cells: show;
				font-family:angsana new;
				font-size:20px;"
			}

			.font-style2{
				empty-cells: show;
				font-family:angsana new;
				font-size:16px;"
			}
		</style>
	</head>
<?php
    @session_start();
	@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	query("USE transport");

	function printShortMount($date){
		list($y,$m,$d)=explode("-",$date);
		$y+=543;
		$tm=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		return "/".$m."/".substr($y,2,2);
	}



	$boonpon_id = $_GET['boonpon_id'];
	$id_ship = $_GET['id_ship'];

	$get_data = getlist("SELECT * FROM insertdata_transport as i  inner join production_order as p on i.boonpon_id=p.boonpon_id WHERE i.boonpon_id = '".$boonpon_id."'");

			print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:200mm;empty-cells: show;margin-top:45px;\">");
				////อันเดิม width:180mm; margin-top:55px;
				print("<tr>");
					print("<td  class='font-style' style='width:2%;padding-left:40px;' ><b> ");
						print("<br>");
						print("&nbsp;&nbsp;&nbsp;");
						print(printShortMount($get_data[0]['delivery_date']));
					print("</td>");
				print("</tr>");

				print("<tr>");
					print("<td align = \"center\" class='font-style' style='width:5%;font-size:26px;'><b>");
						print("บจก. บุญพรขนส่ง");
					print("</td>");
				print("</tr>");

				print("<tr>");

					print("<td align = \"center\" class='font-style' style='width:5%;padding-left: 110px;'><b>");
					print("<br>");
					print("<br>");
					$get_car = getlist("SELECT * FROM car_detail WHERE id_car='".$get_data[0]['idcar']."'");
					$get_driver = getlist("SELECT * FROM driver WHERE id_driver='".$get_data[0]['nameDriver']."'");
						print("ทะเบียน : ".$get_car[0]['licenceplates']."  (".$get_driver[0]['namedriver1'].")");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:5%;padding-left: 110px;'><b>");
					print("<br>");
					print("<br>");
					$get_product = getlist("SELECT * FROM type_production WHERE id_production='".$get_data[0]['product_id']."'");
						print($get_product[0]['alis_name']);
					print("</td>");
				print("</tr>");
			print("</table>");
			print("<table  bgcolor =\"#FFFFFF\" border = \"0\" cellspacing = \"0\" cellpadding = \"2\" align = \"center\" valign = \"middle\" style=\"width:230mm;empty-cells: show; show;margin-top:20px;\">");
			////อันเดิม wigth:210mm;
			print("<tr style='height: 19mm;' colspan='5'>");
				print("<td style='hight:10mm;'> ");
				print("</td>");
			print("</tr>");
				print("<tr>");

			$get_shipping = getlist("SELECT * FROM fule_detail WHERE id_ship='".$get_data[0]['delivery_name']."' and car_type='".$get_car[0]['typecar']."'");
					//ตัวเลขระยะทาง
					print("<td align = \"right\" class='font-style' style='width:14%; padding-right:2mm;'><b> ");
						//width เดิม 18% 14-10-62
						print(ReadNumber($get_data[0]['final']));
						//ReadNumber
					print("</td>");
					print("<td  class='font-style' style='width:3%;'><b> ");
							print("&nbsp;&nbsp;".$get_data[0]['final']);
					print("</td>");
					print("<td class='font-style' style='width:4%;' ><b> ");
						print("&nbsp;&nbsp;ลิตร");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:15%; line-height:30px;' ><b> ");
						print("น้ำมันดีเซล มาตราฐาน ");
					print("</td>");
						print("<td align = \"center\" class='font-style' style='width:5%;' ><b> ");
						print($get_shipping[0]['standard']);
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:15%;' ><b> ");
					print("</td>");
					print("<td align = \"center\" class='font-style' style='width:20%;' ><b> ");
					print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='3' ><b> ");
							
					print("</td>");

					print("<td align = \"center\" class='font-style'  ><b> ");
								print("เพิ่ม-ลด : ");
					print("</td>");

					print("<td align = \"center\" class='font-style'  ><b> ");
								print($get_data[0]['up']);
					print("</td>");
				print("</tr>");
				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='3' ><b> ");
							
					print("</td>");

					print("<td align = \"center\" class='font-style' style='line-height:37px;' ><b> ");
								print("เติมมาแล้ว : ");
					print("</td>");

					print("<td align = \"center\" class='font-style'  ><b> ");
								print($get_data[0]['fill_oil']);
					print("</td>");
				print("</tr>");

				print("<tr>");
					print("<td align = \"center\" class='font-style' colspan='3' ><b> ");
							
					print("</td>");

					print("<td align = \"center\" class='font-style'  style='line-height:15px;' ><b> ");
								print("สุทธิ : ");
					print("</td>");
					print("<td align = \"center\" class='font-style'  ><b> ");
								print($get_data[0]['final']);
					print("</td>");
				print("</tr>");

				print("<tr>");
	
						$get_ship = getlist("SELECT * FROM shipping WHERE id_ship='".$get_data[0]['delivery_name']."'");
					print("<td align = \"center\" class='font-style' style='width:20%; height:10mm;' colspan='7' ><b> ");
								//print("<br>"); แก้ 14-10-62
								print($get_ship[0]['detailship']." - ".$get_ship[0]['country']);
					print("</td>");
				print("</tr>");

				print("<tr>");
	
					
					print("<td align = \"center\" class='font-style' style='width:20%;' colspan='7' ><b> ");
							cut_invoice();
					print("</td>");
				print("</tr>");
			print("</table>");



function cut_invoice(){
	global $get_data;
		$product = array();

					for ($p=0; $p <sizeof($get_data) ; $p++) { 
						if(!in_array($get_data[$p]['product_id'],$product)){
							$product[] = $get_data[$p]['product_id'];
						}
					}
					$tax = array();
						for($i=0;$i<sizeof($get_data);$i++){
							if(!in_array($get_data[$i]['invoice'],$tax)){
								$tax[] = $get_data[$i]['invoice'];
							}
						}

	
						//sort($tax);
						$cut_invoice = array();
						for($s=0;$s<sizeof($tax);$s++){
							$cut =substr($tax[$s], 0,8);
							if(!in_array($cut,$cut_invoice)){
							$cut_invoice[] = $cut;
							}
						}

						for ($l=0; $l < sizeof($cut_invoice); $l++) 
						{ 
							$m = 1;
							$u = 0;
							for($i=0;$i<sizeof($tax);$i++)
							{
								$data3 = strpos($tax[$i],$cut_invoice[$l]);
									if($data3 !== FALSE)
									{
										if($m==1)
										{
											print strtoupper($tax[$i]);
											$m=2;
										}else{
											print substr($tax[$i], 8,8);

										}
										
										if(!empty($tax[$i+1])){
											print ",";
										}
										$u += 1;
										//print($u);
						
									}

									
								
							}

						}

						
					
}
?>
