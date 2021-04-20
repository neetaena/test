<?php
	@ini_set('display_errors', '0');

	function show_description($id_order,$product_id){
		 $get_data = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE id_order='$id_order'");
    $bua = array(6,7,13,14,15,16);
    $floor = array(4,8,9,11,12,17,18,21);
    $rubber = array(19,20,21,22);
    $kaindl = array(23,24);
    $paper = array(3,5);
    $fer = array(25);
    		for($in=0; $in < sizeof($get_data); $in++) 
    		{ 
            if(in_array($get_data[$in]['product_id'],$bua)){
              print "บัวตัวจบ ".$get_data[$in]['plate']." ".$get_data[$in]['item_number']." ".$get_data[$in]['mark_name'].$get_data[$in]['box_name'];//รายการ 
            }elseif(in_array($get_data[$in]['product_id'],$paper)){
              print $get_data[$in]['type_w']." ".$get_data[$in]['item_number']." ".$get_data[$in]['type_mark']."".$get_data[$in]['mark_name'].$get_data[$in]['side']." ".$get_data[$in]['plate']." ".$get_data[$in]['gule'];//รายการ 
            }elseif($get_data[$in]['product_id']==4 or $get_data[$in]['product_id']==11 or $get_data[$in]['product_id']==12 or $get_data[$in]['product_id']==17 or $get_data[$in]['product_id']==21 or $get_data[$in]['product_id']==9){
             
               /* $gule_str = substr($get_data[$in]['plate'],1,1);//plate
                $plate_str = substr($get_data[$in]['plate'],2,1);//ระบบล็อค
                $box_str = substr($get_data[$in]['plate'],3,2);//กล่อง
                $get_lock_str = getlist("SELECT * FROM detail_sale_required WHERE detail_sale_insert='$plate_str' and detail_sale_type='2'");
                $get_plate_str = getlist("SELECT * FROM detail_sale_required WHERE detail_sale_insert='$gule_str' and detail_sale_type='1'");*/

                   print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['plate']." เซาะ ".$get_data[$in]['type_w']." ".$get_data[$in]['customer_mark'];//รายการ 
                    // print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule'].$get_lock_str[0]['detail_sale_code']." ".$get_plate_str[0]['detail_sale_code']." ".$get_data[$in]['side']." ".$box_str." เซาะ ".$get_data[$in]['type_w']." ".$get_data[$in]['customer_mark'];//รายการ 
                

                
            }elseif($get_data[$in]['product_id'] ==8 || $get_data[$in]['product_id'] ==18){
                    print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule']." ".$get_data[$in]['side']." ".$get_data[$in]['plate']." เซาะ ".$get_data[$in]['type_w'];//รายการ  
            }elseif(in_array($get_data[$in]['product_id'],$kaindl)){
                    print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule']." ".$get_data[$in]['side']." ".$get_data[$in]['plate'];//รายการ 
            }elseif(in_array($get_data[$in]['product_id'],$rubber)){
                    print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number'];//รายการ  
            }elseif(in_array($get_data[$in]['product_id'],$fer)){
                 print  $get_data[$in]['plate']." ขนาด ".$get_data[$in]['item_number']." mm. สี".$get_data[$in]['mark_name']." กล่อง ".$get_data[$in]['box_name'];//รายการ 
            }else{
              print  $get_data[$in]['detail_production']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule'];//รายการ 
            }
  
        }
	}


        function show_description_for_temporary($id_order,$product_id){
         $get_data = getlist("SELECT * FROM production_order as po inner join type_production as tp on product_id=id_production WHERE id_order='$id_order'");
    $bua = array(6,7,13,14,15,16);
    $floor = array(4,8,9,11,12,17,18,21);
    $rubber = array(19,20,21,22);
    $kaindl = array(23,24);
    $paper = array(3,5);
    $fer = array(25);
            for($in=0; $in < sizeof($get_data); $in++) 
            { 
            if(in_array($get_data[$in]['product_id'],$bua)){
              print "บัวตัวจบ ".$get_data[$in]['plate']." ".$get_data[$in]['item_number']." ".$get_data[$in]['mark_name'].$get_data[$in]['box_name'];//รายการ 
            }elseif(in_array($get_data[$in]['product_id'],$paper)){
              print $get_data[$in]['type_w']." ".$get_data[$in]['item_number']." ".$get_data[$in]['type_mark']."".$get_data[$in]['mark_name'].$get_data[$in]['side']." ".$get_data[$in]['plate']." ".$get_data[$in]['gule'];//รายการ 
            }elseif($get_data[$in]['product_id']==4 or $get_data[$in]['product_id']==11 or $get_data[$in]['product_id']==12 or $get_data[$in]['product_id']==17 or $get_data[$in]['product_id']==21 or $get_data[$in]['product_id']==9){
               /* if($get_data[$in]['product_id']==4){
                    if(!empty($get_data[$in]['customer_mark'])){
                        print $get_data[$in]['customer_mark']." ".$get_data[$in]['item_number']." ".$get_data[$in]['plate']." เซาะ ".$get_data[$in]['type_w'];//รายการ 
                    }else{
                         print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['plate']." เซาะ ".$get_data[$in]['type_w'];//รายการ 
                    }
                }else{
                    print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['plate']." เซาะ ".$get_data[$in]['type_w']." ".$get_data[$in]['customer_mark'];//รายการ 
                }*/
              
                $gule_str = substr($get_data[$in]['plate'],0,1);//plate

                $plate_str = substr($get_data[$in]['plate'],1,1);//ระบบล็อค
                $box_str = substr($get_data[$in]['plate'],2,2);//กล่อง
                $get_lock_str = getlist("SELECT * FROM detail_sale_required WHERE detail_sale_insert='$plate_str' and detail_sale_type='2'");
                $get_plate_str = getlist("SELECT * FROM detail_sale_required WHERE detail_sale_insert='$gule_str' and detail_sale_type='1'");

                 //  print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['plate']." เซาะ ".$get_data[$in]['type_w']." ".$get_data[$in]['customer_mark'];//รายการ 
                print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule']." ".$get_lock_str[0]['detail_sale_code']." ".$get_plate_str[0]['detail_sale_code']." ".$get_data[$in]['side']." กล่อง ".$box_str." เซาะ ".$get_data[$in]['type_w']." ".$get_data[$in]['customer_mark'];//รายการ 

                
            }elseif($get_data[$in]['product_id'] ==8 || $get_data[$in]['product_id'] ==18){
                    print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule']." ".$get_data[$in]['side']." ".$get_data[$in]['plate']." เซาะ ".$get_data[$in]['type_w'];//รายการ  
            }elseif(in_array($get_data[$in]['product_id'],$kaindl)){
                    print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule']." ".$get_data[$in]['side']." ".$get_data[$in]['plate'];//รายการ 
            }elseif(in_array($get_data[$in]['product_id'],$rubber)){
                    print $get_data[$in]['mark_name']." ".$get_data[$in]['item_number'];//รายการ  
            }elseif(in_array($get_data[$in]['product_id'],$fer)){
                  print  $get_data[$in]['plate']." ขนาด ".$get_data[$in]['item_number']." mm. สี".$get_data[$in]['mark_name']." กล่อง ".$get_data[$in]['box_name'];//รายการ 
            }else{
              print  $get_data[$in]['detail_production']." ".$get_data[$in]['item_number']." ".$get_data[$in]['gule'];//รายการ 
            }
  
        }
    }
?>