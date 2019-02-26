CREATE TABLE `prefix_test` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `code` varchar(50) COLLATE utf8_bin NOT NULL,
  `menu_title` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `menu_enable` tinyint(4) NOT NULL DEFAULT '0',
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `prefix_test`
--

INSERT INTO `prefix_test` (`id`, `title`, `code`, `menu_title`, `menu_enable`, `state`) VALUES
(1, 'пдд', 'pdd', '0', 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `prefix_test`
--
ALTER TABLE `prefix_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state` (`state`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `prefix_test`
--
ALTER TABLE `prefix_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;