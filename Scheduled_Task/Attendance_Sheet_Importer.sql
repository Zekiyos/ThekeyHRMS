USE thekeyhrmsdb;

 INSERT INTO attendance_sheet () 


SELECT Waarde AS ID,CONCAT(`user`.`Voornaam`," ", `user`.`Achternaam`) AS "Full_Name",
gebruikersgroep.`Omschrijving` AS Department,
LEFT(s.Datum,10) AS "Date",TIME(s.starttijd) AS "Start",
TIME(s.StartPauze) AS Start_Break,TIME(s.EindPauze) AS End_Break,
TIME(s.Eindtijd) AS End
 FROM snapshot s JOIN user ON User.userID=S.UserID JOIN gebruikersgroep ON gebruikersgroep.gebruikersgroepID=user.gebruikersgroepID
 JOIN vrijveldwaarde v ON v.userid=user.userid
WHERE Fiat=1 and
(YEAR(s.Datum)='2012' and MONTH(s.Datum) ='07' and DAY(s.Datum) ='14'
OR
YEAR(s.Datum)='2012' and MONTH(s.Datum) ='07' and DAY(s.Datum) ='14')
AND (gebruikersgroep.`Omschrijving` LIKE "%12%"
OR gebruikersgroep.`Omschrijving` LIKE "%11%")
AND LEFT(Waarde,2)="SH"  ORDER BY Department,ID,Date;