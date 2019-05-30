-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 27 2019 г., 14:25
-- Версия сервера: 5.6.43
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
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `book_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `image`, `document`, `year`, `author`, `viewed`, `status`, `category_id`, `date_added`, `book_key`) VALUES
(8, 'Afrika ertaklari', 'Ertaklar doimo xalq og’zaki ijodining nodir namunasi sifatida qadirlanib keladi. Sevib o’qiladi. Shu bilan bir qatorda u yoki bu xalqning yashash sharoiti, urf-odati, orzu-umidlari, kurashi ham o’z aksini topadi. Ushbu to’plamda asosan Afrika qitasida yashovchi Kongo, Angola, Efiyopiya, Bantu, Mabuntu kabi xalqlarning ertaklari kiritildi.', 'd47a87ce4d2c9bfbf4bc088a21956b39.jpg', '4bca98484920c504324455f36f1796f4.pdf', 2018, 'Ertaklar', 5, 1, 4, '2019-05-02', 'boo56564'),
(9, 'Beshning sarguzashtlari', 'Kunlardan bir kun Besh ko’chada orqa-oldiga qaramay yugurib borarkan: -	Hoy, kim bor, yordam beringlar! – deb qichqiribdi. -	Senga nima bo’ldi? Tinchlikmi? -	Orqamdan Olov belgisi quvib kelayotganini nahot ko’rmayapsizlar? Agar u menga yetib olsa, shunday musibat yuz beradiki!..', '2b3d217e5b9ad090ad14bd497f4717e2.jpg', 'b2a84e043a8d0017ba97cb9d1c10870a.pdf', 2018, 'Janni Rodari', 1, 1, 4, '2019-05-02', 'boo454564'),
(10, 'So\'nggi ov', 'Zokir Xudoyshukur - So\'nggi ov - 2018', '93189a08a4f559c83c547644658a4fb4.jpg', 'edbec8ab361a03a72a21c2facc6c23ca.pdf', 2018, 'Zokir Xudoyshukur', 4, 1, 4, '2019-05-02', 'boo456446'),
(11, 'Alamazon va uning piyodalari', 'Anvar Obidjon - Alamazon va uning piyodalari - 2018', '7468e26b68c75f60047a37dd02fe526a.jpg', 'b9e657b29958d77a52b90fb751361a1e.pdf', 2018, 'Anvar Obidjon', 1, 1, 4, '2019-05-02', 'boo789789'),
(12, 'Sarmoyador', 'Muallif: Teodor Drayzer Nashr etilgan yili: 2018', 'c7332c4c8b856c8999c7b9da2cea2f48.jpg', 'ee9ab3a00ed1f833ca2ee7f5a41d34b2.pdf', 2018, 'Teodor Drayzer', 24, 1, 4, '2019-05-08', 'bood8143bd4880b686ae441245f8237fd12'),
(13, 'Sariq devni minib', 'dsadasd', '933469dd5eb05ac9b1661b4b700b711f.jpg', '5a171971c1631b27d385f485c2ef5b9e.pdf', 2018, 'rwerwe', 1, 1, 4, '2019-05-08', 'boo190040d96ceb6c621d7fc6c0b7ca3f4a');

-- --------------------------------------------------------

--
-- Структура таблицы `books_tags`
--

CREATE TABLE `books_tags` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books_tags`
--

INSERT INTO `books_tags` (`id`, `book_id`, `tag_id`) VALUES
(2, 9, 1),
(3, 9, 2),
(4, 10, 2),
(5, 11, 1),
(6, 11, 2),
(7, 8, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category_books`
--

CREATE TABLE `category_books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `key_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_books`
--

INSERT INTO `category_books` (`id`, `name`, `parent_id`, `status`, `key_cat`) VALUES
(0, 'Root', 0, 1, 'cab5465'),
(3, 'Hikoyalar', 0, 1, 'cab5456'),
(4, 'Jahon adabiyoti', 0, 1, 'cab45425'),
(5, 'Ertaklar', 0, 1, 'cabcb00790b3d06ea71d8a2ddd76c73494b'),
(6, 'Normativ xujjatlar', 0, 1, 'cab5fd7cbbc45010f147c06926c44aff0b7'),
(7, 'Kodeks', 0, 1, 'cabfeaa3aa9821868db73534710d1945c9c');

-- --------------------------------------------------------

--
-- Структура таблицы `category_news`
--

CREATE TABLE `category_news` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `maqol`
--

CREATE TABLE `maqol` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `maqol`
--

INSERT INTO `maqol` (`id`, `name`) VALUES
(1, 'Kitobsiz aql - qanotsiz qush'),
(2, 'Kitoblar jonsiz, ammo sodiq do`stlardir');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1556088423),
('m130524_201442_init', 1556088427);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `date` datetime DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'tag1'),
(2, 'tag2');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'XlS_GUt0Zitar3u7ajlGTBLDTL7dtBIe', '$2y$13$6jDxNm0B4LU8GWA01fmVROPmxB5kd8GbYPXDCUbhDpDKTJ.V2pm9i', NULL, 'forward.uz@mail.ru', 10, 1556088462, 1556088462);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_cat_id` (`category_id`);

--
-- Индексы таблицы `books_tags`
--
ALTER TABLE `books_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookid` (`book_id`),
  ADD KEY `tagid` (`tag_id`);

--
-- Индексы таблицы `category_books`
--
ALTER TABLE `category_books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_news`
--
ALTER TABLE `category_news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `maqol`
--
ALTER TABLE `maqol`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_cat_id` (`category_id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `books_tags`
--
ALTER TABLE `books_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `category_books`
--
ALTER TABLE `category_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `category_news`
--
ALTER TABLE `category_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `maqol`
--
ALTER TABLE `maqol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `book_cat_id` FOREIGN KEY (`category_id`) REFERENCES `category_books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `books_tags`
--
ALTER TABLE `books_tags`
  ADD CONSTRAINT `bookid` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tagid` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_cat_id` FOREIGN KEY (`category_id`) REFERENCES `category_news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
