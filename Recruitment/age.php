<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Untitled Document</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <meta http-equiv="Content-Style-Type" content="text/css">
        <meta http-equiv="Content-Script-Type" content="text/javascript">

    </head>
    <body>
        Insert your date of birth in format dd/mm/yyyy<br>
        <input id="txt" type="text"><input type="button" value="Show Age" onclick="showAge()">
        <script type="text/javascript">
            function showAge(){
                var d =document.getElementById('txt').value.split('/');
                var today=new Date();
                var bday=new Date(d[2],d[1],d[0]);
                var by=bday.getFullYear();
                var bm=bday.getMonth()-1;
                var bd=bday.getDate();
                var age=0; var dif=bday;
                while(dif<=today){
                    var dif = new Date(by+age,bm,bd);
                    age++;
                }
                age +=-2 ;
                alert('You are '+age+' years old')
            }
        </script>
    </body> 
</html>