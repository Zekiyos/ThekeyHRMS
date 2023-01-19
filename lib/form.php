<?php

if (!defined('validurl'))
    exit('No direct script access allowed');
/* Form : this class help to create html from <br>
 * such as Text Box,<br>
 * Check box<br>
 * Radio box<br>
 * Drop down<br>
 * Grid<br>
 * Image<br>
 * @author Raju Mesfin rajumesfin@gmail.com
 */

class Form {

    public function open_html($element, $attributes = array()) {
        return "<" . $element . " " . $this->set_attributes($attributes) . " >";
    }

    public function close_html($element) {
        return "</" . $element . ">";
    }

    public function html($element, $attributes = array(), $value = "") {
        $html = "<" . $element . " " . $this->set_attributes($attributes) . " >";
        $html .=$value;
        $html .="</" . $element . ">";
        return $html;
    }

    /**
     * Lets you generate a standard text input field.
     * @param Array/String $attributes Html Attributes of text box
     * @return String Html text box
     */
    public function textbox($attributes) {
        if (!is_array($attributes)) {
            $attributes["name"] = $attributes;
        }
        return "<input type=\"Text\" " . $this->set_attributes($attributes) . "> ";
    }

    public function password($attributes) {
        if (!is_array($attributes)) {
            $attributes["name"] = $attributes;
        }
        return "<input type=\"password\" " . $this->set_attributes($attributes) . "> ";
    }

    public function file($attributes) {
        if (!is_array($attributes)) {
            $attributes["name"] = $attributes;
        }
        return "<input type=\"file\" " . $this->set_attributes($attributes) . "> ";
    }

    /**
     * Lets you generate a standard text area field.
     * @param Array/String $attributes Html Attributes of Text Area
     * @return String HTML Text Area
     */
    public function textarea($attributes, $value = "") {
        if (!is_array($attributes)) {
            $attributes["name"] = $attributes;
        }
        return "<textarea " . $this->set_attributes($attributes) . ">" . $value . "</textarea> ";
    }

    /**
     * Lets you generate a standard fadio field.
     * @param Array/String $attributes Html Attributes of radio
     * @return String HTML Radio
     */
    public function radio($attributes) {
        if (!is_array($attributes)) {
            $attributes["name"] = $attributes;
        }
        return "<input type=\"radio\" " . $this->set_attributes($attributes) . "> ";
    }

    /**
     * Lets you generate a standard HTML button field.
     * @param Array/String $attributes Html Attributes of Button
     * @return String HTML Button
     */
    public function button($attributes) {
        if (!is_array($attributes)) {
            $attributes["name"] = $attributes;
        }
        return "<input type=\"button\" " . $this->set_attributes($attributes) . "> ";
    }

    /**
     * Lets you generate a standard Submit Button.
     * @param Array/String $attributes Html Attributes of Submit Button
     * @return String HTML Submit Button
     */
    public function submit($attributes) {
        if (!is_array($attributes)) {
            $attributes["name"] = $attributes;
        }
        return "<input type=\"submit\" " . $this->set_attributes($attributes) . "> ";
    }

    /**
     * Lets you generate a standard Lable field.
     * @param Array/String $attributes Html Attributes of Lable
     * @return String HTML Lable
     */
    public function lable($attributes) {
        if (!is_array($attributes)) {
            $attributes["name"] = $attributes;
        }
        return "<lable " . $this->set_attributes($attributes) . "> ";
    }

    /**
     * Lets you generate a standard Select field.
     * @param Array/String $attributes Html Attributes of Text Area
     * @param Array/Object $record list of record to be displayed
     * @param string $selected the option to be selected
     * @return string String HTML Select filed
     */
    public function dropdown($record, $optionkey, $optionvalue, $attribute, $selected = "") {
        if (!is_array($attribute)) {
            $attribute["name"] = $attribute;
        }
        $select = "<select " . $this->set_attributes($attribute) . ">";
        $select .='<option value="">-- Select --</option>';
        foreach ($record as $key => $value) {

            if ($selected != $value[$optionvalue])
                $select = $select . "\n" . "<option value=\"" . $value[$optionkey] . "\">" . $value[$optionvalue] . "</option>";
            else
                $select = $select . "\n" . "<option selected=\"selected\" value=\"" . $value[$optionkey] . "\">" . $value[$optionvalue] . "</option>";
        }
        $select = $select . "\n </select> ";
        return $select;
    }

