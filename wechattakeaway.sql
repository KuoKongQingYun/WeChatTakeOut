-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 06 月 10 日 11:42
-- 服务器版本: 5.6.19
-- PHP 版本: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wechattakeaway`
--

-- --------------------------------------------------------

--
-- 表的结构 `wcta_admin`
--

CREATE TABLE IF NOT EXISTS `wcta_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `auth` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wcta_admin`
--

INSERT INTO `wcta_admin` (`id`, `username`, `password`, `auth`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '0e099e1a32430e378065c2faffb11e15');

-- --------------------------------------------------------

--
-- 表的结构 `wcta_cart`
--

CREATE TABLE IF NOT EXISTS `wcta_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `wcta_cart`
--

INSERT INTO `wcta_cart` (`id`, `user_id`, `item_id`) VALUES
(50, 9, 3);

-- --------------------------------------------------------

--
-- 表的结构 `wcta_category`
--

CREATE TABLE IF NOT EXISTS `wcta_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wcta_category`
--

INSERT INTO `wcta_category` (`id`, `name`, `order`) VALUES
(1, '零食', 0),
(2, '饮料', 1),
(3, '水果', 2),
(4, '新分类', 0);

-- --------------------------------------------------------

--
-- 表的结构 `wcta_item`
--

CREATE TABLE IF NOT EXISTS `wcta_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `pic` varchar(1024) NOT NULL,
  `price` float NOT NULL,
  `time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `wcta_item`
--

INSERT INTO `wcta_item` (`id`, `category`, `name`, `unit`, `pic`, `price`, `time`) VALUES
(2, 3, '梨子', '斤', '/Upload/sg-2.jpg', 4, '2015-06-03 18:37:47'),
(1, 4, '苹果', '斤', '/Upload/sg-1.jpg', 5, '2015-06-04 13:33:03'),
(3, 3, '香蕉', '斤', '/Upload/sg-3.jpg', 6, '2015-05-27 22:46:41'),
(4, 1, '薯片', '袋', '/Upload/ls-1.jpg', 3, '2015-05-27 22:53:34'),
(5, 1, '辣条', '袋', '/Upload/ls-2.jpg', 1, '2015-05-27 22:53:34'),
(6, 1, '瓜子', '袋', '/Upload/ls-3.jpg', 2, '2015-05-27 22:57:09'),
(7, 2, '鲜橙多', '瓶', '/Upload/yl-1.jpg', 3, '2015-05-27 22:58:23'),
(8, 2, '可口可乐', '瓶', '/Upload/yl-2.jpg', 3, '2015-05-27 22:58:23');

-- --------------------------------------------------------

--
-- 表的结构 `wcta_order`
--

CREATE TABLE IF NOT EXISTS `wcta_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wcta_user`
--

CREATE TABLE IF NOT EXISTS `wcta_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` text NOT NULL,
  `wxid` varchar(28) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `wcta_user`
--

INSERT INTO `wcta_user` (`id`, `name`, `phone`, `address`, `wxid`) VALUES
(9, '林志豪', '13200000000', '一环路东一段', 'o2KADs3SIevhzrLnu2lXe50hnhZ0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
