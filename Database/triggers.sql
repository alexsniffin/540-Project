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

DELIMITER //
DROP TRIGGER IF EXISTS ProfileCheck //
CREATE TRIGGER ProfileCheck BEFORE INSERT ON Users
FOR EACH ROW
BEGIN
	DECLARE errMsg VARCHAR(128);

	IF (NEW.display_name NOT REGEXP '[^.\w]') THEN --Why does this not work...
		SET errMsg = "Only characters and numbers are allowed for display names.";
        	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	ELSEIF (NEW.age >= 150) THEN
		SET errMsg = "Age must be less than 150, sorry old people.";
        	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	ELSEIF (NEW.email NOT REGEXP '^[^@]+@[^@]+\.[^@]{2,}$') THEN
		SET errMsg = "Email must not include any special symbols.";
        	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	END IF;
END //
DELIMITER ;
