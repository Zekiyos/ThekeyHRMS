<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Court Case Report Filter Option</title>
<script type="text/javascript">
function toggle(element) {
    document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";
}
</script>
</head>
<body>
<form action="CourtCaseReportFilter.php" method="post" name="DataSelection" >
<input value="+" type="button" onclick="javascript:toggle('filter')" />Filter
<div id="filter" style="display: none;">
    <table width="691">
<tr>
 <td width="114">Type Filter Value:</td><td width="147">
    <input name="find" type="text" /></td>
     <td width="176"><p align="center"><font color="#0000CC"   size="+2" >Filter By Plaintiff</font></p>
            <input type="radio" name="Field" value="ID"   />
      ID  <br />
      <input type="radio" name="Field" value="FirstName"  checked="checked"   />
      Plantiff First Name <br /> 
      <input type="radio" name="Field" value="MiddelName"   />
      Middel Name<br />
      <input type="radio" name="Field" value="LastName"   /> 
      Last Name<br />
      <input type="radio" name="Field" value="Department"   /> 
      Department<br />    
      <input type="radio" name="Field" value="FileNumber"   />
      FileNumber<br />    </td><td width="154">
  <p align="center"><font color="#0000CC" size="+2" ><br />Filter By Case</font></p>
   <input type="radio" name="Field" value="FileDate" onclick="javascript:toggle('FileDate')"  /> File Date<br />
    
    <input type="radio" name="Field" value="ClaimAmount"   />Claim Amount<br />  
    <input type="radio" name="Field" value="AdvocateName"   />
    Advocate Name<br />
  <input type="radio" name="Field" value="AppointmentDate"   />Appointment Date<br />
  <input type="radio" name="Field" value="Decision"   />Decision<br />
  <input type="radio" name="Field" value="Court"   />Court  <br />
    <input type="radio" name="Field" value="Case_Status"   />
  Case Status <br /> </p>
  </td><td width="76"><input type="submit" value="Display"   /></td></tr></table>
  <div id="FileDate" style="display: none;">From
<script type='text/JavaScript' src="../Calendar/scw.js" ></script>
<input type="text" name="FromDate" onclick='scwShow(this,event);' value='' />
TO<input type="text" name="ToDate" onclick='scwShow(this,event);' value='' /><input type="submit" value="Display"  /></div>
</div>
</form>


 
</div>
</body>
</html>