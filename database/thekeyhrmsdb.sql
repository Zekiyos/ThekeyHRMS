-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2023 at 02:13 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thekeyhrmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level_privilege`
--

CREATE TABLE IF NOT EXISTS `access_level_privilege` (
  `Page_Description` text COLLATE utf8_unicode_ci,
  `PageName` text COLLATE utf8_unicode_ci,
  `Granted_Access_Level` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_settings`
--

CREATE TABLE IF NOT EXISTS `allowance_settings` (
  `Allowance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Allowance_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Min_Value` double(10,2) NOT NULL,
  `Max_Value` double(10,2) NOT NULL,
  `Formula` tinyint(4) NOT NULL DEFAULT '0',
  `Taxable` tinyint(4) NOT NULL DEFAULT '0',
  `Allowance_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Allowance_ID`,`Allowance_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `al_totalleavedays`
--
CREATE TABLE IF NOT EXISTS `al_totalleavedays` (
`ID` varchar(255)
,`TotalLeaveDays` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `al_totalleavedaysx`
--
CREATE TABLE IF NOT EXISTS `al_totalleavedaysx` (
`ID` varchar(255)
,`TotalLeaveDays` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `al_totalnightotdays`
--
CREATE TABLE IF NOT EXISTS `al_totalnightotdays` (
`ID` varchar(255)
,`TotalNightOTDays` bigint(21)
,`Date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `al_totaloffdays`
--
CREATE TABLE IF NOT EXISTS `al_totaloffdays` (
`ID` varchar(255)
,`TotalOffDays` bigint(21)
,`Date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `al_totaloffdaysx`
--
CREATE TABLE IF NOT EXISTS `al_totaloffdaysx` (
`ID` varchar(255)
,`TotalOffDays` bigint(21)
,`Date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `al_total_leavedays2`
--
CREATE TABLE IF NOT EXISTS `al_total_leavedays2` (
`ID` varchar(255)
,`TotalLeaveDays` bigint(21)
);
-- --------------------------------------------------------

--
-- Table structure for table `annual_leave`
--

CREATE TABLE IF NOT EXISTS `annual_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Leavedays` decimal(10,1) NOT NULL,
  `RestDay` int(4) DEFAULT '0',
  `Leave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Annual Leave',
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`Leave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4866 ;

--
-- Triggers `annual_leave`
--
DROP TRIGGER IF EXISTS `AnnualLeave_Insert_Trigger`;
DELIMITER //
CREATE TRIGGER `AnnualLeave_Insert_Trigger` AFTER INSERT ON `annual_leave`
 FOR EACH ROW BEGIN
INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.Leavedays,
NEW.RestDay,NEW.Leave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'INSERT');
 END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `AnnualLeave_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `AnnualLeave_Update_Trigger` AFTER UPDATE ON `annual_leave`
 FOR EACH ROW BEGIN
INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,
OLD.MiddelName,OLD.LastName,Department,OLD.Leavedays,
OLD.RestDay,OLD.Leave_Taken_Date,OLD.ReportOn,
OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'BEFORE UPDATE');

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.Leavedays,
NEW.RestDay,NEW.Leave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'AFTER UPDATE');

 END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `AnnualLeave_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `AnnualLeave_Delete_Trigger` AFTER DELETE ON `annual_leave`
 FOR EACH ROW BEGIN
INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,
OLD.MiddelName,OLD.LastName,Department,OLD.Leavedays,
OLD.RestDay,OLD.Leave_Taken_Date,OLD.ReportOn,
OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'DELETE');
 END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `annual_leave_calculate`
--

CREATE TABLE IF NOT EXISTS `annual_leave_calculate` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WorkingMonth` int(11) NOT NULL,
  `WorkingYear` int(11) NOT NULL,
  `ThisYearALdays` int(11) NOT NULL,
  `LastYearALdays` int(11) NOT NULL,
  `BeforeLastYearALdays` int(11) NOT NULL,
  `TotalALdays` int(11) NOT NULL,
  `TotalTakenDay` int(10) DEFAULT NULL,
  `TotalLeftDay` int(10) DEFAULT NULL,
  `Calculated_Date` date NOT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BeforeLastYearLeft` int(10) DEFAULT NULL,
  `LastYearLeft` int(10) DEFAULT NULL,
  `ThisYearLeft` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `annual_leave_calculateold`
--

