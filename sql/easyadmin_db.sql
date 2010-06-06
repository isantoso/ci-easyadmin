-- phpMyAdmin SQL Dump
-- version 3.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2010 at 11:37 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.10-2ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easyadmin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `core_acl`
--

CREATE TABLE IF NOT EXISTS `core_acl` (
  `acl_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`acl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=980 ;

--
-- Dumping data for table `core_acl`
--

INSERT INTO `core_acl` (`acl_id`, `module_id`, `group_id`, `date_created`) VALUES
(979, 58, 1, '2010-06-06 00:00:00'),
(978, 57, 1, '2010-06-06 00:00:00'),
(977, 65, 1, '2010-06-06 00:00:00'),
(976, 66, 1, '2010-06-06 00:00:00'),
(975, 64, 1, '2010-06-06 00:00:00'),
(974, 63, 1, '2010-06-06 00:00:00'),
(973, 42, 1, '2010-06-06 00:00:00'),
(972, 43, 1, '2010-06-06 00:00:00'),
(971, 45, 1, '2010-06-06 00:00:00'),
(970, 41, 1, '2010-06-06 00:00:00'),
(969, 44, 1, '2010-06-06 00:00:00'),
(968, 59, 1, '2010-06-06 00:00:00'),
(967, 55, 1, '2010-06-06 00:00:00'),
(965, 54, 1, '2010-06-06 00:00:00'),
(964, 52, 1, '2010-06-06 00:00:00'),
(963, 49, 1, '2010-06-06 00:00:00'),
(962, 50, 1, '2010-06-06 00:00:00'),
(961, 51, 1, '2010-06-06 00:00:00'),
(960, 48, 1, '2010-06-06 00:00:00'),
(959, 56, 1, '2010-06-06 00:00:00'),
(958, 46, 1, '2010-06-06 00:00:00'),
(957, 62, 1, '2010-06-06 00:00:00'),
(956, 53, 1, '2010-06-06 00:00:00'),
(955, 40, 1, '2010-06-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `core_group`
--

CREATE TABLE IF NOT EXISTS `core_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `group_enabled` tinyint(1) DEFAULT '1',
  `group_description` text,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `core_group`
--

INSERT INTO `core_group` (`group_id`, `group_name`, `group_enabled`, `group_description`) VALUES
(1, 'Super Admin', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `core_menu`
--

CREATE TABLE IF NOT EXISTS `core_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(255) DEFAULT NULL,
  `menu_order` int(11) DEFAULT '9999',
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `core_menu`
--

INSERT INTO `core_menu` (`menu_id`, `menu_title`, `menu_order`, `date_created`) VALUES
(2, 'Admin', 0, NULL),
(5, 'Your Account', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_module`
--

CREATE TABLE IF NOT EXISTS `core_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `access_path` varchar(255) DEFAULT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `class_method` varchar(255) DEFAULT NULL,
  `show_on_menu` tinyint(1) DEFAULT '0',
  `module_enabled` tinyint(1) DEFAULT '0',
  `module_order` int(11) DEFAULT '9',
  `module_description` text,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `core_module`
--

INSERT INTO `core_module` (`module_id`, `menu_id`, `module_name`, `access_path`, `class_name`, `class_method`, `show_on_menu`, `module_enabled`, `module_order`, `module_description`, `date_created`) VALUES
(46, 2, 'View User Group', 'group/view', '', '', 1, 1, 4, 'View Groups', '2008-12-12 15:58:36'),
(40, 2, 'View Module', 'module/view', 'module', 'view', 1, 1, 0, 'Add new module', '2008-12-12 15:15:52'),
(41, 2, 'Delete Module', 'module/delete', 'module', 'delete', 0, 1, 999, 'Delete Module', '2008-12-12 15:15:52'),
(42, 2, 'Module as Menu Item', 'module/menu', 'module', 'menu', 0, 1, 999, 'Show/Hide Module as Menu Item', '2008-12-12 15:26:18'),
(43, 2, 'Enable/Disable Module', 'module/enable', 'module', 'enable', 0, 1, 999, 'Enable or Disable Module', '2008-12-12 15:26:55'),
(44, 2, 'Add Module', 'module/add', 'module', 'add', 0, 1, 999, 'Add New Module', '2008-12-12 15:26:55'),
(45, 2, 'Edit Module', 'module/edit', '', '', 0, 1, 999, 'Edit Module', '2008-12-12 15:55:57'),
(48, 2, 'Add Group', 'group/add', '', '', 0, 1, 999, 'Add Group', '2008-12-12 16:00:26'),
(49, 2, 'Enable/Disable Group', 'group/enable', '', '', 0, 1, 999, 'Enable/Disable group', '2008-12-12 16:01:15'),
(50, 2, 'Group Edit', 'group/edit', '', '', 0, 1, 999, 'group edit', '2008-12-12 16:02:14'),
(51, 2, 'Delete Group', 'group/delete', '', '', 0, 1, 999, 'delete group', '2008-12-12 16:03:33'),
(52, 2, 'Group Module Permissions', 'group/permission', '', '', 0, 1, 999, 'set group - module permission (ACL)', '2008-12-12 16:23:48'),
(53, 2, 'View Menu', 'menu/view', '', '', 1, 1, 1, 'view menu group', '2008-12-16 10:58:51'),
(54, 2, 'Add New Menu', 'menu/add', '', '', 0, 1, 999, 'add new menu', '2008-12-16 10:59:28'),
(55, 2, 'Delete Menu', 'menu/delete', '', '', 0, 1, 999, 'delete menu with empty modules/ menu item', '2008-12-16 10:59:58'),
(56, 2, 'Menu Re-Order', 'menu/reorder', '', '', 0, 1, 2, 're-order menu', '2008-12-16 11:00:26'),
(57, 5, 'Your Details', 'account/edit', '', '', 1, 1, 0, 'edit user account details', '2008-12-16 11:41:49'),
(58, 5, 'Update Password', 'account/password', '', '', 1, 1, 1, 'update account password', '2008-12-16 11:42:10'),
(59, 2, 'Edit Menu', 'menu/edit', '', '', 0, 1, 999, 'edit menu item', '2008-12-16 11:43:02'),
(62, 2, 'View User Login', 'users/view', '', '', 1, 1, 3, 'view all user login', '2008-12-16 13:52:25'),
(63, 2, 'Add New User Login', 'users/add', '', '', 0, 1, 999, 'add new user login', '2008-12-18 11:37:46'),
(64, 2, 'Delete User Login', 'users/delete', '', '', 0, 1, 999, 'delete user login', '2008-12-18 11:48:52'),
(65, 2, 'Enable/Disable User Login', 'users/enable', '', '', 0, 1, 999, 'enable or disable login', '2008-12-18 11:49:35'),
(66, 2, 'Edit User Login', 'users/edit', '', '', 0, 1, 999, 'edit user login', '2008-12-18 12:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `core_user`
--

CREATE TABLE IF NOT EXISTS `core_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(32) DEFAULT NULL,
  `login_enabled` tinyint(1) DEFAULT '1',
  `group_id` int(1) DEFAULT '1',
  `last_login` int(11) DEFAULT NULL,
  `last_ip` varchar(16) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `core_user`
--

INSERT INTO `core_user` (`user_id`, `name`, `phone`, `email`, `user_username`, `user_password`, `login_enabled`, `group_id`, `last_login`, `last_ip`, `date_created`) VALUES
(1, 'Administrator', '', 'isantoso@gmail.com', 'admin', 'd31cdc66fe164772bbbb97fbc1d83a67', 1, 1, 1275831307, '127.0.0.1', '2009-01-11 11:05:04');
