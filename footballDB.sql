DROP DATABASE IF EXISTS football;

CREATE DATABASE football;

USE football;

CREATE TABLE `player` (
  `playerID` int(11) NOT NULL AUTO_INCREMENT,
  `squadNumber` int(11) NOT NULL,
  `playerName` varchar(30) NOT NULL,
  `playerPosition` varchar(30) NOT NULL,
  `playerAge` int(11) NOT NULL,
  PRIMARY KEY (`playerID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `privilege` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO user (userName, pass, privilege) VALUES ('admin', '$2y$10$Lx0xaM9yAX37rhUqxwrdo.WRfY8NEf7gPlUuVk0c0fHXKNcgrPTq6', 1);
INSERT INTO user (userName, pass, privilege) VALUES ('user', '$2a$06$dB8q4ONiNZctM0MM7zjake4eo0z87QQbXy8B.U4vWYYhAgzLmIUfm', 0);

INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'J. Joyce', 'GoalKeeper', 26);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'A. Andrew', 'GoalKeeper', 27);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'B. Bob', 'Midfielder', 25);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'C. Carl', 'Midfielder', 28);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'E. Enzo', 'Defender', 26);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'F. Finn', 'Defender', 29);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'Z. Zach', 'Forwards', 28);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'M. Matt', 'Defender', 25);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (1, 'N. Newton', 'Forwards', 26);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (2, 'O. Orion', 'Midfielder', 20);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (2, 'P. Peter', 'GoalKeeper', 21);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (3, 'D. Dann', 'Defender', 22);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (3, 'G. Gary', 'Defender', 23);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (4, 'T. Tom', 'Midfielder', 24);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (4, 'V. Vance', 'GoalKeeper', 24);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (4, 'R. Ron', 'Forwards', 24);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (5, 'U. Ulah', 'Midfielder', 30);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (5, 'I. Igor', 'Forwards', 30);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (5, 'H. Helio', 'GoalKeeper', 31);
INSERT INTO player (squadNumber, playerName, playerPosition, playerAge) VALUES (5, 'X. X', 'Forwards', 32);