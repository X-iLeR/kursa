-- phpMyAdmin SQL Dump
-- version 4.2.0-rc1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 12 2014 г., 22:07
-- Версия сервера: 5.5.37-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `kursak`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);
