/*
MySQL Backup
Source Server Version: 5.6.26
Source Database: zoo-crm
Date: 18.05.2017 12:28:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `pets` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `customer_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `customer_category`
-- ----------------------------
DROP TABLE IF EXISTS `customer_category`;
CREATE TABLE `customer_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `margin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `margin_id` (`margin_id`),
  CONSTRAINT `customer_category_ibfk_1` FOREIGN KEY (`margin_id`) REFERENCES `margin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `manufacturer`
-- ----------------------------
DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `margin`
-- ----------------------------
DROP TABLE IF EXISTS `margin`;
CREATE TABLE `margin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sum` decimal(10,0) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `at_date` int(11) DEFAULT NULL,
  `delivery_date` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`),
  KEY `customer_id` (`customer_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`),
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `order_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `order_status`
-- ----------------------------
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `price`
-- ----------------------------
DROP TABLE IF EXISTS `price`;
CREATE TABLE `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `status_check` int(1) DEFAULT '0',
  `price` decimal(10,2) DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  KEY `category_id` (`category_id`),
  KEY `price_id` (`price_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`),
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`),
  CONSTRAINT `product_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `product_category`
-- ----------------------------
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `product_order_mn`
-- ----------------------------
DROP TABLE IF EXISTS `product_order_mn`;
CREATE TABLE `product_order_mn` (
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`order_id`),
  KEY `dfggssg` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `vendor`
-- ----------------------------
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `customer` VALUES ('1','Скотный двор имени Чехова','+8 888 888 88 88','1','Лошади, коровы','Москва, ул. Ленина');
INSERT INTO `customer_category` VALUES ('1','Оптовые покупатели','6');
INSERT INTO `manufacturer` VALUES ('1','NORDOG Group'), ('2','ACANA ООО');
INSERT INTO `margin` VALUES ('6','Скидка 5%','5');
INSERT INTO `order` VALUES ('1','1','1','323','sd',NULL,NULL,NULL,NULL), ('2','2','1','32323','3232','0','0','1','323');
INSERT INTO `order_status` VALUES ('1','В обработке'), ('2','Выполнен'), ('3','Отменен');
INSERT INTO `price` VALUES ('6','1','2.00','1495020590'), ('7','1','42','1495020611'), ('8','1','212.00','1495023814');
INSERT INTO `product` VALUES ('1','Китэкет','2','1','2',NULL,'99','0','212.00','1494605203'), ('2','Пшено','3','2','3',NULL,'56','1','568.00','0');
INSERT INTO `product_category` VALUES ('2','Корм для собак'), ('3','Корм для кошек');
INSERT INTO `vendor` VALUES ('2','4 Май Петс','8 (495) 517 33 28','info@4mypets.ru'), ('3','ЗАО «АГРОБИОПРОМ»','(495)607-50-34','zakaz@agrobioprom.com');
