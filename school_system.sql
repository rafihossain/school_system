-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 12, 2023 at 11:09 AM
-- Server version: 10.3.37-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pktherssoftware_student_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(191) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(191) DEFAULT NULL,
  `event` varchar(191) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(128) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `schedule` varchar(128) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_notifies`
--

CREATE TABLE `announcement_notifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_name` varchar(128) DEFAULT NULL,
  `student_email` varchar(128) DEFAULT NULL,
  `student_phone` varchar(128) DEFAULT NULL,
  `mail_subject` varchar(128) DEFAULT NULL,
  `mail_message` text DEFAULT NULL,
  `mail_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

CREATE TABLE `blood_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calenders`
--

CREATE TABLE `calenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_title` varchar(128) DEFAULT NULL,
  `start_date` varchar(128) DEFAULT NULL,
  `end_date` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` int(11) NOT NULL DEFAULT 0,
  `class_name` varchar(128) DEFAULT NULL,
  `class_numeric` int(11) NOT NULL DEFAULT 0,
  `class_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `session_id`, `class_name`, `class_numeric`, `class_status`, `created_at`, `updated_at`) VALUES
(1, 2, 'One', 1, 1, '2023-02-11 14:16:55', '2023-02-11 14:16:55'),
(2, 2, 'Two', 2, 1, '2023-02-11 14:16:55', '2023-02-11 14:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classroom_name` varchar(128) DEFAULT NULL,
  `classroom_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `classroom_name`, `classroom_description`, `created_at`, `updated_at`) VALUES
(1, '101', 'Bangla', '2023-02-12 09:55:59', '2023-02-12 09:55:59'),
(2, '102', 'English', '2023-02-12 09:56:12', '2023-02-12 09:56:12'),
(3, '103', 'Math', '2023-02-12 09:56:24', '2023-02-12 09:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `classteachers`
--

CREATE TABLE `classteachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) NOT NULL DEFAULT 0,
  `section_id` int(11) NOT NULL DEFAULT 0,
  `teacher_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classteachers`
--

INSERT INTO `classteachers` (`id`, `class_id`, `section_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 6, '2023-02-12 11:10:34', '2023-02-12 11:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `class_routines`
--

CREATE TABLE `class_routines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` int(11) NOT NULL DEFAULT 0,
  `class_id` int(11) NOT NULL DEFAULT 0,
  `section_id` int(11) NOT NULL DEFAULT 0,
  `subject_id` int(11) NOT NULL DEFAULT 0,
  `classroom_id` int(11) NOT NULL DEFAULT 0,
  `teacher_id` int(11) NOT NULL DEFAULT 0,
  `day_id` int(11) NOT NULL DEFAULT 0,
  `start_time` varchar(128) DEFAULT NULL,
  `end_time` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `commentable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `commentable_type` varchar(191) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `user_name` varchar(191) DEFAULT NULL,
  `order` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `moderated_by` int(10) UNSIGNED DEFAULT NULL,
  `moderated_at` datetime DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(128) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `department_image` varchar(128) DEFAULT NULL,
  `department_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `description`, `department_image`, `department_status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 'bangla', 'department_1672490129_809534.jpg', 1, '2023-02-11 14:16:55', '2023-02-11 14:16:55'),
