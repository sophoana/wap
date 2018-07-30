<?php 
$dsn = 'mysql:dbname=nerdluv;host=localhost';
$user = 'match-maker';
$password = 'meant2B';
// singles.sql user: match-maker pass: meant2B

try {
     $db = new PDO($dsn, $user, $password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    printf("Connection Failed: ". $ex->getMessage());
    exit();
}
?> 