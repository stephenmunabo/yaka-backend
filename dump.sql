-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 22 2018 г., 07:59
-- Версия сервера: 5.6.39-83.1
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u0433526_delivery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `api_tokens`
--

CREATE TABLE `api_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `_lft` int(10) UNSIGNED NOT NULL,
  `_rgt` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '500',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `city_user`
--

CREATE TABLE `city_user` (
  `city_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_areas`
--

CREATE TABLE `delivery_areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_boys`
--

CREATE TABLE `delivery_boys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `delivery_boys`
--

INSERT INTO `delivery_boys` (`id`, `name`, `created_at`, `updated_at`, `login`, `password`) VALUES
(1, 'admin', '2018-04-12 10:09:32', '2018-04-12 10:09:32', '', ''),
(2, 'Ken', '2018-04-19 03:47:39', '2018-04-19 03:47:39', '', ''),
(3, 'Jrllo', '2018-04-23 06:53:03', '2018-04-23 06:53:03', '', ''),
(4, 'james t', '2018-04-23 11:16:44', '2018-04-23 11:16:44', '', ''),
(5, 'Hussam', '2018-04-30 09:16:37', '2018-04-30 09:16:37', '', ''),
(6, 'Arshad snack', '2018-05-06 23:18:27', '2018-05-08 02:59:05', '', ''),
(7, 'boy1', '2018-05-19 12:40:04', '2018-05-19 12:40:04', 'boy1', '$2y$10$aU7HggoTzq7E8dZ2ScK8l.FbHUi04pLAtfKgcL3l5.scE3i/7moMO'),
(8, 'John Doe', '2018-05-19 17:44:01', '2018-05-19 17:46:24', 'jd@test.com', '$2y$10$CUnI7tf6SOLMyoXte8vIy.dAw1vDIe1ahFA6w4uuXbhHbOu00u/7a'),
(9, 'levan', '2018-05-19 17:44:43', '2018-05-19 17:52:23', 'com@gmail.com', '$2y$10$oh6gqdM/x/BUC6vipwVVpe8VAhtmVtcid0QrVhfDQO0sZSPRVjKKm');

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_boy_api_tokens`
--

CREATE TABLE `delivery_boy_api_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `delivery_boy_id` int(10) UNSIGNED NOT NULL,
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `push_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `delivery_boy_api_tokens`
--

INSERT INTO `delivery_boy_api_tokens` (`id`, `token`, `delivery_boy_id`, `platform`, `push_token`, `created_at`, `updated_at`) VALUES
(1, '643d9bd82ba35540ea4a876d69d81417', 7, '', 'de2bf9f1-ebe5-4bab-a122-e8d4135f3c87', '2018-05-19 12:40:28', '2018-05-19 12:42:59'),
(2, '48f019516c1a5326f354d7d3f5119185', 7, '', 'de2bf9f1-ebe5-4bab-a122-e8d4135f3c87', '2018-05-19 13:01:53', '2018-05-19 13:02:08'),
(3, '576f5e7794b6b8c047c8e9636fb9b055', 7, '', '', '2018-05-19 13:06:48', '2018-05-19 13:06:48'),
(4, '000225e13a97ebe51338197fde05f132', 7, '', '', '2018-05-19 13:10:54', '2018-05-19 13:10:54');

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_boy_messages`
--

CREATE TABLE `delivery_boy_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_id` int(10) UNSIGNED NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `delivery_boy_messages`
--

