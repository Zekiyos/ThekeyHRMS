<?php

if (!defined('validurl'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gride
 *
 * @author raju
 */
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'lib/form.php';

class gride extends Form {

    //put your code here
    private $_data;
    private $_headerInfo;
    private $_status;
    private $_chekbox;
    private $_control;
    private $_visibility;
    private $_link;
    private $_convert;
    private $_group_by;
    private $_action;
    private $sort_order = 'asc';
    private $sort_by;
    private $sortable = false;
    private $base_url;

    /**
     *
     * @param Array $data list of recored to be displayed as Table <br>
     * <b>Example </b>
     * <code>
     * array(
     *      array(
     *          "first_name"=>"Raju",
     *          "last_name"=>"Mesfin"),
     *      array(
     *          "first_name"=>"Elias",
     *          "last_name"=>"Mesfin"));
     * </code>
     * @link http://www.example.com Example hyperlink inline link} links to
     */
    function setData($data) {
        $this->_data = $data;
    }

    /**
     * This Function Enable us to add action button on the greed
     * @param String $action name of the action
     * @param String $url url of the acction is redirect to
     * @param String $key_filed the filed that use as a key
     */
    function set_acction($action, $url, $key_filed = '') {
        if (is_array($this->_action)) {
            $this->_action[$action] = array(
                'url' => $url,
                'key_filed' => $key_filed);
        } else {
            $this->_action = array(
                $action => array(
                    'url' => $url,
                    'key_filed' => $key_filed));
        }
    }

    /**
     * This function enable as to set the url where the pagination and the action buttons navigat to
     * @param String $url
     */
    function set_base_url($url) {
        if (preg_match("/\/^/", $url)) {
            $url = $url . "index.php";
        }
        $this->base_url = $url;
    }

    /**
     * This Funciton Enable us to grou and create Sub total Informaiton
     * @param String $grou_by_filed the filed we want to group and get every breaking point
     * @param array $operation  what operation have to be performed on each sub total
     * <code>
     * $operation=array('fname'=>'count',
     * 'age'=>average);
     * $group_by_filed=$sex
     * </code>
     * the above code group the record and calculate averate for age and count fnmae filed
     */
    function set_sub_total($grou_by_filed, $operation) {
        if (!is_array($this->_group_by)) {
            $this->_group_by = array();
        }
        $this->_group_by[$grou_by_filed] = $operation;
    }

    /**
     * This function enable as to set item ordered filed
     * @param String $filed
     */
    function set_sort_by($filed, $order) {
        $this->sort_by = $filed;
        $this->sort_order = $order;
        $this->sortable = true;
    }

    /**
     *
     * @param Array $headerInfo the caption for each collumens
     * <b>Example </b> array("fname"=>"First Name","uname"=>"User Name")
     */
    function setHeaderInfo($header) {
        $this->_headerInfo = $header;
    }

    /**
     * @param String $status  to specify and edit each rows according to some status<br>
     * <b>Example</b> let assume you want the gride to display Inbox message <br>
     * then you wan't to make the read and unread message different style u give the <br>
     * filed you want to specify the status such as message status filed if the message status <br>
     * is read it will make the text color red else blue
     */
    function setStatus($status) {
        $this->_status = $status;
    }

    /**
     * @param Array $chekbox display check box at the begining of each row.<br>
     * <b>Example</b><br>
     * Array("user_name")<br> this will add a check box at the begining of <br>
     * each row and its value and name will be the user_name filed
     */
    function showChekbox($chekbox) {
        $this->_chekbox = $chekbox;
    }

    /**
     * @param Array $link this make specific filed to be link or anchorn<br>
     * <b>Example</b><br>
     * Array(<br>
     *       "screen_name" => array(<br>
     *           "link" => "viewusermessage.php",<br>
     *           "lable" => "Edit",<br>
     *           "key" => "user_name"), // this make screen_name link and its lable will be Edit<br>
     *       "user_name" => array(<br>
     *           "link" => "fuckyou.php",<br>
     *           "key" => "user_name")// this make the filed user_name link and it lable will be the value of user_name filed value<br>
     *   ),
     */
    function setLink($link) {
        $this->_link = $link;
    }

    /**
     * @param Array $control this make the specific filed a controller such as image , text box
     * <b>Example</b>
     * <pre>
     * array("user_name" => array(
     *           "type" => "image",
     *           "value" => "pic",
     *           "lable"=>"screen_name",
     *           "attribute" => array(
     *               "width" => "60px",
     *               "height" => "60px"
     *           )
     *       )
     *   )</pre>
     * <br> this make the filed user_name image and its lable screen_name<br>
     */
    function setControl($control) {
        $this->_control = $control;
    }

    /**
     * @param Array $hide list of filed not to be displayed on the gride
     * <b>Example</b>
     * array("pic"=>False)
     */
    function hide($visibility) {
        if (is_array($visibility)) {
            if (is_array($this->_visibility)) {
                $this->_visibility = array_merge($this->_visibility, $visibility);
            } else {
                $this->_visibility = $visibility;
            }
        } else {
            if (!is_array($this->_visibility)) {
                $this->_visibility = array();
            }
            $this->_visibility[$visibility] = $visibility;
        }
    }

    function convertTo($conver) {
        $this->_convert = $conver;
    }

    /**
     * Convert Two dimensional array to table
     * @return String Recored converted as Html Table
     */
    function generate($showEdit = false, $showDelete = false) {
        $myform = new Form();
        $header = "";

        if ($this->sortable) {
            if ($this->base_url == "") {
                throw new Exception("If the grid is sortabel you have to specifiy base url!");
            }
            if ($this->sort_by == "") {
                throw new Exception("If the grid is sortabel you have to specifiy The Defult Sort By Filed!");
            }
        }

        if (count($this->_data)) {

            // //------------------------------------------------//
            //------------------------------------------------//
            /** This Block of code Create The grid Header * *Start /* */
            //------------------------------------------------//
            //------------------------------------------------//

            if (is_array($this->_data)) {
                foreach ($this->_data[0] as $key => $value) {
                    if (isset($this->_visibility[$key])) {
                        continue;
                    }
                    $header_lable = '';
                    if (isset($this->_headerInfo[$key])) {
                        $header_lable = $this->_headerInfo[$key];
                    } else {
                        $header_lable = preg_replace('/_/', ' ', $key);
                    }
                    if ($this->sortable) {
                        $link = $this->base_url;
                        if (preg_match('/[?]/', $this->base_url)) {
                            $link .='&';
                        } else {
                            $link .='?';
                        }

                        $link .= 'sort_by=' . $key . "&sort_order=";

                        $link .= ($this->sort_order == "asc" && strtolower($this->sort_by) == strtolower($key)) ? "desc" : "asc";
                        $attr = array('href' => $link);
                        if ((strtolower($this->sort_by) == strtolower($key))) {
                            $attr['class'] = $this->sort_order;
                        }
                        $header_lable = $this->anchorn($header_lable, $attr);
                    }
                    $header = $header . "<Th>" . $header_lable . "</Th>\n";
                }
            }
            if (isset($this->_chekbox[0])) {
                $header = '<Th><input type="checkbox" name="selectall" value="selectall" id="selectall" /></Th>' . "\n" . $header;
            }

            if (is_array($this->_action)) {
                if (count($this->_action) > 0) {
                    $header = '<Th>&nbsp;</Th>' . "\n" . $header;
                }
            }

            // //------------------------------------------------//
            //------------------------------------------------//
            /** This Block of code Create The grid Header * *End /* */
            //------------------------------------------------//
            //------------------------------------------------//


            $tables = "";
            $count = 0;

            // //------------------------------------------------//
            //------------------------------------------------//
            /** This Block of code Initialize  The grid Sub total Fileds to zero * *Start /* */
            //------------------------------------------------//
            //------------------------------------------------//

            if (isset($this->_group_by)) {
                foreach ($this->_group_by as $groupkey => $groupvalue) {
                    foreach ($groupvalue as $subtotalkey => $subtotalvalue) {
                        $new_var = $groupkey . $subtotalvalue . $subtotalkey;
                        $$new_var = 0;
                    }
                    $count_this = 'count_' . $groupkey;
                    $$count_this = 0;
                }
            }
            $group_by_filed_value = '';
            foreach ($this->_data as $key => $rows) {

                $new_group_by = $this->_group_by;
                $count++;
                $row = "";
                $is_first = TRUE;

                // //------------------------------------------------//
                //------------------------------------------------//
                /** This Block of code Calculate And Display   The grid Sub total * *Start /* */
                //------------------------------------------------//
                //------------------------------------------------//
                if (is_array($this->_group_by)) {
                    $my_group = '';

                    //begning of group by filed
                    $group_id = 0;
                    foreach ($this->_group_by as $group_by_key => $group_by_value) {
                        $group_id++;
                        $group_by_filed_value = 'Groupby_' . $group_by_key;
                        if (!isset($$group_by_filed_value)) {
                            $$group_by_filed_value = '';
                        }
                        unset($new_group_by[$group_by_key]);
                        if (strtolower($$group_by_filed_value) != strtolower($rows[$group_by_key])) {

                            if ($$group_by_filed_value != '') {
                                if (!is_array($new_group_by)) {
                                    $new_group_by = array();
                                } else {
                                    $new_group_by = array_reverse($new_group_by);
                                }

                                $new_group_by[$group_by_key] = $group_by_value;
                                $n_of_new_group = count($this->_group_by);
                                foreach ($new_group_by as $newgkey => $newgvalue) {

                                    $my_group = '<tr  class="footer group' . $n_of_new_group . '">' . "\n";
                                    $n_of_new_group--;
                                    foreach ($rows as $rowkey => $rowvalue) {
                                        if (isset($newgvalue[$rowkey])) {
                                            $cur_opperation = $newgvalue[$rowkey];
                                            $new_var = $newgkey . $cur_opperation . $rowkey;
                                            $my_group .='<td>' . "\n";
                                            if (strtolower($cur_opperation) == 'avg') {
                                                $count_this = 'count_' . $newgkey;
                                                $my_group .=$$new_var / $$count_this;
                                            } else {
                                                $my_group .=$$new_var;
                                            }

                                            $my_group .='</td>' . "\n";
                                        } else {
                                            $my_group .='<td>&nbsp;</td>' . "\n";
                                        }
                                    }
                                    $my_group .='</tr>' . "\n";
                                    foreach ($newgvalue as $subtotalkey => $subtotalvalue) {
                                        $new_var = $newgkey . $subtotalvalue . $subtotalkey;
                                        $$new_var = 0;
                                    }
                                    $tables .=$my_group;
                                }
                            } else {
                                $changed = true;
                            }

                            $$group_by_filed_value = $rows[$group_by_key];

                            $my_group = '<tr  class="group' . $group_id . '">' . "\n";
                            $total_col = (count($rows) - count($this->_visibility));
                            if ($this->_chekbox != '') {
                                $total_col++;
                            }
                            if (isset($this->_action)) {
                                $total_col++;
                            }
                            $my_group .='<td colspan=' . $total_col . '>' . "\n";
                            $my_group .=$rows[$group_by_key];
                            $my_group .='</td>' . "\n";
                            $my_group .='</tr>' . "\n";
                            $tables .=$my_group;
                        }

                        foreach ($group_by_value as $subtotalkey => $subtotalvalue) {
                            $new_var = $group_by_key . $subtotalvalue . $subtotalkey;
                            if (strtolower($subtotalvalue) == 'count') {
                                $$new_var = $$new_var + 1;
                            } else if (strtolower($subtotalvalue) == 'sum' || strtoupper($subtotalvalue) == 'avg') {
                                $$new_var +=$rows[$subtotalkey];
                            } else if (strtolower($subtotalvalue) == 'max') {
                                if ($$new_var < $rows[$subtotalkey]) {
                                    $$new_var = $rows[$subtotalkey];
                                }
                            } else if (strtolower($subtotalvalue) == 'min') {
                                if ($$new_var > $rows[$subtotalkey]) {
                                    $$new_var = $rows[$subtotalkey];
                                }
                            }
                        }
                        $count_this = 'count_' . $group_by_key;
                        $$count_this = 0;
                    }

                    // end of group by for loop
                }

                // //------------------------------------------------//
                //------------------------------------------------//
                /** This Block of code Calculate And Display   The grid Sub total * *End /* */
                //------------------------------------------------//
                //------------------------------------------------//
                // //------------------------------------------------//
                //------------------------------------------------//
                /** This Block of code Display   Every Columen of Each Row* *End /* */
                //------------------------------------------------//
                //------------------------------------------------//



                foreach ($rows as $colskey => $colsvalue) {
                    if (isset($this->_visibility[$colskey])) {
                        continue;
                    }
                    if (isset($this->_convert[$colskey])) {
                        $colsvalue = util::convert($colsvalue, $this->_convert[$colskey]);
                    }
                    $thiscontrol = "";
                    if (isset($this->_control[$colskey])) {
                        $attribute = array();
                        if (isset($this->_control[$colskey]["attribute"])) {
                            $attribute = $this->_control[$colskey]["attribute"];
                        }
                        $newcontroler = $this->_control[$colskey]["type"];
                        $lable = isset($this->_control[$colskey]["value"]) ? $rows[$this->_control[$colskey]["value"]] : $colsvalue;
                        $createdControler = $this->_control[$colskey]["type"];
                        if ($newcontroler == 'image') {
                            $attribute["src"] = "../img/" . $lable;
                        }
                        if ($newcontroler != 'anchorn') {

                            $thiscontrol = $this->$createdControler($attribute);
                        } else {
                            $caption = $rows[$this->_control[$colskey]["caption"]];
                            $link = $this->_control[$colskey]["link"] . $rows[$this->_control[$colskey]["key"]];
                            $attribute["href"] = $link;
                            $thiscontrol = $this->$createdControler($caption, $attribute);
                        }
                        if (isset($this->_control[$colskey]["lable"])) {
                            $thiscontrol = $thiscontrol . "<br>" . $rows[$this->_control[$colskey]["lable"]];
                        }
                    } else {

                        $thiscontrol = $colsvalue;
                    }

                    if (!isset($this->_link[$colskey]))
                        $row = $row . "<td>" . $thiscontrol . "</td>\n";
                    else {
                        if (isset($this->_link[$colskey])) {
                            $keyvalue = "";
                            if (isset($this->_link[$colskey]["key"]))
                                $keyvalue = $rows[$this->_link[$colskey]["key"]];
                            $lable = isset($this->_link[$colskey]["lable"]) ? $this->_link[$colskey]["lable"] : $thiscontrol;
                            $row = $row . "<td>" . $this->anchorn(
                                            $lable, $this->_link[$colskey]["link"] .
                                            $keyvalue
                                    ) .
                                    "</td>\n";
                        } else {
                            $row = $row . "<td>" . $colsvalue . "</td>\n";
                        }
                    }
                }


                // //------------------------------------------------//
                //------------------------------------------------//
                /** This Block of code Display   Every Columen of Each Row* *End/* */
                //------------------------------------------------//
                //------------------------------------------------//
                // //------------------------------------------------//
                //------------------------------------------------//
                /** This Block of code check if the check box enabled and Display    * *Start/* */
                //------------------------------------------------//
                //------------------------------------------------//


                $my_action = '';

                if (isset($this->_action)) {
                    foreach ($this->_action as $actionkey => $actionvalue) {
                        $my_url = $actionvalue['url'];
                        if ($actionvalue['key_filed'] != '') {
                            if (isset($rows[$actionvalue['key_filed']])) {
                                $my_url = $my_url . '?' . $actionvalue['key_filed'] . '=' . $rows[$actionvalue['key_filed']];
                            }
                        }
                        $my_action .= '<a href="' . $my_url . '" class="ui-icon ' . $actionkey . '">' . ucwords(strtolower($actionkey)) . '</a>';
                    }
                    if ($my_action != '') {
                        $my_action = '<td>' . $my_action . '</td>' . "\n";
                    }
                }


                if (isset($this->_chekbox[0])) {
                    $row = "<td>\n" .
                            $this->checkbox(array(
                                "id" => "chkall",
                                "name" => "chk" . $rows[$this->_chekbox[0]],
                                "value" => $rows[$this->_chekbox[0]]
                            ))
                            . "</td>\n" . $my_action . $row;
                } else {
                    $row = $my_action . $row;
                }
                if ($this->_status != "") {
                    $tables = $tables . "\n\n\n<tr class=\"" . $rows[$this->_status] . "\" >" . $row . "\n\n\n<tr>\n";
                } else {
                    $tables = $tables . "\n\n\n<tr>" . $row . "</tr>\n";
                }
            }

            // //------------------------------------------------//
            //------------------------------------------------//
            /** This Block of code check if the check box enabled and Display    * *End/* */
            //------------------------------------------------//
            //------------------------------------------------//
            // //------------------------------------------------//
            //------------------------------------------------//
            /** This Block of code Generate The last SubTotal    * *Start/* */
            //------------------------------------------------//
            //------------------------------------------------//


            $my_group = '<tr>' . "\n";
            foreach ($rows as $rowkey => $rowvalue) {
                if (isset($this->_sub_total_operation[$rowkey])) {
                    $cur_opperation = $this->_sub_total_operation[$rowkey];
                    $new_var = $rowkey . $cur_opperation;
                    $my_group .='<td>' . "\n";
                    if (strtolower($cur_opperation) == 'avg') {
                        $my_group .=$$new_var / $count_this;
                    } else {
                        $my_group .=$$new_var;
                    }

                    $my_group .='</td>' . "\n";
                } else {
                    $my_group .='<td>&nbsp;</td>';
                }
            }
            $my_group .='</tr>';
            $tables .=$my_group;

            // //------------------------------------------------//
            //------------------------------------------------//
            /** This Block of code Generate The last SubTotal    * *Start/* */
            //------------------------------------------------//
            //------------------------------------------------//


            $tables = "<table class=\"rgrid\" cellpadding=2>\n
                <thead>
                \n\n\n<tr>\n" .
                    $header .
                    "</tr>\n
                       </thead><tbody> " .
                    $tables .
                    "</tbody></table>\n";
            if (($showEdit ) || ($showDelete)) {
                $form = '<form method="post">';
                $form .= '<div id="rajGrideMainContainer">';

                $form .= '<div id="rajGridContainer">';
                $form .= $tables;
                $form .= '</div>';

                $form .= '<div id=rajGridAction>';
                if ($showEdit) {
                    $form .= $myform->submit(array('name' => 'editData', 'id' => 'editData', 'value' => 'Edit'));
                }
                if ($showDelete) {
                    $form .= $myform->submit(array('name' => 'deleteData', 'id' => 'deleteData', 'value' => 'Delet'));
                }
                $form .= '</div>';


                $form .= '</div>';

                $form .= '</form>';
                $tables = $form;
            }
            return $tables;
        }
    }

}

?>
