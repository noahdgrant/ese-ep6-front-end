# ese-ep6-front-end
Front-end code for ESE Engineering Project 6


When running server on windows using xampp, to set up the environment variables for php and mysql complete the following steps:
In start menu search for and open "Edit the system environment variables"
Select Environment Variables
Select Path
add the following new entries:
C:\xampp\php
C:\xampp\mysql\bin


Setting up environment variables for mysql database info in php:
Add the following lines of code to C:\xampp\apache\conf\httpd.conf

SetEnv MYSQL_PASSWORD "your_mysql_password"
SetEnv MYSQL_USERNAME "your_mysql_username"

to access the variables in php simply use the following code:

$db_password = getenv('MYSQL_PASSWORD');
$db_username = getenv('MYSQL_USERNAME');