<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

require_once 'db.php';

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
    <link rel="stylesheet" href="library.css">
</head>
<body>
    <header>
        <h1> MEMBERS</h1>
        <nav>
            <a href="Landong.php">Dashboard</a>
            <a href="bOOKmANAGEMENT.php">Books</a>

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
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>
