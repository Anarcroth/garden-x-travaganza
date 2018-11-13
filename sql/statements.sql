-- This is a set of the commands that were used in SQL to create and maintain the database needed for this project

-- Step 0.
-- Create a user with privileges to a database.
CREATE user 'martin'@'localhost' IDENTIFIED BY 'me4kaikop4e';
GRANT ALL PRIVILEGES ON *.* TO 'martin'@'localhost';
FLUSH PRIVILEGES;

-- Step 1.
-- Create a database and use it.
CREATE DATABASE garden-x-travaganza;
USE garden_x_travaganza;

-- Step 2.
-- Create tables.
CREATE TABLE users (username TINYTEXT, password TEXT);
CREATE TABLE catalogue (item TINYTEXT, id INT, price FLOAT(255, 3) unsigned, description LONGTEXT, imgpath TINYTEXT);
CREATE TABLE promo (code VARCHAR(50), item TINYTEXT);

-- Step 3.
-- Populate the database tables.

INSERT INTO users (username, password) VALUES("Olivia","1234567890"); -- This is only a demo. Real users should have their passwords encrypted and NOT stored in plain text.

INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Hedge Trimmer", 421234, 149.00, "Kobalt 80-volt cordless hedge trimmer provides the power you need with up to 70 minutes runtime on a fully charged 2.0 Ah battery. Complete your project faster with dual action laser cut blades at 3600 strokes per minute. Cut through thick shrubs with a 26-in blade and 3/4-in cut capacity.", "/hedge_trimmer.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Root Assassin Shovel", 468713, 50.00, "48 In ROOT ASSASSIN shovel saw that is the original and best award winning shovel and saw Combo garden tool. Patented all purpose garden shovel and saw easily slices through roots. 16 beveled and serrated steel teeth on each side and cuts while digging both in and out.", "/shovel.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Bypass Hand Pruner", 541896, 14.98, "A pruner with soft ComfortGEL grips for less hand fatigue and a great feel. The handles, chassis and hook are a one-piece, full-steel design built for durability. The handles have a full steel core versus other tools which have a steel blade connected to the top of a handle.", "/pruner.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Bypass Lopper", 528965, 23.48, "Power-lever mechanism increases leverage to make cutting 2 times easier than single-pivot loppers. Sharp, precision-ground blade edge. Corrosion-resistant, non-stick blade coating reduces friction to make cutting easier.", "/lopper.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Sledge Hammer", 456851, 34.98, "10 lb steel sledge hammer with 34-in fiberglass handle. Demolition side perfect for all those difficult tasks around a work site. 10-lb head is ideal for concrete and construction projects.", "/sledge_hammer.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Steel Camp Axe", 965810, 34.98, "Great for use on camping trips. 1-piece forged metal head and handle for strength. 3-1/4 in. tempered cutting edge for easy chopping.", "/camp_axe.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Steel Garden Rake", 854175, 14.98, "Coronas new line of ExtendedREACH hand tools are designed for working in raised -bed gardens, small gardens and tight access locations. ComfortGEL grips deliver comfort to gardeners who seek an easier, more therapeutic gardening experience. Optimal 36-in length for long reach and balance - ideal for gardeners who find many long handle tools to hard to manage.", "/garden_rake.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Steel Garden Pick", 854963, 49.98, "Ideal for breaking up rocky surfaces such as gravel and hardened, dried earth (pointed end), or for use as a hoe when digging in tough soil (flat end). Patented IsoCore Shock Control System absorbs strike shock and vibration to reduce the punishment your body takes, transferring 2X less shock and vibration than wood handles. Insulation sleeve captures initial strike shock before it can reach your hand.", "/pickaxe.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Leather Garden Gloves", 456025, 11.98, "Breathable 4-way stretch spandex back helps reduce hand fatigue and keeps hands cool. Touch screen capabilities on the index finger. Adjustable hook and loop wrist helps keep unwanted dirt and debris out of the glove.", "/gloves.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Hand Tool Kit", 748596, 59.95, "Gardener seat and tools. Sturdy, lightweight and portable. Tool pockets on exterior of storage tote.", "/kit.jpg");
INSERT INTO catalogue (item, id, price, description, imgpath) VALUES("Bulb Auger", 418503, 14.98, "Dig holes up to 22 inches deep and 2-3/4 inches wide. Just insert into any 3/8 inch or larger drill.", "/auger.jpg");

INSERT INTO promo (code, item) VALUES("6daee431-5882-416b-b60a","Sledge Hammer");
INSERT INTO promo (code, item) VALUES("3b632813-6b36-4563-bf16","Hedge Trimmer");
INSERT INTO promo (code, item) VALUES("d55f2ce8-33ba-43cf-bb19","Root Assassin Shovel");
INSERT INTO promo (code, item) VALUES("6f931dc4-b79e-42d7-bc92","Bypass Hand Pruner");
INSERT INTO promo (code, item) VALUES("bb4f918a-a0df-4081-b5e9","Steel Camp Axe");
INSERT INTO promo (code, item) VALUES("6a2b4397-c840-405f-ab8e","Bypass Lopper");
INSERT INTO promo (code, item) VALUES("f8df22b9-3c66-4bf4-8007","Steel Garden Rake");
INSERT INTO promo (code, item) VALUES("0743ac4d-3000-4bfd-84c7","Steel Garden Pick");
INSERT INTO promo (code, item) VALUES("208d8de9-2896-4ffc-a27b","Leather Garden Gloves");
INSERT INTO promo (code, item) VALUES("87c76eec-af33-4b79-a607","Hand Tool Kit");
INSERT INTO promo (code, item) VALUES("fbb27b4d-98e6-478f-b1e1","Bulb Auger");

-- Plumbing commands --

-- Just get everything.
SELECT * FROM tablename;

-- Remove table entries.
DELETE FROM users WHERE username='XXXX';

-- Update table column data types.
ALTER TABLE users MODIFY username TINYTEXT; -- This is just an example on how to modify a column data type.

-- Show the details of a table.
SHOW FIELDS FROM table_name;

-- Update a specific column value of a table;
UPDATE catalogue SET imgpath='$HOME/assets/hedge_trimmer.jpg' WHERE item='Hedge Trimmer';
