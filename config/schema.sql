CREATE TABLE `logs` (
      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
      `username` varchar(255) DEFAULT NULL,
      `message` text,
      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8
