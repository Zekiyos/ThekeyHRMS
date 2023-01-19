<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('class/BCGFontFile.php');
require_once('class/BCGColor.php');
require_once('class/BCGDrawing.php');
require_once 'class/BCGcode128.barcode.php';

class generatebarcode {

    function generatebarcode($text) {
        $colorFront = new BCGColor(0, 0, 0);
        $colorBack = new BCGColor(255, 255, 255);


        $font = new BCGFontFile('./application/libraries/class/font/Arial.ttf', 18);


        $code = new BCGcode128(); // Or another class name from the manual
        $code->setScale(2); // Resolution
        $code->setThickness(10); // Thickness
        $code->setForegroundColor($colorFront); // Color of bars
        $code->setBackgroundColor($colorBack); // Color of spaces
        $code->setFont($font); // Font (or 0)

        $code->setLabel("");
        $code->parse($text); // Text


        $drawing = new BCGDrawing('', $colorBack);
        $drawing->setBarcode($code);
        $drawing->draw();

        header('Content-Type: image/png');
        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
    }

}

?>
