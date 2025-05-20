<?php
// register_event.php - Event registration page
session_start();
require 'db_connect.php';
$conn = getDBConnection();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$event_id = $_GET['event_id'];
$event = $conn->query("SELECT * FROM events WHERE id = $event_id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO event_records (user_id, event_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $_SESSION['user_id'], $event_id);
    
    if ($stmt->execute()) {
        $conn->query("UPDATE events SET number_seats = number_seats - 1 WHERE id = $event_id");
        header("Location: index.php");
        exit;
    } else {
        $error = "Registration failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register for Event</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Register for <?php echo htmlspecialchars($event['name']); ?></h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="bg-white p-4 rounded shadow">
            <p>Date: <?php echo $event['date']; ?></p>
            <p>Price: $<?php echo $event['price']; ?></p>
            <p>Seats Available: <?php echo $event['number_seats']; ?></p>
            <form method="POST">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Confirm Registration</button>
            </form>
        </div>
    </div>
</body>
</html>
