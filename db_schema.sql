-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2011 at 01:37 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `rubidium`
--
CREATE DATABASE `rubidium` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rubidium`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE IF NOT EXISTS `admin_info` (
  `name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`name`, `value`) VALUES
('login_key', 'o2no03e7abvogo3qhgw6pkv7wk6kzc9kgbalj0tdiacqzd3m7reuitm3909hjffpkj5cioobntiz6ykcoj4mrgfjncpw8d57tp84pv1eep0nwidjd6suzyglz7u6qg3'),
('password_salt', '0eyasvnxldlvxe6z'),
('password_hash', '8691f1231a0752bdd0eace8183550c0713d4d6f39741c5a082323f24409bc9fba6c6c645f2fd23f17416ff016c15d91d49de4eab70ac40a1d229335fc59dd153'),
('timeout_time', '1300049780');

-- --------------------------------------------------------

--
-- Table structure for table `module_admin_sections`
--

CREATE TABLE IF NOT EXISTS `module_admin_sections` (
  `name` varchar(32) NOT NULL,
  `public_name` varchar(64) NOT NULL,
  `templateCategory` varchar(128) NOT NULL,
  `templateName` varchar(128) NOT NULL,
  `pageInfo` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_admin_sections`
--

INSERT INTO `module_admin_sections` (`name`, `public_name`, `templateCategory`, `templateName`, `pageInfo`) VALUES
('index', 'Index', 'modules/admin', 'dashboard', 'title=Admin+CP+Dashboard&templateCategory=modules%2Fadmin&templateToLoad=dashboard'),
('login', 'Log in', 'modules/admin', 'login', 'title=Admin+CP+Login&templateCategory=modules%2Fadmin&templateToLoad=login'),
('logout', 'Log out', 'modules/admin', 'logout', 'title=Logged+Out&templateCategory=modules%2Fadmin&templateToLoad=logout'),
('settings', 'Settings', 'modules/admin', 'settings', 'title=Settings&templateCategory=modules%2Fadmin&templateToLoad=settings');

-- --------------------------------------------------------

--
-- Table structure for table `module_page_pages`
--

CREATE TABLE IF NOT EXISTS `module_page_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Page ID',
  `title` varchar(256) NOT NULL COMMENT 'Page title',
  `content` text NOT NULL COMMENT 'Page content',
  `last_updated` int(11) NOT NULL COMMENT 'Last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `module_page_pages`
--

INSERT INTO `module_page_pages` (`id`, `title`, `content`, `last_updated`) VALUES
(1, 'Test Page 1', '<p>\r\n	This is a test page.</p>\r\n', 1299977195),
(2, 'Test Page 2', '<p>\r\n	This is another test page.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style="text-align: right; ">\r\n	<strong>lalalalala</strong></p>\r\n<p style="text-align: center; ">\r\n	<embed bgcolor="#FFFFFF" flashvars="autoPlay=yes&amp;playlistPath=http://oliverrudland.co.uk/playlist.xml&amp;overColor=#000033&amp;playerSkin=1" height="245" id="mymovie" name="mymovie" quality="high" src="http://oliverrudland.co.uk/playerMultipleList.swf" style="undefined" type="application/x-shockwave-flash" width="220"></embed></p>\r\n', 1299977734),
(3, '404 Error', '<p>\r\n	Error 404 - The requested page was not found.</p>\r\n', 1299977215),
(23, 'Index Page', '<p>\r\n	This is the default Rubidium index page. Open up the Admin CP and visit the Pages tab to change the content here!</p>\r\n', 1300045717),
(22, 'Another Test Page', '<p>\r\n	Testing!!!</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	I just lost the game.</p>\r\n', 1299985914);

-- --------------------------------------------------------

--
-- Table structure for table `module_page_sections`
--

CREATE TABLE IF NOT EXISTS `module_page_sections` (
  `name` varchar(32) NOT NULL,
  `public_name` varchar(64) NOT NULL,
  `pageInfo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_page_sections`
--

INSERT INTO `module_page_sections` (`name`, `public_name`, `pageInfo`) VALUES
('index', 'Index', 'title=Page Manager&templateCategory=modules%2Fpage%2Fadmin&templateToLoad=index'),
('manage', 'Manage Pages', 'title=Manage Pages&templateCategory=modules%2Fpage%2Fadmin&templateToLoad=manage'),
('settings', 'Settings', 'title=Settings&templateCategory=modules%2Fpage%2Fadmin&templateToLoad=settings');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `numeric_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numeric ID for sorting',
  `id` varchar(32) NOT NULL COMMENT 'ID used by software',
  `name` varchar(32) NOT NULL COMMENT 'Public name for module',
  `default_action` varchar(32) NOT NULL COMMENT 'Action of default content to load for this mode (e.g. id)',
  `default_action_value` varchar(32) NOT NULL COMMENT 'Default value for default action (e.g. 1)',
  `enabled` tinyint(1) NOT NULL COMMENT 'Is the mode enabled? (Page\r\ncannot be disabled)',
  `protected` tinyint(1) NOT NULL COMMENT 'Can it be uninstalled?\r\n(Addon modes cannot be protected)',
  PRIMARY KEY (`numeric_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`numeric_id`, `id`, `name`, `default_action`, `default_action_value`, `enabled`, `protected`) VALUES
(2, 'page', 'Pages', 'id', '23', 1, 1),
(1, 'admin', 'Dashboard', 'module', 'dashboard', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `description`, `value`) VALUES
(2, 'footer', 'Global site footer', '&copy; 2011 The Rubidium Project'),
(5, '404_page', 'ID of page to display on 404 error', '3'),
(4, 'default_mode', 'Default mode to load if not specified', 'page');

