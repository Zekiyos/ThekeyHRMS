<?php

if (isset($_GET['content'])) {

    $id_no = $_GET['content'];



    if (preg_match('/[-]/', $id_no)) {
        $matches = preg_split('/[-]/', $id_no);
        $id_no = $matches[1];
        $id_no .= '001';
    }
// set Barcode39 object


    if (preg_match('/^([0])+/', $id_no)) {
        // $id_no = preg_replace('/^[0]+/', '', $id_no);
    }
    $length = strlen($id_no);
    if ($length > 7) {
        $id_no = substr($id_no, strlen($id_no) - 7, 7);
    }



    $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';

    require($base_path . 'class/BCGFontFile.php');
    require($base_path . 'class/BCGColor.php');
    require($base_path . 'class/BCGDrawing.php');
    require($base_path . 'class/BCGcode39.barcode.php');


    $font = new BCGFontFile($base_path . 'class/font/Arial.ttf', 18);
    $color_black = new BCGColor(0, 0, 0);
    $color_white = new BCGColor(255, 255, 255);

// Barcode Part
    $code = new BCGcode39();
    $code->setScale(2);
    $code->setThickness(30);
    $code->setForegroundColor($color_black);
    $code->setBackgroundColor($color_white);
    $code->setFont($font);
    //$code->setStart(NULL);
    //$code->setTilde(true);
    $code->parse($id_no);

// Drawing Part
    $drawing = new BCGDrawing('', $color_white);
    $drawing->setBarcode($code);
    ob_clean();
    $drawing->draw();

    header('Content-Type: image/png');

    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
}
?>
