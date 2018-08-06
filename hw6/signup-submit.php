<?php

session_start();
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

    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO singles values (NULL, :name, :pass, :gender, :age, :type1, :type2,"
            . ":type3, :type4, :favorite_os, :age_min, :age_max)");
    $array_res = array(':name' => $name, ':pass' => $hash_pass, ':gender' => $gender, ':age' => $age,
        ':type1' => $personality_type[0], ':type2' => $personality_type[1], ':type3' => $personality_type[2],
        ':type4' => $personality_type[3], ':favorite_os' => $favorite_os, ':age_min' => $seeling_age_min,
        ':age_max' => $seeling_age_max);
    $stmt->execute($array_res);



    $stmt0 = $db->prepare("SELECT * FROM singles WHERE name=:name");
    $stmt0->execute(array(':name' => $name));
    $result = $stmt0->fetch(PDO::FETCH_ASSOC);
    $_SESSION['username'] = $name;
    $_SESSION["user_data"] = $result;

    $stmt1 = $db->prepare("SELECT * FROM singles WHERE gender !=:gender "
            . "AND os =:os "
            . "AND age between :min AND :max "
            . "AND max>=:age "
            . "AND min<=:age "
            . "AND (type1=:type1 || type2=:type2 || type3=:type3 || type4=:type4)"
    );
    $stmt1->execute(array(':gender' => $result['gender'], ':os' => $result['os'],
        ':max' => $result['max'], ':min' => $result['min'],
        ':age' => $result['age'], ':type1' => $result['type1'],
        ':type2' => $result['type2'], ':type3' => $result['type3'],
        ':type4' => $result['type4']));
    $match_data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["matches"] = $match_data;
    header("Location: signup-success.php?name=$name");
}
?>