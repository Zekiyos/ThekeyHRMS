<?php 
include('../../User_account/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php echo "<script type=\"text/javascript\">confirm('Are you Sure you want to remove Expired Warning from active list');Expired Warning Remover</script>";?>
<?php require_once('../../Connections/HRMS.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_HRMS, $HRMS);
$query_RS4ExiredDeletion = "SELECT * FROM disciplinary_action";
$RS4ExiredDeletion = mysql_query($query_RS4ExiredDeletion, $HRMS) or die(mysql_error());
$row_RS4ExiredDeletion = mysql_fetch_assoc($RS4ExiredDeletion);
$totalRows_RS4ExiredDeletion = mysql_num_rows($RS4ExiredDeletion);



// DATEDIFF('ReportOn','$d')
                // $d=date("Y-m-d");
		 
		   $date = date("Y-m-d");
		   $Diff=180;
$SixMonthBeforedate = strtotime ( '-'.$Diff.' day' , strtotime ( $date ) ) ;
$SixMonthBeforedate = date ( 'Y-m-j' , $SixMonthBeforedate );
		  
		  $Copydisciplinary_action2Expired="INSERT INTO Expired_disciplinary_action () SELECT * FROM disciplinary_action WHERE Last_Warning_Date <= '".$SixMonthBeforedate."' OR (Third_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL) OR (Second_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL AND Third_Inistance_Date IS NULL)  OR ( First_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL AND Third_Inistance_Date='' AND Second_Inistance_Date IS NULL)";
		  
		  $DeleteExpireddisciplinary_action ="DELETE FROM disciplinary_action WHERE Last_Warning_Date <= '".$SixMonthBeforedate."' OR (Third_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL) OR (Second_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL AND Third_Inistance_Date IS NULL)  OR ( First_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL AND Third_Inistance_Date='' AND Second_Inistance_Date IS NULL)";
		  
       			 		$sqlDA= "SELECT * FROM disciplinary_action";
						
						$resultDA= mysql_query($sqlDA);
						
					
			//SELECT * FROM disciplinary_action WHERE Last_Warning_Date <= '2010-09-30' OR (Third_Inistance_Date <= '2010-09-30' AND Last_Warning_Date='') OR (Second_Inistance_Date <= '2010-09-30' AND Last_Warning_Date='' AND Third_Inistance_Date='')  OR ( First_Inistance_Date <= '2010-09-30' AND Last_Warning_Date='' AND Third_Inistance_Date='' AND Second_Inistance_Date='')
					
					if(mysql_num_rows(mysql_query("SELECT * FROM disciplinary_action WHERE Last_Warning_Date <= '".$SixMonthBeforedate."' OR (Third_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL) OR (Second_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL AND Third_Inistance_Date IS NULL)  OR ( First_Inistance_Date <= '".$SixMonthBeforedate."' AND Last_Warning_Date IS NULL AND Third_Inistance_Date='' AND Second_Inistance_Date IS NULL)")))
					
					//if(mysql_num_rows(mysql_query("SELECT * FROM disciplinary_action WHERE Last_Warning_Date <= '".$SixMonthBeforedate."' OR Third_Inistance_Date <= '".$SixMonthBeforedate."' OR Second_Inistance_Date <= '".$SixMonthBeforedate."' OR First_Inistance_Date <= '".$SixMonthBeforedate."'")))

						{
							
				while($row = mysql_fetch_array($resultDA, MYSQL_ASSOC))
				{
					
					if($row['Last_Warning_Date'] <>"")
					{
					
					if($row['Last_Warning_Date'] <=$SixMonthBeforedate)
			    {
					//Last warning date expired
					echo "<font color=\"#FF6600\" color=\"#FF0000\" size=\"+1\">".$row['FirstName']." ".$row['MiddelName']." ".$row['LastName']." Last Warning given on ".$row['Last_Warning_Date']." that means it was given before morethan 6 months.So it is set as EXPIRED Warning<br>";
					mysql_query($Copydisciplinary_action2Expired);//Copy exired Disciplinar action first before deletion
					
         			mysql_query($DeleteExpireddisciplinary_action);
					//delete exired from currentor active displinary action
					
				}
					}
				else
				if($row['Third_Inistance_Date'] <>"")
					{
					
					if($row['Third_Inistance_Date'] <=$SixMonthBeforedate)
			    {
					///Third instance warning date expired
					echo "<font color=\"#FF6600\" color=\"#FF0000\" size=\"+1\">".$row['FirstName']." ".$row['MiddelName']." ".$row['LastName']." Third Inistance given on ".$row['Third_Inistance_Date']." that means it was given before morethan 6 months.So it is set as EXPIRED Warning<br>";
					mysql_query($Copydisciplinary_action2Expired);//Copy exired Disciplinar action first before deletion
					
         			mysql_query($DeleteExpireddisciplinary_action);
					//delete exired from currentor active displinary action
					
				}
					}
				else
				if($row['Second_Inistance_Date'] <>"")
					{
					
					if($row['Second_Inistance_Date'] <=$SixMonthBeforedate)
			    {
						///Second instance warning date expired
						echo "<font color=\"#FF6600\" color=\"#FF0000\" size=\"+1\">".$row['FirstName']." ".$row['MiddelName']." ".$row['LastName']." Second Inistance given on ".$row['Second_Inistance_Date']." that means it was given before morethan 6 months.So it is set as EXPIRED Warning<br>";
					mysql_query($Copydisciplinary_action2Expired);//Copy exired Disciplinar action first before deletion
					
         			mysql_query($DeleteExpireddisciplinary_action);
					//delete exired from currentor active displinary action
					
				}
					}
				else
					if($row['First_Inistance_Date'] <>"")
					{
					
					if($row['First_Inistance_Date'] <=$SixMonthBeforedate)
			    {
					///First Inistanse warning date expired
					echo "<font color=\"#FF6600\" color=\"#FF0000\" size=\"+1\">".$row['FirstName']." ".$row['MiddelName']." ".$row['LastName']." First Inistance Warning given on ".$row['First_Inistance_Date']." that means it was given before morethan 6 months.So it is set as EXPIRED Warning<br>";
					mysql_query($Copydisciplinary_action2Expired);//Copy exired Disciplinar action first before deletion
					
         			mysql_query($DeleteExpireddisciplinary_action);
					//delete exired from currentor active displinary action
				
				}
					}
					
									
					
				}//loop closing
				
						}//closing exitance checker
				
			else			{		
			echo "<Script type=\"text/javascript\">alert('There is NO EXPIRED Warning.');</script>";	
						}
						
		
?>
</body>
</html>
<?php
mysql_free_result($RS4ExiredDeletion);
?>
