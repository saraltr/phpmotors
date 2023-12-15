<?php 
    if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1) {
      header('Location: /phpmotors/');
      exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors template page">
    <title>Add Vehicle | PHP Motors</title>
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
        <section class="addCarPage">
          <h1>Add Vehicle</h1>
          <?php
            if(isset($message)) {
              echo $message;
            }
          ?>
          <form id="newCarForm" method="POST" action="/phpmotors/vehicles/index.php">
            <?php echo $classificationList ?>

            <label for="invMake">Make:</label>
            <input type="text" id="invMake" name="invMake" maxlength="30" required placeholder="30 characters max" <?php if(isset($invMake)){echo "value='$invMake'";} ?>>

            <label for="invModel">Model:</label>
            <input type="text" id="invModel" name="invModel" maxlength="30" required <?php if(isset($invModel)){echo "value='$invModel'";} ?>>

            <label for="invDescription">Description:</label>
            <textarea name="invDescription" id="invDescription" required><?php if(isset($invDescription)){echo $invDescription;} ?></textarea>

            <label for="invImage">Image Path:</label>
            <input type="text" id="invImage" name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} ?> maxlength="50" value="/phpmotors/images/no-image.png" required>

            <label for="invThumbnail">Thumbnail Path:</label>
            <input type="text" id="invThumbnail" name="invThumbnail" maxlength="50" value="/phpmotors/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required>

            <label for="invPrice">Price:</label>
            <input type="number" id="invPrice" name="invPrice" min="0" step="0.01" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>

            <label for="invColor">Color:</label>
            <input type="text" id="invColor" name="invColor" maxlength="20" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required>

            <input type="submit" class="submit-button" id="addv" value="Add Vehicle">

            <input type="hidden" name="action" value="addedNewCar">

          </form>
        </section>
        

      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>