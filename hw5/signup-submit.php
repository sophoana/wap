<?php

if ($_POST) {

    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $gender = trim($_POST['gender']);
    $age = trim($_POST['age']);
    $personality_type = trim($_POST['personality_type']);
    $favorite_os = trim($_POST['favorite_os']);
    $seeling_age_max = trim($_POST['max']);
    $seeling_age_min = trim($_POST['min']);

    include("db-connection.php");

    // $hash_pass = hash("sha256", $password . $name); 
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO singles values (NULL, :name, :pass, :gender, :age, :type1, :type2,"
        . ":type3, :type4, :favorite_os, :age_min, :age_max)");

    $stmt->execute(array(
        ':name' => $name, ':pass' => $hash_pass, ':gender' => $gender, ':age' => $age,
        ':type1' => $personality_type[0], ':type2' => $personality_type[1], ':type3' => $personality_type[2],
        ':type4' => $personality_type[3], ':favorite_os' => $favorite_os, ':age_min' => $seeling_age_min,
        ':age_max' => $seeling_age_max
    ));

    header("Location: signup-success.php?name=$name");
}
