// JavaScript Document

function toggle(element) {
    document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";
}


function toggle_all() {
	
    document.getElementById('Leave').style.display = (document.getElementById('Leave').style.display == "none") ? "" : "none";
	
    document.getElementById('Equipment').style.display = (document.getElementById('Equipment').style.display == "none") ? "" : "none";
	
    document.getElementById('Training').style.display = (document.getElementById('Training').style.display == "none") ? "" : "none";
	
    document.getElementById('Disciplinary_Action').style.display = (document.getElementById('Disciplinary_Action').style.display == "none") ? "" : "none";
	
	
    document.getElementById('Job_Description').style.display = (document.getElementById('Job_Description').style.display == "none") ? "" : "none";
	
    if (document.getElementById('ShowAll').value=='Show All')
    {
        document.getElementById('ShowAll').value='Hide All';
    }
    else if (document.getElementById('ShowAll').value=='Hide All')
        document.getElementById('ShowAll').value='Show All';
		
		
}