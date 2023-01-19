var port = window.location.port;
if (port)
{
    port = ":" + port;
}
var thekeyhrms_url = "http://" + window.location.hostname + port + "/ThekeyHRMS/";

function toggle(element) {
    document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";

}

function SelectedDepartment(elem, helperMsg) {
    //document.writeln(elem.value);
    alert("You Chooose " + elem.value + " Department!")
    var ID = elem.value;

    location = "OT_Definition1.php?Department=" + elem.value;
    if (elem.value == "Please Choose ID") {
        alert(helperMsg);
        elem.focus();
        return false;
    } else {
        return true;
    }
}

function Numberofdays(From, RD, LD) {

    t1 = From;
    restday = RD;
    leaveday = LD


    var x = t1.split("-");

    var newday = eval(x[2]) + eval(leaveday) + eval(restday);
    //alert(newday);

    var now = new Date();


    now.setYear(x[0]);
    now.setMonth(x[1] - 1);
    now.setDate(newday);


    var nowStr = now.getFullYear().toString() + "-" +
            (now.getMonth() + 1 < 10 ? "0" + (now.getMonth() + 1).toString() : (now.getMonth() + 1).toString()) + "-" +
            (now.getDate() < 10 ? "0" + now.getDate().toString() : now.getDate().toString());

    // alert(nowStr);

    return nowStr;



}


function treatAsUTC(date) {
    var sd = date.split('-');
    var s_date = new Date();
    s_date.setDate(1);
    s_date.setYear(sd[0]);
    s_date.setMonth(sd[1] - 1);
    s_date.setDate(sd[2]);
    var result = s_date;
    result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
    return result;
}



function date_diff(start_date, end_date)
{
    var millisecondsPerDay = 24 * 60 * 60 * 1000;
    return (treatAsUTC(end_date) - treatAsUTC(start_date)) / millisecondsPerDay;
}

function roundNumber(num, dec) {
    var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
    return result;
}


function SelectedDepartment4Attendance(elem, FromDate, ToDate, helperMsg) {
    //document.writeln(elem.value);
    alert("You Chooose " + elem.value + " Department!")
    var Department = elem.value;

    location = "Attendance_Allocation.php?Department=" + elem.value + "&From_Date=" + FromDate.value + "&To_Date=" + ToDate.value;
    if (elem.value == "Please Choose Department") {
        alert(helperMsg);
        elem.focus();
        return false;
    } else {
        return true;
    }
}

