Select `Section`,`Sub Section`,`Group`,attendance_allocation.Department,
attendance_allocation.ID,CAST((SUBSTRING_INDEX(`ID`, '-', -1))AS UNSIGNED) AS IDNO,attendance_allocation.FirstName,
attendance_allocation.MiddelName,attendance_allocation.LastName,Date,


@Total_Working_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /3600))))
  AS Total_Working_Hour,
  

@Total_Working_Day:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /28800) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /28800) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /28800) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /28800) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.Working_HR),'00:00:00',attendance_allocation.Working_HR))) /28800))))
  AS Total_Working_Day,

  
@Total_Absent_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /3600))))
  AS Total_Absent_Hour,
  

@Total_Absent_Day:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800))))
  AS Total_Absent_Day,

  
@Working_Day:=26-(IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800))))) AS Working_Day,


@TotalLeaveDays:= (SELECT SUM(TotalLeaveDays)  AS TotalLeaveDays

FROM (
 
SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`Leavedays`,`RestDay`,`Leave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`Leave_Taken_Date` >= @Attendance_Opening_Date),`Leavedays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`Leave_Taken_Date` >= @Attendance_Opening_Date) and (`Leave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`Leave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`Leave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`Leave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)-`RestDay`),0)))),0) AS TotalLeaveDays


 FROM `annual_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`Leave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	
UNION ALL



SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`FuneralLeaveDays`,`RestDay`,`FuneralLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`FuneralLeave_Taken_Date` >= @Attendance_Opening_Date),`FuneralLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`FuneralLeave_Taken_Date` >= @Attendance_Opening_Date) and (`FuneralLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`FuneralLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`FuneralLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`FuneralLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)-`RestDay`),0)))),0) AS TotalLeaveDays


 FROM `Funeral_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`FuneralLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	

UNION ALL


SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`WeddingLeavedays`,`RestDay`,`WeddingLeave_TakenDate`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`WeddingLeave_TakenDate` >= @Attendance_Opening_Date),`WeddingLeavedays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`WeddingLeave_TakenDate` >= @Attendance_Opening_Date) and (`WeddingLeave_TakenDate` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`WeddingLeave_TakenDate`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`WeddingLeave_TakenDate` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`WeddingLeave_TakenDate` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)-`RestDay`),0)))),0) AS TotalLeaveDays


 FROM `Wedding_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`WeddingLeave_TakenDate` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 

	 
UNION ALL


SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`SickLeaveDays`,'RestDay' ,`SickLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`SickLeave_Taken_Date` >= @Attendance_Opening_Date),`SickLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`SickLeave_Taken_Date` >= @Attendance_Opening_Date) and (`SickLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`SickLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`SickLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`SickLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)),0)))),0) AS TotalLeaveDays


 FROM `Sick_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`SickLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	
UNION ALL



SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`MaternityLeaveDays`,'RestDay' ,`MaternityLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`MaternityLeave_Taken_Date` >= @Attendance_Opening_Date),`MaternityLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`MaternityLeave_Taken_Date` >= @Attendance_Opening_Date) and (`MaternityLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`MaternityLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`MaternityLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`MaternityLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)),0)))),0) AS TotalLeaveDays


 FROM `Maternity_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`MaternityLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	
	
UNION ALL	


SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`PaternityLeaveDays`,'RestDay' ,`PaternityLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`PaternityLeave_Taken_Date` >= @Attendance_Opening_Date),`PaternityLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`PaternityLeave_Taken_Date` >= @Attendance_Opening_Date) and (`PaternityLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`PaternityLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`PaternityLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`PaternityLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)),0)))),0) AS TotalLeaveDays


 FROM `Paternity_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`PaternityLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	
UNION ALL


SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`SpecialLeaveDays`,'RestDay' ,`SpecialLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`SpecialLeave_Taken_Date` >= @Attendance_Opening_Date),`SpecialLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`SpecialLeave_Taken_Date` >= @Attendance_Opening_Date) and (`SpecialLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`SpecialLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`SpecialLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`SpecialLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)),0)))),0) AS TotalLeaveDays


 FROM `Special_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`SpecialLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 

