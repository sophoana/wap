<?php include("top.html"); ?>
<?php $name = isset($_GET['name']) ? $_GET['name'] : "user"; ?>
<h2>Thank you!</h2>
Welcome to NerdLuv, <?= $name; ?><br/>
<a href="view-match.php?match=0">Now continue on to see your matches!</a>
<?php include("bottom.html"); ?>
