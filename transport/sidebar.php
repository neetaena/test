	<?php
		query("USE transport");
			$getMenutab=getList("SELECT sidebarName,sidebarTarget,sidebarHead FROM sidebar WHERE sidebarHeaddetail = '1' AND sidebar.sidebarShow = '1'  and permission like '%".$_SESSION["permission"]."%'");
		for($i=0;$i<sizeof($getMenutab);$i++){
			$check = getlist("SELECT * FROM sidebar WHERE sidebarTarget='".$_GET['path']."'");
			$active1 = $check[0]['sidebarHead']==$getMenutab[$i]['sidebarHead'] ? "class=\"active\"" :"";
			print("<li><a href=\"#\" $active1>".$getMenutab[$i]['sidebarName']."<span class=\"fa arrow\"></span></a>");
				print("<ul class=\"nav nav-second-level\">");
					$getMenutab2=getList("SELECT sidebarName,sidebarTarget FROM sidebar WHERE sidebarHeaddetail <> '1' AND sidebarShow = '1' AND sidebarHead = '".$getMenutab[$i]['sidebarHead']."' and permission like '%".$_SESSION["permission"]."%' Order by sidebarHeaddetail ASC");
					for($j=0;$j<sizeof($getMenutab2);$j++){
						$active = $_GET['path']==$getMenutab2[$j]['sidebarTarget'] ? "class=\"active\"" :"";
						print("<li><a href=\"index.php?path=".$getMenutab2[$j]['sidebarTarget']."\" $active>".$getMenutab2[$j]['sidebarName']."</a></li>");
					}
				print("</ul>");
			print("</li>");
		}
	?>
