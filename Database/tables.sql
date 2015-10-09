-- Tables for 540 Poll App Project, full database documentation at 
-- https://docs.google.com/document/d/192YH8u7bxSb10Z9gxeHdSVb2I0XLxp4-DhEmbFiv3Rw/edit?usp=sharing (Note this may not be up to date)

-- #1 Some user with attributes: email, password, name, ip, mac, points, created date, and total votes
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
	UNIQUE(mac_address)
);

-- #2 Some Poll created by a Users with some attributes: share_code (can be null; null approach), creation date, date to close poll, question
CREATE TABLE Polls (
	P_ID INT NOT NULL AUTO_INCREMENT, 
	User_ID INT,
	share_code CHAR(8),
	date_created DATE,
	date_to_close DATE,
	question VARCHAR(255) NOT NULL,
	PRIMARY KEY(P_ID),
	FOREIGN KEY (User_ID) REFERENCES Users(ID),
	UNIQUE(share_code)
);

-- #3 Some Answers for a Polls that also holds the total votes
CREATE TABLE Answers (
	ANS_ID INT NOT NULL AUTO_INCREMENT,
	P_ID INT,
	ans VARCHAR(128) NOT NULL,
	total_votes INT NOT NULL,
	PRIMARY KEY(ANS_ID),
	FOREIGN KEY (P_ID) REFERENCES Polls(P_ID)
);

-- #4 Some Vote record where a Users has voted in a Polls, holds the result
CREATE TABLE Voted (
	Vote_ID INT NOT NULL AUTO_INCREMENT,
	User_ID INT,
	P_ID INT,
	ANS_ID INT,
	PRIMARY KEY(Vote_ID),
	FOREIGN KEY (User_ID) REFERENCES Users(ID),
	FOREIGN KEY (P_ID) REFERENCES Polls(P_ID),
	FOREIGN KEY (ANS_ID) REFERENCES Answers(ANS_ID)
);

