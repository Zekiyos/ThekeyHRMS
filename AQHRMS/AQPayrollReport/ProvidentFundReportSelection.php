<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type='text/javascript'>
function SelectedFileName(elem, helperMsg){
	//document.writeln(elem.value);
	alert ( "You have Slelcted " + elem.value + "!")
	var ID=elem.value;
	//alert("http://localhost/AQHRMS/AQPayrollReport/PayrollSheet/"+elem.value)
//location="Court_Case.php?ID=" + elem.value;
//location="D:/wamp/www/aqhrms/payroll report/html2/"+elem.value;
//location="http:/localhost/AQHRMS/payroll%20report/html2/July_2011_PF.html";
url1="http:/AQPayrollReport/ProvidentFund/"+elem.value
window.open(url1)
window.close()
	if(elem.value == "Please Choose ID"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}

</script>
<body>
<form name="SelectedReport" action="">
<?php
    $file=opendir("ProvidentFund/");
	echo "<select  id=\"selectedfilename\">";
    while($dir1=readdir($file))
      {
		 if (substr($dir1,-6)=="1.html")
          echo "<option>$dir1</option>";
         //else
		 
	 //echo  $_Left($dir1);
    //echo $dir1."<br>";
       }
echo "</select>";
?>
<input type="submit" value="OK" onclick="SelectedFileName(document.getElementById('selectedfilename'), 'Please Choose Something')" />
</form>

</body>
</html>