CREATE TABLE clients (
  clientId int NOT NULL auto_increment,
  clientFirstname varchar(30),
  clientLastname varchar(30),
  clientEmail varchar(40),
  clientPassword varchar(255),
  clientLevel ENUM("1", "2", "3") DEFAULT "1",
  comment text,
  PRIMARY KEY (clientId)
);
-- 1
INSERT INTO clients(
    clientFirstname,
    clientLastname,
    clientEmail,
    clientPassword,
    COMMENT
)
VALUES(
    "Tony",
    "Stark",
    "tony@starkent.com",
    "Iam1ronM@n",
    "I am the real Ironman"
)

-- 2
UPDATE
    clients
SET
    clientLevel = 3
WHERE
    clientFirstname = "Tony" AND clientLastname = "Stark";

-- 3
UPDATE
    inventory
SET
    invDescription =
REPLACE
    (
        invDescription,
        "small interior",
        "spacious interior"
        
    )
WHERE
    invMake = "GM" AND invModel = "Hummer";

-- 4
SELECT
    inv.invModel,
    car.classificationName
FROM
    inventory as inv
INNER JOIN carclassification as car ON inv.classificationId = car.classificationId
WHERE
    inv.classificationId = 1
LIMIT 0, 25;


-- 5 
DELETE FROM
    inventory
WHERE
    invMake = "Jeep" AND invModel = "Wrangler"

-- 6 
UPDATE
    inventory
SET
    invImage = CONCAT("/phpmotors", invImage),
    invThumbnail = CONCAT("/phpmotors", invThumbnail);