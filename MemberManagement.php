<?php
require_once 'db.php';

// Handle member deletion
if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM Members WHERE member_id = ?")->execute([$_GET['delete']]);
    header("Location: members.php");
    exit;
}

$members = $pdo->query("
    SELECT *, 
           CASE WHEN is_active THEN 'Active' ELSE 'Inactive' END AS status_text
    FROM Members 
    ORDER BY last_name, first_name
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Members</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>👥 Members</h1>
        <nav>
            <a href="index.php">Dashboard</a>
            <a href="books.php">Books</a>
            <a href="loans.php">Loans</a>
        </nav>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Join Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $m): ?>
                <tr>
                    <td><?php echo $m['member_id']; ?></td>
                    <td><?php echo htmlspecialchars($m['first_name'] . ' ' . $m['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($m['email']); ?></td>
                    <td><?php echo $m['join_date']; ?></td>
                    <td><?php echo $m['status_text']; ?></td>
                    <td>
                        <a href="?delete=<?php echo $m['member_id']; ?>" 
                           onclick="return confirm('Delete member?')">🗑️</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>