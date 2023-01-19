// JavaScript Document

function PrintContentPersonalInfo()
{
    //Display if none for all tab mean div tags
    document.getElementById('Basic_Info').style.display = (document.getElementById('Basic_Info').style.display == "none") ? "" : "";
		 
    document.getElementById('Annual_Leave').style.display = (document.getElementById('Annual_Leave').style.display == "none") ? "" : "";
		 
    document.getElementById('Leave').style.display = (document.getElementById('Leave').style.display == "none") ? "" : "";
	
    document.getElementById('Equipment').style.display = (document.getElementById('Equipment').style.display == "none") ? "" : "";
	
    document.getElementById('Training').style.display = (document.getElementById('Training').style.display == "none") ? "" : "";
	
    document.getElementById('Disciplinary_Action').style.display = (document.getElementById('Disciplinary_Action').style.display == "none") ? "" : "";
	
    document.getElementById('Job_Description').style.display = (document.getElementById('Job_Description').style.display == "none") ? "" : "";
	
		
    var DocumentContainer = document.getElementById('tblInfo');
    var WindowObject = window.open('', "TrackHistoryData", 
        "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
    WindowObject.document.writeln(DocumentContainer.innerHTML);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
}
	
function PrintContent(element)
{
alert('Please make sure that, you had summarized this attendance for Payroll Output?');
    if (confirm('Are you sure you want to Print Out the result in current setting of paper scale?')) {
		
        var DocumentContainer = document.getElementById(element);
        var WindowObject = window.open('', "TrackHistoryData", 
            "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
        WindowObject.document.writeln(DocumentContainer.innerHTML);
        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        WindowObject.close();
		
		
    }
    else
    {
        alert("To adjust the paper scale go to Print preview pane and set 40% for your A4 paper.");
        void('')
    }; 
	
		
}