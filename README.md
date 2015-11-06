## APP INFO
Software Engineering CSCI 540 Polling App Project

Members:

*Lee, Alexander, Michael, Julian*

## WEB INFO
TO-DO ...

## DATABASE INFO
To access the MySQL database on Michael's computer, use:

**mysql -u darth -p -h 24.197.117.117**

The password is: *[Send an email or text to get the pass]*

Use the following command to access our database used for this project, or make a seperate one for personal debugging/use.

**use pollApp;**

Then you can use this command to show the current tables.

**show tables;**

Current *procedures/functions* that can be used:

Procedures -
- **random_public_poll**(User_ID: INT, category: CHAR(32)) *returns Poll_ID: INT (ResultSet)*
- **private_poll**(share_code: CHAR(8)) *returns Poll_ID: INT (ResultSet)*
- **create_poll**(User_ID: INT, Question: VARCHAR(255), share_code: CHAR(8), category: CHAR(32), days_to_close: INT, ans1 ... ans12: VARCHAR(128)) *returns void*
- **getPollQuestion**(Poll_ID: INT, share_code: CHAR(8)) *returns Question: VARCHAR(255), DisplayName: CHAR(16), DateCreated: DATE (ResultSet)*
- **getPollAnswers**(Poll_ID: INT) *returns ANS_ID: INT, Answer: VARCHAR(128), TotalVotes: INT (ResultSet)*
- **userVote**(User_ID: INT, ANS_ID: INT) *returns void*
- **addCoins**(User_ID: INT, Poll_ID: INT) *returns void*
- **createUser**(email: CHAR(64), pass CHAR(32), displayName CHAR(16), IP INT UNSIGNED, MAC CHAR(32), timeCreated: TIMESTAMP) *returns void* (will throw an error 'Email is already in use' if email is already in the db)
- **getProfile**(User_ID: INT) *returns Email: CHAR(64), DisplayName: CHAR(16), Coins: INT, Gender: CHAR(6), Age: INT, Time created: DATE, Total votes: INT (ResultSet)*
-- **getUserPolls**(User_ID) *returns P_ID: INT, Question: CHAR(255), Category: CHAR(32), Share code: CHAR(8), Date created: DATE, Date to close: DATE (ResultSet)*

Functions - 
- **login**(email: CHAR(64), pass CHAR(32)) *returns User_ID (Single value)* (if -1, then wrong email or pass)
- **getRandomPublicPoll**(User_ID: INT, category: CHAR(32)) *returns Poll_ID: INT (Single value)*
- **getPrivatePoll**(share_code: CHAR(8)) *returns Poll_ID: INT (Single value)*

Triggers:
- **VoteCheck** - Checks if you've voted in a poll already

