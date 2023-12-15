<?php 
//if session in not true,redirect to main controller
if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors/index.php');
}
if($_SESSION['clientData']['clientLevel'] < 2){
    header('Location: /phpmotors/index.php');
    exit;
}

$classificationList =  '<label>Update the car Classification:</label><select id="classificationId" name="classificationName" required><option>Choose a classification</option>';

foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
        $classificationList .= ' selected ';
        }
    } elseif(isset($invInfo['classificationId'])){
    if($classification['classificationId'] === $invInfo['classificationId']){
        $classificationList .= ' selected ';
    }
    }
    $classificationList .= ">$classification[classificationName]</option>";
    }
$classificationList .=  '</select>';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors template page">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></title>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/phpmotors/css/base.css">
    <link rel="stylesheet" href="/phpmotors/css/large.css">
</head>    
<body>
    <div id="wrapper">
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php" ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>

    <main>
        <section class="updateVehicle">
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ echo "Modify $invInfo[invMake] $invInfo[invModel]"; 
            } elseif(isset($invMake) && isset($invModel)) { echo "Modify$invMake $invModel"; }?></h1>
            <?php if(isset($message)) { echo $message;}?>

            <form id="newCarForm" method="post" action="/phpmotors/vehicles/index.php">
                <?php echo $classificationList ?>

                <label for="make">Make:</label>
                <input type="text" name="invMake" id="make" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

                <label for="model">Model:</label>
                <input type="text" name="invModel" id="model" required <?php if(isset($invModel)){ echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?>>

                <label for="description">Description:</label>
                <textarea name="invDescription" id="description" required ><?php if(isset($invDescription)){ echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo "$invInfo[invDescription]"; } ?></textarea>

                <label for="imagepath">Image Path:</label>
                <input type="text" name="invImage" id="imagepath" value="/phpmotors/images/no-image.png" required <?php if(isset($invImage)){ echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>>

                <label for="thumbnailpath">Thumbnail Path:</label>
                <input type="text" name="invThumbnail" id="thumbnailpath" value="/phpmotors/images/no-image.png" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>>

                <label for="price">Price:</label>
                <input type="number" name="invPrice" id="price" min="0" required <?php if(isset($invPrice)){ echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>>

                <label for="color">Color:</label>
                <input type="text" name="invColor" id="color" required <?php if(isset($invColor)){ echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>>

                <input type="submit" name="submit" value="Update Vehicle" class="submit-button">

                <input type="hidden" name="action" value="updateVehicle">

                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
            </form>

        </section>
        <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div> 
</body>
</html>