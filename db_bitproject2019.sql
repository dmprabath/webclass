-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2019 at 07:20 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bitproject2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE `tbl_batch` (
  `bat_id` char(8) NOT NULL,
  `grn_id` int(11) NOT NULL,
  `prod_id` char(7) NOT NULL,
  `bat_sprice` float NOT NULL,
  `bat_cprice` float NOT NULL,
  `bat_qty` int(11) NOT NULL,
  `bat_qty_rem` int(11) NOT NULL,
  `bat_rdate` date NOT NULL,
  `bat_edate` date NOT NULL,
  `bat_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`bat_id`, `grn_id`, `prod_id`, `bat_sprice`, `bat_cprice`, `bat_qty`, `bat_qty_rem`, `bat_rdate`, `bat_edate`, `bat_status`) VALUES
('BAT00001', 1, 'PRO0006', 220, 200, 20, 10, '2019-09-04', '2019-09-17', 1),
('BAT00002', 1, 'PRO0005', 320, 300, 10, 5, '2019-09-04', '2019-09-25', 1),
('BAT00003', 2, 'PRO0005', 150, 200, 1000, 120, '2019-09-04', '2019-09-18', 1),
('BAT00004', 3, 'PRO0003', 150, 100, 500, 500, '2019-10-02', '2019-10-17', 1),
('BAT00005', 3, 'PRO0005', 250, 600, 600, 600, '2019-10-02', '2019-10-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` char(6) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_desc` varchar(100) NOT NULL,
  `cat_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_desc`, `cat_status`) VALUES
('CAT001', 'Biscuits', 'Biscuits Products', 1),
('CAT002', 'Shampoo', 'Sunsilk, shampoo', 1),
('CAT003', 'Soap', 'Laundary and bathing soap', 1),
('CAT004', 'Rice', 'rice products', 1),
('CAT005', 'Tea', 'Ceyloan tea', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` char(8) NOT NULL,
  `emp_title` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_gender` int(11) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_mobile` char(12) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_nic` varchar(12) NOT NULL,
  `emp_doj` date NOT NULL,
  `emp_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `emp_title`, `emp_name`, `emp_dob`, `emp_gender`, `emp_address`, `emp_mobile`, `emp_email`, `emp_nic`, `emp_doj`, `emp_status`) VALUES
