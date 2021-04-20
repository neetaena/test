<?php
	@session_start();
	@ini_set('display_errors', '0');
	include("../include/mySqlFunc.php");
	$database="transport";
	$path=!empty($_GET['path']) ? $_GET['path'].".php" : "content.php";

    query("USE account");
       // $get_user = getlist("SELECT * FROM `user` WHERE `id_user` = '".$_SESSION["id_user"]."'");
        $get_select = getlist("SELECT * FROM `user_select_program` WHERE `id_user` = '".$_SESSION["id_user"]."' and program_name='transport'");

    if (!empty($_POST['logout'])) {
            $_SESSION["id_login"] = 0;
            $_SESSION["permission"] ="";
            unset($_SESSION);
            echo "<script type='text/javascript'>window.location.href = \"https://www.my-vngs.com\";</script>";
    }
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
	<link rel="stylesheet" type = "text/css" href = "datetimepicker/jquery.datetimepicker.css">
	<script type="text/javascript" src="datetimepicker/jquery.js"></script>
	<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
<body>
<header >
<style type="text/css">
    .nav > li:hover a
    {
        color: #000;
    }
</style>

<?php
                 
?>
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
                            <div class = "user-info">
                                <div class = "user-text-online">
                                    VANACHAI GROUP
                                </div>
                            </div>
                        <!--end user image section-->
                    </li>
                    <li class = "selected">
                    <?php
                        $active2 = empty($_GET['path']) ? "class=\"active\"" :"";
                        print("<a href = \"index.php\" $active2><i class = \"fa fa-dashboard fa-fw\"></i> ตารางการจัดส่ง </a>");

                        ?>
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
                <div  style="float: left;">
                    <m style='font-size: 35px;' class="page-header1"><b>โปรแกรมการจัดการขนส่งสินค้า<b></m>
                </div>	
                <div style = " margin-left : 15px;float: right;margin-top: 5px;">
                    <form name="logout_form" method = "POST" action = "">
                        <input type="submit" name="logout" value="Logout" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่ ?')">
                        <?php
                      
                            print("<a class=\"nav-link drop_select\"  href=\"../path_select.php\" ><i class=\"ace-icon fa fa-arrows\"></i>เลือกโปรแกรมใหม่</a>");
                            
                        ?>
                    </form>
                    
                </div>
            <!--End Page Header -->
            </div>
					<?php
							if(!empty($_POST['Submit_login']))
							{
								$username_login = $_POST['txtUsername'];
                                $password_login = $_POST['txtPassword'];
								$password_login = $_POST['txtPassword'];
								$check_login = getlist("select * from account where username='$username_login' and password ='$password_login'");

								if($check_login)
									{
										session_start();
										$_SESSION["id_login"] = sizeof($check_login[0]['id_account']);
                                        $_SESSION["permission"] = $check_login[0]['permission'];
										session_write_close();
									}		
							}
							if($_SESSION["id_login"]== 1)
							{
								if(!empty($_GET['path'])){
									query("USE transport");
									include($path);
								} else {
									include("insertdatatransport.php");
								}
							}else{
								//include("login.php");
								echo "<script type='text/javascript'>window.location.href = \"..\";</script>";	
							}
				?>
        </div>
        <!-- end page-wrapper -->
    </div>
    <!-- end wrapper -->
    <!-- Core Scripts - Include with every page -->
    
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <!-- <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>-->

</body>

</html>
