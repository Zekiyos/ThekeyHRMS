<div id="Chart_Option" class="top_bar">
    <p >Chart Option<a class="show_search down">&nbsp;</a></p>
    <?php
    if ((substr($Chart_Type, 0, 2) == 'MS' ) || (substr($Chart_Type, 0, 7) == 'Stacked' )) {
        $series = 'Multi';
    } else {
        $series = 'Single';
    }

    echo '<form method="post" name="form1" id="form_multiple">';
    echo'<table>';
    echo '<tr> <td height="2" align="right" nowrap="nowrap" colspan="1">Chart Type</td>';
    echo '<td align="left" colspan="3">';
    echo '<select name="chartType" id="chartType" class="\chartType\"  >';
    echo '<option >--Select Chart Type--</option>';

    $objChart->getChartType($series);

    echo '</select>';
    echo '</td>';
    echo '<td align="left">';
    // echo '<input type="button" value="Show Sample" onclick="updateQueryStringParameter(\'chartType\')" />';
    echo '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Show Name</td>';
    echo '<td align="left"><input type="radio" checked   id="showName" name="showName" value="1" />YES';
    echo '<input type="radio" id="showName" name="showName" value="0" />NO';
    echo '</td>';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Rotate Name</td>';
    echo '<td align="left"><input type="radio"    id="rotateNames" name="rotateNames" value="1" />YES';
    echo '<input type="radio" checked id="rotateNames" name="rotateNames" value="0" />NO';
    echo '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Split in to</td>';
    echo '<td align="left" colspan="3">';
    echo '<select name="chartSplit" id="chartSplit"   >';

    for ($i = 1; $i <= 10; $i++) {
        echo '<option >' . $i . '</option>';
    }

    echo '</select>';
    echo '</td>';

    echo'<tr> ';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Chart Width</td>';
    echo '<td align="left"> <input name="chartWidth" id="chartWidth" value="650" type="text3" size="3"  />';
    echo '</td>';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Chart Height</td>';
    echo '<td align="left"> <input name="chartHeight" id="chartHeight" value="450" type="text3" size="3" />';
    echo '</td>';
    echo '</tr>';
    echo'<tr> ';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="3">';
    echo '<td align="left"><input type="submit" value="Display Chart" /></td>';
    echo '</tr>';

    echo '</table>';

    echo '<input type="hidden" name="MM_insert" value="form1" />';
    echo '</form>';

//    // $objChart->generate_Chart('Smaple Chart', 200, 100, $_GET['chartType']);
//
//    $strXML = "<graph caption='Monthly Unit Sales' rotateNames='1' xAxisName='Month' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
//    $strXML .= "<set name='Jan' value='462' color='AFD8F8' />";
//    $strXML .= "<set name='Feb' value='857' color='F6BD0F' />";
//    $strXML .= "<set name='Mar' value='671' color='8BBA00' />";
//    $strXML .= "<set name='Apr' value='494' color='FF8E46'/>";
//    $strXML .= "<set name='May' value='761' color='008E8E'/>";
//    $strXML .= "<set name='Jun' value='960' color='D64646'/>";
//    $strXML .= "<set name='Jul' value='629' color='8E468E'/>";
//    $strXML .= "<set name='Aug' value='622' color='588526'/>";
//    $strXML .= "<set name='Sep' value='376' color='B3AA00'/>";
//    $strXML .= "<set name='Oct' value='494' color='008ED6'/>";
//    $strXML .= "<set name='Nov' value='761' color='9D080D'/>";
//    $strXML .= "<set name='Dec' value='960' color='A186BE'/>";
//    $strXML .= "</graph>";
//
//    //Create the chart - Column 3D Chart with data from strXML variable using dataXML method
//
//    if (isset($_GET['chartType']))
//        echo renderChart("Chart/Charts/" . $_GET['chartType'], "", $strXML, "Smaple_Chart", 500, 250);
    ?>
</div>
