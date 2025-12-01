<html>

<head>
  <meta charset="UTF-8">
  <title>User Authentication</title>

</head>

<body>
  <?php
  // Enable errors for debugging (remove in production)
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // Get form data
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validate input
if (empty($username) || empty($password)) {
    die('<h1 class="center">Error: Both fields are required.</h1>');
}

  // Connect to database
  $db = new mysqli("localhost", "CS344", "CS344F25", "CS344F25");

  // Check connection
  if ($db->connect_errno) {
    die('Database connection failed: ' . $db->connect_error);
  }

  // Prepare SQL to prevent injection (basic version using escaping for simplicity)
  $username = $db->real_escape_string($username);

  // Fetch user from database
   $sql = "SELECT username, password FROM Over9000 where ".
         "username='".$_POST["user"]."';";

  if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Verify password (assuming passwords are stored with password_hash())
    if (password_verify($password, $hashed_password)) {
      echo "<h2>Login successful!</h2>";
      echo "<p>Welcome, " . htmlspecialchars($username) . "!</p>";
    } else {
      echo "<h2>Login failed!</h2>";
      echo "<p>Invalid password.</p>";
    }
  } else {
    echo "<h2>Login failed!</h2>";
    echo "<p>Username not found.</p>";
  }

  $db->close();
  ?>
</body>

</html>