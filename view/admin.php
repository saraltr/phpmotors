<?php 
    if(!isset($_SESSION['loggedin'])){
        header('Location: /phpmotors/');
    }
    $clientInfo = $_SESSION['clientData'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors admin page">
    <title>Admin | PHP Motors</title>
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
        <section class="admin-view">
            <h1 id="user-name">Welcome back <?php echo $clientInfo['clientFirstname'] . ' ' . $clientInfo['clientLastname'] . '!' ?></h1>
            <?php if (isset($_SESSION['message'])) : ?>
                <p><?php echo $_SESSION['message']; ?></p>
            <?php endif; ?>
            <p>You are logged in.</p>
            <ul>
                <li>First Name: <?php echo $clientInfo['clientFirstname']; ?></li>
                <li>Last Name: <?php echo $clientInfo['clientLastname']; ?></li>
                <li>Email: <?php echo $clientInfo['clientEmail']; ?></li>
            </ul>

          </section>
          <section class="manag">
            <h2>Account Management</h2>
            <p>Use this link to update account information</p>
            <a id="man-link" href="../accounts/index.php?action=update">Update Account Information</a>
          </section>
          <section class="inventory">

            <?php if($clientInfo['clientLevel'] > 1) : ?>
              <h2>Inventory Management</h2>
              <p>Use this link to manage the inventory:</p>
              <a id="vehi-man" href="/phpmotors/vehicles/">Vehicle Managements</a>
              <?php endif; ?>
        </section>
        
      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>