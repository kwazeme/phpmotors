SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)



SELECT invId, invMake, invModel, invPrice, classificationId
FROM inventory
WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
JOIN images
WHERE inventory.invId = images.invId 


SELECT a.invId, a.invMake, a.invModel, a.invPrice, a.classificationId, b.invId, b.imgName, b.imgPath, b.imgPrimary
          FROM inventory AS a WHERE a.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
          JOIN images AS b
          ON a.invId = b.invId


SELECT inventory.invId, inventory.invMake, inventory.invModel, inventory.invPrice, inventory.classificationId
                images.ImgId, images.invId, images.imgName, images.imgPath, images.imgPrimary
          FROM inventory, images
          WHERE inventory.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
          INNER JOIN inventory ON inventory.invId = images.ImgId



-- This one fetches every image in the table
SELECT veh.invId, veh.invMake,veh.invModel,veh.invDescription,veh.classificationId,veh.invPrice,img.imgId,img.invId,img.imgName,img.imgPath,imgPrimary
          FROM inventory as veh, images as img
          WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
          



SELECT veh.invId, veh.invMake,veh.invModel,veh.invDescription,veh.classificationId,veh.invPrice,img.imgId,img.invId,img.imgName,img.imgPath,imgPrimary
          FROM inventory as veh, images as img
          WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)


SELECT * FROM inventory, images WHERE inventory.invId = :invId LIKE images.invId 

-- Instructors solution
-- For this SQL statement, you need to use a JOIN and LIKE.
--The basic format for the function to get vehicles by classification is:
SELECT * FROM table1 JOIN table2 ON table1.id = table2.id WHERE table1.classId IN (SELECT classId FROM classTable WHERE className = :className) AND <put in here a statement to check if it is the primary image> AND <put in here a statement so you get only the thumbnails>

-- The format for the function to get a specific vehicles info is more simple
SELECT * FROM table1 JOIN table2 ON table1.id = table2.id WHERE table1.id = :id AND <put in here a statement to check if it is the primary image> AND <put in here a statement to make sure it is NOT the thumbnail>


-- Needs work
SELECT inv.invId, inv.invMake, inv.invModel, inv.invDescription, 
  inv.invPrice, inv.invStock, inv.invColor, inv.classificationId, (SELECT img.imgPath FROM images img WHERE inv.invId = img.invId AND img.imgPrimary = 1 LIMIT 1)
   invImage, (SELECT img.imgPath FROM images img WHERE inv.invId = img.invId AND img.imgPrimary = 0 AND img.imgPath LIKE "%-tn%" LIMIT 1),
  invThumbnail FROM inventory inv WHERE inv.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)

-- Correct syntax: working solution. Fetches image -tn.jpg
SELECT * FROM inventory JOIN images ON inventory.invId = images.invId WHERE inventory.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName) AND images.imgPrimary = 1 AND images.imgPath LIKE "%-tn%"


-- 
SELECT * FROM inventory JOIN images ON inventory.invId = images.invId WHERE inventory.invId = :invId AND images.imgPrimary = 1  AND images.imgPath NOT LIKE "%-tn%"

-- Review table create
CREATE TABLE `phpmotors`.`reviews` 
(`reviewId` INT UNSIGNED NOT NULL AUTO_INCREMENT , 
`reviewText` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL , 
`reviewDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
`invId` INT UNSIGNED NOT NULL , 
`clientId` INT UNSIGNED NOT NULL , 
PRIMARY KEY (`reviewId`)) ENGINE = InnoDB;

-- Foriegn Keys clients, inventory and reviews tables
ALTER TABLE `reviews` 
ADD CONSTRAINT `FK_reviews_clients` 
FOREIGN KEY (`clientId`) REFERENCES `clients`(`clientId`) 
ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `reviews` 
ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) 
REFERENCES `inventory`(`invId`) ON DELETE CASCADE ON UPDATE CASCADE;


SELECT * 
            FROM reviews 
            WHERE invId = :invId
            ORDER BY reviewDate DESC';