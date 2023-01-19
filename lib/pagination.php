<?php

if (!defined('validurl'))
    exit('No direct script access allowed');

/**
 * Display links that allows you to navigate from page to page, like this:
 * |<< 1  2  3  4  5  >>   >>|
 * @author Raju Mesfin Salilih rajumesfin@gmail.com
 *
 */
class pagination {

    /**
     * Total number of record
     * @var <type>
     */
    private $_totalelement;

    /**
     * a text to be displayed before each page number
     * @var String
     */
    public $prifix;

    /**
     * the page that contain the pagination
     * @var String
     */
    private $_baseurl;
    private $_elementperpage; // number of record to be displayed per page

    /**
     *
     * @param String $base_url
     * @param Integer $total_elemetn
     * @param Integer $element_per_page 
     */

    function __construct($base_url = "", $total_elemetn = 0, $element_per_page = 10) {
        $this->_totalelement = $total_elemetn;
        $this->_baseurl = $base_url;
        $this->_elementperpage = $element_per_page;
    }

    /**
     * Set number of element to be displayed per page
     * @param Integer $numberofelement
     */
    function set_element_per_page($numberofelement) {
        $this->_elementperpage = $numberofelement;
    }

    /**
     * This is the full URL to the page containing your pagination.
     * @param String $url
     */
    function baseurl($url) {
        $this->_baseurl = $url;
    }

    /**
     * Return  links that allows you to navigate from page to page, like this:<br>
     * <pre> |<< 1  2  3  4  5  >>  >>|</pre>
     *
     * Note: <br>
     * This function return empty string when there is no pagination to show.
     * @return String
     */
    function generatepagination() {
        $currentpage = 0;
        if (isset($_GET["navpage"])) {
            if (is_numeric($_GET["navpage"])) {
                $currentpage = $_GET["navpage"];
            }
        } else {
            $currentpage = $this->_elementperpage;
        }
        if ($this->_totalelement <= 0) {
            return "You have to set Total Element ";
        }
        if ($this->_elementperpage <= 0) {
            return "You have to set Element per page";
        }
        if ($this->_baseurl == "") {
            return "You have to set Base URL";
        }
        $oldpage = $currentpage;
        $currentpage = $currentpage / $this->_elementperpage;
        if (($currentpage * $this->_elementperpage) < $oldpage) {
            $currentpage++;
        }
        $totalpagemod = ($this->_totalelement % $this->_elementperpage);
        if ($totalpagemod == 0) {
            $totalpage = ($this->_totalelement / $this->_elementperpage);
        } else {
            $totalpage = (($this->_totalelement - $totalpagemod) / $this->_elementperpage) + 1;
        }
        if ($currentpage != 0) {
            if ($currentpage > 3) {
                $startfrom = $currentpage - 2;
            } else {
                $startfrom = 1;
            }
        } else {
            $startfrom = 1;
        }
        $paginationresult = "";
        for ($i = $startfrom; $i <= $startfrom + 5; $i++) {
            if ($totalpage >= $i)
                if ($i != $currentpage) {
                    $paginationresult .= "<li class=pages><div><a href=\"" . $this->_baseurl . "navpage=" . ($i * $this->_elementperpage) . "\">" . $i . "</a></div></li>";
                } else {
                    $paginationresult .= "<li class=currentpages><div>" . $i . "</div></li>";
                }
        }

        if ($currentpage > 1) {
            $paginationresult = "<li class=pre><div><a class=\"ui-icon ui-icon-seek-prev\" href=\"" . $this->_baseurl . "navpage=" . (($currentpage * $this->_elementperpage) - $this->_elementperpage ) . "\">&nbsp;</a></div></li>" . $paginationresult;
            $paginationresult = "<li class=first><div><a class=\"ui-icon ui-icon-seek-first\" href=\"" . $this->_baseurl . "\">&nbsp;</a></div></li>" . $paginationresult;
        }
        if ($currentpage < $totalpage) {
            $paginationresult = $paginationresult . "<li class=next><div ><a class=\"ui-icon ui-icon-seek-next\"  href=\"" . $this->_baseurl . "navpage=" . (($currentpage * $this->_elementperpage) + $this->_elementperpage) . "\">&nbsp;</a></div></li>";
            $paginationresult = $paginationresult . "<li  class=last><div><a class=\"ui-icon ui-icon-seek-end\" href=\"" . $this->_baseurl . "navpage=" . ($totalpage * $this->_elementperpage) . "\">&nbsp;</a></div></li>";
        }
        if ($this->_totalelement > $this->_elementperpage)
            return "<ul class=\"pegination\">" . $paginationresult . "</ul>";
    }

    /**
     * this function set the total rows in the result set you are creating pagination for. Typically this number
     * will be the total rows that your database query returned.
     * @param Integer $total Total rows of the element you want to create pagination
     */
    function totalelement($total) {
        $this->_totalelement = $total;
    }

}

?>
