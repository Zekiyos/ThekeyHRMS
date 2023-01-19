<?php require_once('../../Connections/HRMS.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Department Selection</title>

        <script type="text/javascript" src="../../Js/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function()
            {
	
                $(".Section").change(function()
                {
                    var id=$(this).val();//get value of changed listed box section
                    var dataString = 'Section='+ id;
                    $.ajax
                    ({
                        type: "POST",

                        url:  "ajax/ajax_SubSection.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $(".SubSection").html(html);
                        } 
                    });


                    //changing group list box dynmicaly

                    $.ajax
                    ({
                        type: "POST",
                        url: "ajax/ajax_Group.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $(".Group").html(html);
                        } 
                    });


                    //changing group list box dynmicaly

                    $.ajax
                    ({
                        type: "POST",
                        url: "ajax/ajax_Department.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $(".Department").html(html);
                        } 
                    });



                });//end of section change event function



                $(".SubSection").change(function()
                {
                    var id=$(this).val();//get value of changed listed box SubSection
                    var dataString = 'SubSection='+ id;


                    //changing group list box dynamicaly

                    $.ajax
                    ({
                        type: "POST",
                        url: "ajax/ajax_Group.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $(".Group").html(html);
                        } 
                    });

                    //changing Department list box dynmicaly

                    $.ajax
                    ({
                        type: "POST",
                        url: "ajax/ajax_Department.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $(".Department").html(html);
                        } 
                    });



                });//end of Sub section change event function




                $(".Group").change(function()
                {
                    var id=$(this).val();//get value of changed listed box SubSection
                    var dataString = 'Group='+ id;



                    //changing Department list box dynmicaly

                    $.ajax
                    ({
                        type: "POST",
                        url: "ajax/ajax_Department.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $(".Department").html(html);
                        } 
                    });



                });//end of Sub section change event function



            });
        </script>

        <script type='text/javascript'>
            function SelectedDepartment(elem, helperMsg){
                //document.writeln(elem.value);
	
                /*var val = new Array(elem.value );
                //val=elem.value
                alert(elem.value)
                alert(val);
        for (var i = 0; i < val.length; i++) {
                alert(val[i]);
   
        }
                 */

	
                alert ( "You Chooose " + elem.value + " Department!")
                var Department=elem.value;
	
                location="PayrollDataSettingSetup.php?Department=" + elem.value;
                if(elem.value == "Please Choose Department"){
                    alert(helperMsg);
                    elem.focus();
                    return false;
                }else{
                    return true;
                }
            }

        </script>
    </head>
    <body>
        <!--form id="form1" name="form1" method="post" action="Attendance_Allocation.php"-->

<!--form id="form1" name="form1" method="post" action="<?php //echo $editFormAction;     ?>"-->

        <form id="form1" name="form1" method="get" action="">
            <table align="center"  bgcolor="#EBEBEB" width="382" height="440">
                <tr valign="baseline">
                    <td height="105" align="right" nowrap="nowrap"><label for="Section">Section</label>:</td>
                    <td>
                        <select name="Section" class="Section">
                            <option selected="selected">------Select Section-----</option>
                            <?php
                            $sql = mysql_query("Select DISTINCT Section from Department");
                            while ($row = mysql_fetch_array($sql)) {
                                $id = $row['Section'];
                                $data = $row['Section'];
                                echo '<option value="' . $id . '">' . $data . '</option>';
                            }
                            ?>
                        </select> 
                    </td>
                </tr>
                <tr valign="baseline">
                    <td height="105" align="right" nowrap="nowrap"><label>Sub Section</label>:</td>
                    <td>
                        <select name="SubSection" class="SubSection">
                            <option selected="selected">--First Select Section--</option>

                        </select>
                    </td>
                </tr>
                <tr valign="baseline">
                    <td height="105" align="right" nowrap="nowrap"><label >Group</label>:</td>
                    <td>

                        <select name="Group" class="Group">
                            <option selected="selected">--First Select Section--</option>

                        </select>

                    </td>
                </tr>
                <tr valign="baseline">
                    <td height="105" align="right" nowrap="nowrap"><label ></label>Department:</td>
                    <td>

                        <select id="Department" name="Department" class="Department"  >
                            <option selected="selected">--First Select Section--</option>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td>
                        <input type="button" onclick="SelectedDepartment(document.getElementById('Department'), 'Please Choose Department First')" value="Next" />
                    </td>
                </tr>

            </table>

        </form>

    </body>
</html>

