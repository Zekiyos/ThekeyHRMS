
<?php
require_once('../../Connections/HRMS.php');


include('../../Classes/Class_ThekeyPayrollSystem_Data_Setting.php');
$obj_PayrollData = new ThekeyPayrollSystem_Data_Setting();

//$obj_PayrollData->get_TotalDeductionBenefit_Columns("ALL");
?>
<script type="text/javascript">
    function validate(frm)
    {
        var ele = frm.elements['Formula[]'];
    
        if (! ele.length)
        {
            alert(ele.value);
        }
    
        for(var i=0; i<ele.length; i++)
        {
            // alert(ele[i].value);
        }
    
        return true;
    }

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
    
    function add_Conditional_init()
    {
        var div1 = document.createElement('div');
        
        var div2 = document.createElement('div');
        var div3 = document.createElement('div');
        var div4 = document.createElement('div');
        
        
        // Get template data
        div1.innerHTML = document.getElementById('DivConditionalInit').innerHTML;
        
      
        // append to our form, so that template data
        //become part of form
       
        document.getElementById('Divformula').appendChild(div1);
        
     

    }
    
    
    function add_Equation_init()
    {
        var div1 = document.createElement('div');
        
        var div2 = document.createElement('div');
        var div3 = document.createElement('div');
        var div4 = document.createElement('div');
        
        
        // Get template data
        div1.innerHTML = document.getElementById('DivNewFiled').innerHTML;
        
        div2.innerHTML = document.getElementById('DivInequality').innerHTML;
        div3.innerHTML = document.getElementById('DivFiled').innerHTML;
        div4.innerHTML = document.getElementById('DivOperator').innerHTML;

        // append to our form, so that template data
        //become part of form
        document.getElementById('Divformula').appendChild(div1);
        
        document.getElementById('Divformula').appendChild(div2);
        document.getElementById('Divformula').appendChild(div3);
        document.getElementById('Divformula').appendChild(div4);

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
<link rel="stylesheet"  href="../../Css/FormulaDragDrop.css" />
<style type="text/css" media="print">
    div#dhtmlgoodies_listOfItems{
        display:none;
    }
    body{
        background-color:#FFF;
    }
    img{
        display:none;
    }
    #dhtmlgoodies_dragDropContainer2{
        border:0px;
        width:100%;
    }
</style>
<script type="text/javascript" src="../../Js/Drag_Drop.js"></script>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}




if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {



    print_r($_POST['Formula']);

    $formula = $_POST['Formula'];

    $N = count($formula);
    $formulalist = '';
    foreach ($formula as $key => $value) {

        $FieldName = $formula[0];



        $formulalist.=$formula[$key];
    }

//    if ($_POST['FormualType'] == 'Conditional') {
//        foreach ($formula as $key => $value) {
//
//            $FieldName = $formula[0];
//
//
//
//            $formulalist.=$formula[$key];
//        }
//        $formulalist.=$value . ',';
//    }

    echo '<br>Formula Detail:' . $formulalist;

    echo '<br> Filed Name:' . $FieldName;

    $sqlFormula = "INSERT INTO `thekeyhrmsdb`.`total_deduction_benefit`
                       (`FieldName`, `Value`) VALUES ('" . $FieldName . "', '" . $formulalist . "')";

    mysql_select_db($database_HRMS, $HRMS);

    $RSFormula = mysql_query($sqlFormula, $HRMS) or die(mysql_error());

    if ($RSFormula)
        echo "<script type=\"text/javascript\">alert('You have Difined Formula for {$_POST['Formula']} Successfully.')</script>";
}
?>


<link rel="stylesheet"  href="../../Css/tinybox2style.css" />
<script type="text/javascript" src="../../Js/tinybox.js"></script>


<p align="center"><a  onclick="TINY.box.show({url:'PayrollDeductionBenefitFormulaSetup.php',post:'',width:400,height:300,opacity:20,topsplit:3});">+</a></p>


<form name="form1" method="post" action="<?php echo $editFormAction; ?>" onsubmit="return validate(this)">

    <table>
        <tr>
            <td valign=top> Formula Type:</td>
            <td>
                <table width="200">
                    <tr>
                        <td><label>
                                <input onclick="javascript:add_Equation_init()"  type="radio" name="FormualType" value="Equation" id="FormualType_0" />
                                Equation</label></td>
                    </tr>
                    <tr>
                        <td><label>
                                <input  onclick="javascript:add_Conditional_init()" type="radio" name="FormualType" value="Conditional" id="FormualType_1" />
                                Conditional</label></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign=top> Formula:</td>
            <td valign=top>
                <div id="Divformula" >
                    <div id="DivFormulaType">

                    </div>
                </div>
            </td>
        </tr>
    </table>

    <p>
        <br>
        <input type="submit" name="submit1" value="Creat Formula">
        <input type="reset" name="reset1">
        <input type="hidden" name="MM_insert" value="form1" />
    </p>

    <p id="addnew">
        <a href="javascript:add_NewFiled('DivNewFiled')">Add New Field </a><br>
        <a href="javascript:add_NewFiled('DivFiled')">Add Input Field </a><br>
        <a href="javascript:add_NewFiled('DivOperator')">Add Operator </a><br>
        <a href="javascript:add_NewFiled('DivInequality')">Add Inequality </a><br>
        <a href="javascript:add_NewFiled('DivConditional')">Add Conditional </a><br>
    </p>

