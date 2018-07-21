<?php include("top.html"); ?>
<?php $name = isset($_GET['name']) ? $_GET['name'] : "user";?>
<h2>Thank you!</h2>
Welcome to NerdLuv, <?= $name; ?><br/>
Now <a href="index.php">login to see your matches!</a>
<?php include("bottom.html"); ?>
