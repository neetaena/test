<?php 
include("../include/mySqlFunc.php");
query("USE transport");
if(!empty($_GET['delete_driver'])){
			$delete = query("delete from driver where id_driver ='".$_GET['delete_driver']."'");
			if($delete)
			{
				$message = "ลบข้อมูลเรียบร้อยแล้ว";
				print "<script type='text/javascript'>alert('$message');</script>";
				header('Location: index.php?path=report_driver');
			}else{
				$message = "ลบข้อมูลไม่สำเร็จ";
				print "<script type='text/javascript'>alert('$message');</script>";
			}
		}
else if(!empty($_GET['delete_car']))
{
	$delete1 = query("delete from car_detail where id_car ='".$_GET['delete_car']."'");
			if($delete1)
			{
				$message = "ลบข้อมูลเรียบร้อยแล้ว";
				print "<script type='text/javascript'>alert('$message');</script>";
				header('Location: index.php?path=reportcar');
			}else{
				$message = "ลบข้อมูลไม่สำเร็จ";
				print "<script type='text/javascript'>alert('$message');</script>";
			}
}
else if(!empty($_GET['delete_prodcut']))
{
			$a = query("delete from insertdatawarehouse where idwarehouse ='".$_GET['delete_prodcut']."'");
			$b = query("delete from productionorder where id_warehouse ='".$_GET['delete_prodcut']."'");
			if($a == true and $b==true)
			{
				$message = "ลบข้อมูลเรียบร้อยแล้ว";
				print "<script type='text/javascript'>alert('$message');</script>";
				header('Location: index.php?path=report_warehouse');
			}else{
				$message = "ลบข้อมูลไม่สำเร็จ";
				print "<script type='text/javascript'>alert('$message');</script>";
			}
}
else if(!empty($_GET['delete_allowance']))
{
			$a = query("delete from allowance where id_allowance ='".$_GET['delete_allowance']."'");
			if($a)
			{
				$message = "ลบข้อมูลเรียบร้อยแล้ว";
				print "<script type='text/javascript'>alert('$message');</script>";
				header('Location: index.php?path=report_Allowance');
			}else{
				$message = "ลบข้อมูลไม่สำเร็จ";
				print "<script type='text/javascript'>alert('$message');</script>";
			}
}else if(!empty($_GET['delete_shipping']))
{
	$a = query("DELETE from shipping where id_ship ='".$_GET['delete_shipping']."'");
			if($a)
			{
				$message = "ลบข้อมูลเรียบร้อยแล้ว";
				print "<script type='text/javascript'>alert('$message');</script>";
				header('Location: index.php?path=show_shipping');
			}else{
				$message = "ลบข้อมูลไม่สำเร็จ";
				print "<script type='text/javascript'>alert('$message');</script>";
			}
}else if(!empty($_GET['delete_customer']))
{
	$a = query("DELETE from customer where id_customer ='".$_GET['delete_customer']."'");
			if($a)
			{
				$message = "ลบข้อมูลเรียบร้อยแล้ว";
				print "<script type='text/javascript'>alert('$message');</script>";
				header('Location: index.php?path=show_customer');
			}else{
				$message = "ลบข้อมูลไม่สำเร็จ";
				print "<script type='text/javascript'>alert('$message');</script>";
			}
}
else if(!empty($_GET['delete_number']))
{
	$a = query("DELETE from production_order where data_number ='".$_GET['delete_number']."'");
		
			if($a)
			{
				$message = "ลบข้อมูลเรียบร้อยแล้ว";
				print "<script type='text/javascript'>alert('$message');</script>";
				print "<script>window.opener.location.reload();</script>";
				print "<script>window.close();</script>";
			}else{
				$message = "ลบข้อมูลไม่สำเร็จ";
				print "<script type='text/javascript'>alert('$message');</script>";
			}
}
?>