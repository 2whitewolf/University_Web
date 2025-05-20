<?php
// index.php - Events listing page
session_start();
require 'db_connect.php';
$conn = getDBConnection();

$result = $conn->query("SELECT * FROM events WHERE date >= NOW() ORDER BY date");
?>

<!DOCTYPE html>
<html>
<head>
    <title>City Events</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="index.php">City Events</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div>
                    <a href="logout.php" class="mr-4">Logout</a>
                    <?php if ($_SESSION['role'] === 'manager'): ?>
                        <a href="admin.php">Admin Panel</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div>
                    <a href="login.php" class="mr-4">Login</a>
                    <a href="register.php">Register</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Upcoming Events</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php while ($event = $result->fetch_assoc()): ?>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($event['name']); ?></h2>
                    <p>Date: <?php echo $event['date']; ?></p>
                    <p>Price: $<?php echo $event['price']; ?></p>
                    <p>Seats Available: <?php echo $event['number_seats']; ?></p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="register_event.php?event_id=<?php echo $event['id']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block">Register</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

