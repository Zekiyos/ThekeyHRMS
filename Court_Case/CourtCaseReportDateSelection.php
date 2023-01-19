<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
    </head>

    <body>
        <form action="CourtCaseReport.php" method="post" name="DataSelection" target="_new">
            <font color="#FF6600" size="+1" > <p align="center">Court Case File Date </p></font>
            <table align="center">
                <tr><td align="right">From</td><td>
                        <script type='text/JavaScript' src="../Js/scw.js" ></script>
                        <input type="text" name="FromDate" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d"); ?>' />
                    </td><td>To</td><td><input type="text" name="ToDate" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d"); ?>' /></td><td><input type="submit" value="Display" onclick="window.close()" /></td></tr></table> 
        </form>
    </body>
</html>