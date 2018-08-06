<?php 
$dsn = 'mysql:dbname=nerdluv;host=localhost';
$user = 'root';
$password = 'F@n27#$fkgPc$tn9';

print_r("Testing hash !!!");

$hash_pass = hash("sha256", "chlanghello"); 
print_r($hash_pass);
print_r("<br>");
print_r(hash("sha256", "Hellochlang"));


print_r("<br>");
print_r(hash("sha256", "hellochlang"));

print_r("<br>");
print_r(password_hash("sha256", PASSWORD_DEFAULT));


echo("<br>----");

try {
     $db = new PDO($dsn, $user, $password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $ex) {
    printf("Connection Failed: ". $ex->getMessage());
    exit();
}
?> 