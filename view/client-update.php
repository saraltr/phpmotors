<?php 
    if(!isset($_SESSION['loggedin'])){
        header('Location: /phpmotors/');
    }
    $clientInfo = $_SESSION['clientData'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors update account page">
    <title>Account Update | PHP Motors</title>
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
        <section class="accountInfo-view">
            <h1>Manage Account</h1>

            <?php if (isset($message)) : ?>
                <p><?php echo $message; ?></p> 
            <?php endif; ?>

            <div class="infoUp">
                <form id="manageForm" method="POST" action="/phpmotors/accounts/index.php?action=updateUserInfo">
                <fieldset>
                <legend>Update Account</legend>
                <label for="clientFirstname">First Name:</label>
                <input type="text" name="clientFirstname" id="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'";} ?>>

                <label for="clientLastname">Last Name:</label>
                <input type="text" name="clientLastname" id="clientLastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'"; } elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'";} ?>>

                <label for="clientEmail">Email:</label>
                <input type="email" name="clientEmail" id="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'";} ?>>

                <input type="submit" name="submit" class="submit-button" value="Update Information">

                <input type="hidden" name="action" value="updateUserInfo">

                <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>
                ">
                </fieldset>
              </form>

              <form id="passwordForm" method="POST" action="/phpmotors/accounts/index.php?action=updatePassword">
                  <fieldset>
                  <legend>Change Password</legend>
                  <p>Current password will change permanently</p>

                  <label>New Password: <input type="password" name="clientPassword" id="clientPassword" minlength="8" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder="Enter new password"></label>

                  <ul class="requirement-list">
                      <li class="requirement">Password should have 8 characters or more</li>
                      <li class="requirement">Contain at least 1 number</li>
                      <li class="requirement">Contain at least 1 special character</li>
                      <li class="requirement">Contain at least 1 capital letter</li>
                  </ul>

                  <input type="submit" name="submit" class="submit-button" value="Update Password">

                  <input type="hidden" name="action" value="updatePassword">

                  <input type="hidden" name="clientId" value="
                  <?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                  elseif(isset($clientId)){ echo $clientId; } ?>
                  ">
                  </fieldset>
              </form>
            </div>


        </section>
      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>