<?php
// admin.php - Admin panel
session_start();
require 'db_connect.php';
$conn = getDBConnection();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'manager') {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_event'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $seats = $_POST['seats'];
    $date = $_POST['date'];
    
    $stmt = $conn->prepare("INSERT INTO events (name, price, number_seats, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdis", $name, $price, $seats, $date);
    $stmt->execute();
}

$events = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Admin Panel</h1>
        
        <h2 class="text-xl font-semibold mb-2">Add New Event</h2>
        <form method="POST" class="bg-white p-4 rounded shadow mb-8">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Event Name</label>
                <input type="text" name="name" required class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Price</label>
                <input type="number" name="price" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Number of Seats</label>
                <input type="number" name="seats" required class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Date and Time</label>
                <input type="datetime-local" name="date" required class="w-full p-2 border rounded">
            </div>
            <button type="submit" name="add_event" class="bg-blue-500 text-white px-4 py-2 rounded">Add Event</button>
        </form>

        <h2 class="text-xl font-semibold mb-2">Events</h2>
        <div class="bg-white p-4 rounded shadow">
            <?php while ($event = $events->fetch_assoc()): ?>
                <div class="border-b py-2">
                    <h3 class="font-semibold"><?php echo htmlspecialchars($event['name']); ?></h3>
                    <p>Date: <?php echo $event['date']; ?></p>
                    <p>Price: $<?php echo $event['price']; ?></p>
                    <p>Seats: <?php echo $event['number_seats']; ?></p>
                    <a href="view_registrations.php?event_id=<?php echo $event['id']; ?>" class="text-blue-500">View Registrations</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
