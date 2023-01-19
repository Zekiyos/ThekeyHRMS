<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<script type="text/javascript">
var arSelected = new Array();
 function getMultiple(ob) {
	  while (ob.selectedIndex != -1) { 
	  if (ob.selectedIndex != 0) 
	  arSelected.push(ob.options[ob.selectedIndex].value); 
	  ob.options[ob.selectedIndex].selected = false;
	   }
 // You can use the arSelected array for further processing.
  }
</script>

<form name='frmSelect'> <select name='numbers' multiple='multiple' onblur='getMultiple(document.frmSelect.numbers);'>
 <option value='1'>One</option> 
 <option value='2'>Two</option>
  <option value='3'>Three</option>
   <option value='4'>Four</option> 
   <option value='5'>Five</option>
    </select> 
    <input type='submit' value='Submit' onclick='return confirm("You have selected: " + arSelected.toString();' />
     </form>
</body>
</html>