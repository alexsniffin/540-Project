-- TRIGGERS
-- TODO: ...

-- Check if a user has already voted on a poll before inserting
DELIMITER //
DROP TRIGGER IF EXISTS VoteCheck //
CREATE TRIGGER VoteCheck BEFORE INSERT ON Voted
FOR EACH ROW
BEGIN
	DECLARE errMsg VARCHAR(128);
	DECLARE hasVoted INT;

	SELECT COUNT(User_ID) INTO hasVoted
	FROM Voted v, Answers a
	WHERE v.User_ID = NEW.User_ID AND a.ANS_ID = NEW.ANS_ID AND EXISTS (
		SELECT p.P_ID
		FROM Polls p
		WHERE a.P_ID = p.P_ID
	);
	
	IF (hasVoted > 0) THEN
		SET errMsg = "Seems you''ve already voted in this poll, try another poll!";
        	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	END IF;
END //
DELIMITER ;
-- Test with:
INSERT INTO Voted VALUES(NULL, 2, 1); -- Should throw the error message
