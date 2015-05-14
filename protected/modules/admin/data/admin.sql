-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2014 at 04:44 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `bootstrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_configuration`
--

CREATE TABLE IF NOT EXISTS `tbl_configuration` (
  `name` varchar(40) NOT NULL,
  `value` text NOT NULL,
  `type` enum('text','json', 'file') NOT NULL DEFAULT 'text',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_configuration`
--

INSERT INTO `tbl_configuration` (`name`, `value`, `type`) VALUES
('about', '<p>About Us !!! About us</p>', 'text'),
('cache', '{"time":"0"}', 'json'),
('contact', '{"email":"haolangvn@gmail.com"}', 'json'),
('page', '{"admin":"50","client":"30"}', 'json');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `url` varchar(128) NOT NULL DEFAULT '#',
  `weight` int(11) NOT NULL DEFAULT '0',
  `level` varchar(155) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `visible_expression` varchar(155) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `type_id`, `parent_id`, `alias`, `name`, `url`, `weight`, `level`, `status`, `create_time`, `update_time`, `visible_expression`) VALUES
(1, 2, 0, 'account', 'Account', '/user/admin', 0, '000001', 1, NULL, '2014-03-13 04:18:32', ''),
(2, 2, 1, 'list-users', 'List Users', '/user/admin/index', 0, '000001/000002', 1, '2014-03-13 04:22:24', '2014-03-13 04:33:14', ''),
(3, 2, 1, 'profile-fields', 'Profile Fields', '/user/profile_field/index', 0, '000001/000003', 1, '2014-03-13 04:33:02', '2014-04-25 04:09:40', ''),
(4, 2, 0, 'catalog', 'Catalog', '#', 0, '000004', 1, '2014-03-13 04:35:47', NULL, ''),
(5, 2, 4, 'term-data', 'Term Data', '/admin/voc/index', 0, '000004/000005', 1, '2014-03-13 04:36:22', '2014-04-25 03:56:11', ''),
(6, 2, 4, 'menu', 'Menu', '/admin/menu/index', 0, '000004/000006', 1, '2014-03-13 04:36:23', '2014-03-13 04:36:51', ''),
(7, 2, 0, 'system', 'System', '#', -100, '100007', 1, '2014-03-13 04:37:17', '2014-04-25 03:35:14', ''),
(8, 2, 7, 'params', 'Params', '/admin/config/update', 0, '100007/000008', 1, '2014-03-13 04:37:38', '2014-03-18 04:49:45', ''),
(9, 2, 7, 'clear-cache', 'Clear Cache', '/admin/config/clear', 0, '100007/000009', 1, '2014-03-13 04:37:58', '2014-03-18 04:49:45', ''),
(10, 2, 7, 'srbac', 'SRBAC', '/srbac', 0, '100007/000010', 1, '2014-03-18 03:33:20', '2014-03-18 04:49:45', ''),
(11, 2, 0, 'contact', 'Contact', '/contact/admin', 0, '000011', 1, '2014-03-18 04:49:04', '2014-03-18 04:49:29', ''),
(12, 2, 4, 'translate', 'Translate', '/admin/translate/index', 0, NULL, 1, '2014-04-25 03:56:41', '2014-04-25 03:57:33', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_type`
--

CREATE TABLE IF NOT EXISTS `tbl_menu_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_menu_type`
--

INSERT INTO `tbl_menu_type` (`id`, `alias`, `name`, `description`) VALUES
(1, 'main-menu', 'Main Menu', ''),
(2, 'admin-menu', 'Admin Menu', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_term`
--

CREATE TABLE IF NOT EXISTS `tbl_term` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_seo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '#',
  `description` text NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `level` varchar(155) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`),
  KEY `weight` (`weight`),
  KEY `vid` (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_term`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_translate`
--

CREATE TABLE IF NOT EXISTS `tbl_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varbinary(128) NOT NULL,
  `category` varchar(255) NOT NULL,
  `language_code` varchar(8) NOT NULL,
  `translation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `message` (`message`,`category`,`language_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_translate`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_vocabulary`
--

CREATE TABLE IF NOT EXISTS `tbl_vocabulary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_vocabulary`
--

