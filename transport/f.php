<html>
<head>
<title>ThaiCreate.Com JavaScript Add/Remove Element</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<script language="javascript">
	function CreateNewRow()
	{
		var intLine = parseInt(document.frmMain.hdnMaxLine.value);
		intLine++;
			
		var theTable = document.all.tbExp
		var newRow = theTable.insertRow(theTable.rows.length)
		newRow.id = newRow.uniqueID
		
		var item1 = 1
		var newCell
		
		//*** Column 1 ***//
		newCell = newRow.insertCell(0)
		newCell.id = newCell.uniqueID
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column1_"+intLine+"\" VALUE=\"\"></center>"

		//*** Column 2 ***//
		newCell = newRow.insertCell(1)
		newCell.id = newCell.uniqueID
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column2_"+intLine+"\" VALUE=\"\"></center>"		
		
		//*** Column 3 ***//
		newCell = newRow.insertCell(2)
		newCell.id = newCell.uniqueID
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column3_"+intLine+"\" VALUE=\"\"></center>"				
		
		//*** Column 4 ***//
		newCell = newRow.insertCell(3)
		newCell.id = newCell.uniqueID
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column4_"+intLine+"\" VALUE=\"\"></center>"		
		
		//*** Column 5 ***//
		newCell = newRow.insertCell(4)
		newCell.id = newCell.uniqueID
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column5_"+intLine+"\" VALUE=\"\"></center>"			
		
		document.frmMain.hdnMaxLine.value = intLine;
	}
	
	function RemoveRow()
	{
		intLine = parseInt(document.frmMain.hdnMaxLine.value);
		if(parseInt(intLine) > 0)
		{
				theTable = (document.all) ? document.all.tbExp : 
				document.getElementById("tbExp")
				theTableBody = theTable.tBodies[0];
				theTableBody.deleteRow(intLine);
				intLine--;
				document.frmMain.hdnMaxLine.value = intLine;
		}	
	}	
</script>
<body>
<form name="frmMain" method="post">
<table width="445" border="1" id="tbExp">
  <tr>
    <td><div align="center">Column 1 </div></td>
    <td><div align="center">Column 2 </div></td>
    <td><div align="center">Column 3 </div></td>
    <td><div align="center">Column 4 </div></td>
    <td><div align="center">Column 5 </div></td>
  </tr>
</table>
<input type="hidden" name="hdnMaxLine" value="0">
<input name="btnAdd" type="button" id="btnAdd" value="+" onClick="CreateNewRow();">
<input name="btnDel" type="button" id="btnDel" value="-" onClick="RemoveRow();">
</form>
</body>
</html>