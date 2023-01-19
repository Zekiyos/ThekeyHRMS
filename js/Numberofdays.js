// JavaScript Document

function Numberofdays(From,To,LD,RD){
	
    t1=document.getElementById(From).value;
    t2=document.getElementById(To).value
    if(RD!=0)
        restday=document.getElementById(RD).value
    else
        restday=0;
    leaveday=document.getElementById(LD).value
	 
    var one_day=1000*60*60*24; 
    var x=t1.split("-");     
    var y=t2.split("-");
    var date1=new Date(x[0],(x[1]-1),x[2]);
    var date2=new Date(y[0],(y[1]-1),y[2])
    var month1=x[1]-1;
    var month2=y[1]-1;
          
    _Diff=Math.ceil((date2.getTime() - date1.getTime())/(one_day)); 
    totalday=restday+leaveday

    var now = new Date();
    t1=document.getElementById(From).value;
	
    var x=t1.split("-"); 
    if(x[2]=='08')
        var  newday=parseInt('8')+parseInt(leaveday)+ parseInt(restday);
    else
    if(x[2]=='09')
        var  newday=parseInt('9')+parseInt(leaveday)+ parseInt(restday);
    else
        var  newday=parseInt(x[2])+parseInt(leaveday)+ parseInt(restday);
    //alert(newday);
    now.setYear(x[0]);
    now.setMonth(x[1]-1);
    now.setDate(newday);

	
    var nowStr = now.getFullYear().toString() + "-" +
    (now.getMonth()+1 < 10 ? "0" + (now.getMonth()+1).toString() : (now.getMonth()+1).toString()) + "-" +
    (now.getDate() < 10 ? "0" + now.getDate().toString() : now.getDate().toString());
		
    // alert(nowStr);

    document.getElementById(To).value=nowStr;



}

function Numberofdays2(From,To,LD){
    //var d1 = Date.today().add(1).days();
    //document.getElementById("MaternityLeaveDays2").value = d1.toString('d MMMM yyyy');//Need to change this to MYSQL format
    //documnet.write( document.getElementById("MaternityLeaveDays2").value);


    // Any source code blocks look like this

    //

    t1=document.getElementById(From).value;
    t2=document.getElementById(To).value
    //t1="2006-10-10" ;// t1="10-10-2006" ;

    // t2="2006-10-15";

 
    //Total time for one day

    var one_day=1000*60*60*24; 
    //Here we need to split the inputed dates to convert them into standard format

    //for furter execution
    var x=t1.split("-");     
    var y=t2.split("-");
    //date format(Fullyear,month,date) 


    var date1=new Date(x[0],(x[1]-1),x[2]);
  
    var date2=new Date(y[0],(y[1]-1),y[2])
    var month1=x[1]-1;
    var month2=y[1]-1;
        
    //Calculate difference between the two dates, and convert to days

               
    _Diff=Math.ceil((date2.getTime() - date1.getTime())/(one_day)); 
    //_Diff gives the diffrence between the two dates.

    document.getElementById(LD).value=_Diff;


}