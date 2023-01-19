<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        <link href="../../Css/ProgressBar.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <?php require_once('../../Connections/HRMS.php'); ?>
        <?php
        require_once('../../Classes/Class_AccessLevel.php');
        $obj_AccessLevel = new AccessLevel();
        echo $obj_AccessLevel->CHK_AccessLevel();
        ?>
        <?php
        require_once('../../Classes/Class_ProgressBar.php');
        $obj_prg_bar = new Progress_Bar();

        require_once('../../Classes/Class_ThekeyPayrollSystem_Data_Setting.php');

        $obj_PayrollData = new ThekeyPayrollSystem_Data_Setting();

//session_start();

        $FieldData = $_POST['FieldData'];
        $Field = $_POST['Field'];

        $obj_prg_bar->progressbar('' . $Field . ' is updating by value: ' . $FieldData . ' ', 250000, ' ' . $Field . ' Update Has Been Done.');
        $IDNo = "";
//if(isset($_POST['IDNo']))
        $IDNo = $_SESSION['IDNo'];
//echo $_SESSION['IDNo'];
//$IDNo=$_SESSION['IDNo'];

        $arrIDNo = Explode(",", $IDNo);





        foreach ($arrIDNo as $value) {
            //$update=$obj_PayrollData->update("total_deduction",array("".$Field.",".$FieldData.""),array("ID=$value")); 
            //$update=$obj_PayrollData->update("total_deduction",array("Position_Allowance,888"),array("ID=ZR-00001")); 
            //$update=$obj_PayrollData->update("total_deduction",array("FirstName,Updated"),array("ID=ZR-00001")); 	

            $update = $obj_PayrollData->UpdatePayrollData("total_deduction", $Field, $FieldData, $value);
        }
        if (isset($update) and ($update)) {
            session_unset();
            echo "<script type=\"text/javascript\"> alert('You have Updated Payroll Data Setting Successfully!!'); </script>";
        }
        ?>


    </body>
</html>