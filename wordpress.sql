-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.0.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.5104
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for wordpress
CREATE DATABASE IF NOT EXISTS `wordpress` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wordpress`;

-- Dumping structure for table wordpress.wp_commentmeta
CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_commentmeta: ~0 rows (approximately)
/*!40000 ALTER TABLE `wp_commentmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_commentmeta` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_comments
CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_comments: ~1 rows (approximately)
/*!40000 ALTER TABLE `wp_comments` DISABLE KEYS */;
INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
	(1, 1, 'Mr WordPress', '', 'https://wordpress.org/', '', '2016-04-30 04:53:02', '2016-04-30 04:53:02', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0);
/*!40000 ALTER TABLE `wp_comments` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_links
CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_links: ~0 rows (approximately)
/*!40000 ALTER TABLE `wp_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_links` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_options
CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_options: ~131 rows (approximately)
/*!40000 ALTER TABLE `wp_options` DISABLE KEYS */;
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
	(1, 'siteurl', 'http://localhost/wordpress', 'yes'),
	(2, 'home', 'http://localhost/wordpress', 'yes'),
	(3, 'blogname', 'jayelmascarinas', 'yes'),
	(4, 'blogdescription', 'Just another WordPress site', 'yes'),
	(5, 'users_can_register', '0', 'yes'),
	(6, 'admin_email', 'mascarinas_jayel@yahoo.com', 'yes'),
	(7, 'start_of_week', '1', 'yes'),
	(8, 'use_balanceTags', '0', 'yes'),
	(9, 'use_smilies', '1', 'yes'),
	(10, 'require_name_email', '1', 'yes'),
	(11, 'comments_notify', '1', 'yes'),
	(12, 'posts_per_rss', '10', 'yes'),
	(13, 'rss_use_excerpt', '0', 'yes'),
	(14, 'mailserver_url', 'mail.example.com', 'yes'),
	(15, 'mailserver_login', 'login@example.com', 'yes'),
	(16, 'mailserver_pass', 'password', 'yes'),
	(17, 'mailserver_port', '110', 'yes'),
	(18, 'default_category', '1', 'yes'),
	(19, 'default_comment_status', 'open', 'yes'),
	(20, 'default_ping_status', 'open', 'yes'),
	(21, 'default_pingback_flag', '1', 'yes'),
	(22, 'posts_per_page', '10', 'yes'),
	(23, 'date_format', 'F j, Y', 'yes'),
	(24, 'time_format', 'g:i a', 'yes'),
	(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
	(26, 'comment_moderation', '0', 'yes'),
	(27, 'moderation_notify', '1', 'yes'),
	(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
	(29, 'hack_file', '0', 'yes'),
	(30, 'blog_charset', 'UTF-8', 'yes'),
	(31, 'moderation_keys', '', 'no'),
	(32, 'active_plugins', 'a:0:{}', 'yes'),
	(33, 'category_base', '', 'yes'),
	(34, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
	(35, 'comment_max_links', '2', 'yes'),
	(36, 'gmt_offset', '0', 'yes'),
	(37, 'default_email_category', '1', 'yes'),
	(38, 'recently_edited', '', 'no'),
	(39, 'template', 'twentyfourteen', 'yes'),
	(40, 'stylesheet', 'twentyfourteen', 'yes'),
	(41, 'comment_whitelist', '1', 'yes'),
	(42, 'blacklist_keys', '', 'no'),
	(43, 'comment_registration', '0', 'yes'),
	(44, 'html_type', 'text/html', 'yes'),
	(45, 'use_trackback', '0', 'yes'),
	(46, 'default_role', 'subscriber', 'yes'),
	(47, 'db_version', '35700', 'yes'),
	(48, 'uploads_use_yearmonth_folders', '1', 'yes'),
	(49, 'upload_path', '', 'yes'),
	(50, 'blog_public', '1', 'yes'),
	(51, 'default_link_category', '2', 'yes'),
	(52, 'show_on_front', 'posts', 'yes'),
	(53, 'tag_base', '', 'yes'),
	(54, 'show_avatars', '1', 'yes'),
	(55, 'avatar_rating', 'G', 'yes'),
	(56, 'upload_url_path', '', 'yes'),
	(57, 'thumbnail_size_w', '150', 'yes'),
	(58, 'thumbnail_size_h', '150', 'yes'),
	(59, 'thumbnail_crop', '1', 'yes'),
	(60, 'medium_size_w', '300', 'yes'),
	(61, 'medium_size_h', '300', 'yes'),
	(62, 'avatar_default', 'mystery', 'yes'),
	(63, 'large_size_w', '1024', 'yes'),
	(64, 'large_size_h', '1024', 'yes'),
	(65, 'image_default_link_type', 'none', 'yes'),
	(66, 'image_default_size', '', 'yes'),
	(67, 'image_default_align', '', 'yes'),
	(68, 'close_comments_for_old_posts', '0', 'yes'),
	(69, 'close_comments_days_old', '14', 'yes'),
	(70, 'thread_comments', '1', 'yes'),
	(71, 'thread_comments_depth', '5', 'yes'),
	(72, 'page_comments', '0', 'yes'),
	(73, 'comments_per_page', '50', 'yes'),
	(74, 'default_comments_page', 'newest', 'yes'),
	(75, 'comment_order', 'asc', 'yes'),
	(76, 'sticky_posts', 'a:0:{}', 'yes'),
	(77, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
	(78, 'widget_text', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
	(79, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
	(80, 'uninstall_plugins', 'a:0:{}', 'no'),
	(81, 'timezone_string', '', 'yes'),
	(82, 'page_for_posts', '0', 'yes'),
	(83, 'page_on_front', '0', 'yes'),
	(84, 'default_post_format', '0', 'yes'),
	(85, 'link_manager_enabled', '0', 'yes'),
	(86, 'finished_splitting_shared_terms', '1', 'yes'),
	(87, 'site_icon', '0', 'yes'),
	(88, 'medium_large_size_w', '768', 'yes'),
	(89, 'medium_large_size_h', '0', 'yes'),
	(90, 'initial_db_version', '35700', 'yes'),
	(91, 'wp_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:61:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}', 'yes'),
	(92, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
	(93, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
	(94, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
	(95, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
	(96, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
	(97, 'sidebars_widgets', 'a:5:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:13:"array_version";i:3;s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}}', 'yes'),
	(99, 'widget_pages', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(100, 'widget_calendar', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(101, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(102, 'widget_nav_menu', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(103, 'cron', 'a:4:{i:1470675184;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1470718405;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1470747180;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
	(118, 'can_compress_scripts', '1', 'yes'),
	(125, '_transient_twentysixteen_categories', '1', 'yes'),
	(130, 'auto_core_update_notified', 'a:4:{s:4:"type";s:6:"manual";s:5:"email";s:26:"mascarinas_jayel@yahoo.com";s:7:"version";s:5:"4.5.3";s:9:"timestamp";i:1467517117;}', 'yes'),
	(131, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:2:{i:0;O:8:"stdClass":10:{s:8:"response";s:7:"upgrade";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.5.3.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.5.3.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.5.3-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.5.3-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.5.3";s:7:"version";s:5:"4.5.3";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.4";s:15:"partial_version";s:0:"";}i:1;O:8:"stdClass":13:{s:8:"response";s:10:"autoupdate";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.5.3.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.5.3.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.5.3-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.5.3-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.5.3";s:7:"version";s:5:"4.5.3";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.4";s:15:"partial_version";s:0:"";s:12:"notify_email";s:1:"1";s:13:"support_email";s:26:"updatehelp42@wordpress.org";s:9:"new_files";s:1:"1";}}s:12:"last_checked";i:1470661489;s:15:"version_checked";s:5:"4.4.4";s:12:"translations";a:0:{}}', 'yes'),
	(134, '_site_transient_timeout_browser_312436032fc4a53563bfde48d6ec78cc', '1468027250', 'yes'),
	(135, '_site_transient_browser_312436032fc4a53563bfde48d6ec78cc', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:6:"Chrome";s:7:"version";s:13:"51.0.2704.103";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"18";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
	(136, 'recently_activated', 'a:0:{}', 'yes'),
	(153, 'theme_mods_twentysixteen', 'a:7:{s:16:"background_color";s:6:"616a73";s:12:"color_scheme";s:4:"gray";s:21:"page_background_color";s:7:"#4d545c";s:10:"link_color";s:7:"#c7c7c7";s:15:"main_text_color";s:7:"#f2f2f2";s:20:"secondary_text_color";s:7:"#f2f2f2";s:16:"sidebars_widgets";a:2:{s:4:"time";i:1469277943;s:4:"data";a:2:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}}}}', 'yes'),
	(187, 'widget_widget_twentyfourteen_ephemera', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(190, 'current_theme', 'Twenty Fourteen', 'yes'),
	(191, 'theme_mods_twentyfourteen', 'a:2:{i:0;b:0;s:18:"nav_menu_locations";a:2:{s:7:"primary";i:0;s:9:"secondary";i:0;}}', 'yes'),
	(192, 'theme_switched', '', 'yes'),
	(193, 'theme_switched_via_customizer', '', 'yes'),
	(194, 'rewrite_rules', 'a:77:{s:11:"^wp-json/?$";s:22:"index.php?rest_route=/";s:14:"^wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:58:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:68:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:88:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:64:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:53:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$";s:91:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$";s:85:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1";s:77:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:65:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]";s:61:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]";s:47:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:57:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:77:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:53:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]";s:51:"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]";s:38:"([0-9]{4})/comment-page-([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&cpage=$matches[2]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:".?.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"(.?.+?)/embed/?$";s:41:"index.php?pagename=$matches[1]&embed=true";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:24:"(.?.+?)(?:/([0-9]+))?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";}', 'yes'),
	(196, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:"auto_add";a:0:{}}', 'yes'),
	(197, 'category_children', 'a:0:{}', 'yes'),
	(229, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1470661490;s:7:"checked";a:3:{s:13:"twentyfifteen";s:3:"1.4";s:14:"twentyfourteen";s:3:"1.6";s:13:"twentysixteen";s:3:"1.1";}s:8:"response";a:3:{s:13:"twentyfifteen";a:4:{s:5:"theme";s:13:"twentyfifteen";s:11:"new_version";s:3:"1.5";s:3:"url";s:43:"https://wordpress.org/themes/twentyfifteen/";s:7:"package";s:59:"https://downloads.wordpress.org/theme/twentyfifteen.1.5.zip";}s:14:"twentyfourteen";a:4:{s:5:"theme";s:14:"twentyfourteen";s:11:"new_version";s:3:"1.7";s:3:"url";s:44:"https://wordpress.org/themes/twentyfourteen/";s:7:"package";s:60:"https://downloads.wordpress.org/theme/twentyfourteen.1.7.zip";}s:13:"twentysixteen";a:4:{s:5:"theme";s:13:"twentysixteen";s:11:"new_version";s:3:"1.2";s:3:"url";s:43:"https://wordpress.org/themes/twentysixteen/";s:7:"package";s:59:"https://downloads.wordpress.org/theme/twentysixteen.1.2.zip";}}s:12:"translations";a:0:{}}', 'yes'),
	(230, '_site_transient_update_plugins', 'O:8:"stdClass":4:{s:12:"last_checked";i:1470661489;s:8:"response";a:1:{s:19:"akismet/akismet.php";O:8:"stdClass":8:{s:2:"id";s:2:"15";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:6:"3.1.11";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:57:"https://downloads.wordpress.org/plugin/akismet.3.1.11.zip";s:6:"tested";s:5:"4.5.3";s:13:"compatibility";b:0;}}s:12:"translations";a:0:{}s:9:"no_update";a:1:{s:9:"hello.php";O:8:"stdClass":6:{s:2:"id";s:4:"3564";s:4:"slug";s:11:"hello-dolly";s:6:"plugin";s:9:"hello.php";s:11:"new_version";s:3:"1.6";s:3:"url";s:42:"https://wordpress.org/plugins/hello-dolly/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip";}}}', 'yes'),
	(251, '_site_transient_timeout_browser_774a54d777b10c4546922bc3dab69fc6', '1471180665', 'yes'),
	(252, '_site_transient_browser_774a54d777b10c4546922bc3dab69fc6', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:6:"Chrome";s:7:"version";s:13:"51.0.2704.106";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"18";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
	(255, '_site_transient_timeout_theme_roots', '1470663290', 'yes'),
	(256, '_site_transient_theme_roots', 'a:3:{s:13:"twentyfifteen";s:7:"/themes";s:14:"twentyfourteen";s:7:"/themes";s:13:"twentysixteen";s:7:"/themes";}', 'yes'),
	(258, '_transient_timeout_plugin_slugs', '1470748347', 'no'),
	(259, '_transient_plugin_slugs', 'a:2:{i:0;s:19:"akismet/akismet.php";i:1;s:9:"hello.php";}', 'no'),
	(260, '_transient_timeout_dash_88ae138922fe95674369b1cb3d215a2b', '1470705147', 'no'),
	(261, '_transient_dash_88ae138922fe95674369b1cb3d215a2b', '<div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Could not resolve host: wordpress.org</p></div><div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Could not resolve host: planet.wordpress.org</p></div><div class="rss-widget"><ul></ul></div>', 'no'),
	(262, '_transient_featured_content_ids', 'a:0:{}', 'yes'),
	(263, '_transient_is_multi_author', '0', 'yes'),
	(264, '_transient_twentyfourteen_category_count', '1', 'yes');
/*!40000 ALTER TABLE `wp_options` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_postmeta
CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_postmeta: ~29 rows (approximately)
/*!40000 ALTER TABLE `wp_postmeta` DISABLE KEYS */;
INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
	(1, 2, '_wp_page_template', 'default'),
	(2, 4, '_menu_item_type', 'post_type'),
	(3, 4, '_menu_item_menu_item_parent', '0'),
	(4, 4, '_menu_item_object_id', '1'),
	(5, 4, '_menu_item_object', 'post'),
	(6, 4, '_menu_item_target', ''),
	(7, 4, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
	(8, 4, '_menu_item_xfn', ''),
	(9, 4, '_menu_item_url', ''),
	(10, 5, '_edit_last', '1'),
	(11, 5, '_wp_page_template', 'default'),
	(12, 5, '_edit_lock', '1469278293:1'),
	(13, 5, '_wp_trash_meta_status', 'publish'),
	(14, 5, '_wp_trash_meta_time', '1469278445'),
	(15, 2, '_edit_lock', '1470575531:1'),
	(16, 8, '_edit_last', '1'),
	(17, 8, '_wp_page_template', 'default'),
	(18, 8, '_edit_lock', '1470661891:1'),
	(19, 10, '_edit_last', '1'),
	(20, 10, '_edit_lock', '1469279037:1'),
	(21, 10, '_wp_page_template', 'default'),
	(22, 2, '_edit_last', '1'),
	(23, 16, '_wp_attached_file', '2016/04/NBA.jpg'),
	(24, 16, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:251;s:6:"height";i:478;s:4:"file";s:15:"2016/04/NBA.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:15:"NBA-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:15:"NBA-158x300.jpg";s:5:"width";i:158;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:15:"NBA-251x372.jpg";s:5:"width";i:251;s:6:"height";i:372;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
	(25, 19, '_edit_last', '1'),
	(26, 19, '_edit_lock', '1470575725:1'),
	(27, 20, '_wp_attached_file', '2016/08/PBA111.png'),
	(28, 20, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:570;s:6:"height";i:375;s:4:"file";s:18:"2016/08/PBA111.png";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:18:"PBA111-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:18:"PBA111-300x197.png";s:5:"width";i:300;s:6:"height";i:197;s:9:"mime-type";s:9:"image/png";}s:14:"post-thumbnail";a:4:{s:4:"file";s:18:"PBA111-570x372.png";s:5:"width";i:570;s:6:"height";i:372;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
	(29, 19, '_wp_page_template', 'default');
/*!40000 ALTER TABLE `wp_postmeta` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_posts
CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_posts: ~21 rows (approximately)
/*!40000 ALTER TABLE `wp_posts` DISABLE KEYS */;
INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
	(1, 1, '2016-04-30 04:53:02', '2016-04-30 04:53:02', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2016-04-30 04:53:02', '2016-04-30 04:53:02', '', 0, 'http://localhost/wordpress/?p=1', 0, 'post', '', 1),
	(2, 1, '2016-04-30 04:53:02', '2016-04-30 04:53:02', '<strong><img class="alignnone size-medium wp-image-16" src="http://localhost/wordpress/wp-content/uploads/2016/04/NBA-158x300.jpg" alt="NBA" width="158" height="300" />\r\nEastern Conference</strong>\r\n<em><strong>Atlantic Division</strong></em>\r\nBoston Celtics\r\nBrooklyn Nets\r\nNew York Knicks\r\nPhiladelphia 76ers\r\nToronto Raptors\r\n<em><strong>Central Division</strong></em>\r\nChicago Bulls\r\nCleveland Cavaliers\r\nDetroit Pistons\r\nIndiana Pacers\r\nMilwaukee Bucks\r\n<em><strong>Southeast Division</strong></em>\r\nAtlanta Hawks\r\nCharlotte Hornets\r\nMiami Heat\r\nOrlando Magic\r\nWashington Wizards\r\n<strong>Western Conference</strong>\r\n<em><strong>Southwest Division</strong></em>\r\nDallas Mavericks\r\nHouston Rockets\r\nMemphis Grizzlies\r\nNew Orleans Pelicans\r\nSan Antonio Spurs\r\n<strong><em>Northwest Division</em></strong>\r\nDenver Nuggets\r\nMinnesota Timberwolves\r\nOklahoma City Thunder\r\nPortland Trail Blazers\r\nUtah Jazz\r\n<em><strong>Pacific Division</strong></em>\r\nGolden State Warriors\r\nLos Angeles Clippers\r\nLos Angeles Lakers\r\nPhoenix Suns\r\nSacramento Kings', 'NBA Teams', '', 'publish', 'closed', 'open', '', 'nbateams', '', '', '2016-08-07 13:14:17', '2016-08-07 13:14:17', '', 0, 'http://localhost/wordpress/?page_id=2', 0, 'page', '', 0),
	(4, 1, '2016-07-23 12:51:53', '2016-07-23 12:51:53', ' ', '', '', 'publish', 'closed', 'closed', '', '4', '', '', '2016-07-23 12:51:53', '2016-07-23 12:51:53', '', 0, 'http://localhost/wordpress/2016/07/23/4/', 1, 'nav_menu_item', '', 0),
	(5, 1, '2016-07-23 12:53:13', '2016-07-23 12:53:13', '', 'Abouts', '', 'trash', 'closed', 'closed', '', 'about', '', '', '2016-07-23 12:54:05', '2016-07-23 12:54:05', '', 2, 'http://localhost/wordpress/?page_id=5', 0, 'page', '', 0),
	(6, 1, '2016-07-23 12:53:13', '2016-07-23 12:53:13', '', 'About', '', 'inherit', 'closed', 'closed', '', '5-revision-v1', '', '', '2016-07-23 12:53:13', '2016-07-23 12:53:13', '', 5, 'http://localhost/wordpress/2016/07/23/5-revision-v1/', 0, 'revision', '', 0),
	(7, 1, '2016-07-23 12:53:35', '2016-07-23 12:53:35', '', 'Abouts', '', 'inherit', 'closed', 'closed', '', '5-revision-v1', '', '', '2016-07-23 12:53:35', '2016-07-23 12:53:35', '', 5, 'http://localhost/wordpress/2016/07/23/5-revision-v1/', 0, 'revision', '', 0),
	(8, 1, '2016-07-23 12:54:28', '2016-07-23 12:54:28', 'Test About', 'About', '', 'publish', 'closed', 'closed', '', 'about', '', '', '2016-08-08 13:13:43', '2016-08-08 13:13:43', '', 0, 'http://localhost/wordpress/?page_id=8', 0, 'page', '', 0),
	(9, 1, '2016-07-23 12:54:28', '2016-07-23 12:54:28', '', 'About', '', 'inherit', 'closed', 'closed', '', '8-revision-v1', '', '', '2016-07-23 12:54:28', '2016-07-23 12:54:28', '', 8, 'http://localhost/wordpress/2016/07/23/8-revision-v1/', 0, 'revision', '', 0),
	(10, 1, '2016-07-23 12:55:04', '2016-07-23 12:55:04', 'Contact me here', 'Contact', '', 'publish', 'closed', 'closed', '', 'contact', '', '', '2016-07-23 12:55:04', '2016-07-23 12:55:04', '', 0, 'http://localhost/wordpress/?page_id=10', 0, 'page', '', 0),
	(11, 1, '2016-07-23 12:55:04', '2016-07-23 12:55:04', 'Contact me here', 'Contact', '', 'inherit', 'closed', 'closed', '', '10-revision-v1', '', '', '2016-07-23 12:55:04', '2016-07-23 12:55:04', '', 10, 'http://localhost/wordpress/2016/07/23/10-revision-v1/', 0, 'revision', '', 0),
	(12, 1, '2016-08-07 13:01:57', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2016-08-07 13:01:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/wordpress/?p=12', 0, 'post', '', 0),
	(13, 1, '2016-08-07 13:03:39', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2016-08-07 13:03:39', '0000-00-00 00:00:00', '', 0, 'http://localhost/wordpress/?page_id=13', 0, 'page', '', 0),
	(14, 1, '2016-08-07 13:07:50', '2016-08-07 13:07:50', '<strong>Eastern Conference</strong>\n<em><strong>Atlantic Division</strong></em>\nBoston Celtics\n1.1.2Brooklyn Nets\n1.1.3New York Knicks\n1.1.4Philadelphia 76ers\n1.1.5Toronto Raptors\n<em><strong>Central Division</strong></em>\n1.2.1Chicago Bulls\n1.2.2Cleveland Cavaliers\n1.2.3Detroit Pistons\n1.2.4Indiana Pacers\n1.2.5Milwaukee Bucks\n1.3<em><strong>Southeast Division</strong></em>\n1.3.1Atlanta Hawks\n1.3.2Charlotte Hornets\n1.3.3Miami Heat\n1.3.4Orlando Magic\n1.3.5Washington Wizards\n<strong>Western Conference</strong>\n2.1<em><strong>Southwest Division</strong></em>\n2.1.1Dallas Mavericks\n2.1.2Houston Rockets\n2.1.3Memphis Grizzlies\n2.1.4New Orleans Pelicans\n2.1.5San Antonio Spurs\n2.2<strong><em>Northwest Division</em></strong>\n2.2.1Denver Nuggets\n2.2.2Minnesota Timberwolves\n2.2.3Oklahoma City Thunder\n2.2.4Portland Trail Blazers\n2.2.5Utah Jazz\n2.3<em><strong>Pacific Division</strong></em>\n2.3.1Golden State Warriors\n2.3.2Los Angeles Clippers\n2.3.3Los Angeles Lakers\n2.3.4Phoenix Suns\n2.3.5Sacramento Kings', 'NBA Teams', '', 'inherit', 'closed', 'closed', '', '2-autosave-v1', '', '', '2016-08-07 13:07:50', '2016-08-07 13:07:50', '', 2, 'http://localhost/wordpress/2016/08/07/2-autosave-v1/', 0, 'revision', '', 0),
	(15, 1, '2016-08-07 13:09:13', '2016-08-07 13:09:13', '<strong>Eastern Conference</strong>\r\n<em><strong>Atlantic Division</strong></em>\r\nBoston Celtics\r\nBrooklyn Nets\r\nNew York Knicks\r\nPhiladelphia 76ers\r\nToronto Raptors\r\n<em><strong>Central Division</strong></em>\r\nChicago Bulls\r\nCleveland Cavaliers\r\nDetroit Pistons\r\nIndiana Pacers\r\nMilwaukee Bucks\r\n<em><strong>Southeast Division</strong></em>\r\nAtlanta Hawks\r\nCharlotte Hornets\r\nMiami Heat\r\nOrlando Magic\r\nWashington Wizards\r\n<strong>Western Conference</strong>\r\n<em><strong>Southwest Division</strong></em>\r\nDallas Mavericks\r\nHouston Rockets\r\nMemphis Grizzlies\r\nNew Orleans Pelicans\r\nSan Antonio Spurs\r\n<strong><em>Northwest Division</em></strong>\r\nDenver Nuggets\r\nMinnesota Timberwolves\r\nOklahoma City Thunder\r\nPortland Trail Blazers\r\nUtah Jazz\r\n<em><strong>Pacific Division</strong></em>\r\nGolden State Warriors\r\nLos Angeles Clippers\r\nLos Angeles Lakers\r\nPhoenix Suns\r\nSacramento Kings', 'NBA Teams', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2016-08-07 13:09:13', '2016-08-07 13:09:13', '', 2, 'http://localhost/wordpress/2016/08/07/2-revision-v1/', 0, 'revision', '', 0),
	(16, 1, '2016-08-07 13:11:16', '2016-08-07 13:11:16', '', 'NBA', '', 'inherit', 'open', 'closed', '', 'nba', '', '', '2016-08-07 13:11:16', '2016-08-07 13:11:16', '', 2, 'http://localhost/wordpress/wp-content/uploads/2016/04/NBA.jpg', 0, 'attachment', 'image/jpeg', 0),
	(17, 1, '2016-08-07 13:11:26', '2016-08-07 13:11:26', '<strong><img class="alignnone size-medium wp-image-16" src="http://localhost/wordpress/wp-content/uploads/2016/04/NBA-158x300.jpg" alt="NBA" width="158" height="300" />Eastern Conference</strong>\r\n<em><strong>Atlantic Division</strong></em>\r\nBoston Celtics\r\nBrooklyn Nets\r\nNew York Knicks\r\nPhiladelphia 76ers\r\nToronto Raptors\r\n<em><strong>Central Division</strong></em>\r\nChicago Bulls\r\nCleveland Cavaliers\r\nDetroit Pistons\r\nIndiana Pacers\r\nMilwaukee Bucks\r\n<em><strong>Southeast Division</strong></em>\r\nAtlanta Hawks\r\nCharlotte Hornets\r\nMiami Heat\r\nOrlando Magic\r\nWashington Wizards\r\n<strong>Western Conference</strong>\r\n<em><strong>Southwest Division</strong></em>\r\nDallas Mavericks\r\nHouston Rockets\r\nMemphis Grizzlies\r\nNew Orleans Pelicans\r\nSan Antonio Spurs\r\n<strong><em>Northwest Division</em></strong>\r\nDenver Nuggets\r\nMinnesota Timberwolves\r\nOklahoma City Thunder\r\nPortland Trail Blazers\r\nUtah Jazz\r\n<em><strong>Pacific Division</strong></em>\r\nGolden State Warriors\r\nLos Angeles Clippers\r\nLos Angeles Lakers\r\nPhoenix Suns\r\nSacramento Kings', 'NBA Teams', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2016-08-07 13:11:26', '2016-08-07 13:11:26', '', 2, 'http://localhost/wordpress/2016/08/07/2-revision-v1/', 0, 'revision', '', 0),
	(18, 1, '2016-08-07 13:14:17', '2016-08-07 13:14:17', '<strong><img class="alignnone size-medium wp-image-16" src="http://localhost/wordpress/wp-content/uploads/2016/04/NBA-158x300.jpg" alt="NBA" width="158" height="300" />\r\nEastern Conference</strong>\r\n<em><strong>Atlantic Division</strong></em>\r\nBoston Celtics\r\nBrooklyn Nets\r\nNew York Knicks\r\nPhiladelphia 76ers\r\nToronto Raptors\r\n<em><strong>Central Division</strong></em>\r\nChicago Bulls\r\nCleveland Cavaliers\r\nDetroit Pistons\r\nIndiana Pacers\r\nMilwaukee Bucks\r\n<em><strong>Southeast Division</strong></em>\r\nAtlanta Hawks\r\nCharlotte Hornets\r\nMiami Heat\r\nOrlando Magic\r\nWashington Wizards\r\n<strong>Western Conference</strong>\r\n<em><strong>Southwest Division</strong></em>\r\nDallas Mavericks\r\nHouston Rockets\r\nMemphis Grizzlies\r\nNew Orleans Pelicans\r\nSan Antonio Spurs\r\n<strong><em>Northwest Division</em></strong>\r\nDenver Nuggets\r\nMinnesota Timberwolves\r\nOklahoma City Thunder\r\nPortland Trail Blazers\r\nUtah Jazz\r\n<em><strong>Pacific Division</strong></em>\r\nGolden State Warriors\r\nLos Angeles Clippers\r\nLos Angeles Lakers\r\nPhoenix Suns\r\nSacramento Kings', 'NBA Teams', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2016-08-07 13:14:17', '2016-08-07 13:14:17', '', 2, 'http://localhost/wordpress/2016/08/07/2-revision-v1/', 0, 'revision', '', 0),
	(19, 1, '2016-08-07 13:17:08', '2016-08-07 13:17:08', '<img class="alignnone size-medium wp-image-20" src="http://localhost/wordpress/wp-content/uploads/2016/08/PBA111-300x197.png" alt="PBA111" width="300" height="197" />\r\n\r\nAlaska Aces\r\nBarangay Ginebra San Miguel\r\nBlackwater Elite\r\nGlobalPort Batang Pier\r\nMahindra Enforcer\r\nMeralco Bolts\r\nNLEX Road Warriors\r\nPhoenix Fuel Masters\r\nRain or Shine Elasto Painters\r\nSan Miguel Beermen\r\nStar Hotshots\r\nTNT KaTropa', 'PBA Teams', '', 'publish', 'closed', 'closed', '', 'pba-teams', '', '', '2016-08-07 13:17:08', '2016-08-07 13:17:08', '', 0, 'http://localhost/wordpress/?page_id=19', 0, 'page', '', 0),
	(20, 1, '2016-08-07 13:16:54', '2016-08-07 13:16:54', '', 'PBA111', '', 'inherit', 'open', 'closed', '', 'pba111', '', '', '2016-08-07 13:16:54', '2016-08-07 13:16:54', '', 19, 'http://localhost/wordpress/wp-content/uploads/2016/08/PBA111.png', 0, 'attachment', 'image/png', 0),
	(21, 1, '2016-08-07 13:17:08', '2016-08-07 13:17:08', '<img class="alignnone size-medium wp-image-20" src="http://localhost/wordpress/wp-content/uploads/2016/08/PBA111-300x197.png" alt="PBA111" width="300" height="197" />\r\n\r\nAlaska Aces\r\nBarangay Ginebra San Miguel\r\nBlackwater Elite\r\nGlobalPort Batang Pier\r\nMahindra Enforcer\r\nMeralco Bolts\r\nNLEX Road Warriors\r\nPhoenix Fuel Masters\r\nRain or Shine Elasto Painters\r\nSan Miguel Beermen\r\nStar Hotshots\r\nTNT KaTropa', 'PBA Teams', '', 'inherit', 'closed', 'closed', '', '19-revision-v1', '', '', '2016-08-07 13:17:08', '2016-08-07 13:17:08', '', 19, 'http://localhost/wordpress/2016/08/07/19-revision-v1/', 0, 'revision', '', 0),
	(22, 1, '2016-08-08 13:13:43', '2016-08-08 13:13:43', 'Test About', 'About', '', 'inherit', 'closed', 'closed', '', '8-revision-v1', '', '', '2016-08-08 13:13:43', '2016-08-08 13:13:43', '', 8, 'http://localhost/wordpress/2016/08/08/8-revision-v1/', 0, 'revision', '', 0);
/*!40000 ALTER TABLE `wp_posts` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_termmeta
CREATE TABLE IF NOT EXISTS `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_termmeta: ~0 rows (approximately)
/*!40000 ALTER TABLE `wp_termmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_termmeta` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_terms
CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_terms: ~2 rows (approximately)
/*!40000 ALTER TABLE `wp_terms` DISABLE KEYS */;
INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
	(1, 'Uncategorized', 'uncategorized', 0),
	(2, 'About', 'about', 0);
