Select `Section`,`Sub Section`,Department.`Group`,attendance_allocation.Department,
attendance_allocation.ID,CAST((SUBSTRING_INDEX(attendance_allocation.`ID`, '-', -1))AS UNSIGNED) AS IDNO,attendance_allocation.FirstName,
attendance_allocation.MiddelName,attendance_allocation.LastName,Date,


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

  
@Working_Day:=if(
working_day_val -(IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)))))-(IF(isnull(TotalLeaveDays),0, if(TotalLeaveDays>working_day_val,working_day_val,TotalLeaveDays) ))
<0,0,
working_day_val -(IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ) < 0.25,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ),

IF((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)
-
floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) ) < 0.75,

floor((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800) )+0.5,

CEILING((Sum(Time_To_Sec(if(isnull(attendance_allocation.AbsentHR),'00:00:00',attendance_allocation.AbsentHR))) /28800)))))-(IF(isnull(TotalLeaveDays),0, if(TotalLeaveDays>working_day_val,working_day_val,TotalLeaveDays) ))
) AS Working_Day,


@TotalLeaveDays:=(IF(isnull(TotalLeaveDays),0,if(TotalLeaveDays>working_day_val,working_day_val,TotalLeaveDays))) AS Total_Leave_Days,


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
  AS HolyDayOT_Hour,


Prepared,Department_Manager,Checked,Approved

  From attendance_allocation LEFT JOIN Al_TotalLeaveDays ON Al_TotalLeaveDays.ID=attendance_allocation.ID
  JOIN employee_personal_record ON attendance_allocation.ID=employee_personal_record.ID  
  JOIN Department ON employee_personal_record.Department=Department.Department
  INNER JOIN User_Attendance ON Department.Section = User_Attendance.`Department`
  
