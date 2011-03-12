-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2011 at 10:41 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `rubidium`
--
DROP DATABASE `rubidium`;
CREATE DATABASE `rubidium` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rubidium`;

-- --------------------------------------------------------
--
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
('login_key', '0wjg8ycmz3u4bb2qzcef1oy8r5zrnbchpp6gfn1iesub0kjdaadite1gsxenvwgyvxr8vvlmls6125krdikdkhptiwfn69os2sidwf812ghe0ekghtx9ccgh50y3872'),
('password_salt', 'fqrpprx5rfcg8wc5'),
('password_hash', '422ffac138fb207c8d48da89d4d7f446e17c6442930b8611ef5a1c9139a24a20905b2a7787826aa0e0d97402d308abebcdc442823caea8acd4748ba05937a83d'),
('timeout_time', '1299913426');

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
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `module_page_pages`
--

INSERT INTO `module_page_pages` (`id`, `title`, `content`, `last_updated`) VALUES
(1, 'Test Page 1', 'This is a test page.', '2010-12-22 16:09:43'),
(2, 'Test Page 2', 'This is another test page.', '2011-01-07 17:43:45'),
(3, '404 Error', 'Error 404 - The requested page was not found.', '2011-02-25 19:24:18');

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
(2, 'page', 'Pages', 'id', '1', 1, 1),
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

