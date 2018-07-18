<!-- 
    Sophoana Pan 
    986075
    WAP - Homework 3 
-->

<?php 
$movie = $_GET["film"];
$info_path = $movie . '/info.txt';
$review_path = $movie . '/review*.txt';
$overview_path = $movie . '/overview.txt';

$overview_png = $movie . '/overview.png';
$info_lines = file($info_path);
$overview_lines = file($overview_path);
?> 
<!DOCTYPE html>
<html>
<head>
    <title><?= $info_lines[0] ?></title>
    <meta charset="utf-8" />
    <link href="movie.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="wrapper">
            <img src="img/banner.png" alt="Banner" />
            <h2><?= $info_lines[0] . " " . $info_lines[1] ?></h2>
  
        </div>
    </header>
    <div class="wrapper roundborder">
        <section>
            <div class="head">
                <img src="img/rottenbig.png" alt="rottenbig" />
                <h1> <?= $info_lines[2] ?>%</h1>
            </div>
            <ul class="review">
            <?php
            $review_files = glob($review_path);
            foreach ($review_files as $key => $value) {
                $lines = file($value);
                $img_line = strtolower($lines[1]) . ".gif";
                ?>
                    <li>
                    <p>
                        <img src="img/<?=$img_line?>" alt="fresh" /> 
                        <?= $lines[0] ?>
                    </p>
                    <div>
                        <img src="img/critic.gif" alt="critic" />
                        <span>
                            <?= $lines[2] ?>
                            <br/> <?= $lines[3] ?>
                        </span>
                    </div>
                </li>
                <?php

            }
            ?>
            </ul>
        </section>

        <aside>
            <img src="<?= $overview_png ?>" alt="overview" />
            <ul class="list">

                <?php 
                foreach ($overview_lines as $key => $value) {
                    ?>
                    <li>
                    
                <?php $items = explode(":", $value);
                echo trim($items[0]);
                ?>  
                    <ul>
                       <li>
                            <?php echo trim($items[1]); ?>
                       </li>
                    </ul>
                </li>
             <?php 
        } ?>
            </ul>
        </aside>
        <div class="clear"></div>

        <footer>
            <p>1-10 of 88</p>
        </footer>

    </div>
    <div class="validator">
        <a href="http://validator.w3.org/check/referer">
            <img src="http://mumstudents.org/cs472/2013-09/images/w3c-html.png" alt="html validator">
        </a> 
    <p></p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" />
        </a>
    </div>
</body>

</html>