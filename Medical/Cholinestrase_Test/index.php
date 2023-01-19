 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
<title>Thekey HRMS</title>

<?php
    $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
    require_once $base_path . 'Templates/head.php';
    ?>
</head>

<body>
<div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
<div id="thekey_page">
 <?php require_once $base_path .'Templates/header.php'; ?>

  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
             <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>
                <?php
                if (isset($_GET['Auto_ID'])) {
                    $case_id = $_GET['Auto_ID'];
                    $mydb->where('Auto_ID', $case_id);
                    $result = $mydb->delete('cholinesterase_test');
                    if ($result) {
                        alert('You Have Succesffuly Delete the Record !');
                    }
                }



                $mydb = new DataBase();
                $header_lable = 'Employee Cholinesterase Test';
                $mydb = filter($mydb);
				$mydb = filter($mydb);
                $result = $mydb->get('cholinesterase_test');
                $total_num_row = $result['total_row'];                 $result = $result['result'];
if (count($result) > 0) {
                    $header_info = $result[0];
                }
                else
                {
                    $newresult = $mydb->get('cholinesterase_test',1);
                    if($newresult['count'])
                    {
                        $header_info = $newresult['result'][0];
                    }
                        
                }

                $update_page = 'CholinesteraseTestUpdate.php';
                $key_filed = 'Auto_ID';

                $hide = array('Auto_ID' => 'Auto_ID');
				$table="cholinesterase_test";

                require_once $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/gui/grid_view.php';
                ?>
  <!-- InstanceEndEditable -->
 </div>
  </div>
</body>
<!-- InstanceEnd --></html>


