<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        header { background: #333; color: white; padding: 1em; text-align: center; }
        nav { background: #444; padding: 1em; }
        nav a { color: white; margin: 0 1em; text-decoration: none; }
        .gallery { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px; padding: 20px; }
        .gallery img { width: 100%; height: auto; }
        footer { background: #333; color: white; text-align: center; padding: 1em; position: fixed; bottom: 0; width: 100%; }
    </style>
</head>
<body>
    <header>
        <h1>Image Gallery</h1>
    </header>
    <nav>
        <a href="#">Home</a>
        <a href="#">Gallery</a>
        <a href="#">About</a>
    </nav>
    <div class="gallery">
        <?php
        $dir = 'image/';
        $files = scandir($dir);

        if ($files !== false) {
            foreach ($files as $file) {
                if ($file != "." && $file != ".." && pathinfo($file, PATHINFO_EXTENSION) === 'jpg') {
                    $path = $dir . $file;
                    echo "<img src='$path' alt='Gallery Image'>";
                }
            }
        }
        ?>
    </div>
    <footer>
        <p>&copy; 2025 Image Gallery</p>
    </footer>
</body>
</html>