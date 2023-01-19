<?php

function pre($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

echo "1) " . dirname($_SERVER['SCRIPT_FILENAME']) . PHP_EOL; // 1) /etc
?>