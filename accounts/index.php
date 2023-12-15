<?php
// accounts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// get the accounts model
require_once '../model/accounts-model.php';
require_once '../library/functions.php';


// Get the array of classifications
$classifications = getClassifications();

// testing
// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

//get action method
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// testing
// echo $navList;
// exit;

//check for existance of firstname cookie
if(isset($_COOKIE["firstname"])){
    $_SESSION['cookieFirstname'] = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action)
{   
    case 'login-page':
        include '../view/login.php';
        break;
    case 'login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordCheck = checkPassword($clientPassword);

        // run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
            $_SESSION['message'] = '<p class="notice">Please provide a valid email address and password.</p>';
        include '../view/login.php';
        exit;
        }
        
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
            $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
    case 'registration':
        include '../view/registration.php';
    break;

    case 'register':
        // filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        $existingEmail = checkExistingEmail($clientEmail);

        // check for existing email address in the table
        if($existingEmail) {
            $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = "<p>Please provide information for all empty form fields.</p>";
            include '../view/registration.php';
            exit;
        }

        // hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            // setcookie("firstname", $clientFirstname, strtotime("+1 year"), "/");
    
            $_SESSION['message'] = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            //include '../view/login.php';
            header('Location: /phpmotors/accounts/?action=login-page');
            exit;
          } else {
            $message = "<p class='error-message'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
          }
    case 'logout':
        //unset session
      session_unset();
      //destroy session
      session_destroy();
      //return to phpmotors main controller
      header('Location: /phpmotors/index.php');
      exit;

    case 'update':
        //get the users information using their id
        $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
        $clientInfo = getClientInfo($clientId);
        include '../view/client-update.php';
    break;

    case 'updateUserInfo':
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      $clientEmail = checkEmail($clientEmail);
      $existingEmail = checkExistingEmail($clientEmail);

      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
        $message = '<p class="error-message">Please provide information for all empty form fields.</p>';
        include '../view/client-update.php';
        exit; 
      }
      
      //checking for an existing email address and if email is not same as session email
      if($existingEmail === 1 && $clientEmail != $_SESSION['clientData']['clientEmail']){
        $message = '<p class="notice">The email address you entered already exists.</p>';
        $_SESSION['message'] = $message;
        include '../view/client-update.php';
        exit;
      }      
      
      // send the data to the model
      $updateResult = accountUpdate($clientFirstname, $clientLastname, $clientEmail, $clientId);  
      
      if ($updateResult) {
        // update the corresponding fields in the session data
        $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
        $_SESSION['clientData']['clientLastname'] = $clientLastname;
        $_SESSION['clientData']['clientEmail'] = $clientEmail;

        $message = "<p class='success'>The update was successful.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/accounts/');
        exit;
        
      } else {
        $message = "<p class='error-message'>Error. The account was not updated.</p>";
        include '../view/client-update.php';
        exit;
      }

      case 'updatePassword':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        $checkPassword = checkPassword($clientPassword);

        // check for missing data
        if (empty($clientPassword)) {
            $message = '<p class="error-message">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        if (!$checkPassword) {
            $message = '<p class="error-message">The password you entered is not in a valid format.</p>';
            include '../view/client-update.php';
            exit;
        }

        // check if the password is the same password already 
        $clientInfo = getClientInfo($clientId);
        $hashCheck = password_verify($clientPassword, $clientInfo['clientPassword']);

        if ($hashCheck) {
            $message = '<p class="notice">You entered the same current password. No changes were made.</p>';
            include '../view/client-update.php';
            exit;
        }
        
        // updates the results in the db
        $updateResult = passwordUpdate($clientPassword, $clientId);

        if ($updateResult) {
            $message = "<p class='success'>The password was updated successfully!</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='error-message'>Error. The password was not updated.</p>";
            include '../view/client-update.php';
            exit;
        }

    default:
        include '../view/admin.php';
    break;
}

?>