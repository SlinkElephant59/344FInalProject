<?php
require_once 'db.php';

$locations = $pdo->query("SELECT * FROM Location ORDER BY name")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Locations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📍 Locations</h1>
        <nav>
            <a href="index.php">Dashboard</a>
            <a href="books.php">Books</a>
            <a href="members.php">Members</a>
            <a href="loans.php">Loans</a>
        </nav>
    </header>
    <main>
        <div class="locations-grid">
            <?php foreach ($locations as $loc): ?>
            <div class="location-card">
                <h3><?php echo htmlspecialchars($loc['name']); ?></h3>
                <p>📍 <?php echo htmlspecialchars($loc['address']); ?></p>
                <p>🕒 <?php echo htmlspecialchars($loc['hours']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>