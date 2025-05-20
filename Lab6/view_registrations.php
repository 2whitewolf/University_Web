<?php
// view_registrations.php - View event registrations
session_start();
require 'db_connect.php';
$conn = getDBConnection();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'manager') {
    header("Location: index.php");
    exit;
}

$event_id = $_GET['event_id'];
$registrations = $conn->query("SELECT u.username, u.email FROM event_records er JOIN users u ON er.user_id = u.id WHERE er.event_id = $event_id");
$event = $conn->query("SELECT name FROM events WHERE id = $event_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Registrations</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Registrations for <?php echo htmlspecialchars($event['name']); ?></h1>
        <div class="bg-white p-4 rounded shadow">
            <?php while ($user = $registrations->fetch_assoc()): ?>
                <div class="border-b py-2">
                    <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
                    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            <?php endwhile; ?>
            <a href="admin.php" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Back to Admin Panel</a>
        </div>
    </div>
</body>
</html>