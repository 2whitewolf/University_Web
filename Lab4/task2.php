<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2: While</title>
</head>
<body>
    <h1>Task 2: While</h1>
    <?php
$a = 0;
$b = 0;
$i = 0;

while ($i <= 5) {
    $a += 10;
    $b += 5;
    echo "Step $i: a = $a, b = $b<br>";
    $i++;
}

echo "End of the loop: a = $a, b = $b";
?>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>