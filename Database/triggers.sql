-- TRIGGERS

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

-- http://www.regextester.com/
-- Check if a new user has a valid name, pass, and email and limit age to 150
DELIMITER //
DROP TRIGGER IF EXISTS ProfileCheck //
CREATE TRIGGER ProfileCheck BEFORE INSERT ON Users
FOR EACH ROW
BEGIN
	DECLARE errMsg VARCHAR(128);

	IF NOT NEW.display_name REGEXP '^[A-Za-z0-9\s]+$' THEN
		SET errMsg = "Only characters and numbers are allowed for display name and passwords.";
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	ELSEIF NOT NEW.password REGEXP '^[A-Za-z0-9\s]+$' THEN
		SET errMsg = "Only characters and numbers are allowed for display name and passwords.";
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	ELSEIF (NEW.age <= 12) THEN
		SET errMsg = "Age must be 13 or greater.";
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	ELSEIF (NEW.age >= 150) THEN
		SET errMsg = "Age must be less than 150.";
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	ELSEIF NOT NEW.email REGEXP '^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$' THEN
		SET errMsg = "Email must not include any special symbols and must follow the format email@website.com.";
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errMsg;
	END IF;
END //
DELIMITER ;
