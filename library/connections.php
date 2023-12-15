<?php
// proxy connection to the phpmotors DB
function phpmotorsConnect(){
    $envFile = __DIR__ . "../.env";
    $envVariables = parse_ini_file($envFile);
    $server = $envVariables['SERVER'];
    $dbname = $envVariables['DBNAME'];
    $username = $envVariables['USERNAME'];
    $password = $envVariables['PASSWORD'];
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try{
        $link = new PDO($dsn, $username, $password, $options);
        // if(is_object($link)){
        //     echo "Connected to the DB";
        // }
        return $link;
    } catch(PDOException $e){
        // echo "It didn't work, error: " . $e->getMessage();
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}
?>