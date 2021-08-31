-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2021 at 06:48 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms_mini_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `air_lab_server`
--

CREATE TABLE `air_lab_server` (
  `SNo` int(11) NOT NULL,
  `HD` varchar(20) DEFAULT NULL,
  `DVD` varchar(20) DEFAULT NULL,
  `RAM` varchar(20) DEFAULT NULL,
  `Processor` varchar(50) DEFAULT NULL,
  `Name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `air_lab_server`
--

INSERT INTO `air_lab_server` (`SNo`, `HD`, `DVD`, `RAM`, `Processor`, `Name`) VALUES
(1, '2*140 GB SCSI HDD', 'Dvd Writer', '2GB pc3200 DDR RAM', 'IBM Intel Xeon 3.0 GHz Processor', 'IBM SERVER'),
(2, '2*160 GB HDD', 'Dvd Writer', '4GB RAM DDR2', 'DELL POWER EDGE 2900 INTEL XEON-E5335 @2 GHz', 'DELL SERVER'),
(3, '1 TB HDD', NULL, '128G DDR4 RAM', 'Intel Xeon(R) silver 4108 CPU @1.80GHz*32', 'BOSTON'),
(4, '2 TB HDD', 'Dvd Drive', '32 GB RAM', 'Intel Xeon W2104 CPU @3.20GHz', 'GPU Workstation'),
(5, '1 TB HDD', 'Dvd Drive', '16 GB RAM', 'Intel Xeon E3 1240V3 2 3.40GHz', 'Workstaion-8 Nos'),
(6, '300 GB HDD', 'Dvd Drive', '16 GB RAM', 'HPE Server 2667 GHz Processor', 'HPE SERVER-2 Nos'),
(7, NULL, NULL, '96 GB DDR3 RAM', '2x Intel xeon@processor E52620 Rack Server', 'OPEN-V-4Nos'),
(8, 'dfafg', 'dsfgzfdghd dfhdfgh', 'srtrehgcn xssdfg', 'dfgsd', 'afsdg');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `Batch_No` int(11) NOT NULL,
  `Project_Title` varchar(50) DEFAULT NULL,
  `Company_ID` varchar(15) DEFAULT NULL,
  `Faculty_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`Batch_No`, `Project_Title`, `Company_ID`, `Faculty_ID`) VALUES
(1, 'Criminal Face Identification System', 'Comp01', 'PSG_CSE_01'),
(2, 'Personalised Food Recommendation Engine', 'Comp01', 'PSG_CSE_02'),
(3, 'Smart Toll Plaza with AI', 'Comp01', 'PSG_CSE_03'),
(4, 'Construe - A Sign Language Interpreter', 'Comp01', 'PSG_CSE_04'),
(5, 'Digital Asset Management System', 'Comp01', 'PSG_CSE_05'),
(6, 'Intelligent Student Companion', 'Comp01', 'PSG_CSE_06'),
(7, 'Review Oracle', 'Comp00', 'PSG_CSE_07'),
(8, 'Text Reading For Blind', 'Comp00', 'PSG_CSE_08'),
(9, 'Medical Secretary Bot', 'Comp00', 'PSG_CSE_09');

-- --------------------------------------------------------

--
-- Table structure for table `batch_students`
--

CREATE TABLE `batch_students` (
  `Batch_No` int(11) DEFAULT NULL,
  `Roll_No` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batch_students`
--

INSERT INTO `batch_students` (`Batch_No`, `Roll_No`) VALUES
(1, '16Z212'),
(1, '16Z213'),
(1, '16Z252'),
(1, '16Z259'),
(1, '16Z264'),
(2, '16Z225'),
(2, '16Z238'),
(2, '16Z257'),
(2, '16Z263'),
(2, '16Z265'),
(3, '16Z229'),
(3, '16Z237'),
(3, '16Z240'),
(3, '16Z262'),
(4, '16Z215'),
(4, '16Z235'),
(4, '16Z239'),
(4, '16Z244'),
(4, '17Z434'),
(5, '16Z203'),
(5, '16Z216'),
(5, '16Z227'),
(5, '16Z228'),
(5, '17Z434'),
(6, '16Z206'),
(6, '16Z210'),
(6, '16Z226'),
(6, '16Z251'),
(6, '16Z253'),
(7, '16Z333'),
(7, '16Z339'),
(7, '16Z315'),
(7, '16Z354'),
(7, '16Z334'),
(8, '16Z335'),
(8, '16Z306'),
(8, '16Z325'),
(8, '16Z361'),
(9, '16Z322'),
(9, '16Z311'),
(9, '16Z318'),
(9, '16Z321');

-- --------------------------------------------------------

--
-- Table structure for table `cloud_data_center`
--

CREATE TABLE `cloud_data_center` (
  `SNo` int(11) NOT NULL,
  `Component_Name` varchar(30) DEFAULT NULL,
  `Description` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cloud_data_center`
--

INSERT INTO `cloud_data_center` (`SNo`, `Component_Name`, `Description`) VALUES
(1, 'OpenStack related services', 'Nova,Glance,Neutron,Swift,MySQL,RabbitMQ'),
(2, 'Networking Device', '24 port Gigabyte switch'),
(3, 'Monitoring Device', 'KVM switch with cables / LCD monitor & keyboard'),
(4, 'Rack Enclosure', '2 x 24U with 5A power strips,monitor & keyboard trays');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `Company_id` varchar(10) NOT NULL,
  `Company_Name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_id`, `Company_Name`) VALUES
