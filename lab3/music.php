

<!DOCTYPE html>
<html>
	<!--
	Web Programming Step by Step
    Lab #3, PHP
    Name: Sophoana Pan - 986075
	-->

	<head>
		<title>Music Viewer</title>
		<meta charset="utf-8" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<h1>My Music Page</h1>
		
        <!-- Exercise 1: Number of Songs (Variables) -->
        <?php 
        $total_songs = 2430;
        $total_hours = 899;
        ?>
		<p>
			I love music.
			I have <?= $total_songs ?> total songs,
			which is over <?= $total_hours ?> hours of music!
		</p>

		<!-- Exercise 2: Top Music News (Loops) -->
		<!-- Exercise 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
        <?php
        $newsPage = 5;
        if (isset($_GET["newspages"]))
            $newsPage = $_GET["newspages"];

        echo "<ol>";
        for ($value = 1; $value <= $newsPage; $value++) {
            echo "
                    <li><a href='http://music.yahoo.com/news/archive/" . $value . ".html'>Page " . $value . "</a></li>
                ";
        }

        echo "</ol>";
        ?>
		</div>

		<!-- Exercise 4: Favorite Artists (Arrays) -->
		<!-- Exercise 5: Favorite Artists from a File (Files) -->
		<div class="section">

        <?php 
        echo "<h2>My Favorite Artists</h2>";
        echo "<ol>";
        $favorite = file("favorite.txt");
        foreach ($favorite as $key => $value) {
            echo "<li>" . $value . "</li>";
        }
        echo "</ol>";
        ?>
		</div>
		
		<!-- Exercise 6: Music (Multiple Files) -->
		<!-- Exercise 7: MP3 Formatting -->
		<div class="section">
            <h2>My Music and Playlists</h2>
            <ul id="musiclist">
<?php
$song_path = "songs/*.mp3";
$m3u_path = "songs/*m3u";

$mp3_songs = glob($song_path);
$m3u_list = glob($m3u_path);

foreach ($mp3_songs as $key => $value) {
    $file_size = intval(filesize($value) / 1024);
    echo '
    <li class="mp3item">
        <a href="' . $value . '">' . basename($value) . '</a> (' . $file_size . ' KB)
    </li>
    ';
}
?>

            </ul>
            
            <ul id="musiclist">

            <!-- Exercise 8: Playlists (Files) -->
				
<?php
foreach ($m3u_list as $key => $value) {
    echo ('<li class="playlistitem">' . basename($value) . ':
        <ul>');

    $playlist_songs_lines = file($value);
    foreach ($playlist_songs_lines as $playlist_song_line) {
        if (strpos($playlist_song_line, "#") === false)
            echo '<li>' . $playlist_song_line . '</li>';
    }
    echo ('</ul>');
}
?>

				</li>
			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://mumstudents.org/cs472/Labs/3/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://mumstudents.org/cs472/Labs/3/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>

