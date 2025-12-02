<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>

    <meta charset="UTF-8">
    <meta name="author" content="Shimin Li"> 

    <link rel="icon" type="image/png" href="/buddy.png">
    <link rel="stylesheet" href="Login.css">
</head>
<body>
<div class="main">
	<h1 class="center">Create UserName and Password</h1>

    <form action="LibraryLoginPage.php" method="POST">
        <label for="Usrname"><strong>Username:</strong></label><br>
        <input type="text" id="Usrname" name="Usrname" size="20" required><br><br>
        <label for="Password"><strong>Password:</strong></label><br>
        <textarea type="text" name="Psw" cols="2" rows="2"></textarea>
        <br>
        <div class="right">
        <button type="submit">Login</button>
        </div>
    </form>
</div>
</body>
</html>
