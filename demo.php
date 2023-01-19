<?php

function pre($array) {
    echo '<pre>';

    print_r($array);

    echo '</pre>';
}

function get_Date_Range($From_Date, $To_Date) {

    $start = strtotime($From_Date);


    $end = strtotime($To_Date);



    $incriment = 60 * 60 * 24;

    $date_rage = array();
    for ($i = $start; $i <= $end; $i += $incriment) {

        $date_rage[] = date('Y-m-d', $i);
    }
    return $date_rage;
}

$result = get_Date_Range('2012-09-10', '2012-09-18');

function hour2sec($hr) {

    $time = explode(':', $hr);

    $second = 0;

    if (isset($time[0])) {
        $second = $time[0] * 3600;
    }
    if (isset($time[1])) {
        $second +=$time[1] * 60;
    }
    if (isset($time[2])) {
        $second +=$time[2];
    }
    return $second;
}


function sec2hour($sec) {
    $remain = 0;
    $remain = $sec % 3600;
    $hour = ($sec - $remain) / 3600;
    $min = '00';
    $se = '00';
    if ($remain > 0) {
        $rm = $remain % 60;
        $min = ($remain - $rm) / 60;
        if ($min < 10) {
            $min = 0 . $min;
        }
        if ($rm > 0) {
            $se = $rm;
            if ($se < 10) {
                $se = 0 . $se;
            }
        }
    }
    return $hour . ':' . $min . ':' . $se;
}

echo sec2hour(17400);
echo '<br/>';
echo hour2sec('4:50');
?>
