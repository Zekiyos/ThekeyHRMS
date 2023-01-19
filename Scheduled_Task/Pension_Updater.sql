USE thekeyhrmsdb;

UPDATE `thekeyhrmsdb`.`total_deduction` SET `CHK_Pension` = 'YES' WHERE `total_deduction`.`ID`= ANY
 (

SELECT ID FROM (
SELECT `ID`,`FirstName`,`MiddelName`,`Department`,"Date_Employement","No_Day" 
     FROM `total_deduction` WHERE `CHK_Pension`='NO' 
UNION
SELECT `ID`,`FirstName`,`MiddelName`,`Department`,`Date_Employement`,DATEDIFF(NOW(),`Date_Employement`)
     FROM `employee_personal_record` WHERE DATEDIFF(NOW(),`Date_Employement`)=45
) as sql1 WHERE DATEDIFF(NOW(),`Date_Employement`)=45 )