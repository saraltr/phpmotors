<?php 
    if ($_SESSION['clientData']['clientLevel'] < 2) {
      header('Location: /phpmotors/');
      exit;
    }

    if(isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vehicle Management page">
    <title>Vehicle Management | PHP Motors</title>
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
        <?php echo $navList ?>
      </nav>
      <main>
        <section class="managPage">
        <h1>Vehicle Management</h1>
          <ul>
              <li>
                <a href="../vehicles/index.php?action=add-classification">Add classification</a>
              </li>
              <li>
                  <a href="../vehicles/index.php?action=add-vehicle">Add vehicle</a>
              </li>
          </ul>
          </section>
          <section class="vehiManag">
          <?php
          if (isset($_SESSION['message'])) :?>
                  <div class="success">
                      <p><?php echo $_SESSION['message']; ?></p>
                  </div>
          <?php
          endif;

          if (isset($classificationList)) : ?>
              <h2>Vehicles By Classification</h2>
              <?php echo $classificationList; ?>
          <?php endif; ?>
            <noscript>
              <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
          </section>
          
      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html><?php unset($_SESSION['$message']);?>