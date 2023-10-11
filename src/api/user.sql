
--
-- База данных: `phone_book`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `organization` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `phone`, `organization`) VALUES
(1, 'Тест Тестов Тестович 1', '8 (800) 555-35-35', 'Банк'),
(2, 'Тест Тестов Тестович 2', '8 (800) 555-45-45', 'Магазин'),
(3, 'Тест Тестов Тестович 3', '8 (800) 555-55-55', 'Больница');
