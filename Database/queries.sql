-- Please note for some reason with MySQL it doesn't like tabs, so remove any tabs if you
-- use the terminal.

-- #1
-- Get new random public poll for some <USER_ID>
-- Projects all of the polls that the <USER_ID> doesn't own, and also checks
-- all of the polls in which the user has voted in. Will check the date to close attribute too.
DELIMITER //
CREATE PROCEDURE random_public_poll 
	(IN user INT,
	OUT poll_id INT)
BEGIN
	SELECT P_ID INTO poll_id
	FROM Polls p
	WHERE p.User_ID <> user AND p.share_code IS NULL AND date_to_close > NOW() AND NOT EXISTS (
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
DELIMITER;
-- Use
CALL random_public_poll(<id>);

-- #2
-- Get a Private Poll using a <share_code>
DELIMITER //
CREATE PROCEDURE private_poll
	(IN share_code CHAR(8))
BEGIN
	SELECT P_ID
	FROM Polls p
	WHERE p.share_code = share_code;
END //
DELIMITER;

-- #3
-- Create a poll and the corresponding answers
-- It's kind of ugly because I couldn't get a loop to work, but it works!
DELIMITER //
CREATE PROCEDURE create_poll
	(IN user INT,
	IN question VARCHAR(255),
	IN share_code CHAR(8),
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
		INSERT INTO Polls VALUES (NULL, user, share_code, NOW(), DATE_ADD(NOW(), INTERVAL days_to_close DAY), question);
	SET poll_id = LAST_INSERT_ID();

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
DELIMITER;

-- Use
CALL create_poll(1, 'Some question using procedure', NULL, 30, 'Some answer using procedure', 'Another answer using procedure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- #4 getPoll
DELIMITER //
CREATE PROCEDURE getPoll
	(IN poll_id INT,
	IN share_code CHAR(8))
BEGIN
	DECLARE user INT;
	SET user = (SELECT User_ID FROM Polls p1 WHERE p1.P_ID = poll_id LIMIT 1);

	SELECT p.question, u.display_name, p.date_created
	FROM Polls p, Users u
	WHERE p.P_ID = poll_id AND u.ID = user;

	SELECT ans
	FROM Answers a
	WHERE a.P_ID = poll_id;
END //
DELIMITER;
