<?php
// search model

function searchInventory($search) {
    $db = phpmotorsConnect();
    $query = '%' . $search . '%';

    $sql = 'SELECT * FROM inventory
            WHERE invMake LIKE :make 
            OR invModel LIKE :model 
            OR invDescription LIKE :description
            OR invColor LIKE :color';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':make', $query, PDO::PARAM_STR);
    $stmt->bindValue(':model', $query, PDO::PARAM_STR);
    $stmt->bindValue(':description', $query, PDO::PARAM_STR);
    $stmt->bindValue(':color', $query, PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $searchResults;
}


// invMake
// invModel
// invDescription
// invColor


?>
