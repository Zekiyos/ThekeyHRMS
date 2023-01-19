INSERT INTO `thekeyhrmsdb`.`attendance_sheet`
           (`ID`, `FirstName`, `MiddelName`, `LastName`, `Department`, `Date`,
            `Start`, `Start_Break`, `End_Break`, `End`)
SELECT Waarde AS ID,`user`.`Voornaam` AS FirstName,
`user`.Tussenvoegsel AS MiddelName,
`user`.`Achternaam` AS LastName,
gebruikersgroep.`Omschrijving` AS Department,
date(s.Datum) AS 'Date',TIME(s.starttijd) AS 'Start',
TIME(s.StartPauze) AS Start_Break,TIME(s.EindPauze) AS End_Break,
TIME(s.Eindtijd) AS End
 
FROM snapshot s JOIN user ON User.userID=S.UserID 
JOIN gebruikersgroep ON gebruikersgroep.gebruikersgroepID=user.gebruikersgroepID
JOIN vrijveldwaarde v ON v.userid=user.userid
 
WHERE Fiat=1 
and s.Datum>='2012-09-21'
and  s.Datum<='2012-10-21'
AND (gebruikersgroep.`Omschrijving` LIKE '%12%')
AND v.vrijveldid='8951c7d4-d6a7-4db2-a201-b29fe37b4787'
AND Waarde<>'SH-Blocked'  ORDER BY Department,ID,Date;