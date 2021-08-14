CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fullname` varchar(120) NOT NULL,
  `username` varchar(120)  NOT NULL,
  `email` varchar(200) NULL,
  `password` varchar(250)  NOT NULL,
  `reg_date` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `post_title` varchar(100) NOT NULL,
  `post_content` TEXT NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `post_username` varchar(100) NOT NULL,
  `post_date` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;