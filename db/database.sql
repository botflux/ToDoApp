CREATE database if NOT EXISTS todoapp CHARACTER SET utf8 COLLATE utf8_unicode_ci;

use todoapp;

GRANT ALL PRIVILEGES ON todoapp.* to 'todoapp_user'@'localhost' identified by 'secret';