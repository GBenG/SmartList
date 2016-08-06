
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 06 2016 г., 23:30
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
-- Структура таблицы `spisok_`
--

CREATE TABLE IF NOT EXISTS `spisok_` (
  `ID` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `articul` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `Qty` int(16) NOT NULL,
  `availble` int(16) NOT NULL,
  `ordered` int(16) NOT NULL,
  `need` int(16) NOT NULL,
  `datasheet` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `appnote1` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `appnote2` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `appnote3` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `spisok_`
--

INSERT INTO `spisok_` (`ID`, `articul`, `name`, `description`, `price`, `Qty`, `availble`, `ordered`, `need`, `datasheet`, `appnote1`, `appnote2`, `appnote3`) VALUES
(3, 'ai_57a659781d058', 'LM317', 'Linear regulator', 0.52, 95, 2, 50, 200, 'sps.esy.es/SmartList/add_component.php', 'myrusakov.ru/php-uniqid.html', 'myrusakov.ru/php-uniqid.html', 'myrusakov.ru/php-uniqid.html'),
(2, 'ai_57a659781d153', 'MC34063', 'DC-DC regulator', 1.25, 50, 15, 30, 100, 'ti.com/lit/ds/symlink/mc34063a.pdf', 'sparkfun.com/datasheets/IC/MC34063A.pdf', 'sparkfun.com/datasheets/IC/MC34063A.pdf', 'sparkfun.com/datasheets/IC/MC34063A.pdf'),
(4, 'ai_57a659781d725', 'ATmega8', 'MCU 8kb flash DIP28', 5.23, 14, 3, 10, 25, 'www.atmel.com/Images/Atmel-2486-8-bit-AVR-microcontroller-ATmega8_L_datasheet.pdf', 'www.gaw.ru/html.cgi/txt/ic/Atmel/micros/avr/atmega8.htm', 'www.gaw.ru/html.cgi/txt/ic/Atmel/micros/avr/atmega8.htm', 'www.gaw.ru/html.cgi/txt/ic/Atmel/micros/avr/atmega8.htm'),
(5, 'ai_57a659781d788', 'LM358', 'Amplifier', 0.58, 73, 8, 20, 55, 'www.fairchildsemi.com/datasheets/LM/LM358.pdf', 'www.joyta.ru/5934-opisanie-i-primenenie-operacionnogo-usilitelya-lm358/', 'www.joyta.ru/5934-opisanie-i-primenenie-operacionnogo-usilitelya-lm358/', 'www.joyta.ru/5934-opisanie-i-primenenie-operacionnogo-usilitelya-lm358/'),
(6, 'ai_57a65a11e6faa', 'NE555', 'Timer IC', 0.02, 150, 42, 50, 100, 'www.ti.com/lit/ds/symlink/se555.pdf', 'ru.wikipedia.org/wiki/NE555', 'ru.wikipedia.org/wiki/NE555', 'ru.wikipedia.org/wiki/NE555');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
