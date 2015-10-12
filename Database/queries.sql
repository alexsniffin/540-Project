-- Please note for some reason with MySQL it doesn't like tabs, so remove any tabs if you
-- use the terminal.

-- #1
-- Get new random public poll for some <USER_ID>
-- Projects all of the polls that the <USER_ID> doesn't own, and also checks
-- all of the polls in which the user has voted in. Will check the date to close attribute too.
DELIMITER //
CREATE PROCEDURE random_public_poll
	(IN user INT)
BEGIN
	SELECT P_ID
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
--
CALL public_Poll(<id>);

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
