<?php require_once('../Connections/HRMS.php'); ?>
<?php

$term = $_REQUEST['q'];

$sqlEP = "SELECT Equipment_Picture_Path FROM company_settings";

$resultEP = mysql_query($sqlEP) or die(mysql_error());

$rowEP = mysql_fetch_array($resultEP);

$Equipment_Picture_Path = $rowEP['Equipment_Picture_Path'];



if ($Equipment_Picture_Path == "") {

    echo "<script type=\"text/javascript\"> alert('Equipment picture path has not set on the Company Settings.');</script>";

    echo "<script type=\"text/javascript\">
	 var answer = confirm(\"Do you want to set the path of Equipment Pictures now?\")
	       if (answer)
        window.location = \"../Company Setting Wizard/CompanySettingWizard.php\"
    </script>";
} else {
    $dir = $Equipment_Picture_Path;
}

if (!file_exists($dir)) {
    $dir = $base_path . 'Equipment_HandOver\Equipment_Picture\\';
}

if (file_exists($dir)) {
    $images = array_slice(scandir($dir), 2);
    foreach ($images as $value) {
        if (strpos(strtolower($value), $term) === 0) {
            echo $value . "\n";
        }
    }
}
?>
