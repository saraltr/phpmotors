<?php
// proxy connection to the phpmotors DB
function phpmotorsConnect(){
    $server = getenv('DB_SERVER');
    $dbname = getenv('DB_NAME');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');

    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        $_SESSION['errorCode'] = $e->getCode();
        $_SESSION['errorMessage'] = "Connection failed: " . $e->getMessage();

        // redirect to the error page with the error in the URL
        header('Location: /phpmotors/view/500.php?error=' . urlencode($_SESSION['errorCode']));
        exit;
    }
}
?>