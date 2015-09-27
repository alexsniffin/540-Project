-- Sample data for 540 Poll App Project, full database documentation at 
-- https://docs.google.com/document/d/192YH8u7bxSb10Z9gxeHdSVb2I0XLxp4-DhEmbFiv3Rw/edit?usp=sharing

INSERT INTO Users VALUES ('', 'abc@gmail.com', 'pass', 'Alex', '127.0.0.1', 'pc1', 100, NOW(), 0);
INSERT INTO Users VALUES ('', 'abcd@gmail.com', 'pass1', 'Lee', '127.0.0.2', 'pc2', 100, NOW(), 0);
INSERT INTO Users VALUES ('', 'abcde@gmail.com', 'pass2', 'Michael', '127.0.0.3', 'pc3', 100, NOW(), 0);
INSERT INTO Users VALUES ('', 'abcdef@gmail.com', 'pass3', 'Julian', '127.0.0.4', 'pc4', 100, NOW(), 0);

INSERT INTO Polls VALUES(1, NULL, NULL, NOW(), NOW(), 'Some question', 'Some ans', 'Some other ans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO Polls VALUES(1, NULL, NULL, NOW(), NOW(), 'Some question', 'Some ans', 'Some other ans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO Polls VALUES(1, NULL, NULL, NOW(), NOW(), 'Some question', 'Some ans', 'Some other ans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO Polls VALUES(1, NULL, NULL, NOW(), NOW(), 'Some question', 'Some ans', 'Some other ans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO Polls VALUES(2, NULL, NULL, NOW(), NOW(), 'Some question', 'Some ans', 'Some other ans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO Polls VALUES(2, NULL, NULL, NOW(), NOW(), 'Some question', 'Some ans', 'Some other ans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO Polls VALUES(3, NULL, NULL, NOW(), NOW(), 'Some question', 'Some ans', 'Some other ans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO Polls VALUES(4, NULL, NULL, NOW(), NOW(), 'Some question', 'Some ans', 'Some other ans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO Voted VALUES(1, 5, 1);
INSERT INTO Voted VALUES(1, 8, 2);