$(function()
{

    tool_bar_help = $(".form_lable");
    if (tool_bar_help.length > 0)
    {
        my_menu = "<label id=\"tool_top\"><a title=help class=\"help_me\" href=\"#\"><img src=\"" + thekeyhrms_url + "images/help.png\" alt=\"Help\" title=\"Help\"/></a><a title=proclamation  class=\"proclamation\" href=\"#\"><img src=\"" + thekeyhrms_url + "images/justice.png\" alt=\"Proclamation\" title=\"Proclamation\" /></a></label>";

        my_content = tool_bar_help.html();

        tool_bar_help.attr('title', my_content);

        tool_bar_help.append(my_menu);

    }

    $(".help_me,.proclamation").live("click", function()
    {
        my_form_lable = $(this).parents(".form_lable");

        help = my_form_lable.attr("title");

        help = help.replace(/(\r\n|\n|\r|\t)/gm, "");

        help = help.trim();

        help = escape(help);

        what_i_need = $(this).attr("title");

        url = thekeyhrms_url + what_i_need + ".php?" + what_i_need + "=" + help;

        $("#pop_up_help").load(url).dialog({
            title: what_i_need,
            width: 470,
            height: 300,
            position: [675, 220]
        });
        return false;
    })



    $(".Section").change(function()
    {
        var id = $(this).val();//get value of changed listed box section
        var dataString = 'Section=' + id;
        //var path="http://localhost/ThekeyHRMS/Database_Update/";path +
        $.ajax
                ({
                    type: "POST",
                    url: thekeyhrms_url + "ajax/ajax_SubSection.php",
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
                    url: thekeyhrms_url + "ajax/ajax_Group.php",
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
                    url: thekeyhrms_url + "ajax/ajax_Department.php",
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
        var id = $(this).val();//get value of changed listed box SubSection
        var dataString = 'SubSection=' + id;


        //changing group list box dynamicaly

        $.ajax
                ({
                    type: "POST",
                    url: thekeyhrms_url + "ajax/ajax_Group.php",
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
                    url: thekeyhrms_url + "ajax/ajax_Department.php",
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
        var id = $(this).val();//get value of changed listed box SubSection
        var dataString = 'Group=' + id;



        //changing Department list box dynmicaly

        $.ajax
                ({
                    type: "POST",
                    url: thekeyhrms_url + "ajax/ajax_Department.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $(".Department").html(html);
                    }
                });



    });//end of Sub section change event function



    $("#CHKALL").click(function()
    {
        $(".check_this_all").trigger('click');

    })


    $(".expand_view a").toggle(function()
    {
        $(this).find('label').addClass('ui-icon-circle-minus').removeClass('ui-icon-circle-plus')
        $("#DetailMS").show(200)

    },
            function()
            {
                $(this).find('label').addClass('ui-icon-circle-plus').removeClass('ui-icon-circle-minus')
                $("#DetailMS").hide(200);
            })

            $(".toggle_me").toggle(function()
            {
                $(this).addClass('ui-icon-circle-minus').removeClass('ui-icon-circle-plus')
            },
                    function()
                    {
                        $(this).addClass('ui-icon-circle-plus').removeClass('ui-icon-circle-minus')
                    }
                    )


                    $(".calculate_age").change(function()
                    {
                        var d = new Date();
                        var curr_date = d.getDate();
                        var curr_month = d.getMonth();
                        var curr_year = d.getFullYear();
                        today = curr_year + "-" + eval(curr_month + 1)
                                + "-" + curr_date;

                        b_date = $(this).val();

                        age = date_diff(b_date, today);
                        age = age / 365;
                        age = roundNumber(age, 2);
                        $("#Age").val(age);
                    });


                    $("#Leavedays,#Restday,#Leave_Taken_Date").live("change", function()
                    {
                        aLeavedays = $("#Leavedays").val();
                        aRestday = $("#Restday").val();
                        aLeave_Taken_Date = $("#Leave_Taken_Date").val();
                        if (!isNaN(aLeavedays) && !isNaN(aRestday))
                        {
                            myDateString = Numberofdays(aLeave_Taken_Date, aRestday, aLeavedays)
                            $("#ReportOn").val(myDateString);
                        }
                    });



                    $('#Date_Selecter').multiDatesPicker({
                        dateFormat: "yy-mm-dd",
                        altField: '#Date_Selected'
                    });

                    $("#myLeave_Taken_Date,#myLeaveReportOn").live("change", function()
                    {
                        leave_start_date = $("#myLeave_Taken_Date").val();
                        leave_end_date = $("#myLeaveReportOn").val();
                        if (leave_end_date != "" && leave_start_date != "")
                        {
                            dif = date_diff(leave_start_date, leave_end_date);
                            $("#total_leave_day").val(dif);
                        }
                    });



                    function myTimer()
                    {
                        var d = new Date();
                        var t = d.toLocaleTimeString();
                        $("#ctime").html(t);
                    }

                    setInterval(function() {
                        myTimer()
                    }, 1000);

                    $('#busy').hide();
                    document.body.style.overflow = "visible";

                    $("header #sys_info #language_bar ul li:nth-child(2)").toggle(
                            function()
                            {
                                parent_ul = $(this).parents('ul');
                                $(parent_ul).css('height', 'auto');
                            }
                            , function()
                            {
                                parent_ul = $(this).parents('ul');
                                $(parent_ul).css('height', '40px');
                            })

                            $("header #menu ul li a").click(function()
                            {
                                url = $(this).attr('href');
                                if (url)
                                {
                                    $('#busy').show();
                                    document.body.style.overflow = "hidden";
                                }
                            })

                        })


                $(function() {

                    pop_ups = $("pop_up_div");
                    if (pop_ups.length > 0)
                    {
                        $(".pop_up_div").dialog(
                                {
                                    width: "500px",
                                    modal: true
                                });
                    }
                    if (!Modernizr.inputtypes.date)
                    {
                        $("input[type=Date]").datepicker({
                            numberOfMonths: 2,
                            changeMonth: true,
                            changeYear: true,
                            dateFormat: 'yy-mm-dd',
                            showAnim: 'fold'
                        });
                    }


                    page = $("#thekey_page:not(.not_pop_up)");
                    chi = page.find(".rgrid .Edit")

                    $("#thekey_page:not(.not_pop_up)").find(".rgrid .Edit")
                            .click(function() {
                        url = $(this).attr('href');
                        $("#popup_update").load(url).dialog({
                            modal: true,
                            width: "470px",
                            position: ['40%', 50]
                        });
                        my_title = $("#popup_update font[color=#FF6600]")
                        if (my_title.length > 0)
                        {

                            $(".ui-dialog-titlebar span").html(my_title.html());
                            my_title.remove();
                        }
                        return false;
                    });


                    $(".rgrid .Edit").addClass('ui-icon-pencil');

                    $(".rgrid .view").addClass('ui-icon-play');



                    $(".rgrid .Delete").addClass('ui-icon-trash').click(function()
                    {
                        answer = confirm("Are You Sure You want to Delete this record ?")
                        if (answer)
                        {
                            delete_row = $(this).parents("tr");
                            my_url = $(this).attr("href");


                            $.ajax({
                                type: "Get",
                                url: my_url,
                                cache: false,
                                beforeSend: function()
                                {
                                    delete_row.animate({
                                        'backgroundColor': '#fb6c6c'
                                    }, 300).animate({
                                        opacity: 0.35
                                    }, "slow");
                                    ;
                                },
                                success: function()
                                {
                                    delete_row.slideUp('slow', function() {
                                        $(this).remove();
                                    });
                                }
                            });

                        }
                        return false;

                    })

                    $("#date_convert_button").click(function()
                    {
                        current_val = $("#date_convert").val();
                        isValid(current_val);
                        converted_val = ECDate(current_val);
                        $("#converted_date").html(converted_val);
                    });


                    $(".top_bar .add_more").live("click", function()
                    {

                        my_list = $(this).parent('li');
                        copy_list = my_list.clone();
                        $(this).removeClass('add_more').addClass('remove').children('span').html('Remove');
                        $(this).children('span').addClass('ui-icon-circle-minus').removeClass('ui-icon-circle-plus')
                        copy_list.appendTo(my_list.parents('ul'));
                        return false;
                    })

                    $(".top_bar .remove").live("click", function()
                    {
                        my_list = $(this).parent('li').remove();
                        return false;
                    })

                    $('.top_bar > p').toggle(
                            function()
                            {
                                $(this).find("a.down").removeClass('down').addClass('up');
                                $(this).parents('.top_bar').css('height', 'auto');
                            }, function()
                            {
                                $(this).find("a.up").removeClass('up').addClass('down');
                                $(this).parents('.top_bar').animate({
                                    height: "13px"
                                }, 500);
                            })

							
							  $('.Display_bar > p').toggle(
        function()
        {
            $(this).find("a.down").removeClass('down').addClass('up');
            
            $(this).parents('.Display_bar').css('height', '350px');
              
            $(this).parents('.Display_bar').css('overflow-y', 'auto');
              
              
        }, function()
        {
            $(this).find("a.up").removeClass('up').addClass('down');
            $(this).parents('.Display_bar').animate({
                height: "20px"
            }, 500);
               
            
        })

                            $('#date_converter').toggle(
                                    function()
                                    {
                                        $('#date_convert_bar').show();
                                    },
                                            function()
                                            {
                                                $('#date_convert_bar').hide();
                                            });

                                            $('.options input:radio').not('#other_role').click(function()
                                            {
                                                $('#new_user_group').hide();
                                            })

                                            $("#other_role").click(function()
                                            {
                                                $('#new_user_group').show();
                                            })


                                            $('.check_all').click(function()
                                            {
                                                my_pap = $(this).parents("label");
                                                bro = my_pap.siblings("ul").find("> li input:checkbox");//.not('input:checked');
                                                bro.trigger('click')
                                            })




                                            $("#group_list").change(function()
                                            {
                                                $(this).parents("form").submit();
                                            })
                                            my_sib = $('.left_text:not(.show_always)').siblings("ul");

                                            if (my_sib.length > 0)
                                            {
                                                my_sib.hide();
                                                grand_child = my_sib.find("li ul");
                                                grand_child.each(function()
                                                {
                                                    selected = $(this).find("input:checkbox:checked");
                                                    notselected = $(this).find("input:checkbox:not(input:checked)");
                                                    if (notselected.length == 0)
                                                    {
                                                        $(this).siblings("label").find("input:checkbox").attr('checked', true);
                                                    }
                                                });

                                                my_sib.each(function()
                                                {
                                                    selected = $(this).find(">li input:checkbox:checked");
                                                    notselected = $(this).find(">li input:checkbox:not(input:checked)");
                                                    if (notselected.length == 0)
                                                    {
                                                        $(this).siblings("label").find("input:checkbox").attr('checked', true);
                                                    }
                                                });

                                            }


                                            $('.left_text:not(.show_always').prepend('<a class="expand ui-icon ui-icon-circle-plus">&nbsp;</a>')

                                            $(".expand").live("click", function()
                                            {
                                                $(this).addClass("ui-icon-circle-minus").removeClass("ui-icon-circle-plus").removeClass("expand").addClass("collapse");
                                                my_pap = $(this).parents("label");
                                                bro = my_pap.siblings("ul").show();
                                                return false;
                                            })

                                            $(".collapse").live("click", function()
                                            {
                                                $(this).addClass("ui-icon-circle-plus").removeClass("ui-icon-circle-minus").removeClass("collapse").addClass("expand");
                                                my_pap = $(this).parents("label");
                                                bro = my_pap.siblings("ul").hide();
                                                return false;
                                            });


                                            $("input:submit,input:reset,input:button").button({
                                                icons: {
                                                    primary: 'ui-icon-gear',
                                                    secondary: 'ui-icon-triangle-1-s'
                                                }
                                            });



                                            $(".Section").change(function()
                                            {
                                                var id = $(this).val();//get value of changed listed box section
                                                var dataString = 'Section=' + id;
                                                //var path="http://localhost/ThekeyHRMS/Database_Update/";path +
                                                $.ajax
                                                        ({
                                                            type: "POST",
                                                            url: thekeyhrms_url + "ajax/ajax_SubSection.php",
                                                            data: dataString,
                                                            cache: false,
                                                            success: function(html)
                                                            {
                                                                $(".SubSection").html(html);
                                                            }
                                                        });






                                            });//end of section change event function



                                            $(".SubSection").change(function()
                                            {
                                                var id = $(this).val();//get value of changed listed box SubSection
                                                var dataString = 'SubSection=' + id;


                                                //changing group list box dynamicaly



                                                //changing Department list box dynmicaly

                                                $.ajax
                                                        ({
                                                            type: "POST",
                                                            url: thekeyhrms_url + "ajax/ajax_Department.php",
                                                            data: dataString,
                                                            cache: false,
                                                            success: function(html)
                                                            {
                                                                $(".Department").html(html);
                                                            }
                                                        });



                                            });//end of Sub section change event function



                                            $("#per_page").change(function()
                                            {
                                                $(this).parents("form").submit();
                                            })


                                        });
										
										
										
										
										
										$(document).ready(function()
{
               
                 
    /******Pagination Option******/ 
    var options = {
        currPage : 1, 
        optionsForRows : [30,50,60,80,100,200,3000],
        rowsPerPage : 10,
        firstArrow : (new Image()).src="../images/First.gif",
        prevArrow : (new Image()).src="../images/Previous.gif",
        lastArrow : (new Image()).src="../images/Last.gif",
        nextArrow : (new Image()).src="../images/Next.gif",
        topNav : false
    }
   
    $('#Attendance_allocation_rpt').tablePagination(options);
    /********end of pagination******/
                
                
    // Initialise Plugin
    var optionsFilter = {
        additionalFilterTriggers: [$('#quickfind')],
        clearFiltersControls: [$('#cleanfilters')]
    };
                
    $('#ThekeyHRMS_rpt').tableFilter(optionsFilter);
                
    $('#Attendance_allocation_rpt').tableFilter(optionsFilter);
                
    $('#hidefilters').click(function ()
    {            
        $('.filter').hide;
            
    });
       
                
});




$(document).ready(function() 
{ 
    $("#ThekeyHRMS_rpt").tablesorter(); 
    
    $("#Attendance_allocation_rpt").tablesorter(); 
    
    
} 
);


function updateQueryStringParameter(key) {
    //  alert(key);
    var uri= window.location.href;
    var value=document.getElementById(key).value;
 
    var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
    separator = uri.indexOf('?') !== -1 ? "&" : "?";
    
    if (uri.match(re)) {
        location=uri.replace(re, '$1' + key + "=" + value + '$2');
       
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        location=uri + separator + key + "=" + value;
         
        return uri + separator + key + "=" + value;
    }
  
    
   
  
}



$(document).ready(function() 
{ 


    $(".ChartSelection").change(function()
    {
        var id = $(this).val();//get value of changed listed box SubSection
        var dataString = 'Chart=' + id;

        $.ajax
        ({
            type: "POST",
            url: thekeyhrms_url + "ajax/ajax_showChartDisplayOption.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $(".ChartDisplayOption").html(html);
            }
        });

    });
    
$('#attendance_summarizer').live("click",function(e){
 var selected_Department ='selected_Department=' +  $('#selected_Department').val();
  var selected_monthYear ='selected_monthYear=' +  $('#selected_monthYear').val();
    var From_Date ='From_Date=' +  $('#FromDate').val();

  var To_Date ='To_Date=' +  $('#ToDate').val();

       var dataString = selected_Department+'&'+selected_monthYear+'&'+From_Date+'&'+To_Date;

        $.ajaxSetup({
            beforeSend:function(){
                                $('#loading').remove(); 
                $('#mainContent').before('<div id="loading" style="top:400px;height: 100px;position: absolute;width: 100px;z-index: 1000;left:600px;alignment-adjust:  central;"><img alt="Am Working" src="' + thekeyhrms_url + 'ajax/loader13.gif"/>Attendance Summerizing...</div>');
            },
            complete:function(){
                $('#loading').remove(); 
            }
        }), $.ajax
       ({
           type: "POST",
           url: thekeyhrms_url + "ajax/ajax_attendance_summarizer.php",
           data: dataString,
           cache: false,
           success: function(html)
           {
alert(html);

 $.ajaxSetup({
            beforeSend:function(){
                                $('#loading').remove(); 
                $('#mainContent').before('<div id="loading" style="top:400px;height: 100px;position: absolute;width: 100px;z-index: 1000;left:600px;alignment-adjust:  central;"><img alt="Am Working" src="' + thekeyhrms_url + 'ajax/loader13.gif"/>Summarized data email sending...</div>');
            },
            complete:function(){
                $('#loading').remove(); 
            }
        }),$.post('http://192.168.1.201/ci/index.php/Attendance_System/mail_attendance_summary/json/'+$('#selected_monthYear').val(), dataString, function (result) {
               alert(result); 
            });
			
           }
       });

   });  
   
    
     $(".ReportSelection").change(function()
    {
        var id = $(this).val();//get value of changed listed box SubSection
        var dataString = 'Report=' + id;

        $.ajax
        ({
            type: "POST",
            url: thekeyhrms_url + "ajax/ajax_showReportDisplayOption.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $(".ReportDisplayOption").html(html);
            }
        });

    });
	
	
} 
);
