<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 1: For Loop</title>
</head>
<body>
    <h1>Task 1: For Loop</h1>
    <?php
    $a = 0;
    $b = 0;
    for ($i = 0; $i <= 5; $i++) {
        $a += 10;
        $b += 5;
        echo "Step $i: a = $a, b = $b<br>";
    }
    echo "End of the loop: a = $a, b = $b";
    ?>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>