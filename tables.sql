-- Tables for 540 Poll App Project, full database documentation at 
-- https://docs.google.com/document/d/192YH8u7bxSb10Z9gxeHdSVb2I0XLxp4-DhEmbFiv3Rw/edit?usp=sharing

-- Some user with attributes: email, password, name, ip, mac, points, created date, and total votes
CREATE TABLE Users (
	ID INT NOT NULL AUTO_INCREMENT,
	email CHAR(64) NOT NULL,
	password CHAR(32) NOT NULL,
	display_name CHAR(16) NOT NULL,
	ip_address INT UNSIGNED,
	mac_address char(32) DEFAULT 'Unknown',
	points INT DEFAULT 100,
	time_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	total_votes INT DEFAULT 0,
	PRIMARY KEY(ID),
	UNIQUE(email),
	UNIQUE(ip_address),
	UNIQUE(mac_address)
);

-- Some Poll created by a Users with some attributes: share_code (can be null; null approach), creation date, date to close poll, question
CREATE TABLE Polls (
	User_ID INT NOT NULL,
	P_ID INT NOT NULL AUTO_INCREMENT,
	share_code CHAR(8),
	date_created DATE,
	date_to_close DATE,
	question VARCHAR(255) NOT NULL,
	PRIMARY KEY(P_ID),
	FOREIGN KEY (User_ID) REFERENCES Users(ID),
	UNIQUE(share_code)
);

-- Some Vote record where a Users has voted in a Polls, holds the result
CREATE TABLE Voted (
	Vote_ID INT NOT NULL AUTO INCREMENT,
	User_ID INT NOT NULL,
	P_ID INT NOT NULL,
	result INT NOT NULL,
	PRIMARY KEY(Vote_ID),
	FOREIGN KEY (User_ID) REFERENCES Users(ID),
	FOREIGN KEY (P_ID) REFERENCES Polls(P_ID)
);

-- Some Answers for a Polls
CREATE TABLE Answers (
	P_ID INT NOT NULL,
	ANS_ID INT NOT NULL AUTO INCREMENT,
	ans VARCHAR(128) NOT NULL,
	res INT NOT NULL,
	PRIMARY KEY(ANS_ID),
	FOREIGN KEY (P_ID) REFERENCES Polls(P_ID)
);

-- TRIGGERS
-- TODO: Add check for removing points when creating polls
DELIMITER $$
DROP TRIGGER IF EXISTS UserCheck $$
CREATE TRIGGER UserCheck BEFORE UPDATE ON Users
FOR EACH ROW
BEGIN
	IF (NEW.points - OLD.points) < 0 OR (NEW.points - OLD.points) > 10 THEN
		SET NEW.points = OLD.points + 10;
	END IF;
END $$
DELIMITER ;

