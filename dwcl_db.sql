CREATE TABLE `Userlogins` (
  `login_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) DEFAULT NULL,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`login_id`),
  FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`)
);

CREATE TABLE `Users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` INT(11) DEFAULT NULL,
  `fname` VARCHAR(50) NOT NULL,
  `midname` VARCHAR(50) DEFAULT NULL,
  `lname` VARCHAR(50) NOT NULL,
  `dob` DATE DEFAULT NULL,
  `age` INT(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
);
