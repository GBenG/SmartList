
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 30 2016 г., 10:12
-- Версия сервера: 10.0.20-MariaDB
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u158376855_list`
--

-- --------------------------------------------------------

--
-- Структура таблицы `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `ID` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `articul` int(32) NOT NULL,
  `element` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `project` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `ID` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `project` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`ID`, `project`) VALUES
(4, 'Starling'),
(3, 'BlueJAY'),
(5, 'Znak');

-- --------------------------------------------------------

--
-- Структура таблицы `shiplist`
--

CREATE TABLE IF NOT EXISTS `shiplist` (
  `ID` int(16) NOT NULL,
  `articul` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `shipper` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `shippers`
--

CREATE TABLE IF NOT EXISTS `shippers` (
  `shipper` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `contacts` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `shippers`
--

INSERT INTO `shippers` (`shipper`, `url`, `contacts`) VALUES
('Имрад', 'imrad.com.ua', '+380 (44) 490-21-95'),
('Космодром', 'http://www.kosmodrom.com.ua/', '(057) 750 99 93\r\n(057) 755 48 27');

-- --------------------------------------------------------

--
-- Структура таблицы `spisok`
--

CREATE TABLE IF NOT EXISTS `spisok` (
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `spisok`
--

INSERT INTO `spisok` (`name`, `price`, `url`) VALUES
('Резисторы', 25, 'Козлодром'),
('Резистор ', 0.15, 'test '),
('Пучек паяльников', 53, 'РКС Компоненты'),
('Ведро кондесаторов', 62, 'оЕ-Ворон'),
('Золоченый дросель на 8Гн', 787, 'Китай'),
('Датчик газа MQ-2 модуль', 5.38, 'http://www.mini-tech.com.ua/index.php?route=product/product&path');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_hash` varchar(32) NOT NULL,
  `user_ip` int(10) unsigned NOT NULL DEFAULT '0',
  `surname` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `fname` varchar(300) NOT NULL,
  `dnumber` varchar(30) NOT NULL,
  `situation` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `user_hash`, `user_ip`, `surname`, `name`, `fname`, `dnumber`, `situation`) VALUES
(33, 'admin', 'b03496787c3d934ad67e2295cee01407', '8b796202ce06cdc324be14e629866742', 1388405637, '', '', '', '', ''),
(32, 'Boris', 'dca76855be17e335d09512be4c108e9d', '', 0, '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
