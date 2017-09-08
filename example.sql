
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);


ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);


ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

INSERT INTO employee(cat_id, `name`, surname) VALUES('1', 'test', 'user');
INSERT INTO category(cat_id, cat_name) VALUES('1', 'test category');
