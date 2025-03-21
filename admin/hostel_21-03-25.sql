-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 08:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'anuj.lpu1@gmail.com', 'Test@1234', '2016-04-04 20:31:45', '2016-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `block_type` varchar(255) DEFAULT NULL,
  `block_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `block_type`, `block_name`, `created_at`) VALUES
(1, 'Male', 'South', '2025-03-21 10:12:01'),
(2, 'Male', 'North', '2025-03-21 10:12:06'),
(3, 'Female', 'A', '2025-03-21 10:12:09'),
(4, 'Female', 'B', '2025-03-21 10:12:13'),
(5, 'Female', 'C', '2025-03-21 10:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `course_sn` varchar(255) DEFAULT NULL,
  `course_fn` varchar(255) DEFAULT NULL,
  `posting_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_sn`, `course_fn`, `posting_date`) VALUES
(1, 'B10992', 'B.Tech', 'Bachelor  of Technology', '2016-04-11 19:31:42'),
(2, 'BCOM1453', 'B.Com', 'Bachelor Of commerce ', '2016-04-11 19:32:46'),
(3, 'BSC12', 'BSC', 'Bachelor  of Science', '2016-04-11 19:33:23'),
(4, 'BC36356', 'BCA', 'Bachelor Of Computer Application', '2016-04-11 19:34:18'),
(5, 'MCA565', 'MCA', 'Master of Computer Application', '2016-04-11 19:34:40'),
(6, 'MBA75', 'MBA', 'Master of Business Administration', '2016-04-11 19:34:59'),
(7, 'BE765', 'BE', 'Bachelor of Engineering', '2016-04-11 19:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `bn_name`) VALUES
(1, 'Comilla', 'কুমিল্লা'),
(2, 'Feni', 'ফেনী'),
(3, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া'),
(4, 'Rangamati', 'রাঙ্গামাটি'),
(5, 'Noakhali', 'নোয়াখালী'),
(6, 'Chandpur', 'চাঁদপুর'),
(7, 'Lakshmipur', 'লক্ষ্মীপুর'),
(8, 'Chattogram', 'চট্টগ্রাম'),
(9, 'Coxsbazar', 'কক্সবাজার'),
(10, 'Khagrachhari', 'খাগড়াছড়ি'),
(11, 'Bandarban', 'বান্দরবান'),
(12, 'Sirajganj', 'সিরাজগঞ্জ'),
(13, 'Pabna', 'পাবনা'),
(14, 'Bogura', 'বগুড়া'),
(15, 'Rajshahi', 'রাজশাহী'),
(16, 'Natore', 'নাটোর'),
(17, 'Joypurhat', 'জয়পুরহাট'),
(18, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ'),
(19, 'Naogaon', 'নওগাঁ'),
(20, 'Jashore', 'যশোর'),
(21, 'Satkhira', 'সাতক্ষীরা'),
(22, 'Meherpur', 'মেহেরপুর'),
(23, 'Narail', 'নড়াইল'),
(24, 'Chuadanga', 'চুয়াডাঙ্গা'),
(25, 'Kushtia', 'কুষ্টিয়া'),
(26, 'Magura', 'মাগুরা'),
(27, 'Khulna', 'খুলনা'),
(28, 'Bagerhat', 'বাগেরহাট'),
(29, 'Jhenaidah', 'ঝিনাইদহ'),
(30, 'Jhalakathi', 'ঝালকাঠি'),
(31, 'Patuakhali', 'পটুয়াখালী'),
(32, 'Pirojpur', 'পিরোজপুর'),
(33, 'Barisal', 'বরিশাল'),
(34, 'Bhola', 'ভোলা'),
(35, 'Barguna', 'বরগুনা'),
(36, 'Sylhet', 'সিলেট'),
(37, 'Moulvibazar', 'মৌলভীবাজার'),
(38, 'Habiganj', 'হবিগঞ্জ'),
(39, 'Sunamganj', 'সুনামগঞ্জ'),
(40, 'Narsingdi', 'নরসিংদী'),
(41, 'Gazipur', 'গাজীপুর'),
(42, 'Shariatpur', 'শরীয়তপুর'),
(43, 'Narayanganj', 'নারায়ণগঞ্জ'),
(44, 'Tangail', 'টাঙ্গাইল'),
(45, 'Kishoreganj', 'কিশোরগঞ্জ'),
(46, 'Manikganj', 'মানিকগঞ্জ'),
(47, 'Dhaka', 'ঢাকা'),
(48, 'Munshiganj', 'মুন্সিগঞ্জ'),
(49, 'Rajbari', 'রাজবাড়ী'),
(50, 'Madaripur', 'মাদারীপুর'),
(51, 'Gopalganj', 'গোপালগঞ্জ'),
(52, 'Faridpur', 'ফরিদপুর'),
(53, 'Panchagarh', 'পঞ্চগড়'),
(54, 'Dinajpur', 'দিনাজপুর'),
(55, 'Lalmonirhat', 'লালমনিরহাট'),
(56, 'Nilphamari', 'নীলফামারী'),
(57, 'Gaibandha', 'গাইবান্ধা'),
(58, 'Thakurgaon', 'ঠাকুরগাঁও'),
(59, 'Rangpur', 'রংপুর'),
(60, 'Kurigram', 'কুড়িগ্রাম'),
(61, 'Sherpur', 'শেরপুর'),
(62, 'Mymensingh', 'ময়মনসিংহ'),
(63, 'Jamalpur', 'জামালপুর'),
(64, 'Netrokona', 'নেত্রকোণা');

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id` int(11) NOT NULL,
  `hall_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `hall_name`, `created_at`) VALUES
(1, 'Test asd asd', '2025-03-21 09:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `roomno` int(11) DEFAULT NULL,
  `seater` int(11) DEFAULT NULL,
  `feespm` int(11) DEFAULT NULL,
  `foodstatus` int(11) DEFAULT NULL,
  `stayfrom` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `course` varchar(500) DEFAULT NULL,
  `regno` int(11) DEFAULT NULL,
  `firstName` varchar(500) DEFAULT NULL,
  `middleName` varchar(500) DEFAULT NULL,
  `lastName` varchar(500) DEFAULT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `emailid` varchar(500) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `egycontactno` bigint(11) DEFAULT NULL,
  `guardianName` varchar(500) DEFAULT NULL,
  `guardianRelation` varchar(500) DEFAULT NULL,
  `guardianContactno` bigint(11) DEFAULT NULL,
  `corresAddress` varchar(500) DEFAULT NULL,
  `corresCIty` varchar(500) DEFAULT NULL,
  `corresState` varchar(500) DEFAULT NULL,
  `corresPincode` int(11) DEFAULT NULL,
  `pmntAddress` varchar(500) DEFAULT NULL,
  `pmntCity` varchar(500) DEFAULT NULL,
  `pmnatetState` varchar(500) DEFAULT NULL,
  `pmntPincode` int(11) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(500) DEFAULT NULL,
  `corresDistrict` varchar(500) DEFAULT NULL,
  `pmnatetDistrict` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `roomno`, `seater`, `feespm`, `foodstatus`, `stayfrom`, `duration`, `course`, `regno`, `firstName`, `middleName`, `lastName`, `gender`, `contactno`, `emailid`, `profile_picture`, `egycontactno`, `guardianName`, `guardianRelation`, `guardianContactno`, `corresAddress`, `corresCIty`, `corresState`, `corresPincode`, `pmntAddress`, `pmntCity`, `pmnatetState`, `pmntPincode`, `postingDate`, `updationDate`, `corresDistrict`, `pmnatetDistrict`) VALUES
(6, 100, 5, 8000, 0, '2016-04-22', 5, 'Bachelor  of Technology', 10806121, 'Anuj', '', 'kumar', 'male', 8285703354, 'anuj.lpu1@gmail.com', NULL, 0, 'XYZ', 'Mother', 8285703354, 'New Delhi India', 'Aligarh', 'Uttar Pradesh', 202001, 'New Delhi India', 'Delhi', 'Delhi (NCT)', 202001, '2016-04-16 08:24:09', '', NULL, NULL),
(7, 100, 5, 8000, 1, '2016-06-17', 4, 'Bachelor of Engineering', 108061211, 'Test', 'test', 'kumar', 'male', 8467067344, 'test@gmail.com', NULL, 123456789, 'test', 'test', 1236547890, 'New Delhi India', 'Aligarh', 'Uttar Pradesh', 202001, 'New Delhi India', 'Delhi', 'Delhi (NCT)', 202001, '2016-06-23 11:54:35', '', NULL, NULL),
(8, 112, 3, 4000, 0, '2016-06-27', 5, 'Bachelor  of Science', 102355, 'rahul', 'kumar', 'Singh', 'male', 6786786786, 'rahul@gmail.com', NULL, 789632587, 'demo', 'demo', 1234567890, 'New Delhi', 'Delhi', 'Delhi (NCT)', 110001, 'New Delhi', 'Delhi', 'Delhi (NCT)', 110001, '2016-06-26 16:31:08', '', NULL, NULL),
(9, 132, 5, 2000, 1, '2016-06-28', 6, 'Bachelor of Engineering', 586952, 'Ajay', '', 'kumar', 'male', 8596185625, 'ajay@gmail.com', NULL, 8285703354, 'demo', 'demo', 8285703354, 'New Delhi India', 'Aligarh', 'Uttar Pradesh', 202001, 'New Delhi India', 'Delhi', 'Delhi (NCT)', 202001, '2016-06-26 16:40:07', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `hall_id` int(11) DEFAULT NULL,
  `block_id` int(11) DEFAULT NULL,
  `seater` int(11) DEFAULT NULL,
  `room_no` int(11) DEFAULT NULL,
  `fees` int(11) DEFAULT NULL,
  `posting_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hall_id`, `block_id`, `seater`, `room_no`, `fees`, `posting_date`) VALUES
(1, NULL, NULL, 5, 100, 8000, '2016-04-11 22:45:43'),
(2, NULL, NULL, 2, 201, 6000, '2016-04-12 01:30:47'),
(3, NULL, NULL, 2, 200, 6000, '2016-04-12 01:30:58'),
(4, NULL, NULL, 3, 112, 4000, '2016-04-12 01:31:07'),
(5, NULL, NULL, 5, 132, 2000, '2016-04-12 01:31:15'),
(6, NULL, NULL, 3, 503, 123, '2025-03-21 11:07:46'),
(7, 1, 2, 2, 2324, 4, '2025-03-21 11:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `State` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `State`) VALUES
(1, 'Andaman and Nicobar Island (UT)'),
(2, 'Andhra Pradesh'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(5, 'Bihar'),
(6, 'Chandigarh (UT)'),
(7, 'Chhattisgarh'),
(8, 'Dadra and Nagar Haveli (UT)'),
(9, 'Daman and Diu (UT)'),
(10, 'Delhi (NCT)'),
(11, 'Goa'),
(12, 'Gujarat'),
(13, 'Haryana'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(16, 'Jharkhand'),
(17, 'Karnataka'),
(18, 'Kerala'),
(19, 'Lakshadweep (UT)'),
(20, 'Madhya Pradesh'),
(21, 'Maharashtra'),
(22, 'Manipur'),
(23, 'Meghalaya'),
(24, 'Mizoram'),
(25, 'Nagaland'),
(26, 'Odisha'),
(27, 'Puducherry (UT)'),
(28, 'Punjab'),
(29, 'Rajastha'),
(30, 'Sikkim'),
(31, 'Tamil Nadu'),
(32, 'Telangana'),
(33, 'Tripura'),
(34, 'Uttarakhand'),
(35, 'Uttar Pradesh'),
(36, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `city`, `country`, `loginTime`) VALUES
(1, 10, 'test@gmail.com', '', '', '', '2016-06-22 06:16:42'),
(2, 10, 'test@gmail.com', '', '', '', '2016-06-24 11:20:28'),
(4, 10, 'test@gmail.com', 0x3a3a31, '', '', '2016-06-24 11:22:47'),
(5, 10, 'test@gmail.com', 0x3a3a31, '', '', '2016-06-26 15:37:40'),
(6, 20, 'ajay@gmail.com', 0x3a3a31, '', '', '2016-06-26 16:40:57'),
(7, 10, 'test@gmail.com', 0x3a3a31, '', '', '2019-06-10 05:02:51'),
(8, 10, 'test@gmail.com', 0x3a3a31, '', '', '2019-06-10 05:49:42'),
(9, 10, 'test@gmail.com', 0x3a3a31, '', '', '2019-06-10 07:17:32'),
(10, 10, 'test@gmail.com', 0x3a3a31, '', '', '2019-06-10 08:08:59'),
(11, 10, 'test@gmail.com', 0x3a3a31, '', '', '2025-03-13 17:01:57'),
(12, 10, 'test@gmail.com', 0x3a3a31, '', '', '2025-03-13 17:35:02'),
(13, 10, 'test@gmail.com', 0x3a3a31, '', '', '2025-03-13 17:44:56'),
(14, 10, 'test@gmail.com', 0x3a3a31, '', '', '2025-03-21 05:49:24'),
(15, 10, 'test@gmail.com', 0x3a3a31, '', '', '2025-03-21 09:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `regNo` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `contactNo` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL,
  `updationDate` varchar(45) DEFAULT NULL,
  `passUdateDate` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `regNo`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `district_id`, `password`, `regDate`, `profile_picture`, `updationDate`, `passUdateDate`) VALUES
(10, '108061211', 'Test', 'test', 'kumar', 'male', 1234567890, 'test@gmail.com', NULL, 'Test@123', '2016-06-22 04:21:33', '1742539264_morskie-oko-tatry.jpg', '21-03-2025 12:11:04', NULL),
(19, '102355', 'rahul', 'kumar', 'Singh', 'male', 6786786786, 'rahul@gmail.com', NULL, '6786786786', '2016-06-26 16:33:36', NULL, '', ''),
(20, '586952', 'Ajay', '', 'kumar', 'male', 8596185625, 'ajay@gmail.com', NULL, '8596185625', '2016-06-26 16:40:07', NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_no` (`room_no`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;
