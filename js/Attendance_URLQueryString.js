// JavaScript Document


Attendanceurl=document.URL;
	
var x=Attendanceurl.split("&"); 
//(x[2]=='operation=Update')
//alert(x[3]);
if( (x[3]!='operation=Update') && (x[3]!='operation=Show'))
{

    alert('Attendance Allocation is already run for selected Department on selected date Range.');

    var answer = confirm('Do You want to overwrite the existing Attendnace Allocation Data ?If Click Ok the existining data will be overwriten.To Show only the allocation Click Cancel.');

	

    if((answer==true) )
    {
         
        alert('Attendance Allocation will Run on Updating Mode');
        location=document.URL+"&operation=Update";
    //alert(document.URL+"&operation=Update");



    } 
    else 
    if(answer!=true)
    { 
        alert('Attendance Allocation will Run on Display Mode Only');
        location=document.URL+"&operation=Show";
    //location=document.URL;  
    }
}
