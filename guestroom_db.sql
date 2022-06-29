-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 05:44 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guestroom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RoomNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `From` date NOT NULL,
  `To` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_02_064034_create_booking_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing`
--

CREATE TABLE `tbl_billing` (
  `BillingID` int(11) NOT NULL,
  `BookingID` int(10) DEFAULT NULL,
  `RoomRent` varchar(50) DEFAULT NULL,
  `Messing` varchar(50) DEFAULT NULL,
  `Washing` varchar(50) DEFAULT NULL,
  `Ironing` varchar(50) DEFAULT NULL,
  `ElecGas` varchar(50) DEFAULT NULL,
  `WaterBottle` varchar(50) DEFAULT NULL,
  `ExtraMatress` varchar(50) DEFAULT NULL,
  `FridgeItems` varchar(50) DEFAULT NULL,
  `PasteBrush` varchar(50) DEFAULT NULL,
  `Misc` varchar(50) DEFAULT NULL,
  `Total` varchar(10) DEFAULT NULL,
  `Discount` varchar(25) DEFAULT NULL,
  `AdvPayment` varchar(50) DEFAULT NULL,
  `Bal` varchar(50) DEFAULT NULL,
  `Paid` varchar(10) DEFAULT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Month` varchar(25) DEFAULT NULL,
  `Yr` varchar(25) DEFAULT NULL,
  `flag` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_billing`
--

INSERT INTO `tbl_billing` (`BillingID`, `BookingID`, `RoomRent`, `Messing`, `Washing`, `Ironing`, `ElecGas`, `WaterBottle`, `ExtraMatress`, `FridgeItems`, `PasteBrush`, `Misc`, `Total`, `Discount`, `AdvPayment`, `Bal`, `Paid`, `Remarks`, `created_at`, `Month`, `Yr`, `flag`) VALUES
(21, 18, '2400', '1200', NULL, NULL, '520', NULL, NULL, NULL, NULL, NULL, '4120.00', '0', '0', '4120', '4120', NULL, '2021-05-31 19:37:27', '05', '21', 1),
(22, 19, '2800', '1200', NULL, NULL, '260', NULL, NULL, NULL, NULL, NULL, '4260.00', '0', '0', '4260', '4260', NULL, '2021-05-31 19:48:00', '05', '21', 1),
(23, 20, '1200', '1990', NULL, NULL, '260', NULL, NULL, NULL, NULL, NULL, '3450.00', '0', '0', '3450', '3450', NULL, '2021-05-31 19:55:55', '05', '21', 1),
(24, 21, '4000', '1313', NULL, NULL, '520', NULL, NULL, NULL, NULL, NULL, '5833.00', '0', '0', '5833', '5833', NULL, '2021-05-31 20:18:26', '05', '21', 1),
(25, 22, '5400', '1900', '20', '20', '780', NULL, '50', NULL, NULL, NULL, '8170.00', '780', '0', '7390', '7390', NULL, '2021-06-01 05:43:56', '06', '21', 1),
(26, 23, '1200', '1530', NULL, NULL, '260', NULL, NULL, NULL, NULL, NULL, '2990.00', '1200', '0', '1790', '1790', NULL, '2021-06-07 06:16:06', '06', '21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `BookingID` int(11) NOT NULL,
  `RoomID` int(6) DEFAULT NULL,
  `Cat` varchar(50) DEFAULT NULL,
  `ArmyNo` varchar(12) DEFAULT NULL,
  `Rank` varchar(50) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Unit` varchar(50) DEFAULT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `CNIC` varchar(15) DEFAULT NULL,
  `GuestsNo` int(6) DEFAULT NULL,
  `MobileNo` varchar(15) DEFAULT NULL,
  `VehNo` varchar(15) DEFAULT NULL,
  `CheckIn` varchar(50) DEFAULT NULL,
  `CheckOut` varchar(50) DEFAULT NULL,
  `RoomStatus` varchar(50) DEFAULT 'Vacant',
  `SponsoredBy` varchar(50) DEFAULT NULL,
  `Fmn` varchar(50) DEFAULT NULL,
  `Remarks` varchar(250) DEFAULT NULL,
  `Month` varchar(25) DEFAULT NULL,
  `Yr` varchar(25) DEFAULT NULL,
  `flag` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`BookingID`, `RoomID`, `Cat`, `ArmyNo`, `Rank`, `Name`, `Unit`, `Address`, `CNIC`, `GuestsNo`, `MobileNo`, `VehNo`, `CheckIn`, `CheckOut`, `RoomStatus`, `SponsoredBy`, `Fmn`, `Remarks`, `Month`, `Yr`, `flag`, `created_at`, `updated_at`) VALUES
