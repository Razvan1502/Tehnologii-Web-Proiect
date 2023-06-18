CREATE TABLE `register` (
  `ID` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `CODE` int(7) NOT NULL,
  `Password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `register`
  ADD PRIMARY KEY (`ID`);

CREATE TABLE `shop_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` varchar(60) NOT NULL,
  `product_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `shop_products` (`id`, `product_name`, `product_desc`, `product_image`, `product_price`) VALUES
(1, 'Black Tea', 'Delicious black tea with rich flavor.', 'blackTea.png', 8.5),
(2, 'Mint Tea', 'Refreshing mint tea with a soothing aroma.', 'mintTea.png', 8),
(3, 'Berry Tea', 'A delightful blend of berries for a fruity tea experience.', 'berryTea.png', 9.5),
(4, 'Linden Tea', 'Light and fragrant linden tea for relaxation.', 'lindenTea.png', 9),
(5, 'Green Tea', 'Healthy and invigorating green tea.', 'greenTea.png', 7),
(6, 'Ginger Tea', 'Spicy and warming ginger tea.', 'gingerTea.png', 6.5);

ALTER TABLE `shop_products`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `shop_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` varchar(20) NOT NULL,
  `table_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);



CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `products` (`product_id`, `product_name`, `quantity`) VALUES
(1, 'Mint Tea', 3),
(2, 'Berry Tea', 11),
(3, 'Linden Tea', 13),
(4, 'Ginger Tea', 12),
(5, 'Green Tea', 4),
(6, 'Black Tea', 4);

ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);


CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `total_price` float NOT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

CREATE TABLE `order_items` (
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `order_items`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);


ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;