('EMP00001', 1, 'Lahiru chamara', '1995-04-11', 1, 'No.183,Mahayaya road ,Beliatta', '0712208520', 'mahiru1995@gmail.com', '951023299V', '2012-02-15', 1),
('EMP00002', 1, 'DMP Lakshitha', '1995-02-03', 1, 'School rd,Beliatta', '0712346578', 'lakshitha@gmail.com', '956723456V', '2014-02-13', 0),
('EMP00003', 1, 'Udara Shakthi', '1997-06-14', 1, 'Seruwila,Trincomalee', '0773456789', 'udaras@gmail.com', '973465922V', '2016-05-17', 1),
('EMP00004', 1, 'Miron Nishmika', '1997-06-18', 1, 'Kaduwela,Colombo', '0712345679', 'mironnis@gmail.com', '972345786V', '2018-12-12', 1),
('EMP00005', 1, 'Shahen Fernando', '1995-08-18', 0, 'Rathmalana,Colombo', '0762345687', 'shahenfer@live.com', '953467896V', '2009-03-13', 1),
('EMP00006', 1, 'Tharindu Dananjaya', '1995-09-16', 1, 'Darmapala Mw,Anuradapura', '0772345697', 'tarindanjya@live.com', '956734599V', '2014-08-20', 1),
('EMP00007', 2, 'Sachini Nirmali', '1997-09-17', 0, 'Kadana road, Gampaha', '0719723487', 'sachnir@yahoo.com', '975693456V', '2016-06-12', 1),
('EMP00008', 2, 'Vindya Ranathunga', '1995-07-09', 0, 'Main Road, Ranala', '0774569326', 'vindyaran@gmail.com', '953487299V', '2019-01-08', 1),
('EMP00009', 2, 'Malithi Kuruwitarachchi', '1996-08-10', 0, 'Temple Road, Kaduwela', '0773459245', 'malithikuru@gmail.com', '963456876V', '2018-09-19', 1),
('EMP00010', 2, 'Ravindya ridmi', '1997-03-13', 0, 'Mountan road,Walapane', '0752345756', 'ridmiravi@hotmail.com', '971254789V', '2010-11-08', 1),
('EMP00011', 2, 'Hiruni Dayawansa', '1997-11-11', 0, 'manik Mw,Rathnapura', '0723456789', 'hirudaya@yahoo.com', '972354234V', '2017-02-14', 1),
('EMP00012', 1, 'Tharindu Deeptha', '1994-09-10', 1, 'galle road,rathmalana', '0765423849', 'tharindud@hotmail.com', '941234654V', '2016-07-11', 1),
('EMP00013', 2, 'Jeniffer Iresha', '1997-01-06', 0, 'Gahata gahak mw,Moratuwa', '0712346598', 'ireshaj@hotmail.com', '972354167V', '2010-03-10', 1),
('EMP00014', 1, 'Nipuna ranathunga', '1997-10-25', 1, 'Lotus rd, Moratuwa', '0785467823', 'nipooo@ymail.com', '972378546V', '2013-06-08', 1),
('EMP00015', 2, 'kasun', '2001-07-11', 1, 'ss', '544', 'sss@ss.com', '925222', '2019-07-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn`
--

CREATE TABLE `tbl_grn` (
  `grn_id` int(11) NOT NULL,
  `sup_id` char(6) NOT NULL,
  `grn_rdate` date NOT NULL,
  `grn_gtotal` float NOT NULL,
  `grn_discount` float NOT NULL,
  `grn_ntotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grn`
--

INSERT INTO `tbl_grn` (`grn_id`, `sup_id`, `grn_rdate`, `grn_gtotal`, `grn_discount`, `grn_ntotal`) VALUES
(1, 'SUP003', '2019-09-04', 5000, 0, 5000),
(2, 'SUP002', '2019-09-04', 2000, 0, 2000),
(3, 'SUP003', '2019-10-02', 410000, 0, 410000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `inv_id` char(16) NOT NULL,
  `inv_date` date NOT NULL,
  `inv_time` time NOT NULL,
  `inv_amount` float NOT NULL,
  `inv_discount` float NOT NULL,
  `inv_operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_details`
--

CREATE TABLE `tbl_invoice_details` (
  `inv_det_id` int(11) NOT NULL,
  `inv_id` char(16) NOT NULL,
  `prod_id` char(7) NOT NULL,
  `prod_price` float NOT NULL,
  `prod_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `prod_id` char(7) NOT NULL,
  `cat_id` char(6) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_desc` varchar(100) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_rlevel` int(11) NOT NULL,
  `prod_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`prod_id`, `cat_id`, `prod_name`, `prod_desc`, `prod_qty`, `prod_rlevel`, `prod_status`) VALUES
('PRO0001', 'CAT001', 'Chocolate Cream 100G', 'Chocolate Cream 100G packet', 0, 10, 1),
('PRO0002', 'CAT001', 'Cream Cracker 250G', 'Cream Cracker 250G pack', 0, 20, 1),
('PRO0003', 'CAT002', 'Sunsilk Egg  Protein 5ML', 'Sunsilk Egg  Protein 5ML packet', 500, 50, 1),
('PRO0004', 'CAT002', 'Lifeboy Men\'s Shampoo 5ML ', 'Lifeboy Men\'s Shampoo 5ML packet', 0, 10, 1),
('PRO0005', 'CAT003', 'Lux Rose Mediam', 'Lux Rose Mediam Soap', 620, 15, 1),
('PRO0006', 'CAT004', 'Nipuna samba 5KG', 'Nipuna samba 5KG pack', 10, 10, 1),
('PRO0007', 'CAT005', 'Dilma Tea 100g', 'Dilma Tea 100g packet', 0, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pro_images`
--

CREATE TABLE `tbl_pro_images` (
  `img_id` int(11) NOT NULL,
  `cat_id` char(6) NOT NULL,
  `pro_id` char(7) NOT NULL,
  `img_name` varchar(50) NOT NULL,
  `img_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pro_images`
--

INSERT INTO `tbl_pro_images` (`img_id`, `cat_id`, `pro_id`, `img_name`, `img_status`) VALUES
(1, 'CAT001', 'PRO0001', 'CAT001_PRO0001_1568353092.png', 1),
(2, 'CAT001', 'PRO0001', 'CAT001_PRO0001_1568353178.png', 1),
(3, 'CAT005', 'PRO0007', 'CAT005_PRO0007_1568353201.png', 1),
(4, 'CAT003', 'PRO0005', 'CAT003_PRO0005_1568779952.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `sup_id` char(6) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_contact` varchar(11) NOT NULL,
  `sup_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`sup_id`, `sup_name`, `sup_contact`, `sup_status`) VALUES
('SUP001', 'Malibhan  Biscuit (pvt) td', '011-4567894', 1),
('SUP002', 'Uniliver Sri lanka (pvt) ltd.', '011-8529456', 1),
('SUP003', 'Nipuna Sahal (Pvt) ltd', '037-1345678', 1),
('SUP004', 'Dilma Tea (pvt) ltd', '011-8945685', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `usr_name` varchar(25) NOT NULL,
  `usr_pass` varchar(50) NOT NULL,
  `usr_type` tinyint(4) NOT NULL,
  `usr_status` tinyint(4) NOT NULL,
  `pwd_reset` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`usr_name`, `usr_pass`, `usr_type`, `usr_status`, `pwd_reset`) VALUES
('admin', '202cb962ac59075b964b07152d234b70', 1, 1, 0),
('hirudaya@yahoo.com', '8e12b0089468a05e3fb206afeb1e36b8', 3, 1, 0),
('lakshitha@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 0, 0),
('mahiru1995@gmail.com', '4fe693b846579f5afa0bb6aaf83f5eab', 1, 0, 1),
('malithikuru@gmail.com', '0030273ec88cca54d18d78fa60d4db26', 2, 0, 1),
('mironnis@gmail.com', 'd3835a509829130a0e70b4e85cde05d9', 3, 1, 1),
('sachnir@yahoo.com', '6466fa20d406adf8e4a6461df5536caf', 2, 1, 1),
('shahenfer@live.com', '8e12b0089468a05e3fb206afeb1e36b8', 1, 0, 0),
('tarindanjya@live.com', '250cf8b51c773f3f8dc8b4be867a9a02', 1, 1, 1),
('udaras@gmail.com', 'ebb3568cc3257be7bc2ac835dc76b208', 3, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD PRIMARY KEY (`bat_id`),
  ADD KEY `fk_prod` (`prod_id`),
  ADD KEY `fk_grn` (`grn_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD PRIMARY KEY (`grn_id`),
  ADD KEY `fk_sup` (`sup_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  ADD PRIMARY KEY (`inv_det_id`),
  ADD KEY `fk_inv` (`inv_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `fk_cat` (`cat_id`);

--
-- Indexes for table `tbl_pro_images`
--
ALTER TABLE `tbl_pro_images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_cat_id` (`cat_id`),
  ADD KEY `img_pro_id` (`pro_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`usr_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  MODIFY `inv_det_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pro_images`
--
ALTER TABLE `tbl_pro_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD CONSTRAINT `fk_grn` FOREIGN KEY (`grn_id`) REFERENCES `tbl_grn` (`grn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prod` FOREIGN KEY (`prod_id`) REFERENCES `tbl_product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD CONSTRAINT `fk_sup` FOREIGN KEY (`sup_id`) REFERENCES `tbl_supplier` (`sup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  ADD CONSTRAINT `fk_inv` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pro_images`
--
ALTER TABLE `tbl_pro_images`
  ADD CONSTRAINT `img_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `img_pro_id` FOREIGN KEY (`pro_id`) REFERENCES `tbl_product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
