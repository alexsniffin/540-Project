## APP INFO
Software Engineering CSCI 540 Polling App Project

Members:
Lee
Alexander
Michael
Julian

## WEB INFO
TO-DO ...

## DATABASE INFO
To access the MySQL database on Michael's computer, use: 
mysql -u darth -p -h 24.197.117.117

The password is: [Send an email or text to get the pass]

Use the following command to access our database used for this project, or make a seperate one for personal debugging/use.
use pollApp;

Then you can use this command to show the current tables.
show tables;

Current procedures/functions that can be used:

Random Polls, procedure and function versions - 
- **random_public_poll(User_ID: INT, category: CHAR(32))** returns Poll_ID: INT (ResultSet)
- **getRandomPublicPoll(User_ID: INT, category: CHAR(32))** returns Poll_ID: INT (Single value)

Private Polls, procedure and function versions -
- **private_poll(share_code: CHAR(8))** returns Poll_ID: INT (ResultSet)
- **getPrivatePoll(share_code: CHAR(8))** returns Poll_ID: INT (Single value)

Procedures -
- **create_poll(User_ID: INT, Question: VARCHAR(255), share_code: CHAR(8), days_to_close: INT, ans1 ... ans12: VARCHAR(128))** returns void
- **getPollQuestion(Poll_ID: INT, share_code: CHAR(8))** returns Question: VARCHAR(255), DisplayName: CHAR(16), DateCreated: DATE (ResultSet)
- **getPollAnswers(Poll_ID: INT)** returns ANS_ID: INT, Answer: VARCHAR(128), TotalVotes: INT (ResultSet)
- **userVote(User_ID: INT, ANS_ID: INT)** returns void
- **addCoins(User_ID: INT, Poll_ID: INT)** returns void

Triggers:
- VoteCheck - Checks if you've voted in a poll already

