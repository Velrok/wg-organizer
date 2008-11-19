-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 19. November 2008 um 02:53
-- Server Version: 5.0.41
-- PHP-Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Datenbank: `WGOrganizer_new`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `Buyings`
-- 

CREATE TABLE `Buyings` (
  `id` int(10) NOT NULL auto_increment,
  `description` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `bought_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `Buyings`
-- 

INSERT INTO `Buyings` VALUES (1, 'Käse', 60, 1, '2008-11-18 00:39:03');
INSERT INTO `Buyings` VALUES (2, 'Brot', 190, 1, '2008-11-18 00:39:21');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `Residents`
-- 

CREATE TABLE `Residents` (
  `id` int(10) NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `Residents`
-- 

INSERT INTO `Residents` VALUES (1, 'admin@wg.de', md5('change_on_install'));
