CREATE TABLE `car_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_car` varchar(255) NOT NULL ,
  `date_car` varchar(255)  NOT NULL,
  `time_car1` varchar(255)  NOT NULL,
  `time_car2` varchar(255)  NOT NULL,
  `status_car` varchar(255)  DEFAULT NULL,
  `users` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `car_db` AUTO_INCREMENT = 1;