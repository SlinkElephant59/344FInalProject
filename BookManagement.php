<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

require_once 'db.php';

// Handle book deletion
if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM Book WHERE book_id = ?")->execute([$_GET['delete']]);
    header("Location: BookManagement.php");
    exit;
}

// Fetch books with categories/genres
$stmt = $pdo->query("
    SELECT b.*, 
           GROUP_CONCAT(DISTINCT c.name) AS categories,
           GROUP_CONCAT(DISTINCT g.name) AS genres
    FROM Book b
    LEFT JOIN Book_Category bc ON b.book_id = bc.book_id
    LEFT JOIN Category c ON bc.category_id = c.category_id
    LEFT JOIN Book_Genre bg ON b.book_id = bg.book_id
    LEFT JOIN Genre g ON bg.genre_id = g.genre_id
    GROUP BY b.book_id
    ORDER BY b.title
");
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books</title>
    <link rel="stylesheet" href="library.css">
</head>
<body>
    <header>
        <h1> Books</h1>
        <nav>
            <a href="landingPage.php">Dashboard</a>
            <a href="MemberManagement.php">Members</a>
            <a href="loanManagement.php">Loans</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Categories</th>
                    <th>Genres</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['book_id']); ?></td>
                    <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                    <td><?php echo $book['categories'] ?: '—'; ?></td>
                    <td><?php echo $book['genres'] ?: '—'; ?></td>
                    <td>
                        <a href="?delete=<?php echo $book['book_id']; ?>" 
                           onclick="return confirm('Delete this book?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

