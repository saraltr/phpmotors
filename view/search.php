<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors search page">
    <title>Search | PHP Motors</title>
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
        <section class="search-section">
            <h1>Search</h1>
              <form action="/phpmotors/search" method="GET" id="search-form">
                <label for="search" class="hidden">What are you looking for ?</label>
                <input type="text" name="search" id="search" placeholder="Enter your research here" required pattern="[a-zA-Z0-9\s]+" <?php if (isset($search)) {
                    echo "value='$search'";
                } ?>>
                <input type="hidden" name="action" value="search">
                <button type="submit" class="submit-button" >Search</button>
              </form>
          </section>
          <section class="results">
              <?php if (isset($message)) : ?>
                  <div class="error-message">
                      <?php echo $message; ?>
                  </div>
              <?php else : ?>
                  <h2><?php if (isset($search)) {
                      echo $num;
                  } ?></h2>
                  <?php
                  if (isset($searchDisplay)) {
                      echo $searchDisplay;
                  }
                  if (isset($paginationBar)) {
                      echo $paginationBar;
                  }
                  ?>
              <?php endif; ?>
          </section>
      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html>