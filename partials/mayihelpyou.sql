-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 05:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mayihelpyou`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Siddharth Sarode', 'siddharthsarode279@gmail.com', 'Siddhu1234'),
(2, 'Gopal Sadavarte', 'gopalsadavarte555@gmail.com', 'grs2004311'),
(5, 'rakesh', 'rakesh@gmail.com', 'rakesh123'),
(6, 'Aniket', 'aniket@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(255) NOT NULL,
  `cate_create_at` timestamp NULL DEFAULT current_timestamp(),
  `cate_admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_name`, `cate_create_at`, `cate_admin_id`) VALUES
(1, 'Plumbing', '2024-02-27 09:27:07', 1),
(2, 'Cleaning', '2024-02-27 09:27:07', 1),
(3, 'Electrical', '2024-02-27 09:27:07', 1),
(4, 'Appliances Repairs\r\n', '2024-02-27 09:27:07', 1),
(5, 'Carpentry', '2024-02-27 09:27:07', 1),
(6, 'Emergency', '2024-04-15 05:24:03', 2),
(7, 'Painting', '2024-02-27 09:27:07', 2),
(8, 'Moving', '2024-02-27 09:27:07', 2),
(9, 'Landscaping & Gardening', '2024-02-27 09:27:07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category_employee`
--

CREATE TABLE `category_employee` (
  `category_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `emp_create_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_employee`
--

INSERT INTO `category_employee` (`category_id`, `employee_id`, `emp_create_at`) VALUES
(1, 30, '2024-04-14 14:57:16'),
(1, 31, '2024-04-15 04:39:52'),
(3, 31, '2024-04-15 04:40:06'),
(2, 30, '2024-04-15 04:40:14'),
(4, 30, '2024-04-15 04:40:32'),
(7, 32, '2024-04-15 04:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `con_id` int(11) NOT NULL,
  `con_user` varchar(255) NOT NULL,
  `con_email` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `con_create_at` timestamp NULL DEFAULT current_timestamp(),
  `con_user_id` int(11) DEFAULT NULL,
  `con_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`con_id`, `con_user`, `con_email`, `message`, `con_create_at`, `con_user_id`, `con_status`) VALUES
(1, 'Gopal Ravindra Sadavarte', 'gopalsadavarte555@gmail.com', 'i have requested to you,please give me service of carpentry', '2024-04-14 19:00:27', 23, 'Replied');

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE `duration` (
  `duration_id` int(11) NOT NULL,
  `duration_avg_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `duration`
--

INSERT INTO `duration` (`duration_id`, `duration_avg_time`) VALUES
(1, '30 min'),
(2, '45 min'),
(3, '1 hour'),
(4, '1 - 2 hours'),
(5, 'above 2 hours'),
(6, '1 day'),
(7, '1-2 day'),
(8, 'depending');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `emp_email` varchar(200) DEFAULT NULL,
  `emp_mobile_no` varchar(50) DEFAULT NULL,
  `emp_address` varchar(500) NOT NULL,
  `emp_age` int(11) NOT NULL,
  `adhar_card_no` varchar(50) NOT NULL,
  `pan_card_no` varchar(50) NOT NULL,
  `adhar_image` varchar(200) NOT NULL,
  `pan_card_image` varchar(200) NOT NULL,
  `emp_status` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `profile_picture` varchar(200) NOT NULL,
  `emp_admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_email`, `emp_mobile_no`, `emp_address`, `emp_age`, `adhar_card_no`, `pan_card_no`, `adhar_image`, `pan_card_image`, `emp_status`, `password`, `profile_picture`, `emp_admin_id`) VALUES
(30, 'Rakesh', 'rakesh@gmail.com', '6754321894', 'dalvi wasti,ward no.7,shrirampur', 23, '456789043212', 'REWQA4321H', '../img/adharCards/e_456789043212.jpg', '../img/panCards/f_REWQA4321H.jpg', 'Not Working', '672ace7f90561ed8cc445a4c30894d17', '../img/user/rakesh_456789043212.jpg', 2),
(31, 'Rohan', 'rohan@gmail.com', '7654321909', 'Dalvi nagar,nagar road,ahmednagar', 25, '326574438373', 'ERFSA1234T', '../img/adharCards/j_326574438373.jpg', '../img/panCards/b_ERFSA1234T.jpg', 'present', '41b046191358d2415a4bfd551656c061', '../img/user/rohan (2)_326574438373.jpg', 2),
(32, 'Aniket', 'aniket@gmail.com', '8999927968', 'Shrirampur ,Ahemed nagar', 19, '123456789018', 'ASGDT1234I', '../img/adharCards/gardon_123456789018.jpg', '../img/panCards/b_ASGDT1234I.jpg', 'new', '0bb774f7e12548d6382e3dbd663e021f', '../img/user/vinod_123456789018.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `customer_name` varchar(300) DEFAULT NULL,
  `customer_email` varchar(200) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `service_address` varchar(200) DEFAULT NULL,
  `order_service_id` int(11) DEFAULT NULL,
  `customer_city` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `customer_name`, `customer_email`, `contact_no`, `service_address`, `order_service_id`, `customer_city`) VALUES
(32, 'Gopal Ravindra Sadavarte', 'gopalsadavarte555@gmail.com', '8956434705', 'LAXMINAGAR,DALVI WASTI,WARD NO.7,SHRIRAMPUR-413709', 17, 'Ahmed Nagar'),
(33, 'Aniket', 'aniket1@gmail.com', '8999927968', 'pune Maharastra India svdhsg', 23, 'Pune');

-- --------------------------------------------------------

--
-- Table structure for table `order_to_order_details`
--

CREATE TABLE `order_to_order_details` (
  `ord_id` int(11) DEFAULT NULL,
  `ord_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_to_order_details`
--

INSERT INTO `order_to_order_details` (`ord_id`, `ord_details_id`) VALUES
(22, 32),
(23, 33);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(200) DEFAULT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `avg_duration` varchar(20) NOT NULL,
  `availability` varchar(50) NOT NULL DEFAULT 'yes',
  `service_create_at` timestamp NULL DEFAULT current_timestamp(),
  `image_path` text NOT NULL,
  `service_cate_id` int(11) DEFAULT NULL,
  `service_admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `price`, `avg_duration`, `availability`, `service_create_at`, `image_path`, `service_cate_id`, `service_admin_id`) VALUES