CREATE TABLE IF NOT EXISTS `annual_leave_calculateold` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WorkingMonth` int(11) NOT NULL,
  `WorkingYear` int(11) NOT NULL,
  `ThisYearALdays` int(11) NOT NULL,
  `LastYearALdays` int(11) NOT NULL,
  `BeforeLastYearALdays` int(11) NOT NULL,
  `TotalALdays` int(11) NOT NULL,
  `Calculated_Date` date NOT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `annual_leave_detail`
--

CREATE TABLE IF NOT EXISTS `annual_leave_detail` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WorkingMonth` int(11) NOT NULL,
  `WorkingYear` int(11) NOT NULL,
  `ThisYearALdays` int(11) NOT NULL,
  `LastYearALdays` int(11) NOT NULL,
  `BeforeLastYearALdays` int(11) NOT NULL,
  `TotalALdays` int(11) NOT NULL,
  `ALCalculated_Date` date NOT NULL,
  `ThisYearALLeft` int(11) NOT NULL,
  `LastYearALLeft` int(11) NOT NULL,
  `BeforeLastYearALLeft` int(11) NOT NULL,
  `TotalALLeftdays` int(11) NOT NULL,
  `ALTaken` int(11) NOT NULL,
  `ALTaken_Date` date NOT NULL,
  PRIMARY KEY (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `annual_leave_settings`
--

CREATE TABLE IF NOT EXISTS `annual_leave_settings` (
  `Company_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date_Employement` date NOT NULL,
  `To_Date_Employement` date NOT NULL,
  `Annual_Leave_Expiry_Year` int(5) DEFAULT NULL,
  `Annual_Leave_Initial_Days` int(5) DEFAULT NULL,
  `Annual_Leave_CONST_Year` int(11) DEFAULT NULL COMMENT 'Annual leave constant Year',
  `Annual_Leave_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`From_Date_Employement`,`To_Date_Employement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aq_personal_record`
--

CREATE TABLE IF NOT EXISTS `aq_personal_record` (
  `ID` varchar(8) DEFAULT NULL,
  `FirstName` varchar(14) DEFAULT NULL,
  `MiddelName` varchar(11) DEFAULT NULL,
  `LastName` varchar(12) DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Date_Birth_EC` date NOT NULL,
  `Date_Employeement` date DEFAULT NULL,
  `Date_Employeement_EC` date NOT NULL,
  `Department` varchar(25) DEFAULT NULL,
  `Position` varchar(29) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `at`
--

CREATE TABLE IF NOT EXISTS `at` (
  `ID` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(41) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(48) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WorkingHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOTHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOTHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOTHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOTHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Off_Day` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Definition` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`ID`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocationv2`
--

CREATE TABLE IF NOT EXISTS `attendance_allocationv2` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocationx`
--

CREATE TABLE IF NOT EXISTS `attendance_allocationx` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_6_5_2017`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_6_5_2017` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WorkingHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DayOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SundayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HolydayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Off_Day` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Definition` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2012_august`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2012_august` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2012_december`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2012_december` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WorkingHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DayOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SundayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HolydayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Off_Day` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2012_july`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2012_july` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2012_june`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2012_june` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2012_may`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2012_may` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2012_november`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2012_november` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2012_october`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2012_october` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2012_september`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2012_september` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2013_april`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2013_april` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WorkingHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DayOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SundayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HolydayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Off_Day` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2013_february`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2013_february` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WorkingHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DayOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SundayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HolydayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Off_Day` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2013_march`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2013_march` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WorkingHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DayOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SundayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HolydayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Off_Day` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_2013_may`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_2013_may` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Session` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NightOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SundayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HolydayOT_HR` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WorkingHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DayOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOT_MaxHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SundayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HolydayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Off_Day` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_allocation_new`
--

CREATE TABLE IF NOT EXISTS `attendance_allocation_new` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Scan_Start` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_Start_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End_Break` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Scan_End` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `First_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_Start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_End` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Second_Session_HR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WorkingHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NightOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `OffdayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HolydayOTHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `AbsentHR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Definition` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet` (
  `ID` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(38) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet2`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet2` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Start` time DEFAULT NULL,
  `Start_Break` time DEFAULT NULL,
  `End_Break` time DEFAULT NULL,
  `End` time DEFAULT NULL,
  `Work_Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet3`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet3` (
  `ID` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet4`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet4` (
  `ID` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet5`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet5` (
  `ID` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet6`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet6` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_2012_december`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_2012_december` (
  `ID` varchar(10) DEFAULT NULL,
  `FirstName` varchar(75) DEFAULT NULL,
  `MiddelName` varchar(75) DEFAULT NULL,
  `LastName` varchar(75) NOT NULL,
  `Department` varchar(38) DEFAULT NULL,
  `Date` varchar(10) DEFAULT NULL,
  `Start` varchar(8) DEFAULT NULL,
  `Start_Break` varchar(8) DEFAULT NULL,
  `End_Break` varchar(8) DEFAULT NULL,
  `End` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_2012_november`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_2012_november` (
  `ID` varchar(10) DEFAULT NULL,
  `FirstName` varchar(75) DEFAULT NULL,
  `MiddelName` varchar(75) DEFAULT NULL,
  `LastName` varchar(75) NOT NULL,
  `Department` varchar(38) DEFAULT NULL,
  `Date` varchar(10) DEFAULT NULL,
  `Start` varchar(8) DEFAULT NULL,
  `Start_Break` varchar(8) DEFAULT NULL,
  `End_Break` varchar(8) DEFAULT NULL,
  `End` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_2012_october`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_2012_october` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_2012_september`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_2012_september` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_2013_april`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_2013_april` (
  `ID` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(38) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_2013_february`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_2013_february` (
  `ID` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(38) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_2013_march`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_2013_march` (
  `ID` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(38) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_2013_may`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_2013_may` (
  `ID` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(38) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet_scan6`
--

CREATE TABLE IF NOT EXISTS `attendance_sheet_scan6` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Start_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_Break` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_summary_2012_november`
--

CREATE TABLE IF NOT EXISTS `attendance_summary_2012_november` (
  `Section` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDNO` bigint(67) unsigned DEFAULT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Total_Working_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Working_Day` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(18,1) DEFAULT NULL,
  `Working_Day` decimal(21,1) DEFAULT NULL,
  `Total_Leave_Days` bigint(20) DEFAULT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Prepared` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_summary_2012_october`
--

CREATE TABLE IF NOT EXISTS `attendance_summary_2012_october` (
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `IDNO` bigint(67) unsigned NOT NULL DEFAULT '0',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Total_Working_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Working_Day` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(18,1) DEFAULT NULL,
  `Working_Day` decimal(19,1) DEFAULT NULL,
  `Total_Leave_Days` decimal(45,0) DEFAULT NULL,
  `TotalNightOffDays` int(11) NOT NULL,
  `TotalNightOTDays` int(11) NOT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_summary_2012_september`
--

CREATE TABLE IF NOT EXISTS `attendance_summary_2012_september` (
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `IDNO` bigint(67) unsigned NOT NULL DEFAULT '0',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Working_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Working_Day` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(18,1) DEFAULT NULL,
  `Working_Day` decimal(19,1) DEFAULT NULL,
  `Total_Leave_Days` decimal(45,0) DEFAULT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_summary_2013_april`
--

CREATE TABLE IF NOT EXISTS `attendance_summary_2013_april` (
  `Section` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDNO` bigint(67) unsigned DEFAULT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Total_Working_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Working_Day` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(18,1) DEFAULT NULL,
  `Working_Day` decimal(22,1) DEFAULT NULL,
  `Total_Leave_Days` bigint(21) DEFAULT NULL,
  `Total_Off_Days` bigint(20) DEFAULT NULL,
  `TotalNightOTDays` bigint(20) DEFAULT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Prepared` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_summary_2013_february`
--

CREATE TABLE IF NOT EXISTS `attendance_summary_2013_february` (
  `Section` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDNO` bigint(67) unsigned DEFAULT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Total_Working_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Working_Day` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(18,1) DEFAULT NULL,
  `Working_Day` decimal(22,1) DEFAULT NULL,
  `Total_Leave_Days` bigint(21) DEFAULT NULL,
  `Total_Off_Days` bigint(20) DEFAULT NULL,
  `TotalNightOTDays` bigint(20) DEFAULT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Prepared` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_summary_2013_march`
--

CREATE TABLE IF NOT EXISTS `attendance_summary_2013_march` (
  `Section` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDNO` bigint(67) unsigned DEFAULT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Total_Working_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Working_Day` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(18,1) DEFAULT NULL,
  `Working_Day` decimal(22,1) DEFAULT NULL,
  `Total_Leave_Days` bigint(21) DEFAULT NULL,
  `Total_Off_Days` bigint(20) DEFAULT NULL,
  `TotalNightOTDays` bigint(20) DEFAULT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Prepared` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_summary_2013_may`
--

CREATE TABLE IF NOT EXISTS `attendance_summary_2013_may` (
  `Section` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDNO` bigint(67) unsigned DEFAULT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Total_Working_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Working_Day` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(18,1) DEFAULT NULL,
  `Working_Day` decimal(22,1) DEFAULT NULL,
  `Total_Leave_Days` bigint(21) DEFAULT NULL,
  `Total_Off_Days` bigint(20) DEFAULT NULL,
  `TotalNightOTDays` bigint(20) DEFAULT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Prepared` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_system_log`
--

CREATE TABLE IF NOT EXISTS `attendance_system_log` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` longtext COLLATE utf8_unicode_ci,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Time` datetime DEFAULT NULL,
  `TableName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Action` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Attendance_System_log';

-- --------------------------------------------------------

--
-- Table structure for table `auto_attendance_allocation_schedule`
--

CREATE TABLE IF NOT EXISTS `auto_attendance_allocation_schedule` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Scan_Date` date NOT NULL,
  `Schedule_Date` date NOT NULL,
  PRIMARY KEY (`ID`,`Scan_Date`,`Auto_ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `biometeric_attendance`
--

CREATE TABLE IF NOT EXISTS `biometeric_attendance` (
  `Section` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `Department1` varchar(38) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDNO` int(5) DEFAULT NULL,
  `ID` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(38) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `To_Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Working_Hour` decimal(4,1) DEFAULT NULL,
  `Total_Working_Day` decimal(3,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(4,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(3,1) DEFAULT NULL,
  `Working_Day` decimal(3,1) DEFAULT NULL,
  `Total_Leave_Days` int(2) DEFAULT NULL,
  `DayOT_Hour` decimal(3,1) DEFAULT NULL,
  `NightOT_Hour` int(1) DEFAULT NULL,
  `OffDayOT_Hour` int(1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(3,1) DEFAULT NULL,
  `Prepared` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biometric_attendance`
--

CREATE TABLE IF NOT EXISTS `biometric_attendance` (
  `Section` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `Department` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDNO` int(5) DEFAULT NULL,
  `FirstName` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department1` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `To_Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Working_Hour` decimal(4,1) DEFAULT NULL,
  `Total_Working_Day` decimal(3,1) DEFAULT NULL,
  `Total_Absent_Hour` decimal(4,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(3,1) DEFAULT NULL,
  `Working_Day` decimal(3,1) DEFAULT NULL,
  `Total_Leave_Days` int(2) DEFAULT NULL,
  `DayOT_Hour` decimal(3,1) DEFAULT NULL,
  `NightOT_Hour` int(1) DEFAULT NULL,
  `OffDayOT_Hour` int(1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(2,1) DEFAULT NULL,
  `Prepared` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biometric_attendance_summary`
--

CREATE TABLE IF NOT EXISTS `biometric_attendance_summary` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Working_Day` decimal(18,1) DEFAULT NULL,
  `Leave_Day` decimal(28,1) DEFAULT NULL,
  `Leave_Type_Days` text COLLATE utf8_unicode_ci NOT NULL,
  `Absent_Day` decimal(18,1) DEFAULT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Year_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Confirm` tinyint(4) NOT NULL DEFAULT '0',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `biometric_attendance_summary`
--
DROP TRIGGER IF EXISTS `biometric_attendance_summary_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `biometric_attendance_summary_INSERT_Trigger` AFTER INSERT ON `biometric_attendance_summary`
 FOR EACH ROW BEGIN

INSERT INTO attendance_system_log VALUES(
NEW.ID,CONCAT('FullName=',NEW.FirstName,' ',NEW.MiddelName,' ',NEW.LastName,' ',
'Department=',NEW.Department,' ',
'Working_Day=',NEW.Working_Day,' ',
'Leave_Day=',NEW.Leave_Day,' ',
'Absent_Day=',NEW.Absent_Day,' ',
'DayOT_Hour=',NEW.DayOT_Hour,' ',
'NightOT_Hour=',NEW.NightOT_Hour,' ',
'OffDayOT_Hour=',NEW.OffDayOT_Hour,' ',
'HolyDayOT_Hour=',NEW.HolyDayOT_Hour,' ',
'Year_Month=',NEW.`Year_Month`,' ',
'Prepared=',NEW.Prepared,' ',
'Department_Manager=',NEW.Department_Manager,' ',
'Checked=',NEW.Checked,' ',
'Approved=',NEW.Approved),
NEW.ModifiedBy,TIMESTAMP(NOW()),"biometric_attendance_summary",'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `biometric_attendance_summary_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `biometric_attendance_summary_Update_Trigger` AFTER UPDATE ON `biometric_attendance_summary`
 FOR EACH ROW BEGIN

INSERT INTO attendance_system_log VALUES(
OLD.ID,CONCAT('FullName=',OLD.FirstName,' ',OLD.MiddelName,' ',OLD.LastName,' ',
'Department=',OLD.Department,' ',
'Working_Day=',OLD.Working_Day,' ',
'Leave_Day=',OLD.Leave_Day,' ',
'Absent_Day=',OLD.Absent_Day,' ',
'DayOT_Hour=',OLD.DayOT_Hour,' ',
'NightOT_Hour=',OLD.NightOT_Hour,' ',
'OffDayOT_Hour=',OLD.OffDayOT_Hour,' ',
'HolyDayOT_Hour=',OLD.HolyDayOT_Hour,' ',
'Year_Month=',OLD.`Year_Month`,' ',
'Prepared=',OLD.Prepared,' ',
'Department_Manager=',OLD.Department_Manager,' ',
'Checked=',OLD.Checked,' ',
'Approved=',OLD.Approved),
OLD.ModifiedBy,TIMESTAMP(NOW()),"biometric_attendance_summary",'BEFORE UPDATE');



INSERT INTO attendance_system_log VALUES(
NEW.ID,CONCAT('FullName=',NEW.FirstName,' ',NEW.MiddelName,' ',NEW.LastName,' ',
'Department=',NEW.Department,' ',
'Working_Day=',NEW.Working_Day,' ',
'Leave_Day=',NEW.Leave_Day,' ',
'Absent_Day=',NEW.Absent_Day,' ',
'DayOT_Hour=',NEW.DayOT_Hour,' ',
'NightOT_Hour=',NEW.NightOT_Hour,' ',
'OffDayOT_Hour=',NEW.OffDayOT_Hour,' ',
'HolyDayOT_Hour=',NEW.HolyDayOT_Hour,' ',
'Year_Month=',NEW.`Year_Month`,' ',
'Prepared=',NEW.Prepared,' ',
'Department_Manager=',NEW.Department_Manager,' ',
'Checked=',NEW.Checked,' ',
'Approved=',NEW.Approved),
NEW.ModifiedBy,TIMESTAMP(NOW()),"biometric_attendance_summary",'AFTER UPDATE');


END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `biometric_attendance_summary_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `biometric_attendance_summary_Delete_Trigger` AFTER DELETE ON `biometric_attendance_summary`
 FOR EACH ROW BEGIN

INSERT INTO attendance_system_log VALUES(
OLD.ID,CONCAT('FullName=',OLD.FirstName,' ',OLD.MiddelName,' ',OLD.LastName,' ',
'Department=',OLD.Department,' ',
'Working_Day=',OLD.Working_Day,' ',
'Leave_Day=',OLD.Leave_Day,' ',
'Absent_Day=',OLD.Absent_Day,' ',
'DayOT_Hour=',OLD.DayOT_Hour,' ',
'NightOT_Hour=',OLD.NightOT_Hour,' ',
'OffDayOT_Hour=',OLD.OffDayOT_Hour,' ',
'HolyDayOT_Hour=',OLD.HolyDayOT_Hour,' ',
'Year_Month=',OLD.`Year_Month`,' ',
'Prepared=',OLD.Prepared,' ',
'Department_Manager=',OLD.Department_Manager,' ',
'Checked=',OLD.Checked,' ',
'Approved=',OLD.Approved),
OLD.ModifiedBy,TIMESTAMP(NOW()),"biometric_attendance_summary",'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE IF NOT EXISTS `bonus` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Year_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Bonus_Amount` double(10,2) NOT NULL,
  PRIMARY KEY (`ID`,`Year_Month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bunching`
--

CREATE TABLE IF NOT EXISTS `bunching` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Year_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `No_Bunch` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Year_Month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `canteen_service`
--

CREATE TABLE IF NOT EXISTS `canteen_service` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(25) NOT NULL,
  `Meal_ID` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  `Date_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`,`Date`,`Auto_ID`),
  KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cc`
--

CREATE TABLE IF NOT EXISTS `cc` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Chart_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Chart_Caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Chart_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `X_axis_Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `X_axis_Category_Field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Y_axis_Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Y_axis_Summary_Field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Y_axis_Summary_Value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Series_Field_Summary` text COLLATE utf8_unicode_ci NOT NULL,
  `Series_Field` text COLLATE utf8_unicode_ci NOT NULL,
  `Table_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Join_Table` text COLLATE utf8_unicode_ci NOT NULL,
  `Where_Clause` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Chart_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `cholinesterase_test`
--

CREATE TABLE IF NOT EXISTS `cholinesterase_test` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastResult` double DEFAULT NULL,
  `LastTestDate` date DEFAULT NULL,
  `FirstResult` double DEFAULT NULL,
  `FirstTestDate` date DEFAULT NULL,
  `FirstDifference` double DEFAULT NULL,
  `SecondResult` double DEFAULT NULL,
  `SecondTestDate` date DEFAULT NULL,
  `SecondDifference` double DEFAULT NULL,
  `ThirdResult` double DEFAULT NULL,
  `ThirdTestDate` date DEFAULT NULL,
  `ThirdDifference` double DEFAULT NULL,
  `ForthResult` double DEFAULT NULL,
  `ForthTestDate` date DEFAULT NULL,
  `ForthDifference` double DEFAULT NULL,
  `Year` year(4) NOT NULL,
  PRIMARY KEY (`ID`,`Year`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE IF NOT EXISTS `company_settings` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Company_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Annual_Leave_Expiry_Year` int(5) DEFAULT NULL,
  `Annual_Leave_Initial_Days` int(5) DEFAULT NULL,
  `Annual_Leave_CONST_Year` int(11) DEFAULT NULL COMMENT 'Annual leave constant Year',
  `ID_Number_Initial_Character` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Maximum_Allowed_ID_Number` int(15) DEFAULT NULL,
  `Medical_Referral_Hospital_Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Logo_Path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Logo_Height` int(11) NOT NULL,
  `Logo_Width` int(11) NOT NULL,
  `Company_Seal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Equipment_Picture_Path` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Web_Site` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_P.O.BOX` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_Country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_City` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_Telphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_Fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Attendance_System` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Attendance_Opening_Date` int(11) NOT NULL,
  `Attendance_Closing_Date` int(11) NOT NULL,
  `support_group` tinyint(1) NOT NULL,
  `OT_Auto_Allocation` tinyint(1) NOT NULL,
  PRIMARY KEY (`Company_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `company_settings3`
--

CREATE TABLE IF NOT EXISTS `company_settings3` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Company_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Annual_Leave_Expiry_Year` int(5) DEFAULT NULL,
  `Annual_Leave_Initial_Days` int(5) DEFAULT NULL,
  `Annual_Leave_CONST_Year` int(11) DEFAULT NULL COMMENT 'Annual leave constant Year',
  `ID_Number_Initial_Character` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Maximum_Allowed_ID_Number` int(15) DEFAULT NULL,
  `Medical_Referral_Hospital_Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Logo_Path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_Seal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Equipment_Picture_Path` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Web_Site` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_P.O.BOX` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `Company_Country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_City` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_Telphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company_Fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Attendance_Opening_Date` int(11) NOT NULL,
  `Attendance_Closing_Date` int(11) NOT NULL,
  PRIMARY KEY (`Company_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `contract_letter`
--

CREATE TABLE IF NOT EXISTS `contract_letter` (
  `Department` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Job_Description` varbinary(20000) DEFAULT NULL,
  `Job_Description_Amharic` varbinary(20000) DEFAULT NULL,
  PRIMARY KEY (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `court_case`
--

CREATE TABLE IF NOT EXISTS `court_case` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FileNumber` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FileDate` date DEFAULT NULL,
  `ClaimAmount` double DEFAULT NULL,
  `AdvocateName` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `Court` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Case` varchar(5000) CHARACTER SET latin1 DEFAULT NULL,
  `Result` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Decision` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Case_Status` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `daily_production`
--

CREATE TABLE IF NOT EXISTS `daily_production` (
  `Account_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Production_Amount` double NOT NULL,
  PRIMARY KEY (`Account_Name`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_notification_definition`
--

CREATE TABLE IF NOT EXISTS `dashboard_notification_definition` (
  `Notification_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Sql` text COLLATE utf8_unicode_ci NOT NULL,
  `Message` text COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Discription` text COLLATE utf8_unicode_ci NOT NULL,
  `Show_Chart` tinyint(4) NOT NULL,
  `Chart_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Detail_Sql` text COLLATE utf8_unicode_ci,
  `Show_Notification` tinyint(4) NOT NULL,
  `Show_Notification_PayrollSystem` tinyint(4) NOT NULL,
  PRIMARY KEY (`Notification_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_notification_definition_new`
--

CREATE TABLE IF NOT EXISTS `dashboard_notification_definition_new` (
  `User_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_ID` int(11) NOT NULL,
  `Show_Notification_HRMS` tinyint(1) NOT NULL DEFAULT '0',
  `Show_Chart_HRMS` tinyint(1) NOT NULL DEFAULT '0',
  `Show_Notification_Payroll_System` tinyint(1) NOT NULL DEFAULT '0',
  `Show_Chart_Payroll_System` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_Name`,`Notification_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deduction_settings`
--

CREATE TABLE IF NOT EXISTS `deduction_settings` (
  `Deduction_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Deduction_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Min_Value` double(10,2) NOT NULL,
  `Max_Value` double(10,2) NOT NULL,
  `Formula` tinyint(4) NOT NULL DEFAULT '0',
  `Deduction_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Deduction_ID`,`Deduction_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Division` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Department`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=954 ;

-- --------------------------------------------------------

--
-- Table structure for table `departmentsher`
--

CREATE TABLE IF NOT EXISTS `departmentsher` (
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Department`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departmentsheratt`
--

CREATE TABLE IF NOT EXISTS `departmentsheratt` (
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Department`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_2_10_2019`
--

CREATE TABLE IF NOT EXISTS `department_2_10_2019` (
  `Auto_ID` int(4) DEFAULT NULL,
  `Section` varchar(14) DEFAULT NULL,
  `Sub Section` varchar(18) DEFAULT NULL,
  `Group` varchar(29) DEFAULT NULL,
  `Department` varchar(47) DEFAULT NULL,
  `Division` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department_2019_june`
--

CREATE TABLE IF NOT EXISTS `department_2019_june` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Division` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Department`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`,`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1039 ;

-- --------------------------------------------------------

--
-- Table structure for table `department_group_no`
--

CREATE TABLE IF NOT EXISTS `department_group_no` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group_No` int(11) NOT NULL,
  PRIMARY KEY (`Auto_ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=95 ;

-- --------------------------------------------------------

--
-- Table structure for table `department_position`
--

CREATE TABLE IF NOT EXISTS `department_position` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Salary_Min` varchar(255) NOT NULL,
  `Salary_Max` varchar(255) NOT NULL,
  `Job_Description` text NOT NULL,
  PRIMARY KEY (`Department`,`Position`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=173 ;

-- --------------------------------------------------------

--
-- Table structure for table `department_position_zr`
--

CREATE TABLE IF NOT EXISTS `department_position_zr` (
  `Department` varchar(26) DEFAULT NULL,
  `Position` varchar(37) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department_transfer`
--

CREATE TABLE IF NOT EXISTS `department_transfer` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FromDepartment` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ToDepartment` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_AfterTransfered` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Transfered_Date` date NOT NULL,
  PRIMARY KEY (`ID`,`Transfered_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department_tulu`
--

CREATE TABLE IF NOT EXISTS `department_tulu` (
  `Auto_ID` varchar(10) DEFAULT NULL,
  `Section` varchar(14) DEFAULT NULL,
  `Sub Section` varchar(14) DEFAULT NULL,
  `Group` varchar(14) DEFAULT NULL,
  `Department` varchar(36) DEFAULT NULL,
  `Division` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department_zr`
--

CREATE TABLE IF NOT EXISTS `department_zr` (
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_action`
--

CREATE TABLE IF NOT EXISTS `disciplinary_action` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Discipline_Action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Discipline_Letter` longtext COLLATE utf8_unicode_ci,
  `Discipline_Taken_Date` date NOT NULL DEFAULT '0000-00-00',
  `Status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`ID`,`Discipline_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_actionold`
--

CREATE TABLE IF NOT EXISTS `disciplinary_actionold` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Verbal_Warning` varbinary(10000) DEFAULT NULL,
  `First_Inistance` varbinary(10000) DEFAULT NULL,
  `Second_Inistance` varbinary(10000) DEFAULT NULL,
  `Third_Inistance` varbinary(10000) DEFAULT NULL,
  `Last_Warning` varbinary(10000) DEFAULT NULL,
  `First_Inistance_Date` date DEFAULT NULL,
  `Verbal_Warning_Date` date DEFAULT NULL,
  `Second_Inistance_Date` date DEFAULT NULL,
  `Third_Inistance_Date` date DEFAULT NULL,
  `Last_Warning_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_action_old`
--

CREATE TABLE IF NOT EXISTS `disciplinary_action_old` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Verbal_Warning` varbinary(10000) DEFAULT NULL,
  `First_Inistance` varbinary(10000) DEFAULT NULL,
  `Second_Inistance` varbinary(10000) DEFAULT NULL,
  `Third_Inistance` varbinary(10000) DEFAULT NULL,
  `Last_Warning` varbinary(10000) DEFAULT NULL,
  `First_Inistance_Date` date DEFAULT NULL,
  `Verbal_Warning_Date` date DEFAULT NULL,
  `Second_Inistance_Date` date DEFAULT NULL,
  `Third_Inistance_Date` date DEFAULT NULL,
  `Last_Warning_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`),
  KEY `Department_2` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_action_settings`
--

CREATE TABLE IF NOT EXISTS `disciplinary_action_settings` (
  `Disciplinary_Action_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Disciplinary_Action_Priority` int(11) NOT NULL,
  `Expire_Days` double(10,2) NOT NULL,
  `Menu_Caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Menu_URL` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `Disciplinary_Action_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Disciplinary_Action_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discipline_action_settings`
--

CREATE TABLE IF NOT EXISTS `discipline_action_settings` (
  `Discipline_Action_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Discipline_Action_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Priority` int(11) NOT NULL,
  `Expire_Days` double(10,2) NOT NULL,
  `Menu_Caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Menu_URL` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `Disciplinary_Action_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Discipline_Action_ID`,`Discipline_Action_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_notification_definition`
--

CREATE TABLE IF NOT EXISTS `email_notification_definition` (
  `User_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_ID` int(11) NOT NULL,
  PRIMARY KEY (`User_Name`,`Notification_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employeeNumber` int(11) NOT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `officeCode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reportsTo` int(11) DEFAULT NULL,
  `jobTitle` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`employeeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees_audit`
--

CREATE TABLE IF NOT EXISTS `employees_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeNumber` int(11) NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `changedon` datetime DEFAULT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_allowance`
--

CREATE TABLE IF NOT EXISTS `employee_allowance` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Transport_Allowance` double NOT NULL DEFAULT '0',
  `Hardship_Allowance` double NOT NULL DEFAULT '0',
  `Housing_Allowance` double NOT NULL DEFAULT '0',
  `Position_Allowance` double NOT NULL DEFAULT '0',
  `Present_Allowance` double NOT NULL DEFAULT '0',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=521 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_allowance_definition`
--

CREATE TABLE IF NOT EXISTS `employee_allowance_definition` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Allowance_ID` int(11) NOT NULL,
  `Year_Month` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Allowance_Amount` double(10,2) NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`Allowance_ID`,`Year_Month`),
  KEY `Allowance_ID` (`Allowance_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_children`
--

CREATE TABLE IF NOT EXISTS `employee_children` (
  `ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Child_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Child_Birth_Date` date NOT NULL,
  `Child_Sex` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`Child_Name`),
  KEY `emp_number` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_consecutive_absent_days`
--

CREATE TABLE IF NOT EXISTS `employee_consecutive_absent_days` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Consecutive_Absent_Days` int(11) NOT NULL,
  `Absent_Dates` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_contract`
--

CREATE TABLE IF NOT EXISTS `employee_contract` (
  `ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Contract_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `From_Date` date NOT NULL DEFAULT '0000-00-00',
  `To_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`Contract_Name`,`From_Date`),
  KEY `emp_number` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_demotion`
--

CREATE TABLE IF NOT EXISTS `employee_demotion` (
  `Auto_ID` int(11) NOT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Evaluation_Result` float DEFAULT NULL,
  `Position_Before_Demotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_After_Demotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Before_Demotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_After_Demotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary_Before_Demotion` int(11) NOT NULL,
  `Salary_After_Demotion` int(11) NOT NULL,
  `Demotion_Date` date NOT NULL,
  PRIMARY KEY (`ID`,`Demotion_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_department_transfer`
--

CREATE TABLE IF NOT EXISTS `employee_department_transfer` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Position_Before` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `To_Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_After` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Transfer_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Transfer_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `FromDepartment` (`From_Department`,`To_Department`),
  KEY `ToDepartment` (`To_Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_dependents`
--

CREATE TABLE IF NOT EXISTS `employee_dependents` (
  `ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Dependent_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Dependent_Relationship` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Dependent_Birth_Date` date NOT NULL,
  `Dependent_Sex` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`Dependent_Name`),
  KEY `emp_number` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_discipline_action_definition`
--

CREATE TABLE IF NOT EXISTS `employee_discipline_action_definition` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Discipline_Action_ID` int(11) NOT NULL,
  `Discipline_Action_Letter` longtext COLLATE utf8_unicode_ci,
  `Discipline_Action_Taken_Date` date NOT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`ID`,`Discipline_Action_ID`,`Discipline_Action_Taken_Date`),
  KEY `Discipline_Action_ID` (`Discipline_Action_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_education`
--

CREATE TABLE IF NOT EXISTS `employee_education` (
  `ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Institute` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Major_Specialization` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Year` decimal(4,0) DEFAULT NULL,
  `GPA` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` date DEFAULT NULL,
  `To_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`Institute`,`Major_Specialization`),
  KEY `emp_number` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_emergency_contact`
--

CREATE TABLE IF NOT EXISTS `employee_emergency_contact` (
  `ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Contact_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Contact_Relationship` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Home_Telephone_No` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci DEFAULT NULL,
  `Mobile_Telephone_No` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Office_Telephone_No` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`Contact_Name`),
  KEY `emp_number` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_evaluation`
--

CREATE TABLE IF NOT EXISTS `employee_evaluation` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Year_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Total_Grade` double(10,2) NOT NULL,
  PRIMARY KEY (`ID`,`Year_Month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_image_path`
--

CREATE TABLE IF NOT EXISTS `employee_image_path` (
  `Company_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Path` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDCardBG` longblob NOT NULL,
  PRIMARY KEY (`Company_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_language`
--

CREATE TABLE IF NOT EXISTS `employee_language` (
  `ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Fluency` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Competency` varchar(25) CHARACTER SET utf16 COLLATE utf16_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Language`,`Fluency`),
  KEY `emp_number` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE IF NOT EXISTS `employee_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LeaveDays` double(10,2) NOT NULL,
  `RestDays` int(4) DEFAULT '0',
  `Leave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Annual Leave',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`Leave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `employee_personal_record_Annua_Leave` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_definition`
--

CREATE TABLE IF NOT EXISTS `employee_leave_definition` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Leave_ID` int(11) NOT NULL,
  `Leave_Taken_Date` date NOT NULL,
  `Leave_Days` double(10,2) NOT NULL,
  `Rest_Days` int(11) DEFAULT '0',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Leave_Taken_Date`),
  KEY `employee_personal_record_Annua_Leave` (`ID`),
  KEY `Leave_ID` (`Leave_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_offday`
--

CREATE TABLE IF NOT EXISTS `employee_offday` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Off_Day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  UNIQUE KEY `Auto_ID_2` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_offday1`
--

CREATE TABLE IF NOT EXISTS `employee_offday1` (
  `ID` varchar(8) DEFAULT NULL,
  `FirstName` varchar(18) DEFAULT NULL,
  `MiddelName` varchar(14) DEFAULT NULL,
  `LastName` varchar(12) DEFAULT NULL,
  `Department` varchar(31) DEFAULT NULL,
  `Off_day` varchar(9) DEFAULT NULL,
  `From_Date` varchar(10) DEFAULT NULL,
  `To_Date` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_offday_blen`
--

CREATE TABLE IF NOT EXISTS `employee_offday_blen` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Off_Day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`,`ID`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  UNIQUE KEY `Auto_ID_2` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=489 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_offday_tulu`
--

CREATE TABLE IF NOT EXISTS `employee_offday_tulu` (
  `Auto_ID` int(2) DEFAULT NULL,
  `ID` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddelName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Off_Day` varchar(255) DEFAULT NULL,
  `From_Date` varchar(10) DEFAULT NULL,
  `To_Date` varchar(10) DEFAULT NULL,
  `ModifiedBy` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_2019_june`
--

CREATE TABLE IF NOT EXISTS `employee_personal_2019_june` (
  `Auto_ID` varchar(10) DEFAULT NULL,
  `ID` varchar(11) DEFAULT NULL,
  `FirstName` varchar(13) DEFAULT NULL,
  `MiddelName` varchar(10) DEFAULT NULL,
  `LastName` varchar(12) DEFAULT NULL,
  `Department` varchar(41) DEFAULT NULL,
  `Position` varchar(8) DEFAULT NULL,
  `Date_Employement` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record` (
  `Auto_ID` int(11) NOT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Pension_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nick_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TIN` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Date_Birth` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub_City` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Kebele` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `House_No` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Mobile_Telephone_No` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Office_Telephone_No` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contract_Session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` double DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(11) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LU_Member` tinyint(4) NOT NULL DEFAULT '0',
  `Employment_Status` tinyint(4) NOT NULL DEFAULT '1',
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `employee_personal_record`
--
DROP TRIGGER IF EXISTS `EmployeeRecord_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `EmployeeRecord_INSERT_Trigger` AFTER INSERT ON `employee_personal_record`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
NEW.ID,CONCAT('FullName=',NEW.FirstName,' ',NEW.MiddelName,' ',NEW.LastName,'  ',
'Date_Birth=',NEW.Date_Birth,' ',
'Place_Birth=',NEW.Place_Birth,' ',
'Age=',NEW.Age,' ',
'Sex=',NEW.Sex,' ',
'Telephone=',NEW.Telephone,' ',
'Email=',NEW.Email,' ',
'Date_Employement=',NEW.Date_Employement,' ',
'Department=',NEW.Department,' ',
'Position=',NEW.Position,' ',
'Educational_Status=',NEW.Educational_Status,' ',
'Salary=',NEW.Salary,' ',
'Martial_Status',NEW.Martial_Status,' ',NEW.Spouse_Name,' ',
'Children_number=',NEW.Children_number,' ',
'Childern Detail=',NEW.Name_Child,' ',NEW.Date_Birth_Child,' ',NEW.Age_Child,' ',NEW.Sex_Child,' ',
'Contact_Emergency=',NEW.Contact_Emergency,' ',NEW.Contact_Relation,' ',
'Photo=',NEW.Photo,' ',
'Experience',NEW.Experience,' ',
'HardCopy_Shelf_No=',NEW.HardCopy_Shelf_No),
NEW.ModifiedBy,TIMESTAMP(NOW()),"Employeen Personal Record",'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `EmployeeRecord_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `EmployeeRecord_Delete_Trigger` AFTER DELETE ON `employee_personal_record`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
OLD.ID,CONCAT('FullName=',OLD.FirstName,OLD.MiddelName,OLD.LastName,' ',
'Date_Birth=',OLD.Date_Birth,' ',
'Place_Birth=',OLD.Place_Birth,' ',
'Age=',OLD.Age,' ',
'Sex=',OLD.Sex,' ',
'Telephone=',OLD.Telephone,' ',
'Email=',OLD.Email,' ',
'Date_Employement=',OLD.Date_Employement,' ',
'Department=',OLD.Department,' ',
'Position=',OLD.Position,' ',
'Educational_Status=',OLD.Educational_Status,' ',
'Salary=',OLD.Salary,' ',
'Martial_Status',OLD.Martial_Status,' ',OLD.Spouse_Name,' ',
'Children_number=',OLD.Children_number,' ',
'Childern Detail=',OLD.Name_Child,' ',OLD.Date_Birth_Child,' ',OLD.Age_Child,' ',OLD.Sex_Child,' '
'Contact_Emergency=',OLD.Contact_Emergency,' ',OLD.Contact_Relation,' ',
'Photo=',OLD.Photo,' ',
'Experience',OLD.Experience,' ',
'HardCopy_Shelf_No=',OLD.HardCopy_Shelf_No),
OLD.ModifiedBy,TIMESTAMP(NOW()),"Employeen Personal Record",'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record(rf15-03-2014)`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record(rf15-03-2014)` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contract_Session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(11) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2779 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record(sher line 11-12)`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record(sher line 11-12)` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=650 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record(sher line 13-14)`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record(sher line 13-14)` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1613 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record(zr)`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record(zr)` (
  `Auto_ID` int(4) DEFAULT NULL,
  `ID` varchar(8) DEFAULT NULL,
  `FirstName` varchar(14) DEFAULT NULL,
  `MiddelName` varchar(20) DEFAULT NULL,
  `LastName` varchar(13) DEFAULT NULL,
  `Date_Birth` varchar(10) DEFAULT NULL,
  `Place_Birth` varchar(10) DEFAULT NULL,
  `Age` int(1) DEFAULT NULL,
  `Sex` varchar(7) DEFAULT NULL,
  `Telephone` varchar(22) DEFAULT NULL,
  `Email` varchar(27) DEFAULT NULL,
  `Date_Employement` varchar(10) DEFAULT NULL,
  `Department` varchar(30) DEFAULT NULL,
  `Position` varchar(30) DEFAULT NULL,
  `Educational_Status` varchar(18) DEFAULT NULL,
  `Salary` int(5) DEFAULT NULL,
  `Martial_Status` varchar(9) DEFAULT NULL,
  `Spouse_Name` varchar(10) DEFAULT NULL,
  `Children_number` int(1) DEFAULT NULL,
  `Name_Child` varchar(127) DEFAULT NULL,
  `Date_Birth_Child` varchar(95) DEFAULT NULL,
  `Age_Child` varchar(10) DEFAULT NULL,
  `Sex_Child` varchar(50) DEFAULT NULL,
  `Contact_Emergency` varchar(28) DEFAULT NULL,
  `Contact_Relation` varchar(17) DEFAULT NULL,
  `Photo` varchar(1) DEFAULT NULL,
  `Image` varchar(10) DEFAULT NULL,
  `Experience` varchar(10) DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(10) DEFAULT NULL,
  `ModifiedBy` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record1`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record1` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1520 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record2`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record2` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1520 ;

--
-- Triggers `employee_personal_record2`
--
DROP TRIGGER IF EXISTS `EmployeeRecord_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `EmployeeRecord_Update_Trigger` AFTER UPDATE ON `employee_personal_record2`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
OLD.ID,CONCAT('FullName=',OLD.FirstName,OLD.MiddelName,OLD.LastName,' ',
'Date_Birth=',OLD.Date_Birth,' ',
'Place_Birth=',OLD.Place_Birth,' ',
'Age=',OLD.Age,' ',
'Sex=',OLD.Sex,' ',
'Telephone=',OLD.Telephone,' ',
'Email=',OLD.Email,' ',
'Date_Employement=',OLD.Date_Employement,' ',
'Department=',OLD.Department,' ',
'Position=',OLD.Position,' ',
'Educational_Status=',OLD.Educational_Status,' ',
'Salary=',OLD.Salary,' ',
'Martial_Status',OLD.Martial_Status,' ',OLD.Spouse_Name,' ',
'Children_number=',OLD.Children_number,' ',
'Childern Detail=',OLD.Name_Child,' ',OLD.Date_Birth_Child,' ',OLD.Age_Child,' ',OLD.Sex_Child,' '
'Contact_Emergency=',OLD.Contact_Emergency,' ',OLD.Contact_Relation,' ',
'Photo=',OLD.Photo,' ',
'Experience',OLD.Experience,' ',
'HardCopy_Shelf_No=',OLD.HardCopy_Shelf_No),
OLD.ModifiedBy,TIMESTAMP(NOW()),"Employeen Personal Record",'BEFORE UPDATE');



INSERT INTO employee_Record_log VALUES(
NEW.ID,CONCAT('FullName=',NEW.FirstName,' ',NEW.MiddelName,' ',NEW.LastName,'  ',
'Date_Birth=',NEW.Date_Birth,' ',
'Place_Birth=',NEW.Place_Birth,' ',
'Age=',NEW.Age,' ',
'Sex=',NEW.Sex,' ',
'Telephone=',NEW.Telephone,' ',
'Email=',NEW.Email,' ',
'Date_Employement=',NEW.Date_Employement,' ',
'Department=',NEW.Department,' ',
'Position=',NEW.Position,' ',
'Educational_Status=',NEW.Educational_Status,' ',
'Salary=',NEW.Salary,' ',
'Martial_Status',NEW.Martial_Status,' ',NEW.Spouse_Name,' ',
'Children_number=',NEW.Children_number,' ',
'Childern Detail=',NEW.Name_Child,' ',NEW.Date_Birth_Child,' ',NEW.Age_Child,' ',NEW.Sex_Child,' ',
'Contact_Emergency=',NEW.Contact_Emergency,' ',NEW.Contact_Relation,' ',
'Photo=',NEW.Photo,' ',
'Experience',NEW.Experience,' ',
'HardCopy_Shelf_No=',NEW.HardCopy_Shelf_No),
NEW.ModifiedBy,TIMESTAMP(NOW()),"Employeen Personal Record",'AFTER UPDATE');


END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record 11-12and28-29`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record 11-12and28-29` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1428 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record 11-13`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record 11-13` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1613 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record line 11-12`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record line 11-12` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2195 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_3_7_2017`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_3_7_2017` (
  `Auto_ID` int(11) NOT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Pension_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contract_Session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` double DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(11) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LU_Member` tinyint(4) NOT NULL DEFAULT '0',
  `Employment_Status` tinyint(4) NOT NULL DEFAULT '1',
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_am`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_am` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(22) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_am_aw`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_am_aw` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(22) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_am_zr`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_am_zr` (
  `ID` varchar(8) DEFAULT NULL,
  `FirstName` varchar(22) DEFAULT NULL,
  `MiddelName` varchar(22) DEFAULT NULL,
  `LastName` varchar(24) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_aq`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_aq` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1715 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_audit`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_audit` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date NOT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) NOT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date NOT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) NOT NULL,
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob NOT NULL,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Changed_ON` datetime NOT NULL,
  `Action` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_aw`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_aw` (
  `Auto_ID` int(11) NOT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Pension_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nick_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TIN` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Date_Birth` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub_City` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Kebele` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `House_No` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Mobile_Telephone_No` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Office_Telephone_No` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contract_Session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` double DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(11) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LU_Member` tinyint(4) NOT NULL DEFAULT '0',
  `Employment_Status` tinyint(4) NOT NULL DEFAULT '1',
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_blen`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_blen` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure _Place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` float DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=489 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_new`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_new` (
  `Auto_ID` int(4) DEFAULT NULL,
  `ID` varchar(11) DEFAULT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `MiddelName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `Date_Birth` varchar(12) DEFAULT NULL,
  `Place_Birth` varchar(13) DEFAULT NULL,
  `Age` int(4) DEFAULT NULL,
  `Sex` varchar(6) DEFAULT NULL,
  `departure_place` varchar(2) DEFAULT NULL,
  `Telephone` varchar(18) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Date_Employement` varchar(10) DEFAULT NULL,
  `Term_Employment` varchar(10) DEFAULT NULL,
  `Contract_Session` varchar(14) DEFAULT NULL,
  `Department` varchar(33) DEFAULT NULL,
  `Group` varchar(4) DEFAULT NULL,
  `Position` varchar(61) DEFAULT NULL,
  `Educational_Status` varchar(39) DEFAULT NULL,
  `Salary` int(5) DEFAULT NULL,
  `Martial_Status` varchar(8) DEFAULT NULL,
  `Spouse_Name` varchar(30) DEFAULT NULL,
  `Children_number` int(1) DEFAULT NULL,
  `Name_Child` varchar(117) DEFAULT NULL,
  `Date_Birth_Child` varchar(67) DEFAULT NULL,
  `Age_Child` varchar(24) DEFAULT NULL,
  `Sex_Child` varchar(18) DEFAULT NULL,
  `Contact_Emergency` varchar(33) DEFAULT NULL,
  `Contact_Relation` varchar(25) DEFAULT NULL,
  `Contact_Address` varchar(18) DEFAULT NULL,
  `Photo` varchar(10) DEFAULT NULL,
  `Image` varchar(10) DEFAULT NULL,
  `Experience` varchar(10) DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(43) DEFAULT NULL,
  `ModifiedBy` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_rf`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_rf` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1256 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_rf_03_01_2013`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_rf_03_01_2013` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contract_Session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2699 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_sher 11`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_sher 11` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=651 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_tulu`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_tulu` (
  `Auto_ID` varchar(10) DEFAULT NULL,
  `ID` varchar(10) DEFAULT NULL,
  `FirstName` varchar(21) DEFAULT NULL,
  `MiddelName` varchar(11) DEFAULT NULL,
  `LastName` varchar(10) DEFAULT NULL,
  `Date_Birth` varchar(10) DEFAULT NULL,
  `Place_Birth` varchar(10) DEFAULT NULL,
  `Age` varchar(10) DEFAULT NULL,
  `Sex` varchar(10) DEFAULT NULL,
  `Telephone` varchar(10) DEFAULT NULL,
  `Email` varchar(10) DEFAULT NULL,
  `Date_Employement` varchar(11) DEFAULT NULL,
  `Department` varchar(36) DEFAULT NULL,
  `Group` varchar(10) DEFAULT NULL,
  `Position` varchar(10) DEFAULT NULL,
  `Educational_Status` varchar(10) DEFAULT NULL,
  `Salary` varchar(10) DEFAULT NULL,
  `Martial_Status` varchar(10) DEFAULT NULL,
  `Spouse_Name` varchar(10) DEFAULT NULL,
  `Children_number` varchar(10) DEFAULT NULL,
  `Name_Child` varchar(10) DEFAULT NULL,
  `Date_Birth_Child` varchar(10) DEFAULT NULL,
  `Age_Child` varchar(10) DEFAULT NULL,
  `Sex_Child` varchar(10) DEFAULT NULL,
  `Contact_Emergency` varchar(10) DEFAULT NULL,
  `Contact_Relation` varchar(10) DEFAULT NULL,
  `Contact_Address` varchar(10) DEFAULT NULL,
  `Photo` varchar(10) DEFAULT NULL,
  `Image` varchar(10) DEFAULT NULL,
  `Experience` varchar(10) DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(10) DEFAULT NULL,
  `ModifiedBy` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_record_zr`
--

CREATE TABLE IF NOT EXISTS `employee_personal_record_zr` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Contract_Session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` double NOT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Department`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `employee_personal_record_Department` (`Department`),
  KEY `Salary` (`Salary`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1270 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_promotion`
--

CREATE TABLE IF NOT EXISTS `employee_promotion` (
  `Auto_ID` int(11) NOT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Evaluation_Result` float DEFAULT NULL,
  `Position_Before_Promotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_After_Promotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Before_Promotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_After_Promotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary_Before_Promotion` int(11) NOT NULL,
  `Salary_After_Promotion` int(11) NOT NULL,
  `Promotion_Date` date NOT NULL,
  PRIMARY KEY (`ID`,`Promotion_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_record_log`
--

CREATE TABLE IF NOT EXISTS `employee_record_log` (
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` longtext COLLATE utf8_unicode_ci,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Time` datetime DEFAULT NULL,
  `TableName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Action` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_report_to`
--

CREATE TABLE IF NOT EXISTS `employee_report_to` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Supervisor_ID',
  `Subordinate_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Reporting_Mode` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`Subordinate_ID`,`Reporting_Mode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_skills`
--

CREATE TABLE IF NOT EXISTS `employee_skills` (
  `ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Skill_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Experience_Year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Comments` text CHARACTER SET utf16 COLLATE utf16_unicode_ci,
  PRIMARY KEY (`ID`,`Skill_ID`),
  KEY `emp_number` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_status_transaction`
--

CREATE TABLE IF NOT EXISTS `employee_status_transaction` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Evaluation_Result` float DEFAULT NULL,
  `Position_Before` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_After` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Before` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_After` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary_Before` double NOT NULL,
  `Salary_After` double NOT NULL,
  `Transaction_Date` date NOT NULL,
  `Transaction_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`Transaction_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_suspension`
--

CREATE TABLE IF NOT EXISTS `employee_suspension` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SuspendedDays` int(5) NOT NULL,
  `RestDays` int(11) NOT NULL,
  `Suspended_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Suspended_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_work_experience`
--

CREATE TABLE IF NOT EXISTS `employee_work_experience` (
  `ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Employer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Job_Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Salary` double(10,2) DEFAULT NULL,
  `Comments` text COLLATE utf8_unicode_ci,
  `From_Date` datetime DEFAULT NULL,
  `To_Date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`,`Employer`,`Job_Title`),
  KEY `emp_number` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employment_status_settings`
--

CREATE TABLE IF NOT EXISTS `employment_status_settings` (
  `Status_ID` int(11) NOT NULL DEFAULT '0',
  `Status_Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Status_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_handover`
--

CREATE TABLE IF NOT EXISTS `equipment_handover` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Equipment_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Taken_Date` date NOT NULL,
  `Replacement_Date` date NOT NULL,
  `Returned_Date` date DEFAULT NULL,
  `Returned` varchar(7) COLLATE utf8_unicode_ci DEFAULT 'NO',
  PRIMARY KEY (`ID`,`Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_list`
--

CREATE TABLE IF NOT EXISTS `equipment_list` (
  `Equipment_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Permited_Department` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`Equipment_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_definition`
--

CREATE TABLE IF NOT EXISTS `evaluation_definition` (
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `From_Grade` double(10,2) NOT NULL DEFAULT '0.00',
  `To_Grade` double(10,2) NOT NULL,
  `Allowance` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`Department`,`From_Grade`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expired_disciplinary_action`
--

CREATE TABLE IF NOT EXISTS `expired_disciplinary_action` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Verbal_Warning` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Inistance` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Second_Inistance` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Third_Inistance` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Last_Warning` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `First_Inistance_Date` date DEFAULT NULL,
  `Verbal_Warning_Date` date DEFAULT NULL,
  `Second_Inistance_Date` date DEFAULT NULL,
  `Third_Inistance_Date` date DEFAULT NULL,
  `Last_Warning_Date` date DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `factory_master`
--

CREATE TABLE IF NOT EXISTS `factory_master` (
  `FactoryId` int(11) NOT NULL AUTO_INCREMENT,
  `FactoryName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`FactoryId`),
  KEY `FactoryName` (`FactoryName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `factory_output`
--

CREATE TABLE IF NOT EXISTS `factory_output` (
  `FactoryID` int(11) DEFAULT '0',
  `DatePro` datetime DEFAULT NULL,
  `Quantity` double DEFAULT NULL,
  KEY `FactoryID` (`FactoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `funeral_leave`
--

CREATE TABLE IF NOT EXISTS `funeral_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FuneralLeaveDays` int(3) NOT NULL,
  `RestDay` int(7) DEFAULT NULL,
  `FuneralLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Funeral Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`FuneralLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=203 ;

--
-- Triggers `funeral_leave`
--
DROP TRIGGER IF EXISTS `FuneralLeave_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `FuneralLeave_INSERT_Trigger` AFTER INSERT ON `funeral_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.FuneralLeaveDays,
NEW.RestDay,NEW.FuneralLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `FuneralLeave_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `FuneralLeave_Update_Trigger` AFTER UPDATE ON `funeral_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.FuneralLeaveDays,
OLD.RestDay,OLD.FuneralLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'BEFORE UPDATE');

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.FuneralLeaveDays,
NEW.RestDay,NEW.FuneralLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'AFTER UPDATE');


 END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `FuneralLeave_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `FuneralLeave_Delete_Trigger` AFTER DELETE ON `funeral_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.FuneralLeaveDays,
OLD.RestDay,OLD.FuneralLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `header_notification_definition`
--

CREATE TABLE IF NOT EXISTS `header_notification_definition` (
  `Notification_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Sql` text COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Message` text COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Discription` text COLLATE utf8_unicode_ci NOT NULL,
  `Show_Chart` tinyint(4) NOT NULL,
  `Chart_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Detail_Sql` text COLLATE utf8_unicode_ci,
  `Show_Notification` tinyint(4) NOT NULL,
  `Show_Notification_PayrollSystem` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Notification_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `header_notification_definition_new`
--

CREATE TABLE IF NOT EXISTS `header_notification_definition_new` (
  `User_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_ID` int(11) NOT NULL,
  `Show_Notification_HRMS` tinyint(1) NOT NULL DEFAULT '0',
  `Show_Chart_HRMS` tinyint(1) NOT NULL DEFAULT '0',
  `Show_Notification_Payroll_System` tinyint(1) NOT NULL DEFAULT '0',
  `Show_Chart_Payroll_System` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_Name`,`Notification_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_care_insurance`
--

CREATE TABLE IF NOT EXISTS `health_care_insurance` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Referral_Case` text COLLATE utf8_unicode_ci,
  `Treatment_Cost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Refferal_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Refferal_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`),
  KEY `Department_2` (`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=289 ;

-- --------------------------------------------------------

--
-- Table structure for table `health_care_insurance_definition`
--

CREATE TABLE IF NOT EXISTS `health_care_insurance_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `From_Basic_Salary` double NOT NULL,
  `To_Basic_Salary` double NOT NULL,
  `Insurance_Amount` double NOT NULL,
  `Amount_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `holyday_definition`
--

CREATE TABLE IF NOT EXISTS `holyday_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Holyday_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_title`
--

CREATE TABLE IF NOT EXISTS `job_title` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Job_Title_Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Salary_Min` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Salary_Max` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Job_Description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Job_Title_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jv_account`
--

CREATE TABLE IF NOT EXISTS `jv_account` (
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Display_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Account_No` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jv_account_definition`
--

CREATE TABLE IF NOT EXISTS `jv_account_definition` (
  `Account_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Account_Code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Account_Display_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Account_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Department` text COLLATE utf8_unicode_ci NOT NULL,
  `PayrollOutput_Field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Payment_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Account_Name`,`Account_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jv_account_definition_21_09_2014`
--

CREATE TABLE IF NOT EXISTS `jv_account_definition_21_09_2014` (
  `Account_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Account_Code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Account_Display_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Account_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Department` text COLLATE utf8_unicode_ci NOT NULL,
  `PayrollOutput_Field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Payment_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Account_Name`,`Account_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `lang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language_definition`
--

CREATE TABLE IF NOT EXISTS `language_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `textid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `en` longtext COLLATE utf8_unicode_ci,
  `am` longtext COLLATE utf8_unicode_ci,
  `or` longtext COLLATE utf8_unicode_ci,
  `nl` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`textid`),
  UNIQUE KEY `textid` (`textid`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=307 ;

-- --------------------------------------------------------

--
-- Table structure for table `lang_am`
--

CREATE TABLE IF NOT EXISTS `lang_am` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `textid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`Auto_ID`),
  UNIQUE KEY `textid` (`textid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=232 ;

-- --------------------------------------------------------

--
-- Table structure for table `lang_en`
--

CREATE TABLE IF NOT EXISTS `lang_en` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `textid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`Auto_ID`),
  UNIQUE KEY `textid` (`textid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=231 ;

-- --------------------------------------------------------

--
-- Table structure for table `lang_nl`
--

CREATE TABLE IF NOT EXISTS `lang_nl` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `textid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`Auto_ID`),
  UNIQUE KEY `textid` (`textid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=231 ;

-- --------------------------------------------------------

--
-- Table structure for table `lang_or`
--

CREATE TABLE IF NOT EXISTS `lang_or` (
  `Auto_ID` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `textid` varchar(42) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` varchar(38) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `late_tolerance_definition`
--

CREATE TABLE IF NOT EXISTS `late_tolerance_definition` (
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Day_Name` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ALL',
  `After_Start` time NOT NULL,
  `Before_Start_Break` time NOT NULL,
  `After_End_Break` time NOT NULL,
  `Before_End` time NOT NULL,
  `Definition_Type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Department`,`From_Date`,`Day_Name`,`Definition_Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `late_tolerance_setting`
--

CREATE TABLE IF NOT EXISTS `late_tolerance_setting` (
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `After_Start` time NOT NULL,
  `Before_Start_Break` time NOT NULL,
  `After_End_Break` time NOT NULL,
  `Before_End` time NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Department`,`From_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `late_tolerance_setting_individual`
--

CREATE TABLE IF NOT EXISTS `late_tolerance_setting_individual` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Before_Start` time DEFAULT NULL,
  `After_Start` time DEFAULT NULL,
  `Before_Start_Break` time DEFAULT NULL,
  `After_Start_Break` time DEFAULT NULL,
  `Before_End_Break` time DEFAULT NULL,
  `After_End_Break` time DEFAULT NULL,
  `Before_End` time DEFAULT NULL,
  `After_End` time DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_allocation`
--

CREATE TABLE IF NOT EXISTS `leave_allocation` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Sick Leave',
  `Jan` double DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_log`
--

CREATE TABLE IF NOT EXISTS `leave_log` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Leavedays` int(4) NOT NULL,
  `RestDay` int(4) DEFAULT '0',
  `Leave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `Time` datetime NOT NULL,
  `Action` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_settings`
--

CREATE TABLE IF NOT EXISTS `leave_settings` (
  `Leave_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Leave_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Allowed_Leave_Grant_Days` int(11) NOT NULL,
  `Popup_Notify` tinyint(4) DEFAULT NULL,
  `Menu_Caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Leave_Type_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Leave_ID`,`Leave_Type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_settings_28_5_2017`
--

CREATE TABLE IF NOT EXISTS `leave_settings_28_5_2017` (
  `Leave_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Allowed_Leave_Grant_Days` int(11) NOT NULL,
  `Popup_Notify` tinyint(4) DEFAULT NULL,
  `Menu_Caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Leave_Type_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Leave_Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letter`
--

CREATE TABLE IF NOT EXISTS `letter` (
  `Completion_Probation_Period` text COLLATE utf8_unicode_ci,
  `Permanent_Employment_Contract` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `User_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Privilage` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`User_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manpower_plan`
--

CREATE TABLE IF NOT EXISTS `manpower_plan` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Number_Employee` int(11) NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Department`,`Position`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `manual_attendance_summary`
--

CREATE TABLE IF NOT EXISTS `manual_attendance_summary` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Working_Day` double(10,2) DEFAULT NULL,
  `Leave_Day` double(10,2) DEFAULT NULL,
  `Leave_Type_Days` text COLLATE utf8_unicode_ci NOT NULL,
  `Sick_Leave_Day` double(10,2) NOT NULL,
  `Special_Leave_Day_With_Payment` double(10,2) NOT NULL,
  `Special_Leave_Day_WithOut_Payment` double(10,2) NOT NULL,
  `Absent_Day` double(10,2) DEFAULT NULL,
  `Off_Day` double(10,2) NOT NULL,
  `No_Off_Day_OT` double(10,2) NOT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Month_Year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Confirm` tinyint(4) NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_attendance_summaryold`
--

CREATE TABLE IF NOT EXISTS `manual_attendance_summaryold` (
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `IDNO` bigint(15) unsigned NOT NULL DEFAULT '0',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Absent_Hour` decimal(18,1) DEFAULT NULL,
  `Total_Absent_Day` decimal(18,1) DEFAULT NULL,
  `Working_Day` decimal(28,1) DEFAULT NULL,
  `Total_Leave_Days` decimal(25,0) DEFAULT NULL,
  `Total_Off_Days` int(1) NOT NULL DEFAULT '0',
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Month_Year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `manual_attendance_totalleavedays`
--
CREATE TABLE IF NOT EXISTS `manual_attendance_totalleavedays` (
`ID` varchar(15)
,`MONTH` int(2)
,`YEAR` int(4)
,`ReportOn_MONTH` int(2)
,`ReportOn_YEAR` int(4)
,`LeaveType` varchar(255)
,`NoMonth` int(3)
,`TotalLeaveDays` double(19,2)
);
-- --------------------------------------------------------

--
-- Table structure for table `maternity_leave`
--

CREATE TABLE IF NOT EXISTS `maternity_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaternityLeaveDays` int(3) NOT NULL DEFAULT '90',
  `MaternityLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Maternity Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`MaternityLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

--
-- Triggers `maternity_leave`
--
DROP TRIGGER IF EXISTS `MaternityLeave_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `MaternityLeave_INSERT_Trigger` AFTER INSERT ON `maternity_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.MaternityLeaveDays,
0,NEW.MaternityLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `MaternityLeave_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `MaternityLeave_Update_Trigger` AFTER UPDATE ON `maternity_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.MaternityLeaveDays,
0,OLD.MaternityLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'BEFORE UPDATE');

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.MaternityLeaveDays,
0,NEW.MaternityLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'AFTER UPDATE');


 END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `MaternityLeave_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `MaternityLeave_Delete_Trigger` AFTER DELETE ON `maternity_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.MaternityLeaveDays,
0,OLD.MaternityLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `medical_referral`
--

CREATE TABLE IF NOT EXISTS `medical_referral` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Referral_Case` text COLLATE utf8_unicode_ci,
  `Treatment_Cost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Refferal_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Refferal_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`),
  KEY `Department_2` (`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=385 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `Message_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Message` text COLLATE utf8_unicode_ci NOT NULL,
  `From_User_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `To_User_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Message_Time` int(11) NOT NULL,
  `Message_Status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-Unread,1-Read,2-Sent,3-Darft,4-Trash',
  PRIMARY KEY (`Message_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=455 ;

-- --------------------------------------------------------

--
-- Table structure for table `new_salary`
--

CREATE TABLE IF NOT EXISTS `new_salary` (
  `ID` varchar(8) DEFAULT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `New_Position` varchar(61) DEFAULT NULL,
  `New_Salary` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_definition`
--

CREATE TABLE IF NOT EXISTS `notification_definition` (
  `Notification_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Sql` text COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Message` text COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Discription` text COLLATE utf8_unicode_ci NOT NULL,
  `Show_Chart` tinyint(4) NOT NULL,
  `Chart_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Detail_Sql` text COLLATE utf8_unicode_ci,
  `Show_Notification` tinyint(4) NOT NULL,
  PRIMARY KEY (`Notification_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE IF NOT EXISTS `notification_settings` (
  `Notification_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Notification_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Sql` text COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Message` text COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Discription` text COLLATE utf8_unicode_ci NOT NULL,
  `Chart_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Detail_Sql` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`Notification_Name`),
  UNIQUE KEY `Notification_ID_2` (`Notification_ID`),
  KEY `Notification_ID` (`Notification_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings_24_10_2017`
--

CREATE TABLE IF NOT EXISTS `notification_settings_24_10_2017` (
  `Notification_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Sql` text COLLATE utf8_unicode_ci NOT NULL,
  `Message` text COLLATE utf8_unicode_ci NOT NULL,
  `Notification_Discription` text COLLATE utf8_unicode_ci NOT NULL,
  `Show_Chart` tinyint(4) NOT NULL,
  `Chart_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Detail_Sql` text COLLATE utf8_unicode_ci,
  `Show_Notification` tinyint(4) NOT NULL,
  PRIMARY KEY (`Notification_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oldtotal_attendance_permanent`
--

CREATE TABLE IF NOT EXISTS `oldtotal_attendance_permanent` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_No_Absent` decimal(7,2) DEFAULT '0.00',
  `Total_No_Normal1` decimal(7,2) DEFAULT '0.00',
  `Total_No_Normal2` decimal(7,2) DEFAULT '0.00',
  `Total_No_Sunday` decimal(7,2) DEFAULT '0.00',
  `Total_No_Holyday` decimal(7,2) DEFAULT '0.00',
  PRIMARY KEY (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `oldtotal_deduction_contractual`
--

CREATE TABLE IF NOT EXISTS `oldtotal_deduction_contractual` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Daily_Payment` double DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `Total_Holyday` int(2) DEFAULT '0',
  KEY `ID` (`Auto_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1031 ;

-- --------------------------------------------------------

--
-- Table structure for table `oldtotal_deduction_permanent`
--

CREATE TABLE IF NOT EXISTS `oldtotal_deduction_permanent` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic salary` double DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `Total_Holyday` int(2) DEFAULT '0',
  KEY `ID` (`Auto_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=108 ;

-- --------------------------------------------------------

--
-- Table structure for table `old_slaary`
--

CREATE TABLE IF NOT EXISTS `old_slaary` (
  `ID` varchar(11) DEFAULT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `Salary` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ot_auto_definition`
--

CREATE TABLE IF NOT EXISTS `ot_auto_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `OT_MINHR` time NOT NULL,
  `NightOT_Start` time NOT NULL,
  `Definition_Type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Department`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ot_definition`
--

CREATE TABLE IF NOT EXISTS `ot_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Day_Name` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ALL',
  `DayOT` varchar(5) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_MaxHR` time NOT NULL,
  `NightOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `NightOT_MaxHR` time NOT NULL,
  `DayOT_Start` time NOT NULL,
  `NightOT_Start` time NOT NULL,
  `NightOT_End` time NOT NULL,
  `Definition_Type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Department`,`From_Date`,`Day_Name`,`Definition_Type`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `ot_definition2`
--

CREATE TABLE IF NOT EXISTS `ot_definition2` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `DayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `NightOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `SundayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `HolydayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  PRIMARY KEY (`ID`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ot_definition_department`
--

CREATE TABLE IF NOT EXISTS `ot_definition_department` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `DayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_MaxHR` time NOT NULL,
  `NightOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `NightOT_MaxHR` time NOT NULL,
  `SundayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `HolydayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_Start` time NOT NULL,
  `NightOT_Start` time NOT NULL,
  `NightOT_End` time NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Department`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=112084 ;

-- --------------------------------------------------------

--
-- Table structure for table `ot_definition_department2`
--

CREATE TABLE IF NOT EXISTS `ot_definition_department2` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `DayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_MaxHR` time NOT NULL,
  `NightOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `NightOT_MaxHR` time NOT NULL,
  `SundayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `HolydayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_Start` time NOT NULL,
  `NightOT_Start` time NOT NULL,
  `NightOT_End` time NOT NULL,
  PRIMARY KEY (`Department`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=232 ;

-- --------------------------------------------------------

--
-- Table structure for table `ot_definition_department20-09-2012`
--

CREATE TABLE IF NOT EXISTS `ot_definition_department20-09-2012` (
  `Auto_ID` int(11) DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `DayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_MaxHR` time NOT NULL,
  `NightOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `NightOT_MaxHR` time NOT NULL,
  `SundayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `HolydayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_Start` time NOT NULL,
  `NightOT_Start` time NOT NULL,
  `NightOT_End` time NOT NULL,
  PRIMARY KEY (`Department`,`From_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ot_definition_departmentold`
--

CREATE TABLE IF NOT EXISTS `ot_definition_departmentold` (
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `DayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `NightOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `SundayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `HolydayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ot_definition_individual`
--

CREATE TABLE IF NOT EXISTS `ot_definition_individual` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `DayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_MaxHR` time NOT NULL,
  `NightOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `NightOT_MaxHR` time NOT NULL,
  `SundayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `HolydayOT` varchar(1) COLLATE utf8_unicode_ci DEFAULT ' ',
  `DayOT_Start` time NOT NULL,
  `NightOT_Start` time NOT NULL,
  `NightOT_End` time NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14453 ;

-- --------------------------------------------------------

--
-- Table structure for table `ot_definiton_department`
--

CREATE TABLE IF NOT EXISTS `ot_definiton_department` (
  `Auto_ID` varchar(1) DEFAULT NULL,
  `Department` varchar(38) DEFAULT NULL,
  `From_Date` int(5) DEFAULT NULL,
  `To_Date` int(5) DEFAULT NULL,
  `DayOT` varchar(1) DEFAULT NULL,
  `DayOT_MaxHR` decimal(21,4) DEFAULT NULL,
  `NightOT` varchar(10) DEFAULT NULL,
  `NightOT_MaxHR` varchar(8) DEFAULT NULL,
  `SundayOT` varchar(10) DEFAULT NULL,
  `HolydayOT` varchar(10) DEFAULT NULL,
  `DayOT_Start` varchar(30) DEFAULT NULL,
  `NightOT_Start` varchar(8) DEFAULT NULL,
  `NightOT_End` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paternity_leave`
--

CREATE TABLE IF NOT EXISTS `paternity_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PaternityLeaveDays` int(3) NOT NULL DEFAULT '90',
  `PaternityLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Paternity Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`PaternityLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Triggers `paternity_leave`
--
DROP TRIGGER IF EXISTS `PaternityLeave_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `PaternityLeave_INSERT_Trigger` AFTER INSERT ON `paternity_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.PaternityLeaveDays,
0,NEW.PaternityLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `PaternityLeave_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `PaternityLeave_Update_Trigger` AFTER UPDATE ON `paternity_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.PaternityLeaveDays,
0,OLD.PaternityLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'BEFORE UPDATE');

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.PaternityLeaveDays,
0,NEW.PaternityLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'AFTER UPDATE');


 END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `PaternityLeave_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `PaternityLeave_Delete_Trigger` AFTER DELETE ON `paternity_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.PaternityLeaveDays,
0,OLD.PaternityLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_data`
--

CREATE TABLE IF NOT EXISTS `payroll_data` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Payroll ID` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `First Name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Middel Name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Last Name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Basic salary` double DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `Transport_Allowance` double DEFAULT NULL,
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT '0',
  `CHK_Bonus` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `PF_Amount` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Total_Holydays` int(2) DEFAULT NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_data_entry`
--

CREATE TABLE IF NOT EXISTS `payroll_data_entry` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Payroll ID` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic salary` double DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Holyday` int(2) DEFAULT '0',
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_data_setting`
--

CREATE TABLE IF NOT EXISTS `payroll_data_setting` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Salary` double(10,2) NOT NULL,
  `CHK_LU` varchar(3) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_Pension` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Pledge` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` varchar(3) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Year_Month` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Year_Month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_deduction`
--

CREATE TABLE IF NOT EXISTS `payroll_deduction` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Deduction_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Total_Amount` double NOT NULL,
  `Monthly_Deduction` decimal(16,2) NOT NULL,
  `No_Month` int(11) NOT NULL,
  `Start_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `End_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Payable_Month_List` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(2553) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Deduction_Type`,`Start_Month`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16824 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_deduction_definition`
--

CREATE TABLE IF NOT EXISTS `payroll_deduction_definition` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Deduction_ID` int(11) NOT NULL,
  `Year_Month` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Deduction_Amount` double(10,2) NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Deduction_ID`,`Year_Month`),
  KEY `Deduction_ID` (`Deduction_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_ouput_report_definition_1`
--

CREATE TABLE IF NOT EXISTS `payroll_ouput_report_definition_1` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Report_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Report_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Report_Field` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Report_Field_Display_Name` longtext COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_output_backup`
--

CREATE TABLE IF NOT EXISTS `payroll_output_backup` (
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic salary` double DEFAULT NULL,
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Loan` double DEFAULT NULL,
  `Court Deduction` double DEFAULT NULL,
  `Other Deduction` double DEFAULT NULL,
  `Bonus` double DEFAULT NULL,
  `CHK_Present_Allowance` bigint(21) DEFAULT NULL,
  `Present_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LU_Contribution` int(3) NOT NULL DEFAULT '0',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `PF_Employee` double DEFAULT NULL,
  `PF_Company` double DEFAULT NULL,
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pension 5` double DEFAULT NULL,
  `Pension 12` double DEFAULT NULL,
  `Material` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pledge` int(6) NOT NULL DEFAULT '0',
  `Total_Holyday` int(6) DEFAULT NULL,
  `Total_Absent` decimal(12,2) DEFAULT NULL,
  `Total_Absent_Day` double DEFAULT NULL,
  `Total_Leave_Days` decimal(41,0) DEFAULT NULL,
  `Working_Day` double DEFAULT NULL,
  `Working_Hours` double DEFAULT NULL,
  `Avialable_HR` int(9) DEFAULT NULL,
  `Salary_Per_Hour` double DEFAULT NULL,
  `Working_Day_Payment` double(57,2) DEFAULT NULL,
  `Leave_Day_Payment` double(57,2) DEFAULT NULL,
  `Transport_Allowance` double DEFAULT NULL,
  `Total_No_normal1` decimal(12,2) DEFAULT NULL,
  `Day_OT` double DEFAULT NULL,
  `Total_No_normal2` decimal(12,2) DEFAULT NULL,
  `Night_OT` double DEFAULT NULL,
  `Total_No_Sunday` decimal(12,2) DEFAULT NULL,
  `Sunday_OT` double DEFAULT NULL,
  `Total_No_Holyday` decimal(12,2) DEFAULT NULL,
  `Holyday_OT` double DEFAULT NULL,
  `Total_OT` double DEFAULT NULL,
  `Holyday_Double_Payment` int(1) DEFAULT NULL,
  `Taxable_Income` double DEFAULT NULL,
  `Income_tax` double(57,2) DEFAULT NULL,
  `Total_Deduction` double(57,2) DEFAULT NULL,
  `PrintLayout` bigint(11) DEFAULT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Net_Pay` double(51,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_output_contractual_backup`
--

CREATE TABLE IF NOT EXISTS `payroll_output_contractual_backup` (
  `ID` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Daily_Payment` double DEFAULT NULL,
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Loan` double DEFAULT NULL,
  `Court Deduction` double DEFAULT NULL,
  `Other Deduction` double DEFAULT NULL,
  `Bonus` double DEFAULT NULL,
  `CHK_Present_Allowance` bigint(21) DEFAULT NULL,
  `Present_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LU_Contribution` int(3) NOT NULL DEFAULT '0',
  `Material` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pledge` int(6) NOT NULL DEFAULT '0',
  `Total_Holyday` int(6) DEFAULT NULL,
  `Total_Absent` decimal(12,2) DEFAULT NULL,
  `Total_Leave_Days` decimal(41,0) DEFAULT NULL,
  `Working_Day` decimal(65,30) DEFAULT NULL,
  `Working_Hours` bigint(63) DEFAULT NULL,
  `Avialable_HR` int(9) DEFAULT NULL,
  `Salary_Per_Hour` double DEFAULT NULL,
  `Working_Day_Payment` double(57,2) DEFAULT NULL,
  `Leave_Day_Payment` double(57,2) DEFAULT NULL,
  `Transport_Allowance` double DEFAULT NULL,
  `Total_No_normal1` decimal(12,2) DEFAULT NULL,
  `Day_OT` double DEFAULT NULL,
  `Total_No_normal2` decimal(12,2) DEFAULT NULL,
  `Night_OT` double DEFAULT NULL,
  `Total_No_Sunday` decimal(12,2) DEFAULT NULL,
  `Sunday_OT` double DEFAULT NULL,
  `Total_No_Holyday` decimal(12,2) DEFAULT NULL,
  `Holyday_OT` double DEFAULT NULL,
  `Total_OT` double DEFAULT NULL,
  `Holyday_Double_Payment` int(1) DEFAULT NULL,
  `Taxable_Income` double DEFAULT NULL,
  `Income_tax` double(57,2) DEFAULT NULL,
  `total_deduction` double(57,2) DEFAULT NULL,
  `PrintLayout` bigint(11) DEFAULT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Net_Pay` double(51,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_output_data_t`
--

CREATE TABLE IF NOT EXISTS `payroll_output_data_t` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `IDNO` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pension_ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic_salary` double(10,2) DEFAULT NULL,
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub_Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Year_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Record_Per_Page` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Hardship_Allowance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Housing_Allowance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Loan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LU_Loan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Court_Order_Deduction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cloth_and_Shoe_Deduction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fine_Deduction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bicycle_Deduction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Cost_Sharing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Other_Deduction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Annual_Leave_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Field_Work_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Funeral_Leave_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Maternity_Leave_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Paternity_Leave_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Sick_Leave_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Special_Leave_With_Out_Payment_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Special_Leave_With_Payment_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Wedding_Leave_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Absent_Day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Leave_Days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_Day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_Hours` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bonus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LU_Member` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LU_Contribution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pension_7` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pension_11` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pension_18` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Avialable_HR` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary_Per_Hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary_Per_Day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Absent_Day_Payment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Working_Day_Payment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Leave_Day_Payment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Present_Allowance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `No_Bunch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bunching_Payment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Transport_Allowance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_DayOT_Hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Day_OT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_NightOT_Hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Night_OT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_No_Offday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Offday_OT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_No_Holyday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Holyday_OT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_OT_Hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_OT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salary_analysis` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Taxable_Income` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Non_Taxable_Income` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Income_tax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Deduction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Net_Pay` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Year_Month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_output_print_layout`
--

CREATE TABLE IF NOT EXISTS `payroll_output_print_layout` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Record_Per_Page` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_output_report_definition`
--

CREATE TABLE IF NOT EXISTS `payroll_output_report_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Report_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Report_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Report_Field` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Report_Field_Display_Name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Where_Clause` text COLLATE utf8_unicode_ci NOT NULL,
  `Sub_Query` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`Report_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `pension`
--

CREATE TABLE IF NOT EXISTS `pension` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Year_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Pensionable` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`Year_Month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `popup_notification_definition`
--

CREATE TABLE IF NOT EXISTS `popup_notification_definition` (
  `User_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notification_ID` int(11) NOT NULL,
  `Show_Notification_HRMS` tinyint(1) NOT NULL DEFAULT '0',
  `Show_Notification_Payroll_System` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_Name`,`Notification_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `print_layout`
--

CREATE TABLE IF NOT EXISTS `print_layout` (
  `PrintLayout_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PrintLayout_Payroll ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PrintLayout_F_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PrintLayout_L_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PrintLayout` int(11) DEFAULT NULL,
  PRIMARY KEY (`PrintLayout_Payroll ID`),
  KEY `Payroll ID` (`PrintLayout_Payroll ID`),
  KEY `ID` (`PrintLayout_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `probation_evalutaion`
--

CREATE TABLE IF NOT EXISTS `probation_evalutaion` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date NOT NULL,
  `Attendance` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Motivation` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Performance_Individual` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Performance_Group` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Communication_Supervisor` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Manger_Remark` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HR_Opinon` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Result` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'Passed',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `production_account`
--

CREATE TABLE IF NOT EXISTS `production_account` (
  `Account_Name` varchar(255) NOT NULL,
  `Account_Description` text NOT NULL,
  `Account_Group` varchar(255) NOT NULL,
  `Department` text NOT NULL,
  `Account_Area` double NOT NULL,
  PRIMARY KEY (`Account_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_unit`
--

CREATE TABLE IF NOT EXISTS `production_unit` (
  `Unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE IF NOT EXISTS `progress` (
  `tm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stage` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruitment`
--

CREATE TABLE IF NOT EXISTS `recruitment` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Employer` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Place` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Age` double DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT 'Male',
  `departure_place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'default_profile.png',
  `Date` date DEFAULT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` double NOT NULL,
  `Transport_Allowance` double NOT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `Housing_Allowance` double NOT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Present_Allowance` double DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Triggers `recruitment`
--
DROP TRIGGER IF EXISTS `Recruitment_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `Recruitment_INSERT_Trigger` AFTER INSERT ON `recruitment`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
NEW.ID,CONCAT_WS('  ','Employer:',NEW.Employer,' ',NEW.Place,
'Full Name:',NEW.FirstName,' ',NEW.MiddelName,' ',NEW.LastName,
'Date_Birth:',NEW.Date_Birth,'Age:',NEW.Age,'Sex:',NEW.Sex,'Photo:',NEW.Photo,
'Date:',NEW.Date,'Address:',NEW.Address,
'Department:',NEW.Department,'Position:',NEW.Position,
'Salary:',NEW.Salary,'Transport_Allowance:',NEW.Transport_Allowance,'Hardship_Allowance:',NEW.Hardship_Allowance,
'Housing_Allowance:',NEW.Housing_Allowance,
'Position_Allowance:',NEW.Position_Allowance,'Present_Allowance:',NEW.Present_Allowance),
NEW.ModifiedBy,TIMESTAMP(NOW()),"Recruitment",'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Recruitment_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `Recruitment_Update_Trigger` AFTER UPDATE ON `recruitment`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
OLD.ID,CONCAT_WS('  ','Employer:',OLD.Employer,' ',OLD.Place,
'Full Name:',OLD.FirstName,' ',OLD.MiddelName,' ',OLD.LastName,
'Date_Birth:',OLD.Date_Birth,'Age:',OLD.Age,'Sex:',OLD.Sex,'Photo:',OLD.Photo,
'Date:',OLD.Date,'Address:',OLD.Address,
'Department:',OLD.Department,'Position:',OLD.Position,
'Salary:',OLD.Salary,'Transport_Allowance:',OLD.Transport_Allowance,'Hardship_Allowance:',OLD.Hardship_Allowance,
'Housing_Allowance:',OLD.Housing_Allowance,
'Position_Allowance:',OLD.Position_Allowance,'Present_Allowance:',OLD.Present_Allowance),
OLD.ModifiedBy,TIMESTAMP(NOW()),"Recruitment",'BEFORE UPDATE');



INSERT INTO employee_Record_log VALUES(
NEW.ID,CONCAT_WS('  ','Employer:',NEW.Employer,' ',NEW.Place,
'Full Name:',NEW.FirstName,' ',NEW.MiddelName,' ',NEW.LastName,
'Date_Birth:',NEW.Date_Birth,'Age:',NEW.Age,'Sex:',NEW.Sex,'Photo:',NEW.Photo,
'Date:',NEW.Date,'Address:',NEW.Address,
'Department:',NEW.Department,'Position:',NEW.Position,
'Salary:',NEW.Salary,'Transport_Allowance:',NEW.Transport_Allowance,'Hardship_Allowance:',NEW.Hardship_Allowance,
'Housing_Allowance:',NEW.Housing_Allowance,
'Position_Allowance:',NEW.Position_Allowance,'Present_Allowance:',NEW.Present_Allowance),
NEW.ModifiedBy,TIMESTAMP(NOW()),"Recruitment",'AFTER UPDATE');


END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Recruitment_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `Recruitment_Delete_Trigger` AFTER DELETE ON `recruitment`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
OLD.ID,CONCAT_WS('  ','Employer:',OLD.Employer,' ',OLD.Place,
'Full Name:',OLD.FirstName,' ',OLD.MiddelName,' ',OLD.LastName,
'Date_Birth:',OLD.Date_Birth,'Age:',OLD.Age,'Sex:',OLD.Sex,'Photo:',OLD.Photo,
'Date:',OLD.Date,'Address:',OLD.Address,
'Department:',OLD.Department,'Position:',OLD.Position,
'Salary:',OLD.Salary,'Transport_Allowance:',OLD.Transport_Allowance,'Hardship_Allowance:',OLD.Hardship_Allowance,
'Housing_Allowance:',OLD.Housing_Allowance,
'Position_Allowance:',OLD.Position_Allowance,'Present_Allowance:',OLD.Present_Allowance),
OLD.ModifiedBy,TIMESTAMP(NOW()),"Recruitment",'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `salary_analysis_definition`
--

CREATE TABLE IF NOT EXISTS `salary_analysis_definition` (
  `Group_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Field_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Field_Display_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Field_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Department` text COLLATE utf8_unicode_ci NOT NULL,
  `PayrollOutput_Field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Group_Name`,`Field_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_aq`
--

CREATE TABLE IF NOT EXISTS `salary_aq` (
  `ID` varchar(8) DEFAULT NULL,
  `FirstName` varchar(13) DEFAULT NULL,
  `MiddelName` varchar(13) DEFAULT NULL,
  `LastName` varchar(11) DEFAULT NULL,
  `Salary` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_grade`
--

CREATE TABLE IF NOT EXISTS `salary_grade` (
  `Grade` int(11) NOT NULL,
  `A` double NOT NULL,
  `B` double NOT NULL,
  `C` double NOT NULL,
  `D` double NOT NULL,
  `E` double NOT NULL,
  `F` double NOT NULL,
  `G` double NOT NULL,
  `H` double NOT NULL,
  `I` double NOT NULL,
  `J` double NOT NULL,
  `K` double NOT NULL,
  PRIMARY KEY (`Grade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary_grade_definition`
--

CREATE TABLE IF NOT EXISTS `salary_grade_definition` (
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `From_No_Year` decimal(10,2) NOT NULL DEFAULT '0.00',
  `To_No_Year` double(10,2) NOT NULL,
  `Salary` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`Department`,`From_No_Year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_lu`
--

CREATE TABLE IF NOT EXISTS `salary_lu` (
  `ID` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` double(10,2) DEFAULT NULL,
  `LU_Member` int(1) DEFAULT NULL,
  `Year_Month` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sample_warning_letter`
--

CREATE TABLE IF NOT EXISTS `sample_warning_letter` (
  `Warning_Type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Letter_Content` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sheet2`
--

CREATE TABLE IF NOT EXISTS `sheet2` (
  `ID` varchar(9) DEFAULT NULL,
  `FirstName` varchar(9) DEFAULT NULL,
  `MiddelName` varchar(8) DEFAULT NULL,
  `LastName` varchar(9) DEFAULT NULL,
  `Date_Birth` varchar(10) DEFAULT NULL,
  `Place_Birth` varchar(15) DEFAULT NULL,
  `Age` int(2) DEFAULT NULL,
  `Sex` varchar(6) DEFAULT NULL,
  `Telephone` varchar(11) DEFAULT NULL,
  `Email` varchar(18) DEFAULT NULL,
  `Date_Employement` varchar(10) DEFAULT NULL,
  `L` varchar(24) DEFAULT NULL,
  `Department` varchar(37) DEFAULT NULL,
  `Position` varchar(14) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shortformfielddataname`
--

CREATE TABLE IF NOT EXISTS `shortformfielddataname` (
  `Table_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Field_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Full_Data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Short_Form_Data` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sick_leave`
--

CREATE TABLE IF NOT EXISTS `sick_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SickLeaveDays` int(5) NOT NULL,
  `SickLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Sick Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`SickLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  UNIQUE KEY `Auto_ID_2` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4268 ;

--
-- Triggers `sick_leave`
--
DROP TRIGGER IF EXISTS `SickLeave_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `SickLeave_INSERT_Trigger` AFTER INSERT ON `sick_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.SickLeaveDays,
0,NEW.SickLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `SickLeave_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `SickLeave_Update_Trigger` AFTER UPDATE ON `sick_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.SickLeaveDays,
0,OLD.SickLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'BEFORE UPDATE');

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.SickLeaveDays,
0,NEW.SickLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'AFTER UPDATE');


 END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `SickLeave_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `SickLeave_Delete_Trigger` AFTER DELETE ON `sick_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.SickLeaveDays,
0,OLD.SickLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `skills_settings`
--

CREATE TABLE IF NOT EXISTS `skills_settings` (
  `Skill_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Skill_Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Skill_Description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Skill_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `snapshot_missed_employee`
--

CREATE TABLE IF NOT EXISTS `snapshot_missed_employee` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`,`Date`,`Auto_ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `special_leave`
--

CREATE TABLE IF NOT EXISTS `special_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SpecialLeaveDays` int(3) NOT NULL DEFAULT '90',
  `SpecialLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Special Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`SpecialLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=362 ;

--
-- Triggers `special_leave`
--
DROP TRIGGER IF EXISTS `SpecialLeave_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `SpecialLeave_INSERT_Trigger` AFTER INSERT ON `special_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.SpecialLeaveDays,
0,NEW.SpecialLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `SpecialLeave_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `SpecialLeave_Update_Trigger` AFTER UPDATE ON `special_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.SpecialLeaveDays,
0,OLD.SpecialLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'BEFORE UPDATE');

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.SpecialLeaveDays,
0,NEW.SpecialLeave_Taken_Date,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'AFTER UPDATE');


 END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `SpecialLeave_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `SpecialLeave_Delete_Trigger` AFTER DELETE ON `special_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.SpecialLeaveDays,
0,OLD.SpecialLeave_Taken_Date,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sql`
--

CREATE TABLE IF NOT EXISTS `sql` (
  `Payroll ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `F_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `L_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `G_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic Salary` double DEFAULT NULL,
  `Avialable Days` double DEFAULT NULL,
  `Avialable HR` double DEFAULT NULL,
  `Daily Rate` double DEFAULT NULL,
  `Salary Per Hour` double DEFAULT NULL,
  `Working Days` double DEFAULT NULL,
  `Working Hours` double DEFAULT NULL,
  `Leave Day` double DEFAULT NULL,
  `Working Day Payment` double DEFAULT NULL,
  `Leave Day Payment` double DEFAULT NULL,
  `Normal 1` double DEFAULT NULL,
  `Normal 2` double DEFAULT NULL,
  `Sunday` double DEFAULT NULL,
  `Holyday` double DEFAULT NULL,
  `Total overtime` double DEFAULT NULL,
  `Bonus` double DEFAULT NULL,
  `Taxable Income` double DEFAULT NULL,
  `Income tax` double DEFAULT NULL,
  `Postion allownace` double DEFAULT NULL,
  `Transport allownance` double DEFAULT NULL,
  `Cloth & Shoe` double DEFAULT NULL,
  `Pension 6` double DEFAULT NULL,
  `Loan` double DEFAULT NULL,
  `Labour union contribution` double DEFAULT NULL,
  `Penality` double DEFAULT NULL,
  `Pension 14` double DEFAULT NULL,
  `Other Deduction` double DEFAULT NULL,
  `Total Deduction` double DEFAULT NULL,
  `Net Pay` double DEFAULT NULL,
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Hardship Allowance` double DEFAULT NULL,
  `Court Deduction` double DEFAULT NULL,
  `PrintLayout` int(11) DEFAULT NULL,
  `ID` int(11) DEFAULT NULL,
  `No_Normal 1` double DEFAULT NULL,
  `No_Holydays` double DEFAULT NULL,
  `No_Normal 2` double DEFAULT NULL,
  `No_Sundays` double DEFAULT NULL,
  `Pledge` double DEFAULT NULL,
  `Present_Allowance_Amount` double DEFAULT NULL,
  `PresentAllowanceAmount` double DEFAULT NULL,
  `Present_Allowance` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pledge_Amount` double DEFAULT NULL,
  `NO_Bunch` double DEFAULT NULL,
  `Bunching_Payment` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suspension`
--

CREATE TABLE IF NOT EXISTS `suspension` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SuspendedDays` int(5) NOT NULL,
  `Suspended_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Suspension',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Suspended_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  UNIQUE KEY `Auto_ID_2` (`Auto_ID`),
  KEY `Department` (`Department`),
  KEY `Department_2` (`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `temp_payroll_output_data`
--

CREATE TABLE IF NOT EXISTS `temp_payroll_output_data` (
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDNO` bigint(15) DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddleName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Full_Name` longblob,
  `Date_Employment` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `Basic_Salary` double(19,2) DEFAULT NULL,
  `Section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sub_Section` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Year_Month` varchar(12) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Record_Per_Page` int(11) DEFAULT NULL,
  `Hardship_Allowance` double(19,2) DEFAULT NULL,
  `Housing_Allowance` double(19,2) DEFAULT NULL,
  `Position_Allowance` double(19,2) DEFAULT NULL,
  `Loan` double(19,2) DEFAULT NULL,
  `LU_Loan` double(19,2) DEFAULT NULL,
  `Court_Order_Deduction` double(19,2) DEFAULT NULL,
  `Cloth_and_Shoe_Deduction` double(19,2) DEFAULT NULL,
  `Fine_Deduction` double(19,2) DEFAULT NULL,
  `Bicycle_Deduction` double(19,2) DEFAULT NULL,
  `Educational_Cost_Sharing` double(19,2) DEFAULT NULL,
  `Other_Deduction` double(19,2) DEFAULT NULL,
  `Total_Annual_Leave_Days` longtext COLLATE utf8_unicode_ci,
  `Total_Field_Work_Days` longtext COLLATE utf8_unicode_ci,
  `Total_Funeral_Leave_Days` longtext COLLATE utf8_unicode_ci,
  `Total_Maternity_Leave_Days` longtext COLLATE utf8_unicode_ci,
  `Total_Paternity_Leave_Days` longtext COLLATE utf8_unicode_ci,
  `Total_Sick_Leave_Days` longtext COLLATE utf8_unicode_ci,
  `Total_Special_Leave_With_Out_Payment_Days` longtext COLLATE utf8_unicode_ci,
  `Total_Special_Leave_With_Payment_Days` longtext COLLATE utf8_unicode_ci,
  `Total_Wedding_Leave_Days` longtext COLLATE utf8_unicode_ci,
  `Absent_Day` decimal(18,1) DEFAULT NULL,
  `Leave_Day` decimal(28,1) DEFAULT NULL,
  `Working_Day` decimal(18,1) DEFAULT NULL,
  `Working_Hours` decimal(38,2) DEFAULT NULL,
  `Bonus` double(10,2) DEFAULT NULL,
  `LU_Member` int(4) NOT NULL DEFAULT '0',
  `LU_Contribution` double(19,2) DEFAULT NULL,
  `Pension_7` double(19,2) DEFAULT NULL,
  `Pension_11` double(19,2) DEFAULT NULL,
  `Pension_18` double(19,2) DEFAULT NULL,
  `Salary_Per_Hour` double(19,2) DEFAULT NULL,
  `Salary_Per_Day` double DEFAULT NULL,
  `Absent_Day_Payment` double(19,2) DEFAULT NULL,
  `Working_Day_Payment` double(19,2) DEFAULT NULL,
  `Leave_Day_Payment` double(19,2) DEFAULT NULL,
  `Present_Allowance` double(19,2) DEFAULT NULL,
  `No_Bunch` int(11) DEFAULT NULL,
  `Bunching_Payment` decimal(12,1) DEFAULT NULL,
  `Transport_Allowance` double(19,2) DEFAULT NULL,
  `DayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Day_OT` double(19,2) DEFAULT NULL,
  `NightOT_Hour` decimal(18,1) DEFAULT NULL,
  `Night_OT` double(19,2) DEFAULT NULL,
  `OffDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Offday_OT` double(19,2) DEFAULT NULL,
  `HolyDayOT_Hour` decimal(18,1) DEFAULT NULL,
  `Holyday_OT` double(19,2) DEFAULT NULL,
  `Total_OT_Hour` decimal(38,2) DEFAULT NULL,
  `Total_OT` double(19,2) DEFAULT NULL,
  `salary_analysis` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Taxable_Income` double(19,2) DEFAULT NULL,
  `Non_Taxable_Income` double(19,2) DEFAULT NULL,
  `Income_Tax` double(19,2) DEFAULT NULL,
  `Total_Deduction` double(19,2) DEFAULT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Net_Pay` double(17,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_weekly_attendance`
--

CREATE TABLE IF NOT EXISTS `temp_weekly_attendance` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Absent_Hour` time DEFAULT NULL,
  `Present_Hour` time NOT NULL,
  `Day_OT_Hour` time DEFAULT NULL,
  `Night_OT_Hour` time DEFAULT NULL,
  `Off_Day_OT_Hour` time DEFAULT NULL,
  `Holyday_OT_Hour` time DEFAULT NULL,
  `Absent_Dates` text COLLATE utf8_unicode_ci NOT NULL,
  `Week_Number` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Month_Year` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`,`Week_Number`,`Month_Year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_aq`
--

CREATE TABLE IF NOT EXISTS `terminated_aq` (
  `ID` varchar(8) DEFAULT NULL,
  `FirstName` varchar(16) DEFAULT NULL,
  `MiddelName` varchar(13) DEFAULT NULL,
  `LastName` varchar(11) DEFAULT NULL,
  `Department` varchar(25) DEFAULT NULL,
  `Terminated_Date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee`
--

CREATE TABLE IF NOT EXISTS `terminated_employee` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Terminated_Date` date DEFAULT NULL,
  `Termination_Reason` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Black_List` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=302 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_2019_june`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_2019_june` (
  `Auto_ID` varchar(10) DEFAULT NULL,
  `ID` varchar(11) DEFAULT NULL,
  `FirstName` varchar(11) DEFAULT NULL,
  `MiddelName` varchar(10) DEFAULT NULL,
  `LastName` varchar(8) DEFAULT NULL,
  `Department` varchar(35) DEFAULT NULL,
  `Terminated_Date` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_allowance`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_allowance` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Transport_Allowance` double NOT NULL,
  `Hardship_Allowance` double NOT NULL,
  `Housing_Allowance` double NOT NULL,
  `Position_Allowance` double NOT NULL,
  `Present_Allowance` double NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8421 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_allowance_definition`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_allowance_definition` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Allowance_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Year_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Allowance_Amount` double(10,2) NOT NULL,
  PRIMARY KEY (`ID`,`Allowance_Name`,`Year_Month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_annual_leave`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_annual_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Leavedays` int(4) NOT NULL,
  `RestDay` int(4) DEFAULT '0',
  `Leave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Annual Leave',
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`Leave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4099 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_demotion`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_demotion` (
  `Auto_ID` int(11) NOT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Evaluation_Result` float DEFAULT NULL,
  `Position_Before_Demotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_After_Demotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Before_Demotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_After_Demotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary_Before_Demotion` int(11) NOT NULL,
  `Salary_After_Demotion` int(11) NOT NULL,
  `Demotion_Date` date NOT NULL,
  PRIMARY KEY (`ID`,`Demotion_Date`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_department_transfer`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_department_transfer` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Position_Before` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `To_Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_After` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Transfer_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Transfer_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `FromDepartment` (`From_Department`,`To_Department`),
  KEY `ToDepartment` (`To_Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_disciplinary_action`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_disciplinary_action` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Discipline_Action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Discipline_Letter` longtext COLLATE utf8_unicode_ci,
  `Discipline_Taken_Date` date NOT NULL DEFAULT '0000-00-00',
  `Status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`ID`,`Discipline_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_employee_offday`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_employee_offday` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Off_Day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  PRIMARY KEY (`Auto_ID`,`ID`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  UNIQUE KEY `Auto_ID_2` (`Auto_ID`),
  KEY `Department_2` (`Department`),
  KEY `ID` (`ID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_funeral_leave`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_funeral_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FuneralLeaveDays` int(3) NOT NULL,
  `RestDay` int(7) DEFAULT NULL,
  `FuneralLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Funeral Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`FuneralLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_health_care_insurance`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_health_care_insurance` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Referral_Case` text COLLATE utf8_unicode_ci,
  `Treatment_Cost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Refferal_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Refferal_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department_2` (`Department`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_leave`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LeaveDays` int(4) NOT NULL,
  `RestDays` int(4) DEFAULT '0',
  `Leave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Annual Leave',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`Leave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `employee_personal_record_Annua_Leave` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_maternity_leave`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_maternity_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaternityLeaveDays` int(3) NOT NULL DEFAULT '90',
  `MaternityLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Maternity Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`MaternityLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_medical_referral`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_medical_referral` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Referral_Case` text COLLATE utf8_unicode_ci,
  `Treatment_Cost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Refferal_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Refferal_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department_2` (`Department`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_offday`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_offday` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Off_Day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`,`ID`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2707 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_paternity_leave`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_paternity_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PaternityLeaveDays` int(3) NOT NULL DEFAULT '90',
  `PaternityLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Paternity Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`PaternityLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_payroll_data_setting`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_payroll_data_setting` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Salary` double(10,2) NOT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `No_Bunch` double DEFAULT NULL,
  `Other_Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Fine_HR` double DEFAULT '0',
  `ModifiedBy` varchar(2553) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=265 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_payroll_deduction`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_payroll_deduction` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Deduction_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Total_Amount` double NOT NULL,
  `Monthly_Deduction` decimal(16,2) NOT NULL,
  `No_Month` int(11) NOT NULL,
  `Start_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `End_Month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Payable_Month_List` text COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(2553) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Deduction_Type`,`Start_Month`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_personal_record`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_personal_record` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Pension_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contract_Session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(11) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14070 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_personal_record_06-03-2013`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_personal_record_06-03-2013` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Place_Birth` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Educational_Status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` int(7) DEFAULT NULL,
  `Martial_Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Singel',
  `Spouse_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Children_number` int(3) DEFAULT '0',
  `Name_Child` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth_Child` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex_Child` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Emergency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contact_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob,
  `Experience` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HardCopy_Shelf_No` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_probation_evalutaion`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_probation_evalutaion` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Employement` date NOT NULL,
  `Attendance` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Motivation` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Performance_Individual` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Performance_Group` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Communication_Supervisor` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Manger_Remark` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HR_Opinon` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Result` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'Passed',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_promotion`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_promotion` (
  `Auto_ID` int(11) NOT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Evaluation_Result` float DEFAULT NULL,
  `Position_Before_Promotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_After_Promotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Before_Promotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_After_Promotion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary_Before_Promotion` int(11) NOT NULL,
  `Salary_After_Promotion` int(11) NOT NULL,
  `Promotion_Date` date NOT NULL,
  PRIMARY KEY (`ID`,`Promotion_Date`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_recruitment`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_recruitment` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Employer` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Place` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_Birth` date DEFAULT NULL,
  `Age` int(3) DEFAULT NULL,
  `Sex` varchar(7) COLLATE utf8_unicode_ci DEFAULT 'Male',
  `Photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'default_profile.png',
  `Date` date DEFAULT NULL,
  `Address` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` double NOT NULL,
  `Transport_Allowance` double NOT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `Housing_Allowance` double NOT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Present_Allowance` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_sick_leave`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_sick_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SickLeaveDays` int(5) NOT NULL,
  `SickLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Sick Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`SickLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_special_leave`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_special_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SpecialLeaveDays` int(3) NOT NULL DEFAULT '90',
  `SpecialLeave_Taken_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Special Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`SpecialLeave_Taken_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_status_transaction`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_status_transaction` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Evaluation_Result` float DEFAULT NULL,
  `Position_Before` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_After` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Before` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_After` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary_Before` double NOT NULL,
  `Salary_After` double NOT NULL,
  `Transaction_Date` date NOT NULL,
  `Transaction_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`Transaction_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_suspension`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_suspension` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SuspendedDays` int(5) NOT NULL,
  `RestDays` int(11) NOT NULL,
  `Suspended_Date` date NOT NULL,
  `ReportOn` date NOT NULL,
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Suspended_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_total_deduction`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_total_deduction` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic Salary` double NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `Present_Allowance_Amount` double DEFAULT NULL,
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `Total_Holyday` int(2) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_training`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_training` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TrainingName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Training_Start_Date` date NOT NULL,
  `Training_End_Date` date NOT NULL,
  `Refreshment_Date` date DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Training_Start_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department_2` (`Department`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminated_employee_wedding_leave`
--

CREATE TABLE IF NOT EXISTS `terminated_employee_wedding_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WeddingLeavedays` int(3) NOT NULL,
  `RestDay` int(7) DEFAULT NULL,
  `WeddingLeave_TakenDate` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Wedding Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`WeddingLeave_TakenDate`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `thekey_department_data_access`
--

CREATE TABLE IF NOT EXISTS `thekey_department_data_access` (
  `Auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Auto_id`),
  KEY `gropu_department_access` (`group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8176 ;

-- --------------------------------------------------------

--
-- Table structure for table `thekey_form_definition`
--

CREATE TABLE IF NOT EXISTS `thekey_form_definition` (
  `Form_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Field_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Input_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Input_option` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thekey_group`
--

CREATE TABLE IF NOT EXISTS `thekey_group` (
  `group_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Descriptoin` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`group_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thekey_hrms_chart_definition`
--

CREATE TABLE IF NOT EXISTS `thekey_hrms_chart_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Chart_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Chart_Caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Chart_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `X_axis_Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `X_axis_Category_Field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Y_axis_Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Y_axis_Summary_Field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Y_axis_Summary_Value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Series_Field_Summary` text COLLATE utf8_unicode_ci NOT NULL,
  `Series_Field` text COLLATE utf8_unicode_ci NOT NULL,
  `Table_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Join_Table` text COLLATE utf8_unicode_ci NOT NULL,
  `Where_Clause` text COLLATE utf8_unicode_ci NOT NULL,
  `User_Feed_Parameter` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Chart_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `thekey_hrms_report_definition`
--

CREATE TABLE IF NOT EXISTS `thekey_hrms_report_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Report_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Report_Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Biometric_Attendance` tinyint(4) NOT NULL DEFAULT '1',
  `Report_Query` text COLLATE utf8_unicode_ci,
  `Report_Field` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Report_Field_Display_Name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Table_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Join_Table` text COLLATE utf8_unicode_ci NOT NULL,
  `Where_Clause` text COLLATE utf8_unicode_ci NOT NULL,
  `User_Feed_Parameter` text COLLATE utf8_unicode_ci NOT NULL,
  `Drill_Down_Query` text COLLATE utf8_unicode_ci NOT NULL,
  `Groups_Trailers_Query` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Report_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=94 ;

-- --------------------------------------------------------

--
-- Table structure for table `thekey_role`
--

CREATE TABLE IF NOT EXISTS `thekey_role` (
  `Auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Link` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Page_Name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `View` text COLLATE utf8_unicode_ci NOT NULL,
  `Edit` tinyint(4) DEFAULT NULL,
  `Delete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Auto_id`),
  KEY `group_role` (`group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18042 ;

-- --------------------------------------------------------

--
-- Table structure for table `thekey_role_old`
--

CREATE TABLE IF NOT EXISTS `thekey_role_old` (
  `Auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_id`),
  KEY `group_role` (`group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8682 ;

-- --------------------------------------------------------

--
-- Table structure for table `thekey_sessions`
--

CREATE TABLE IF NOT EXISTS `thekey_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `total_attendance`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `thekeyhrmsdb`.`total_attendance` AS select `thekeyhrmsdb`.`week_6`.`ID` AS `ID`,`thekeyhrmsdb`.`week_6`.`FirstName` AS `FirstName`,`thekeyhrmsdb`.`week_6`.`MiddelName` AS `MiddelName`,`thekeyhrmsdb`.`week_6`.`Department` AS `Department`,(((((`thekeyhrmsdb`.`week_1`.`No_Absent` + `thekeyhrmsdb`.`week_2`.`No_Absent`) + `thekeyhrmsdb`.`week_3`.`No_Absent`) + `thekeyhrmsdb`.`week_4`.`No_Absent`) + `thekeyhrmsdb`.`week_5`.`No_Absent`) + `thekeyhrmsdb`.`week_6`.`No_Absent`) AS `Total_Absent`,(((((`thekeyhrmsdb`.`week_1`.`No_Normal1` + `thekeyhrmsdb`.`week_2`.`No_Normal1`) + `thekeyhrmsdb`.`week_3`.`No_Normal1`) + `thekeyhrmsdb`.`week_4`.`No_Normal1`) + `thekeyhrmsdb`.`week_5`.`No_Normal1`) + `thekeyhrmsdb`.`week_6`.`No_Normal1`) AS `Total_No_normal1`,(((((`thekeyhrmsdb`.`week_1`.`No_Normal2` + `thekeyhrmsdb`.`week_2`.`No_Normal2`) + `thekeyhrmsdb`.`week_3`.`No_Normal2`) + `thekeyhrmsdb`.`week_4`.`No_Normal2`) + `thekeyhrmsdb`.`week_5`.`No_Normal2`) + `thekeyhrmsdb`.`week_6`.`No_Normal2`) AS `Total_No_normal2`,(((((`thekeyhrmsdb`.`week_1`.`No_Sunday` + `thekeyhrmsdb`.`week_2`.`No_Sunday`) + `thekeyhrmsdb`.`week_3`.`No_Sunday`) + `thekeyhrmsdb`.`week_4`.`No_Sunday`) + `thekeyhrmsdb`.`week_5`.`No_Sunday`) + `thekeyhrmsdb`.`week_6`.`No_Sunday`) AS `Total_No_Sunday`,(((((`thekeyhrmsdb`.`week_1`.`No_Holyday` + `thekeyhrmsdb`.`week_2`.`No_Holyday`) + `thekeyhrmsdb`.`week_3`.`No_Holyday`) + `thekeyhrmsdb`.`week_4`.`No_Holyday`) + `thekeyhrmsdb`.`week_5`.`No_Holyday`) + `thekeyhrmsdb`.`week_6`.`No_Holyday`) AS `Total_No_Holyday` from (((((`thekeyhrmsdb`.`week_6` left join `thekeyhrmsdb`.`week_1` on(((`thekeyhrmsdb`.`week_1`.`FirstName` = `thekeyhrmsdb`.`week_6`.`FirstName`) and (`thekeyhrmsdb`.`week_1`.`ID` = `thekeyhrmsdb`.`week_6`.`ID`)))) left join `thekeyhrmsdb`.`week_2` on(((`thekeyhrmsdb`.`week_2`.`FirstName` = `thekeyhrmsdb`.`week_6`.`FirstName`) and (`thekeyhrmsdb`.`week_2`.`ID` = `thekeyhrmsdb`.`week_6`.`ID`)))) left join `thekeyhrmsdb`.`week_3` on(((`thekeyhrmsdb`.`week_3`.`FirstName` = `thekeyhrmsdb`.`week_6`.`FirstName`) and (`thekeyhrmsdb`.`week_3`.`ID` = `thekeyhrmsdb`.`week_6`.`ID`)))) left join `thekeyhrmsdb`.`week_4` on(((`thekeyhrmsdb`.`week_4`.`FirstName` = `thekeyhrmsdb`.`week_6`.`FirstName`) and (`thekeyhrmsdb`.`week_4`.`ID` = `thekeyhrmsdb`.`week_6`.`ID`)))) left join `thekeyhrmsdb`.`week_5` on(((`thekeyhrmsdb`.`week_5`.`FirstName` = `thekeyhrmsdb`.`week_6`.`FirstName`) and (`thekeyhrmsdb`.`week_5`.`ID` = `thekeyhrmsdb`.`week_6`.`ID`))));

-- --------------------------------------------------------

--
-- Table structure for table `total_attendance_backup`
--

CREATE TABLE IF NOT EXISTS `total_attendance_backup` (
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_Absent` decimal(12,2) DEFAULT NULL,
  `Total_No_normal1` decimal(12,2) DEFAULT NULL,
  `Total_No_normal2` decimal(12,2) DEFAULT NULL,
  `Total_No_Sunday` decimal(12,2) DEFAULT NULL,
  `Total_No_Holyday` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `total_deduction`
--

CREATE TABLE IF NOT EXISTS `total_deduction` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic_Salary` double NOT NULL,
  `Term_Employment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Group_No` int(11) DEFAULT NULL,
  `Position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `Present_Allowance_Amount` double DEFAULT NULL,
  `Speed_Bonus` double NOT NULL,
  `Canteen` double NOT NULL,
  `CHK_Cost_Sharing` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Loan` double DEFAULT '0',
  `Court_Deduction` double DEFAULT '0',
  `Other_Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2104 ;

-- --------------------------------------------------------

--
-- Table structure for table `total_deduction_benefit`
--

CREATE TABLE IF NOT EXISTS `total_deduction_benefit` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic Salary` double NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `Present_Allowance_Amount` double DEFAULT NULL,
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `Total_Holyday` int(2) DEFAULT '0',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `total_deduction_benefit_defualt`
--

CREATE TABLE IF NOT EXISTS `total_deduction_benefit_defualt` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic Salary` double NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `Present_Allowance_Amount` double DEFAULT NULL,
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `Total_Holyday` int(2) DEFAULT '0',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fgfhgjgj` text COLLATE utf8_unicode_ci NOT NULL,
  `Test` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `total_deduction_other`
--

CREATE TABLE IF NOT EXISTS `total_deduction_other` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic Salary` double NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `Present_Allowance_Amount` double DEFAULT NULL,
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `Total_Holyday` int(2) DEFAULT '0',
  `ModifiedBy` varchar(2553) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Triggers `total_deduction_other`
--
DROP TRIGGER IF EXISTS `Total_Deduction_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `Total_Deduction_INSERT_Trigger` AFTER INSERT ON `total_deduction_other`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
NEW.ID,CONCAT_WS('  ','FullName:',' ',NEW.FirstName,' ',NEW.MiddelName,' ',NEW.LastName,' ',
'Basic Salary:',NEW.`Basic Salary`,'Department:',NEW.Department,
'Position:',NEW.Position,'Position_Allowance:',NEW.Position_Allowance,
'Housing_Allowance:',NEW.Housing_Allowance,'Hardship_Allowance:',NEW.Hardship_Allowance,
'CHK_LU:',NEW.CHK_LU,'CHK_PF:',NEW.CHK_PF,'CHK_Pension:',NEW.CHK_Pension,
'PF_Amount:',NEW.PF_Amount,'CHK_Pledge:',NEW.CHK_Pledge,
'CHK_Present_Allowance:',NEW.CHK_Present_Allowance,
'Present_Allowance_Amount:',NEW.Present_Allowance_Amount,'Loan:',NEW.Loan,
'Court Deduction:',NEW.`Court Deduction`,'Other Deduction:',NEW.`Other Deduction`,
'Bonus:',NEW.Bonus,'Material:',NEW.Material),
NEW.ModifiedBy,TIMESTAMP(NOW()),"Total Deduction",'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Total_Deduction_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `Total_Deduction_Update_Trigger` AFTER UPDATE ON `total_deduction_other`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
OLD.ID,CONCAT_WS('  ','FullName:',' ',OLD.FirstName,' ',OLD.MiddelName,' ',OLD.LastName,' ',
'Basic Salary:',OLD.`Basic Salary`,'Department:',OLD.Department,
'Position:',OLD.Position,'Position_Allowance:',OLD.Position_Allowance,
'Housing_Allowance:',OLD.Housing_Allowance,'Hardship_Allowance:',OLD.Hardship_Allowance,
'CHK_LU:',OLD.CHK_LU,'CHK_PF:',OLD.CHK_PF,'CHK_Pension:',OLD.CHK_Pension,
'PF_Amount:',OLD.PF_Amount,'CHK_Pledge:',OLD.CHK_Pledge,
'CHK_Present_Allowance:',OLD.CHK_Present_Allowance,
'Present_Allowance_Amount:',OLD.Present_Allowance_Amount,'Loan:',OLD.Loan,
'Court Deduction:',OLD.`Court Deduction`,'Other Deduction:',OLD.`Other Deduction`,
'Bonus:',OLD.Bonus,'Material:',OLD.Material),
OLD.ModifiedBy,TIMESTAMP(NOW()),"Total Deduction",'BEFORE UPDATE');



INSERT INTO employee_Record_log VALUES(
NEW.ID,CONCAT_WS('  ','FullName:',' ',NEW.FirstName,' ',NEW.MiddelName,' ',NEW.LastName,' ',
'Basic Salary:',NEW.`Basic Salary`,'Department:',NEW.Department,
'Position:',NEW.Position,'Position_Allowance:',NEW.Position_Allowance,
'Housing_Allowance:',NEW.Housing_Allowance,'Hardship_Allowance:',NEW.Hardship_Allowance,
'CHK_LU:',NEW.CHK_LU,'CHK_PF:',NEW.CHK_PF,'CHK_Pension:',NEW.CHK_Pension,
'PF_Amount:',NEW.PF_Amount,'CHK_Pledge:',NEW.CHK_Pledge,
'CHK_Present_Allowance:',NEW.CHK_Present_Allowance,
'Present_Allowance_Amount:',NEW.Present_Allowance_Amount,'Loan:',NEW.Loan,
'Court Deduction:',NEW.`Court Deduction`,'Other Deduction:',NEW.`Other Deduction`,
'Bonus:',NEW.Bonus,'Material:',NEW.Material),
NEW.ModifiedBy,TIMESTAMP(NOW()),"Total Deduction",'AFTER UPDATE');


END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Total_Deduction_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `Total_Deduction_Delete_Trigger` AFTER DELETE ON `total_deduction_other`
 FOR EACH ROW BEGIN

INSERT INTO employee_Record_log VALUES(
OLD.ID,CONCAT_WS('  ','FullName:',' ',OLD.FirstName,' ',OLD.MiddelName,' ',OLD.LastName,' ',
'Basic Salary:',OLD.`Basic Salary`,'Department:',OLD.Department,
'Position:',OLD.Position,'Position_Allowance:',OLD.Position_Allowance,
'Housing_Allowance:',OLD.Housing_Allowance,'Hardship_Allowance:',OLD.Hardship_Allowance,
'CHK_LU:',OLD.CHK_LU,'CHK_PF:',OLD.CHK_PF,'CHK_Pension:',OLD.CHK_Pension,
'PF_Amount:',OLD.PF_Amount,'CHK_Pledge:',OLD.CHK_Pledge,
'CHK_Present_Allowance:',OLD.CHK_Present_Allowance,
'Present_Allowance_Amount:',OLD.Present_Allowance_Amount,'Loan:',OLD.Loan,
'Court Deduction:',OLD.`Court Deduction`,'Other Deduction:',OLD.`Other Deduction`,
'Bonus:',OLD.Bonus,'Material:',OLD.Material),
OLD.ModifiedBy,TIMESTAMP(NOW()),"Total Deduction",'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `total_deduction_zr`
--

CREATE TABLE IF NOT EXISTS `total_deduction_zr` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Basic Salary` double NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position_Allowance` double DEFAULT NULL,
  `Transport_Allowance_Amount` double DEFAULT NULL,
  `Housing_Allowance` double DEFAULT NULL,
  `Hardship_Allowance` double DEFAULT NULL,
  `CHK_LU` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'YES',
  `CHK_PF` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `CHK_Pension` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PF_Amount` double DEFAULT NULL,
  `CHK_Pledge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHK_Present_Allowance` int(7) DEFAULT '0',
  `Present_Allowance_Amount` double DEFAULT NULL,
  `Loan` double DEFAULT '0',
  `Court Deduction` double DEFAULT '0',
  `Other Deduction` double DEFAULT '0',
  `Bonus` double DEFAULT NULL,
  `Material` double DEFAULT '0',
  `Total_Holyday` int(2) DEFAULT '0',
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `ID` (`Auto_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1365 ;

-- --------------------------------------------------------

--
-- Table structure for table `total_leave`
--

CREATE TABLE IF NOT EXISTS `total_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SLD` int(5) NOT NULL DEFAULT '0',
  `ALD` int(5) DEFAULT '0',
  `MLD` int(5) DEFAULT '0',
  `PLD` int(5) DEFAULT '0',
  `WLD` int(5) DEFAULT '0',
  `FLD` int(5) DEFAULT '0',
  `SPLD` int(5) DEFAULT '0',
  `TotalLeaveDay` int(10) DEFAULT '0',
  PRIMARY KEY (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_leavedays`
--
CREATE TABLE IF NOT EXISTS `total_leavedays` (
`ID` varchar(15)
,`FirstName` varchar(20)
,`MiddelName` varchar(20)
,`MONTH` bigint(20)
,`YEAR` bigint(20)
,`ReportOn_MONTH` bigint(20)
,`ReportOn_YEAR` bigint(20)
,`LeaveType` varchar(255)
,`NoMonth` bigint(20)
,`LeaveDays` decimal(18,1)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `total_leave_taken_dates`
--
CREATE TABLE IF NOT EXISTS `total_leave_taken_dates` (
`ID` varchar(15)
,`FirstName` varchar(20)
,`MiddelName` varchar(20)
,`LeaveType` varchar(255)
,`Leave_Taken_Date` date
,`ReportOn` date
);
-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE IF NOT EXISTS `training` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TrainingName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Training_Start_Date` date NOT NULL,
  `Training_End_Date` date NOT NULL,
  `Refreshment_Date` date DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Training_Start_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) NOT NULL,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Employee_ID',
  `Full_Name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserName` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Password` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Access_Level` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Last_Login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`,`UserName`),
  KEY `user_group` (`Access_Level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `usersold`
--

CREATE TABLE IF NOT EXISTS `usersold` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserName` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Access_Level` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`,`UserName`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

CREATE TABLE IF NOT EXISTS `users_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pw` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `real_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `extra_info` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tmp_mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `access_level` tinyint(4) NOT NULL DEFAULT '0',
  `active` enum('y','n') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`login`),
  UNIQUE KEY `mail` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_mail_account`
--

CREATE TABLE IF NOT EXISTS `users_mail_account` (
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Mail_Account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Mail_Recipient_Group` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_old`
--

CREATE TABLE IF NOT EXISTS `users_old` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Full_Name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserName` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Password` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Access_Level` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`,`UserName`),
  KEY `user_group` (`Access_Level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE IF NOT EXISTS `users_profile` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Full_Name` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Notify_Summarized_Attendance` tinyint(4) NOT NULL,
  `Notify_Confirmed_Attendance` tinyint(4) NOT NULL,
  `Web_Site` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `About_User` text COLLATE utf8_unicode_ci,
  `Last_Change` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`User_Name`),
  UNIQUE KEY `users_id` (`User_Name`),
  UNIQUE KEY `Auto_ID_2` (`Auto_ID`),
  UNIQUE KEY `Auto_ID_3` (`Auto_ID`),
  KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_attendance`
--

CREATE TABLE IF NOT EXISTS `user_attendance` (
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Department`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_payroll`
--

CREATE TABLE IF NOT EXISTS `user_payroll` (
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department_Manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Approved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Department`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `Green House` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Green House`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_table_2019_june`
--

CREATE TABLE IF NOT EXISTS `user_table_2019_june` (
  `Green House` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prepared` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Aproved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Green House`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wage_allocation`
--

CREATE TABLE IF NOT EXISTS `wage_allocation` (
  `Initial_Salary` int(3) NOT NULL DEFAULT '0',
  `No_Year` decimal(2,1) NOT NULL DEFAULT '0.0',
  `Salary_Increment` int(3) DEFAULT NULL,
  PRIMARY KEY (`Initial_Salary`,`No_Year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `webchat_lines`
--

CREATE TABLE IF NOT EXISTS `webchat_lines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(16) NOT NULL,
  `gravatar` varchar(32) NOT NULL,
  `text` varchar(255) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ts` (`ts`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `webchat_users`
--
-- in use(#145 - Table '.\thekeyhrmsdb\webchat_users' is marked as crashed and should be repaired)

-- --------------------------------------------------------

--
-- Table structure for table `wedding_leave`
--

CREATE TABLE IF NOT EXISTS `wedding_leave` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WeddingLeavedays` int(3) NOT NULL,
  `RestDay` int(7) DEFAULT NULL,
  `WeddingLeave_TakenDate` date NOT NULL,
  `ReportOn` date NOT NULL,
  `LeaveType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Wedding Leave',
  `Reported` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'NO',
  `Report_Back_Date` date DEFAULT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`WeddingLeave_TakenDate`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Triggers `wedding_leave`
--
DROP TRIGGER IF EXISTS `WeddingLeave_INSERT_Trigger`;
DELIMITER //
CREATE TRIGGER `WeddingLeave_INSERT_Trigger` AFTER INSERT ON `wedding_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.WeddingLeaveDays,
NEW.RestDay,NEW.WeddingLeave_TakenDate,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'INSERT');

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `WeddingLeave_Update_Trigger`;
DELIMITER //
CREATE TRIGGER `WeddingLeave_Update_Trigger` AFTER UPDATE ON `wedding_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.WeddingLeaveDays,
OLD.RestDay,OLD.WeddingLeave_TakenDate,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'BEFORE UPDATE');

INSERT INTO leave_log VALUES(NEW.ID,NEW.FirstName,
NEW.MiddelName,NEW.LastName,NEW.Department,NEW.WeddingLeaveDays,
NEW.RestDay,NEW.WeddingLeave_TakenDate,NEW.ReportOn,
NEW.LeaveType,NEW.ModifiedBy,NEW.Reported,
NEW.Report_Back_Date,TIMESTAMP(NOW()),'AFTER UPDATE');


 END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `WeddingLeave_Delete_Trigger`;
DELIMITER //
CREATE TRIGGER `WeddingLeave_Delete_Trigger` AFTER DELETE ON `wedding_leave`
 FOR EACH ROW BEGIN

INSERT INTO leave_log VALUES(OLD.ID,OLD.FirstName,OLD.MiddelName,OLD.LastName,
OLD.Department,OLD.WeddingLeaveDays,
OLD.RestDay,OLD.WeddingLeave_TakenDate,
OLD.ReportOn,OLD.LeaveType,OLD.ModifiedBy,OLD.Reported,
OLD.Report_Back_Date,TIMESTAMP(NOW()),'DELETE');

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `weekattendance`
--

CREATE TABLE IF NOT EXISTS `weekattendance` (
  `Auto_ID` int(11) NOT NULL DEFAULT '0',
  `ID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `No_Absent` decimal(7,2) DEFAULT '0.00',
  `No_Normal1` decimal(7,2) DEFAULT '0.00',
  `No_Normal2` decimal(7,2) DEFAULT '0.00',
  `No_Sunday` decimal(7,2) DEFAULT '0.00',
  `No_Holyday` decimal(7,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weekly_attendance`
--

CREATE TABLE IF NOT EXISTS `weekly_attendance` (
  `ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Absent_Hour` time DEFAULT NULL,
  `Present_Hour` time NOT NULL,
  `Day_OT_Hour` time DEFAULT NULL,
  `Night_OT_Hour` time DEFAULT NULL,
  `Off_Day_OT_Hour` time DEFAULT NULL,
  `Holyday_OT_Hour` time DEFAULT NULL,
  `Absent_Dates` text COLLATE utf8_unicode_ci NOT NULL,
  `Week_Number` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Month_Year` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`,`Week_Number`,`Month_Year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `working_time_definition`
--

CREATE TABLE IF NOT EXISTS `working_time_definition` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Day_Name` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ALL',
  `Start` time NOT NULL,
  `Start_Break` time NOT NULL,
  `End_Break` time NOT NULL,
  `End` time NOT NULL,
  `Working_Hour` time NOT NULL,
  `Working_Hour_Hold` time NOT NULL,
  `Definition_Type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Department`,`From_Date`,`Day_Name`,`Definition_Type`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=615 ;

-- --------------------------------------------------------

--
-- Table structure for table `working_time_setting`
--

CREATE TABLE IF NOT EXISTS `working_time_setting` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Start` time NOT NULL,
  `Start_Break` time NOT NULL,
  `End_Break` time NOT NULL,
  `End` time NOT NULL,
  `Working_Hour` time NOT NULL,
  `Working_Hour_Hold` time NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Auto_ID`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2807 ;

-- --------------------------------------------------------

--
-- Table structure for table `working_time_setting_dayname`
--

CREATE TABLE IF NOT EXISTS `working_time_setting_dayname` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Day_Name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Start` time NOT NULL,
  `Start_Break` time NOT NULL,
  `End_Break` time NOT NULL,
  `End` time NOT NULL,
  `Working_Hour` time NOT NULL,
  `Working_Hour_Hold` time NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Department`,`From_Date`,`Day_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=235 ;

-- --------------------------------------------------------

--
-- Table structure for table `working_time_setting_dayname_individual`
--

CREATE TABLE IF NOT EXISTS `working_time_setting_dayname_individual` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Day_Name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Start` time NOT NULL,
  `Start_Break` time NOT NULL,
  `End_Break` time NOT NULL,
  `End` time NOT NULL,
  `Working_Hour` time NOT NULL,
  `Working_Hour_Hold` time NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`,`From_Date`,`Day_Name`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  KEY `Department` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Table structure for table `working_time_setting_individual`
--

CREATE TABLE IF NOT EXISTS `working_time_setting_individual` (
  `Auto_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MiddelName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From_Date` date NOT NULL,
  `To_Date` date NOT NULL,
  `Start` time NOT NULL,
  `Start_Break` time NOT NULL,
  `End_Break` time NOT NULL,
  `End` time NOT NULL,
  `Working_Hour` time NOT NULL,
  `Working_Hour_Hold` time NOT NULL,
  `ModifiedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`From_Date`),
  UNIQUE KEY `Auto_ID` (`Auto_ID`),
  UNIQUE KEY `Auto_ID_2` (`Auto_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1458 ;

-- --------------------------------------------------------

--
-- Structure for view `al_totalleavedays`
--
DROP TABLE IF EXISTS `al_totalleavedays`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `al_totalleavedays` AS select `attendance_allocation`.`ID` AS `ID`,count(`attendance_allocation`.`Status`) AS `TotalLeaveDays` from `attendance_allocation` where ((`attendance_allocation`.`Status` like _utf8'%Leave%') and (`attendance_allocation`.`Date` >= (select concat(year(now()),_utf8'-',(month(now()) - 1),_utf8'-',`company_settings`.`Attendance_Opening_Date`) AS `Attendance_Opening_Date` from `company_settings`)) and (`attendance_allocation`.`Date` <= (select concat(year(now()),_utf8'-',month(now()),_utf8'-',`company_settings`.`Attendance_Closing_Date`) AS `Attendance_Closing_Date` from `company_settings`))) group by `attendance_allocation`.`ID`;

-- --------------------------------------------------------

--
-- Structure for view `al_totalleavedaysx`
--
DROP TABLE IF EXISTS `al_totalleavedaysx`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `al_totalleavedaysx` AS select `attendance_allocation`.`ID` AS `ID`,count(`attendance_allocation`.`Status`) AS `TotalLeaveDays` from `attendance_allocation` where ((`attendance_allocation`.`Status` like _utf8'%Leave%') and (`attendance_allocation`.`Date` >= (select concat(year(now()),_utf8'-',(month(now()) - 1),_utf8'-',`company_settings`.`Attendance_Opening_Date`) AS `Attendance_Opening_Date` from `company_settings`)) and (`attendance_allocation`.`Date` <= (select concat(year(now()),_utf8'-',month(now()),_utf8'-',`company_settings`.`Attendance_Closing_Date`) AS `Attendance_Closing_Date` from `company_settings`))) group by `attendance_allocation`.`ID`;

-- --------------------------------------------------------

--
-- Structure for view `al_totalnightotdays`
--
DROP TABLE IF EXISTS `al_totalnightotdays`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `al_totalnightotdays` AS select `attendance_allocation`.`ID` AS `ID`,count(`attendance_allocation`.`ID`) AS `TotalNightOTDays`,`attendance_allocation`.`Date` AS `Date` from `attendance_allocation` where ((`attendance_allocation`.`NightOTHR` > _utf8'00:00:00') and (`attendance_allocation`.`Date` >= (select concat(year(now()),_utf8'-',(month(now()) - 1),_utf8'-',`company_settings`.`Attendance_Opening_Date`) AS `Attendance_Opening_Date` from `company_settings`)) and (`attendance_allocation`.`Date` <= (select concat(year(now()),_utf8'-',(month(now()) + 1),_utf8'-',`company_settings`.`Attendance_Closing_Date`) AS `Attendance_Closing_Date` from `company_settings`))) group by `attendance_allocation`.`ID`;

-- --------------------------------------------------------

--
-- Structure for view `al_totaloffdays`
--
DROP TABLE IF EXISTS `al_totaloffdays`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `al_totaloffdays` AS select `attendance_allocation`.`ID` AS `ID`,count(`attendance_allocation`.`Status`) AS `TotalOffDays`,`attendance_allocation`.`Date` AS `Date` from `attendance_allocation` where ((`attendance_allocation`.`Status` like _utf8'%Off-Day%') and (`attendance_allocation`.`Date` >= (select concat(year(now()),_utf8'-',(month(now()) - 1),_utf8'-',`company_settings`.`Attendance_Opening_Date`) AS `Attendance_Opening_Date` from `company_settings`)) and (`attendance_allocation`.`Date` <= (select concat(year(now()),_utf8'-',month(now()),_utf8'-',`company_settings`.`Attendance_Closing_Date`) AS `Attendance_Closing_Date` from `company_settings`))) group by `attendance_allocation`.`ID`;

-- --------------------------------------------------------

--
-- Structure for view `al_totaloffdaysx`
--
DROP TABLE IF EXISTS `al_totaloffdaysx`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `al_totaloffdaysx` AS select `attendance_allocation`.`ID` AS `ID`,count(`attendance_allocation`.`Status`) AS `TotalOffDays`,`attendance_allocation`.`Date` AS `Date` from `attendance_allocation` where ((`attendance_allocation`.`Status` like _utf8'%Off-Day%') and (`attendance_allocation`.`Date` >= (select concat(year(now()),_utf8'-',(month(now()) - 1),_utf8'-',`company_settings`.`Attendance_Opening_Date`) AS `Attendance_Opening_Date` from `company_settings`)) and (`attendance_allocation`.`Date` <= (select concat(year(now()),_utf8'-',month(now()),_utf8'-',`company_settings`.`Attendance_Closing_Date`) AS `Attendance_Closing_Date` from `company_settings`))) group by `attendance_allocation`.`ID`;

-- --------------------------------------------------------

--
-- Structure for view `al_total_leavedays2`
--
DROP TABLE IF EXISTS `al_total_leavedays2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `al_total_leavedays2` AS select `attendance_allocation`.`ID` AS `ID`,count(`attendance_allocation`.`Status`) AS `TotalLeaveDays` from `attendance_allocation` where ((`attendance_allocation`.`Status` like '%Leave%') and (`attendance_allocation`.`Date` >= (select concat((year(now()) - 1),'-',12,'-',`company_settings`.`Attendance_Opening_Date`) AS `Attendance_Opening_Date` from `company_settings`)) and (`attendance_allocation`.`Date` <= (select concat(year(now()),'-',month(now()),'-',`company_settings`.`Attendance_Closing_Date`) AS `Attendance_Closing_Date` from `company_settings`))) group by `attendance_allocation`.`ID`;

-- --------------------------------------------------------

--
-- Structure for view `manual_attendance_totalleavedays`
--
DROP TABLE IF EXISTS `manual_attendance_totalleavedays`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `manual_attendance_totalleavedays` AS select `employee_leave`.`ID` AS `ID`,month(`employee_leave`.`Leave_Taken_Date`) AS `MONTH`,year(`employee_leave`.`Leave_Taken_Date`) AS `YEAR`,month(`employee_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`employee_leave`.`ReportOn`) AS `ReportOn_YEAR`,`employee_leave`.`LeaveType` AS `LeaveType`,(month(`employee_leave`.`ReportOn`) - month(`employee_leave`.`Leave_Taken_Date`)) AS `NoMonth`,sum(if((month(`employee_leave`.`ReportOn`) >= month(now())),if(((month(`employee_leave`.`ReportOn`) - month(`employee_leave`.`Leave_Taken_Date`)) = 0),`employee_leave`.`LeaveDays`,if((((month(`employee_leave`.`ReportOn`) - month(`employee_leave`.`Leave_Taken_Date`)) > 0) and (month(`employee_leave`.`ReportOn`) = month(now()))),dayofmonth(`employee_leave`.`ReportOn`),if((((month(`employee_leave`.`ReportOn`) - month(`employee_leave`.`Leave_Taken_Date`)) > 0) and (month(`employee_leave`.`ReportOn`) > month(now())) and (month(`employee_leave`.`Leave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`employee_leave`.`Leave_Taken_Date`)),if((((month(`employee_leave`.`ReportOn`) - month(`employee_leave`.`Leave_Taken_Date`)) > 0) and (month(`employee_leave`.`ReportOn`) > month(now())) and (month(`employee_leave`.`Leave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0)) AS `TotalLeaveDays` from `employee_leave` where ((month(`employee_leave`.`Leave_Taken_Date`) <= month(now())) and (year(`employee_leave`.`Leave_Taken_Date`) = year(now())) and (month(`employee_leave`.`ReportOn`) >= month(now()))) group by `employee_leave`.`ID`;

-- --------------------------------------------------------

--
-- Structure for view `total_leavedays`
--
DROP TABLE IF EXISTS `total_leavedays`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_leavedays` AS select `maternity_leave`.`ID` AS `ID`,`maternity_leave`.`FirstName` AS `FirstName`,`maternity_leave`.`MiddelName` AS `MiddelName`,month(`maternity_leave`.`MaternityLeave_Taken_Date`) AS `MONTH`,year(`maternity_leave`.`MaternityLeave_Taken_Date`) AS `YEAR`,month(`maternity_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`maternity_leave`.`ReportOn`) AS `ReportOn_YEAR`,`maternity_leave`.`LeaveType` AS `LeaveType`,(month(`maternity_leave`.`ReportOn`) - month(`maternity_leave`.`MaternityLeave_Taken_Date`)) AS `NoMonth`,if((month(`maternity_leave`.`ReportOn`) >= month(now())),if(((month(`maternity_leave`.`ReportOn`) - month(`maternity_leave`.`MaternityLeave_Taken_Date`)) = 0),`maternity_leave`.`MaternityLeaveDays`,if((((month(`maternity_leave`.`ReportOn`) - month(`maternity_leave`.`MaternityLeave_Taken_Date`)) > 0) and (month(`maternity_leave`.`ReportOn`) = month(now()))),dayofmonth(`maternity_leave`.`ReportOn`),if((((month(`maternity_leave`.`ReportOn`) - month(`maternity_leave`.`MaternityLeave_Taken_Date`)) > 0) and (month(`maternity_leave`.`ReportOn`) > month(now())) and (month(`maternity_leave`.`MaternityLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`maternity_leave`.`MaternityLeave_Taken_Date`)),if((((month(`maternity_leave`.`ReportOn`) - month(`maternity_leave`.`MaternityLeave_Taken_Date`)) > 0) and (month(`maternity_leave`.`ReportOn`) > month(now())) and (month(`maternity_leave`.`MaternityLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `maternity_leave` where ((month(`maternity_leave`.`MaternityLeave_Taken_Date`) <= month(now())) and (year(`maternity_leave`.`MaternityLeave_Taken_Date`) = year(now())) and (month(`maternity_leave`.`ReportOn`) >= month(now()))) union select `annual_leave`.`ID` AS `ID`,`annual_leave`.`FirstName` AS `FirstName`,`annual_leave`.`MiddelName` AS `MiddelName`,month(`annual_leave`.`Leave_Taken_Date`) AS `MONTH`,year(`annual_leave`.`Leave_Taken_Date`) AS `YEAR`,month(`annual_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`annual_leave`.`ReportOn`) AS `ReportOn_YEAR`,`annual_leave`.`LeaveType` AS `LeaveType`,(month(`annual_leave`.`ReportOn`) - month(`annual_leave`.`Leave_Taken_Date`)) AS `NoMonth`,if((month(`annual_leave`.`ReportOn`) >= month(now())),if(((month(`annual_leave`.`ReportOn`) - month(`annual_leave`.`Leave_Taken_Date`)) = 0),`annual_leave`.`Leavedays`,if((((month(`annual_leave`.`ReportOn`) - month(`annual_leave`.`Leave_Taken_Date`)) > 0) and (month(`annual_leave`.`ReportOn`) = month(now()))),dayofmonth(`annual_leave`.`ReportOn`),if((((month(`annual_leave`.`ReportOn`) - month(`annual_leave`.`Leave_Taken_Date`)) > 0) and (month(`annual_leave`.`ReportOn`) > month(now())) and (month(`annual_leave`.`Leave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`annual_leave`.`Leave_Taken_Date`)),if((((month(`annual_leave`.`ReportOn`) - month(`annual_leave`.`Leave_Taken_Date`)) > 0) and (month(`annual_leave`.`ReportOn`) > month(now())) and (month(`annual_leave`.`Leave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `annual_leave` where ((month(`annual_leave`.`Leave_Taken_Date`) <= month(now())) and (year(`annual_leave`.`Leave_Taken_Date`) = year(now())) and (month(`annual_leave`.`ReportOn`) >= month(now()))) union select `sick_leave`.`ID` AS `ID`,`sick_leave`.`FirstName` AS `FirstName`,`sick_leave`.`MiddelName` AS `MiddelName`,month(`sick_leave`.`SickLeave_Taken_Date`) AS `MONTH`,year(`sick_leave`.`SickLeave_Taken_Date`) AS `YEAR`,month(`sick_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`sick_leave`.`ReportOn`) AS `ReportOn_YEAR`,`sick_leave`.`LeaveType` AS `LeaveType`,(month(`sick_leave`.`ReportOn`) - month(`sick_leave`.`SickLeave_Taken_Date`)) AS `NoMonth`,if((month(`sick_leave`.`ReportOn`) >= month(now())),if(((month(`sick_leave`.`ReportOn`) - month(`sick_leave`.`SickLeave_Taken_Date`)) = 0),`sick_leave`.`SickLeaveDays`,if((((month(`sick_leave`.`ReportOn`) - month(`sick_leave`.`SickLeave_Taken_Date`)) > 0) and (month(`sick_leave`.`ReportOn`) = month(now()))),dayofmonth(`sick_leave`.`ReportOn`),if((((month(`sick_leave`.`ReportOn`) - month(`sick_leave`.`SickLeave_Taken_Date`)) > 0) and (month(`sick_leave`.`ReportOn`) > month(now())) and (month(`sick_leave`.`SickLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`sick_leave`.`SickLeave_Taken_Date`)),if((((month(`sick_leave`.`ReportOn`) - month(`sick_leave`.`SickLeave_Taken_Date`)) > 0) and (month(`sick_leave`.`ReportOn`) > month(now())) and (month(`sick_leave`.`SickLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `sick_leave` where ((month(`sick_leave`.`SickLeave_Taken_Date`) <= month(now())) and (year(`sick_leave`.`SickLeave_Taken_Date`) = year(now())) and (month(`sick_leave`.`ReportOn`) >= month(now()))) union select `wedding_leave`.`ID` AS `ID`,`wedding_leave`.`FirstName` AS `FirstName`,`wedding_leave`.`MiddelName` AS `MiddelName`,month(`wedding_leave`.`WeddingLeave_TakenDate`) AS `MONTH`,year(`wedding_leave`.`WeddingLeave_TakenDate`) AS `YEAR`,month(`wedding_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`wedding_leave`.`ReportOn`) AS `ReportOn_YEAR`,`wedding_leave`.`LeaveType` AS `LeaveType`,(month(`wedding_leave`.`ReportOn`) - month(`wedding_leave`.`WeddingLeave_TakenDate`)) AS `NoMonth`,if((month(`wedding_leave`.`ReportOn`) >= month(now())),if(((month(`wedding_leave`.`ReportOn`) - month(`wedding_leave`.`WeddingLeave_TakenDate`)) = 0),`wedding_leave`.`WeddingLeavedays`,if((((month(`wedding_leave`.`ReportOn`) - month(`wedding_leave`.`WeddingLeave_TakenDate`)) > 0) and (month(`wedding_leave`.`ReportOn`) = month(now()))),dayofmonth(`wedding_leave`.`ReportOn`),if((((month(`wedding_leave`.`ReportOn`) - month(`wedding_leave`.`WeddingLeave_TakenDate`)) > 0) and (month(`wedding_leave`.`ReportOn`) > month(now())) and (month(`wedding_leave`.`WeddingLeave_TakenDate`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`wedding_leave`.`WeddingLeave_TakenDate`)),if((((month(`wedding_leave`.`ReportOn`) - month(`wedding_leave`.`WeddingLeave_TakenDate`)) > 0) and (month(`wedding_leave`.`ReportOn`) > month(now())) and (month(`wedding_leave`.`WeddingLeave_TakenDate`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `wedding_leave` where ((month(`wedding_leave`.`WeddingLeave_TakenDate`) <= month(now())) and (year(`wedding_leave`.`WeddingLeave_TakenDate`) = year(now())) and (month(`wedding_leave`.`ReportOn`) >= month(now()))) union select `funeral_leave`.`ID` AS `ID`,`funeral_leave`.`FirstName` AS `FirstName`,`funeral_leave`.`MiddelName` AS `MiddelName`,month(`funeral_leave`.`FuneralLeave_Taken_Date`) AS `MONTH`,year(`funeral_leave`.`FuneralLeave_Taken_Date`) AS `YEAR`,month(`funeral_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`funeral_leave`.`ReportOn`) AS `ReportOn_YEAR`,`funeral_leave`.`LeaveType` AS `LeaveType`,(month(`funeral_leave`.`ReportOn`) - month(`funeral_leave`.`FuneralLeave_Taken_Date`)) AS `NoMonth`,if((month(`funeral_leave`.`ReportOn`) >= month(now())),if(((month(`funeral_leave`.`ReportOn`) - month(`funeral_leave`.`FuneralLeave_Taken_Date`)) = 0),`funeral_leave`.`FuneralLeaveDays`,if((((month(`funeral_leave`.`ReportOn`) - month(`funeral_leave`.`FuneralLeave_Taken_Date`)) > 0) and (month(`funeral_leave`.`ReportOn`) = month(now()))),dayofmonth(`funeral_leave`.`ReportOn`),if((((month(`funeral_leave`.`ReportOn`) - month(`funeral_leave`.`FuneralLeave_Taken_Date`)) > 0) and (month(`funeral_leave`.`ReportOn`) > month(now())) and (month(`funeral_leave`.`FuneralLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`funeral_leave`.`FuneralLeave_Taken_Date`)),if((((month(`funeral_leave`.`ReportOn`) - month(`funeral_leave`.`FuneralLeave_Taken_Date`)) > 0) and (month(`funeral_leave`.`ReportOn`) > month(now())) and (month(`funeral_leave`.`FuneralLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `funeral_leave` where ((month(`funeral_leave`.`FuneralLeave_Taken_Date`) <= month(now())) and (year(`funeral_leave`.`FuneralLeave_Taken_Date`) = year(now())) and (month(`funeral_leave`.`ReportOn`) >= month(now()))) union select `paternity_leave`.`ID` AS `ID`,`paternity_leave`.`FirstName` AS `FirstName`,`paternity_leave`.`MiddelName` AS `MiddelName`,month(`paternity_leave`.`PaternityLeave_Taken_Date`) AS `MONTH`,year(`paternity_leave`.`PaternityLeave_Taken_Date`) AS `YEAR`,month(`paternity_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`paternity_leave`.`ReportOn`) AS `ReportOn_YEAR`,`paternity_leave`.`LeaveType` AS `LeaveType`,(month(`paternity_leave`.`ReportOn`) - month(`paternity_leave`.`PaternityLeave_Taken_Date`)) AS `NoMonth`,if((month(`paternity_leave`.`ReportOn`) >= month(now())),if(((month(`paternity_leave`.`ReportOn`) - month(`paternity_leave`.`PaternityLeave_Taken_Date`)) = 0),`paternity_leave`.`PaternityLeaveDays`,if((((month(`paternity_leave`.`ReportOn`) - month(`paternity_leave`.`PaternityLeave_Taken_Date`)) > 0) and (month(`paternity_leave`.`ReportOn`) = month(now()))),dayofmonth(`paternity_leave`.`ReportOn`),if((((month(`paternity_leave`.`ReportOn`) - month(`paternity_leave`.`PaternityLeave_Taken_Date`)) > 0) and (month(`paternity_leave`.`ReportOn`) > month(now())) and (month(`paternity_leave`.`PaternityLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`paternity_leave`.`PaternityLeave_Taken_Date`)),if((((month(`paternity_leave`.`ReportOn`) - month(`paternity_leave`.`PaternityLeave_Taken_Date`)) > 0) and (month(`paternity_leave`.`ReportOn`) > month(now())) and (month(`paternity_leave`.`PaternityLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `paternity_leave` where ((month(`paternity_leave`.`PaternityLeave_Taken_Date`) <= month(now())) and (year(`paternity_leave`.`PaternityLeave_Taken_Date`) = year(now())) and (month(`paternity_leave`.`ReportOn`) >= month(now()))) union select `special_leave`.`ID` AS `ID`,`special_leave`.`FirstName` AS `FirstName`,`special_leave`.`MiddelName` AS `MiddelName`,month(`special_leave`.`SpecialLeave_Taken_Date`) AS `MONTH`,year(`special_leave`.`SpecialLeave_Taken_Date`) AS `YEAR`,month(`special_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`special_leave`.`ReportOn`) AS `ReportOn_YEAR`,`special_leave`.`LeaveType` AS `LeaveType`,(month(`special_leave`.`ReportOn`) - month(`special_leave`.`SpecialLeave_Taken_Date`)) AS `NoMonth`,if((month(`special_leave`.`ReportOn`) >= month(now())),if(((month(`special_leave`.`ReportOn`) - month(`special_leave`.`SpecialLeave_Taken_Date`)) = 0),`special_leave`.`SpecialLeaveDays`,if((((month(`special_leave`.`ReportOn`) - month(`special_leave`.`SpecialLeave_Taken_Date`)) > 0) and (month(`special_leave`.`ReportOn`) = month(now()))),dayofmonth(`special_leave`.`ReportOn`),if((((month(`special_leave`.`ReportOn`) - month(`special_leave`.`SpecialLeave_Taken_Date`)) > 0) and (month(`special_leave`.`ReportOn`) > month(now())) and (month(`special_leave`.`SpecialLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`special_leave`.`SpecialLeave_Taken_Date`)),if((((month(`special_leave`.`ReportOn`) - month(`special_leave`.`SpecialLeave_Taken_Date`)) > 0) and (month(`special_leave`.`ReportOn`) > month(now())) and (month(`special_leave`.`SpecialLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `special_leave` where ((month(`special_leave`.`SpecialLeave_Taken_Date`) <= month(now())) and (year(`special_leave`.`SpecialLeave_Taken_Date`) = year(now())) and (month(`special_leave`.`ReportOn`) >= month(now())) and (month(`special_leave`.`ReportOn`) >= month(now()))) union select `terminated_employee_maternity_leave`.`ID` AS `ID`,`terminated_employee_maternity_leave`.`FirstName` AS `FirstName`,`terminated_employee_maternity_leave`.`MiddelName` AS `MiddelName`,month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`) AS `MONTH`,year(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`) AS `YEAR`,month(`terminated_employee_maternity_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`terminated_employee_maternity_leave`.`ReportOn`) AS `ReportOn_YEAR`,`terminated_employee_maternity_leave`.`LeaveType` AS `LeaveType`,(month(`terminated_employee_maternity_leave`.`ReportOn`) - month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`)) AS `NoMonth`,if((month(`terminated_employee_maternity_leave`.`ReportOn`) >= month(now())),if(((month(`terminated_employee_maternity_leave`.`ReportOn`) - month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`)) = 0),`terminated_employee_maternity_leave`.`MaternityLeaveDays`,if((((month(`terminated_employee_maternity_leave`.`ReportOn`) - month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`)) > 0) and (month(`terminated_employee_maternity_leave`.`ReportOn`) = month(now()))),dayofmonth(`terminated_employee_maternity_leave`.`ReportOn`),if((((month(`terminated_employee_maternity_leave`.`ReportOn`) - month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`)) > 0) and (month(`terminated_employee_maternity_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`)),if((((month(`terminated_employee_maternity_leave`.`ReportOn`) - month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`)) > 0) and (month(`terminated_employee_maternity_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `terminated_employee_maternity_leave` where ((month(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`) <= month(now())) and (year(`terminated_employee_maternity_leave`.`MaternityLeave_Taken_Date`) = year(now())) and (month(`terminated_employee_maternity_leave`.`ReportOn`) >= month(now()))) union select `terminated_employee_annual_leave`.`ID` AS `ID`,`terminated_employee_annual_leave`.`FirstName` AS `FirstName`,`terminated_employee_annual_leave`.`MiddelName` AS `MiddelName`,month(`terminated_employee_annual_leave`.`Leave_Taken_Date`) AS `MONTH`,year(`terminated_employee_annual_leave`.`Leave_Taken_Date`) AS `YEAR`,month(`terminated_employee_annual_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`terminated_employee_annual_leave`.`ReportOn`) AS `ReportOn_YEAR`,`terminated_employee_annual_leave`.`LeaveType` AS `LeaveType`,(month(`terminated_employee_annual_leave`.`ReportOn`) - month(`terminated_employee_annual_leave`.`Leave_Taken_Date`)) AS `NoMonth`,if((month(`terminated_employee_annual_leave`.`ReportOn`) >= month(now())),if(((month(`terminated_employee_annual_leave`.`ReportOn`) - month(`terminated_employee_annual_leave`.`Leave_Taken_Date`)) = 0),`terminated_employee_annual_leave`.`Leavedays`,if((((month(`terminated_employee_annual_leave`.`ReportOn`) - month(`terminated_employee_annual_leave`.`Leave_Taken_Date`)) > 0) and (month(`terminated_employee_annual_leave`.`ReportOn`) = month(now()))),dayofmonth(`terminated_employee_annual_leave`.`ReportOn`),if((((month(`terminated_employee_annual_leave`.`ReportOn`) - month(`terminated_employee_annual_leave`.`Leave_Taken_Date`)) > 0) and (month(`terminated_employee_annual_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_annual_leave`.`Leave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`terminated_employee_annual_leave`.`Leave_Taken_Date`)),if((((month(`terminated_employee_annual_leave`.`ReportOn`) - month(`terminated_employee_annual_leave`.`Leave_Taken_Date`)) > 0) and (month(`terminated_employee_annual_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_annual_leave`.`Leave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `terminated_employee_annual_leave` where ((month(`terminated_employee_annual_leave`.`Leave_Taken_Date`) <= month(now())) and (year(`terminated_employee_annual_leave`.`Leave_Taken_Date`) = year(now())) and (month(`terminated_employee_annual_leave`.`ReportOn`) >= month(now()))) union select `terminated_employee_sick_leave`.`ID` AS `ID`,`terminated_employee_sick_leave`.`FirstName` AS `FirstName`,`terminated_employee_sick_leave`.`MiddelName` AS `MiddelName`,month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`) AS `MONTH`,year(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`) AS `YEAR`,month(`terminated_employee_sick_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`terminated_employee_sick_leave`.`ReportOn`) AS `ReportOn_YEAR`,`terminated_employee_sick_leave`.`LeaveType` AS `LeaveType`,(month(`terminated_employee_sick_leave`.`ReportOn`) - month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`)) AS `NoMonth`,if((month(`terminated_employee_sick_leave`.`ReportOn`) >= month(now())),if(((month(`terminated_employee_sick_leave`.`ReportOn`) - month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`)) = 0),`terminated_employee_sick_leave`.`SickLeaveDays`,if((((month(`terminated_employee_sick_leave`.`ReportOn`) - month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`)) > 0) and (month(`terminated_employee_sick_leave`.`ReportOn`) = month(now()))),dayofmonth(`terminated_employee_sick_leave`.`ReportOn`),if((((month(`terminated_employee_sick_leave`.`ReportOn`) - month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`)) > 0) and (month(`terminated_employee_sick_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`)),if((((month(`terminated_employee_sick_leave`.`ReportOn`) - month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`)) > 0) and (month(`terminated_employee_sick_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `terminated_employee_sick_leave` where ((month(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`) <= month(now())) and (year(`terminated_employee_sick_leave`.`SickLeave_Taken_Date`) = year(now())) and (month(`terminated_employee_sick_leave`.`ReportOn`) >= month(now()))) union select `terminated_employee_wedding_leave`.`ID` AS `ID`,`terminated_employee_wedding_leave`.`FirstName` AS `FirstName`,`terminated_employee_wedding_leave`.`MiddelName` AS `MiddelName`,month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`) AS `MONTH`,year(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`) AS `YEAR`,month(`terminated_employee_wedding_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`terminated_employee_wedding_leave`.`ReportOn`) AS `ReportOn_YEAR`,`terminated_employee_wedding_leave`.`LeaveType` AS `LeaveType`,(month(`terminated_employee_wedding_leave`.`ReportOn`) - month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`)) AS `NoMonth`,if((month(`terminated_employee_wedding_leave`.`ReportOn`) >= month(now())),if(((month(`terminated_employee_wedding_leave`.`ReportOn`) - month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`)) = 0),`terminated_employee_wedding_leave`.`WeddingLeavedays`,if((((month(`terminated_employee_wedding_leave`.`ReportOn`) - month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`)) > 0) and (month(`terminated_employee_wedding_leave`.`ReportOn`) = month(now()))),dayofmonth(`terminated_employee_wedding_leave`.`ReportOn`),if((((month(`terminated_employee_wedding_leave`.`ReportOn`) - month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`)) > 0) and (month(`terminated_employee_wedding_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`)),if((((month(`terminated_employee_wedding_leave`.`ReportOn`) - month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`)) > 0) and (month(`terminated_employee_wedding_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `terminated_employee_wedding_leave` where ((month(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`) <= month(now())) and (year(`terminated_employee_wedding_leave`.`WeddingLeave_TakenDate`) = year(now())) and (month(`terminated_employee_wedding_leave`.`ReportOn`) >= month(now()))) union select `terminated_employee_funeral_leave`.`ID` AS `ID`,`terminated_employee_funeral_leave`.`FirstName` AS `FirstName`,`terminated_employee_funeral_leave`.`MiddelName` AS `MiddelName`,month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`) AS `MONTH`,year(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`) AS `YEAR`,month(`terminated_employee_funeral_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`terminated_employee_funeral_leave`.`ReportOn`) AS `ReportOn_YEAR`,`terminated_employee_funeral_leave`.`LeaveType` AS `LeaveType`,(month(`terminated_employee_funeral_leave`.`ReportOn`) - month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`)) AS `NoMonth`,if((month(`terminated_employee_funeral_leave`.`ReportOn`) >= month(now())),if(((month(`terminated_employee_funeral_leave`.`ReportOn`) - month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`)) = 0),`terminated_employee_funeral_leave`.`FuneralLeaveDays`,if((((month(`terminated_employee_funeral_leave`.`ReportOn`) - month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`)) > 0) and (month(`terminated_employee_funeral_leave`.`ReportOn`) = month(now()))),dayofmonth(`terminated_employee_funeral_leave`.`ReportOn`),if((((month(`terminated_employee_funeral_leave`.`ReportOn`) - month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`)) > 0) and (month(`terminated_employee_funeral_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`)),if((((month(`terminated_employee_funeral_leave`.`ReportOn`) - month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`)) > 0) and (month(`terminated_employee_funeral_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `terminated_employee_funeral_leave` where ((month(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`) <= month(now())) and (year(`terminated_employee_funeral_leave`.`FuneralLeave_Taken_Date`) = year(now())) and (month(`terminated_employee_funeral_leave`.`ReportOn`) >= month(now()))) union select `terminated_employee_paternity_leave`.`ID` AS `ID`,`terminated_employee_paternity_leave`.`FirstName` AS `FirstName`,`terminated_employee_paternity_leave`.`MiddelName` AS `MiddelName`,month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`) AS `MONTH`,year(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`) AS `YEAR`,month(`terminated_employee_paternity_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`terminated_employee_paternity_leave`.`ReportOn`) AS `ReportOn_YEAR`,`terminated_employee_paternity_leave`.`LeaveType` AS `LeaveType`,(month(`terminated_employee_paternity_leave`.`ReportOn`) - month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`)) AS `NoMonth`,if((month(`terminated_employee_paternity_leave`.`ReportOn`) >= month(now())),if(((month(`terminated_employee_paternity_leave`.`ReportOn`) - month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`)) = 0),`terminated_employee_paternity_leave`.`PaternityLeaveDays`,if((((month(`terminated_employee_paternity_leave`.`ReportOn`) - month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`)) > 0) and (month(`terminated_employee_paternity_leave`.`ReportOn`) = month(now()))),dayofmonth(`terminated_employee_paternity_leave`.`ReportOn`),if((((month(`terminated_employee_paternity_leave`.`ReportOn`) - month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`)) > 0) and (month(`terminated_employee_paternity_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`)),if((((month(`terminated_employee_paternity_leave`.`ReportOn`) - month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`)) > 0) and (month(`terminated_employee_paternity_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `terminated_employee_paternity_leave` where ((month(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`) <= month(now())) and (year(`terminated_employee_paternity_leave`.`PaternityLeave_Taken_Date`) = year(now())) and (month(`terminated_employee_paternity_leave`.`ReportOn`) >= month(now()))) union select `terminated_employee_special_leave`.`ID` AS `ID`,`terminated_employee_special_leave`.`FirstName` AS `FirstName`,`terminated_employee_special_leave`.`MiddelName` AS `MiddelName`,month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`) AS `MONTH`,year(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`) AS `YEAR`,month(`terminated_employee_special_leave`.`ReportOn`) AS `ReportOn_MONTH`,year(`terminated_employee_special_leave`.`ReportOn`) AS `ReportOn_YEAR`,`terminated_employee_special_leave`.`LeaveType` AS `LeaveType`,(month(`terminated_employee_special_leave`.`ReportOn`) - month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`)) AS `NoMonth`,if((month(`terminated_employee_special_leave`.`ReportOn`) >= month(now())),if(((month(`terminated_employee_special_leave`.`ReportOn`) - month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`)) = 0),`terminated_employee_special_leave`.`SpecialLeaveDays`,if((((month(`terminated_employee_special_leave`.`ReportOn`) - month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`)) > 0) and (month(`terminated_employee_special_leave`.`ReportOn`) = month(now()))),dayofmonth(`terminated_employee_special_leave`.`ReportOn`),if((((month(`terminated_employee_special_leave`.`ReportOn`) - month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`)) > 0) and (month(`terminated_employee_special_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`) = month(now()))),(dayofmonth(last_day(now())) - dayofmonth(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`)),if((((month(`terminated_employee_special_leave`.`ReportOn`) - month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`)) > 0) and (month(`terminated_employee_special_leave`.`ReportOn`) > month(now())) and (month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`) <> month(now()))),dayofmonth(last_day(now())),0)))),0) AS `LeaveDays` from `terminated_employee_special_leave` where ((month(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`) <= month(now())) and (year(`terminated_employee_special_leave`.`SpecialLeave_Taken_Date`) = year(now())) and (month(`terminated_employee_special_leave`.`ReportOn`) >= month(now())));

-- --------------------------------------------------------

--
-- Structure for view `total_leave_taken_dates`
--
DROP TABLE IF EXISTS `total_leave_taken_dates`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_leave_taken_dates` AS select `annual_leave`.`ID` AS `ID`,`annual_leave`.`FirstName` AS `FirstName`,`annual_leave`.`MiddelName` AS `MiddelName`,`annual_leave`.`LeaveType` AS `LeaveType`,`annual_leave`.`Leave_Taken_Date` AS `Leave_Taken_Date`,`annual_leave`.`ReportOn` AS `ReportOn` from `annual_leave` union select `maternity_leave`.`ID` AS `ID`,`maternity_leave`.`FirstName` AS `FirstName`,`maternity_leave`.`MiddelName` AS `MiddelName`,`maternity_leave`.`LeaveType` AS `LeaveType`,`maternity_leave`.`MaternityLeave_Taken_Date` AS `MaternityLeave_Taken_Date`,`maternity_leave`.`ReportOn` AS `ReportOn` from `maternity_leave` union select `sick_leave`.`ID` AS `ID`,`sick_leave`.`FirstName` AS `FirstName`,`sick_leave`.`MiddelName` AS `MiddelName`,`sick_leave`.`LeaveType` AS `LeaveType`,`sick_leave`.`SickLeave_Taken_Date` AS `SickLeave_Taken_Date`,`sick_leave`.`ReportOn` AS `ReportOn` from `sick_leave` union select `wedding_leave`.`ID` AS `ID`,`wedding_leave`.`FirstName` AS `FirstName`,`wedding_leave`.`MiddelName` AS `MiddelName`,`wedding_leave`.`LeaveType` AS `LeaveType`,`wedding_leave`.`WeddingLeave_TakenDate` AS `WeddingLeave_TakenDate`,`wedding_leave`.`ReportOn` AS `ReportOn` from `wedding_leave` union select `funeral_leave`.`ID` AS `ID`,`funeral_leave`.`FirstName` AS `FirstName`,`funeral_leave`.`MiddelName` AS `MiddelName`,`funeral_leave`.`LeaveType` AS `LeaveType`,`funeral_leave`.`FuneralLeave_Taken_Date` AS `FuneralLeave_Taken_Date`,`funeral_leave`.`ReportOn` AS `ReportOn` from `funeral_leave` union select `paternity_leave`.`ID` AS `ID`,`paternity_leave`.`FirstName` AS `FirstName`,`paternity_leave`.`MiddelName` AS `MiddelName`,`paternity_leave`.`LeaveType` AS `LeaveType`,`paternity_leave`.`PaternityLeave_Taken_Date` AS `PaternityLeave_Taken_Date`,`paternity_leave`.`ReportOn` AS `ReportOn` from `paternity_leave` union select `special_leave`.`ID` AS `ID`,`special_leave`.`FirstName` AS `FirstName`,`special_leave`.`MiddelName` AS `MiddelName`,`special_leave`.`LeaveType` AS `LeaveType`,`special_leave`.`SpecialLeave_Taken_Date` AS `SpecialLeave_Taken_Date`,`special_leave`.`ReportOn` AS `ReportOn` from `special_leave`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department_transfer`
--
ALTER TABLE `department_transfer`
  ADD CONSTRAINT `department_transfer_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disciplinary_action`
--
ALTER TABLE `disciplinary_action`
  ADD CONSTRAINT `disciplinary_action_ibfk_5` FOREIGN KEY (`ID`) REFERENCES `employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disciplinary_action_ibfk_6` FOREIGN KEY (`ID`) REFERENCES `employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_allowance_definition`
--
ALTER TABLE `employee_allowance_definition`
  ADD CONSTRAINT `employee_allowance_definition_ibfk_1` FOREIGN KEY (`Allowance_ID`) REFERENCES `allowance_settings` (`Allowance_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `employee_department_transfer`
--
ALTER TABLE `employee_department_transfer`
  ADD CONSTRAINT `employee_department_transfer_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD CONSTRAINT `employee_leave_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_status_transaction`
--
ALTER TABLE `employee_status_transaction`
  ADD CONSTRAINT `employee_status_transaction_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll_deduction_definition`
--
ALTER TABLE `payroll_deduction_definition`
  ADD CONSTRAINT `payroll_deduction_definition_ibfk_1` FOREIGN KEY (`Deduction_ID`) REFERENCES `deduction_settings` (`Deduction_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_allowance`
--
ALTER TABLE `terminated_employee_allowance`
  ADD CONSTRAINT `terminated_employee_allowance_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_demotion`
--
ALTER TABLE `terminated_employee_demotion`
  ADD CONSTRAINT `terminated_employee_demotion_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `department` (`Department`) ON UPDATE CASCADE,
  ADD CONSTRAINT `terminated_employee_demotion_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record_06-03-2013` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_employee_offday`
--
ALTER TABLE `terminated_employee_employee_offday`
  ADD CONSTRAINT `terminated_employee_employee_offday_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `department` (`Department`) ON UPDATE CASCADE,
  ADD CONSTRAINT `terminated_employee_employee_offday_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record_06-03-2013` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_health_care_insurance`
--
ALTER TABLE `terminated_employee_health_care_insurance`
  ADD CONSTRAINT `terminated_employee_health_care_insurance_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `department` (`Department`) ON UPDATE CASCADE,
  ADD CONSTRAINT `terminated_employee_health_care_insurance_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record_06-03-2013` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_leave`
--
ALTER TABLE `terminated_employee_leave`
  ADD CONSTRAINT `terminated_employee_leave_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_medical_referral`
--
ALTER TABLE `terminated_employee_medical_referral`
  ADD CONSTRAINT `terminated_employee_medical_referral_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `department` (`Department`) ON UPDATE CASCADE,
  ADD CONSTRAINT `terminated_employee_medical_referral_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record_06-03-2013` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_offday`
--
ALTER TABLE `terminated_employee_offday`
  ADD CONSTRAINT `terminated_employee_offday_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_paternity_leave`
--
ALTER TABLE `terminated_employee_paternity_leave`
  ADD CONSTRAINT `terminated_employee_paternity_leave_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_personal_record_06-03-2013`
--
ALTER TABLE `terminated_employee_personal_record_06-03-2013`
  ADD CONSTRAINT `terminated_employee_personal_record_06@002d03@002d2013_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `department` (`Department`) ON UPDATE SET NULL;

--
-- Constraints for table `terminated_employee_probation_evalutaion`
--
ALTER TABLE `terminated_employee_probation_evalutaion`
  ADD CONSTRAINT `terminated_employee_probation_evalutaion_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `department` (`Department`) ON UPDATE CASCADE,
  ADD CONSTRAINT `terminated_employee_probation_evalutaion_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record_06-03-2013` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_promotion`
--
ALTER TABLE `terminated_employee_promotion`
  ADD CONSTRAINT `terminated_employee_promotion_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `department` (`Department`) ON UPDATE CASCADE,
  ADD CONSTRAINT `terminated_employee_promotion_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record_06-03-2013` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_sick_leave`
--
ALTER TABLE `terminated_employee_sick_leave`
  ADD CONSTRAINT `terminated_employee_sick_leave_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_status_transaction`
--
ALTER TABLE `terminated_employee_status_transaction`
  ADD CONSTRAINT `terminated_employee_status_transaction_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terminated_employee_training`
--
ALTER TABLE `terminated_employee_training`
  ADD CONSTRAINT `terminated_employee_training_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `department` (`Department`) ON UPDATE CASCADE,
  ADD CONSTRAINT `terminated_employee_training_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `terminated_employee_personal_record_06-03-2013` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_old`
--
ALTER TABLE `users_old`
  ADD CONSTRAINT `user_group` FOREIGN KEY (`Access_Level`) REFERENCES `thekey_group` (`group_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;
