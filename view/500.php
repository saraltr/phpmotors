<?php
session_start();

if(isset($_SESSION['errorCode']) && isset($_SESSION['errorMessage'])) {
    $errorCode = $_SESSION['errorCode'];
    $errorMessage = "Sorry, our server seems to be experiencing some technical difficulties.<br>Cause: " . $_SESSION['errorMessage'];
} else {
    $errorMessage = "Sorry, our server seems to be experiencing some technical difficulties. Please check back later."; // default message
}

// Unset or clear the session variables after using them
unset($_SESSION['errorCode']);
unset($_SESSION['errorMessage']);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors server error">
    <title>Server Error | PHP Motors</title>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/large.css">
</head>
<body>
    <div id="wrapper">
      <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php" ?>
      </header>
      <nav>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/nav.php" ?>
      </nav>
      <main>
        <section class="errorMsg">
        <h1>Server Error</h1>
        <p><?php echo $errorMessage; ?></p>
        </section>
      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>