('Comp00', NULL),
('Comp01', 'Impiger Technologies'),
('Comp02', NULL),
('Comp03', NULL),
('Comp04', ''),
('Comp05', 'Impiger Technlogies'),
('Comp06', 'Impiger ');

-- --------------------------------------------------------

--
-- Table structure for table `concepts`
--

CREATE TABLE `concepts` (
  `C_No` varchar(10) NOT NULL,
  `C_Title` varchar(50) DEFAULT NULL,
  `C_Field` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `concepts`
--

INSERT INTO `concepts` (`C_No`, `C_Title`, `C_Field`) VALUES
('c_01', 'Artificial Intelligence', 'AI'),
('c_02', 'Block Chain', 'BC'),
('c_03', 'Cloud Computing', 'CC'),
('c_04', 'Evolutionary Computing', 'EC'),
('c_05', 'Machine Learning', 'ML'),
('c_06', 'Service Oriented Architecture', 'SOA'),
('c_07', 'Security', 'SEC'),
('c_08', 'Semantic Web Service Composition', 'SWSC');

-- --------------------------------------------------------

--
-- Table structure for table `concepts_research`
--

CREATE TABLE `concepts_research` (
  `SNo` int(11) DEFAULT NULL,
  `C_No` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `concepts_research`
--

INSERT INTO `concepts_research` (`SNo`, `C_No`) VALUES
(1, 'c_01'),
(1, 'c_03'),
(1, 'c_05'),
(1, 'c_06'),
(1, 'c_08'),
(2, 'c_05'),
(2, 'c_06'),
(2, 'c_08'),
(3, 'c_05'),
(3, 'c_04'),
(4, 'c_05'),
(4, 'c_01'),
(4, 'c_03'),
(4, 'c_06'),
(4, 'c_08'),
(5, 'c_01'),
(5, 'c_03'),
(5, 'c_05'),
(5, 'c_06'),
(5, 'c_08'),
(6, 'c_03'),
(6, 'c_07'),
(7, 'c_03'),
(7, 'c_02'),
(7, 'c_07'),
(8, 'c_03'),
(8, 'c_05'),
(9, 'c_02'),
(9, 'c_05'),
(9, 'c_06'),
(9, 'c_08'),
(10, 'c_02'),
(10, 'c_05'),
(10, 'c_06'),
(10, 'c_08'),
(11, 'c_02'),
(11, 'c_05'),
(NULL, 'c_01'),
(NULL, 'c_05'),
(NULL, 'c_07'),
(NULL, 'c_01'),
(NULL, 'c_05'),
(NULL, 'c_07'),
(NULL, 'c_08'),
(NULL, 'c_01'),
(NULL, 'c_05'),
(NULL, 'c_07'),
(NULL, 'c_08'),
(NULL, 'c_01'),
(NULL, 'c_05'),
(NULL, 'c_07'),
(NULL, 'c_08'),
(NULL, NULL),
(NULL, NULL),
(NULL, NULL),
(NULL, NULL),
(NULL, NULL),
(NULL, 'c_01'),
(NULL, 'c_05'),
(NULL, 'c_01'),
(NULL, 'c_05'),
(NULL, 'c_07'),
(NULL, 'c_01'),
(NULL, 'c_05'),
(NULL, 'c_07');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `Device_ID` varchar(15) NOT NULL,
  `Device_Name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`Device_ID`, `Device_Name`) VALUES
('D01', 'Bio Metric Device1'),
('D02', 'Bio Metric Device2'),
('D03', 'Face Reader Bala'),
('D04', 'Face Reader2'),
('D05', 'Face Reader3'),
('D06', 'Finger Scanner'),
('D07', 'EM Lock'),
('D08', 'Proximity card');

-- --------------------------------------------------------

--
-- Table structure for table `device_without_statistics`
--

CREATE TABLE `device_without_statistics` (
  `SNo` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Device_id` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `device_without_statistics`
--

INSERT INTO `device_without_statistics` (`SNo`, `Quantity`, `Device_id`) VALUES
(1, 1, 'D06'),
(2, 1, 'D07'),
(3, 150, 'D08');

-- --------------------------------------------------------

--
-- Table structure for table `device_with_statistics`
--

CREATE TABLE `device_with_statistics` (
  `Device_ID` varchar(15) DEFAULT NULL,
  `F_ID` varchar(15) DEFAULT NULL,
  `No_of_Users` int(11) DEFAULT NULL,
  `Logs` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `device_with_statistics`
--

INSERT INTO `device_with_statistics` (`Device_ID`, `F_ID`, `No_of_Users`, `Logs`) VALUES
('D01', 'F_2', 10000, '100000'),
('D01', 'F_3', 10000, '100000'),
('D02', 'F_2', 50000, '200000'),
('D02', 'F_3', 50000, '200000'),
('D03', 'F_1', 1000, '80000'),
('D03', 'F_2', 100, '10'),
('D03', 'F_3', 1000, '80000'),
('D04', 'F_1', 2000, '100000'),
('D04', 'F_2', 1500, '100000'),
('D04', 'F_3', 2000, '100000'),
('D05', 'F_1', 3000, '100000'),
('D05', 'F_2', 4000, '100000'),
('D05', 'F_3', 10000, '100000');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `Faculty_id` varchar(10) NOT NULL,
  `Faculty_Name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Faculty_id`, `Faculty_Name`) VALUES
('PSG_CSE_01', 'Dr.G.R.Karpagam'),
('PSG_CSE_02', 'Dr.J.UmaMaheswari'),
('PSG_CSE_03', 'Ms.R.Thirumahal'),
('PSG_CSE_04', 'Ms.S.Vijayalakshmi'),
('PSG_CSE_05', 'MS.J.Swathi'),
('PSG_CSE_06', 'Mr.J.Prakash'),
('PSG_CSE_07', 'Mr.R.Engels'),
('PSG_CSE_08', 'Mr.R.Marx'),
('PSG_CSE_09', 'Ms.J.Bineesha'),
('PSG_CSE_11', 'Ms.A.Bhuvaneswari'),
('PSG_CSE_12', 'Ms.S.Maheswari QoS'),
('PSG_CSE_13', 'Mr.B.Vinothkumar'),
('PSG_CSE_14', 'Ms.S.Bhama'),
('PSG_CSE_15', 'Ms.S.N.Dhanbagiyam'),
('PSG_CSE_16', 'Ms.I.Devi'),
('PSG_CSE_17', 'Ms.Sridevi'),
('PSG_CSE_18', 'Ms.N.G.Swetha');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `F_ID` varchar(15) NOT NULL,
  `F_Name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`F_ID`, `F_Name`) VALUES
('F_1', 'Face'),
('F_2', 'Finger'),
('F_3', 'Card');

-- --------------------------------------------------------

--
-- Table structure for table `funds_generated`
--

CREATE TABLE `funds_generated` (
  `SNo` int(11) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `From_Year` int(11) DEFAULT NULL,
  `To_Year` int(11) DEFAULT NULL,
  `Grants_Received` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funds_generated`
--

INSERT INTO `funds_generated` (`SNo`, `Description`, `From_Year`, `To_Year`, `Grants_Received`) VALUES
(1, 'Center for Teaching and Experiencing Security Insfrastructure', 2019, 2019, '2.5 Lakhs'),
(2, 'PSG-Impiger Artificial Intelligence Research Laboratory(AIR)', 2019, 2019, '5 Lakhs'),
(3, 'Post Graduate Certificate in Data Analytics and Management in Bioinformatics', 2018, 2021, '90.5 Lakhs');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `SNo` int(11) NOT NULL,
  `name` varchar(125) DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `pass` varchar(125) DEFAULT NULL,
  `cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`SNo`, `name`, `email`, `pass`, `cat`) VALUES
(1, 'Admin', 'admin@gmail.com', 'bala123', 3),
(2, 'Student', 'student@gmail.com', 'nari123!@#', 1),
(3, 'Faculty', 'faculty@gmail.com', 'ashwin123', 2),
(4, 'PSGStudent', 'psgstudent@gmail.com', 'psg123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mou_details`
--

CREATE TABLE `mou_details` (
  `SNo` int(11) NOT NULL,
  `Outcome` varchar(100) DEFAULT NULL,
  `MoU_Signal_with` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mou_details`
--

INSERT INTO `mou_details` (`SNo`, `Outcome`, `MoU_Signal_with`) VALUES
(1, 'Modernization of Open Source Laboratory established in 2005 funded by Cognizant,Chennai,2006', 'PSG-TECH-Cognizant'),
(2, 'PSG-CORDYS Service Oriented Achitecture Laboratory funded by Cordys,Hyderabad,2008', 'PSG-TECH-Cordys'),
(3, 'PSG-CORDYS Cloud computing Laboratory funded by Cordys,Coimbatore,2010', 'PSG-TECH-Cordys'),
(4, 'PSG-Imiger Artificial Intelligence Research Laboratory,2018', 'PSG-TECH-Impiger');

-- --------------------------------------------------------

--
-- Table structure for table `private_cloud`
--

CREATE TABLE `private_cloud` (
  `SNo` int(11) NOT NULL,
  `Cloud_Type` varchar(25) DEFAULT NULL,
  `Capabilities` varchar(150) DEFAULT NULL,
  `Iaas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `private_cloud`
--

INSERT INTO `private_cloud` (`SNo`, `Cloud_Type`, `Capabilities`, `Iaas`) VALUES
(1, 'Infrastructure Standard', 'Provisioning of OS level instances & applicatons thereof', 'Tier 2'),
(2, 'CPU vCores for compute', 'In a hyperthread enabled environment(KVM,in our instance),the available VCPUs depend on the actual cores x Y cores x 2', '24'),
(3, 'Total vCores available', 'Effective cores per VCPU(as can be inferred from available vCores', '56'),
(4, 'RAM for compute', 'Minimum of 2GB per VM scaling upto 16GB per instance', '32GB'),
(5, 'Total RAM available', 'Sharable across the instances', '64GB'),
(6, 'Block Storage', 'Storage for VMs or instances', '6TB Redundant');

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `SNo` int(11) NOT NULL,
  `Faculty_id` varchar(10) DEFAULT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`SNo`, `Faculty_id`, `Title`, `Status`) VALUES
(1, 'PSG_CSE_11', 'Enhancing Ontology Driven Web Service Composition', 'Completed'),
(2, 'PSG_CSE_12', 'Based Semantic Web Service Selection', 'Completed'),
(3, 'PSG_CSE_13', 'Evolutionary Algorithms For Quantization Table Optimization', 'Completed'),
(4, 'PSG_CSE_02', 'Self Organizing Agent Based Architecture For Semantic Web Service Discovery In Cloud', 'Completed'),
(5, 'PSG_CSE_14', 'AI Powered QoS Based Architecture For Semantic Web Service Discovery', 'Completed'),
(6, 'PSG_CSE_15', 'Identity And Access Management As A Service In Cloud', 'Completed'),
(7, 'PSG_CSE_04', 'Blockchain Based Secured Electronic Voting', 'Completed'),
(8, 'PSG_CSE_16', 'VM Scheduling', 'IN PROGRESS'),
(9, 'PSG_CSE_17', 'Semantic Web Service Composition', 'IN PROGRESS'),
(10, 'PSG_CSE_18', 'Semantic Web Service Composition', 'IN PROGRESS'),
(11, 'PSG_CSE_05', 'Disease Predection And Privacy Preservation For Smart Healthcare', 'IN PROGRESS');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Roll_Number` varchar(7) DEFAULT NULL,
  `Student_Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Roll_Number`, `Student_Name`) VALUES
('16Z212', 'BOOMA K K'),
('16Z213', 'DHANA SRI NITHI S'),
('16Z252', 'SOUNDARYA R'),
('16Z259', 'THAMIZHI S I'),
('16Z264', 'SWETHA M'),
('16Z225', 'HIMASHINEE V'),
('16Z238', 'PAPITHA D'),
('16Z257', 'SWATHI M'),
('16Z263', 'DRISHYA SAJEEV NAIR'),
('16Z265', 'ADHISINDHA U'),
('16Z229', 'KIRAN SURYA SENGODAN'),
('16Z237', 'PADHMANATHAN R'),
('16Z240', 'PRANEETH R'),
('16Z262', 'DAVANAM S VENKATA HARSHITH'),
('16Z215', 'DINESH A'),
('16Z235', 'NEELESH A'),
('16Z239', 'PARUL MATHUR'),
('16Z244', 'RAMIREDDY RAJ KUMAR REDDY'),
('17Z431', 'ABRAR AHAMED M'),
('16Z203', 'AJAY VIGNESH A B'),
('16Z216', 'DINESH KUMAR J'),
('16Z227', 'KARTHIKEYAN L'),
('16Z228', 'KARUNAKARAN S'),
('17Z434', 'TAMIL SELVAN AS'),
('16Z206', 'ARIJITH C VAGISH'),
('16Z210', 'BHARATH KUMAR M'),
('16Z251', 'SHYAM GANESH C R'),
('16Z253', 'SOURYA PEDDINA'),
('16Z333', 'PALANI BHARATHI M'),
('16Z339', 'RAHUL S'),
('16Z315', 'GAVIMATAM HARSHITH SAI'),
('16Z354', 'SUJJAD AHMED SALARIA'),
('16Z334', 'PAVITRA KRISHNA A G'),
('16Z335', 'PREMASWATI V'),
('16Z306', 'ANITHA S'),
('16Z325', 'KALPANA R'),
('16Z361', 'YANAMALA UMASAHTHI REDDY'),
('16Z322', 'JENNIFER VINTA J'),
('16Z311', 'CHANDNI SATHISH KUMAR'),
('16Z318', 'HARSHINI SURYA S M'),
('16Z321', 'JEEVA B'),
('16Z226', 'JACOB J ABRAHAM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `air_lab_server`
--
ALTER TABLE `air_lab_server`
  ADD PRIMARY KEY (`SNo`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`Batch_No`),
  ADD KEY `Company_ID` (`Company_ID`),
  ADD KEY `Faculty_ID` (`Faculty_ID`);

--
-- Indexes for table `batch_students`
--
ALTER TABLE `batch_students`
  ADD KEY `Batch_No` (`Batch_No`);

--
-- Indexes for table `cloud_data_center`
--
ALTER TABLE `cloud_data_center`
  ADD PRIMARY KEY (`SNo`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Company_id`);

--
-- Indexes for table `concepts`
--
ALTER TABLE `concepts`
  ADD PRIMARY KEY (`C_No`);

--
-- Indexes for table `concepts_research`
--
ALTER TABLE `concepts_research`
  ADD KEY `SNo` (`SNo`),
  ADD KEY `C_No` (`C_No`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`Device_ID`);

--
-- Indexes for table `device_without_statistics`
--
ALTER TABLE `device_without_statistics`
  ADD PRIMARY KEY (`SNo`),
  ADD KEY `FK_8` (`Device_id`);

--
-- Indexes for table `device_with_statistics`
--
ALTER TABLE `device_with_statistics`
  ADD KEY `FK_6` (`Device_ID`),
  ADD KEY `FK_7` (`F_ID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`Faculty_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`F_ID`);

--
-- Indexes for table `funds_generated`
--
ALTER TABLE `funds_generated`
  ADD PRIMARY KEY (`SNo`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`SNo`);

--
-- Indexes for table `mou_details`
--
ALTER TABLE `mou_details`
  ADD PRIMARY KEY (`SNo`);

--
-- Indexes for table `private_cloud`
--
ALTER TABLE `private_cloud`
  ADD PRIMARY KEY (`SNo`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`SNo`),
  ADD KEY `FK_4` (`Faculty_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `SNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_ibfk_1` FOREIGN KEY (`Company_ID`) REFERENCES `company` (`Company_id`),
  ADD CONSTRAINT `batches_ibfk_2` FOREIGN KEY (`Faculty_ID`) REFERENCES `faculty` (`Faculty_id`);

--
-- Constraints for table `batch_students`
--
ALTER TABLE `batch_students`
  ADD CONSTRAINT `batch_students_ibfk_1` FOREIGN KEY (`Batch_No`) REFERENCES `batches` (`Batch_No`);

--
-- Constraints for table `concepts_research`
--
ALTER TABLE `concepts_research`
  ADD CONSTRAINT `concepts_research_ibfk_1` FOREIGN KEY (`SNo`) REFERENCES `research` (`SNo`),
  ADD CONSTRAINT `concepts_research_ibfk_2` FOREIGN KEY (`C_No`) REFERENCES `concepts` (`C_No`);

--
-- Constraints for table `device_without_statistics`
--
ALTER TABLE `device_without_statistics`
  ADD CONSTRAINT `FK_8` FOREIGN KEY (`Device_id`) REFERENCES `devices` (`Device_ID`);

--
-- Constraints for table `device_with_statistics`
--
ALTER TABLE `device_with_statistics`
  ADD CONSTRAINT `FK_6` FOREIGN KEY (`Device_ID`) REFERENCES `devices` (`Device_ID`),
  ADD CONSTRAINT `FK_7` FOREIGN KEY (`F_ID`) REFERENCES `features` (`F_ID`);

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `FK_4` FOREIGN KEY (`Faculty_id`) REFERENCES `faculty` (`Faculty_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
