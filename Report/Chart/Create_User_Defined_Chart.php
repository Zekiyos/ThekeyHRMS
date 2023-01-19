<div id="User_Defined_Chart" class="top_bar">
    <p >Create User Defined Chart<a class="show_search down">&nbsp;</a></p>
    <?php
    require_once $appRoot . '/Classes/Class_Chart.php';
    require_once $appRoot . '/Classes/Class_report.php';

    $objReport = new Report();
    $objChart = new Chart();

    if ((isset($_GET['report']))) {
        $reportName = $_GET['report'];

        list($reportName, $reportDescription, $Report_Field,
                $Report_Field_Display_Name, $tableName, $Join_Table) = $objReport->get_Report_Defintion($reportName);

        $reportField = explode(',', $Report_Field);
    }
    ?>
    <table  name="creatChart" id="creatChart"  align="center" background="" bgcolor="#EBEBEB">
        <tr> <td height="2" align="right" nowrap="nowrap" colspan="2">Chart Name</td>
            <td align="left"> <input name="Chart_Name" type="text" />  </td>
        </tr>
        <tr> 
            <td height="2" align="right" nowrap="nowrap" colspan="2">Chart Caption</td>
            <td align="left"> <input name="Chart_Caption" type="text" />  </td>
        </tr>
        <tr> <td height="2" align="right" nowrap="nowrap" colspan="2">Chart Type</td>
            <td align="left">
                <select name="Chart_Type" class="Chart_Type" >
                    <?php $objChart->getChartType('Single'); ?>
                </select>
            </td>
        </tr>
        <tr> 
            <td height="2" align="right" nowrap="nowrap" colspan="2">X-axis Title</td>
            <td align="left"> <input name="X_axis_Title" type="text" />  </td>
        </tr>
        <tr> 
            <td height="2" align="right" nowrap="nowrap" colspan="2">X-axis Category Field</td>
            <td align="left">
                <select name="X_axis_Category_Field"  >
                    <?php
                    foreach ($reportField as $key => $value) {
                        echo '<option Value="' . $value . '">' . $value . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr> 
            <td height="2" align="right" nowrap="nowrap" colspan="2">Y-axis Title</td>
            <td align="left"> <input name="Y_axis_Title" type="text"  />  </td>
        </tr>
        <tr> 
            <td height="2" align="right" nowrap="nowrap" colspan="2">Y-axis Summary Field</td>
            <td align="left">
                <select name="Y_axis_Summary_Field" class="Chart" >
                    <?php
                    foreach ($reportField as $key => $value) {
                        echo '<option Value="' . $value . '">' . $value . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td height="2" align="right" nowrap="nowrap" colspan="2">Y-axis Summary Value</td>
            <td align="left">
                <select name="Y_axis_Summary_Value" class="Chart" >
                    <?php $objChart->get_Y_xis_Summary_Value(); ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td><td>
            <td colspan="2">&nbsp;&nbsp;<input type="submit" value="Creat Chart" /></td>
        </tr>
    </table>
</div>