(2, 'English', 'english', 'department_1672490129_809534.jpg', 1, '2023-02-11 14:16:55', '2023-02-11 14:16:55'),
(3, 'Math', 'math', 'department_1672490129_809534.jpg', 1, '2023-02-11 14:16:55', '2023-02-11 14:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation_name` varchar(128) DEFAULT NULL,
  `designation_short_name` varchar(128) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `designation_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `designation_short_name`, `description`, `designation_status`, `created_at`, `updated_at`) VALUES
(1, 'Assistant Teacher', 'assistant teacher', 'assistant teacher', 1, '2023-02-12 09:59:13', '2023-02-12 09:59:13'),
(2, 'Sub Assistant Teacher', 'sub assistant teacher', 'sub assistant teacher', 0, '2023-02-12 10:00:04', '2023-02-12 10:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `exam_list`
--

CREATE TABLE `exam_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `start_date` varchar(191) DEFAULT NULL,
  `end_date` varchar(191) DEFAULT NULL,
  `note` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_list`
--

INSERT INTO `exam_list` (`id`, `name`, `start_date`, `end_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Mid Term', '2023-01-01', '2023-06-01', 'Please pay your due first!', '2023-02-12 09:53:10', '2023-02-12 09:54:03'),
(2, 'Final Exam', '2023-05-01', '2023-09-01', 'Please pay your due first!', '2023-02-12 09:54:30', '2023-02-12 09:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `exam_result_rules`
--

CREATE TABLE `exam_result_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `gpa` varchar(191) DEFAULT NULL,
  `min_mark` varchar(191) DEFAULT NULL,
  `max_mark` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_result_rules`
--

INSERT INTO `exam_result_rules` (`id`, `name`, `gpa`, `min_mark`, `max_mark`, `created_at`, `updated_at`) VALUES
(1, 'A+', '5', '80', '100', '2023-02-12 11:34:24', '2023-02-12 12:31:52'),
(2, 'A', '4', '70', '79', '2023-02-12 12:32:11', '2023-02-12 12:32:11'),
(3, 'A-', '3.5', '60', '69', '2023-02-12 12:32:40', '2023-02-12 12:32:40'),
(4, 'B', '3', '50', '59', '2023-02-12 12:33:00', '2023-02-12 12:33:00'),
(5, 'C', '2', '40', '49', '2023-02-12 12:33:28', '2023-02-12 12:33:28'),
(6, 'D', '1', '33', '39', '2023-02-12 12:33:58', '2023-02-12 12:33:58'),
(7, 'F', '0', '0', '32', '2023-02-12 12:34:20', '2023-02-12 12:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` varchar(191) DEFAULT NULL,
  `class_id` varchar(191) DEFAULT NULL,
  `section_id` varchar(191) DEFAULT NULL,
  `class_room_id` varchar(191) DEFAULT NULL,
  `subject_id` varchar(191) DEFAULT NULL,
  `exam_date` varchar(191) DEFAULT NULL,
  `start_time` varchar(191) DEFAULT NULL,
  `end_time` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `exam_id`, `class_id`, `section_id`, `class_room_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, '2', '1', '1', '1', '1', '2023-02-20', '04:51', '09:46', '2023-02-12 11:17:50', '2023-02-12 11:17:50'),
(2, '1', '1', '1', '1', '1', '2023-02-01', '10:00', '12:00', '2023-02-12 11:19:45', '2023-02-12 11:19:45');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expensetype_id` int(11) NOT NULL DEFAULT 0,
  `expense_ammount` varchar(128) DEFAULT NULL,
  `expense_description` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expensetype_id`, `expense_ammount`, `expense_description`, `created_at`, `updated_at`) VALUES
(1, 1, '20000', 'Expense 20000 tk only.', '2023-02-12 14:02:36', '2023-02-12 14:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_name` varchar(128) DEFAULT NULL,
  `expense_image` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `expense_name`, `expense_image`, `created_at`, `updated_at`) VALUES
(1, 'Academic Support', 'images/expanse_image/expanse_1676210525_746675.png', '2023-02-12 14:02:05', '2023-02-12 14:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL DEFAULT 0,
  `txn_number` varchar(128) DEFAULT NULL,
  `invoice_type` int(11) NOT NULL DEFAULT 0,
  `feetype_id` int(11) NOT NULL DEFAULT 0,
  `class_id` int(11) NOT NULL DEFAULT 0,
  `section_id` int(11) NOT NULL DEFAULT 0,
  `subject_id` int(11) DEFAULT NULL,
  `amount_due` varchar(128) DEFAULT NULL,
  `due_date` varchar(128) DEFAULT NULL,
  `fee_description` text DEFAULT NULL,
  `fee_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `txn_number`, `invoice_type`, `feetype_id`, `class_id`, `section_id`, `subject_id`, `amount_due`, `due_date`, `fee_description`, `fee_status`, `created_at`, `updated_at`) VALUES
(1, 5, 'H42M5q75xeRCm', 1, 1, 1, 1, 1, '20000', '2023-02-28', 'Please pay your due ASAP!', 2, '2023-02-12 12:51:03', '2023-02-12 12:51:03'),
(2, 5, '7w1dMg3Mx0YMX', 2, 2, 1, 1, NULL, '4000', '2023-02-14', 'Thanks for paid!', 1, '2023-02-12 14:01:02', '2023-02-12 14:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feetype_name` varchar(128) DEFAULT NULL,
  `feetype_image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `feetype_name`, `feetype_image`, `created_at`, `updated_at`) VALUES
(1, 'Tuition Fee', 'images/accounting/feetype_image/feetype_1676205552_427409.png', '2023-02-12 12:39:12', '2023-02-12 12:39:12'),
(2, 'Monthly Fee', 'images/accounting/feetype_image/feetype_1676205577_733975.png', '2023-02-12 12:39:37', '2023-02-12 12:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `homeworks`
--

CREATE TABLE `homeworks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL DEFAULT 0,
  `class_id` int(11) NOT NULL DEFAULT 0,
  `section_id` int(11) NOT NULL DEFAULT 0,
  `subject_id` int(11) NOT NULL DEFAULT 0,
  `start_date` varchar(128) DEFAULT NULL,
  `end_date` varchar(128) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeworks`
--

INSERT INTO `homeworks` (`id`, `title`, `teacher_id`, `class_id`, `section_id`, `subject_id`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Dolore aliquip conse', 6, 1, 1, 1, '2023-02-20', '2023-02-28', 'Optio odit lorem de', '2023-02-12 10:47:52', '2023-02-12 10:47:52'),
(2, 'Dolore aliquip conse', 6, 1, 1, 1, '2023-02-20', '2023-02-28', 'Optio odit lorem de', '2023-02-12 10:48:00', '2023-02-12 10:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `mime_type` varchar(191) DEFAULT NULL,
  `disk` varchar(191) NOT NULL,
  `conversions_disk` varchar(191) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_11_062135_create_posts_table', 1),
(4, '2018_03_12_062135_create_categories_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2020_02_19_173641_create_settings_table', 1),
(8, '2020_02_19_173700_create_userprofiles_table', 1),
(9, '2020_02_19_173711_create_notifications_table', 1),
(10, '2020_02_22_115918_create_user_providers_table', 1),
(11, '2020_05_01_163442_create_tags_table', 1),
(12, '2020_05_01_163833_create_polymorphic_taggables_table', 1),
(13, '2020_05_04_151517_create_comments_table', 1),
(14, '2022_04_01_132914_create_media_table', 1),
(15, '2022_04_01_133918_create_permission_tables', 1),
(16, '2022_04_01_134140_create_activity_log_table', 1),
(17, '2022_04_01_134141_add_event_column_to_activity_log_table', 1),
(18, '2022_04_01_134142_add_batch_uuid_column_to_activity_log_table', 1),
(19, '2023_01_01_175042_create_parent_additional_info_table', 1),
(20, '2023_01_02_115042_create_students_table', 1),
(21, '2023_01_02_193140_create_student_additional_info_table', 1),
(22, '2023_01_03_101922_create_student_document_checklist_table', 1),
(23, '2023_01_03_131202_create_parent_document_checklist_table', 1),
(24, '2023_01_03_181230_create_teacher_additional_info_table', 1),
(25, '2023_01_03_182928_create_teacher_document_checklist_table', 1),
(26, '2023_01_03_195148_create_staff_additional_info_table', 1),
(27, '2023_01_08_133801_create_exam_list_table', 1),
(28, '2023_01_08_184303_create_exam_schedule_table', 1),
(29, '2023_01_09_185422_create_student_marks_table', 1),
(30, '2023_01_10_152008_create_exam_result_rules_table', 1),
(31, '2023_01_15_194735_create_homeworks_table', 1),
(32, '2023_01_24_184007_create_announcements_table', 1),
(33, '2023_01_24_184753_create_announcement_notifies_table', 1),
(34, '2023_01_24_185048_create_blood_groups_table', 1),
(35, '2023_01_24_185255_create_calenders_table', 1),
(36, '2023_01_24_185455_create_classes_table', 1),
(37, '2023_01_24_185823_create_classrooms_table', 1),
(38, '2023_01_24_185956_create_classteachers_table', 1),
(39, '2023_01_24_190144_create_class_routines_table', 1),
(40, '2023_01_24_190501_create_departments_table', 1),
(41, '2023_01_24_190840_create_designations_table', 1),
(42, '2023_01_24_191348_create_expenses_table', 1),
(43, '2023_01_24_191614_create_expense_types_table', 1),
(44, '2023_01_24_191722_create_fees_table', 1),
(45, '2023_01_24_192432_create_fee_types_table', 1),
(46, '2023_01_24_192919_create_operator_additional_info_table', 1),
(47, '2023_01_24_193221_create_operator_document_checklist_table', 1),
(48, '2023_01_24_193455_create_payment_settings_table', 1),
(49, '2023_01_24_193745_create_sections_table', 1),
(50, '2023_01_24_193859_create_sessions_table', 1),
(51, '2023_01_24_194607_create_subjectclasses_table', 1),
(52, '2023_01_24_194901_create_subjects_table', 1),
(53, '2023_01_24_195028_create_syllabus_table', 1),
(54, '2023_01_24_195146_create_syllabus_images_table', 1),
(55, '2023_01_24_195303_create_system_systems_table', 1),
(56, '2023_01_24_195422_create_system_themes_table', 1),
(57, '2023_01_30_163841_create_student_attendence_table', 1),
(58, '2023_01_31_114414_create_staff_document_checklist_table', 1),
(59, '2023_01_31_170607_create_teacher_attendence_table', 1),
(60, '2023_02_11_201115_create_setting_basics_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(6, 'App\\Models\\User', 5),
(7, 'App\\Models\\User', 5),
(8, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operator_additional_info`
--

CREATE TABLE `operator_additional_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `date_of_birth` varchar(128) DEFAULT NULL,
  `whatsapp` varchar(128) DEFAULT NULL,
  `blood_group` varchar(128) DEFAULT NULL,
  `present_address` varchar(128) DEFAULT NULL,
  `permanent_address` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operator_document_checklist`
--

CREATE TABLE `operator_document_checklist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `attested_passport_size_photograph` int(11) NOT NULL DEFAULT 0,
  `attested_national_id_card` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_additional_info`
--

CREATE TABLE `parent_additional_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `father_occupation` varchar(191) DEFAULT NULL,
  `father_cnic` varchar(191) DEFAULT NULL,
  `mother_name` varchar(191) DEFAULT NULL,
  `mother_nid` varchar(191) DEFAULT NULL,
  `mother_occupation` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_document_checklist`
--

CREATE TABLE `parent_document_checklist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `attested_father_passport_size_photograph` varchar(191) DEFAULT NULL,
  `attested_father_national_id_card` varchar(191) DEFAULT NULL,
  `attested_mather_passport_size_photograph` varchar(191) DEFAULT NULL,
  `attested_mother_national_id_card` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher_key` varchar(128) DEFAULT NULL,
  `secret_key` varchar(128) DEFAULT NULL,
  `live_mode` int(11) NOT NULL DEFAULT 0,
  `merchant_email` varchar(128) DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `publisher_key`, `secret_key`, `live_mode`, `merchant_email`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 'paypal_publisher_key', 'paypal_secret_key', 1, 'ert', 1, NULL, NULL),
(2, 'stripe_publisher_key', 'stripe_secret_key', 1, 'ert', 2, NULL, NULL),
(3, 'razorpay_publisher_key', 'razorpay_secret_key', 1, 'ert', 3, NULL, NULL),
(4, 'paystack_publisher_key', 'paystack_secret_key', 1, 'admin@merchant.com', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(125) NOT NULL,
  `guard_name` varchar(125) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_backend', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(2, 'edit_settings', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(3, 'view_logs', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(4, 'view_users', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(5, 'add_users', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(6, 'edit_users', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(7, 'delete_users', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(8, 'restore_users', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(9, 'block_users', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(10, 'view_roles', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(11, 'add_roles', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(12, 'edit_roles', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(13, 'delete_roles', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(14, 'restore_roles', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(15, 'view_backups', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(16, 'add_backups', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(17, 'create_backups', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(18, 'download_backups', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(19, 'delete_backups', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(20, 'view_posts', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(21, 'add_posts', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(22, 'edit_posts', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(23, 'delete_posts', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(24, 'restore_posts', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(25, 'view_categories', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(26, 'add_categories', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(27, 'edit_categories', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(28, 'delete_categories', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(29, 'restore_categories', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(30, 'view_tags', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(31, 'add_tags', 'web', '2023-02-11 14:16:52', '2023-02-11 14:16:52'),
(32, 'edit_tags', 'web', '2023-02-11 14:16:53', '2023-02-11 14:16:53'),
(33, 'delete_tags', 'web', '2023-02-11 14:16:53', '2023-02-11 14:16:53'),
(34, 'restore_tags', 'web', '2023-02-11 14:16:53', '2023-02-11 14:16:53'),
(35, 'view_comments', 'web', '2023-02-11 14:16:53', '2023-02-11 14:16:53'),
(36, 'add_comments', 'web', '2023-02-11 14:16:53', '2023-02-11 14:16:53'),
(37, 'edit_comments', 'web', '2023-02-11 14:16:53', '2023-02-11 14:16:53'),
(38, 'delete_comments', 'web', '2023-02-11 14:16:53', '2023-02-11 14:16:53'),
(39, 'restore_comments', 'web', '2023-02-11 14:16:53', '2023-02-11 14:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `intro` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `category_name` varchar(191) DEFAULT NULL,
  `is_featured` int(11) DEFAULT NULL,
  `featured_image` varchar(191) DEFAULT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_og_image` varchar(191) DEFAULT NULL,
  `meta_og_url` varchar(191) DEFAULT NULL,
  `hits` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `moderated_by` int(10) UNSIGNED DEFAULT NULL,
  `moderated_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_by_name` varchar(191) DEFAULT NULL,
  `created_by_alias` varchar(191) DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(125) NOT NULL,
  `guard_name` varchar(125) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(2, 'admin', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(3, 'manager', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(4, 'parent', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(5, 'student', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(6, 'teacher', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(7, 'staff', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51'),
(8, 'operator', 'web', '2023-02-11 14:16:51', '2023-02-11 14:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) NOT NULL DEFAULT 0,
  `section_name` varchar(128) DEFAULT NULL,
  `section_capacity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `class_id`, `section_name`, `section_capacity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Section-A', 24, '2023-02-11 14:16:55', '2023-02-11 14:16:55'),
(2, 2, 'Section-B', 81, '2023-02-11 14:16:55', '2023-02-11 14:16:55'),
(3, 1, 'Section-C', 24, '2023-02-11 14:16:55', '2023-02-11 14:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_name` varchar(128) DEFAULT NULL,
  `start_date` varchar(128) DEFAULT NULL,
  `end_date` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session_name`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, '2022', '2022-01-01', '2022-12-30', '2023-02-11 14:16:55', '2023-02-11 14:16:55'),
(2, '2023', '2023-01-01', '2023-12-30', '2023-02-11 14:16:55', '2023-02-11 14:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `val` text DEFAULT NULL,
  `type` char(20) NOT NULL DEFAULT 'string',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting_basics`
--

CREATE TABLE `setting_basics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `short_name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `adddress` text DEFAULT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `dark_mode_logo` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_basics`
--

INSERT INTO `setting_basics` (`id`, `name`, `short_name`, `email`, `phone`, `adddress`, `favicon`, `logo`, `dark_mode_logo`, `created_at`, `updated_at`) VALUES
(1, 'School Management', 'school_system', 'school@gmail.com', '01786543219', 'Rampura, Dhaka, Bangladesh', 'favicon_1676192899_895155.png', 'logo_1676192882_690895.png', 'dark_logo_1676192882_532585.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_additional_info`
--

CREATE TABLE `staff_additional_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(191) DEFAULT NULL,
  `date_of_birth` varchar(191) DEFAULT NULL,
  `whatsapp` varchar(191) DEFAULT NULL,
  `blood_group` varchar(191) DEFAULT NULL,
  `present_address` varchar(191) DEFAULT NULL,
  `permanent_address` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_document_checklist`
--

CREATE TABLE `staff_document_checklist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `attested_passport_size_photograph` varchar(191) DEFAULT NULL,
  `attested_national_id_card` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `roll_no` varchar(128) DEFAULT NULL,
  `admission_date` varchar(128) DEFAULT NULL,
  `b_form` varchar(128) DEFAULT NULL,
  `registration` varchar(128) DEFAULT NULL,
  `guardian_name` varchar(128) DEFAULT NULL,
  `guardian_office_address` varchar(128) DEFAULT NULL,
  `guardian_office_phone` varchar(128) DEFAULT NULL,
  `guardian_mobile_phone` varchar(128) DEFAULT NULL,
  `guardian_mobile_whatsapp` varchar(128) DEFAULT NULL,
  `guardian_mobile_email` varchar(128) DEFAULT NULL,
  `student_profile_pic` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `session_id`, `section_id`, `class_id`, `parent_id`, `department_id`, `roll_no`, `admission_date`, `b_form`, `registration`, `guardian_name`, `guardian_office_address`, `guardian_office_phone`, `guardian_mobile_phone`, `guardian_mobile_whatsapp`, `guardian_mobile_email`, `student_profile_pic`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, 1, 4, 1, '3456788', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_additional_info`
--

CREATE TABLE `student_additional_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `residential_address` varchar(128) DEFAULT NULL,
  `student_phone` varchar(128) DEFAULT NULL,
  `student_mobile` varchar(128) DEFAULT NULL,
  `student_whatsapp` varchar(128) DEFAULT NULL,
  `religion` varchar(128) DEFAULT NULL,
  `nationality` varchar(128) DEFAULT NULL,
  `domicile` varchar(128) DEFAULT NULL,
  `blood_group` varchar(128) DEFAULT NULL,
  `medical_history` varchar(128) DEFAULT NULL,
  `special_instruction` varchar(128) DEFAULT NULL,
  `admission_cancel_date` varchar(128) DEFAULT NULL,
  `transport_required` varchar(128) DEFAULT NULL,
  `free_student` varchar(128) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendence`
--

CREATE TABLE `student_attendence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `attendence_date` varchar(128) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendence`
--

INSERT INTO `student_attendence` (`id`, `student_id`, `attendence_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, '2023-02-12', 'present', '2023-02-12 14:03:02', '2023-02-12 14:03:02'),
(2, 5, '2023-02-11', 'present', '2023-02-12 14:03:13', '2023-02-12 14:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `student_document_checklist`
--

CREATE TABLE `student_document_checklist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `attested_passport_size_photograph` varchar(191) DEFAULT NULL,
  `attested_national_id_card` varchar(191) DEFAULT NULL,
  `attested_all_certificate` varchar(191) DEFAULT NULL,
  `attested_relevent_document` varchar(191) DEFAULT NULL,
  `migration_certificate_different_board` varchar(191) DEFAULT NULL,
  `previous_school_leaving_certificate` varchar(191) DEFAULT NULL,
  `b_from_goverment` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_marks`
--

CREATE TABLE `student_marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(191) DEFAULT NULL,
  `exam_id` varchar(191) DEFAULT NULL,
  `subject_id` varchar(191) DEFAULT NULL,
  `mark` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_marks`
--

INSERT INTO `student_marks` (`id`, `student_id`, `exam_id`, `subject_id`, `mark`, `created_at`, `updated_at`) VALUES
(1, '5', '1', '1', '60', '2023-02-12 11:28:46', '2023-02-12 11:28:46'),
(2, '5', '1', '2', '55', '2023-02-12 11:30:20', '2023-02-12 11:30:20'),
(3, '5', '1', '3', '40', '2023-02-12 11:30:45', '2023-02-12 11:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `subjectclasses`
--

CREATE TABLE `subjectclasses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL DEFAULT 0,
  `subject_name` varchar(128) DEFAULT NULL,
  `subject_code` varchar(128) DEFAULT NULL,
  `total_mark` varchar(128) DEFAULT NULL,
  `theory_mark` varchar(128) DEFAULT NULL,
  `practical_mark` varchar(128) DEFAULT NULL,
  `city_exam_mark` varchar(128) DEFAULT NULL,
  `diary` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_name` varchar(128) DEFAULT NULL,
  `subject_code` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `class_id`, `subject_name`, `subject_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangla', '101', '2023-02-12 09:56:47', '2023-02-12 09:56:47'),
(2, 1, 'English', '102', '2023-02-12 09:57:03', '2023-02-12 09:57:03'),
(3, 1, 'Math', '103', '2023-02-12 09:57:18', '2023-02-12 09:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `syllabus_title` varchar(128) DEFAULT NULL,
  `class_id` int(11) NOT NULL DEFAULT 0,
  `section_id` int(11) NOT NULL DEFAULT 0,
  `subject_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`id`, `syllabus_title`, `class_id`, `section_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 'Mid Exam Syllabus', 1, 1, 1, '2023-02-12 14:06:55', '2023-02-12 14:06:55'),
(2, 'Mid Exam Syllabus', 2, 2, 1, '2023-02-12 14:07:31', '2023-02-12 14:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus_images`
--

CREATE TABLE `syllabus_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `syllabus_id` int(11) NOT NULL DEFAULT 0,
  `syllabus_images` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `syllabus_images`
--

INSERT INTO `syllabus_images` (`id`, `syllabus_id`, `syllabus_images`, `created_at`, `updated_at`) VALUES
(1, 1, 'syllabus_1676210816_475547.png', NULL, NULL),
(2, 2, 'syllabus_1676210851_966139.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_systems`
--

CREATE TABLE `system_systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time_diff` varchar(128) DEFAULT NULL,
  `start_time` varchar(128) DEFAULT NULL,
  `end_time` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_systems`
--

INSERT INTO `system_systems` (`id`, `time_diff`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, '10', '03:07', '17:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_themes`
--

CREATE TABLE `system_themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `group_name` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_additional_info`
--

CREATE TABLE `teacher_additional_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `date_of_birth` varchar(191) DEFAULT NULL,
  `blood_id` int(11) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `teacher_profile_pic` varchar(128) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendence`
--

CREATE TABLE `teacher_attendence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `attendence_date` varchar(128) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_attendence`
--

INSERT INTO `teacher_attendence` (`id`, `teacher_id`, `attendence_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, '2023-02-12', 'present', '2023-02-12 14:03:35', '2023-02-12 14:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_document_checklist`
--

CREATE TABLE `teacher_document_checklist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `attested_passport_size_photograph` varchar(191) DEFAULT NULL,
  `attested_national_id_card` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userprofiles`
--

CREATE TABLE `userprofiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `username` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `url_website` varchar(191) DEFAULT NULL,
  `url_facebook` varchar(191) DEFAULT NULL,
  `url_twitter` varchar(191) DEFAULT NULL,
  `url_instagram` varchar(191) DEFAULT NULL,
  `url_linkedin` varchar(191) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `user_metadata` text DEFAULT NULL,
  `last_ip` varchar(191) DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userprofiles`
--

INSERT INTO `userprofiles` (`id`, `user_id`, `name`, `first_name`, `last_name`, `username`, `email`, `mobile`, `gender`, `url_website`, `url_facebook`, `url_twitter`, `url_instagram`, `url_linkedin`, `date_of_birth`, `address`, `bio`, `avatar`, `user_metadata`, `last_ip`, `login_count`, `last_login`, `email_verified_at`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Super Admin', 'Super', 'Admin', '100001', 'super@admin.com', '417.442.4114', 'Female', NULL, NULL, NULL, NULL, NULL, '2008-06-08', NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 1, '2023-02-12 07:27:35', NULL, 1, NULL, 1, NULL, '2023-02-11 14:16:51', '2023-02-12 07:27:35', NULL),
(2, 2, 'Admin Istrator', 'Admin', 'Istrator', '100002', 'admin@admin.com', '+1-248-600-3914', 'Male', NULL, NULL, NULL, NULL, NULL, '1979-10-01', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL),
(3, 3, 'Manager Istrator', 'Manager', 'Istrator', '100003', 'manager@admin.com', '+18454610027', 'Male', NULL, NULL, NULL, NULL, NULL, '2011-09-20', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL),
(4, 4, 'Rahim Hossain', 'Rahim', 'Hossain', '100004', 'parent@admin.com', '(430) 831-7197', 'Other', NULL, NULL, NULL, NULL, NULL, '1970-10-13', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL),
(5, 5, 'Nazmul Hossain', 'Nazmul', 'Hossain', '100005', 'student@admin.com', '+18044441752', 'Female', NULL, NULL, NULL, NULL, NULL, '1976-11-15', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL),
(6, 6, 'Shukriti Das', 'Shukriti', 'Das', '100006', 'teacher@admin.com', '1-320-833-4674', 'Other', NULL, NULL, NULL, NULL, NULL, '1979-12-07', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL),
(7, 7, 'Karim Hossain', 'Karim', 'Hossain', '100007', 'staff@admin.com', '1-214-749-9183', 'Male', NULL, NULL, NULL, NULL, NULL, '2008-03-21', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL),
(8, 8, 'Jamal Hossain', 'Jamal', 'Hossain', '100008', 'operator@admin.com', '773-438-3589', 'Female', NULL, NULL, NULL, NULL, NULL, '2001-10-26', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `username` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT 'img/default-avatar.jpg',
  `user_role` tinyint(4) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `username`, `email`, `mobile`, `gender`, `date_of_birth`, `email_verified_at`, `password`, `avatar`, `user_role`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'Super', 'Admin', '100001', 'super@admin.com', '417.442.4114', 'Female', '2008-06-08', '2023-02-11 14:16:50', '$2y$10$Yssa/HafBxFKEcCTy7O06.6aX4fiwIbGhq8CZNLcg8GzH3MSxZ516', 'img/default-avatar.jpg', 1, 1, NULL, '2023-02-11 14:16:50', '2023-02-11 14:16:50', NULL),
(2, 'Admin Istrator', 'Admin', 'Istrator', '100002', 'admin@admin.com', '+1-248-600-3914', 'Male', '1979-10-01', '2023-02-11 14:16:50', '$2y$10$TijbOPrLOmJCxYZo9zUl1O/kR/61Qg3EN5ILOFfVRBFNEJX10TA32', 'img/default-avatar.jpg', 2, 1, NULL, '2023-02-11 14:16:50', '2023-02-11 14:16:50', NULL),
(3, 'Manager Istrator', 'Manager', 'Istrator', '100003', 'manager@admin.com', '+18454610027', 'Male', '2011-09-20', '2023-02-11 14:16:50', '$2y$10$FtxtYnXcR0Js4nYkmrqmOunEkzAq2aGSSjGpo0BQE.QD/C94jAk7e', 'img/default-avatar.jpg', 3, 1, NULL, '2023-02-11 14:16:50', '2023-02-11 14:16:50', NULL),
(4, 'Rahim Hossain', 'Rahim', 'Hossain', '100004', 'parent@admin.com', '(430) 831-7197', 'Other', '1970-10-13', '2023-02-11 14:16:50', '$2y$10$0eP2pEFqu/aVYPvoi7AITOxhrqP7PSDjm8gN2a.BC98fihozqBhd.', 'img/default-avatar.jpg', 4, 1, NULL, '2023-02-11 14:16:50', '2023-02-11 14:16:50', NULL),
(5, 'Nazmul Hossain', 'Nazmul', 'Hossain', '100005', 'student@admin.com', '+18044441752', 'Female', '1976-11-15', '2023-02-11 14:16:50', '$2y$10$c6oEhlwai.5Sq5L1eig.r.CCh0dRoHwFxQ71mTyfNsADoOWgHotjG', 'img/default-avatar.jpg', 5, 1, NULL, '2023-02-11 14:16:50', '2023-02-11 14:16:50', NULL),
(6, 'Shukriti Das', 'Shukriti', 'Das', '100006', 'teacher@admin.com', '1-320-833-4674', 'Other', '1979-12-07', '2023-02-11 14:16:50', '$2y$10$iZtBmSzctur8sdILJ4yR3.143NqrrMqQoFehzbawJ3tvYbEQ4WSUy', 'img/default-avatar.jpg', 6, 1, NULL, '2023-02-11 14:16:50', '2023-02-11 14:16:50', NULL),
(7, 'Karim Hossain', 'Karim', 'Hossain', '100007', 'staff@admin.com', '1-214-749-9183', 'Male', '2008-03-21', '2023-02-11 14:16:51', '$2y$10$TORA6V9XfVkwLsywFg3oFOXUPAPMzR8qmeeA.HzNR.iDCZe7homQe', 'img/default-avatar.jpg', 7, 1, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL),
(8, 'Jamal Hossain', 'Jamal', 'Hossain', '100008', 'operator@admin.com', '773-438-3589', 'Female', '2001-10-26', '2023-02-11 14:16:51', '$2y$10$DeKUYt6i232yFpAQ3xYT8.daVd23.oIjk6570ERP9RgiQJYWFZ1m2', 'img/default-avatar.jpg', 8, 1, NULL, '2023-02-11 14:16:51', '2023-02-11 14:16:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_providers`
--

CREATE TABLE `user_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(191) NOT NULL,
  `provider_id` varchar(191) NOT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_notifies`
--
ALTER TABLE `announcement_notifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calenders`
--
ALTER TABLE `calenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classteachers`
--
ALTER TABLE `classteachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_routines`
--
ALTER TABLE `class_routines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_list`
--
ALTER TABLE `exam_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_result_rules`
--
ALTER TABLE `exam_result_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `operator_additional_info`
--
ALTER TABLE `operator_additional_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator_document_checklist`
--
ALTER TABLE `operator_document_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_additional_info`
--
ALTER TABLE `parent_additional_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_additional_info_user_id_foreign` (`user_id`);

--
-- Indexes for table `parent_document_checklist`
--
ALTER TABLE `parent_document_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_document_checklist_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_basics`
--
ALTER TABLE `setting_basics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_additional_info`
--
ALTER TABLE `staff_additional_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_additional_info_user_id_foreign` (`user_id`);

--
-- Indexes for table `staff_document_checklist`
--
ALTER TABLE `staff_document_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_document_checklist_user_id_foreign` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_additional_info`
--
ALTER TABLE `student_additional_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_additional_info_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_attendence`
--
ALTER TABLE `student_attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_document_checklist`
--
ALTER TABLE `student_document_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_document_checklist_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_marks`
--
ALTER TABLE `student_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectclasses`
--
ALTER TABLE `subjectclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syllabus_images`
--
ALTER TABLE `syllabus_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_systems`
--
ALTER TABLE `system_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_themes`
--
ALTER TABLE `system_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_additional_info`
--
ALTER TABLE `teacher_additional_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_additional_info_user_id_foreign` (`user_id`);

--
-- Indexes for table `teacher_attendence`
--
ALTER TABLE `teacher_attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_document_checklist`
--
ALTER TABLE `teacher_document_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_document_checklist_user_id_foreign` (`user_id`);

--
-- Indexes for table `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_providers`
--
ALTER TABLE `user_providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_providers_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_notifies`
--
ALTER TABLE `announcement_notifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calenders`
--
ALTER TABLE `calenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classteachers`
--
ALTER TABLE `classteachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_routines`
--
ALTER TABLE `class_routines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_list`
--
ALTER TABLE `exam_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_result_rules`
--
ALTER TABLE `exam_result_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `operator_additional_info`
--
ALTER TABLE `operator_additional_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operator_document_checklist`
--
ALTER TABLE `operator_document_checklist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_additional_info`
--
ALTER TABLE `parent_additional_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_document_checklist`
--
ALTER TABLE `parent_document_checklist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting_basics`
--
ALTER TABLE `setting_basics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_additional_info`
--
ALTER TABLE `staff_additional_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_document_checklist`
--
ALTER TABLE `staff_document_checklist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_additional_info`
--
ALTER TABLE `student_additional_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendence`
--
ALTER TABLE `student_attendence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_document_checklist`
--
ALTER TABLE `student_document_checklist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_marks`
--
ALTER TABLE `student_marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjectclasses`
--
ALTER TABLE `subjectclasses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `syllabus_images`
--
ALTER TABLE `syllabus_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_systems`
--
ALTER TABLE `system_systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_themes`
--
ALTER TABLE `system_themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taggables`
--
ALTER TABLE `taggables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_additional_info`
--
ALTER TABLE `teacher_additional_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_attendence`
--
ALTER TABLE `teacher_attendence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_document_checklist`
--
ALTER TABLE `teacher_document_checklist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofiles`
--
ALTER TABLE `userprofiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_providers`
--
ALTER TABLE `user_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parent_additional_info`
--
ALTER TABLE `parent_additional_info`
  ADD CONSTRAINT `parent_additional_info_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parent_document_checklist`
--
ALTER TABLE `parent_document_checklist`
  ADD CONSTRAINT `parent_document_checklist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_additional_info`
--
ALTER TABLE `staff_additional_info`
  ADD CONSTRAINT `staff_additional_info_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_document_checklist`
--
ALTER TABLE `staff_document_checklist`
  ADD CONSTRAINT `staff_document_checklist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_additional_info`
--
ALTER TABLE `student_additional_info`
  ADD CONSTRAINT `student_additional_info_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_document_checklist`
--
ALTER TABLE `student_document_checklist`
  ADD CONSTRAINT `student_document_checklist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_additional_info`
--
ALTER TABLE `teacher_additional_info`
  ADD CONSTRAINT `teacher_additional_info_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_document_checklist`
--
ALTER TABLE `teacher_document_checklist`
  ADD CONSTRAINT `teacher_document_checklist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_providers`
--
ALTER TABLE `user_providers`
  ADD CONSTRAINT `user_providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
