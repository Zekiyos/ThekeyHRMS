SELECT Department.`Section`,Department.Department,sql_no_employee.Total_No_Employee,

@Total_Working_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /3600))))
  AS Total_Working_Hour,
  

@Total_Working_Day:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /28800) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /28800) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /28800) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /28800) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.WorkingHR),'00:00:00',attendance_allocation.WorkingHR))) /28800))))
  AS Total_Working_Day,
sql_leave.Total_Leave_Days AS Total_Leave_Days,
  
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

  

@DayOT_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOTHR),'00:00:00',attendance_allocation.DayOTHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOTHR),'00:00:00',attendance_allocation.DayOTHR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOTHR),'00:00:00',attendance_allocation.DayOTHR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOTHR),'00:00:00',attendance_allocation.DayOTHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOTHR),'00:00:00',attendance_allocation.DayOTHR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOTHR),'00:00:00',attendance_allocation.DayOTHR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.DayOTHR),'00:00:00',attendance_allocation.DayOTHR))) /3600))))
  AS DayOT_Hour,
  
  
  
@NightOT_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOTHR),'00:00:00',attendance_allocation.NightOTHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOTHR),'00:00:00',attendance_allocation.NightOTHR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOTHR),'00:00:00',attendance_allocation.NightOTHR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOTHR),'00:00:00',attendance_allocation.NightOTHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOTHR),'00:00:00',attendance_allocation.NightOTHR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOTHR),'00:00:00',attendance_allocation.NightOTHR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.NightOTHR),'00:00:00',attendance_allocation.NightOTHR))) /3600))))
  AS NightOT_Hour,
  
  

@OffDayOT_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.SunDayOTHR),'00:00:00',attendance_allocation.SunDayOTHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(if(isnull(attendance_allocation.SunDayOTHR),'00:00:00',attendance_allocation.SunDayOTHR)),'00:00:00',if(isnull(attendance_allocation.SunDayOTHR),'00:00:00',attendance_allocation.SunDayOTHR)))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.SunDayOTHR),'00:00:00',attendance_allocation.SunDayOTHR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.SunDayOTHR),'00:00:00',attendance_allocation.SunDayOTHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.SunDayOTHR),'00:00:00',attendance_allocation.SunDayOTHR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.SunDayOTHR),'00:00:00',attendance_allocation.SunDayOTHR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.SunDayOTHR),'00:00:00',attendance_allocation.SunDayOTHR))) /3600))))
  AS OffDayOT_Hour,
  
  

@HolyDayOT_Hour:=IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolyDayOTHR),'00:00:00',attendance_allocation.HolyDayOTHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolyDayOTHR),'00:00:00',attendance_allocation.HolyDayOTHR))) /3600) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolyDayOTHR),'00:00:00',attendance_allocation.HolyDayOTHR))) /3600) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolyDayOTHR),'00:00:00',attendance_allocation.HolyDayOTHR))) /3600)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolyDayOTHR),'00:00:00',attendance_allocation.HolyDayOTHR))) /3600) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolyDayOTHR),'00:00:00',attendance_allocation.HolyDayOTHR))) /3600) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.HolyDayOTHR),'00:00:00',attendance_allocation.HolyDayOTHR))) /3600))))
  AS HolyDayOT_Hour
  
   
  
 From attendance_allocation 

  JOIN Department ON attendance_allocation.Department=Department.Department
 LEFT JOIN (
 SELECT `Section`,Count(STATUS ) AS Total_Leave_Days    
  From attendance_allocation 
   JOIN Department ON attendance_allocation.Department=Department.`Department`
    WHERE attendance_allocation.Date BETWEEN rptparameter1 AND rptparameter2 AND `Status` LIKE '%Leave%' AND Status NOT LIKE '%Special Leave Without Payment%' 
 Group By Department.`Section`
 Order By Department.`Section` ) AS sql_leave 
 ON 
 sql_leave.Section=Department.`Section` 
 
 JOIN (
 SELECT `Section`,COUNT( DISTINCT ID ) AS Total_No_Employee    
  From attendance_allocation 
   JOIN Department ON attendance_allocation.Department=Department.`Department`
    WHERE attendance_allocation.Date BETWEEN rptparameter1 AND rptparameter2 
	
 Group By Department.`Section`
 Order By attendance_allocation.ID ) AS sql_no_employee 
 ON 
 sql_no_employee.Section=Department.`Section`
 
WHERE attendance_allocation.Date BETWEEN rptparameter1 AND rptparameter2 
 Group By Department.`Section`
 Order By Department.`Section`