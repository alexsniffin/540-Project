-- MySQL automatically creates clustered indexing on primary keys. Nice.

-- Indexing for Share Code to increase search speed for private polls
ALTER TABLE Polls ADD INDEX (share_code);

-- Indexing for Categorys to increase search speed on public polls
ALTER TABLE Polls ADD INDEX (category);

-- Indexing on Email and Password in increase login query
ALTER TABLE Users ADD INDEX (email, password);
