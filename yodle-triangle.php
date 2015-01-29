<?php
// http://www.yodlecareers.com/puzzles/triangle.html

$filename = isset ($_GET ["filename"]) ? $_GET ["filename"] : "yodle-triangle.txt";
$triangles = file_get_contents ($filename);
$triangles = trim ($triangles);
$triangles = str_replace (" ", ",", $triangles);
$triangles = explode (PHP_EOL, $triangles);

$sum = 0;
$remember = 0;

echo "<pre><h2>Numbers</h2>";

$pyramid = "<center style='width:3100px;'><h3>Pyramid</h3>";

foreach ($triangles as $key => $row) {
	$numbers = trim ($row, ",");
	$numbers = explode (",", $numbers);
	
	foreach ($numbers as $numbers_key => $numbers_value) {
		// EQUALIZE NUMBER WIDTH FOR PYRAMID
		if ($numbers_value < 100) {
			$numbers [$numbers_key] = "0" . $numbers [$numbers_key];
		}

		if ($numbers_value < 1000) {
			$numbers [$numbers_key] = "0" . $numbers [$numbers_key];
		}
	}
	
	$numbers = array_values ($numbers);
	
	if (count ($numbers) == 1) {
		$sum += $numbers [0];
		echo "ROW $key: + $sum" . PHP_EOL;
		$pyramid .= "<p><b>$sum</b></p>";
		
		continue;
	}
	
	$a = $numbers [$remember];
	$adjacent = $remember + 1;
	$b = $numbers [$adjacent];
	
	if ($a > $b) {
		$sum += $a;
		echo "ROW $key: + $a - $b ~ $sum" . PHP_EOL;
		
		$numbers [$remember] = "<b style='color:blue;text-decoration:underline;'>" . $numbers [$remember] . " ></b>";
	}
	else {
		$sum += $b;
		$remember ++;
		echo "ROW $key: + $b - $a ~ $sum" . PHP_EOL;
		
		$numbers [$adjacent] = "<b style='color:blue;text-decoration:underline;'>< " . $numbers [$adjacent] . "</b>";
	}
	
	$pyramid .= "<p style='width:100%;'>" . implode ("_", $numbers) . "</p>";
}

$pyramid .= "</center>";

echo $pyramid;

echo "<h1>SUM: $sum</h1>";
file_put_contents ("yodle-triangle-answer-" . time () . ".txt", $sum);
?>