(1, 'Pipe Leak Repair', 'Professional repair of leaking pipes in residential and commercial properties. Includes identification of leaks, pipe replacement, and sealing.', 200, '1 hour', 'yes', '2024-04-12 07:57:41', 'img/services/01_p_PipeLeakRepair.jpg', 1, 2),
(2, 'Pipe Installation', 'Professional installation of pipes for water supply, drainage, or gas lines in residential and commercial properties. Includes assessment, selection of suitable materials, and precise installation.', 200, '1 - 2 hours', 'yes', '2024-04-12 08:44:10', 'img/services/02_p_PipeInstallation.jpg', 1, 2),
(11, 'Faucet Repair and Replacement', 'Repair and replacement of faulty faucets in kitchens, bathrooms, and utility areas. Addresses issues such as leaks, drips, and damaged components.', 200, '1 hour', 'yes', '2024-04-14 08:15:53', 'img/services/03_p_service_faucets_replacement.jpg', 1, 2),
(13, 'Toilet Repair', 'Repair and maintenance of malfunctioning toilets, including issues such as running toilets, clogged toilets, and flushing problems.', 100, '45 min', 'yes', '2024-04-12 08:42:25', 'img/services/04_p_ToiletRepair.jpg', 1, 2),
(14, 'Water Line Repair and Replacement', 'Repair and replacement of damaged or leaking water lines to restore water flow and prevent property damage. Utilizes trenchless technology for minimal disruption.', 100, '1 - 2 hours', 'yes', '2024-04-14 08:26:47', 'img/services/05_p_WaterLineRepairandReplacement.jpg', 1, 2),
(15, 'Electrical Wiring Repair', 'Repair of damaged or faulty electrical wiring to ensure safety and reliability. Addresses issues such as exposed wires, frayed insulation, and poor connections.', 200, '1 - 2 hours', 'Yes', '2024-04-12 14:16:12', 'img/services/01_e_Electrical Wiring Repair.jpg', 3, 2),
(16, 'Light Fixture Installation', 'Installation of indoor and outdoor light fixtures, including chandeliers, pendant lights, and wall sconces. Enhances ambiance and functionality.', 100, '1 hour', 'yes', '2024-04-12 14:42:21', 'img/services/02_e_LightFixture Installation_12-04-2404-42_PM.jpg', 3, 2),
(17, 'Outlet and Switch Replacement', 'Replacement of outdated or malfunctioning electrical outlets and switches. Ensures proper functionality and safety.', 100, '45 min', 'yes', '2024-02-28 12:21:50', 'img/services/03_e_ Outlet and Switch Replacement.jpg', 3, 1),
(18, 'Electrical Panel Upgrade', 'Upgrade of outdated or insufficient electrical panels to meet increased power demands and safety standards. Enhances electrical capacity and reliability.', 100, '1 - 2 hours', 'No', '2024-04-14 18:25:20', 'img/services/04_e_Electrical Panel Upgrade.jpg', 3, 2),
(19, 'Surge Protection Installation', 'Installation of surge protection devices to safeguard electrical appliances and devices from voltage spikes and surges. Provides added protection against damage from lightning strikes, power grid fluctuations, and other electrical disturbances.', 100, '1 hour', 'yes', '2024-02-28 12:21:50', 'img/services/05_e_Surge Protection Installation.jpg', 3, 1),
(20, 'Backup Generator Installation', 'Installation of backup generators to provide emergency power during outages. Ensures continued operation of essential electrical devices and appliances, such as refrigerators, sump pumps, and medical equipment.', 100, '1-2 day', 'yes', '2024-02-28 12:21:50', 'img/services/06_e_ Backup Generator Installation.jpg', 3, 1),
(21, 'Residential Cleaning', 'Thorough cleaning of residential properties including homes, apartments, and condos. Services may include dusting, vacuuming, mopping, bathroom and kitchen cleaning, and tidying up living spaces.\nPrice: Varies based on the size of the property and specific cleaning requirements.', 100, 'depending', 'yes', '2024-03-06 16:21:23', 'img/services/01_c_Residential Cleaning.jpg', 2, 1),
(22, 'Commercial Cleaning', 'Comprehensive cleaning services tailored for commercial properties such as offices, retail stores, and warehouses. Includes general cleaning, floor care, restroom sanitation, and trash removal.', 100, 'depending', 'yes', '2024-02-28 12:21:50', 'img/services/02_c_Commercial Cleaning.jpg', 2, 1),
(23, 'Carpet Cleaning', 'Professional cleaning of carpets to remove dirt, stains, and odors. Utilizes specialized equipment and cleaning solutions to deep clean carpets and restore their appearance.', 100, 'depending', 'yes', '2024-02-28 12:21:50', 'img/services/03_c_Carpet Cleaning.jpg', 2, 1),
(24, 'Upholstery Cleaning', 'Cleaning of upholstered furniture such as sofas, chairs, and mattresses to remove dirt, allergens, and stains. Uses gentle yet effective cleaning methods to preserve the fabric.', 100, 'depending', 'yes', '2024-02-28 12:21:50', 'img/services/04_c_Upholstery Cleaning.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mobile_no` varchar(10) NOT NULL,
  `user_create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_mobile_no`, `user_create_at`, `user_city`) VALUES
