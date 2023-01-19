/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



function SelctedDepartment4Scansheet(Dept,From,To) {
 
    //get the listbox object from id.
    var src = document.getElementById(Dept);
    var From_Date = document.getElementById(From).value;
    var To_Date = document.getElementById(To).value;
    
    var result = new Array();
  
    //iterate through each option of the listbox
    for(var count=0 ; count <= src.options.length-1; count++) {
 
         //if the option is selected, delete the option
        if(src.options[count].selected == true) {
  
   alert(src.options[count].value);
   
   result.push(src.options[count].value)
   
    result.push('and')
    
    location=document.URL+"?Department="+src.options[count].value+
        "&From_Date="+From_Date+"&To_Date="+To_Date;

        }
    }
    
    // populate the selected value into text boxes
//    for (var i=0; i<result.length; i++) {
//        document.getElementById("box"+(i+1)).value = result[i]
//    }
    
  //  location=document.URL+"&operation=Update";
    
}
