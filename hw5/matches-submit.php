<?php
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
    }

    if (empty($user_data)) {
        echo "<h2>Please sign up to find match!</h2>";
        exit(0);
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
}
?>
<?php include("top.html"); ?>
<!-- your HTML output follows -->

<?php if (!empty($user_data)) : ?>
    <h2>Matches for <?= $user_data['name']; ?></h2>
    <div class="match">
        <img src="images/user.jpg" alt="User Image" />
        <p><?= $user_data['name'] ?></p>
        <ul>
            <li><label>Gender:</label><?= $user_data['gender'] == 'M' ? 'Male' : 'Female' ?></li>
            <li><label>Age:</label><?= $user_data['age'] ?></li>
            <li><label>Personality Type:</label><?= $user_data['type1'] . $user_data['type2'] . $user_data['type3'] . $user_data['type4'] ?></li>
            <li><label>Favorite OS:</label><?= $user_data['os'] ?></li>
        </ul>
    </div>
    <?php if (!empty($match_data)) : ?>
        <div class="match">
            <img src="images/user.jpg" alt="User Image" />
            <p><?= $match_data['name'] ?></p>
            <ul>
                <li><label>Gender:</label><?= $match_data['gender'] == 'M' ? 'Male' : 'Female' ?></li>
                <li><label>Age:</label><?= $match_data['age'] ?></li>
                <li><label>Personality Type:</label><?= $match_data['type1'] . $match_data['type2'] . $match_data['type3'] . $match_data['type4'] ?></li>
                <li><label>Favorite OS:</label><?= $match_data['os'] ?></li>
            </ul>
        </div>
    <?php else : ?>
        <h2>Sorry <?= $user_data[0]; ?>, your profile does not matches. please try again later!</h2>
    <?php endif; ?>
<?php endif; ?>
<?php include("bottom.html"); ?>