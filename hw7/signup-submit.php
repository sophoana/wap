<?php

session_start();
if ($_POST) {

    // Read Post Information
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $gender = trim($_POST['gender']);
    $age = trim($_POST['age']);
    $personality_type = trim($_POST['personality_type']);
    $favorite_os = trim($_POST['favorite_os']);
    $seeling_age_max = trim($_POST['max']);
    $seeling_age_min = trim($_POST['min']);

    // Validation Pattern
    
    $name_pattern = "/^[a-zA-Z_]{2,}/";
    $password_pattern = "/.{6,}/";
    $age_pattern = "/^[1-9]\d{0,1}/";
    $personality_type_pattern = "/^[IE][NS][FT][JP]$/i";

    $isValid = true;

    if ( !$name || !preg_match($name_pattern, $name)) {
        $_SESSION["validation_error"] = "Name should be at least two words.";
        $isValid = false;
    }
    else if (!$password || preg_match($password_pattern, $password)){
        $_SESSION["validation_error"] = "Password should be at least 6 characters.";
        $isValid = false;
    }

    else if( !$age || preg_match($age_pattern, $age) || 
        !$seeling_age_min || preg_match($age_pattern, $seeling_age_min) || 
        !$seeling_age_max || preg_match($age_pattern, $seeling_age_max)
    ){
        $_SESSION["validation_error"] = "Age should be between 0 and 100";
        $isValid = false;
    }

    else if (!$personality_type || preg_match($personality_type_pattern, $personality_type)){
        $_SESSION["validation_error"] = "Personality type didnt match.";
        $isValid = false;
    }

    if(!$isValid){
        
        // Set Paramter for form

        $_SESSION["name"] = $name;
        $_SESSION["age"] = $age;
        $_SESSION["gender"] = $gender;
        $_SESSION["password"] = $password;
        $_SESSION["personality_type"] = $personality_type;
        $_SESSION["favorite_os"] = $favorite_os;
        $_SESSION["age_min"] = $seeling_age_min;
        $_SESSION["age_max"] = $seeling_age_max;

        header("Location: signup.php");
    }

    include("db-connection.php");

    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO singles values (NULL, :name, :pass, :gender, :age, :type1, :type2,"
        . ":type3, :type4, :favorite_os, :age_min, :age_max)");
    $array_res = array(
        ':name' => $name, ':pass' => $hash_pass, ':gender' => $gender, ':age' => $age,
        ':type1' => $personality_type[0], ':type2' => $personality_type[1], ':type3' => $personality_type[2],
        ':type4' => $personality_type[3], ':favorite_os' => $favorite_os, ':age_min' => $seeling_age_min,
        ':age_max' => $seeling_age_max
    );
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
        . "AND (type1=:type1 || type2=:type2 || type3=:type3 || type4=:type4)");
    $stmt1->execute(array(
        ':gender' => $result['gender'], ':os' => $result['os'],
        ':max' => $result['max'], ':min' => $result['min'],
        ':age' => $result['age'], ':type1' => $result['type1'],
        ':type2' => $result['type2'], ':type3' => $result['type3'],
        ':type4' => $result['type4']
    ));
    $match_data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["matches"] = $match_data;
    header("Location: signup-success.php?name=$name");
}
?>