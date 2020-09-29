-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2020 at 05:01 PM
-- Server version: 10.3.24-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ownworkbd_daa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appoint`
--

CREATE TABLE `tbl_appoint` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `shift_id` text NOT NULL,
  `date` text NOT NULL,
  `serial` text NOT NULL,
  `in_queue` tinyint(1) NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_appoint`
--

INSERT INTO `tbl_appoint` (`id`, `doctor_id`, `patient_id`, `shift_id`, `date`, `serial`, `in_queue`, `note`, `status`) VALUES
(1, 37, 22, '', '7-9-2020', '1', 0, '', 1),
(2, 37, 22, '', '19-9-2020', '1', 0, '', 1),
(3, 37, 29, '', '19-9-2020', '2', 0, '', 1),
(4, 31, 37, '', '25-9-2020', '1', 0, '', 0),
(5, 31, 22, '', '25-9-2020', '2', 0, '', 0),
(25, 41, 29, '', '26-9-2020', '1', 0, '', 0),
(24, 31, 29, '', '25-9-2020', '5', 0, '', 0),
(8, 37, 22, '', '25-9-2020', '2', 1, '', 0),
(9, 37, 37, '', '25-9-2020', '3', 1, '', 0),
(22, 27, 1, '', '26-9-2020', '1', 0, '', 0),
(21, 31, 39, '', '25-9-2020', '4', 0, '', 0),
(20, 31, 38, '', '25-9-2020', '3', 0, '', 0),
(19, 37, 38, '', '25-9-2020', '4', 0, '', 0),
(18, 27, 29, '', '25-9-2020', '1', 0, '', 0),
(17, 37, 29, '', '25-9-2020', '3', 0, '', 0),
(23, 37, 1, '', '26-9-2020', '1', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appoint_tele`
--

CREATE TABLE `tbl_appoint_tele` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `shift_id` text NOT NULL,
  `date` text NOT NULL,
  `serial` text NOT NULL,
  `in_queue` tinyint(1) NOT NULL,
  `note` text NOT NULL,
  `whatsapp_number` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_appoint_tele`
--

INSERT INTO `tbl_appoint_tele` (`id`, `doctor_id`, `patient_id`, `shift_id`, `date`, `serial`, `in_queue`, `note`, `whatsapp_number`, `status`) VALUES
(1, 41, 1, '', '12-9-2020', '1', 0, '', '01679636311', 0),
(2, 41, 1, '', '7-9-2020', '1', 0, '', '01679636311', 0),
(3, 41, 22, '', '7-9-2020', '2', 0, '', '01852901177', 0),
(4, 41, 22, '', '9-9-2020', '1', 0, '', '01852901177', 0),
(5, 41, 22, '', '17-9-2020', '1', 1, '', '01852901177', 0),
(6, 41, 29, '', '17-9-2020', '2', 0, '', '01846576486', 1),
(7, 41, 22, '', '25-9-2020', '1', 0, '', '01852901177', 0),
(8, 45, 29, '', '25-9-2020', '1', 0, '', '01766701411', 0),
(9, 41, 29, '', '25-9-2020', '2', 0, '', '01766701411', 1),
(10, 41, 38, '', '25-9-2020', '3', 0, '', '01832249082', 0),
(11, 43, 38, '', '25-9-2020', '1', 0, '', '01846576486', 0),
(12, 45, 39, '', '25-9-2020', '2', 0, '', '01551622061', 0),
(13, 44, 29, '', '26-9-2020', '1', 0, '', '01846576486', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_day_limits`
--

CREATE TABLE `tbl_day_limits` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day` text NOT NULL,
  `patient_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_day_limits`
--

INSERT INTO `tbl_day_limits` (`id`, `doctor_id`, `day`, `patient_limit`) VALUES
(1, 37, 'sun', 20),
(2, 37, 'mon', 20),
(3, 37, 'tue', 20),
(4, 37, 'wed', 20),
(5, 37, 'sat', 20),
(6, 27, 'sat', 20),
(7, 27, 'sun', 20),
(8, 27, 'mon', 20),
(9, 27, 'tue', 20),
(10, 27, 'fri', 20),
(11, 34, 'sat', 20),
(12, 34, 'sun', 20),
(13, 34, 'mon', 20),
(14, 34, 'tue', 20),
(15, 34, 'wed', 20),
(16, 34, 'thu', 20),
(17, 29, 'thu', 20),
(18, 29, 'fri', 20),
(19, 31, 'sat', 20),
(20, 31, 'sun', 20),
(21, 31, 'mon', 20),
(22, 31, 'tue', 20),
(23, 31, 'thu', 20),
(24, 31, 'fri', 20),
(25, 39, 'sat', 20),
(26, 39, 'sun', 20),
(27, 39, 'mon', 20),
(28, 39, 'tue', 20),
(29, 39, 'wed', 20),
(30, 39, 'thu', 20),
(31, 40, 'sat', 20),
(32, 40, 'tue', 20),
(33, 40, 'wed', 20),
(34, 41, 'sat', 20),
(35, 41, 'sun', 20),
(36, 41, 'mon', 20),
(37, 41, 'tue', 20),
(38, 41, 'wed', 20),
(39, 41, 'thu', 20),
(40, 42, 'sun', 20),
(41, 42, 'mon', 20),
(42, 42, 'tue', 20),
(43, 42, 'wed', 20),
(44, 42, 'thu', 20),
(45, 37, 'fri', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_day_limits_tele`
--

CREATE TABLE `tbl_day_limits_tele` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day` text NOT NULL,
  `patient_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_day_limits_tele`
--

INSERT INTO `tbl_day_limits_tele` (`id`, `doctor_id`, `day`, `patient_limit`) VALUES
(1, 41, 'sat', 20),
(2, 41, 'mon', 10),
(3, 41, 'sun', 20),
(4, 41, 'tue', 20),
(5, 41, 'wed', 20),
(6, 41, 'thu', 20),
(7, 41, 'fri', 20),
(8, 43, 'sat', 20),
(9, 43, 'sun', 20),
(10, 43, 'mon', 20),
(11, 43, 'tue', 20),
(12, 43, 'wed', 20),
(13, 43, 'thu', 20),
(14, 43, 'fri', 20),
(15, 44, 'sat', 20),
(16, 44, 'sun', 20),
(17, 45, 'sat', 30),
(18, 45, 'mon', 30),
(19, 45, 'thu', 30),
(20, 45, 'fri', 30),
(21, 46, 'sun', 30),
(22, 46, 'mon', 35),
(23, 46, 'thu', 30),
(24, 47, 'tue', 30),
(25, 47, 'wed', 30),
(26, 47, 'thu', 30),
(27, 47, 'thu', 30),
(28, 48, 'sat', 30),
(29, 48, 'mon', 30),
(30, 48, 'wed', 30),
(31, 48, 'thu', 30),
(32, 49, 'sat', 20),
(33, 49, 'sun', 20),
(34, 49, 'thu', 20),
(35, 50, 'sun', 30),
(36, 50, 'tue', 30),
(37, 50, 'thu', 30),
(38, 51, 'sat', 20),
(39, 51, 'mon', 20),
(40, 51, 'thu', 20),
(41, 52, 'sat', 20),
(42, 52, 'mon', 20),
(43, 52, 'tue', 20),
(44, 53, 'sun', 20),
(45, 53, 'mon', 20),
(46, 53, 'thu', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor`
--

CREATE TABLE `tbl_doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `msisdn` text NOT NULL,
  `details` text NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_doctor`
--

INSERT INTO `tbl_doctor` (`id`, `name`, `email`, `password`, `image`, `msisdn`, `details`, `specialty_id`, `status`) VALUES
(37, 'Dr. Soela Sahnaz', 'soela@gmail.com', '123456', 'images/photo-1584432810601-6c7f27d2362b.jpg', '01918374610', 'MBBS, FCPS (Obs and Gynae) Gynae and Obstetrics Visiting Day: Saturday- Wednesday, Friday; Visiting Hour: 3 PM- 6 PM Room No: 315 Hospital: CSCR Hospital Chittagong fee: 700 Advance bkash: 300', 19, 1),
(27, 'Dr. Sabrina Meher', 'sabrinameher@gmail.com', '123456', 'images/photo-1584432810601-6c7f27d2362b.jpg', '01823455062', 'Speciality: Gynae and ObstetricsDegree: DGO , FCPS (Gynae and Obs); Visiting Day: Saturday -Tuesday, Friday; Visiting Hour: 5 PM; Room No: 422', 19, 1),
(34, 'Dr. Md. Abu Taslim', 'abutaslim@gmail.com', '123456', 'images/young-doctor-16088825.jpg', '0187363534', 'Degree: MBBS, FCPS Speciality: Physical Medicine & Rehabilitation Visiting Day: Saturday - Thursday Visiting Hour:7 PM - 10 PM Room No: 326  Appointment Time: 8:00 AM - 9:00 PM', 15, 1),
(29, 'Dr. Masihuzzaman (Alpha)', 'mashuizzaman@gmail.com', '123456', 'images/unnamed.png', '01755019576', 'Specialty: Medicine and Neuromedicine; Degree: MBBS, MCPS(Medicine), MD( Neuromedicine); Visiting Day: Thursday- Friday; Visiting Hour: 4 PM; Room No: 223; Hospital: CSCR Hospital,Chittagong', 20, 1),
(31, 'Dr. Mohammad Nasir Uddin', 'nasir@gmail.com', '123456', 'images/demo_image.jpg', '01857920606', 'Speciality: MedicineDegree: MBBS, MCPS (Medicine), FCPS (Medicine); Visiting Day: Thursday - Tuesday, Friday; Visiting Hour: 7 PM - 10 PM, 6 PM - 10 PM; Room No: 418; Hospital: CSCR Hospital,Chittagong', 21, 1),
(39, 'Dr. Md. Fazle Maruf', 'fazle@gmail.com', '123456', 'images/young-doctor-16088825.jpg', '01628345123', 'MBBS, MS (CV & TS)Cardiologist; Visiting Day: Saturday- Thursday; Visiting Hour: 5 PM- 7 PM; Room No: 317 Hospital: CSCR Hospital Chittagong fee: 1000tk Advance bkash: 500', 23, 1),
(40, 'Dr. Mohammad Akram Hossain', 'akram@gmail.com', '123456', 'images/unnamed.png', '0189389347', 'MBBS, MPH, D-Card, Diploma Asthma (IPCRG â€“ UK)Cardiology, Asthma Specialist Visiting Day: Saturday, Tuesday, Wednesday; Visiting Hour: 05.00 PM-9:00 PM; Hospital: CSCR Hospital Chittagong; fee: 1000tk; Advance bkash: 500tk', 23, 1),
(41, 'Professor Dr. Md. Iftekhar Hossain Khan', 'iftekhar@gmail.com', '123456', 'images/young-doctor-16088825.jpg', '01893892451', 'MBBS, MD (endocrinology and metabolism); Visiting Day: Saturday-Thursday; Visiting Hour: 11 AM-1 PM; Room No 410; Hospital: CSCR Hospital Chittagong; Fee: 800tk; Advance bkash: 400tk', 24, 1),
(42, 'Professor Dr. Wazir Ahmed', 'wazir@gmail.com', '123456', 'images/unnamed.png', '0189389246', 'Degree: MBBS (CU), DCH (DU), FRCP (Glasgow), Visiting Day: Sunday - Thursday, Visiting Hour: 5 PM - 10 PM, Room No: 302; Hospital: CSCR Hospital Chittagong. fee: 1000tk Advance bkash: 500tk', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor_tele`
--

CREATE TABLE `tbl_doctor_tele` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `msisdn` text NOT NULL,
  `details` text NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `pres_header` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_doctor_tele`
--

INSERT INTO `tbl_doctor_tele` (`id`, `name`, `email`, `password`, `image`, `msisdn`, `details`, `specialty_id`, `status`, `pres_header`) VALUES
(41, 'DR Afroz Jahan Aurin', 'aurin@gmail.com', '123456', 'images/photo-1584432810601-6c7f27d2362b.jpg', '01852901166', 'Medical officer(Ultra,Diabetes, Gynecology Specialist);Fees: 300tk;Appointment Day: Saturday-Friday', 19, 1, ' Medical officer(Ultra,Diabetes, Gynecology Specialist)'),
(42, 'Dr. Sanjida Rezwana', 'sanjida@gmail.com', '123456', 'images/photo-1584432810601-6c7f27d2362b.jpg', '01893892471', 'Medical officer(Gynecologist)MBBS, PGTFees: 200tk;Appointment Day: Saturday,Monday,Friday', 19, 1, 'Medical officer(Gynecologist)MBBS'),
(43, 'Dr. Abishek Vodro', 'abishek@gmail.com', '123456', 'images/unnamed.png', '01965234812', 'MBBS, MPH, PGT; Fees: 300tk; Appointment Day: Saturday-Friday', 22, 1, 'MBBS, MPH, PGT'),
(44, 'Dr. Mohammed Imranul Hoque', 'imranul@gmail.com', '123456', 'images/unnamed.png', '01627383562', 'Medical Officer, MBBS, BCS, FCPS(Medicine), Fees: 300tk; Appointment Day: Saturday- Friday', 22, 1, 'Medical Officer, MBBS, BCS, FCPS(Medicine)'),
(45, 'Dr Farzana Afros', 'farzana@gmail.com', '123456', 'images/photo-1584432810601-6c7f27d2362b.jpg', '01893892651', 'Assistant Register(Medicine), Ahmed Forces Medical collage, Dhaka', 23, 1, 'Assistant Register(Medicine), Ahmed Forces Medical collage, Dhaka'),
(46, 'Dr Abdullah-Al-Mahmud', 'abdul@gmail.com', '123456', '', '01817389247', 'Medical Officer, MBBS,BCS; \nFees:200tk\n', 23, 1, ''),
(47, 'Abu Yousuf Md Shahidul Alam', 'yousuf@gmail.com', '123456', 'images/unnamed.png', '01627389247', 'Associate professor; Medicine & Cardiology, Popular Diagnostic Centre Ltd, Bogra; Fees: 600tk', 24, 1, 'Associate professor; Medicine & Cardiology, Popular Diagnostic Centre Ltd, Bogra'),
(48, 'Dr Assaduzzaman Sadi', 'sadi@gmail.com', '123456', 'images/young-doctor-16088825.jpg', '01639389247', 'SMO.NHFH&RI(General practitioner),Cardiology; Fees: 300tk', 24, 1, 'SMO.NHFH&RI(General practitioner),Cardiology'),
(49, 'Dr MD Sohel Rana', 'sohel@gmail.com', '123456', 'images/young-doctor-16088825.jpg', '01828681223', 'Dental surgeon(Oral & Maxillofacial Surgery); Fees:300tk', 25, 1, 'Dental surgeon(Oral & Maxillofacial Surgery)'),
(50, 'Dilshad Jahan', 'dilshad@gmail.com', '123456', '', '01838923547', 'Consultant(Public Health, Dental Surgery)\nFees: 400tk', 25, 1, ''),
(51, 'Dr Parash Ullah', 'parash@gmail.com', '123456', '', '01893809247', 'OSD, Deputation in DMCH(Gastroenterology),MBBS;Fees: 500tk', 26, 1, 'OSD, Deputation in DMCH(Gastroenterology),MBBS'),
(52, 'Dr Shaima Rahman', 'shaima@gmail.com', '123456', '', '01893892478', 'MBBS(Gastroenterology)Fees: 250tk', 26, 1, 'MBBS(Gastroenterology)'),
(53, 'Dr. M. M. Saqlain', 'saqlain@gmail.com', '123456', '', '01853753342', 'MBBS(RU),MPH,CCD(BIRDEM)Fees:200tk', 27, 1, 'MBBS(RU),MPH,CCD(BIRDEM)'),
(54, 'Dr.Mostafa Habib', 'habib@gmail.com', '123456', '', '01982145956', 'MBBS(DU),CMU,CCD(Diabetes)\nFees:300tk', 27, 1, ''),
(55, 'Ahmed imtiazur rahman', 'imtiaz@gmail.com', '123456', '', '01843889247', 'MBBS(sust)(child medicine),PGT\nFees:500tk', 28, 1, ''),
(56, 'Dr. Sukanta Dey', 'sukanta@gmail.com', '123456', '', '01943851309', 'Resident(Medical Officer), MBBS\nFees: 300tk', 28, 1, ''),
(57, 'Dr. Kaushik Roy', 'kaushik@gmail.com', '123456', '', '01852501256', 'MBBS,DCH(Child specialist)\nFees:300tk', 29, 1, ''),
(58, 'Dr Khondaker Mobasher', 'khondaker@gmail.com', '123456', '', '01627343541', 'MBBS, BCS, FCPS(Child specialist)\nFees: 500tk', 29, 1, ''),
(59, 'Dr Mahmudul Hasan', 'mahmudul@gmail.com', '123456', '', '01815026075', 'Medical officer(Nutrition specialist)\nFees:200tk', 30, 1, ''),
(60, 'Mohammad Khan', 'mohammad@gmail.com', '123456', '', '01654297854', 'Nutritionist/Dietitian\nFees:1000tk', 30, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hospital`
--

CREATE TABLE `tbl_hospital` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hospital`
--

INSERT INTO `tbl_hospital` (`id`, `name`, `details`) VALUES
(2, 'BNSB', 'Category: General Hospital\nAddress: Pahartali, Chittagong\nPhone : +880-31-659019, 659018'),
(3, 'C.S.C.R', 'Category: General Hospital\nAddress: Probortak Circle, Chittagong\nPhone : +880-31-2550625-9'),
(4, 'Centre Point Hospital (Pvt)Ltd.', 'Category: General Hospital\nAddress: 100, Momin Road, Chittagong\nPhone : +88 031 639025-7'),
(5, 'Chattagram Maa-Shishu General Hospital', 'Category: Child Health & Mother Care Hospital\nAddress: Agrabad, Chittagong\nPhone : +880-31-2520063, 711236, 718521, 718525\nFax : +880-31-2525409\nEmail: cmosh@globalctg.net, cmosh@techno-bd.net\nWeb: http://www.maa-shishu-ctg.org');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `msisdn` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `gender` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`id`, `name`, `msisdn`, `age`, `email`, `address`, `password`, `gender`) VALUES
(1, 'Robiul Alam', '01679636311', 27, 'robi3443@gmail.com', 'Rahaman nagar R/a, East nasirabad, Chittagong.', '12345', 'Male'),
(18, 'Mazharul Alam', '01876626011', 12, 'asd@asd.asd', 'gdag', 'asd', 'Male'),
(21, 'Zubrein', '01679636312', 27, 'zubrein@gmail.com', 'Chittagong', '123456', 'Male'),
(22, 'Farhana kamal', '01852901177', 20, 'abc@g.c', 'Chittagong', '123456', 'Female'),
(28, 'farha', '12346678988', 20, 'demo_email', 'Hathazari', '12345', 'Female'),
(23, 'Shamik jahan', '01815519215', 45, 'shamim@jahan.com', 'Rahmannagar', '123', 'Female'),
(25, 'farha', '01828681221', 21, 'farhana@gmail.com', 'quaish', '12345', 'Female'),
(27, 'Sajin', '01627383861', 21, 'sanjana_yahoo.com', 'quaish', 'sanjana', 'Female'),
(29, 'nipa', '01846576486', 22, 'demo_email', 'raojan', '12345', 'Female'),
(30, 'subrina', '01817751583', 33, 'demo_email', 'ctg', '12345', 'Female'),
(31, 'shamima', '01816234584', 30, 'demo_email', 'dhaka', '12345', 'Female'),
(32, 'priya', '015629497', 25, 'demo_email', 'Burischar', '12345', 'Female'),
(33, 'abc', '01111111111', 12, 'demo_email', 'asbd', 'qweryy', 'Male'),
(34, '0284u', '01852901221', 0, 'demo_email', 'quaish', '123456', 'Female'),
(35, '123', '01017751583', 0, 'demo_email', 'quash;#:', '12345', 'Female'),
(36, 'odhfdna1', '01852901577', 19, 'demo_email', 'quaish', '12345', 'Female'),
(37, 'Tasnim', '01766701411', 23, 'demo_email', 'Raojan', '123456', 'Female'),
(38, 'Tuhin', '01832249082', 24, 'demo_email', 'Raojan', '12345', 'Female'),
(39, 'Tazin', '01551622061', 20, 'demo_email', 'Quaish', '12345', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plasma_donor`
--

CREATE TABLE `tbl_plasma_donor` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `blood_group` text NOT NULL,
  `contact_number` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_plasma_donor`
--

INSERT INTO `tbl_plasma_donor` (`id`, `patient_id`, `blood_group`, `contact_number`, `status`, `city`) VALUES
(4, 1, 'O+', '01679636311', 0, 'Chattogram'),
(5, 22, 'O+', '01852901177', 0, 'Chattogram'),
(6, 30, 'A+', '01817751583', 0, 'Dhaka'),
(7, 29, 'O+', '01846576486', 0, 'Dhaka'),
(8, 39, 'B+', '01551622061', 0, 'Chattogram');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription`
--

CREATE TABLE `tbl_prescription` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `prescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prescription`
--

INSERT INTO `tbl_prescription` (`id`, `appointment_id`, `prescription`) VALUES
(1, 5, 'You are fired');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_report`
--

INSERT INTO `tbl_report` (`id`, `appointment_id`, `image`, `date`) VALUES
(2, 2, '202009071017131615088209.jpg', '2020-09-07 10:17:13'),
(4, 2, '20200907101717596812216.jpg', '2020-09-07 10:17:17'),
(5, 3, '202009071030291159801505.jpg', '2020-09-07 10:30:29'),
(7, 1, '202009081042081022982179.jpg', '2020-09-08 10:42:08'),
(8, 4, '202009081118191099478424.jpg', '2020-09-08 11:18:24'),
(9, 5, '202009190547321348766896.jpg', '2020-09-19 05:47:40'),
(10, 8, '202009241541091415294146.jpg', '2020-09-24 15:41:09'),
(11, 10, '20200924181641975781843.jpg', '2020-09-24 18:16:45'),
(12, 10, '202009241816451208756707.jpg', '2020-09-24 18:16:45'),
(13, 10, '202009241916342077883717.jpg', '2020-09-24 19:16:36'),
(14, 8, '20200925074157325464824.jpg', '2020-09-25 07:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day` text NOT NULL,
  `start_time` text NOT NULL,
  `end_time` text NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `doctor_id`, `day`, `start_time`, `end_time`, `note`, `status`) VALUES
(1, 37, 'sat', '15:00', '18:00', '', 0),
(2, 37, 'sun', '15:00', '18:00', '', 0),
(3, 37, 'mon', '15:00', '18:00', '', 0),
(4, 37, 'tue', '15:00', '18:00', '', 0),
(5, 37, 'wed', '15:00', '18:00', '', 0),
(6, 27, 'sat', '17:00', '22:00', '', 0),
(51, 27, 'fri', '17:00', '', '', 0),
(50, 27, 'tue', '17:00', '', '', 0),
(49, 27, 'mon', '17:00', '', '', 0),
(48, 27, 'sun', '17:00', '', '', 0),
(11, 34, 'sat', '19:00', '22:00', '', 0),
(12, 34, 'sun', '19:00', '22:00', '', 0),
(13, 34, 'mon', '19:00', '22:00', '', 0),
(14, 34, 'tue', '19:00', '22:00', '', 0),
(15, 34, 'wed', '19:00', '22:00', '', 0),
(16, 34, 'thu', '19:00', '22:00', '', 0),
(47, 37, 'fri', '15:00', '18:00', '', 0),
(19, 31, 'thu', '19:00', '22:00', '', 0),
(20, 31, 'fri', '18:00', '22:00', '', 0),
(21, 31, 'sat', '19:00', '22:00', '', 0),
(22, 31, 'sun', '19:00', '22:00', '', 0),
(23, 31, 'mon', '19:00', '22:00', '', 0),
(24, 31, 'tue', '19:00', '22:00', '', 0),
(25, 39, 'sat', '17:00', '19:00', '', 0),
(26, 0, 'sun', '17:00', '19:00', '', 0),
(27, 0, 'sat', '17:00', '19:00', '', 0),
(28, 39, 'sun', '17:00', '19:00', '', 0),
(29, 39, 'mon', '17:00', '19:00', '', 0),
(30, 39, 'tue', '17:00', '19:00', '', 0),
(31, 39, 'wed', '17:00', '19:00', '', 0),
(32, 39, 'thu', '17:00', '19:00', '', 0),
(33, 40, 'sat', '17:00', '21:00', '', 0),
(34, 40, 'tue', '17:00', '21:00', '', 0),
(35, 40, 'wed', '17:00', '21:00', '', 0),
(36, 41, 'sat', '11:00', '13:00', '', 0),
(37, 41, 'sun', '11:00', '13:00', '', 0),
(38, 41, 'mon', '11:00', '13:00', '', 0),
(39, 41, 'tue', '11:00', '13:00', '', 0),
(40, 41, 'wed', '11:00', '13:00', '', 0),
(41, 41, 'thu', '11:00', '13:00', '', 0),
(42, 42, 'sun', '17:00', '22:00', '', 0),
(43, 42, 'mon', '17:00', '22:00', '', 0),
(44, 42, 'tue', '17:00', '22:00', '', 0),
(45, 42, 'wed', '17:00', '22:00', '', 0),
(46, 42, 'thu', '17:00', '22:00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_tele`
--

CREATE TABLE `tbl_schedule_tele` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day` text NOT NULL,
  `start_time` text NOT NULL,
  `end_time` text NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schedule_tele`
--

INSERT INTO `tbl_schedule_tele` (`id`, `doctor_id`, `day`, `start_time`, `end_time`, `note`, `status`) VALUES
(1, 41, 'sat', '10:00', '16:00', '', 0),
(2, 41, 'mon', '10:00', '16:00', '', 0),
(3, 41, 'sun', '10:00', '22:00', '', 0),
(4, 41, 'tue', '10:00', '22:00', '', 0),
(5, 41, 'wed', '10:00', '22:00', '', 0),
(6, 41, 'thu', '10:00', '22:00', '', 0),
(8, 41, 'fri', '10:00', '22:00', '', 0),
(9, 42, 'sat', '09:00', '23:00', '', 0),
(10, 42, 'mon', '09:00', '23:00', '', 0),
(11, 42, 'fri', '09:00', '23:00', '', 0),
(12, 43, 'sat', '08:00', '23:00', '', 0),
(13, 43, 'sun', '08:00', '23:00', '', 0),
(14, 43, 'mon', '08:00', '23:00', '', 0),
(15, 43, 'tue', '08:00', '23:00', '', 0),
(16, 43, 'wed', '08:00', '23:00', '', 0),
(17, 43, 'thu', '08:00', '23:00', '', 0),
(18, 43, 'fri', '08:00', '23:00', '', 0),
(19, 44, 'sat', '09:00', '23:00', '', 0),
(20, 44, 'sun', '09:00', '23:00', '', 0),
(21, 45, 'sat', '08:00', '23:00', '', 0),
(22, 45, 'mon', '08:00', '00:00', '', 0),
(23, 45, 'thu', '08:00', '23:00', '', 0),
(24, 45, 'fri', '08:00', '23:00', '', 0),
(25, 46, 'sun', '08:00', '23:00', '', 0),
(26, 46, 'mon', '08:00', '00:00', '', 0),
(27, 46, 'thu', '08:00', '23:00', '', 0),
(28, 47, 'tue', '08:00', '00:00', '', 0),
(29, 47, 'wed', '08:00', '23:00', '', 0),
(30, 47, 'thu', '08:00', '00:00', '', 0),
(31, 48, 'sat', '08:00', '23:00', '', 0),
(32, 48, 'mon', '08:00', '00:00', '', 0),
(33, 48, 'wed', '08:00', '23:00', '', 0),
(34, 48, 'thu', '09:00', '23:00', '', 0),
(35, 49, 'sat', '08:00', '23:00', '', 0),
(36, 49, 'sun', '08:00', '23:00', '', 0),
(37, 49, 'thu', '08:00', '23:00', '', 0),
(38, 50, 'sun', '08:00', '22:00', '', 0),
(39, 50, 'tue', '08:00', '23:00', '', 0),
(40, 50, 'thu', '08:00', '23:00', '', 0),
(41, 51, 'sat', '08:00', '23:00', '', 0),
(42, 51, 'mon', '09:00', '23:00', '', 0),
(43, 51, 'thu', '08:00', '23:00', '', 0),
(44, 52, 'sat', '08:00', '23:00', '', 0),
(45, 52, 'mon', '09:00', '23:00', '', 0),
(46, 52, 'tue', '08:00', '23:00', '', 0),
(47, 53, 'sun', '08:00', '23:00', '', 0),
(48, 53, 'mon', '09:00', '23:00', '', 0),
(49, 53, 'thu', '08:00', '23:00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_specialty`
--

CREATE TABLE `tbl_specialty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_specialty`
--

INSERT INTO `tbl_specialty` (`id`, `name`) VALUES
(19, 'Gynae and Obstetrics'),
(20, 'Medicine and Neuromedicine'),
(15, 'Physical Medicine & Rehabilitation'),
(21, 'Medicine'),
(23, 'Cardiology'),
(24, 'Diabetes and Hormones'),
(25, ' Child Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_specialty_tele`
--

CREATE TABLE `tbl_specialty_tele` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_specialty_tele`
--

INSERT INTO `tbl_specialty_tele` (`id`, `name`) VALUES
(19, 'Gynae and Obstetrics'),
(22, 'Medicine'),
(23, 'Covid-19'),
(24, 'Cardiology'),
(25, 'Dentistry'),
(26, 'Gastroenterology'),
(27, 'Diabetes & Endocrinology'),
(28, 'General Physician'),
(29, 'Pediatrics'),
(30, 'Nutritionist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_appoint`
--
ALTER TABLE `tbl_appoint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_appoint_tele`
--
ALTER TABLE `tbl_appoint_tele`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_day_limits`
--
ALTER TABLE `tbl_day_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_day_limits_tele`
--
ALTER TABLE `tbl_day_limits_tele`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_doctor_tele`
--
ALTER TABLE `tbl_doctor_tele`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hospital`
--
ALTER TABLE `tbl_hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_plasma_donor`
--
ALTER TABLE `tbl_plasma_donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule_tele`
--
ALTER TABLE `tbl_schedule_tele`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_specialty`
--
ALTER TABLE `tbl_specialty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_specialty_tele`
--
ALTER TABLE `tbl_specialty_tele`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_appoint`
--
ALTER TABLE `tbl_appoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_appoint_tele`
--
ALTER TABLE `tbl_appoint_tele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_day_limits`
--
ALTER TABLE `tbl_day_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_day_limits_tele`
--
ALTER TABLE `tbl_day_limits_tele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_doctor_tele`
--
ALTER TABLE `tbl_doctor_tele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_hospital`
--
ALTER TABLE `tbl_hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_plasma_donor`
--
ALTER TABLE `tbl_plasma_donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_schedule_tele`
--
ALTER TABLE `tbl_schedule_tele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_specialty`
--
ALTER TABLE `tbl_specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_specialty_tele`
--
ALTER TABLE `tbl_specialty_tele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
