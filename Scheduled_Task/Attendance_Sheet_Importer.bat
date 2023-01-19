@ECHO OFF
"C:\Program Files\MySQL\MySQL Server 5.0\bin\mysql" -uroot -pEWSadmin < C:\Shared\IdentySoft\ClearZonderSnapshots\clear.sql 
"D:\wamp\bin\mysql\mysql5.5.8\bin\mysql" -uroot < "E:\Project Data\Sher\15-07-2012\task Schedule\sql1.sql" 
pause