</form>


<!--<div id="dhtmlgoodies_dragDropContainer">
        <div id="topBar">
                <img src="../../Img/thekey soft.jpg" >
        </div>
        <div id="dhtmlgoodies_listOfItems">
                <div>
                        <p>Payroll Fields</p>
                <ul id="allItems">
<?php $obj_PayrollData->get_TotalDeductionBenefit_Columns("ALL"); ?>
                </ul>
                </div>
        </div>
        <div id="dhtmlgoodies_mainContainer">
                 ONE <UL> for each "room" 
                <div>
                        <p>Selected Fields</p>
                        <ul id="box1">
                                
                        </ul>
                </div>
                
                
        </div>
</div>
<div id="footer">
        <form action="../../Payroll Data Settings/PayrollDedcutionBenefitDefinition/aPage.html" method="post"><input type="button" onclick="saveDragDropNodes()" value="Save"></form>
</div>
<ul id="dragContent"></ul>
<div id="dragDropIndicator"><img src="../../Payroll Data Settings/PayrollDedcutionBenefitDefinition/images/insert.gif"></div>
<div id="saveContent"> THIS ID IS ONLY NEEDED FOR THE DEMO </div>-->



<!-- Template. This whole data will be added directly to working form above -->


<div id="DivNewFiled" style="display:none">
    <div class="NewFiled">
        <input type="text" name="Formula[]" value=""  size="40" required="required">
    </div>
</div>


<div id="DivInequality" style="display:none">
    <div class="clsInequality">
        <select id="Inequality" name="Formula[]">
            <option  value="=" >=
                </operator>
            <option  value="<" > <
                </operator>
            <option  value="<=" > <=
                </operator>
            <option  value=">" > >
                </operator>
            <option  value=">="> >=

                </operator> 
            <option  value="<>" > <>
            </option>     </select>
    </div>
</div>

<div id="DivOperator" style="display:none">
    <div class="clsOperator">
        <select id="Operator" name="Formula[]">
            <option  value="+" >+
                </operator>
            <option  value="-" > -
                </operator>
            <option  value="*" > *
                </operator>
            <option  value="/" > /
                </operator>
            <option  value="&Sqrt;"> &Sqrt;

                </operator> 
        </select>
    </div>
</div>

<div id="DivFiled" style="display:none">
    <div class="clsFiled">
        <select id="Filed" name="Formula[]">
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
        <blockquote></blockquote>
        <table>

            <tr>
                <td align="right">
                    Logical Test

                </td>
                <td>
                    <textarea name="Formula[]" value="" cols="30"  required="required" ></textarea>


                </td>
            </tr>
            <tr>
                <td align="right">
                    IF TRUE </td>
                <td><textarea name="Formula[]" value="" cols="30"  required="required" >

              </textarea>
                </td>
            </tr>
            <tr>
                <td align="right">
                    IF False 
                </td>
                <td >
                    <textarea name="Formula[]" value="" cols="30"  required="required" >

                    </textarea>
                </td>
            </tr>
        </table>
    </div>
</div>


<div id="DivConditionalInit" style="display:none">
    <div class="clsConditional">
        <table>
            <tr>
                <td align="right">
                    Filed Name
                </td>
                <td >
                    <input type="text" name="Formula[]" value=""  size="40" required="required">
                    </blockquote>

                    <select id="Conditional" name="Formula[]">

                        <option  value="=" > =
                            </operator>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Logical Test
                    <!--        <select id="Conditional" name="Formula[]">
                                <option  value="if" >If
                                    </operator>
                            </select>-->

                </td >
                <td >
                    <textarea name="Formula[]" value="" cols="30"  required="required" ></textarea>


                </td>
            </tr>
            <tr>
                <td align="right">
                    IF TRUE </td>
                <td><textarea name="Formula[]" value="" cols="30"  required="required" >

                    </textarea>


<!--        <select id="Conditional" name="Formula[]">
                      <option  value="else" > Else
                </operator>
        </select>-->
                </td>
            </tr>
            <tr>
                <td align="right">
                    IF False 
                </td>
                <td >
                    <textarea name="Formula[]" value="" cols="30"  required="required" >

                    </textarea>
                </td>
            </tr>
        </table>
    </div>
</div>
