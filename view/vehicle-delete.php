<?php
if($_SESSION['clientData']['clientLevel'] < 2){
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors template page">
    <title><?php if(isset($invInfo['invMake'])){echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
        <section class="deleteCarPage">
            <h1>
                <?php if(isset($invInfo['invMake'])){ echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?>
            </h1>
            <p>All fiels are readonly</p>
          <?php
            if(isset($message)) {
              echo $message;
            }
          ?>
          <p>Confirm Vehicle Deletion. The delete is permanent.</p>
          <form id="newCarForm" method="POST" action="/phpmotors/vehicles/index.php">

            <label for="invMake">Make:</label>
            <input type="text" name="invMake" id="invMake" readonly <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

            <label for="invModel">Model:</label>
            <input type="text" name="invModel" id="invModel" readonly <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

            
            <label for="invDescription">Description:</label>
            <textarea name="invDescription" id="invDescription" readonly><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>

            <input type="submit" class="submit-button" value="Delete Vehicle">

            <input type="hidden" name="action" value="deleteVehicle">

            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
            elseif(isset($invId)){ echo $invId; } ?>">

          </form>
        </section>
        

      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>