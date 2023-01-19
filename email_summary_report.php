<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of email_summary_report
 *
 * @author raju
 */
class email_summary_report {

    //put your code here

    public $subject;
    public $message_content;
    public $data;

    function pre($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    function email_data() {
        $html = '';
        $header='';
        if (is_array($this->data)) {
            $first = true;
            foreach ($this->data as $key => $value) {
                $html .="<tr>\n";
                if (is_array($value)) {
                    foreach ($value as $vkey => $vvalue) {
                        if ($first) {
                            $header .="<th>$vkey<th>\n";
                        }
                        $html .= "<td>$vvalue</td>\n";
                    }
                } else {
                    if ($first) {
                        $header .="<th>$key<th>\n";
                    }
                    $html .= "<td>$value</td>\n";
                }
                $html .="</tr>\n";

                $first = false;
            }
        }
        $html .="<table>\n<thead>\n<tr>$header</tr>\n</thead>\n<tbody> $html</tbody>\n</table>";
        return $html;
    }

}

$summary = new email_summary_report();
$summary->data = array("Raju", "Mesfin", "Salilih");
echo $summary->email_data();
?>