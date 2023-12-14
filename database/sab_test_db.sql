/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100420
Source Host           : localhost:3306
Source Database       : sab_test_db

Target Server Type    : MYSQL
Target Server Version : 100420
File Encoding         : 65001

Date: 2023-12-14 15:43:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_posts
-- ----------------------------
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `blog_post_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` bigint(20) unsigned NOT NULL,
  `post_type_id` int(11) NOT NULL,
  `blog_post_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_post_content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_post_content_short` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_post_publish_date` date DEFAULT NULL,
  `blog_post_image_url` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'json_encoded image urls',
  `blog_post_created_at` datetime DEFAULT current_timestamp(),
  `blog_post_updated_at` datetime DEFAULT NULL,
  `blog_post_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`blog_post_id`),
  KEY `FK_user_blog_posts_author_id` (`author_id`),
  KEY `FK_post_types_blog_posts_type_id` (`post_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of blog_posts
-- ----------------------------
INSERT INTO `blog_posts` VALUES ('1', '1', '1', 'Post 01', 'Blockquotes\r\n\r\nThis is an example blockquote in action:\r\n\r\n    Quoted text goes here.\r\n\r\nThis is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We\'ll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.\r\nExample lists\r\n\r\nThis is some additional paragraph placeholder content. It\'s a slightly shorter version of the other highly repetitive body text used throughout. This is an example unordered list:\r\n\r\n    First list item\r\n    Second list item with a longer description\r\n    Third list item to close it out\r\n\r\nAnd this is an ordered list:\r\n\r\n    First list item\r\n    Second list item with a longer description\r\n    Third list item to close it out\r\n\r\nAnd this is a definition list:', null, '2023-12-01', '[\"1697599158_Screenshot 2022-05-28 at 9.45.50 AM.png\",\"1697599158_Screenshot 2023-06-02 at ItElligence.png\",\"1697599158_Screenshot 2023-06-13 at bluesteps.png\"]', '2023-10-18 03:19:18', '2023-10-18 03:19:18', null);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('6', '2023_10_16_092055_create_blog_posts_table', '2');
INSERT INTO `migrations` VALUES ('7', '2023_10_17_152759_create_post_types_table', '3');
INSERT INTO `migrations` VALUES ('8', '2023_10_17_152759_create_blog_posts_table', '4');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for post_types
-- ----------------------------
DROP TABLE IF EXISTS `post_types`;
CREATE TABLE `post_types` (
  `post_type_id` int(11) NOT NULL,
  `post_type_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `post_type_created_at` datetime DEFAULT current_timestamp(),
  `post_type_updated_at` datetime DEFAULT NULL,
  `post_type_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`post_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of post_types
-- ----------------------------
INSERT INTO `post_types` VALUES ('1', 'Technology', '2023-10-18 08:45:44', null, null);
INSERT INTO `post_types` VALUES ('2', 'Design', '2023-10-18 08:46:01', null, null);
INSERT INTO `post_types` VALUES ('3', 'Culture', '2023-10-18 08:46:14', null, null);
INSERT INTO `post_types` VALUES ('4', 'Business', '2023-10-18 08:46:23', null, null);
INSERT INTO `post_types` VALUES ('5', 'Politics', '2023-10-18 08:46:36', null, null);
INSERT INTO `post_types` VALUES ('6', 'Science', '2023-10-18 08:46:41', null, null);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(12) NOT NULL,
  `category` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` tinytext DEFAULT NULL,
  `selling_price` decimal(13,2) NOT NULL,
  `special_price` decimal(13,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Draft|2=Published|3=Out of Stock',
  `is_delivery_available` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=yes;2=no',
  `Image_path` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for product_attributes
-- ----------------------------
DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_name` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_attributes
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_role` tinyint(4) DEFAULT 1 COMMENT '1=admin;2=moderator;3=user;',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'author 01', 'author01@gmail.com', null, '$2y$10$soNr.uuftRl1m7Z2uDQXxOyMRvco72AHZunn9MzxRZ9yQxjRMZAqO', null, '2023-10-18 03:06:23', '2023-10-18 03:06:23', null, '1');