UNION ALL



SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`Leavedays`,`RestDay`,`Leave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`Leave_Taken_Date` >= @Attendance_Opening_Date),`Leavedays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`Leave_Taken_Date` >= @Attendance_Opening_Date) and (`Leave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`Leave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`Leave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`Leave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)-`RestDay`),0)))),0) AS TotalLeaveDays


 FROM `terminated_employee_annual_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`Leave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	
UNION ALL



SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`FuneralLeaveDays`,`RestDay`,`FuneralLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`FuneralLeave_Taken_Date` >= @Attendance_Opening_Date),`FuneralLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`FuneralLeave_Taken_Date` >= @Attendance_Opening_Date) and (`FuneralLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`FuneralLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`FuneralLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`FuneralLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)-`RestDay`),0)))),0) AS TotalLeaveDays


 FROM `terminated_employee_Funeral_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`FuneralLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	

UNION ALL


SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`WeddingLeavedays`,`RestDay`,`WeddingLeave_TakenDate`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`WeddingLeave_TakenDate` >= @Attendance_Opening_Date),`WeddingLeavedays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`WeddingLeave_TakenDate` >= @Attendance_Opening_Date) and (`WeddingLeave_TakenDate` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`WeddingLeave_TakenDate`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`WeddingLeave_TakenDate` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`WeddingLeave_TakenDate` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)-`RestDay`),0)))),0) AS TotalLeaveDays


 FROM `terminated_employee_Wedding_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`WeddingLeave_TakenDate` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 

	 
UNION ALL


SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`SickLeaveDays`,'RestDay' ,`SickLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`SickLeave_Taken_Date` >= @Attendance_Opening_Date),`SickLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`SickLeave_Taken_Date` >= @Attendance_Opening_Date) and (`SickLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`SickLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`SickLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`SickLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)),0)))),0) AS TotalLeaveDays


 FROM `terminated_employee_Sick_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`SickLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	
UNION ALL



SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`MaternityLeaveDays`,'RestDay' ,`MaternityLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`MaternityLeave_Taken_Date` >= @Attendance_Opening_Date),`MaternityLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`MaternityLeave_Taken_Date` >= @Attendance_Opening_Date) and (`MaternityLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`MaternityLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`MaternityLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`MaternityLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)),0)))),0) AS TotalLeaveDays


 FROM `terminated_employee_Maternity_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`MaternityLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	
	
UNION ALL	


SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`PaternityLeaveDays`,'RestDay' ,`PaternityLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`PaternityLeave_Taken_Date` >= @Attendance_Opening_Date),`PaternityLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`PaternityLeave_Taken_Date` >= @Attendance_Opening_Date) and (`PaternityLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`PaternityLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`PaternityLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`PaternityLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)),0)))),0) AS TotalLeaveDays


 FROM `terminated_employee_Paternity_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`PaternityLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 
	
UNION ALL


SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`SpecialLeaveDays`,'RestDay' ,`SpecialLeave_Taken_Date`,`ReportOn`,

@Attendance_Opening_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) AS Attendance_Opening_Date
FROM `company_settings`) AS Attendance_Opening_Date ,

@Attendance_Closing_Date:=(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) AS Attendance_Closing_Date
FROM `company_settings`) AS Attendance_Closing_Date ,

@Next_Attendance_Opening_Date:=ADDDATE(@Attendance_Closing_Date, 01) AS Next_Attendance_Opening_Date,

@TotalLeaveDays:=IF( (`ReportOn` >= @Attendance_Opening_Date),
    IF( (`ReportOn` <= @Attendance_Closing_Date) and (`SpecialLeave_Taken_Date` >= @Attendance_Opening_Date),`SpecialLeaveDays`,
      IF( (`ReportOn` > @Attendance_Closing_Date) and (`SpecialLeave_Taken_Date` >= @Attendance_Opening_Date) and (`SpecialLeave_Taken_Date` <= @Attendance_Closing_Date),
	  (DATEDIFF(@Next_Attendance_Opening_Date,`SpecialLeave_Taken_Date`)),
		IF( (`ReportOn` >= @Attendance_Closing_Date) and (`SpecialLeave_Taken_Date` <= @Attendance_Opening_Date),
			(DATEDIFF(@Attendance_Closing_Date,@Attendance_Opening_Date)),
			IF( (`ReportOn` <= @Attendance_Closing_Date) and (`SpecialLeave_Taken_Date` < @Attendance_Opening_Date),
              (DATEDIFF(`ReportOn`,@Attendance_Opening_Date)),0)))),0) AS Total_Leave_Days


 FROM `terminated_employee_Special_leave` 
 
 WHERE 
 
