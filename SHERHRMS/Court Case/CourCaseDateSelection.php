<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="CourCaseReport.php" method="post" name="DataSelection"><table>
<tr><td align="right">From</td><td>
<script type='text/JavaScript' src="../Calender/scw.js" ></script>
<input type="text" name="FromDate" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d");?>' />
</td><td>TO</td><td><input type="text" name="TODate" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d");?>' /></td><td><input type="submit" value="Display" /></td></tr></table> 
</form>
</body>
</html>