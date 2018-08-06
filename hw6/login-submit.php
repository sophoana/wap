<?php

session_start();
if ($_POST) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    include 'db-connection.php';

    $user_data;
    $match_data;

    $stmt = $db->prepare("SELECT * FROM singles WHERE name=:name");
    $stmt->execute(array(':name' => $name));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $hash_pass = hash("sha256", $password . $name); 

    // if (strcmp($hash_pass, $result['pass']) == 0) {
    //     $user_data = $result;
    // }

    if (password_verify($password, $result['pass'])) {
        $user_data = $result;
        $_SESSION["username"] = $result['name'];
        $_SESSION["user_data"] = $result;
    }

    if (empty($user_data)) {
        $_SESSION['error'] = "Invalid username or password";
        header('Location: login.php');
        exit();
    }

    $stmt1 = $db->prepare("SELECT * FROM singles WHERE gender !=:gender "
        . "AND os =:os "
        . "AND age between :min AND :max "
        . "AND max>=:age "
        . "AND min<=:age "
        . "AND (type1=:type1 || type2=:type2 || type3=:type3 || type4=:type4)");
    $stmt1->execute(array(
        ':gender' => $user_data['gender'], ':os' => $user_data['os'],
        ':max' => $user_data['max'], ':min' => $user_data['min'],
        ':age' => $user_data['age'], ':type1' => $user_data['type1'],
        ':type2' => $user_data['type2'], ':type3' => $user_data['type3'],
        ':type4' => $user_data['type4']
    ));
    $match_data = $stmt1->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION["matches"] = $match_data;
    header('Location: view-match.php?match=0');
}
?>