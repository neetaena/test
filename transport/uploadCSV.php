<?php include 'include/mySqlFunc.php'; 
	mysqli_select_db($link, 'transport2');
?> 
<?php

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
		$sql0 = "INSERT INTO `upload_data` ( `upload_datetime`, `user_upload`) 
		        	VALUES ('".date("Y-m-d")."','admin')";
		        	$result0 = mysqli_query($link,$sql0);
				   $last_id= mysqli_insert_id($link);
		//echo $last_id;
        
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
			
            $sales_order = "";
            if (isset($getData[0])) {
                $sales_order = mysqli_real_escape_string($link, $getData[0]);
				//echo $sales_order;
            }
            $name_customer = "";
            if (isset($getData[1])) {
                $name_customer = mysqli_real_escape_string($link, $getData[1]);
				echo $name_customer;
            }
            $address_customer = "";
            if (isset($getData[1])) {
                $address_customer = mysqli_real_escape_string($link, $getData[1]);
				//echo $address_customer;
            }
            $name_sale = "";
            if (isset($getData[7])) {
                $name_sale = mysqli_real_escape_string($link, $getData[7]);
				//echo $name_sale;
            }
            
            $date = "";
            		if (isset($getData[4])) {
                	$date = mysqli_real_escape_string($link, $getData[4]);
					$Requested_date = date("Y-d-m",strtotime($date));
						//echo $Requested_date;
            }
			//$sql = "INSERT INTO `saleorder` ( `sales_order`, `name_customer`, `address_customer`, `name_sale`, `Requested_date`, `upload_id`)
                 // values ('".$sales_order."','".$name_customer."','".$name_customer."','".$name_sale."','".$Requested_date."','".$last_id."')";
			
				   
                  // $result = mysqli_query($link, $sql);
				    
       				//if (! empty($result)) {
						//	$type = "success";
                			//$message = "เรียบร้อยครับ !!";
            				//} else {
							//	$type = "error";
                			//$message = "เกิดข้อผิดพลาด กรุณาัพโหลดใหม่ ";
            		//}  
			$check = " SELECT customer_name 
						FROM customer  
						WHERE customer_name = '$name_customer' ";
    		$result1 = mysqli_query($link, $check) or die(mysqli_error());
    		$num=mysqli_num_rows($result1);          // เช็คชื่อลูกค้าว่าซ้ำหรือป่าว
			
			if($num > 0)//ถ้าซ้ำให้อัพเดท
				{
				$strSQL2 = "UPDATE `customer` SET `customer_name` = '".$name_customer."' WHERE customer_name = '$name_customer';";
				$objQuery2 = mysqli_query($conn,$strSQL2);
    			
    			}else{ // ถ้าไม่ซ้ำให้เพิ่ม
	
					$sql = "INSERT INTO `customer`
					(`customer_name`)
					VALUES ('".$name_customer."')";
					$result = mysqli_query($link, $sql) or die ("Error in query: $sql " . mysqli_error());
 
				}
        
    }
}
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
    font-family: Arial;
    width: 800px;
	align-content: center;
}

.outer-scontainer {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-top: 0px;
    margin-bottom: 20px;
}

.btn-submit {
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor: pointer;
}

.outer-scontainer table {
    border-collapse: collapse;
    width: 100%;
}

.outer-scontainer th {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.outer-scontainer td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>โปรแกรมการจัดการขนส่ง</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
					
                    <label class="col-md-4 control-label">เลือกไฟล์ที่ต้องการ</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">ยืนยัน</button>
                    <br />

                </div>

            </form>

      </div>
			<?php
									$strSQL = "SELECT * FROM saleorder,upload_data WHERE saleorder.upload_id=upload_data.upload_id";
									$objQuery = mysqli_query($link,$strSQL);
								?>
	  <table width="104%" border="1" align="center" valign="top">
	  								<tr bgcolor="#1E90FF">
										<th width="154"> <div align="center">เลขใบสั่งขาย</div></th>
										<th width="348"> <div align="center">ชื่อลูกค้า</div></th>
										<th width="131"> <div align="center">วันที่อัพโหลด</div></th>
										<th width="97"> <div align="center">เพิ่มข้อมูล</div></th>
	  								</tr>
										<?php
											while($objResult = mysqli_fetch_array($objQuery))
											{
										?>
	  								<tr bgcolor="#87CEFA">
										<td><div align="left"><?php echo $objResult["sales_order"];?></div></td>
										<td><div align="left"><?php echo $objResult["name_customer"];?></div></td>
										<td><div align="right"><?php echo $objResult["upload_datetime"];?></div></td>
										<td><div align="right"><?php echo $objResult["status"];?></div></td>
	  								</tr>
										<?php
																	}
										?>
								</table>


    </div>

</body>

</html>