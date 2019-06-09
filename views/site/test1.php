<html>
<head>
<title>ThaiCreate.Com JavaScript Add/Remove Element</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
mysql_connect("localhost","root","");
mysql_select_db("bsc");
$strSQL = "SELECT * FROM contact";
$objQuery = mysql_query($strSQL);
?>
<script language="javascript">

	function CreateSelectOption(ele)
	{
		var objSelect = document.getElementById(ele);
		var Item = new Option("", ""); 
		objSelect.options[objSelect.length] = Item;
		<?php
		while($objResult = mysql_fetch_array($objQuery))
		{
		?>
		var Item = new Option("<?php echo $objResult["name"];?>", "<?php echo $objResult["photo"];?>"); 
		objSelect.options[objSelect.length] = Item;
		<?php
		}
		?>
	}

	function CreateNewRow()
	{
		var intLine = parseInt(document.frmMain.hdnMaxLine.value);
		intLine++;
			
		var theTable = document.getElementById("tbExp");
		var newRow = theTable.insertRow(theTable.rows.length)
		newRow.id = newRow.uniqueID

		var newCell
		
		//*** Column 1 ***//
		newCell = newRow.insertCell(0);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column1_"+intLine+"\"  ID=\"Column1_"+intLine+"\" VALUE=\"\"></center>";

		//*** Column 2 ***//
		newCell = newRow.insertCell(1);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column2_"+intLine+"\" ID=\"Column2_"+intLine+"\"  VALUE=\"\"></center>";
		
		//*** Column 3 ***//
		newCell = newRow.insertCell(2);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column3_"+intLine+"\"  ID=\"Column3_"+intLine+"\" VALUE=\"\"></center>";
		
		//*** Column 4 ***//
		newCell = newRow.insertCell(3);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"5\" NAME=\"Column4_"+intLine+"\"  ID=\"Column4_"+intLine+"\" VALUE=\"\"></center>";
		
		//*** Column 5 ***//
		newCell = newRow.insertCell(4);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><SELECT NAME=\"Column5_"+intLine+"\" ID=\"Column5_"+intLine+"\"></SELECT></center>";

		//*** Create Option ***//
		CreateSelectOption("Column5_"+intLine)
		
		document.frmMain.hdnMaxLine.value = intLine;
	}
	
	function RemoveRow()
	{
		intLine = parseInt(document.frmMain.hdnMaxLine.value);
		if(parseInt(intLine) > 0)
		{
				theTable = document.getElementById("tbExp");				
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