<?php

if ($_POST) {
    $name = trim($_POST['name']);
    $gender = trim($_POST['gender']);
    $age = trim($_POST['age']);
    $personality_type = trim($_POST['personality_type']);
    $favorite_os = trim($_POST['favorite_os']);
    $seeling_age_max = trim($_POST['max']);
    $seeling_age_min = trim($_POST['min']);
    $data = "$name,$gender,$age,$personality_type,$favorite_os,$seeling_age_min,$seeling_age_max\n";
    file_put_contents("singles.txt", $data, FILE_APPEND);
    header("Location: signup-success.php?name=$name");
}
