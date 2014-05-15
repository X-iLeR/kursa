-- phpMyAdmin SQL Dump
-- version 4.2.0-rc1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 15 2014 г., 20:57
-- Версия сервера: 5.5.37-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
`id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) DEFAULT NULL,
  `time_begin` int(11) DEFAULT NULL,
  `time_end` int(11) DEFAULT NULL,
  `winner` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `battle`
--

INSERT INTO `battle` (`id`, `user1`, `user2`, `time_begin`, `time_end`, `winner`) VALUES
(11, 13, 11, 1400176574, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `turn`
--

CREATE TABLE IF NOT EXISTS `turn` (
`id` int(11) NOT NULL,
  `battle_id` int(11) NOT NULL,
  `attack1` int(11) DEFAULT NULL,
  `attack2` int(11) DEFAULT NULL,
  `defense1` int(11) DEFAULT NULL,
  `defense2` int(11) DEFAULT NULL,
  `damage1` int(11) DEFAULT NULL,
  `damage2` int(11) DEFAULT NULL,
  `finished` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `turn`
--

INSERT INTO `turn` (`id`, `battle_id`, `attack1`, `attack2`, `defense1`, `defense2`, `damage1`, `damage2`, `finished`) VALUES
(6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` varchar(24) NOT NULL,
  `pwd` varchar(64) NOT NULL,
  `blocked` tinyint(4) DEFAULT NULL,
  `hp` int(11) NOT NULL DEFAULT '5',
  `strenght` int(11) NOT NULL DEFAULT '5',
  `agility` int(11) NOT NULL DEFAULT '5',
  `stamina` int(11) NOT NULL DEFAULT '5',
  `intuition` int(11) NOT NULL DEFAULT '5',
  `lvl` int(11) NOT NULL DEFAULT '1',
  `exp` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '3',
  `last_activity` int(11) DEFAULT NULL,
  `is_online` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `pwd`, `blocked`, `hp`, `strenght`, `agility`, `stamina`, `intuition`, `lvl`, `exp`, `points`, `last_activity`, `is_online`) VALUES
(11, 'test', '7cbb3252ba6b7e9c422fac5334d22054', NULL, 5, 5, 5, 5, 5, 1, 0, 3, NULL, NULL),
(12, 'test2', '7cbb3252ba6b7e9c422fac5334d22054', NULL, 5, 5, 5, 5, 5, 1, 0, 3, NULL, NULL),
(13, 'test1', '7cbb3252ba6b7e9c422fac5334d22054', NULL, 10, 5, 5, 5, 5, 0, 20, 5, NULL, NULL),
(14, 'test11', '7cbb3252ba6b7e9c422fac5334d22054', NULL, 0, 5, 5, 5, 5, 1, 0, 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `battle`
--
ALTER TABLE `battle`
 ADD PRIMARY KEY (`id`), ADD KEY `user1` (`user1`,`user2`), ADD KEY `user2` (`user2`), ADD KEY `winner` (`winner`);

--
-- Indexes for table `turn`
--
ALTER TABLE `turn`
 ADD PRIMARY KEY (`id`), ADD KEY `battle_id` (`battle_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `battle`
--
ALTER TABLE `battle`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `turn`
--
ALTER TABLE `turn`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `battle`
--
ALTER TABLE `battle`
ADD CONSTRAINT `battle_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `battle_ibfk_3` FOREIGN KEY (`winner`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `turn`
--
ALTER TABLE `turn`
ADD CONSTRAINT `turn_ibfk_1` FOREIGN KEY (`battle_id`) REFERENCES `battle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
