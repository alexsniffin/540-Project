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

-- TODO: 
