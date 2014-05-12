-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 12 2014 г., 19:23
-- Версия сервера: 5.6.16
-- Версия PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kursak`
--

-- --------------------------------------------------------

--
-- Структура таблицы `battle`
--

CREATE TABLE IF NOT EXISTS `battle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `time_begin` int(11) NOT NULL,
  `time_end` int(11) DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user1` (`user1`,`user2`),
  KEY `user2` (`user2`),
  KEY `winner` (`winner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `turn`
--

CREATE TABLE IF NOT EXISTS `turn` (
  `id` int(11) NOT NULL,
  `battle_id` int(11) NOT NULL,
  `attack1` int(11) DEFAULT NULL,
  `attack2` int(11) DEFAULT NULL,
  `defence1` int(11) NOT NULL,
  `defence2` int(11) NOT NULL,
  `damage1` int(11) NOT NULL,
  `damage2` int(11) NOT NULL,
  `finished` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `battle_id` (`battle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  `pwd` varchar(64) NOT NULL,
  `blocked` tinyint(4) DEFAULT NULL,
  `hp` int(11) NOT NULL DEFAULT '1',
  `strenght` int(11) NOT NULL DEFAULT '5',
  `agility` int(11) NOT NULL DEFAULT '5',
  `stamina` int(11) NOT NULL DEFAULT '5',
  `intuition` int(11) NOT NULL DEFAULT '5',
  `lvl` int(11) NOT NULL DEFAULT '1',
  `exp` int(11) NOT NULL DEFAULT '0',
  `is_online` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `battle`
--
ALTER TABLE `battle`
  ADD CONSTRAINT `battle_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `battle_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `battle_ibfk_3` FOREIGN KEY (`winner`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
