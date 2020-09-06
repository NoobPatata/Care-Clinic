-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2020 at 03:26 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `careclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `AppointmentID` int NOT NULL AUTO_INCREMENT,
  `LoginID` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Date` varchar(250) NOT NULL,
  `Time_Slot` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Doctor_Name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Medical_Concern` longtext NOT NULL,
  `Status` int NOT NULL,
  PRIMARY KEY (`AppointmentID`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentID`, `LoginID`, `Date`, `Time_Slot`, `Doctor_Name`, `Medical_Concern`, `Status`) VALUES
(122, '37', '2020-09-11', '1:30PM', 'Steven Lee', 'Consultation', 0),
(123, '34', '2020-09-04', '4:00PM', 'Alan Lim', 'Toothache', 1),
(120, '34', '2020-09-30', '1:00PM', 'Steven Lee', 'Braces Consultation', 0),
(119, '34', '2020-09-10', '4:00PM', 'Alan Lim', 'Dental Checkup', 0),
(118, '34', '2020-09-08', '3:00PM', 'Jun Young', 'Consultation', 0),
(117, '34', '2020-09-07', '1:00PM', 'Alan Lim', 'Toothache', 0),
(116, '34', '2020-09-03', '1:00PM', 'Alan Lim', 'Gum Bleeding', 1);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
CREATE TABLE IF NOT EXISTS `billing` (
  `BillID` int NOT NULL AUTO_INCREMENT,
  `PrescriptionID` int NOT NULL,
  `PatientID` int NOT NULL,
  `GrandTotal` decimal(10,2) NOT NULL,
  `AmountPaid` decimal(10,2) NOT NULL,
  `Balance` decimal(10,2) NOT NULL,
  `Status` int NOT NULL,
  PRIMARY KEY (`BillID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`BillID`, `PrescriptionID`, `PatientID`, `GrandTotal`, `AmountPaid`, `Balance`, `Status`) VALUES
(12, 37, 34, '90.00', '0.00', '0.00', 0),
(11, 36, 34, '90.00', '100.00', '10.00', 1),
(10, 35, 34, '10.00', '10.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicineandservices`
--

DROP TABLE IF EXISTS `medicineandservices`;
CREATE TABLE IF NOT EXISTS `medicineandservices` (
  `MS_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`MS_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medicineandservices`
--

INSERT INTO `medicineandservices` (`MS_ID`, `Name`, `Type`, `Price`) VALUES
(16, 'Tooth Removal', 'Service', '80.00'),
(17, 'Braces', 'Service', '3000.00'),
(19, 'Implant', 'Service', '1000.00'),
(20, 'X-ray', 'Service', '120.00'),
(21, 'Tylenol', 'Medicine', '10.00'),
(22, 'Painkiller', 'Medicine', '10.00'),
(23, 'Paracetamol', 'Medicine', '10.00'),
(24, 'Ibuprofen', 'Medicine', '10.00'),
(33, 'Scaling', 'Service', '120.00');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `PrescriptionID` int NOT NULL AUTO_INCREMENT,
  `PatientID` int NOT NULL,
  `DoctorID` int NOT NULL,
  `AppointmentID` int NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`PrescriptionID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`PrescriptionID`, `PatientID`, `DoctorID`, `AppointmentID`, `Remarks`) VALUES
(36, 34, 2, 34, 'brush your teeth'),
(35, 34, 2, 116, 'Take once a day'),
(37, 34, 2, 123, 'brush your teeth');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_details`
--

DROP TABLE IF EXISTS `prescription_details`;
CREATE TABLE IF NOT EXISTS `prescription_details` (
  `DetailsID` int NOT NULL AUTO_INCREMENT,
  `PrescriptionID` int NOT NULL,
  `MS_ID` int NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`DetailsID`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prescription_details`
--

INSERT INTO `prescription_details` (`DetailsID`, `PrescriptionID`, `MS_ID`, `Price`) VALUES
(56, 37, 22, '10.00'),
(55, 37, 16, '80.00'),
(54, 36, 22, '10.00'),
(53, 36, 16, '80.00'),
(52, 35, 22, '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

DROP TABLE IF EXISTS `timeslot`;
CREATE TABLE IF NOT EXISTS `timeslot` (
  `TimeID` int NOT NULL,
  `TimeSlot` varchar(250) NOT NULL,
  PRIMARY KEY (`TimeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`TimeID`, `TimeSlot`) VALUES
(1, '10:00AM'),
(2, '10:30AM'),
(3, '11:00AM'),
(4, '11:30AM'),
(5, '1:00PM'),
(6, '1:30PM'),
(7, '2:00PM'),
(8, '2:30PM'),
(9, '3:00PM'),
(10, '3:30PM'),
(11, '4:00PM'),
(12, '4:30PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `LoginID` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Gender` varchar(250) NOT NULL,
  `Date_of_Birth` varchar(250) NOT NULL,
  `Address` longtext NOT NULL,
  `Contact_Number` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Passwd` varchar(250) NOT NULL,
  `Remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `User` varchar(250) NOT NULL,
  `Status` int NOT NULL,
  PRIMARY KEY (`LoginID`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`LoginID`, `First_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Address`, `Contact_Number`, `Email`, `Passwd`, `Remark`, `User`, `Status`) VALUES
(2, 'Alan', 'Lim', 'Male', '11-11-1968', 'jalan jalan', '0132222233', 'alan@gmail.com', '$2y$10$muDT3di4KhRdfbP33.WTsuMbQFVyruKbfMBc4jK9PtGYqgHYmy/Wa', '', 'Doctor', 0),
(4, 'admin', 'admin', 'Female', '2020-11-11', '1212121', '01212212121', 'admin@gmail.com', '$2y$10$ywld8KAdMMRBbIVeyf0HOeKB8czUo94Ocu20zScEZ1XSl2tNJ/Ikq', '', 'Admin', 0),
(8, 'nurse', 'nurse', 'Male', '2020-02-03', 'address', '0192222222', 'nurse@gmail.com', '$2y$10$vunbqOq6k1m/kBYPIAaQ.exGGAw2IpIPRrwkVEJuISZsV./C9ZQ/m', '', 'Nurse', 1),
(35, 'Steven', 'Lee', 'Male', '1999-08-22', '2 jalan 1/86 Off Jalan Taman Seputeh 58000 Wilayah Persekutuan', '013868686', 'stevenlee@gmail.com', '$2y$10$6C./0eBImkEP4xvAq2c5a.S4wtUxsqKRdKul8Q4X9ckqDzy106G9C', '', 'Doctor', 0),
(34, 'Abu', 'Bakar', 'Male', '1999-08-22', 'Gerai Sementara Mdl 27 Jln Pandak Mayah Kuah Malaysia Langkawi Kedah 07000 Malaysia', '0132956683', 'abubakar@gmail.com', '$2y$10$xIW9ETvLF29hZ9.WUslo1eddCHX9gBCmk.IGG5.pQqOm2GH5qo/7G', 'none', 'Patient', 0),
(36, 'Brandon', 'Tan', 'Male', '2002-12-12', 'Lot 10669 Jalan Kuchai Lama 58200 Wilayah Persekutuan, KL10669', '0168588686', 'brandontan@gmail.com', '$2y$10$WapR8UYQh0Il6HBkxG5Ar.jowyXd.nRBIjUyQYL6ZvaZo5OWnQH5e', 'Allergic to paracetamol', 'Patient', 0),
(37, 'June', 'Wong', 'Female', '1994-08-22', '1 Blok B South City Apartment Psn Serdang Perdana Taman Serdang Perdana 43300 Seri Kembangan Seri Ke\r\n', '01256565656', 'junewong@gmail.com', '$2y$10$cp/MsFVg3ReMY8RHAfZth.pZNnbdyDVU3I5GMq32/zTmyLU2LLY1q', 'none', 'Patient', 0),
(38, 'John', 'Leong', 'Male', '1999-08-22', 'No.2, Lorong jaya,Taman Bukit ', '0132900388', 'john@gmail.com', '$2y$10$AD3XxktznIe.f1sJCqSk8ejeEg3Tum2IkTlvCc8XQwW5HSSXX1rq.', '', 'Nurse', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
