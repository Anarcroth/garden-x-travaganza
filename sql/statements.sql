-- Create a database with some table and use it
CREATE DATABASE garden-x-travaganza;
USE garden_x_travaganza;
CREATE TABLE users (username VARCHAR(50), password VARCHAR(100));

-- Populate a database
INSERT INTO users (username,password) VALUES("Olivia","1234567890"); -- This is only a demo data input

-- Remove table entries
 DELETE FROM users WHERE username='XXXX';

-- Create a user with privileges to a database
CREATE user 'martin'@'localhost' IDENTIFIED BY 'me4kaikop4e';
GRANT ALL PRIVILEGES ON *.* TO 'martin'@'localhost';
FLUSH PRIVILEGES;
