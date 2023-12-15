<?php
// vehicles controller

// Create or access a Session
session_start();

// check if the user is not logged in or has a client level greater than 1

// if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 2) {
//     header('Location: /phpmotors/');
//     exit;
// }

// Use the database connection file
require_once '../library/connections.php';

// Use the phpmotors model
require_once '../model/main-model.php';

// Use the vehicles model
require_once '../model/vehicles-model.php';
// Use the functions library
require_once '../library/functions.php';
// use the uploads model
require_once '../model/uploads-model.php';

$classifications = getClassifications(); 

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

//get action method
$action = filter_input( INPUT_POST, 'action' );
if ( $action == NULL ) {
  $action = filter_input( INPUT_GET, 'action' );
} 

// testing 
// foreach ($classification as $key => $value) {
//     echo "Key: $key, Value: $value<br>";
// }

// Create a $classificationList variable to build a dynamic drop-down select list. The classificationName must appear to the human eye, but the classificationId must be the value of each option.
// retrieve the submitted classificationId
$classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_VALIDATE_INT);

$classificationList =  '<label>Update the car Classification:</label>
<select id="classificationId" name="classificationId" required>
<option>Choose a classification</option>';

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


switch($action)
{
    case 'add-vehicle':
        include '../view/add-vehicle.php';
    break;
    case 'addedNewCar':

       // filter and store the data
       $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
       $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS)); 
       $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
       $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       
    
        // check for missing data
        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invColor)) {
            $message = "<p>Please provide information for all required fields. You are missing: ";
            $missingFields = array();

            if (empty($classificationId)) $missingFields[] = "Classification";
            if (empty($invMake)) $missingFields[] = "Make";
            if (empty($invModel)) $missingFields[] = "Model";
            if (empty($invDescription)) $missingFields[] = "Description";
            if (empty($invImage)) $missingFields[] = "Image";
            if (empty($invThumbnail)) $missingFields[] = "Thumbnail";
            if (empty($invPrice)) $missingFields[] = "Price";
            if (empty($invColor)) $missingFields[] = "Color";

            $message .= implode(', ', $missingFields);
            $message .= "</p>";
            include '../view/add-vehicle.php';
            exit;
        }
    
        // send the data to the model
        $regOutcome = addVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor);
    
        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>The $invMake $invModel was added successfully!";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Operation failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
    case 'add-classification':
        include '../view/add-classification.php';
        break;
    case 'addedNewClass':
        $classificationName = trim(filter_input(INPUT_POST,'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if (empty($classificationName)){
            $message =  '<p>Please enter a classification name.</p>';
            include '../view/add-classification.php';
            exit;
        } 

        $regOutcome = addClassification($classificationName);

        if($regOutcome === 1){
            header('Location: ../vehicles/index.php');
            exit;
        } else {
            $message = '<p>Operation failed. Please try again.</p>';
            include '../view/add-classification.php';
            exit;
        }

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        // $inventoryArray = getInventoryByClassification($classifications); 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
    break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
    break;

    case 'updateVehicle':
        // Filter and store the data
        $classificationId = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_NUMBER_INT));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Check for missing data
        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invColor)) {
          $message = '<p class="emptyField">Please provide information for all empty form fields.</p>';
          include '../view/vehicle-update.php';
          exit; 
        }
  
        // Send the data to the model
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $classificationId, $invId);
  
        // Check and report the result
        if($updateResult) {
          $message = "<p class='success'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
          header('location: /phpmotors/vehicles/');
          exit;
  
        } else {
          $message = "<p class='emptyField'>Error. The vehicle was not updated.</p>";
            include '../view/vehicle-update.php';
          exit;
        }

    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;

    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='error-message'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;
        
    case 'vehicleDetail':
        // get the 'invId' from the query string 
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // retrieve vehicle info based on the 'invId'
        $vehicle = getVehiInfo($invId);

        //get thumbnails 
        $thumbnails = getAllThumbnails($invId);
        // var_dump($thumbnails);

        $vehicleName = "{$vehicle['invMake']} {$vehicle['invModel']}";
        // check if the vehicle information is empty (not found)
        if(!count($vehicle)){
            $message = "<p class='error-message'>Sorry, no vehicle could be found.</p>";
        } else { 
            // if vehicle information is found build the details display
            $vehicleDisplay = buildVehicleDetails($vehicle, $thumbnails);
        }

        include '../view/vehicle-detail.php';
    break;

    default:
        $classificationList = buildClassificationList($classifications);
        
        include '../view/vehicle-man.php';
    break;

}

?>