<?php 
// vehicles model

// function to add a car into the inventory db
function addVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor){
    // create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (classificationId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invColor)
        VALUES (:classificationId, :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invColor)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    
    // Insert the data into the db
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
// function to add a car into the inventory db
function addClassification($classificationName){
    // create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification (classificationName)
        VALUES (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    
    // Insert the data into the db
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}

// Get vehicle information by invId
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

// obtaines an individual vehicle's details
// This function should only obtain the large, primary image from the images table, and the non-image details from the inventory table.
function getVehiInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT i.invMake, i.invModel, i.invDescription, i.invPrice, i.invColor, im.imgPath AS largeImgPath
            FROM inventory i
            LEFT JOIN images im ON i.invId = im.invId AND im.imgPath NOT LIKE "%-tn%"
            WHERE i.invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}


// Update a vehicle
//Function to update car info in inventory table.
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $classificationId, $invId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
     invDescription = :invDescription, invImage = :invImage, 
     invThumbnail = :invThumbnail, invPrice = :invPrice, invColor = :invColor, 
     classificationId = :classificationId WHERE invId = :invId';
     // Create the prepared statement using the phpmotors connection
     $stmt = $db->prepare($sql);
     
     $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
     $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
     $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
     $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
     $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
     $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
     $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
     $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
     $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
 
     // Insert the data
     $stmt->execute();
     // Ask how many rows changed as a result of our insert
     $rowsChanged = $stmt->rowCount();
     // Close the database interaction
     $stmt->closeCursor();
     // Return the indication of success (rows changed)
     return $rowsChanged;
} 

// delete vehicle from the db
function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getVehiclesByClassification($classificationName) {
    try {
        $db = phpmotorsConnect();
        $sql = 'SELECT i.invId, i.invYear, i.invMake, i.invModel, i.invDescription, i.invPrice, i.invColor, i.classificationId, im.imgPath 
                FROM inventory i
                JOIN images im ON i.invId = im.invId
                JOIN carclassification cc ON i.classificationId = cc.classificationId
                WHERE im.imgPath LIKE "%-tn%"
                AND cc.classificationName = :classificationName';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; 
    }
}



// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

?>