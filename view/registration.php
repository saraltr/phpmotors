<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors template page">
    <title>Registration Page| PHP Motors</title>
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
        <section class="registrationPage">
          <h1>Registration</h1>

          <?php
            if(isset($message)) {
              echo $message;
            }
          ?>
          <form id="registrationForm" method="POST" action="/phpmotors/accounts/index.php">
          <fieldset>
            <legend>Register Here</legend>
            <label for="clientFirstname">First Name:</label>
            <input name="clientFirstname" id="clientFirstname" type="text" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
            
            <label for="clientLastname">Last Name:</label>
            <input name="clientLastname" id="clientLastname" type="text" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
            
            <label for="clientEmail">Email:</label>
            <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required placeholder="Enter a valid email address" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}">
            
            <label for="clientPassword">Password:</label>
            <input name="clientPassword" id="clientPassword" type="password" minlength="8" pattern="^(?=.*\d)(?=.*\W)(?=.*[A-Z])(?=.*[a-z]).{8,}$" required>

            <ul class="requirement-list">
                <li class="requirement">Password should have 8 characters or more</li>
                <li class="requirement">Contain at least 1 number</li>
                <li class="requirement">Contain at least 1 special character</li>
                <li class="requirement">Contain at least 1 capital letter</li>
            </ul>
            
            <input type="submit" class="submit-button" id="regBtn" value="Sign Up">

            <input type="hidden" name="action" value="register">
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