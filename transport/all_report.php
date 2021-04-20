
<div class="styled-select yellow1 rounded">
			
	<select onchange="window.location=this.options[this.selectedIndex].value">
				<option value = ''>เลือกรายงาน </option>
				<?php
						query("USE transport");
						$gettype = getlist("SELECT sidebarName,sidebarTarget FROM sidebar where sidebarShow ='2'");
						for($i=0 ; $i<sizeof($gettype) ; $i++){
							print("<option value = \"index.php?path=".$gettype[$i]['sidebarTarget']."\"".$selected.">".$gettype[$i]['sidebarName']."</option>");
						}
				?>
			</select>
			

</div>