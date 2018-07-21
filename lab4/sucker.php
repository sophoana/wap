<!DOCTYPE html>
<html>
	<head>
		<title>Thanks, Sucker!</title>
		<link href="buyagrade.css" type="text/css" rel="stylesheet" />
	</head>
<?php 

$name = isset($_POST["name"]) && !empty($_POST["name"]) ? $_POST["name"] : '-';
$section = $_POST["section"];
$cardnumber = $_POST["cardnumber"];
$cardtype = $_POST["cardtype"];



// Save Data to suckers.txt
$file = file_get_contents('suckers.txt', true);

$valid = ($name != "") && ($section != "") && ($cardnumber != "") && ($cardtype != "");

if ($valid == true) {
    $file .= $name . ";" . $section . ";" . $cardnumber . ";" . $cardtype . "\n";

    // Valid Card
    $input = @$_POST['cardnumber'];
    $i = 2;
    $sum = 0;
    $split = str_split($input);
    foreach ($split as $digit) {
        if ($i % 2 == 0) {
            $digit = $digit * 2;
        }
        if ($digit > 9) {
            $digit = $digit - 9;
        }
        $i++;
        $sum += $digit;
    }

    if ($sum % 10 != 0) {
        header('Location: sorry.php');
    }

    file_put_contents('suckers.txt', $file);
} else {
    // redirect to Sorry.html
    header('Location: sorry.php');
}
?>
	<body>
		<h1>Thanks, Sucker!</h1>
		<p>
			Your information has been recorded.
		</p>
		<dl>
			<dt>Name</dt>
			<dd><?= $name ?></dd>
			
			<dt>Section</dt>
			<dd><?= $section ?></dd>
			
			<dt>Credit Card</dt>
			<dd><?= $cardnumber ?> (<?= $cardtype ?>)</dd>
        </dl>
        
        <div>
            <p>Here are all the suckers who have submiited here:</p>
            <p>
                <?php echo nl2br($file) ?>
            </p>
        </div>
	</body>
</html>