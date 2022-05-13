-- Web Backend Development 1: CSE340
-- Week 3: Enhancement2.sql
-- Instructor: Ammon Shepherd
-- Author: Kwazeme Ogubie


-- CREATE table
CREATE TABLE clients
(
    clientId INT(10) NOT NULL PRIMARY KEY,
    clientFirstname VARCHAR(15) NOT NULL,
    clientLastname VARCHAR (25) NOT NULL,
    clientEmail VARCHAR(40) NOT NULL,
    clientPassword VARCHAR(255),
    -- clientLevel ENUM("1","2","3") DEFAULT '1',
    comment TEXT    
);
-- *Writing SQL Statments

-- Query 1: INSERT
INSERT INTO clients
( 
 clientFirstname, clientLastname, clientEmail, clientPassword, comment
)
VALUES
(
 'Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman'
);

-- Query 2: UPDATE
UPDATE clients
SET clientLevel = 3
WHERE clientFirstname = 'Tony' AND clientLastname = 'Stark';

-- Query 3: UPDATE AND REPLACE
UPDATE inventory
SET invDescription = REPLACE(invDescription,'small interiors','spacious interior')
WHERE inventory.invId = 12;

-- Query 4: INNER JOIN
SELECT car.invMake, car.invModel, clss.classificationName
FROM carclassification AS clss
INNER JOIN inventory AS car 
ON car.classificationId = clss.classificationId
WHERE clss.classificationName = 'SUV';

-- Query 5: DELETE
DELETE FROM inventory
WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

-- Query 6: UPDATE with CONCAT
UPDATE inventory
SET invImage = CONCAT('/phpmotors', invImage),
    invThumbnail = CONCAT('/phpmotors', invThumbnail);

-- Link to video demostration
-- https://somup.com/c3h1rYOs1o
-- https://screencast-o-matic.com/u/wDeW/

-- Reverse query 6
-- UPDATE inventory
-- SET invThumbnail = REPLACE(invThumbnail,'/phpmotors','');
