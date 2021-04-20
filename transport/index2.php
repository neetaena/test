<?php
	@session_start();
	@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	$database="transport";
	$path=!empty($_GET['path']) ? $_GET['path'].".php" : "content.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรแกรมจัดการขนส่งสินค้า</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel = "stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel = "stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
	<link href="../include/style.css" rel = "stylesheet" />
    <!-- Page-Level CSS -->
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
  	 <link href="assets/plugins/bootstrap/bootstrap.css" rel = "stylesheet" />
	 <link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
		<script type="text/javascript" src="datetimepicker/jquery.js"></script>
		<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  
  <script>

					$(function() {
						$( "#customers" ).autocomplete({
							source: 'search_customer.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
							minLength: 1,
							
						});
					});
					$(function() {
						$( "#Sendlocation" ).autocomplete({
							source: 'search_location.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
							minLength: 1,
							
						});
					});

</script>
	
 </head>


<body>
<header >
<div style="margin-top : 30px; margin-left : 15px;">
		<?php include("../include/listProgram.php"); ?>
		
</div>
</header>

    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role = "navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                            <div class="user-info">
                                <div class = "user-text-online">
                                    VANACHAI GROUP
                                </div>
                            </div>
                        <!--end user image section-->
                    </li>
                    <li class = "selected">
                        <a href = "index.php"><i class = "fa fa-dashboard fa-fw"></i> หน้าหลัก </a>
                    </li>
					<?php
						include("sidebar.php");
					?>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class = "row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><b>โปรแกรมการจัดการขนส่งสินค้า<b></h1>
                </div>
			
						
						
				
                <!--End Page Header -->
            </div>
				<?php
									if(!empty($_POST['Submit_login']))
									{
										
										$username_login = $_POST['txtUsername'];
										$password_login = $_POST['txtPassword'];
										$check_login = getlist("select * from account where username='$username_login' and password ='$password_login'");
										if($check_login)
										{
											session_start();
											$_SESSION["id_login"] = sizeof($check_login[0]['id_account']);
											session_write_close();
										}
										
										
									}
									
							if($_SESSION["id_login"]== 1)
							{
								if(!empty($_GET['path'])){
									query("USE transport");
									include($path);
								} else {
									include("content.php");
								}
							}else{
											//include("login.php");
											echo "<script type='text/javascript'>window.location.href = \"http://server-golf/main\";</script>";

											
							}
					
				?>
        </div>
        <!-- end page-wrapper -->
    </div>
    <!-- end wrapper -->
    <!-- Core Scripts - Include with every page -->
   
 
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
</body>

</html>
