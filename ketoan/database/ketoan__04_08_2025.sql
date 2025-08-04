-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th8 04, 2025 lúc 02:11 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ketoan_verison1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','in_review','resolved') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `order_code`, `content`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'aa', 'Since Role and Permission models are extended from Eloquent models, basic Eloquent calls can be used as well:', 'new', '2025-06-22 20:02:32', '2025-06-22 20:02:32'),
(7, 1, '424', '12431243', 'new', '2025-06-22 20:02:41', '2025-06-22 20:02:41'),
(8, 1, 'wqe', 'qwe21321431232121424214aaaa', 'resolved', '2025-06-22 20:03:39', '2025-06-22 20:53:15'),
(9, 1, 'hỗ trợ khách hàng', 'ádsad', 'new', '2025-06-22 20:14:37', '2025-06-22 20:14:37'),
(12, 24, 'hehehe', '21321', 'in_review', '2025-06-22 20:17:01', '2025-06-22 20:41:20'),
(13, 24, 'hehehe', '21321', 'in_review', '2025-06-22 20:17:01', '2025-06-22 20:41:20'),
(15, 24, 'hehehe', '21321', 'in_review', '2025-06-22 20:17:01', '2025-06-22 20:41:20'),
(16, 24, 'hehehe', '21321', 'in_review', '2025-06-22 20:17:01', '2025-06-22 20:41:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `custom_notifications`
--

CREATE TABLE `custom_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `custom_notifications`
--

INSERT INTO `custom_notifications` (`id`, `title`, `content`, `type`, `created_at`, `updated_at`) VALUES
(8, 'huhwh', 'aa', '2', '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(9, 'cọc', 'ưdw', '1', '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(10, 'hêhhe', '111', '1', '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(12, 'a', 'a', '1', '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(13, 'heheh', '22', '1', '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(14, 'heheh', '22', '1', '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(15, 'heheh', '22', '1', '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(16, 'heheh', '22', '1', '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(17, 'a', 'a', '1', '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(18, 'hehehehe', '213', '1', '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(19, 'hehehehe', '213', '1', '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(20, 'hehehehe', '213', '1', '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(21, 'hehehehe', '213', '1', '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(22, 'a', 'a', '1', '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(23, 'a', 'a', '1', '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(24, 'a', 'a', '1', '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(25, 'a', 'a', '1', '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(26, 'a', 'a', '1', '2025-06-22 19:29:12', '2025-06-22 19:29:12'),
(27, 'a', 'a', '1', '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(28, 'a', 'a', '1', '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(29, 'a', 'a21', '1', '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(30, 'a12', 'a2', '1', '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(31, '213', '213', '1', '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(32, '34214', '12214', '1', '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(33, 'a', 'a', '1', '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(35, 'a', 'a', '1', '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(36, 'wqewq', 'wqe', '1', '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(37, 'hiehe', '32', '1', '2025-06-22 19:40:17', '2025-06-22 19:40:17'),
(38, 'fd21', 'nhfg', '1', '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(39, 'tạo mới', 'tạo mới nội dung', '2', '2025-06-29 18:56:38', '2025-06-29 18:56:38'),
(40, 'TH1: Không có MST + Những đơn hàng có chọn ở danh sách mã số thuế chưa có thông tin Lấy tên KH ở Lazada + (Khách lẻ không lấy hóa đơn)', 'TH1: Không có MST + Những đơn TH1: Không có MST + Những đơn hàng có chọn ở danh sách mã số thuế chưa có hàng có chọn ở danh sách mã số thuế chưa có thông tin\nLấy tên KH ở Lazada + (Khách lẻ không lấy hóa đơn)', '1', '2025-07-09 20:24:20', '2025-07-09 20:24:20'),
(41, 'Variable icon font', 'Add the variable font stylesheet request to your head tag and the current variable axes configuration to icons using CSS.', '1', '2025-07-09 21:29:39', '2025-07-09 21:29:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_export`
--

CREATE TABLE `history_export` (
  `history_id` int NOT NULL,
  `history_user_id` int NOT NULL,
  `order_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_total_amount` int DEFAULT NULL,
  `order_vat_amount` int DEFAULT NULL,
  `order_paid_amount` int DEFAULT NULL,
  `order_export_receipt` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `history_instance_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `history_export`
--

INSERT INTO `history_export` (`history_id`, `history_user_id`, `order_code`, `order_date`, `order_total_amount`, `order_vat_amount`, `order_paid_amount`, `order_export_receipt`, `history_instance_id`, `created_at`, `updated_at`) VALUES
(11, 1, 'WB00156770292PS', '16/06/2025 12:01:29', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:01', '2025-06-21 07:21:01'),
(12, 1, 'WB00156757857PS', '15/06/2025 11:40:27', 15278, 6667, 16500, '0', NULL, '2025-06-21 07:21:01', '2025-06-21 07:21:01'),
(13, 1, 'WB00156806970PS', '15/06/2025 10:40:41', 16667, 6667, 18000, '0', NULL, '2025-06-21 07:21:01', '2025-06-21 07:21:01'),
(14, 1, 'WB00156783276PS', '15/06/2025 12:41:14', 15278, 6667, 16500, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(15, 1, 'WB00156682085PS', '16/06/2025 11:19:33', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(16, 1, 'WB00156773501PS', '15/06/2025 08:59:55', 15278, 6667, 16500, '0', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(17, 1, 'WB00156692975PS', '15/06/2025 10:33:11', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(18, 1, 'WB00156692103PS', '16/06/2025 10:09:39', 15278, 6667, 16500, '0', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(19, 1, 'WB00156689434PS', '15/06/2025 09:44:15', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(20, 1, 'WB00156738123PS', '15/06/2025 10:31:06', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(21, 1, 'WB00156770292PS', '16/06/2025 12:01:29', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:01', '2025-06-21 07:21:01'),
(22, 1, 'WB00156757857PS', '15/06/2025 11:40:27', 15278, 6667, 16500, '0', NULL, '2025-06-21 07:21:01', '2025-06-21 07:21:01'),
(23, 1, 'WB00156806970PS', '15/06/2025 10:40:41', 16667, 6667, 18000, '0', NULL, '2025-06-21 07:21:01', '2025-06-21 07:21:01'),
(24, 1, 'WB00156783276PS', '15/06/2025 12:41:14', 15278, 6667, 16500, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(25, 1, 'WB00156682085PS', '16/06/2025 11:19:33', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(26, 1, 'WB00156773501PS', '15/06/2025 08:59:55', 15278, 6667, 16500, '0', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(27, 1, 'WB00156692975PS', '15/06/2025 10:33:11', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(28, 1, 'WB00156692103PS', '16/06/2025 10:09:39', 15278, 6667, 16500, '0', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(29, 1, 'WB00156689434PS', '15/06/2025 09:44:15', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52'),
(30, 1, 'WB00156738123PS', '15/06/2025 10:31:06', 16667, 6667, 18000, '1', NULL, '2025-06-21 07:21:52', '2025-06-21 07:21:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(23, 'default', '{\"uuid\":\"c8841883-fb5d-4d81-b992-40ff25c25c79\",\"displayName\":\"App\\\\Events\\\\NotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:30:\\\"App\\\\Events\\\\NotificationCreated\\\":1:{s:5:\\\"notif\\\";O:29:\\\"App\\\\Models\\\\CustomNotification\\\":30:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:20:\\\"custom_notifications\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:7:{s:5:\\\"title\\\";s:11:\\\"tạo mới\\\";s:7:\\\"content\\\";s:22:\\\"tạo mới nội dung\\\";s:4:\\\"type\\\";s:1:\\\"2\\\";s:10:\\\"updated_at\\\";s:19:\\\"2025-06-30 01:56:38\\\";s:10:\\\"created_at\\\";s:19:\\\"2025-06-30 01:56:38\\\";s:2:\\\"id\\\";i:39;s:12:\\\"unread_count\\\";i:17;}s:11:\\\"\\u0000*\\u0000original\\\";a:7:{s:5:\\\"title\\\";s:11:\\\"tạo mới\\\";s:7:\\\"content\\\";s:22:\\\"tạo mới nội dung\\\";s:4:\\\"type\\\";s:1:\\\"2\\\";s:10:\\\"updated_at\\\";s:19:\\\"2025-06-30 01:56:38\\\";s:10:\\\"created_at\\\";s:19:\\\"2025-06-30 01:56:38\\\";s:2:\\\"id\\\";i:39;s:12:\\\"unread_count\\\";i:17;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:1:{s:2:\\\"id\\\";s:3:\\\"int\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:3:{i:0;s:5:\\\"title\\\";i:1;s:7:\\\"content\\\";i:2;s:4:\\\"type\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1751248599, 1751248599),
(24, 'default', '{\"uuid\":\"78f81152-63b5-4bd6-a263-5e0e064984d4\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:13:\\\"abc@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(25, 'default', '{\"uuid\":\"c473f2ef-fe25-4256-a208-5fd31be4945c\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(26, 'default', '{\"uuid\":\"1844ace7-744e-4e9f-9ce2-95b092891ad2\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:16:\\\"ahh1h2@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(27, 'default', '{\"uuid\":\"b55ed7ce-66e8-4a54-8aad-352a29e1d56a\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:12:\\\"gh@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(28, 'default', '{\"uuid\":\"f4c8bc70-f1f1-4d0e-af21-c1420196c258\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:14:\\\"he22@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(29, 'default', '{\"uuid\":\"34e6c968-5425-4e5d-b57e-71d22e882a8e\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"hehee@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(30, 'default', '{\"uuid\":\"721a2c5a-6491-41a6-aab3-3b155d8ffbc8\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"hoanghaidang.dev@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(31, 'default', '{\"uuid\":\"cf005d42-7a21-4a2b-89f4-ca40ba8fbc8c\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:17:\\\"ngaymoi@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(32, 'default', '{\"uuid\":\"83e85ffd-3a8e-41f8-8c11-d156fce364f5\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"nguyenthily.weup@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(33, 'default', '{\"uuid\":\"5d087f1f-82d4-4434-ac00-68fa65863bfb\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:24:\\\"nhatmai.ketoan@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(34, 'default', '{\"uuid\":\"084f49c3-e6ef-4d56-ae7e-fc00ccfb0ee6\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"truo213ng@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(35, 'default', '{\"uuid\":\"54c7ca14-7b81-431e-8298-7d9423121bef\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:16:\\\"truong@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(36, 'default', '{\"uuid\":\"af795d4a-37b1-4d4c-aa20-5a03dffd9865\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:17:\\\"truong1@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(37, 'default', '{\"uuid\":\"e3b5c927-e3f8-4a7b-9e07-9dbdff10a7ed\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"truong11322@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(38, 'default', '{\"uuid\":\"77c83aac-b069-44f9-a65b-2758cf491f01\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:18:\\\"truong12@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(39, 'default', '{\"uuid\":\"e888edf9-cf6d-4c8b-a0d4-03e37857c0db\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"truong123@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(40, 'default', '{\"uuid\":\"1a31664d-3483-455e-8aea-2f3a070aa905\",\"displayName\":\"App\\\\Mail\\\\CustomNotificationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\CustomNotificationMail\\\":3:{s:12:\\\"notification\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\CustomNotification\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"truongbackend@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1751248599, 1751248599),
(41, 'default', '{\"uuid\":\"ae72109b-6102-4a51-b4bb-92790769d16f\",\"displayName\":\"App\\\\Events\\\\NotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:30:\\\"App\\\\Events\\\\NotificationCreated\\\":1:{s:5:\\\"notif\\\";O:29:\\\"App\\\\Models\\\\CustomNotification\\\":30:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:20:\\\"custom_notifications\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:7:{s:2:\\\"id\\\";i:39;s:5:\\\"title\\\";s:11:\\\"tạo mới\\\";s:7:\\\"content\\\";s:22:\\\"tạo mới nội dung\\\";s:4:\\\"type\\\";s:1:\\\"2\\\";s:10:\\\"created_at\\\";s:19:\\\"2025-06-30 01:56:38\\\";s:10:\\\"updated_at\\\";s:19:\\\"2025-06-30 01:56:38\\\";s:12:\\\"unread_count\\\";i:17;}s:11:\\\"\\u0000*\\u0000original\\\";a:7:{s:2:\\\"id\\\";i:39;s:5:\\\"title\\\";s:11:\\\"tạo mới\\\";s:7:\\\"content\\\";s:22:\\\"tạo mới nội dung\\\";s:4:\\\"type\\\";s:1:\\\"2\\\";s:10:\\\"created_at\\\";s:19:\\\"2025-06-30 01:56:38\\\";s:10:\\\"updated_at\\\";s:19:\\\"2025-06-30 01:56:38\\\";s:12:\\\"unread_count\\\";i:17;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:1:{s:2:\\\"id\\\";s:3:\\\"int\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:3:{i:0;s:5:\\\"title\\\";i:1;s:7:\\\"content\\\";i:2;s:4:\\\"type\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1751248599, 1751248599),
(42, 'default', '{\"uuid\":\"9b963fd5-98af-4bd1-8b32-17dd30455c34\",\"displayName\":\"App\\\\Events\\\\NotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:30:\\\"App\\\\Events\\\\NotificationCreated\\\":1:{s:5:\\\"notif\\\";O:29:\\\"App\\\\Models\\\\CustomNotification\\\":30:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:20:\\\"custom_notifications\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:7:{s:2:\\\"id\\\";i:40;s:5:\\\"title\\\";s:169:\\\"TH1: Không có MST + Những đơn hàng có chọn ở danh sách mã số thuế chưa có thông tin Lấy tên KH ở Lazada + (Khách lẻ không lấy hóa đơn)\\\";s:7:\\\"content\\\";s:169:\\\"TH1: Không có MST + Những đơn hàng có chọn ở danh sách mã số thuế chưa có thông tin\\nLấy tên KH ở Lazada + (Khách lẻ không lấy hóa đơn)\\\";s:4:\\\"type\\\";s:1:\\\"1\\\";s:10:\\\"created_at\\\";s:19:\\\"2025-07-10 03:24:20\\\";s:10:\\\"updated_at\\\";s:19:\\\"2025-07-10 03:24:20\\\";s:12:\\\"unread_count\\\";i:17;}s:11:\\\"\\u0000*\\u0000original\\\";a:7:{s:2:\\\"id\\\";i:40;s:5:\\\"title\\\";s:169:\\\"TH1: Không có MST + Những đơn hàng có chọn ở danh sách mã số thuế chưa có thông tin Lấy tên KH ở Lazada + (Khách lẻ không lấy hóa đơn)\\\";s:7:\\\"content\\\";s:169:\\\"TH1: Không có MST + Những đơn hàng có chọn ở danh sách mã số thuế chưa có thông tin\\nLấy tên KH ở Lazada + (Khách lẻ không lấy hóa đơn)\\\";s:4:\\\"type\\\";s:1:\\\"1\\\";s:10:\\\"created_at\\\";s:19:\\\"2025-07-10 03:24:20\\\";s:10:\\\"updated_at\\\";s:19:\\\"2025-07-10 03:24:20\\\";s:12:\\\"unread_count\\\";i:17;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:1:{s:2:\\\"id\\\";s:3:\\\"int\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:3:{i:0;s:5:\\\"title\\\";i:1;s:7:\\\"content\\\";i:2;s:4:\\\"type\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1752117863, 1752117863),
(43, 'default', '{\"uuid\":\"0d964347-e701-44c0-be51-257f1300aca0\",\"displayName\":\"App\\\\Events\\\\NotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:30:\\\"App\\\\Events\\\\NotificationCreated\\\":1:{s:5:\\\"notif\\\";O:29:\\\"App\\\\Models\\\\CustomNotification\\\":30:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:20:\\\"custom_notifications\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:7:{s:2:\\\"id\\\";i:41;s:5:\\\"title\\\";s:18:\\\"Variable icon font\\\";s:7:\\\"content\\\";s:121:\\\"Add the variable font stylesheet request to your head tag and the current variable axes configuration to icons using CSS.\\\";s:4:\\\"type\\\";s:1:\\\"1\\\";s:10:\\\"created_at\\\";s:19:\\\"2025-07-10 04:29:39\\\";s:10:\\\"updated_at\\\";s:19:\\\"2025-07-10 04:29:39\\\";s:12:\\\"unread_count\\\";i:17;}s:11:\\\"\\u0000*\\u0000original\\\";a:7:{s:2:\\\"id\\\";i:41;s:5:\\\"title\\\";s:18:\\\"Variable icon font\\\";s:7:\\\"content\\\";s:121:\\\"Add the variable font stylesheet request to your head tag and the current variable axes configuration to icons using CSS.\\\";s:4:\\\"type\\\";s:1:\\\"1\\\";s:10:\\\"created_at\\\";s:19:\\\"2025-07-10 04:29:39\\\";s:10:\\\"updated_at\\\";s:19:\\\"2025-07-10 04:29:39\\\";s:12:\\\"unread_count\\\";i:17;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:1:{s:2:\\\"id\\\";s:3:\\\"int\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:3:{i:0;s:5:\\\"title\\\";i:1;s:7:\\\"content\\\";i:2;s:4:\\\"type\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1752121780, 1752121780);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lazada_shop_tokens`
--

CREATE TABLE `lazada_shop_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `auth_user_id` int NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `refresh_token` varchar(255) NOT NULL,
  `account_platform` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `seller_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `country` varchar(10) DEFAULT NULL,
  `short_code` varchar(255) DEFAULT NULL,
  `expires_in` int DEFAULT NULL,
  `refresh_expires_in` int DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `request_id` varchar(255) DEFAULT NULL,
  `trace_id` varchar(255) DEFAULT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `lazada_shop_tokens`
--

INSERT INTO `lazada_shop_tokens` (`id`, `auth_user_id`, `access_token`, `refresh_token`, `account_platform`, `account`, `seller_id`, `user_id`, `country`, `short_code`, `expires_in`, `refresh_expires_in`, `code`, `request_id`, `trace_id`, `active`, `created_at`, `updated_at`) VALUES
(2, 1, '50000200d109TNswoxfb4K127477aduDosgzvFBGgT8quwgiHtL3hRS9CBloy7zs', '50001201410cKCkuepvcxT193a0fdcd7idwBrUYHlHOmyguvnCbGsPAJOASlwSb8', 'lazada', 'LzdOp_VN_test@163.com', NULL, NULL, 'vn', NULL, 604800, 1736200, '0_132625_ruTT1wF9D3ZODkCS3Y2V1CS8443', '2140fcb517538585640186619', '2140d18717538585640205760e760f', 'N', '2025-06-28 03:30:52', '2025-07-29 23:56:30'),
(4, 1, '50000200933s6rv7jHtysUa95i0koSEWuGbhds7nVTHnh1908573buGvD5V9mTos', '50001201033qh0uaa6lwiMqAyrjeiDUiqVyiigNjZDV0D1c4f7f72DW8O3DJySVp', 'lazada', 'LzdOp_VN_test@163.com', NULL, NULL, 'vn', NULL, 604800, 2206368, '0_132625_ruTT1wF9D3ZODkCS3Y2V1CS8443', '2141310917524639630463977', '2141031417524639630448167e0f66', 'N', '2025-06-28 03:30:52', '2025-07-13 20:51:39'),
(5, 1, '50000200933s6rv7jHtysUa95i0koSEWuGbhds7nVTHnh1908573buGvD5V9mTos', '50001201033qh0uaa6lwiMqAyrjeiDUiqVyiigNjZDV0D1c4f7f72DW8O3DJySVp', 'lazada', 'LzdOp_VN_test@163.com', NULL, NULL, 'vn', NULL, 604800, 2206368, '0_132625_ruTT1wF9D3ZODkCS3Y2V1CS8443', '2141310917524639630463977', '2141031417524639630448167e0f66', 'N', '2025-06-28 03:30:52', '2025-07-13 20:51:47'),
(6, 1, '50000200933s6rv7jHtysUa95i0koSEWuGbhds7nVTHnh1908573buGvD5V9mTos', '50001201033qh0uaa6lwiMqAyrjeiDUiqVyiigNjZDV0D1c4f7f72DW8O3DJySVp', 'lazada', 'LzdOp_VN_test@163.com', NULL, NULL, 'vn', NULL, 604800, 2206368, '0_132625_ruTT1wF9D3ZODkCS3Y2V1CS8443', '2141310917524639630463977', '2141031417524639630448167e0f66', 'N', '2025-06-28 03:30:52', '2025-07-13 20:51:59'),
(7, 1, '50000201139yY3eZ0nzfnUaSvfdjhSiPxXhlgMkyHQXHgXioOpw1432e1f1o5MRq', '50001201d39uaqbccx9nxYdGkMn3kTXoiaDurdNrZPQuzWeoBVD1be84575f3Fwy', 'lazada', 'LzdOp_VN_test@163.com', NULL, NULL, 'vn', NULL, 604800, 2205171, '0_132625_ruTT1wF9D3ZODkCS3Y2V1CS8443', '0babf46a17524651607393192', '210143f217524651607355711e2513', 'Y', '2025-06-28 03:30:52', '2025-07-13 20:52:59'),
(8, 1, '50000200933s6rv7jHtysUa95i0koSEWuGbhds7nVTHnh1908573buGvD5V9mTos', '50001201033qh0uaa6lwiMqAyrjeiDUiqVyiigNjZDV0D1c4f7f72DW8O3DJySVp', 'lazada', 'Lazadashop2@163.com', NULL, NULL, 'vn', NULL, 604800, 2206368, '0_132625_ruTT1wF9D3ZODkCS3Y2V1CS8443', '2141310917524639630463977', '2141031417524639630448167e0f66', 'Y', '2025-06-28 03:30:52', '2025-07-13 20:52:32'),
(9, 1, '50000200933s6rv7jHtysUa95i0koSEWuGbhds7nVTHnh1908573buGvD5V9mTos', '50001201033qh0uaa6lwiMqAyrjeiDUiqVyiigNjZDV0D1c4f7f72DW8O3DJySVp', 'lazada', 'LzdOp_VN_test@163.com', NULL, NULL, 'vn', NULL, 604800, 2206368, '0_132625_ruTT1wF9D3ZODkCS3Y2V1CS8443', '2141310917524639630463977', '2141031417524639630448167e0f66', 'N', '2025-06-28 03:30:52', '2025-07-13 20:52:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_08_040026_create_package_table', 1),
(6, '2025_06_09_030836_create_notification_table', 2),
(7, '2025_06_09_031400_create_notifications_table', 3),
(8, '2025_06_10_061839_create_permission_tables', 4),
(9, '2025_06_10_063247_add_note_and_status_to_roles_table', 5),
(10, '2025_06_13_090504_create_product_table', 6),
(11, '2025_06_15_165325_create_notifications_table', 7),
(12, '2025_06_18_090058_create_products_table', 8),
(13, '2025_06_21_142305_create_custom_notifications_table', 8),
(14, '2025_06_21_142404_create_notification_user_table', 8),
(15, '2025_06_22_160046_create_complaints_table', 9),
(16, '2025_06_23_045842_add_token_created_at_to_users_table', 10),
(21, '2025_06_24_090117_create_products_table', 11),
(22, '2025_06_24_090503_create_product_details_table', 11),
(23, '2025_08_01_070837_create_setting_account_lazada_table', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 18),
(1, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 23),
(1, 'App\\Models\\User', 24);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notification_user`
--

CREATE TABLE `notification_user` (
  `id` bigint UNSIGNED NOT NULL,
  `notification_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notification_user`
--

INSERT INTO `notification_user` (`id`, `notification_id`, `user_id`, `read_at`, `created_at`, `updated_at`) VALUES
(113, 8, 11, '2025-07-22 04:01:43', '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(114, 8, 6, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(115, 8, 19, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(116, 8, 7, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(117, 8, 12, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(118, 8, 10, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(119, 8, 23, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(120, 8, 13, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(121, 8, 22, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(122, 8, 20, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(123, 8, 8, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(124, 8, 18, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(125, 8, 17, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(126, 8, 14, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(127, 8, 9, NULL, '2025-06-22 03:36:22', '2025-06-22 03:36:22'),
(128, 8, 1, '2025-06-22 21:00:50', '2025-06-22 03:36:22', '2025-06-22 04:15:59'),
(129, 9, 11, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(130, 9, 6, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(131, 9, 19, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(132, 9, 7, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(133, 9, 12, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(134, 9, 10, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(135, 9, 23, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(136, 9, 13, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(137, 9, 22, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(138, 9, 20, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(139, 9, 8, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(140, 9, 18, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(141, 9, 17, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(142, 9, 14, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(143, 9, 9, NULL, '2025-06-22 03:40:08', '2025-06-22 03:40:08'),
(144, 9, 1, '2025-06-22 21:00:50', '2025-06-22 03:40:08', '2025-06-22 08:24:43'),
(145, 10, 11, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(146, 10, 6, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(147, 10, 19, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(148, 10, 7, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(149, 10, 12, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(150, 10, 10, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(151, 10, 23, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(152, 10, 13, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(153, 10, 22, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(154, 10, 20, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(155, 10, 8, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(156, 10, 18, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(157, 10, 17, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(158, 10, 14, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(159, 10, 9, NULL, '2025-06-22 07:59:32', '2025-06-22 07:59:32'),
(160, 10, 1, '2025-06-22 21:00:50', '2025-06-22 07:59:32', '2025-06-22 08:20:35'),
(177, 12, 11, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(178, 12, 6, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(179, 12, 19, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(180, 12, 7, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(181, 12, 12, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(182, 12, 10, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(183, 12, 23, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(184, 12, 13, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(185, 12, 22, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(186, 12, 20, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(187, 12, 8, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(188, 12, 18, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(189, 12, 17, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(190, 12, 14, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(191, 12, 9, NULL, '2025-06-22 08:21:36', '2025-06-22 08:21:36'),
(192, 12, 1, '2025-06-22 21:00:50', '2025-06-22 08:21:36', '2025-06-22 08:49:02'),
(193, 13, 11, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(194, 13, 6, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(195, 13, 19, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(196, 13, 7, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(197, 13, 12, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(198, 13, 10, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(199, 13, 23, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(200, 13, 13, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(201, 13, 22, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(202, 13, 20, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(203, 13, 8, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(204, 13, 18, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(205, 13, 17, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(206, 13, 14, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(207, 13, 9, NULL, '2025-06-22 08:26:39', '2025-06-22 08:26:39'),
(208, 13, 1, '2025-06-22 21:00:50', '2025-06-22 08:26:39', '2025-06-22 08:46:01'),
(209, 14, 11, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(210, 14, 6, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(211, 14, 19, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(212, 14, 7, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(213, 14, 12, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(214, 14, 10, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(215, 14, 23, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(216, 14, 13, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(217, 14, 22, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(218, 14, 20, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(219, 14, 8, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(220, 14, 18, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(221, 14, 17, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(222, 14, 14, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(223, 14, 9, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(224, 14, 1, '2025-06-22 21:00:50', '2025-06-22 08:26:40', '2025-06-22 08:51:08'),
(225, 15, 11, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(226, 15, 6, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(227, 15, 19, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(228, 15, 7, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(229, 15, 12, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(230, 15, 10, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(231, 15, 23, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(232, 15, 13, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(233, 15, 22, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(234, 15, 20, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(235, 15, 8, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(236, 15, 18, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(237, 15, 17, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(238, 15, 14, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(239, 15, 9, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(240, 15, 1, '2025-06-22 21:00:50', '2025-06-22 08:26:40', '2025-06-22 08:46:00'),
(241, 16, 11, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(242, 16, 6, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(243, 16, 19, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(244, 16, 7, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(245, 16, 12, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(246, 16, 10, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(247, 16, 23, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(248, 16, 13, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(249, 16, 22, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(250, 16, 20, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(251, 16, 8, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(252, 16, 18, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(253, 16, 17, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(254, 16, 14, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(255, 16, 9, NULL, '2025-06-22 08:26:40', '2025-06-22 08:26:40'),
(256, 16, 1, '2025-06-22 21:00:50', '2025-06-22 08:26:40', '2025-06-22 08:46:00'),
(257, 17, 11, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(258, 17, 6, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(259, 17, 19, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(260, 17, 7, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(261, 17, 12, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(262, 17, 10, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(263, 17, 23, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(264, 17, 13, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(265, 17, 22, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(266, 17, 20, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(267, 17, 8, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(268, 17, 18, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(269, 17, 17, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(270, 17, 14, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(271, 17, 9, NULL, '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(272, 17, 1, '2025-06-22 21:00:50', '2025-06-22 18:55:46', '2025-06-22 18:55:46'),
(273, 18, 11, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(274, 18, 6, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(275, 18, 19, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(276, 18, 7, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(277, 18, 12, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(278, 18, 10, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(279, 18, 23, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(280, 18, 13, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(281, 18, 22, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(282, 18, 20, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(283, 18, 8, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(284, 18, 18, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(285, 18, 17, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(286, 18, 14, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(287, 18, 9, NULL, '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(288, 18, 1, '2025-06-22 21:00:50', '2025-06-22 19:01:05', '2025-06-22 19:01:05'),
(289, 19, 11, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(290, 19, 6, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(291, 19, 19, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(292, 19, 7, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(293, 19, 12, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(294, 19, 10, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(295, 19, 23, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(296, 19, 13, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(297, 19, 22, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(298, 19, 20, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(299, 19, 8, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(300, 19, 18, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(301, 19, 17, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(302, 19, 14, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(303, 19, 9, NULL, '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(304, 19, 1, '2025-06-22 21:00:50', '2025-06-22 19:01:06', '2025-06-22 19:01:06'),
(305, 20, 11, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(306, 20, 6, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(307, 20, 19, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(308, 20, 7, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(309, 20, 12, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(310, 20, 10, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(311, 20, 23, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(312, 20, 13, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(313, 20, 22, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(314, 20, 20, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(315, 20, 8, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(316, 20, 18, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(317, 20, 17, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(318, 20, 14, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(319, 20, 9, NULL, '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(320, 20, 1, '2025-06-22 21:00:50', '2025-06-22 19:01:30', '2025-06-22 19:01:30'),
(321, 21, 11, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(322, 21, 6, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(323, 21, 19, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(324, 21, 7, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(325, 21, 12, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(326, 21, 10, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(327, 21, 23, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(328, 21, 13, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(329, 21, 22, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(330, 21, 20, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(331, 21, 8, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(332, 21, 18, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(333, 21, 17, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(334, 21, 14, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(335, 21, 9, NULL, '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(336, 21, 1, '2025-06-22 21:00:50', '2025-06-22 19:01:31', '2025-06-22 19:01:31'),
(337, 22, 11, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(338, 22, 6, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(339, 22, 19, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(340, 22, 7, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(341, 22, 12, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(342, 22, 10, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(343, 22, 23, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(344, 22, 13, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(345, 22, 22, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(346, 22, 20, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(347, 22, 8, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(348, 22, 18, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(349, 22, 17, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(350, 22, 14, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(351, 22, 9, NULL, '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(352, 22, 1, '2025-06-22 21:00:50', '2025-06-22 19:02:57', '2025-06-22 19:02:57'),
(353, 23, 11, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(354, 23, 6, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(355, 23, 19, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(356, 23, 7, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(357, 23, 12, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(358, 23, 10, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(359, 23, 23, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(360, 23, 13, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(361, 23, 22, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(362, 23, 20, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(363, 23, 8, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(364, 23, 18, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(365, 23, 17, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(366, 23, 14, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(367, 23, 9, NULL, '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(368, 23, 1, '2025-06-22 21:00:50', '2025-06-22 19:08:25', '2025-06-22 19:08:25'),
(369, 24, 11, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(370, 24, 6, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(371, 24, 19, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(372, 24, 7, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(373, 24, 12, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(374, 24, 10, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(375, 24, 23, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(376, 24, 13, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(377, 24, 22, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(378, 24, 20, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(379, 24, 8, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(380, 24, 18, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(381, 24, 17, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(382, 24, 14, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(383, 24, 9, NULL, '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(384, 24, 1, '2025-06-22 21:00:50', '2025-06-22 19:22:44', '2025-06-22 19:22:44'),
(385, 25, 11, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(386, 25, 6, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(387, 25, 19, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(388, 25, 7, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(389, 25, 12, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(390, 25, 10, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(391, 25, 23, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(392, 25, 13, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(393, 25, 22, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(394, 25, 20, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(395, 25, 8, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(396, 25, 18, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(397, 25, 17, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(398, 25, 14, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(399, 25, 9, NULL, '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(400, 25, 1, '2025-06-22 21:00:50', '2025-06-22 19:29:10', '2025-06-22 19:29:10'),
(401, 26, 11, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(402, 26, 6, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(403, 26, 19, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(404, 26, 7, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(405, 26, 12, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(406, 26, 10, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(407, 26, 23, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(408, 26, 13, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(409, 26, 22, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(410, 26, 20, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(411, 26, 8, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(412, 26, 18, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(413, 26, 17, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(414, 26, 14, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(415, 26, 9, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(416, 26, 1, '2025-06-22 21:00:50', '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(417, 27, 11, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(418, 27, 6, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(419, 27, 19, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(420, 27, 7, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(421, 27, 12, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(422, 27, 10, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(423, 27, 23, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(424, 27, 13, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(425, 27, 22, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(426, 27, 20, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(427, 27, 8, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(428, 27, 18, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(429, 27, 17, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(430, 27, 14, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(431, 27, 9, NULL, '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(432, 27, 1, '2025-06-22 21:00:50', '2025-06-22 19:29:13', '2025-06-22 19:29:13'),
(433, 28, 11, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(434, 28, 6, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(435, 28, 19, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(436, 28, 7, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(437, 28, 12, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(438, 28, 10, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(439, 28, 23, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(440, 28, 13, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(441, 28, 22, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(442, 28, 20, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(443, 28, 8, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(444, 28, 18, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(445, 28, 17, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(446, 28, 14, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(447, 28, 9, NULL, '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(448, 28, 1, '2025-06-22 21:00:50', '2025-06-22 19:31:38', '2025-06-22 19:31:38'),
(449, 29, 11, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(450, 29, 6, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(451, 29, 19, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(452, 29, 7, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(453, 29, 12, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(454, 29, 10, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(455, 29, 23, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(456, 29, 13, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(457, 29, 22, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(458, 29, 20, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(459, 29, 8, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(460, 29, 18, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(461, 29, 17, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(462, 29, 14, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(463, 29, 9, NULL, '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(464, 29, 1, '2025-06-22 21:00:50', '2025-06-22 19:32:51', '2025-06-22 19:32:51'),
(465, 30, 11, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(466, 30, 6, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(467, 30, 19, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(468, 30, 7, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(469, 30, 12, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(470, 30, 10, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(471, 30, 23, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(472, 30, 13, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(473, 30, 22, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(474, 30, 20, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(475, 30, 8, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(476, 30, 18, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(477, 30, 17, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(478, 30, 14, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(479, 30, 9, NULL, '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(480, 30, 1, '2025-06-22 21:00:50', '2025-06-22 19:33:08', '2025-06-22 19:33:08'),
(481, 31, 11, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(482, 31, 6, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(483, 31, 19, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(484, 31, 7, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(485, 31, 12, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(486, 31, 10, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(487, 31, 23, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(488, 31, 13, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(489, 31, 22, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(490, 31, 20, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(491, 31, 8, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(492, 31, 18, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(493, 31, 17, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(494, 31, 14, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(495, 31, 9, NULL, '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(496, 31, 1, '2025-06-22 21:00:50', '2025-06-22 19:33:37', '2025-06-22 19:33:37'),
(497, 32, 11, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(498, 32, 6, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(499, 32, 19, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(500, 32, 7, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(501, 32, 12, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(502, 32, 10, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(503, 32, 23, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(504, 32, 13, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(505, 32, 22, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(506, 32, 20, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(507, 32, 8, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(508, 32, 18, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(509, 32, 17, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(510, 32, 14, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(511, 32, 9, NULL, '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(512, 32, 1, '2025-06-22 21:00:50', '2025-06-22 19:34:14', '2025-06-22 19:34:14'),
(513, 33, 11, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(514, 33, 6, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(515, 33, 19, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(516, 33, 7, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(517, 33, 12, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(518, 33, 10, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(519, 33, 23, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(520, 33, 13, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(521, 33, 22, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(522, 33, 20, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(523, 33, 8, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(524, 33, 18, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(525, 33, 17, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(526, 33, 14, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(527, 33, 9, NULL, '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(528, 33, 1, '2025-06-22 21:00:50', '2025-06-22 19:35:54', '2025-06-22 19:35:54'),
(545, 35, 11, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(546, 35, 6, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(547, 35, 19, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(548, 35, 7, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(549, 35, 12, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(550, 35, 10, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(551, 35, 23, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(552, 35, 13, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(553, 35, 22, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(554, 35, 20, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(555, 35, 8, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(556, 35, 18, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(557, 35, 17, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(558, 35, 14, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(559, 35, 9, NULL, '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(560, 35, 1, '2025-06-22 21:00:50', '2025-06-22 19:39:16', '2025-06-22 19:39:16'),
(561, 36, 11, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(562, 36, 6, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(563, 36, 19, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(564, 36, 7, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(565, 36, 12, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(566, 36, 10, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(567, 36, 23, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(568, 36, 13, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(569, 36, 22, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(570, 36, 20, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(571, 36, 8, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(572, 36, 18, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(573, 36, 17, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(574, 36, 14, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(575, 36, 9, NULL, '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(576, 36, 1, '2025-06-22 21:00:50', '2025-06-22 19:40:07', '2025-06-22 19:40:07'),
(577, 37, 11, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(578, 37, 6, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(579, 37, 19, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(580, 37, 7, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(581, 37, 12, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(582, 37, 10, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(583, 37, 23, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(584, 37, 13, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(585, 37, 22, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(586, 37, 20, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(587, 37, 8, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(588, 37, 18, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(589, 37, 17, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(590, 37, 14, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(591, 37, 9, NULL, '2025-06-22 19:40:17', '2025-06-22 19:40:18'),
(592, 37, 1, '2025-06-22 21:00:50', '2025-06-22 19:40:17', '2025-06-22 19:40:27'),
(593, 38, 11, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(594, 38, 6, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(595, 38, 19, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(596, 38, 7, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(597, 38, 12, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(598, 38, 10, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(599, 38, 23, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(600, 38, 13, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(601, 38, 22, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(602, 38, 20, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(603, 38, 8, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(604, 38, 18, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(605, 38, 17, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(606, 38, 14, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(607, 38, 9, NULL, '2025-06-22 19:40:39', '2025-06-22 19:40:39'),
(608, 38, 1, '2025-06-26 19:47:21', '2025-06-22 19:40:39', '2025-06-26 19:47:21'),
(609, 39, 11, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(610, 39, 6, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(611, 39, 19, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(612, 39, 7, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(613, 39, 12, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(614, 39, 10, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(615, 39, 23, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(616, 39, 13, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(617, 39, 22, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(618, 39, 20, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(619, 39, 24, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(620, 39, 8, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:54'),
(621, 39, 18, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(622, 39, 17, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(623, 39, 14, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(624, 39, 9, NULL, '2025-06-29 18:56:38', '2025-06-29 18:56:39'),
(625, 39, 1, '2025-07-09 20:24:01', '2025-06-29 18:56:38', '2025-07-09 20:24:01'),
(626, 40, 11, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(627, 40, 6, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(628, 40, 19, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(629, 40, 7, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(630, 40, 12, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(631, 40, 10, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(632, 40, 23, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(633, 40, 13, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(634, 40, 22, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(635, 40, 20, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(636, 40, 24, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(637, 40, 8, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(638, 40, 18, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(639, 40, 17, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(640, 40, 14, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(641, 40, 9, NULL, '2025-07-09 20:24:20', '2025-07-09 20:24:23'),
(642, 40, 1, NULL, '2025-07-09 20:24:20', '2025-07-09 21:37:35'),
(643, 41, 11, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(644, 41, 6, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(645, 41, 19, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(646, 41, 7, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(647, 41, 12, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(648, 41, 10, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(649, 41, 23, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(650, 41, 13, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(651, 41, 22, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(652, 41, 20, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(653, 41, 24, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(654, 41, 8, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(655, 41, 18, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(656, 41, 17, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(657, 41, 14, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(658, 41, 9, NULL, '2025-07-09 21:29:39', '2025-07-09 21:29:40'),
(659, 41, 1, NULL, '2025-07-09 21:29:39', '2025-07-10 00:31:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` int NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `companyTax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_user_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `email`, `phone`, `address`, `total_amount`, `package_id`, `note`, `companyTax`, `companyName`, `order_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'truong', 'truongbackend@gmail.com', '12214', '1232', 21, 4, NULL, 'hewhehwqh', NULL, 1, 2, '2025-05-29 03:09:53', '2025-06-29 03:09:58'),
(2, 'truong', 'truongbackend@gmail.com', 'aaa', 'aa', 12, 3, NULL, NULL, NULL, 1, 2, '2025-06-29 03:11:10', '2025-06-29 03:11:21'),
(3, 'truong', 'truongbackend@gmail.com', '012402954', '12412', 21, 4, NULL, NULL, NULL, 1, 1, '2025-06-29 03:36:52', '2025-06-29 03:36:52'),
(4, 'truong', 'hhh@gmail.com', 'hêhhe', 'ưqewq', 21, 4, NULL, NULL, NULL, 25, 2, '2025-06-29 03:51:02', '2025-06-29 03:51:39'),
(5, 'truong', 'truong@gmail.com', '213', '123', 21, 4, NULL, NULL, NULL, 8, 1, '2025-06-29 21:57:24', '2025-06-29 21:57:24'),
(6, 'truong', 'truong@gmail.com', 'hehehe', '123', 1131, 7, NULL, NULL, NULL, 8, 1, '2025-06-29 22:23:03', '2025-06-29 22:23:03'),
(7, 'truong', 'truong@gmail.com', 'sad', 'ád', 21, 4, 'sda', NULL, NULL, 8, 1, '2025-06-29 22:48:49', '2025-06-29 22:48:49'),
(8, 'truong', 'truong@gmail.com', '213', '123', 21, 4, '123', NULL, NULL, 8, 1, '2025-06-29 22:50:06', '2025-06-29 22:50:06'),
(9, 'truong', 'truong@gmail.com', '123', '2131', 21, 4, '321', NULL, NULL, 8, 1, '2025-06-29 22:50:32', '2025-06-29 22:50:32'),
(10, 'truong', 'truong@gmail.com', '123', '3', 21, 4, '123', NULL, NULL, 8, 1, '2025-06-29 22:52:31', '2025-06-29 22:52:31'),
(11, 'truong', 'truong@gmail.com', '213', '3', 21, 4, '123', NULL, NULL, 8, 1, '2025-06-29 22:56:01', '2025-06-29 22:56:01'),
(12, 'truong', 'truong@gmail.com', '123', '2131', 21, 4, '23', NULL, NULL, 8, 1, '2025-06-29 22:58:51', '2025-06-29 22:58:51'),
(13, 'truong', 'truong@gmail.com', '03581155', 'mới', 21, 4, NULL, NULL, NULL, 8, 1, '2025-06-30 19:39:52', '2025-06-30 19:39:52'),
(14, 'truong', 'truong@gmail.com', '2421321', '123', 21, 4, '123', NULL, NULL, 8, 1, '2025-06-30 19:40:36', '2025-06-30 19:40:36'),
(15, 'có công ty', 'truong@gmail.com', '123123', '12', 21, 4, '123', '123213', '123123', 8, 1, '2025-06-30 19:41:55', '2025-06-30 19:41:55'),
(16, 'truon5555g', 'truong213214214@gmail.com', '213', '123', 1131, 7, '123', '213', '213', 8, 1, '2025-06-30 19:46:08', '2025-06-30 19:46:08'),
(17, 'truong', 'truong@gmail.com', '51252122', '214', 21, 4, 'sấ', 'công ty bividsaaa', 'công ty bividsaaa', 8, 1, '2025-06-30 23:13:59', '2025-06-30 23:13:59'),
(18, 'truong', 'truong@gmail.com', '21321', '21312', 1131, 7, NULL, '213123', '3213', 8, 1, '2025-06-30 23:18:57', '2025-06-30 23:18:57'),
(19, 'truong', 'truong@gmail.com', '213123', '123', 21, 4, '123', '123', '213', 8, 1, '2025-06-30 23:20:20', '2025-06-30 23:20:20'),
(20, 'truong', 'truong@gmail.com', '3213', '12312', 1131, 7, '4123', '213421', '12321', 8, 1, '2025-06-30 23:22:24', '2025-06-30 23:22:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` int NOT NULL,
  `discould` decimal(5,2) NOT NULL,
  `default_packages` tinyint(1) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `expiration_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `packages`
--

INSERT INTO `packages` (`id`, `created_at`, `updated_at`, `name`, `note`, `price`, `discould`, `default_packages`, `status`, `expiration_time`) VALUES
(3, '2025-06-08 19:12:28', '2025-06-12 09:34:41', 'truong', '21', 12, 12.00, 1, 1, '10'),
(4, '2025-06-08 19:57:02', '2025-06-12 09:34:41', 'base', NULL, 21, 12.00, 0, 1, '12'),
(7, '2025-06-22 19:23:31', '2025-06-22 19:23:31', 'a', '213', 1131, 21.00, 0, 1, '12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user.list', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(2, 'user.create', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(3, 'user.edit', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(4, 'user.delete', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(7, 'package.list', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(8, 'package.create', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(9, 'package.edit', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(10, 'package.delete', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(11, 'role.list', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(12, 'role.create', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(13, 'role.edit', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(14, 'role.delete', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(15, 'report.list', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(16, 'report.create', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(17, 'report.edit', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(18, 'report.delete', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(19, 'notification.list', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(20, 'notification.create', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(21, 'notification.edit', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(22, 'notification.delete', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(23, 'complaints.list', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(24, 'complaints.create', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(25, 'complaints.edit', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(26, 'complaints.delete', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(27, 'product.list', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(28, 'product.create', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(29, 'product.edit', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(30, 'product.delete', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(35, 'orders.create', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(36, 'orders.edit', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(37, 'orders.delete', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26'),
(38, 'orders.list', 'api', '2024-07-20 01:59:26', '2024-07-25 01:59:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accounting_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `combo_detail_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `default_role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `note`, `status`, `default_role`) VALUES
(1, 'administration', 'api', '2025-06-09 23:23:02', '2025-06-22 20:26:39', 'Quant trị viên', 1, 0),
(2, 'nhân viên content', 'api', '2025-06-09 23:46:09', '2025-06-29 18:55:03', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_account_ecommerce`
--

CREATE TABLE `setting_account_ecommerce` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interpretation` json DEFAULT NULL,
  `product_name_setting` json DEFAULT NULL,
  `added_tax_vat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_account_ecommerce`
--

INSERT INTO `setting_account_ecommerce` (`id`, `customer_code`, `customer_name`, `interpretation`, `product_name_setting`, `added_tax_vat`, `warehouse`, `payment_method`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'heheheheheh', '1221', '[\"2\", \"1\", \"3\"]', '[\"2\"]', '33311', '324234', '1', 1, '2025-07-13 21:32:51', '2025-07-30 20:05:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_account_lazada`
--

CREATE TABLE `setting_account_lazada` (
  `id` bigint UNSIGNED NOT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lazada',
  `document_number_prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_voucher_prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_cash_debt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_revenue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_account_lazada`
--

INSERT INTO `setting_account_lazada` (`id`, `shop_id`, `type`, `document_number_prefix`, `issue_voucher_prefix`, `account_cash_debt`, `account_revenue`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 7, 'lazada', '', '', '', '', 1, '2025-08-01 03:03:14', '2025-08-01 03:06:40'),
(5, 8, 'lazada', '123', '213', '1244214', '214214214214', 1, '2025-08-01 03:03:14', '2025-08-01 03:06:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_package` date DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `expiration_package` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `packages_id` int DEFAULT NULL,
  `api_token` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_created_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `create_package`, `note`, `expiration_package`, `status`, `packages_id`, `api_token`, `token_created_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'truong', 'truongbackend@gmail.com', '2032-02-25 02:51:34', '$2a$12$NFemA43XtUrxRyeMbTcKA.PQXWX9DG9F7Yi/vsIu.Xb3TbTHbN1GC', '0521266565', '0521266565121', '2025-06-30', NULL, '2026-07-31', 1, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzU0MjczMzgyLCJleHAiOjE3NTQ4NzgxODIsIm5iZiI6MTc1NDI3MzM4MiwianRpIjoieHdBVlFtYlBGSlBNMUZ0USIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.6Froj4tYEYCLWVKl7RxmPsyI7lsklHyLc6bmMqO5chc', '2025-06-22 23:06:32', NULL, '2024-07-20 01:59:26', '2025-08-03 19:09:42'),
(6, 'admin', 'admin@gmail.com', NULL, '$2y$10$p4cmVtGZAMVWOhflDtgbguJ9UI9vjMm.Daa4otYgE.0Dgq2j6QUUC', '0352848002', '412', '2025-06-09', NULL, '2025-06-12', 0, 4, '', NULL, NULL, '2025-06-09 01:06:54', '2025-06-09 19:55:06'),
(7, 'truong', 'gh@gmail.com', NULL, '$2y$10$NfHYNUt.p5eKgthmkVwlQ.4kcDgEINRv4gz9u2XeaH/uku22UdiVG', '352848002', '214', '2025-06-09', NULL, '2025-06-27', 1, 3, '', NULL, NULL, '2025-06-09 01:07:48', '2025-06-09 01:14:09'),
(8, 'truong', 'truong@gmail.com', NULL, '$2a$12$NFemA43XtUrxRyeMbTcKA.PQXWX9DG9F7Yi/vsIu.Xb3TbTHbN1GC', NULL, NULL, NULL, NULL, NULL, 1, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzUzOTI4NTgyLCJleHAiOjE3NTQ1MzMzODIsIm5iZiI6MTc1MzkyODU4MiwianRpIjoiUzRDbVJxOTZjZDh5c3B2VSIsInN1YiI6IjgiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.g5SVW8GtmP2j50zajHdflmGuzETtpTvAFgVSFhm5h18', NULL, NULL, '2025-06-09 03:00:02', '2025-07-30 19:23:02'),
(9, 'truong', 'truong123@gmail.com', NULL, '$2y$10$6lJNvdwSjAu08wUykhdwjuatIOMFAy.w7qkETamqA/N.KYQQ98ZQO', '0352848005', NULL, '2025-06-10', NULL, '2025-06-11', 1, NULL, 'EofAHhhFyHEOEnPxVFq79Hx6MDaBMGyhyjfkvcPEHGr9Woo6V4qHZvo1SBq5', NULL, NULL, '2025-06-10 03:01:17', '2025-06-10 03:04:10'),
(10, 'hehehe', 'hehee@gmail.com', NULL, '$2y$10$RFDyyCC1q9VFoEnBEhTP4.5usuK/.CvD7QF3SXAkk.uZTDrJf0Lp6', NULL, NULL, '2025-06-10', NULL, '2025-06-11', 1, NULL, NULL, NULL, NULL, '2025-06-10 03:02:53', '2025-06-10 03:02:53'),
(11, 'aa', 'abc@gmail.com', NULL, '$2y$10$iy8XIcOa33X85rJy2NXpJulMG9CqEGs20RzfRvE9P8SviMQWdZ/Ky', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2025-06-12 08:26:01', '2025-06-12 08:26:01'),
(12, 'hêh ngay 22', 'he22@gmail.com', NULL, '$2y$10$ceVwL7zfmBOZ18uHKgPBr.ROO5i20l.NU4JpELDlgzidUwM.lAR52', NULL, NULL, NULL, NULL, '2025-06-22', 1, 3, NULL, NULL, NULL, '2025-06-12 09:35:17', '2025-06-12 09:35:17'),
(13, 'ngay moii', 'ngaymoi@gmail.com', NULL, '$2y$10$zzpWMnrj25jjBMXajpn7DeKS36xQlY4LsKe.hCC1bPnS2ek3wZNrO', NULL, NULL, '2025-06-12', NULL, '2025-06-22', 1, 3, NULL, NULL, NULL, '2025-06-12 09:39:49', '2025-06-12 09:39:49'),
(14, 'truong12', 'truong12@gmail.com', NULL, '$2y$10$n2Ixc5A0LI2AwDIkqWmc1egD2CejmBGojZC.vz3maC36oan8Hmi2W', NULL, NULL, '2025-06-12', NULL, '2025-06-22', 1, 3, NULL, NULL, NULL, '2025-06-12 09:58:34', '2025-06-12 09:58:34'),
(17, 'truong123', 'truong11322@gmail.com', NULL, '$2y$10$n2Ixc5A0LI2AwDIkqWmc1egD2CejmBGojZC.vz3maC36oan8Hmi2W', NULL, NULL, '2025-06-12', NULL, '2025-06-22', 1, 3, NULL, NULL, NULL, '2025-06-12 09:58:34', '2025-06-12 09:58:34'),
(18, 'truong', 'truong1@gmail.com', NULL, '$2y$10$TVFRk3aGoQ3//jK3Zj34i.5ngzotHUdXanQZqwh2gqwdbJc63DSGW', NULL, NULL, '2025-06-15', NULL, '2025-06-25', 1, 3, NULL, NULL, NULL, '2025-06-15 08:34:07', '2025-06-15 08:34:07'),
(19, 'truong', 'ahh1h2@gmail.com', NULL, '$2y$10$52.ihW2Y9xSqqM7TAou5HOv5kIkwSOL667WAfVWB2jjyG8l/fAP8W', NULL, NULL, '2025-06-16', NULL, '2025-06-26', 1, 3, NULL, NULL, NULL, '2025-06-16 01:51:03', '2025-06-16 01:51:03'),
(20, 'Admin', 'nhatmai.ketoan@gmail.com', NULL, '$2y$10$xnb7XbiB63I/V6N6VKcqduAQrAvJIUONHtNrEVaLkhnut.GbCgKJG', NULL, NULL, '2025-06-16', NULL, '2025-06-26', 1, 3, NULL, NULL, NULL, '2025-06-16 04:41:33', '2025-06-16 04:41:33'),
(22, 'Lim', 'nguyenthily.weup@gmail.com', NULL, '$2y$10$qSOdrgkJsONwELAJG7PDfuamhV8NCXwvLD5mJZXU/3SlfvxuKgCSG', NULL, NULL, '2025-06-16', NULL, '2025-06-26', 1, 3, 'tBpTPG2RPNnhhj8WzRpX4Xf3bocDmOuFtRZFAaPaRlK8yS2fcFzIO6PISCBI', NULL, NULL, '2025-06-16 05:19:23', '2025-06-16 06:32:55'),
(23, 'hoàng hải đăng', 'hoanghaidang.dev@gmail.com', NULL, '$2y$10$Qvcxwi0TOvdAjbUFahoHlOhDYgT8QNMNKBYWCJuvFEJKktXSGoGDC', NULL, NULL, '2025-06-16', NULL, '2025-06-26', 1, 3, 'URD9HC82nYkGKLISkZ6o7FFEmBv6qL9kWedkliTZHGtncuRUpVskPifYVlbn', NULL, NULL, '2025-06-16 07:30:08', '2025-06-16 08:20:28'),
(24, 'nuni', 'truo213ng@gmail.com', NULL, '$2y$10$c.t3bdivOyKETZ4XCTpym.Hnu5mfkyUK1OrbYbIYaDpo5G0XhBaP6', NULL, NULL, '2025-06-23', NULL, '2025-07-03', 1, 3, NULL, NULL, NULL, '2025-06-22 20:16:54', '2025-06-22 20:16:54');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `custom_notifications`
--
ALTER TABLE `custom_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `history_export`
--
ALTER TABLE `history_export`
  ADD PRIMARY KEY (`history_id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `lazada_shop_tokens`
--
ALTER TABLE `lazada_shop_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `notification_user`
--
ALTER TABLE `notification_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notification_user_notification_id_user_id_unique` (`notification_id`,`user_id`),
  ADD KEY `notification_user_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_package_id_foreign` (`package_id`);

--
-- Chỉ mục cho bảng `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Chỉ mục cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `setting_account_ecommerce`
--
ALTER TABLE `setting_account_ecommerce`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting_account_lazada`
--
ALTER TABLE `setting_account_lazada`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `custom_notifications`
--
ALTER TABLE `custom_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `history_export`
--
ALTER TABLE `history_export`
  MODIFY `history_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `lazada_shop_tokens`
--
ALTER TABLE `lazada_shop_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `notification_user`
--
ALTER TABLE `notification_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=660;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `setting_account_ecommerce`
--
ALTER TABLE `setting_account_ecommerce`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `setting_account_lazada`
--
ALTER TABLE `setting_account_lazada`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `notification_user`
--
ALTER TABLE `notification_user`
  ADD CONSTRAINT `notification_user_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `custom_notifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
