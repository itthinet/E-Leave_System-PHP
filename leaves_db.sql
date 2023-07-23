CREATE TABLE `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL ,
  `leave_date` varchar(255) NOT NULL ,
  `leave_reason` varchar(255)  NOT NULL,
  `status_a` varchar(255)  DEFAULT NULL,
  `status_reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `leaves` AUTO_INCREMENT = 1;