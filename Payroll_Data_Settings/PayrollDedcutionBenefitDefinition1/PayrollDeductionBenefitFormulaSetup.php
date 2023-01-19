
<?php
require_once('../../Connections/HRMS.php');


include('../../Classes/Class_ThekeyPayrollSystem_Data_Setting.php');
$obj_PayrollData = new ThekeyPayrollSystem_Data_Setting();

//$obj_PayrollData->get_TotalDeductionBenefit_Columns("ALL");
?>
<script type="text/javascript">
    //function validate(frm)
    //{
    //	var ele = frm.elements['feedurl[]'];
    //
    //	if (! ele.length)
    //	{
    //		alert(ele.value);
    //	}
    //
    //	for(var i=0; i<ele.length; i++)
    //	{
    //		alert(ele[i].value);
    //	}
    //
    //	return true;
    //}

    function add_feed()
    {
        var div1 = document.createElement('div');

        // Get template data
        div1.innerHTML = document.getElementById('Divformulatpl').innerHTML;

        // append to our form, so that template data
        //become part of form
        document.getElementById('Divformula').appendChild(div1);

    }
    
    
    function add_NewFiled(DivNewFiled)
    {
        var div1 = document.createElement('div');
        var DivNewFiled=DivNewFiled;
        // Get template data
        div1.innerHTML = document.getElementById(DivNewFiled).innerHTML;

        // append to our form, so that template data
        //become part of form
        document.getElementById('Divformula').appendChild(div1);

    }
    
</script>

<style>
    .feed {padding: 5px 0}

    #Divformula > div
{
        /*height: 3px;
        width: 100px
          */  
    }
</style>

<form method="post" action="new_ele2.php" onsubmit="return validate(this)">

    <table>
        <tr>
            <td valign=top> Formula:</td>
            <td valign=top>
                <div id="Divformula" >

                </div>
            </td>
        </tr>
    </table>

    <p>
        <br>
        <input type="submit" name="submit1">
        <input type="reset" name="reset1">
    </p>

    <p id="addnew">
        <a href="javascript:add_NewFiled('DivNewFiled')">Add New Field </a><br>
        <a href="javascript:add_NewFiled('DivFiled')">Add Input Field </a><br>
        <a href="javascript:add_NewFiled('DivOperator')">Add Operator </a><br>
        <a href="javascript:add_NewFiled('DivInequality')">Add Inequality </a><br>
        <a href="javascript:add_NewFiled('DivConditional')">Add Conditional </a><br>
    </p>

</form>

<!-- Template. This whole data will be added directly to working form above -->


<div id="DivNewFiled" style="display:none">
    <div class="NewFiled">
        <input type="text" name="NewFiled[]" value=""  size="40">
    </div>
</div>


<div id="DivInequality" style="display:none">
    <div class="clsInequality">
        <select id="Inequality">
            <option name="Inequality[]" value="=" >=
                </operator>
            <option name="Inequality[]" value="<" > <
                </operator>
            <option name="Inequality[]" value="<=" > <=
                </operator>
            <option name="Inequality[]" value=">" > >
                </operator>
            <option name="Inequality[]" value=">="> >=

                </operator> 
            <option name="Inequality[]" value="<>" > <>
            </option>     </select>
    </div>
</div>

<div id="DivOperator" style="display:none">
    <div class="clsOperator">
        <select id="Operator">
            <option name="Operator[]" value="+" >+
                </operator>
            <option name="Operator[]" value="-" > -
                </operator>
            <option name="Operator[]" value="*" > *
                </operator>
            <option name="Operator[]" value="/" > /
                </operator>
            <option name="Operator[]" value="&Sqrt;"> &Sqrt;

                </operator> 
        </select>
    </div>
</div>

<div id="DivFiled" style="display:none">
    <div class="clsFiled">
        <select id="Filed">
            <?php
            $sqlFiled = "SELECT * FROM `total_deduction_benefit`";


            $resultFiled = mysql_query($sqlFiled);


            while ($rowField = mysql_fetch_assoc($resultFiled, MYSQL_ASSOC)) {

                echo "<option  id=\"{$rowField['FieldName']}\" value=\"{$rowField['FieldName']}\">
 {$rowField['FieldName']}
     </option>";
            }
            ?>
        </select>
    </div>
</div>


<div id="DivConditional" style="display:none">
    <div class="clsConditional">
        <select id="Conditional">
            <option name="Conditional[]" value="if" >If
                </operator>
            <option name="Conditional[]" value="else" > Else
                </operator>
        </select>
    </div>
</div>