    public function html_dropdown($record,$selected,$attribute) {
        if (!is_array($attribute)) {
            $attr=array();
            $attr["name"] = $attribute;
            $attr["id"] = $attribute;
        }
        
        $select = "<select " . $this->set_attributes($attr) . ">";
        $select .='<option value="">-- Select --</option>';
        foreach ($record as $key => $value) {
            if ($selected != $value)
                $select = $select . "\n" . "<option value=\"" . $value . "\">" . $value . "</option>";
            else
                $select = $select . "\n" . "<option selected=\"selected\" value=\"" . $value . "\">" . $value . "</option>";
        }
        $select = $select . "\n </select> ";
        return $select;
    }

    /**
     * Lets you generate a standard Check box field.
     * @param Array/String $attributes Html Attributes of Check box
     * @return String HTML Check box
     */
    public function checkbox($attributes) {
        if (!is_array($attributes)) {
            $attributes = "name=\"" . $attributes . "\" " . "id=\"" . $attributes . "\"";
        }
        $checkboxattributes = $this->set_attributes($attributes);
        return "<input type=\"checkbox\" " . $checkboxattributes . ">";
    }

    public function datepicker($attributes) {
        if (is_array($attributes)) {
            if (isset($attributes['name'])) {
                $name = $attributes['name'];
            }
        } else {
            $name = $attributes;
        }
        $datepic = '<script>
	$(function() {
		$( "#' . $name . '" ).datepicker({
			changeMonth: true,
			changeYear: true,
                        dateFormat: "yy-mm-dd"
		});
	});
	</script>';
        $datepic .= $this->textbox($attributes);
        return $datepic;
    }

    /**
     * recive array that contian html attribute and value then convert to  Html format
     * @param Array $attributes array contain html attribute as key and its value <br>
     * <b>Example</b> array("name"=>"myname","id"=>"myid","class"=>"myclass")
     * @return String prepare the attribute like this name=myname id=myid class=mycss
     */
    private function set_attributes($attributes) {
        $checkboxattributes = "";
        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                if ($checkboxattributes == "") {
                    if ($value != '')
                        $checkboxattributes = $key . "=\"" . $value . "\"";
                    else
                        $checkboxattributes = $key;
                } else {
                    if ($value != '')
                        $checkboxattributes = $checkboxattributes . " " . $key . "=\"" . $value . "\"";
                    else
                        $checkboxattributes = $checkboxattributes . " " . $key;
                }
            }
        } else {
            $checkboxattributes = $attributes;
        }
        return $checkboxattributes;
    }

    /**
     *
     * @param String $value the Value that display as link
     * @param string $attribute HTML anchorn attribute such as name, id , classs
     * <b>Example</b> array("name"=>"myname","id"=>"myid","class"=>"mycss")
     * @return string Html Anchorn <br>
     * <b>Example </b> &lt;a href="http://cytekoffice.com" class="mycss" name="myname">my office &lt;/a>
     */
    public function anchorn($value, $attribute) {
        if (!is_array($attribute)) {
            $attribute = "href=\"" . $attribute . "\"";
        }
        return "<a " . $this->set_attributes($attribute) . ">" . $value . "</a>";
    }

    /**
     *
     * @param Array $attribute HTML Image attribute such as name, id , classs
     * <b>Example</b> array("name"=>"myname","id"=>"myid","class"=>"mycss")
     * @return String HTML Image
     * <b>Example </b> &lt;img src="../img/raju.png" class="mycss" name="myname">
     */
    public function image($attribute) {
        if (!is_array($attribute)) {
            $attribute = "src=" . $attribute . "\"";
        } else {
            $attribute = $this->set_attributes($attribute);
        }

        return "<img " . $attribute . ">";
    }

    /**
     *
     * @param String $path
     */
    public static function redirect($path) {
        $url = "<script type=\"text/javascript\">
            window.location=\"" . $path . "\";" .
                "</script>";
        echo $url;
    }

}

?>