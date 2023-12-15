<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors home page">
    <title>Home | PHP Motors</title>
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
        <section class="hero">
          <h1>Welcome to PHP Motors!</h1>
          <div class="heroContainer">
            <h2>DMC Delorean</h2>
            <p>3 Cup holders<br>Superman doors<br>Fuzzy dice!</p>
            <img class="deloranHero" src="/phpmotors/images/vehicles/1982-dmc-delorean.jpg" alt="delorean image hero">
            <a class="heroBtn" href="#">
                <img src="/phpmotors/images/site/own_today.png" alt="own today button">
            </a>
          </div>
        </section>

        <section class="reviews">
          <h2>DMC Delorean Reviews</h2>
          <ul>
            <li>"So fast its almost like traveling in time." (4/5)</li>
            <li>"Coolest ride on the road." (4/5)</li>
            <li>"I'm feeling Marty McFly!" (5/5)</li>
            <li>"The most futuristic ride of our day." (4.5/5)</li>
            <li>"80's livin and I love it!" (5/5)</li>
          </ul>
        </section>

        <section class="upgrades">
          <h2>Delorean Upgrades</h2>
          <ul class="upgrades-list">
              <li>
                  <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
                  <a href="#">Flux Capacitor</a>
              </li>
              <li>
                  <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decals">
                  <a href="#">Flame Decals</a>
              </li>
              <li>
                  <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                  <a href="#">Bumper Stickers</a>
              </li>
              <li>
                  <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps">
                  <a href="#">Hub Caps</a>
              </li>
          </ul>
      </section>


      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>