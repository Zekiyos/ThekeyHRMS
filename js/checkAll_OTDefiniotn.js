// JavaScript Document

   
function checkAll_OTDefiniotn(field) {
    if((document.SelectedID.CheckAll_ID.checked)  ||
        (document.SelectedID.CheckAll_DayOT.checked) ||
        (document.SelectedID.CheckAll_NightOT.checked) )
        {
        for (i = 0; i < field.length; i++)
            field[i].checked = true;
	
    }
    else
    {
        for (i = 0; i < field.length; i++)
            field[i].checked = false;
    }
	
	
	
}
