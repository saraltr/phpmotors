<?php 
    if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1) {
      header('Location: /phpmotors/');
      exit;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors add classification page">
    <title>Add Classification | PHP Motors</title>
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
        <section class="addClassPage">
        <h1>Add Classification</h1>
          <?php
              if(isset($message)) {
                echo $message;
              }
          ?>
            <form id="newClass" method="POST" action="/phpmotors/vehicles/index.php">
                <label for="classificationName">Classification Name:</label>
                <input type="text" name="classificationName" id="classificationName" maxlength="30" required>

                <input type="submit" class="submit-button" id="addc" value="Add Classification">

                <input type="hidden" name="action" value="addedNewClass">
                
            </form>
        </section>
      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>