-- Tables for 540 Poll App Project, full database documentation at 
-- https://docs.google.com/document/d/192YH8u7bxSb10Z9gxeHdSVb2I0XLxp4-DhEmbFiv3Rw/edit?usp=sharing

CREATE TABLE Users (
	ID INT NOT NULL AUTO_INCREMENT,
	email CHAR(64) NOT NULL,
	password CHAR(32) NOT NULL,
	display_name CHAR(16) NOT NULL,
	ip_address char(32) NOT NULL,
	mac_address char(32) NOT NULL,
	points INT,
	time_created DATE,
	total_votes INT,
	PRIMARY KEY(ID),
	UNIQUE(email),
	UNIQUE(ip_address),
	UNIQUE(mac_address)
);

CREATE TABLE Polls (
	ID INT NOT NULL,
	P_ID INT NOT NULL AUTO_INCREMENT,
	share_code CHAR(8),
	date_created DATE,
	date_to_close DATE,
	question CHAR(255) NOT NULL,
	ans1 CHAR(128) NOT NULL,
ans2 CHAR(128) NOT NULL,
	ans3 CHAR(128),
	ans4 CHAR(128),
	ans5 CHAR(128),
	ans6 CHAR(128),
	ans7 CHAR(128),
	ans8 CHAR(128),
	ans9 CHAR(128),
	ans10 CHAR(128),
	ans11 CHAR(128),
	ans12 CHAR(128),
	FOREIGN KEY (ID) REFERENCES Users(ID),
	UNIQUE(P_ID),
	UNIQUE(share_code),
	CONSTRAINT unique_poll PRIMARY KEY (ID, P_ID)
);

CREATE TABLE Voted (
	ID INT NOT NULL,
	P_ID INT NOT NULL,
	result INT NOT NULL,
	FOREIGN KEY (ID) REFERENCES Users(ID),
	FOREIGN KEY (P_ID) REFERENCES Polls(P_ID),
	CONSTRAINT unique_voted PRIMARY KEY (ID, P_ID)
);

CREATE TABLE Results (
	P_ID INT NOT NULL,
	res1 INT,
	res2 INT,
	res3 INT,
	res4 INT,
	res5 INT,
	res6 INT,
	res7 INT,
	res8 INT,
	res9 INT,
	res10 INT,
	res11 INT,
	res12 INT,
	FOREIGN KEY (P_ID) REFERENCES Polls(P_ID)
);

