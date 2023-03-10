<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        <script type="text/javascript" src="../Js/jquery.js"></script>
        <script type='text/javascript' src='../Js/jquery.bgiframe.min.js'></script>
        <script type='text/javascript' src='../Js/jquery.ajaxQueue.js'></script>
        <script type='text/javascript' src='../Js/thickbox-compressed.js'></script>
        <script type='text/javascript' src='../Js/jquery.autocomplete.js'></script>
        <script type='text/javascript' src='../Js/localdata.js'></script>
        <link rel="stylesheet" type="text/css" href="../Css/main.css" />
        <link rel="stylesheet" type="text/css" href="../Css/jquery.autocomplete.css" />
        <link rel="stylesheet" type="text/css" href="../Css/thickbox.css" />

        <script type="text/javascript">
            $().ready(function() {

                function log(event, data, formatted) {
                    $("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
                    var datastr=String(data);
                    var dataselected=datastr.slice(0,8)
                    alert(dataselected);
                    location="../Personal_Information_detail.php?ID=" +dataselected;
                }
	
                function formatItem(row) {
                    return row[0] + " (<strong>id: " + row[1] + "</strong>)";
                }
                function formatResult(row) {
                    return row[0].replace(/(<.+?>)/gi, '');
                }
	
                /*	$("#suggest1").focus().autocomplete(cities);
                $("#month").autocomplete(months, {
                        minChars: 0,
                        max: 12,
                        autoFill: true,
                        mustMatch: true,
                        matchContains: false,
                        scrollHeight: 220,
                        formatItem: function(data, i, total) {
                                // don't show the current month in the list of values (for whatever reason)
                                if ( data[0] == months[new Date().getMonth()] ) 
                                        return false;
                                return data[0];
                        }
                });
                $("#suggest13").autocomplete(emails, {
                        minChars: 0,
                        width: 310,
                        matchContains: "word",
                        autoFill: false,
                        formatItem: function(row, i, max) {
                                return i + "/" + max + ": \"" + row.name + "\" [" + row.to + "]";
                        },
                        formatMatch: function(row, i, max) {
                                return row.name + " " + row.to;
                        },
                        formatResult: function(row) {
                                return row.to;
                        }
                });
                $("#singleBirdRemote").autocomplete("search.php", {
                        width: 260,
                        selectFirst: false
                });
                $("#suggest14").autocomplete(cities, {
                        matchContains: true,
                        minChars: 0
                });
                $("#suggest3").autocomplete(cities, {
                        multiple: true,
                        mustMatch: true,
                        autoFill: true
                });
                $("#suggest4").autocomplete('search.php', {
                        width: 300,
                        multiple: true,
                        matchContains: true,
                        formatItem: formatItem,
                        formatResult: formatResult
                });
                 */	$("#imageSearch").autocomplete("Search_Path.php", {
                    width: 320,
                    max: 2000,
                    highlight: false,
                    scroll: true,
                    scrollHeight: 300,
                    formatItem: function(data, i, n, value) {
                        return "<img src='../../Employee_Images/" + value + "' height='90' width='80'/> " + value.split(".")[0];
                    },
                    formatResult: function(data, value) {
                        return value.split(".")[0];
                    }
                });
	
                /*	$("#tags").autocomplete(["c++", "java", "php", "coldfusion", "javascript", "asp", "ruby", "python", "c", "scala", "groovy", "haskell", "pearl"], {
                        width: 320,
                        max: 4,
                        highlight: false,
                        multiple: true,
                        multipleSeparator: " ",
                        scroll: true,
                        scrollHeight: 300
                });
	
                 */	
                $(":text, textarea").result(log).next().click(function() {
                    $(this).prev().search();
                });
                /*	$("#singleBirdRemote").result(function(event, data, formatted) {
                        if (data)
                                $(this).parent().next().find("input").val(data[1]);
                });
                $("#suggest4").result(function(event, data, formatted) {
                        var hidden = $(this).parent().next().find(">:input");
                        hidden.val( (hidden.val() ? hidden.val() + ";" : hidden.val()) + data[1]);
                });
            $("#suggest15").autocomplete(cities, { scroll: true } );
                $("#scrollChange").click(changeScrollHeight);
	
                $("#thickboxEmail").autocomplete(emails, {
                        minChars: 0,
                        width: 310,
                        matchContains: true,
                        highlightItem: false,
                        formatItem: function(row, i, max, term) {
                                return row.name.replace(new RegExp("(" + term + ")", "gi"), "<strong>$1</strong>") + "<br><span style='font-size: 80%;'>Email: &lt;" + row.to + "&gt;</span>";
                        },
                        formatResult: function(row) {
                                return row.to;
                        }
                });
	
                $("#clear").click(function() {
                        $(":input").unautocomplete();
                }); */
            });

            function changeOptions(){
                var max = parseInt(window.prompt('Please type number of items to display:', jQuery.Autocompleter.defaults.max));
                if (max > 0) {
                    $("#suggest1").setOptions({
                        max: max
                    });
                }
            }

            function changeScrollHeight() {
                var h = parseInt(window.prompt('Please type new scroll height (number in pixels):', jQuery.Autocompleter.defaults.scrollHeight));
                if(h > 0) {
                    $("#suggest1").setOptions({
                        scrollHeight: h
                    });
                }
            }

            function changeToMonths(){
                $("#suggest1")
                // clear existing data
                .val("")
                // change the local data to months
                .setOptions({data: months})
                // get the label tag
                .prev()
                // update the label tag
                .text("Month (local):");
            }
        </script>

    </head>

    <body>
        <p>
            <label>Type Employee ID:</label>
            <input type="text" id='imageSearch' size="12" />
            <input type="button" value="Search" />
        </p>
        <h3>Result:</h3><ol id="result" ></ol>


    </body>
</html>
