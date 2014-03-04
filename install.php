<?php
$con=mysqli_connect("localhost","root","q1w2e3","QOS");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = " CREATE TABLE answers (
  id INT(30) NOT NULL AUTO_INCREMENT, question_id INT(20) NOT NULL,answer VARCHAR(250) NOT NULL,
  correct ENUM('0','1') NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE TABLE questions (
  id INT(30) NOT NULL AUTO_INCREMENT,question_id INT(20) NOT NULL,question VARCHAR(250) NOT NULL,
  type VARCHAR(50) NOT NULL, UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 CREATE TABLE users (
  id INT(30) NOT NULL AUTO_INCREMENT, name VARCHAR(30) NOT NULL, password VARCHAR(20) NOT NULL, password_again VARCHAR(20) NOT NULL,email VARCHAR(100) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `quiz_takers` (
  `id` INT(30) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `percentage` INT(100) NOT NULL,
  `date_time` DATETIME NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1  ";



// Execute multi query
if (mysqli_multi_query($con,$sql))
{
 echo "table created";
 }
 else   {
  echo "Error creating database: " . mysqli_error($con);
  } 

mysqli_close($con);
?> 