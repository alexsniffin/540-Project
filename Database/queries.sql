-- Get new random public poll for some <USER_ID>
-- Projects all of the polls that the <USER_ID> doesn't own, isn't a private poll, whether it's the right category, will check the date to close attribute and also checks all of the polls in which the user has voted in.
-- Input: User_ID(Int), Category type(String)
-- Output: Poll_ID(Result set)
DELIMITER //
CREATE PROCEDURE random_public_poll 
	(IN user INT,
	IN cate CHAR(32))
BEGIN
	SELECT P_ID
	FROM Polls p
	WHERE p.User_ID <> user AND p.share_code IS NULL AND date_to_close > NOW() AND (cate IS NULL OR p.category = cate) AND NOT EXISTS (
		SELECT User_ID
		FROM Voted v
		WHERE v.User_ID = user AND v.ANS_ID IN (
			SELECT ANS_ID
			FROM Answers a
			WHERE a.P_ID = p.P_ID
		)
	)
	ORDER BY RAND() LIMIT 1;
END //
DELIMITER ;

-- Get a Private Poll using a <share_code>, follows same logic as public poll, except no category
-- Input: Share_code(String)
-- Output: Poll_ID(Result set)
DELIMITER //
CREATE PROCEDURE private_poll
	(IN user INT, 
	IN share_code CHAR(8))
BEGIN
	SELECT P_ID
	FROM Polls p
	WHERE p.User_ID <> user AND p.share_code = share_code AND date_to_close > NOW() AND NOT EXISTS (
		SELECT User_ID
		FROM Voted v
		WHERE v.User_ID = user AND v.ANS_ID IN (
			SELECT ANS_ID
			FROM Answers a
			WHERE a.P_ID = p.P_ID
		)
	)
	ORDER BY RAND() LIMIT 1;
END //
DELIMITER ;

-- Create a poll and the corresponding answers
-- It's kind of ugly, but it works! (No optional parameter length in MySQL)
-- Input: Question(String), Share code(String), category(String), Days to close(Date), Ans1 - Ans12(Strings)
-- Output: Null
DELIMITER //
CREATE PROCEDURE create_poll
	(IN user INT,
	IN question VARCHAR(255),
	IN share_code CHAR(8),
	IN category CHAR(32),
	IN days_to_close INT,
	IN ans1 VARCHAR(128),
	IN ans2 VARCHAR(128),
	IN ans3 VARCHAR(128),
	IN ans4 VARCHAR(128),
	IN ans5 VARCHAR(128),
	IN ans6 VARCHAR(128),
	IN ans7 VARCHAR(128),
	IN ans8 VARCHAR(128),
	IN ans9 VARCHAR(128),
	IN ans10 VARCHAR(128),
	IN ans11 VARCHAR(128),
	IN ans12 VARCHAR(128))
BEGIN
	DECLARE poll_id INT;
	DECLARE totalCoins INT;
	DECLARE errMsg VARCHAR(128);

	SELECT u.coins INTO totalCoins 
	FROM Users u 
	WHERE u.User_ID = user
	LIMIT 1;

	IF (totalCoins < 100) THEN
		SET errMsg = "Sorry, you don''t have enough coins for this!";
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	END IF;

	IF days_to_close IS NULL OR DATE_ADD(NOW(), INTERVAL days_to_close DAY) < NOW() THEN
		SET days_to_close = 30;
	END IF;

	INSERT INTO Polls VALUES (NULL, user, share_code, NOW(), DATE_ADD(NOW(), INTERVAL days_to_close DAY), question, category);
	SET poll_id = LAST_INSERT_ID();

	-- and..... a lot of if statements. Ew SQL...
	-- could probably do a procedure for adding in the answers
	IF ans1 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans1, 0);
	END IF;

	IF ans2 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans2, 0);
	END IF;

	IF ans3 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans3, 0);
	END IF;

	IF ans4 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans4, 0);
	END IF;

	IF ans5 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans5, 0);
	END IF;

	IF ans6 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans6, 0);
	END IF;

	IF ans7 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans7, 0);
	END IF;

	IF ans8 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans8, 0);
	END IF;

	IF ans9 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans9, 0);
	END IF;

	IF ans10 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans10, 0);
	END IF;

	IF ans11 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans11, 0);
	END IF;

	IF ans12 IS NOT NULL THEN
		INSERT INTO Answers VALUES (NULL, poll_id, ans12, 0);
	END IF;
END //
DELIMITER ;

-- getPollQuestion, returns a single tuple with the question, name of person who made poll, and date created
-- Input: Poll_ID(Int), Share Code(String)
-- Output: Question, Name, Date Created(Result set)
DELIMITER //
CREATE PROCEDURE getPollQuestion
	(IN poll_id INT)
BEGIN
	DECLARE user INT;
	SET user = (SELECT User_ID FROM Polls p1 WHERE p1.P_ID = poll_id LIMIT 1);

	SELECT p.question, u.display_name, p.date_created
	FROM Polls p, Users u
	WHERE p.P_ID = poll_id AND u.User_ID = user;
