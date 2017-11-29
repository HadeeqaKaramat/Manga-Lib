<?php

$dsn = 'mysql:dbname=projet;host=127.0.0.1';
$user = 'redacteur';
$password = 'helb';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

include_once 'mangaServices.php';

$mangaService = new MangaServices($dbh);

?>
