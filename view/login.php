<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors template page">
    <title>Login Page | PHP Motors</title>
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
        <section class="loginPage">
          <h1>Welcome back!</h1>
          
          <?php
          if (isset($_SESSION['message'])) {
              echo $_SESSION['message'];
              unset($_SESSION['message']);
          }
          ?>

          <form id="loginForm" method="POST" action="/phpmotors/accounts/">
          <fieldset>
            <legend>Login</legend>
            <label for="clientEmail">Email:</label>
            <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required placeholder="Enter a valid email address" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}">

            <label for="clientPassword">Password:</label>
            <input name="clientPassword" id="clientPassword" type="password" minlength="8" pattern="^(?=.*\d)(?=.*\W)(?=.*[A-Z])(?=.*[a-z]).{8,}$" required title="Min 8 characters, one digit, one uppercase, one lowercase, and one special character">

            <input type="submit" class="submit-button" value="login">
            <input type="hidden" name="action" value="login">
            
            <p>Not a member yet? <a href="/phpmotors/accounts/index.php?action=registration" title="Register with PHP Motors" id="register">Sign-up</a></p>
          </fieldset>
          </form>

        </section>
      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>