END //
DELIMITER ;

-- getPollAnswers, returns a result set of all answers for the given poll, their ANS_ID and the total votes which will be used for displaying results
-- Input: Poll_ID(Int)
-- Output: (Result set) ANS_ID, Answers, Total Votes
DELIMITER //
CREATE PROCEDURE getPollAnswers
	(IN poll_id INT)
BEGIN
	SELECT ANS_ID, ans, total_votes
	FROM Answers a
	WHERE a.P_ID = poll_id;
END //
DELIMITER ;

-- Increment Answers total_votes after user votes on poll and adds the user in voted table
-- Input: User_ID(Int), Ans_ID(Int)
-- Output: Void
DELIMITER //
CREATE PROCEDURE userVote
	(IN User_ID INT,
	IN Ans_ID INT)
BEGIN
	INSERT INTO Voted VALUES(NULL, User_ID, Ans_ID);

	UPDATE Answers a
	SET total_votes = total_votes + 1
	WHERE a.ANS_ID = Ans_ID;
END //
DELIMITER ;

-- Coin increment for random poll, updates the voters coins by 10 and the poll creater by 1
-- Input: User_ID(Int), P_ID(Int)
-- Output: Void
DELIMITER //
CREATE PROCEDURE addCoins
	(IN User_ID INT,
	IN P_ID INT)
BEGIN
	UPDATE Users u
	SET u.coins = u.coins + 10
	WHERE u.User_ID = User_ID;

	UPDATE Users u, Polls p
	SET u.coins = u.coins + 1
	WHERE p.P_ID = P_ID AND p.User_ID = u.User_ID;
END //
DELIMITER ;

-- Removes 100 coins from the User. This will be used for buying a Poll. If they don't have enough coins then it will return an error.
-- Input: User_ID(Int)
-- Output: Void
DELIMITER //
CREATE PROCEDURE removeCoins
	(IN User_ID INT)
BEGIN
	DECLARE totalCoins INT;
	DECLARE errMsg VARCHAR(128);

	SELECT u.coins INTO totalCoins 
	FROM Users u 
	WHERE u.User_ID = User_ID 
	LIMIT 1;

	IF (totalCoins >= 100) THEN
		UPDATE Users u
		SET u.coins = u.coins - 100
		WHERE u.User_ID = User_ID;
	ELSE
		SET errMsg = "Sorry, you don''t have enough coins for this!";
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	END IF;
END //
DELIMITER ;

-- Creates a new user
-- Input: email, password, displayName, gender, age, IP address, Mac Address, Date
-- Output: Void, can return an error if email already in use
DELIMITER //
CREATE PROCEDURE createUser
	(IN email CHAR(64),
	IN password CHAR(32),
	IN displayName CHAR(16),
	IN gender CHAR(6),
	IN age INT,
	IN IP INT UNSIGNED,
	IN mac CHAR(32),
	IN timeCreated TIMESTAMP)
BEGIN
	DECLARE EXIT HANDLER FOR 1062 SELECT 'Email is already in use';
	INSERT INTO Users VALUES(NULL, email, password, displayName, ip, mac, 100, gender, age, timeCreated, 0);
END //
DELIMITER ;

-- Logins with an email and password
-- Input: email, password
-- Output: User_ID, if wrong email or pass, it'll be -1
DELIMITER //
CREATE FUNCTION login(email CHAR(64), password CHAR(32))
	RETURNS INT
	DETERMINISTIC
BEGIN
	DECLARE id INT;

	SELECT User_ID INTO id
	FROM Users u
	WHERE u.email = email AND u.password = password;

	IF id IS NULL THEN
		SET id = -1;
	END IF;

	RETURN ID;
END //
DELIMITER ;

-- Get profile information
-- Input: User_ID
-- Output: email, display name, coins, gender, age, time created, total votes
DELIMITER //
CREATE PROCEDURE getProfile
	(IN User_ID INT)
BEGIN
	SELECT u.email, u.display_name, u.coins, u.gender, u.age, u.time_created, u.total_votes
	FROM Users u
	WHERE u.User_ID = User_ID
	LIMIT 1;
END //
DELIMITER ;

-- Get all user polls
-- Input: User_ID
-- Output: P_ID, question, category, share_code, date_created, date_to_close
DELIMITER //
CREATE PROCEDURE getUserPolls
	(IN User_ID INT)
BEGIN
	SELECT P_ID, question, category, share_code, date_created, date_to_close
	FROM Polls p
	WHERE p.User_ID = User_ID;
END //
DELIMITER ;

-- Get the polls a user has voted on
-- Input: User_ID
-- P_ID, question, answer
DELIMITER //
CREATE PROCEDURE getVotedOn
	(IN User_ID INT)
BEGIN
	SELECT a.P_ID, p.question, a.ans
	FROM Voted v, Polls p, Answers a
	WHERE v.User_ID = User_ID AND v.ANS_ID = a.ANS_ID AND a.P_ID = p.P_ID;
END //
DELIMITER ;