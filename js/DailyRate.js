// JavaScript Document
function DailyRate(Salary,WorkingDays,SalaryPerDay){
    Salary=document.getElementById("Salary").value;
    WD=document.getElementById("WorkingDays").value
	   
    var SalaryPerDay=Salary/WD;


    document.getElementById("SalaryPerDay").value=SalaryPerDay;


}