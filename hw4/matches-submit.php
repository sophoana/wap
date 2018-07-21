<?php
if ($_GET) {
    $name = trim($_GET['name']);
    $file = file("singles.txt");

    @$user_data;
    @$match_data;

    foreach ($file as $datas) {
        $data = explode(",", $datas);
        if ($data[0] == $name) {
            $user_data = $data;
            break;
        }
    }
    if (empty($user_data)) {
        echo "<h2>Please sign up to find match!</h2>";
        exit(0);
    }
    foreach ($file as $datas) {
        $data = explode(",", $datas);
        if ($data[1] != $user_data[1] &&
            $data[4] == $user_data[4] &&
            $user_data[2] >= $data[5] &&
            $user_data[2] <= $data[6] &&
            $data[2] >= $user_data[5] &&
            $data[2] <= $user_data[6] &&
            checkPersonality($user_data[3], $data[3])) {

            $match_data = $data;
            break;
        }
    }
}

function checkPersonality($user, $match)
{
    $count = 0;
    for ($i = 0; $i < sizeof($user); $i++) {
        if ($user[$i] == $match[$i]) {
            $count++;
        }
    }
    if ($count >= 1) {
        return true;
    }
    return false;
}
?>
<?php include("top.html"); ?>
<!-- your HTML output follows -->

<?php if (!empty($user_data)) : ?>
    <h2>Matches for <?= $user_data[0]; ?></h2>
    <div class="match">
        <img src="images/user.jpg" alt="User Image" />
        <p><?= $user_data[0] ?></p>
        <ul>
            <li><label>Gender:</label><?= $user_data[1] == 'M' ? 'Male' : 'Female' ?></li>
            <li><label>Age:</label><?= $user_data[2] ?></li>
            <li><label>Personality Type:</label><?= $user_data[3] ?></li>
            <li><label>Favorite OS:</label><?= $user_data[4] ?></li>
        </ul>
    </div>
    <?php if (!empty($match_data)) : ?>
        <div class="match">
            <img src="images/user.jpg" alt="User Image" />
            <p><?= $match_data[0] ?></p>
            <ul>
                <li><label>Gender:</label><?= $match_data[1] == 'M' ? 'Male' : 'Female' ?></li>
                <li><label>Age:</label><?= $match_data[2] ?></li>
                <li><label>Personality Type:</label><?= $match_data[3] ?></li>
                <li><label>Favorite OS:</label><?= $match_data[4] ?></li>
            </ul>
        </div>
    <?php else : ?>
        <h2>Sorry <?= $user_data[0]; ?>, your profile does not matches. please try again later!</h2>
    <?php endif; ?>
<?php endif; ?>
<?php include("bottom.html"); ?>