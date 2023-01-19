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
	alert("http://localhost/AQHRMS/payroll%20report/html2/"+elem.value)
//location="Court_Case.php?ID=" + elem.value;
//location="D:/wamp/www/aqhrms/payroll report/html2/"+elem.value;
//location="http:/localhost/AQHRMS/payroll%20report/html2/July_2011_PF.html";
url1="http:/AQHRMS/payroll%20report/html/"+elem.value
window.open(url1)
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
    $file=opendir("D:/wamp/www/aqhrms/payroll report/html/");
	echo "<select  id=\"selectedfilename\">";
    while($dir1=readdir($file))
      {
		 if (substr($dir1,-4)=="html")
          echo "<option>$dir1</option>";
         //else
		 
	 //echo  $_Left($dir1);
    //echo $dir1."<br>";
       }
echo "</select>";
?>
<input type="submit" value="OK" onclick="SelectedFileName(document.getElementById('selectedfilename'), 'Please Choose Something')" />
</form>
<?php
/*// starting word
$word = new COM("word.application") or die("Unable to instantiate Word");
echo "Loaded Word, version {$word->Version}\n";

//bring it to front
$word->Visible = 1;

//open an empty document
$word->Documents->Add();

//do some weird stuff
$word->Selection->TypeText("This is a test...");
$word->Documents[1]->SaveAs("C:\Useless test.doc");

//closing word
$word->Quit();

//free the object
$word = null;
*/


/*$COM_Object = "CrystalReports11.ObjectFactory.1";
$my_report = "C:\\rpt1.rpt";
$my_pdf = "C:\\report.pdf";

$ObjectFactory= New COM($COM_Object);
$crapp = $ObjectFactory->CreateObject("CrystalDesignRunTime.Application");
$creport = $crapp->OpenReport($my_report, 1);
$creport->ReadRecords(); // attention!

$creport->ExportOptions->DiskFileName=$my_pdf;
$creport->ExportOptions->PDFExportAllPages=true;
$creport->ExportOptions->DestinationType=1; // Export to File
$creport->ExportOptions->FormatType=31; // Type: PDF
$creport->Export(false);*/

?>

</body>
</html>