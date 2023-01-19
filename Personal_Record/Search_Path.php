<?php

$term = $_REQUEST['q'];
$dir = "..\..\Employee_Images\/";
$images = array_slice(scandir($dir), 2);
foreach ($images as $value) {
    if (strpos(strtolower($value), $term) === 0) {
        echo $value . "\n";
    }
}
?>
