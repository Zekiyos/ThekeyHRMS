<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet"  href="../../Css/tinybox2style.css" />
<script type="text/javascript" src="../../Js/tinybox.js"></script>

	<link rel="stylesheet"  href="../../Css/Drag_Drop_Style.css" />
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
	#dhtmlgoodies_dragDropContainer{
		border:0px;
		width:100%;
	}
	</style>
	<script type="text/javascript" src="../../Js/Drag_Drop.js"></script>

</head>

<body>
<div id="dhtmlgoodies_dragDropContainer">
	<div id="topBar">
		<img src="../../Img/thekey soft.jpg"  height="30" width="150">
	</div>
	<div id="dhtmlgoodies_listOfItems">
		<div>
			<p>Available Payroll Fields</p>
		<ul id="allItems">
			 <?php
		    require_once('../../Connections/HRMS.php');


include('../../Classes/Class_ThekeyPayrollSystem_Data_Setting.php'); 
$obj_PayrollData=new  ThekeyPayrollSystem_Data_Setting();

 //$obj_PayrollData->get_TotalDeductionBenefit_Columns("ALL");?>
			<!--li id="node3">Student C</li>
			<li id="node4">Student D</li>
			<li id="node5">Student E</li>
			<li id="node6">Student F</li>
			<li id="node7">Student G</li>
			<li id="node8">Student H</li>
			<li id="node9">Student I</li>
			<li id="node10">Student J</li>
			<li id="node11">Student K</li>
			<li id="node12">Student L</li>
			<li id="node13">Student M</li>
			<li id="node14">Student N</li>
			<li id="node15">Student O</li-->
		</ul>
		</div>
	</div>
    
  <div id="dhtmlgoodies_mainContainer">
		<!-- ONE <UL> for each "room" -->
        
            
	<div>
			<p>Payroll Fields</p>
			<ul id="box1">
				            <?php
		     $obj_PayrollData->get_TotalDeductionBenefit_Columns("ALL");?>
			</ul>
			
      </div>
      <p align="center"><a  onclick="TINY.box.show({url:'AddField.php',post:'',width:400,height:300,opacity:20,topsplit:3});">+</a></p>
     
     <p align="center"><a  onclick="TINY.box.show({url:'DeleteField.php',post:'',width:300,height:150,opacity:20,topsplit:3});">-</a></p>
	  <!--div>
			<p>Benefit</p>
			<ul id="box2">
            <?php
		     //$obj_PayrollData->get_TotalDeductionBenefit_Columns("BENEFIT");?>
            </ul>
             
		</div>
		<div>
			<p>Deduction</p>
			<ul id="box3">
				 <?php
		     //$obj_PayrollData->get_TotalDeductionBenefit_Columns("DEDUCTION");?>
			</ul>
		</div>
		<!--div>
			<p>Team D</p>
			<ul id="box4"></ul>
		</div>
		<div-->
		  <!--p>Team E</p>
			<ul id="box5">
				<li id="node19">Student S</li>
				<li id="node20">Student T</li>
				<li id="node21">Student U</li>
			</ul-->
	  </div>
	</div>
</div>
<div id="footer">
	<!--form action="aPage.html" method="post"><input type="button" onclick="saveDragDropNodes()" value="Save"></form-->
    <form name="myForm" method="post" action="Save.php" onsubmit="saveDragDropNodes()">
<input type="hidden" name="listOfItems" value="">
<input type="submit" value="Creat Payroll Deduction and Benefit" name="saveButton">
</form> 
</div>
<ul id="dragContent"></ul>
<div id="dragDropIndicator"><img src="../../Payroll Data Settings/PayrollDedcutionBenefitDefinition/images/insert.gif"></div>
<div id="saveContent"><!-- THIS ID IS ONLY NEEDED FOR THE DEMO --></div>

</body>
</html>