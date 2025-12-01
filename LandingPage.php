<!-- 
// require_once 'db.php';
// Fetch stats
// $books = $pdo->query("SELECT COUNT(*) FROM Book")->fetchColumn();
// $members = $pdo->query("SELECT COUNT(*) FROM Members")->fetchColumn();
// $loans = $pdo->query("SELECT COUNT(*) FROM Loan WHERE status = 'active'")->fetchColumn();
// $locations = $pdo->query("SELECT COUNT(*) FROM Location")->fetchColumn();
// ?>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Dashboard</title>
    <link rel="stylesheet" href="libraryPage.css">
</head>
<body>
    <header>
        <h1>📚 Library Management System</h1>
        <nav>
            <a href="books.php">Books</a>
            <a href="members.php">Members</a>
            <a href="loans.php">Loans</a>
            <a href="locations.php">Locations</a>
        </nav>
    </header>
    <main>
        <div class="stats">
            <div class="stat-card">📚 Books: <?php echo $books; ?></div>
            <div class="stat-card">👥 Members: <?php echo $members; ?></div>
            <div class="stat-card">📅 Active Loans: <?php echo $loans; ?></div>
            <div class="stat-card">📍 Locations: <?php echo $locations; ?></div>
        </div>
    </main>
</body>
</html>