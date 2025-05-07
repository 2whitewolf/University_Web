<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 3: Arrays</title>
</head>
<body>
    <h1>Task 3: Arrays</h1>
    <?php
    $numbers = [];
    for ($i = 0; $i < 10; $i++) {
        $numbers[] = rand(1, 100);
    }
    echo "<pre>";
    print_r($numbers);
    echo "</pre>";
    ?>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>