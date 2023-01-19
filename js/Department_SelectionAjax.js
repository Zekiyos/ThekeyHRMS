// JavaScript Document

$(document).ready(function()
{
	
    $(".Section").change(function()
    {
        var id=$(this).val();//get value of changed listed box section
        var dataString = 'Section='+ id;

        $.ajax
        ({
            type: "POST",
            url: "../ajax/ajax_SubSection.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $(".SubSection").html(html);
            } 
        });


        //changing group list box dynmicaly

        $.ajax
        ({
            type: "POST",
            url: "../ajax/ajax_Group.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $(".Group").html(html);
            } 
        });


        //changing group list box dynmicaly

        $.ajax
        ({
            type: "POST",
            url: "../ajax/ajax_Department.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $(".Department").html(html);
            } 
        });



    });//end of section change event function



    $(".SubSection").change(function()
    {
        var id=$(this).val();//get value of changed listed box SubSection
        var dataString = 'SubSection='+ id;


        //changing group list box dynamicaly

        $.ajax
        ({
            type: "POST",
            url: "..z/ajax/ajax_Group.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $(".Group").html(html);
            } 
        });

        //changing Department list box dynmicaly

        $.ajax
        ({
            type: "POST",
            url: "ajax/ajax_Department.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $(".Department").html(html);
            } 
        });



    });//end of Sub section change event function




    $(".Group").change(function()
    {
        var id=$(this).val();//get value of changed listed box SubSection
        var dataString = 'Group='+ id;



        //changing Department list box dynmicaly

        $.ajax
        ({
            type: "POST",
            url: "ajax/ajax_Department.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $(".Department").html(html);
            } 
        });



    });//end of Sub section change event function



});
