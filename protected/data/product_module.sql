-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2015 at 10:33 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `status` tinyint(11) NOT NULL,
  `invoice_total` double NOT NULL,
  `shipping_fee` double NOT NULL DEFAULT '0',
  `grand_total` double NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `command` text,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_order_detail` (
  `order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` double NOT NULL,
  `line_total` double NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`order_detail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_order_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `alias` varchar(150) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sku` varchar(15) NOT NULL COMMENT 'Product''s model code or ''Stock Keep Unit''',
  `quantity` smallint(5) unsigned NOT NULL DEFAULT '0',
  `price` float unsigned NOT NULL,
  `wholesale_price` float unsigned DEFAULT NULL,
  `bought` int(11) DEFAULT NULL COMMENT 'Number of buyers who bought the product',
  `discount` float DEFAULT '0' COMMENT 'If discount value between 0 and 1, then it is known that discount in percentage, else would be in price',
  `sale_promotion` float unsigned NOT NULL DEFAULT '0',
  `like` int(11) DEFAULT '0',
  `subscripbe` int(11) DEFAULT '0',
  `description` text NOT NULL COMMENT 'Short introduction',
  `detail` text NOT NULL COMMENT 'Product''s detail like size, material, ect',
  `status` tinyint(4) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `alias`, `uri`, `image`, `sku`, `quantity`, `price`, `wholesale_price`, `bought`, `discount`, `sale_promotion`, `like`, `subscripbe`, `description`, `detail`, `status`, `create_time`, `update_time`) VALUES
(2, '3D Tshirt', '3d-tshirt', '', 'upload/products/2015/05/03/small/20150503100433.jpg', 'SKU', 150, 120000, NULL, NULL, 0, 0, 0, 0, '<p>3D Tshirt</p>', '', 1, '2015-05-03 22:04:33', NULL),
(3, 'Túi Ipad handmade', 'tui-ipad-handmade', '', 'upload/products/2015/05/03/small/20150503100526.jpg', 'SKU', 200, 500000, NULL, NULL, 0, 0, 0, 0, '<p>Ipad bag</p>', '', 1, '2015-05-03 22:05:26', NULL),
(4, 'Khay  d?ng cafe', 'khay-dung-cafe', '', 'upload/products/2015/05/03/small/20150503100629.jpg', 'SKU', 500, 20000, NULL, NULL, 0, 0, 0, 0, '<p>Khay&nbsp; d?ng cafe</p>', '', 1, '2015-05-03 22:06:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_follow`
--

CREATE TABLE IF NOT EXISTS `tbl_product_follow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `subscriber` varchar(100) NOT NULL COMMENT 'emails',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_product_follow`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_gallery`
--

CREATE TABLE IF NOT EXISTS `tbl_product_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `uri` varchar(225) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `filesize` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_product_gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_review`
--

CREATE TABLE IF NOT EXISTS `tbl_product_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_product_review`
--

INSERT INTO `tbl_product_review` (`id`, `pid`, `name`, `email`, `content`, `create_time`) VALUES
(1, 3, 'Dieu', 'logos010@gmail.com', 'God', '2015-05-03 22:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_term`
--

CREATE TABLE IF NOT EXISTS `tbl_product_term` (
  `pid` tinyint(10) unsigned NOT NULL,
  `tid` tinyint(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product_term`
--

INSERT INTO `tbl_product_term` (`pid`, `tid`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 5),
(4, 5);
