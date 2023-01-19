<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php /*
	$crapp = new COM ("CrystalRuntime.Application.9") or die ("Error on
	load");
	$creport = $crapp->OpenReport("c:/rpt1.rpt", 1);
	$creport->ExportOptions->DiskFileName="c:/test.rtf";
	$creport->ExportOptions->DestinationType=1; // Export to File
	$creport->ExportOptions->FormatType=4; // Type: RTF
	$creport->DiscardSavedData();
	$creport->Export(false);
	 
	$creport = null;
	$crapp = null;
	 
	print "...done";
	?>
<?php /*
    function export_excel_csv()
    {
        $conn = mysql_connect("localhost","root","");
        $db = mysql_select_db("PayrollDB",$conn);
       
        $sql = "SELECT * FROM Payroll_Data";
        $rec = mysql_query($sql) or die (mysql_error());
       
        $num_fields = mysql_num_fields($rec);
       
        for($i = 0; $i < $num_fields; $i++ )
        {
            $header .= mysql_field_name($rec,$i)."\t";
        }
       
        while($row = mysql_fetch_row($rec))
        {
            $line = '';
            foreach($row as $value)
            {                                           
                if((!isset($value)) || ($value == ""))
                {
                    $value = "\t";
                }
                else
                {
                    $value = str_replace( '"' , '""' , $value );
                    $value = '"' . $value . '"' . "\t";
                }
                $line .= $value;
            }
            $data .= trim( $line ) . "\n";
        }
       
        $data = str_replace("\r" , "" , $data);
       
        if ($data == "")
        {
            $data = "\n No Record Found!n";                       
        }
       
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=reports.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        print "$header\n$data";
    }
   */ ?>
    <?php
    //function export_excel_csv()
    //{
	//////	$DateValue='2011-07-02';  //assigning transfer date
//////  
//////   $WeekOFMonthSQL="SELECT WEEK('".$DateValue."',6) - WEEK(DATE_SUB('".$DateValue."', INTERVAL DAYOFMONTH('".$DateValue."')-1 DAY),6)+1 AS WeekOFMonth ";
//////						$resultWeekOFMonth = mysql_query($WeekOFMonthSQL);
//////				while($rowWeekOFMonth = mysql_fetch_array($resultWeekOFMonth, MYSQL_ASSOC))
//////				{
//////					
//////					$WeekOFMonth =$rowWeekOFMonth ['WeekOFMonth'];
//////					
//////					$UpdatedTabelName="week_".$WeekOFMonth."" ;
//////					
//////				}
//////				
//////        $conn = mysql_connect("localhost","root","");
//////        $db = mysql_select_db("aqhrmsdb",$conn);
//////       
//////        $sql = "SELECT * FROM ".$UpdatedTabelName.""; //payroll_data ORDER By ID";
//////        $rec = mysql_query($sql) or die (mysql_error());
//////       
//////   $num_fields = mysql_num_fields($rec);
//////       $header="";
//////	   $data="";
//////        for($i = 0; $i < $num_fields; $i++ )
//////        {
//////			
//////             $header .= mysql_field_name($rec,$i)."\t";
//////        }
//////       
//////	  
//////        while($row = mysql_fetch_row($rec))
//////        {
//////            $line = "";
//////            foreach($row as $value)
//////            {                                           
//////                if((!isset($value)) || ($value == ""))
//////                {
//////                    $value = "\t";
//////                }
//////                else
//////                {
//////                    $value = str_replace( '"' , '""' , $value );
//////                    $value = '"' . $value . '"' . "\t";
//////                }
//////                $line .= $value;
//////            }
//////            $data .= trim( $line ) . "\n";
//////        }
//////       
//////        $data = str_replace("\r" , "" , $data);
//////       
//////        if ($data == "")
//////        {
//////            $data = "\n No Record Found!n";                       
//////        }
//////       
//////        header("Content-type: application/octet-stream");
//////        header("Content-Disposition: attachment; filename=".date("M_Y_W").".xls");
//////        header("Pragma: no-cache");
//////        header("Expires: 0");
//////		print "$header". \n ."$data";
//////		
		
		
		$conn = mysql_connect("localhost","root","");
   $db = mysql_select_db("aqhrmsdb",$conn);

		$sql = "SELECT * FROM week_1"; //payroll_data ORDER By ID";
$result = mysql_query($sql);
$count = mysql_num_fields($result);

for ($i = 0; $i < $count; $i++){
$header .= mysql_field_name($result, $i)."\t";
}

while($row = mysql_fetch_row($result)){
$line = '';
foreach($row as $value){
if(!isset($value) || $value == ""){
$value = "\t";
}else{
# important to escape any quotes to preserve them in the data.
$value = str_replace('"', '""', $value);
# needed to encapsulate data in quotes because some data might be multi line.
# the good news is that numbers remain numbers in Excel even though quoted.
$value = '"' . $value . '"' . "\t";
}


$line .= $value;
}
$data .= trim($line)."\n";
}
# this line is needed because returns embedded in the data have "\r"
# and this looks like a "box character" in Excel
$data = str_replace("\r", "", $data);


# Nice to let someone know that the search came up empty.
# Otherwise only the column name headers will be output to Excel.
if ($data == "") {
$data = "\n no matching records found\n";
}

# This line will stream the file to the user rather than spray it across the screen
//header("Content-Type: application/vnd.ms-excel; name='excel'");

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=excelfile.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo $header."\n".$data;

//print "done";
		
	//}
	
	
	
	/*import start ing point
	
	if(isset($_POST['SUBMIT']))
    {
         $fname = $_FILES['sel_file']['name'];
        
         $chk_ext = explode(".",$fname);
        
         if(strtolower($chk_ext[1]) == "csv")
         {
        
             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");
       
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
             {
                $sql = "INSERT into user(name,email,phone) values('$data[0]','$data[1]','$data[2]')";
                mysql_query($sql) or die(mysql_error());
             }
       
             fclose($handle);
             echo "Successfully Imported";
         }
         else
         {
             echo "Invalid File";
         }   
    }
*/?>
    <!--form action='<?php //echo $_SERVER["PHP_SELF"];?>' method='post'>

        Import File : <input type="file" name='sel_file' size='20'>
        <input type='submit' name='submit' value='submit'>

    </form-->
	
	
	
	
   
    
</body>
</html>