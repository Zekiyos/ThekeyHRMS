<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('../connections/hrms.php');
   include('../Classes/Class_DB_Relationship.php');
                $obj_DB = new DB_Relationship();
                
              
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    
                    
                     $SelectedTables = $_POST['Tables_in_thekeyhrmsdb'];
                     
                         print_r($SelectedTables);
                         foreach ($SelectedTables as $SelectedTablesvalue) {
                             $Result1=$obj_DB->add_foreign_key($SelectedTablesvalue,"terminated_employee_personal_record");
                             if (!($Result1))
                              echo  '<hr>'.$SelectedTablesvalue;
                                 
                         }
                   
//                        if ($Result1)
//                          echo "<script type=\"text/javascript\">alert('You have Defined Foriegn Successfully for Selected Tables.')</script>";
//                          else
//                     echo "<script type=\"text/javascript\">alert('Not Successfull.')</script>";
                }
               
                


?>
<h1 class="form_lable">
                    <?php echo 'Foriegn Key Definition Form'; ?>
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                   <table width="400" height="395" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Table List:</td>
                            <td>
                                <?php $obj_DB->get_Table_list(); ?>
                            </td>
                        </tr>
                    
                    <tr valign="baseline">
      
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Define Foriegn Key" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>