INSERT INTO `delivery_boy_messages` (`id`, `message`, `delivery_boy_id`, `read`, `created_at`, `updated_at`) VALUES
(1, 'test', 7, 1, '2018-05-19 12:43:43', '2018-05-19 13:04:18'),
(2, 'qwer', 7, 0, '2018-05-19 13:04:49', '2018-05-19 13:04:49'),
(3, 'qwer', 7, 0, '2018-05-19 13:24:10', '2018-05-19 13:24:10'),
(4, 'delivery_boy_messages.new_order', 1, 0, '2018-05-19 13:31:27', '2018-05-19 13:31:27'),
(5, 'delivery_boy_messages.new_order', 2, 0, '2018-05-19 13:31:55', '2018-05-19 13:31:55'),
(6, 'delivery_boy_messages.new_order', 7, 0, '2018-05-19 13:32:24', '2018-05-19 13:32:24'),
(7, 'delivery_boy_messages.new_order', 1, 0, '2018-05-19 13:33:52', '2018-05-19 13:33:52'),
(8, 'You have the new order assigned', 2, 0, '2018-05-19 13:34:35', '2018-05-19 13:34:35'),
(9, 'You have the new order assigned', 7, 0, '2018-05-19 13:34:37', '2018-05-19 13:34:37'),
(10, 'You have the new order assigned', 8, 0, '2018-05-19 17:44:42', '2018-05-19 17:44:42'),
(11, 'test', 9, 0, '2018-05-19 17:47:32', '2018-05-19 17:47:32');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_30_180306_create_categories_table', 1),
(4, '2017_03_31_124009_add_image_to_categories', 1),
(5, '2017_04_03_134750_create_products_table', 1),
(6, '2017_04_03_140913_create_product_images_table', 1),
(7, '2017_04_07_145559_create_orders_table', 1),
(8, '2017_04_07_145619_create_ordered_products_table', 1),
(9, '2017_04_09_101351_create_news_items_table', 1),
(10, '2017_04_09_140135_create_settings_table', 1),
(11, '2017_04_09_180814_create_push_messages_table', 1),
(12, '2017_04_09_192319_add_gcm_project_to_settings', 1),
(13, '2017_04_13_081723_change_news_feed_texts', 2),
(14, '2017_04_19_182522_create_delivery_areas_table', 3),
(15, '2017_04_20_054541_add_delivery_area_id_to_orders', 4),
(16, '2017_05_11_074026_add_notification_email_to_settings', 5),
(17, '2017_05_13_134349_create_promo_codes_table', 6),
(18, '2017_05_13_140716_add_promo_code_to_orders', 6),
(19, '2018_03_09_125327_add_stripe_fields_to_settings', 7),
(20, '2018_03_09_125955_add_payment_method_to_orders', 7),
(21, '2018_03_11_082151_add_paypal_to_settings', 7),
(22, '2018_03_12_120831_add_paypal_id_to_orders', 7),
(23, '2018_03_26_103140_create_tax_groups_table', 8),
(24, '2018_03_26_105638_add_tax_group_id_to_products', 8),
(25, '2018_03_26_112646_add_total_tax_to_orders', 8),
(26, '2018_03_26_113257_add_tax_included_to_settings', 8),
(27, '2018_03_27_090932_create_cities_table', 8),
(28, '2018_03_27_091215_create_restaurants_table', 8),
(29, '2018_03_27_094031_add_restaurant_id_to_categories', 8),
(30, '2018_03_27_094521_add_multiple_restaurants_to_settings', 8),
(31, '2018_03_27_121400_add_city_to_orders', 8),
(32, '2018_03_27_123051_add_city_to_delivery_areas', 8),
(33, '2018_03_27_140351_add_city_to_promo_codes', 8),
(34, '2018_03_28_071528_create_customers_table', 8),
(35, '2018_03_28_073738_add_customer_id_to_orders', 8),
(36, '2018_03_28_080253_add_signup_required_to_settings', 8),
(37, '2018_03_28_090304_create_api_tokens', 8),
(38, '2018_03_30_013810_create_cities_users_table', 8),
(39, '2018_03_30_015454_add_access_fields_to_users', 8),
(40, '2018_04_02_104602_create_delivery_boys_table', 8),
(41, '2018_04_02_104728_add_delivery_boy_id_to_orders', 8),
(42, '2018_04_02_110159_add_access_delivery_boys_to_users', 8),
(43, '2018_04_04_075520_add_paypal_production_to_settings', 8),
(44, '2018_04_06_071254_add_city_id_to_news_items', 8),
(45, '2018_04_20_123420_create_order_statuses_table', 9),
(46, '2018_04_20_123528_add_order_status_id_to_orders', 9),
(47, '2018_04_20_124947_add_access_order_statuses_to_users', 9),
(48, '2018_04_21_145653_add_date_format_backend_to_setings', 10),
(49, '2018_04_21_171950_add_date_format_app_to_settings', 10),
(50, '2018_05_02_105736_add_login_to_delivery_boys', 11),
(51, '2018_05_02_110837_create_delivery_boy_api_tokens', 11),
(52, '2018_05_07_114438_create_delivery_boy_messages_table', 11),
(53, '2018_05_16_142852_add_driver_onesignal_id_to_settings', 11),
(54, '2018_05_17_144726_add_available_to_delivery_boy_to_order_statuses', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `news_items`
--

CREATE TABLE `news_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `announce` text COLLATE utf8mb4_unicode_ci,
  `full_text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `product_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double(8,2) DEFAULT NULL,
  `lng` double(8,2) DEFAULT NULL,
  `total` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delivery_area_id` int(10) UNSIGNED DEFAULT NULL,
  `delivery_price` double(8,2) NOT NULL DEFAULT '0.00',
  `promo_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `promo_code_id` int(11) DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'cash',
  `stripe_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `paypal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `total_with_tax` double(8,2) NOT NULL DEFAULT '0.00',
  `restaurant_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `delivery_boy_id` int(10) UNSIGNED DEFAULT NULL,
  `order_status_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '500',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `available_to_delivery_boy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` double(8,2) NOT NULL,
  `price_old` double(8,2) DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tax_group_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `discount_in_percent` tinyint(1) NOT NULL,
  `min_price` double(8,2) NOT NULL DEFAULT '0.00',
  `limit_use_count` int(11) NOT NULL,
  `times_used` int(11) NOT NULL DEFAULT '0',
  `active_from` datetime NOT NULL,
  `active_to` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `restaurant_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `push_messages`
--

CREATE TABLE `push_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '0',
  `error` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `push_messages`
--

INSERT INTO `push_messages` (`id`, `message`, `status`, `error`, `created_at`, `updated_at`) VALUES
(1, 'test push', 3, '', '2017-04-14 13:07:25', '2017-04-14 13:07:25'),
(2, 'one more test push', 0, '', '2017-04-20 05:40:33', '2017-04-20 05:40:33'),
(3, 'one more test push', 0, '', '2017-04-20 05:40:45', '2017-04-20 05:40:45'),
(4, 'I\'m push', 0, '', '2017-04-21 07:46:45', '2017-04-21 07:46:45'),
(5, 'Push again', 0, '', '2017-04-21 15:17:21', '2017-04-21 15:17:21'),
(6, 'xxx', 0, '', '2017-04-21 15:17:44', '2017-04-21 15:17:44'),
(7, 'qwe', 0, '', '2017-04-21 15:18:18', '2017-04-21 15:18:18'),
(8, 'qwe222', 1, '', '2017-04-21 15:19:42', '2017-04-21 15:19:42'),
(9, 'does it works?', 1, '', '2017-04-21 19:21:35', '2017-04-21 19:21:35'),
(10, 'teast', 1, '', '2017-04-24 10:35:46', '2017-04-24 10:35:46'),
(11, 'testtt', 1, '', '2017-04-25 05:12:06', '2017-04-25 05:12:06'),
(12, 'testtt', 1, '', '2017-04-27 14:43:27', '2017-04-27 14:43:27'),
(13, 'New Combo Burger with Fries , Just 29 Dhs , order  now', 1, '', '2017-04-28 07:32:01', '2017-04-28 07:32:01'),
(14, '2 x 1 en pizzas familiares solo si  muestras el app en tu celular al pagar.', 1, '', '2017-04-28 19:09:20', '2017-04-28 19:09:20'),
(15, 'test', 1, '', '2017-05-01 05:56:19', '2017-05-01 05:56:19'),
(16, 'test 2', 1, '', '2017-05-01 05:56:35', '2017-05-01 05:56:35'),
(17, 'vxv d', 1, '', '2017-05-02 15:34:11', '2017-05-02 15:34:11'),
(18, 'test', 1, '', '2017-05-07 06:57:36', '2017-05-07 06:57:36'),
(19, 'qweqew', 1, '', '2017-05-07 21:58:43', '2017-05-07 21:58:43'),
(20, 'ooyuoyiyiuy', 1, '', '2017-05-07 22:02:19', '2017-05-07 22:02:19'),
(21, 'test', 1, '', '2017-05-09 08:48:22', '2017-05-09 08:48:22'),
(22, 'ffffff', 1, '', '2017-05-11 08:04:16', '2017-05-11 08:04:16'),
(23, 'l,dkjhfbkjvclk,cjkxcnbkxcnvb,nvblk,', 1, '', '2017-05-14 07:42:16', '2017-05-14 07:42:16'),
(24, 'novidades .msg teste', 1, '', '2017-05-15 13:53:17', '2017-05-15 13:53:17'),
(25, 'bora pra nosso bar, musica ao vivo hoje!', 1, '', '2017-05-15 14:00:26', '2017-05-15 14:00:26'),
(26, 'testeeeee', 1, '', '2017-05-21 14:16:25', '2017-05-21 14:16:25'),
(27, 'Nada melhor do que um caldo neste friozinho.. Então vem pra Cabana, nessa quinta feira teremos caldinho de feijão com torresminho de acompanhamento, ?????', 1, '', '2017-05-21 14:17:21', '2017-05-21 14:17:21'),
(28, 'Nada melhor do que um caldo neste friozinho.. Então vem pra Cabana, nessa quinta feira teremos caldinho de feijão com torresminho de acompanhamento, ?????', 1, '', '2017-05-21 14:19:17', '2017-05-21 14:19:17'),
(29, 'Cabana Hamburgueria e Petiscaria', 1, '', '2017-05-21 14:28:23', '2017-05-21 14:28:23'),
(30, 'Hello', 1, '', '2017-06-03 18:40:53', '2017-06-03 18:40:53'),
(31, 'Hello', 1, '', '2017-06-05 09:56:42', '2017-06-05 09:56:42'),
(32, 'Hi, this is a test', 1, '', '2017-06-05 14:48:40', '2017-06-05 14:48:40'),
(33, 'Today free delivery', 1, '', '2017-06-05 14:49:05', '2017-06-05 14:49:05'),
(34, 'asfasdf', 1, '', '2017-06-21 07:13:26', '2017-06-21 07:13:26'),
(35, 'as', 1, '', '2017-06-23 05:05:17', '2017-06-23 05:05:17'),
(36, 'bdgf', 1, '', '2017-06-24 06:45:50', '2017-06-24 06:45:50'),
(37, 'test', 1, '', '2017-06-24 06:46:51', '2017-06-24 06:46:51'),
(38, 'test2', 1, '', '2017-06-24 06:47:04', '2017-06-24 06:47:04'),
(39, 'last test', 1, '', '2017-06-24 06:47:19', '2017-06-24 06:47:19'),
(40, 'test', 1, '', '2017-07-02 01:02:05', '2017-07-02 01:02:05'),
(41, 'Hello', 0, '', '2017-07-08 16:45:12', '2017-07-08 16:45:12'),
(42, 'teste', 0, '', '2017-07-12 00:50:23', '2017-07-12 00:50:23'),
(43, 'redy', 0, '', '2017-07-24 18:44:22', '2017-07-24 18:44:22'),
(44, 'redy', 0, '', '2017-07-24 18:44:23', '2017-07-24 18:44:23'),
(45, '999', 0, '', '2017-08-03 03:53:23', '2017-08-03 03:53:23'),
(46, 'teste', 0, '', '2017-08-05 15:01:09', '2017-08-05 15:01:09'),
(47, 'testando uma mensagem', 0, '', '2017-08-05 15:07:08', '2017-08-05 15:07:08'),
(48, 'testando uma mensagem', 0, '', '2017-08-05 15:07:12', '2017-08-05 15:07:12'),
(49, 'aaa', 0, '', '2017-08-08 09:52:54', '2017-08-08 09:52:54'),
(50, 'qwedsadsa', 0, '', '2017-08-18 13:04:03', '2017-08-18 13:04:03'),
(51, 'HGFHGHDHDF', 0, '', '2017-09-04 08:28:20', '2017-09-04 08:28:20'),
(52, 'gfggfgd g df gdf gdf', 0, '', '2017-09-04 08:28:33', '2017-09-04 08:28:33'),
(53, 'ferff fer fer', 0, '', '2017-09-07 21:15:03', '2017-09-07 21:15:03'),
(54, 'cxvcvfvsdfsd', 0, '', '2017-09-18 09:27:51', '2017-09-18 09:27:51'),
(55, 'Hello test', 0, '', '2017-09-28 01:12:38', '2017-09-28 01:12:38'),
(56, 'treste', 0, '', '2017-09-29 21:19:44', '2017-09-29 21:19:44'),
(57, 'a', 0, '', '2017-09-30 07:57:07', '2017-09-30 07:57:07'),
(58, 'push message test', 0, '', '2017-10-05 05:05:43', '2017-10-05 05:05:43'),
(59, 'tester', 0, '', '2017-10-10 20:19:01', '2017-10-10 20:19:01'),
(60, 'test', 0, '', '2017-10-11 16:23:01', '2017-10-11 16:23:01'),
(61, 'test', 0, '', '2017-10-21 19:52:50', '2017-10-21 19:52:50'),
(62, 'ngekngok', 0, '', '2017-11-09 03:01:07', '2017-11-09 03:01:07'),
(63, '5454545', 0, '', '2017-11-09 16:29:50', '2017-11-09 16:29:50'),
(64, 'Teste', 0, '', '2017-11-22 07:46:49', '2017-11-22 07:46:49'),
(65, 'd', 0, '', '2017-11-22 22:27:32', '2017-11-22 22:27:32'),
(66, 'test', 0, '', '2017-11-28 07:33:42', '2017-11-28 07:33:42'),
(67, 'xzxz\\x', 0, '', '2017-12-12 00:32:30', '2017-12-12 00:32:30'),
(68, NULL, 0, '', '2017-12-12 13:30:18', '2017-12-12 13:30:18'),
(69, 'sdfsdf', 0, '', '2017-12-12 13:30:19', '2017-12-12 13:30:19'),
(70, NULL, 0, '', '2017-12-22 01:02:16', '2017-12-22 01:02:16'),
(71, 'Testing 123', 0, '', '2017-12-24 04:37:01', '2017-12-24 04:37:01'),
(72, 'hjgb hf    f', 0, '', '2017-12-26 15:19:25', '2017-12-26 15:19:25'),
(73, 'tt', 0, '', '2018-01-08 07:24:57', '2018-01-08 07:24:57'),
(74, 'hello', 0, '', '2018-01-20 14:15:44', '2018-01-20 14:15:44'),
(75, 'uigiug   ggiu uhui', 0, '', '2018-01-23 02:05:07', '2018-01-23 02:05:07'),
(76, 'TEST', 0, '', '2018-01-28 20:11:35', '2018-01-28 20:11:35'),
(77, 'test', 0, '', '2018-01-29 23:21:29', '2018-01-29 23:21:29'),
(78, 'SU pedido ya esta', 0, '', '2018-01-30 17:25:03', '2018-01-30 17:25:03'),
(79, 'SU pedido ya esta', 0, '', '2018-01-30 17:25:30', '2018-01-30 17:25:30'),
(80, 'Promocao ATiva', 0, '', '2018-02-12 16:32:25', '2018-02-12 16:32:25'),
(81, NULL, 0, '', '2018-02-14 15:51:34', '2018-02-14 15:51:34'),
(82, 'AMK SIZIN', 0, '', '2018-02-19 11:39:40', '2018-02-19 11:39:40'),
(83, 'ffff', 0, '', '2018-02-19 13:35:22', '2018-02-19 13:35:22'),
(84, 'fala', 0, '', '2018-02-27 17:59:17', '2018-02-27 17:59:17'),
(85, 'big update', 1, '', '2018-03-09 04:23:49', '2018-03-09 04:23:49'),
(86, 'test push', 1, '', '2018-03-13 07:00:13', '2018-03-13 07:00:13'),
(87, '--==', 1, '', '2018-03-13 07:00:37', '2018-03-13 07:00:37'),
(88, 'whaaat???', 1, '', '2018-03-13 07:02:21', '2018-03-13 07:02:21'),
(89, 'sample', 1, '', '2018-03-21 11:45:25', '2018-03-21 11:45:25'),
(90, 'sample test', 1, '', '2018-03-27 16:36:50', '2018-03-27 16:36:50'),
(91, 'oncemore', 1, '', '2018-04-11 03:03:39', '2018-04-11 03:03:39'),
(92, 'aaaaaa', 1, '', '2018-04-12 10:09:07', '2018-04-12 10:09:07'),
(93, 'ddd', 1, '', '2018-04-18 07:27:06', '2018-04-18 07:27:06'),
(94, 'Hello!', 1, '', '2018-04-18 16:36:12', '2018-04-18 16:36:12'),
(95, 'Promoção Relampago!', 1, '', '2018-04-18 16:36:39', '2018-04-18 16:36:39'),
(96, 'hello... dex here!', 1, '', '2018-04-18 16:38:57', '2018-04-18 16:38:57'),
(97, 'Wut!', 1, '', '2018-04-18 18:38:47', '2018-04-18 18:38:47'),
(98, 'asdflaksdjflkjgsdfgjkhgkdfjghksdfg', 1, '', '2018-04-19 04:47:27', '2018-04-19 04:47:27'),
(99, 'hello,Join us at head office for more fun', 1, '', '2018-04-19 08:53:29', '2018-04-19 08:53:29'),
(100, 'hi', 1, '', '2018-04-19 13:23:37', '2018-04-19 13:23:37'),
(101, 'iluyil', 1, '', '2018-04-19 15:26:13', '2018-04-19 15:26:13'),
(102, 'iluyil', 1, '', '2018-04-19 15:26:16', '2018-04-19 15:26:16'),
(103, 'Hoy - Big sale! ?', 1, '', '2018-04-19 15:46:31', '2018-04-19 15:46:31'),
(104, 'prueba', 1, '', '2018-04-20 12:41:50', '2018-04-20 12:41:50'),
(105, 'prueba2', 1, '', '2018-04-20 13:22:35', '2018-04-20 13:22:35'),
(106, 'ьоол', 1, '', '2018-04-21 14:59:17', '2018-04-21 14:59:17'),
(107, 'Дарим вам промокод на 15%!', 1, '', '2018-04-21 14:59:37', '2018-04-21 14:59:37'),
(108, 'ewrwrwe', 1, '', '2018-04-22 00:19:37', '2018-04-22 00:19:37'),
(109, 'push', 1, '', '2018-04-22 16:32:51', '2018-04-22 16:32:51'),
(110, 'just test for push notification', 1, '', '2018-04-23 06:52:02', '2018-04-23 06:52:02'),
(111, '123', 1, '', '2018-04-23 07:36:37', '2018-04-23 07:36:37'),
(112, '5555', 1, '', '2018-04-23 07:36:57', '2018-04-23 07:36:57'),
(113, 'helllllllooo', 1, '', '2018-04-23 10:42:23', '2018-04-23 10:42:23'),
(114, 'tbis is a test for james', 1, '', '2018-04-23 11:15:37', '2018-04-23 11:15:37'),
(115, 'Test for Amos', 1, '', '2018-04-23 11:16:16', '2018-04-23 11:16:16'),
(116, 'Wow, Big Save at KFC', 1, '', '2018-04-23 11:16:59', '2018-04-23 11:16:59'),
(117, 'Wow, Big Save at KFC', 1, '', '2018-04-23 11:50:41', '2018-04-23 11:50:41'),
(118, '30% Discount on Every KFC Meal', 1, '', '2018-04-23 11:51:53', '2018-04-23 11:51:53'),
(119, 'Teste', 1, '', '2018-04-24 16:19:02', '2018-04-24 16:19:02'),
(120, 'yeee', 1, '', '2018-04-25 19:41:33', '2018-04-25 19:41:33'),
(121, 'yyyyyoo', 1, '', '2018-04-25 20:09:06', '2018-04-25 20:09:06'),
(122, 'we the best nigga', 1, '', '2018-04-26 02:58:55', '2018-04-26 02:58:55'),
(123, 'we the best bitch', 1, '', '2018-04-26 02:59:31', '2018-04-26 02:59:31'),
(124, 'no local pick up yo.', 1, '', '2018-04-27 03:11:35', '2018-04-27 03:11:35'),
(125, 'yooooooo', 1, '', '2018-04-27 05:24:41', '2018-04-27 05:24:41'),
(126, 'test', 1, '', '2018-04-27 17:43:11', '2018-04-27 17:43:11'),
(127, 'test', 1, '', '2018-04-27 17:43:21', '2018-04-27 17:43:21'),
(128, 'wut up', 1, '', '2018-04-28 00:09:07', '2018-04-28 00:09:07'),
(129, 'test app notification', 1, '', '2018-04-28 06:12:14', '2018-04-28 06:12:14'),
(130, 'prueba', 1, '', '2018-04-28 06:14:41', '2018-04-28 06:14:41'),
(131, 'xfgsdfgsdfsdfdsfsfsd', 1, '', '2018-04-29 01:08:26', '2018-04-29 01:08:26'),
(132, 'sfsfsfsf', 1, '', '2018-04-29 01:08:36', '2018-04-29 01:08:36'),
(133, 'Test notification', 1, '', '2018-04-29 12:01:26', '2018-04-29 12:01:26'),
(134, 'tooooooiiii', 1, '', '2018-04-29 23:38:43', '2018-04-29 23:38:43'),
(135, 'Hey Pl', 1, '', '2018-05-01 14:02:23', '2018-05-01 14:02:23'),
(136, 'test', 1, '', '2018-05-03 03:58:28', '2018-05-03 03:58:28'),
(137, 'apple and android', 1, '', '2018-05-03 15:37:13', '2018-05-03 15:37:13'),
(138, 'Prueba', 1, '', '2018-05-05 10:31:29', '2018-05-05 10:31:29'),
(139, 'Test', 1, '', '2018-05-05 22:46:01', '2018-05-05 22:46:01'),
(140, 'ghghghg', 1, '', '2018-05-06 00:44:05', '2018-05-06 00:44:05'),
(141, 'sdasds', 1, '', '2018-05-06 07:42:51', '2018-05-06 07:42:51'),
(142, 'Hello moto', 1, '', '2018-05-06 23:13:57', '2018-05-06 23:13:57'),
(143, 'Hello Jana', 1, '', '2018-05-06 23:16:34', '2018-05-06 23:16:34'),
(144, 'yunus', 1, '', '2018-05-07 09:09:23', '2018-05-07 09:09:23'),
(145, 'ccc', 1, '', '2018-05-07 11:02:04', '2018-05-07 11:02:04'),
(146, NULL, 0, '', '2018-05-08 05:36:44', '2018-05-08 05:36:44'),
(147, 'Hello EmergeApps!', 1, '', '2018-05-08 13:27:23', '2018-05-08 13:27:23'),
(148, 'I think this is a nice feature!', 1, '', '2018-05-08 13:27:50', '2018-05-08 13:27:50'),
(149, 'test', 1, '', '2018-05-08 18:27:51', '2018-05-08 18:27:51'),
(150, 'lkbkj', 1, '', '2018-05-08 18:31:19', '2018-05-08 18:31:19'),
(151, 'oferta', 1, '', '2018-05-08 21:02:20', '2018-05-08 21:02:20'),
(152, 'new updates', 1, '', '2018-05-09 06:12:19', '2018-05-09 06:12:19'),
(153, 'helloooo', 1, '', '2018-05-10 13:30:56', '2018-05-10 13:30:56'),
(154, 'test!', 1, '', '2018-05-10 13:31:09', '2018-05-10 13:31:09'),
(155, 'Привет всем', 1, '', '2018-05-11 05:53:33', '2018-05-11 05:53:33'),
(156, 'прога супер', 1, '', '2018-05-11 05:53:53', '2018-05-11 05:53:53'),
(157, 'qwdwded', 1, '', '2018-05-11 05:54:15', '2018-05-11 05:54:15'),
(158, 'testttt', 1, '', '2018-05-11 06:45:01', '2018-05-11 06:45:01'),
(159, 'Hi', 1, '', '2018-05-11 22:54:38', '2018-05-11 22:54:38'),
(160, 'good job', 1, '', '2018-05-12 01:48:53', '2018-05-12 01:48:53'),
(161, 'you', 1, '', '2018-05-12 20:00:23', '2018-05-12 20:00:23'),
(162, 'just testing', 1, '', '2018-05-13 15:37:01', '2018-05-13 15:37:01'),
(163, 'Testing the push message', 1, '', '2018-05-13 23:51:32', '2018-05-13 23:51:32'),
(164, 'göt fako', 1, '', '2018-05-14 10:07:09', '2018-05-14 10:07:09'),
(165, 'why u', 1, '', '2018-05-14 21:48:34', '2018-05-14 21:48:34'),
(166, 'kkkkkkkkkkkkkkkkkkkkkk', 1, '', '2018-05-15 06:09:21', '2018-05-15 06:09:21'),
(167, NULL, 0, '', '2018-05-15 08:03:58', '2018-05-15 08:03:58'),
(168, 'sadsadsd', 1, '', '2018-05-15 08:04:14', '2018-05-15 08:04:14'),
(169, 'hello', 1, '', '2018-05-16 20:55:06', '2018-05-16 20:55:06'),
(170, 'hello', 1, '', '2018-05-16 20:59:45', '2018-05-16 20:59:45'),
(171, 'hello', 1, '', '2018-05-16 21:00:01', '2018-05-16 21:00:01'),
(172, 'YYOYO', 1, '', '2018-05-17 07:52:24', '2018-05-17 07:52:24'),
(173, 'sss', 1, '', '2018-05-18 10:11:21', '2018-05-18 10:11:21'),
(174, 'hi', 1, '', '2018-05-18 13:19:42', '2018-05-18 13:19:42'),
(175, 'klklklk', 1, '', '2018-05-19 17:40:44', '2018-05-19 17:40:44'),
(176, 'Test by Sammy', 3, '', '2018-05-21 23:17:21', '2018-05-21 23:17:21');

-- --------------------------------------------------------

--
-- Структура таблицы `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '500',
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `pushwoosh_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `pushwoosh_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `date_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'd/m/Y H:i',
  `currency_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `delivery_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gcm_project_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `notification_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `notification_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mail_from_mail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mail_from_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mail_from_new_order_subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `stripe_publishable` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `stripe_private` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `paypal_client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `paypal_client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `paypal_currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `tax_included` tinyint(1) NOT NULL DEFAULT '0',
  `multiple_restaurants` tinyint(1) NOT NULL DEFAULT '0',
  `multiple_cities` tinyint(1) NOT NULL DEFAULT '0',
  `signup_required` tinyint(1) NOT NULL DEFAULT '0',
  `paypal_production` tinyint(1) NOT NULL DEFAULT '0',
  `time_format_backend` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'd/M/Y H:i',
  `time_format_app` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dd/MM/yyyy HH:mm',
  `date_format_app` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dd/MM/yyyy',
  `driver_onesignal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `driver_onesignal_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tax_groups`
--

CREATE TABLE `tax_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `value` double(8,2) NOT NULL DEFAULT '0.00',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tax_groups`
--

INSERT INTO `tax_groups` (`id`, `name`, `value`, `is_default`, `created_at`, `updated_at`) VALUES
(2, 'HK', 0.00, 1, '2018-05-21 23:17:38', '2018-05-21 23:17:38');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `access_full` tinyint(1) NOT NULL DEFAULT '1',
  `access_news` tinyint(1) NOT NULL DEFAULT '1',
  `access_categories` tinyint(1) NOT NULL DEFAULT '1',
  `access_products` tinyint(1) NOT NULL DEFAULT '1',
  `access_orders` tinyint(1) NOT NULL DEFAULT '1',
  `access_customers` tinyint(1) NOT NULL DEFAULT '1',
  `access_pushes` tinyint(1) NOT NULL DEFAULT '1',
  `access_delivery_areas` tinyint(1) NOT NULL DEFAULT '1',
  `access_promo_codes` tinyint(1) NOT NULL DEFAULT '1',
  `access_tax_groups` tinyint(1) NOT NULL DEFAULT '1',
  `access_cities` tinyint(1) NOT NULL DEFAULT '1',
  `access_restaurants` tinyint(1) NOT NULL DEFAULT '1',
  `access_settings` tinyint(1) NOT NULL DEFAULT '1',
  `access_users` tinyint(1) NOT NULL DEFAULT '1',
  `access_delivery_boys` tinyint(1) NOT NULL DEFAULT '1',
  `access_order_statuses` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `access_full`, `access_news`, `access_categories`, `access_products`, `access_orders`, `access_customers`, `access_pushes`, `access_delivery_areas`, `access_promo_codes`, `access_tax_groups`, `access_cities`, `access_restaurants`, `access_settings`, `access_users`, `access_delivery_boys`, `access_order_statuses`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$53uwVUb9HqczhzipXnP2U..EkAhgY6xPFqHd0CUp6oSZXKfIFAx22', 'stu1GtId7yhlJLyscosJKaOI7f9bsgAojPjEPBpLrTtsQ6kaYpYQ3blNW8LB', '2017-04-13 07:47:13', '2017-04-13 07:47:13', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 'test', 'test@email.com', '$2y$10$abOdsrB1RuhbgtN2Rxo7j.aseAxQbcAw7pxX3apavJNv/sCCqVadi', 'CNyJDcev3ioGwa8LfwGHo4TXdX95Fq8Y255Q7ReetacGhp3BqqT6IrP0LvRO', '2018-05-03 03:56:54', '2018-05-03 03:56:54', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_tokens_customer_id_foreign` (`customer_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`),
  ADD KEY `categories_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `categories_city_id_foreign` (`city_id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city_user`
--
ALTER TABLE `city_user`
  ADD KEY `city_user_city_id_foreign` (`city_id`),
  ADD KEY `city_user_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_city_id_foreign` (`city_id`);

--
-- Индексы таблицы `delivery_areas`
--
ALTER TABLE `delivery_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_areas_city_id_foreign` (`city_id`);

--
-- Индексы таблицы `delivery_boys`
--
ALTER TABLE `delivery_boys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery_boy_api_tokens`
--
ALTER TABLE `delivery_boy_api_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_boy_api_tokens_delivery_boy_id_foreign` (`delivery_boy_id`);

--
-- Индексы таблицы `delivery_boy_messages`
--
ALTER TABLE `delivery_boy_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_boy_messages_delivery_boy_id_foreign` (`delivery_boy_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_items`
--
ALTER TABLE `news_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_items_city_id_foreign` (`city_id`);

--
-- Индексы таблицы `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `orders_city_id_foreign` (`city_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_delivery_boy_id_foreign` (`delivery_boy_id`),
  ADD KEY `orders_order_status_id_foreign` (`order_status_id`);

--
-- Индексы таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_tax_group_id_foreign` (`tax_group_id`);

--
-- Индексы таблицы `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_codes_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `promo_codes_city_id_foreign` (`city_id`);

--
-- Индексы таблицы `push_messages`
--
ALTER TABLE `push_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tax_groups`
--
ALTER TABLE `tax_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `api_tokens`
--
ALTER TABLE `api_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4519;
--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;
--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT для таблицы `delivery_areas`
--
ALTER TABLE `delivery_areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2712;
--
-- AUTO_INCREMENT для таблицы `delivery_boys`
--
ALTER TABLE `delivery_boys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `delivery_boy_api_tokens`
--
ALTER TABLE `delivery_boy_api_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `delivery_boy_messages`
--
ALTER TABLE `delivery_boy_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT для таблицы `news_items`
--
ALTER TABLE `news_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2735;
--
-- AUTO_INCREMENT для таблицы `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT для таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1763;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8950;
--
-- AUTO_INCREMENT для таблицы `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8982;
--
-- AUTO_INCREMENT для таблицы `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1777;
--
-- AUTO_INCREMENT для таблицы `push_messages`
--
ALTER TABLE `push_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT для таблицы `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=902;
--
-- AUTO_INCREMENT для таблицы `tax_groups`
--
ALTER TABLE `tax_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD CONSTRAINT `api_tokens_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `city_user`
--
ALTER TABLE `city_user`
  ADD CONSTRAINT `city_user_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `city_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Ограничения внешнего ключа таблицы `delivery_areas`
--
ALTER TABLE `delivery_areas`
  ADD CONSTRAINT `delivery_areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `delivery_boy_api_tokens`
--
ALTER TABLE `delivery_boy_api_tokens`
  ADD CONSTRAINT `delivery_boy_api_tokens_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`);

--
-- Ограничения внешнего ключа таблицы `delivery_boy_messages`
--
ALTER TABLE `delivery_boy_messages`
  ADD CONSTRAINT `delivery_boy_messages_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`);

--
-- Ограничения внешнего ключа таблицы `news_items`
--
ALTER TABLE `news_items`
  ADD CONSTRAINT `news_items_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_tax_group_id_foreign` FOREIGN KEY (`tax_group_id`) REFERENCES `tax_groups` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD CONSTRAINT `promo_codes_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `promo_codes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
