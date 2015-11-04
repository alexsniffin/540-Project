-- Sample debugging data for 540 Poll App Project
-- For AUTO_INCREMENT fields, leave as NULL
-- Note that you shouldn't have to reuse this data on the remote server unless you have to delete something!

-- Create our debugging users
INSERT INTO Users VALUES (
	NULL, -- User_ID = 1
	'tester@gmail.com', -- Our email address
	'buggy', -- Our password
	'The Debugger', -- Our display name
	'1.3.3.7', -- IP address
	'skynet_mainframe', -- Mac address
	9000, -- Total points
	NOW(), -- Date created
	0 -- Total times voted
);
INSERT INTO Users VALUES (NULL, 'throwingerrorsallday@gmail.com', 'system.err', 'The Exception', '127.0.0.1', 'some_broken_computer', 100, NOW(), 0); -- User_ID = 2
INSERT INTO Users VALUES (NULL, 'votesalot@gmail.com', 'ivoteforfun', 'The Poll Addict', '127.0.0.2', 'polling_botnet', 100000, NOW(), 9999); -- User_ID = 3

-- Create a Poll(s)
INSERT INTO Polls VALUES (
	NULL, -- Poll_ID = 1
	1, -- User_ID who created this poll
	NULL, -- Is this a private poll? If not leave NULL
	NOW(), -- Date created, use NOW() to get current time when inserted
	DATE_ADD(NOW(), INTERVAL 30 DAY), -- Date to close, will be in 30 days!
	'This App is pretty cool, but this question is even more cool, "don''t" you agree?' -- Some question
);

-- Now we have to make the Answers inserts for our poll(s)
INSERT INTO Answers VALUES (
	NULL, -- ANS_ID = 1
	1, -- What poll are we referring too?
	'Hell YES, best question ever!', -- The anwser to display
	9000 -- The total votes this answer has received
);
INSERT INTO Answers VALUES (NULL, 1, 'It''s alright.', 100); -- ANS_ID = 2
INSERT INTO Answers VALUES (NULL, 1, 'I think you could''ve come up with something better..', 100); -- ANS_ID = 3
INSERT INTO Answers VALUES (NULL, 1, 'Simply horrible.', 100); -- ANS_ID = 4

-- Now we need to figure out who has voted on what
INSERT INTO Voted VALUES (
	NULL, -- Vote_ID = 1
	2, -- User who has voted
	1, -- Poll they voted in
	1 -- Answer they voted on
);