(23, 'Gopal Ravindra Sadavarte', 'gopalsadavarte555@gmail.com', 'a1728904adb4c8dd8a6d73cbde7fdd94', '8956434705', '2024-04-14 14:31:54', 'shrirampur'),
(24, 'Rakesh Shinde', 'rakesh@gmail.com', '430c293ee1fd058610f7543a9ff0be4b', '8976543210', '2024-04-14 14:43:06', 'nagar'),
(25, 'Aniket', 'aniket1@gmail.com', 'b86698d651a54a7d47919349daebd8be', '8999927968', '2024-04-15 05:02:30', 'Pune');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `order_id` int(11) NOT NULL,
  `order_create_at` timestamp NULL DEFAULT NULL,
  `create_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(200) NOT NULL,
  `order_emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`order_id`, `order_create_at`, `create_update`, `order_status`, `order_emp_id`) VALUES
(22, '2024-04-14 18:27:33', '2024-04-14 18:27:33', 'pending', NULL),
(23, '2024-04-15 05:04:50', '2024-04-15 05:04:50', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `payment_id` int(11) NOT NULL,
  `transaction_id` varchar(200) DEFAULT NULL,
  `payment_user_id` int(11) DEFAULT NULL,
  `payment_order_id` int(11) DEFAULT NULL,
  `payment_status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payment`
--

INSERT INTO `user_payment` (`payment_id`, `transaction_id`, `payment_user_id`, `payment_order_id`, `payment_status`) VALUES
(1, '76GHYTRE345', 23, 22, 'success'),
(2, '5275636276352721', 25, 23, 'success');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id`),
  ADD KEY `cate_admin_id` (`cate_admin_id`);

--
-- Indexes for table `category_employee`
--
ALTER TABLE `category_employee`
  ADD KEY `category_id` (`category_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `con_user_id` (`con_user_id`);

--
-- Indexes for table `duration`
--
ALTER TABLE `duration`
  ADD PRIMARY KEY (`duration_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `emp_admin_id` (`emp_admin_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `serv_id` (`order_service_id`);

--
-- Indexes for table `order_to_order_details`
--
ALTER TABLE `order_to_order_details`
  ADD KEY `ord_id` (`ord_id`),
  ADD KEY `ord_details_id` (`ord_details_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `cate_id_fk` (`service_cate_id`),
  ADD KEY `admin_id_fk` (`service_admin_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_user_id` (`payment_user_id`),
  ADD KEY `payment_order_id` (`payment_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `duration`
--
ALTER TABLE `duration`
  MODIFY `duration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `cate_admin_id` FOREIGN KEY (`cate_admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `category_employee`
--
ALTER TABLE `category_employee`
  ADD CONSTRAINT `category_employee_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cate_id`),
  ADD CONSTRAINT `category_employee_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `con_user_id` FOREIGN KEY (`con_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `emp_admin_id` FOREIGN KEY (`emp_admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `order_to_order_details`
--
ALTER TABLE `order_to_order_details`
  ADD CONSTRAINT `order_to_order_details_ibfk_1` FOREIGN KEY (`ord_id`) REFERENCES `user_order` (`order_id`),
  ADD CONSTRAINT `order_to_order_details_ibfk_2` FOREIGN KEY (`ord_details_id`) REFERENCES `order_details` (`order_details_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `admin_id_fk` FOREIGN KEY (`service_admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD CONSTRAINT `user_payment_ibfk_1` FOREIGN KEY (`payment_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_payment_ibfk_2` FOREIGN KEY (`payment_order_id`) REFERENCES `user_order` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