((`ReportOn` >= 
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( ))-01 , "-", `Attendance_Opening_Date` ) FROM `company_settings`)) 
 AND
(`SpecialLeave_Taken_Date` <=
(SELECT CONCAT( YEAR(NOW( )) , "-", MONTH(NOW( )) , "-", `Attendance_Closing_Date` ) FROM `company_settings`)))
	 

) AS tempTotalLeaveDaysDynamic where ID=attendance_allocation.ID GROUP BY ID) as Total_Leave_Days,







@DayOT_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOT_HR),'00:00:00',attendance_allocation.DayOT_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOT_HR),'00:00:00',attendance_allocation.DayOT_HR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOT_HR),'00:00:00',attendance_allocation.DayOT_HR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOT_HR),'00:00:00',attendance_allocation.DayOT_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOT_HR),'00:00:00',attendance_allocation.DayOT_HR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOT_HR),'00:00:00',attendance_allocation.DayOT_HR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOT_HR),'00:00:00',attendance_allocation.DayOT_HR))) /3600))))
  AS DayOT_Hour,
  
  
  
@NightOT_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOT_HR),'00:00:00',attendance_allocation.NightOT_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOT_HR),'00:00:00',attendance_allocation.NightOT_HR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOT_HR),'00:00:00',attendance_allocation.NightOT_HR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOT_HR),'00:00:00',attendance_allocation.NightOT_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOT_HR),'00:00:00',attendance_allocation.NightOT_HR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOT_HR),'00:00:00',attendance_allocation.NightOT_HR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOT_HR),'00:00:00',attendance_allocation.NightOT_HR))) /3600))))
  AS NightOT_Hour,
  
  

@OffDayOT_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.SundayOT_HR),'00:00:00',attendance_allocation.SundayOT_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(if(isnull(attendance_allocation.SundayOT_HR),'00:00:00',attendance_allocation.SundayOT_HR)),'00:00:00',if(isnull(attendance_allocation.SundayOT_HR),'00:00:00',attendance_allocation.SundayOT_HR)))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.SundayOT_HR),'00:00:00',attendance_allocation.SundayOT_HR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.SundayOT_HR),'00:00:00',attendance_allocation.SundayOT_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.SundayOT_HR),'00:00:00',attendance_allocation.SundayOT_HR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.SundayOT_HR),'00:00:00',attendance_allocation.SundayOT_HR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.SundayOT_HR),'00:00:00',attendance_allocation.SundayOT_HR))) /3600))))
  AS OffDayOT_Hour,
  
  

@HolyDayOT_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolydayOT_HR),'00:00:00',attendance_allocation.HolydayOT_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolydayOT_HR),'00:00:00',attendance_allocation.HolydayOT_HR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolydayOT_HR),'00:00:00',attendance_allocation.HolydayOT_HR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolydayOT_HR),'00:00:00',attendance_allocation.HolydayOT_HR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolydayOT_HR),'00:00:00',attendance_allocation.HolydayOT_HR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolydayOT_HR),'00:00:00',attendance_allocation.HolydayOT_HR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolydayOT_HR),'00:00:00',attendance_allocation.HolydayOT_HR))) /3600))))
  AS HolyDayOT_Hour,


Prepared,Department_Manager,Checked,Approved

  From attendance_allocation 
  JOIN Department ON attendance_allocation.Department=Department.Department
  INNER JOIN User_Attendance ON Department.Section = User_Attendance.`Department`
  
 Group By attendance_allocation.ID 
 Order By attendance_allocation.Department,IDNO