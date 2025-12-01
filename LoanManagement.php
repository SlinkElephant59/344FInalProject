<?php
require_once 'db.php';

// Handle return
if (isset($_GET['return'])) {
    $pdo->prepare("
        UPDATE Loan 
        SET return_date = CURDATE(), status = 'returned' 
        WHERE loan_id = ?
    ")->execute([$_GET['return']]);
    
    // Update copy status
    $pdo->prepare("
        UPDATE Copy 
        SET status = 'available' 
        WHERE copy_id = (SELECT copy_id FROM Loan WHERE loan_id = ?)
    ")->execute([$_GET['return']]);
    
    header("Location: loans.php");
    exit;
}

// Fetch active/late loans
$loans = $pdo->query("
    SELECT l.*, 
           b.title, 
           CONCAT(m.first_name, ' ', m.last_name) AS member_name,
           loc.name AS location_name
    FROM Loan l
    JOIN Copy cp ON l.copy_id = cp.copy_id
    JOIN Book b ON cp.book_id = b.book_id
    JOIN Members m ON l.member_id = m.member_id
    JOIN Location loc ON cp.location_id = loc.location_id
    WHERE l.status IN ('active', 'late')
    ORDER BY l.checkout_date DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loans</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📅 Active Loans</h1>
        <nav>
            <a href="index.php">Dashboard</a>
            <a href="books.php">Books</a>
            <a href="members.php">Members</a>
        </nav>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Book</th>
                    <th>Member</th>
                    <th>Location</th>
                    <th>Checked Out</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loans as $l): ?>
                <tr>
                    <td><?php echo $l['loan_id']; ?></td>
                    <td><?php echo htmlspecialchars($l['title']); ?></td>
                    <td><?php echo htmlspecialchars($l['member_name']); ?></td>
                    <td><?php echo htmlspecialchars($l['location_name']); ?></td>
                    <td><?php echo $l['checkout_date']; ?></td>
                    <td><?php echo ucfirst($l['status']); ?></td>
                    <td>
                        <a href="?return=<?php echo $l['loan_id']; ?>">↩️ Return</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>