/*!40000 ALTER TABLE `wp_terms` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_term_relationships
CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_term_relationships: ~2 rows (approximately)
/*!40000 ALTER TABLE `wp_term_relationships` DISABLE KEYS */;
INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
	(1, 1, 0),
	(4, 2, 0);
/*!40000 ALTER TABLE `wp_term_relationships` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_term_taxonomy
CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_term_taxonomy: ~2 rows (approximately)
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
	(1, 1, 'category', '', 0, 1),
	(2, 2, 'nav_menu', '', 0, 1);
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_usermeta
CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_usermeta: ~20 rows (approximately)
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
	(1, 1, 'nickname', 'jayel5k'),
	(2, 1, 'first_name', ''),
	(3, 1, 'last_name', ''),
	(4, 1, 'description', ''),
	(5, 1, 'rich_editing', 'true'),
	(6, 1, 'comment_shortcuts', 'false'),
	(7, 1, 'admin_color', 'fresh'),
	(8, 1, 'use_ssl', '0'),
	(9, 1, 'show_admin_bar_front', 'true'),
	(10, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
	(11, 1, 'wp_user_level', '10'),
	(12, 1, 'dismissed_wp_pointers', ''),
	(13, 1, 'show_welcome_panel', '1'),
	(14, 1, 'session_tokens', 'a:2:{s:64:"ca089527287703a1686710089cc0b5b570035c82f303d02a2461f2f68ec1c82a";a:4:{s:10:"expiration";i:1470747714;s:2:"ip";s:3:"::1";s:2:"ua";s:109:"Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36";s:5:"login";i:1470574914;}s:64:"c1241a2b2ace692c87684dd6fb2fd7e296a5aca10022ec11c16e6112cf23ceda";a:4:{s:10:"expiration";i:1471871544;s:2:"ip";s:3:"::1";s:2:"ua";s:109:"Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36";s:5:"login";i:1470661944;}}'),
	(15, 1, 'wp_user-settings', 'libraryContent=browse&mfold=o&editor=tinymce&widgets_access=on'),
	(16, 1, 'wp_user-settings-time', '1461992001'),
	(17, 1, 'wp_dashboard_quick_press_last_post_id', '12'),
	(18, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:"link-target";i:1;s:11:"css-classes";i:2;s:3:"xfn";i:3;s:11:"description";i:4;s:15:"title-attribute";}'),
	(19, 1, 'metaboxhidden_nav-menus', 'a:2:{i:0;s:12:"add-post_tag";i:1;s:15:"add-post_format";}'),
	(20, 1, 'nav_menu_recently_edited', '2');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;

-- Dumping structure for table wordpress.wp_users
CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wordpress.wp_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
	(1, 'jayel5k', '$P$BSDAHHeA12DKukowFEDpPcjY1gmKVh.', 'jayel5k', 'mascarinas_jayel@yahoo.com', '', '2016-04-30 04:53:01', '1467422288:$P$BdllwR3HJW2X7x6ivE65ZZ0/0tHDFX/', 0, 'jayel5k');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
