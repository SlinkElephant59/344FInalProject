<?php
session_start();
// If not logged in, send back to login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}
//Connect to the library database
require_once 'DataBaseSQL.php';

// Fetch stats
$books = $pdo->query("SELECT COUNT(*) FROM Book")->fetchColumn();
$members = $pdo->query("SELECT COUNT(*) FROM Members")->fetchColumn();
$loans = $pdo->query("SELECT COUNT(*) FROM Loan WHERE status = 'active'")->fetchColumn();
$locations = $pdo->query("SELECT COUNT(*) FROM Location")->fetchColumn();

// Fetch up to 8 available books (with at least one 'available' copy)
$availableBooks = $pdo->query("
    SELECT DISTINCT b.title, b.author, b.book_id
    FROM Book b
    INNER JOIN Copy c ON b.book_id = c.book_id
    WHERE c.status = 'available'
    LIMIT 20
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
    <link rel="stylesheet" href="library.css">
</head>
<body>
    <header>
        <h1> Library Management System</h1>
        <nav>
            <a href="BookManagement.php">Books</a>
            <a href="MemberManagement.php">Members</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <!-- Available Books Section -->
        <section class="content">
            <h2>Available Books</h2>
            <div class="book-list">
                <?php if (!empty($availableBooks)): ?>
                    <?php foreach ($availableBooks as $book): ?>
                        <div class="book-card">
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="author">by <?php echo htmlspecialchars($book['author']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No books currently available.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>

