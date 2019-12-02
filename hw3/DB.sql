-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 02 2019 г., 14:17
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson5`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `path_big` varchar(250) NOT NULL,
  `path_small` varchar(250) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `title`, `path_big`, `path_small`, `rating`) VALUES
(2, 'medovik.jpg', 'data/images/big/medovik.jpg', 'data/images/small/medovik.jpg', 3),
(3, 'napoleon.jpg', 'data/images/big/napoleon.jpg', 'data/images/small/napoleon.jpg', 8),
(4, 'pancho.jpg', 'data/images/big/pancho.jpg', 'data/images/small/pancho.jpg', 4),
(5, 'mount.jpg', 'data/images/big/mount.jpg', 'data/images/small/mount.jpg', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(10) NOT NULL,
  `path_big` varchar(250) NOT NULL,
  `path_small` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `category`, `description`, `price`, `path_big`, `path_small`) VALUES
(1, 'nazvanie', 'торт', 'Opisanit', 0, '/db/images/big/kopiya.jpg', '/db/images/small/kopiya.jpg'),
(2, 'Ежик', 'торт', 'Хороший торт', 5560, '/db/images/big/kopiya.jpg', '/db/images/small/kopiya.jpg'),
(3, 'Трухлявый пень', 'пирожное', 'Великолепный торт вообще', 400, '/db/images/big/2017-08-28_20.53.03.jpg', '/db/images/small/2017-08-28_20.53.03.jpg'),
(4, 'Заварное', 'пирожное', 'Вкусное пирожное, однако', 870, '/db/images/big/2017-08-28_20.53.03.jpg', '/db/images/small/2017-08-28_20.53.03.jpg'),
(5, 'Ежик', 'торт', 'avefveaf', 2452, '/db/images/big/ejik.jpg', '/db/images/small/ejik.jpg'),
(6, 'Медовик', 'торт', 'Медовый торт', 450, '/db/images/big/medovik.jpg', '/db/images/small/medovik.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
