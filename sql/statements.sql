-- Create a database with some table and use it
CREATE DATABASE garden-x-travaganza;
USE garden_x_travaganza;
CREATE TABLE users (username VARCHAR(50), password VARCHAR(100));

-- Populate a database
INSERT INTO users (username,password) VALUES("Olivia","1234567890");

-- Create a user with privileges to a database
CREATE user 'martin'@'localhost' IDENTIFIED BY 'me4kaikop4e';
GRANT ALL PRIVILEGES ON garden_x_travaganza.* TO 'martin'@'localhost';
FLUSH PRIVILEGES;
