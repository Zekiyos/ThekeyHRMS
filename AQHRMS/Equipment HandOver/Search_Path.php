<?php
$term = $_REQUEST['q'];
$dir="E:\HRM\AQHRMS\Equipment HandOver\Equipment_Picture\\";
$images = array_slice(scandir($dir), 2);
foreach($images as $value) {
	if( strpos(strtolower($value), $term) === 0 ) {
		echo $value . "\n";
	}
}
?>