(18, 5, 'Serving(Lve)', 'PSS57688', 'Capt', 'Talha', '9 Sigs', NULL, NULL, NULL, NULL, NULL, '2021-06-01', '2021-06-03', 'Vacant', 'Self', 'Own', NULL, '05', '21', 1, '2021-05-31 19:21:23', NULL),
(19, 3, 'Retd', '30213', 'Col', 'Saleem', 'CORO', NULL, NULL, NULL, NULL, NULL, '2021-06-04', '2021-06-05', 'Vacant', 'Self', 'Own', NULL, '05', '21', 1, '2021-05-31 19:46:40', NULL),
(20, 8, 'Blood Relative', 'PSS57688', 'Capt', 'Talha', '9 Sigs', NULL, NULL, NULL, NULL, NULL, '2021-06-11', '2021-06-12', 'Vacant', 'Self', 'Own', NULL, '05', '21', 1, '2021-05-31 19:52:44', '2021-05-31'),
(21, 7, 'Civ Serving Offr', NULL, 'Mr', 'Faisal', NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-22', '2021-06-24', 'Vacant', 'Self', 'Other', NULL, '05', '21', 1, '2021-05-31 20:17:46', '2021-05-31'),
(22, 6, 'Serving(Lve)', 'PA45435', 'Maj', 'Hassan', '29 SR', NULL, NULL, NULL, NULL, NULL, '2021-06-01', '2021-06-04', 'Vacant', 'Self', 'Other', NULL, '06', '21', 1, '2021-06-01 05:33:00', '2021-06-01'),
(23, 12, 'Serving(Lve)', 'PA13123', 'Maj', 'Ali', '1 SP', NULL, NULL, NULL, NULL, NULL, '2021-06-08', '2021-06-09', 'Vacant', 'Self', 'Own', NULL, '06', '21', 1, '2021-06-07 06:13:59', '2021-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `LogID` int(11) NOT NULL,
  `LogUser` varchar(250) DEFAULT NULL,
  `Unit` varchar(50) DEFAULT NULL,
  `Bde` varchar(50) DEFAULT NULL,
  `Module` varchar(50) DEFAULT NULL,
  `Action` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`LogID`, `LogUser`, `Unit`, `Bde`, `Module`, `Action`, `created_at`) VALUES
(113, 'admin@admin.com', NULL, NULL, 'Rooms', 'Data Edited', '2021-05-31 07:03:37'),
(114, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-05-31 07:05:16'),
(115, 'admin@admin.com', NULL, NULL, 'Billing', 'Data Created', '2021-05-31 07:06:13'),
(116, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-05-31 08:31:22'),
(117, 'admin@admin.com', NULL, NULL, 'Billing', 'Data Created', '2021-05-31 08:34:36'),
(118, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-05-31 09:11:55'),
(119, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-05-31 19:21:23'),
(120, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Edited', '2021-05-31 19:36:52'),
(121, 'admin@admin.com', NULL, NULL, 'Billing', 'Data Created', '2021-05-31 19:37:27'),
(122, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-05-31 19:46:40'),
(123, 'admin@admin.com', NULL, NULL, 'Billing', 'Data Created', '2021-05-31 19:48:00'),
(124, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-05-31 19:52:44'),
(125, 'admin@admin.com', NULL, NULL, 'Billing', 'Data Created', '2021-05-31 19:55:55'),
(126, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-05-31 20:17:46'),
(127, 'admin@admin.com', NULL, NULL, 'Billing', 'Data Created', '2021-05-31 20:18:27'),
(128, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-06-01 05:33:00'),
(129, 'admin@admin.com', NULL, NULL, 'Billing', 'Data Created', '2021-06-01 05:43:56'),
(130, 'admin@admin.com', NULL, NULL, 'Bookings / Checkin-Checkout', 'Data Created', '2021-06-07 06:13:59'),
(131, 'admin@admin.com', NULL, NULL, 'Billing', 'Data Created', '2021-06-07 06:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservations`
--

CREATE TABLE `tbl_reservations` (
  `ReservationID` int(11) NOT NULL,
  `RoomNo` varchar(25) DEFAULT NULL,
  `RoomStatus` varchar(25) DEFAULT NULL,
  `CheckIn` varchar(50) DEFAULT NULL,
  `CheckOut` varchar(50) DEFAULT NULL,
  `Month` varchar(25) DEFAULT NULL,
  `Yr` varchar(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reservations`
--

INSERT INTO `tbl_reservations` (`ReservationID`, `RoomNo`, `RoomStatus`, `CheckIn`, `CheckOut`, `Month`, `Yr`, `created_at`) VALUES
(31, 'CB3', 'Occupied', '2021-06-01', '2021-06-03', '05', '2021', '2021-05-31 19:37:27'),
(32, 'CB3', 'Occupied', '2021-06-01', '2021-06-03', '05', '2021', '2021-05-31 19:37:27'),
(33, 'CB1', 'Occupied', '2021-06-04', '2021-06-05', '05', '2021', '2021-05-31 19:48:00'),
(34, 'CB6', 'Occupied', '2021-06-11', '2021-06-12', '05', '2021', '2021-05-31 19:55:55'),
(35, 'CB5', 'Occupied', '2021-06-22', '2021-06-24', '05', '2021', '2021-05-31 20:18:26'),
(36, 'CB5', 'Occupied', '2021-06-22', '2021-06-24', '05', '2021', '2021-05-31 20:18:26'),
(37, 'CB4', 'Occupied', '2021-06-01', '2021-06-04', '06', '2021', '2021-06-01 05:43:56'),
(38, 'CB4', 'Occupied', '2021-06-01', '2021-06-04', '06', '2021', '2021-06-01 05:43:56'),
(39, 'CB4', 'Occupied', '2021-06-01', '2021-06-04', '06', '2021', '2021-06-01 05:43:56'),
(40, 'CB10', 'Occupied', '2021-06-08', '2021-06-09', '06', '2021', '2021-06-07 06:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE `tbl_rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomNo` varchar(10) DEFAULT NULL,
  `RoomDesc` varchar(250) DEFAULT NULL,
  `Loc` varchar(50) DEFAULT NULL,
  `RoomStatus` varchar(10) NOT NULL DEFAULT 'Vacant',
  `Floor` varchar(50) DEFAULT NULL,
  `Capacity` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` varchar(25) DEFAULT NULL,
  `flag` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`RoomID`, `RoomNo`, `RoomDesc`, `Loc`, `RoomStatus`, `Floor`, `Capacity`, `created_at`, `updated_at`, `flag`) VALUES
(3, 'CB1', NULL, 'Chawinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-17 05:09:37', '2021-05-31', 1),
(4, 'CB2', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 06:46:05', NULL, 1),
(5, 'CB3', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', '2021-05-31', 1),
(6, 'CB4', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', '2021-06-01', 1),
(7, 'CB5', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', '2021-05-31', 1),
(8, 'CB6', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', '2021-05-31', 1),
(9, 'CB7', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(10, 'CB8', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(11, 'CB9', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(12, 'CB10', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', '2021-06-07', 1),
(13, 'CB11', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(14, 'CB12', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(15, 'CB13', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(16, 'CB14', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(17, 'CB15', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(18, 'CB16', NULL, 'Chwinda BOQs', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(19, 'Burraq1', NULL, 'Burraq Mess', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(20, 'Burraq2', NULL, 'Burraq Mess', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(21, 'Chwinda1', NULL, 'Chwinda Mess', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(22, 'Chwinda2', NULL, 'Chwinda Mess', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(23, 'DHL1', NULL, 'DHL', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(24, 'Cavalry1', NULL, 'Cavalry Inn', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1),
(25, 'Cavalry2', NULL, 'Cavalry Inn', 'Vacant', 'Vacant', '2', '2021-05-21 08:02:30', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `add` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0,
  `edit` int(11) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `fmn` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bde` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` int(4) NOT NULL DEFAULT 1,
  `pwd_changed` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `add`, `delete`, `edit`, `view`, `fmn`, `bde`, `unit`, `flag`, `pwd_changed`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$5zGDtprJxz3Rqf0gngLjtOJVy040vy4M9JnTqiep7I1gU7Xw69M62', 'L3G7O3K6EYosYbnK42kSoqTZ6XOxtbEPKtSpCDUxLwUhNgbiUffstaWXK2Nr', '2020-08-12 14:47:22', '2021-01-10 05:48:58', 'admin', 1, 1, 1, 1, NULL, NULL, NULL, 1, 1),
(2, 'Talha Shahzad', '57688talha', NULL, '$2y$10$LmzvQU/EI1a1iLAVRzLbdeJZqVfoFILVgAz76MZXvgeO8jQYbmw0S', 'oAwKP3oUCyPQAgUZLTxFkA1LKIagd3NTO5FQ9BCHghNGXjjafF8r1tVQSdin', NULL, NULL, 'user', 1, 0, 0, 0, '6 Armd Div', '7 Armd Bde', NULL, 1, 0),
(27, '12C', 'clk_12c', NULL, '$2y$10$A1wDKfiCuCrfGVqybGDaE.8iLVFdtmpwLVesS7bIUx.Fl15AwxDca', NULL, NULL, NULL, 'user', 1, 0, 1, 1, '6 Armd Div', 'DTUs', '12 C', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  ADD PRIMARY KEY (`BillingID`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`BookingID`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`LogID`);

--
-- Indexes for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  ADD PRIMARY KEY (`ReservationID`);

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  MODIFY `BillingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
