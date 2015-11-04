----------- APP INFO
Polling Application

----------- WEB INFO
TO-DO

----------- DATABASE INFO
To access the MySQL database on Michael's computer, use: 
mysql -u darth -p -h 24.197.117.117

The password is: ineedhelp

Use the following command to access our database used for this project, or make a seperate one for personal debugging/use.

use pollApp;

Then you can use this command to show the current tables.

show tables;

If you want to see the tuples in a table use:

SELECT * FROM <table_name>;

What this does is project all of the tuples (rows) of a table with all of the attributes. If you want to specify only a select attribute you could use something like this:

SELECT name FROM <table_name>;

or specify conditions

SELECT name FROM <table_name> WHERE name = 'User1';

These are just a couple examples of very basic SQL querys, if you want to learn more just go to W3Schools or ask me and I can help.

To insert data use: (View Database/sample_data.sql for more)

INSERT INTO <table_name> VALUES (<some_value>, ..., <some_value>);
