<?php
session_start();
if (isset($_SESSION['username'])) {
    include 'db-connection.php';
    $name = $_SESSION['username'];
    $user_data = $_SESSION['user_data'];
    $matches = $_SESSION["matches"];
    $size = sizeof($matches);
    $cur_match = isset($_GET['match']) ? $_GET['match'] : 0;
    if ($cur_match >= $size || $cur_match < 0) {
        $cur_match = 0;
    }
    $match_data = $matches[$cur_match];
    
    if (empty($user_data)) {
        echo "<h2>Please sign up to find match!</h2>";
        exit(0);
    }
} else {
    $_SESSION['error'] = "Please login first.";
    header("Location: login.php");
}
?>
<?php include("top.html"); ?>
<!-- your HTML output follows -->

<?php if (!empty($user_data)) : ?>
    <h2>Matches for <?= $user_data['name']; ?><a href="logout.php"> Logout</a></h2>
    
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
        <br/>
        <?php if ($cur_match > 0) : ?>
            <a href="view-match.php?match=<?= $cur_match - 1; ?>">Previous Match</a>
        <?php endif; ?>
        &nbsp;
        <?php if ($cur_match < $size - 1) : ?>
            <a href="view-match.php?match=<?= $cur_match + 1; ?>">Next Match</a>
        <?php endif; ?>
    <?php else : ?>
        <h2>Sorry <?= $user_data[0]; ?>, your profile does not matches. please try again later!</h2>
    <?php endif; ?>
<?php endif; ?>
<?php include("bottom.html"); ?>