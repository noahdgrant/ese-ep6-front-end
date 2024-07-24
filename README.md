# ese-ep6-front-end
Front-end code for ESE Engineering Project 6

## WINDOWS
clone the repo to C:\xampp\htdocs
___
#### php & mysql env variables
When running server using xampp, to set up the environment variables for php and mysql complete the following steps:
In start menu search for and open "Edit the system environment variables"
Select Environment Variables
Select Path
add the following new entries:
C:\xampp\php
C:\xampp\mysql\bin
___
#### php env variables using apache
Add the following lines of code to C:\xampp\apache\conf\httpd.conf
SetEnv MYSQL_PASSWORD "your_mysql_password"
SetEnv MYSQL_USERNAME "your_mysql_username"
to access the variables in php simply use the following code:

\$db_password = getenv("MYSQL_PASSWORD");
$db_username = getenv("MYSQL_USERNAME");


## LINUX
clone the repo to /var/www/html
___
#### php env variables using apache
Add the following lines of code to /etc/apache2/apache2.conf

SetEnv MYSQL_PASSWORD "your_mysql_password"
SetEnv MYSQL_USERNAME "your_mysql_username"

to access the variables in php simply use the following code:

\$db_password = getenv("MYSQL_PASSWORD");
$db_username = getenv("MYSQL_USERNAME");

#### File permissions
Ensure json/cardread.json and php/tmp have read/write permissions



## Email Setup for password change requests:
1. Create a gmail account

2. enable 2 step verification
go to google account https://myaccount.google.com/
Select "Security" from the left-hand menu.
Under "Signing in to Google," find "2-Step Verification" and click on it.
Follow the prompts to enable 2-Step Verification.

3. generate an app password
After enabling 2-Step Verification, go back to the "Security" section.
In the search bar at the top search for "App passwords" and click on it.
You may need to enter your password again.
Enter a name for your app (e.g., "PHP Mailer").
Click "Create".
Google will provide a 16-character app password. Copy this password.

4. include app password in envirnment variables

5. download and include the following library:
https://github.com/PHPMailer/PHPMailer/releases