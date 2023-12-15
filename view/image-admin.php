<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Image Management page">
    <title>Image Management | PHP Motors</title>
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
        <section class="imgMan">
        <h1>Image Management</h1>
            <p>Welcome to the image management page! <br>
            Select one of the options below:</p>
        </section>
        <section class="addNewImg">
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
            echo $message;
            } ?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <label for="invItem">Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <label>Is this the main image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
            <label>Upload Image:</label>
            <input type="file" name="file1">
            <input type="submit" class="regbtn" value="Upload">
            <input type="hidden" name="action" value="upload">
            </form>
            <hr>
        </section>
        <section class="allImg">
          <h2>Existing Images</h2>
          <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
          <?php
          if (isset($imageDisplay)) {
          echo $imageDisplay;
          } ?>
        </section>
      </main>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>