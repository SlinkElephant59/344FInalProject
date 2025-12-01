<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="Login.css">
</head>

<body>
    <div class="login-container">
        <h2>Create Member Login</h2>

        <form id="SignUpForm" action="password.php" method="post">
            <div class="form-group">
                <label for="usrname"><b>Username:</b></label>
                <input type="text" id="usrname" name="usrname" required>
            </div>
            <div class="form-group">
                <label for="psw"><b>Password:</b></label>
                <input type="password" id="psw" name="psw">
            </div>
            <button type="submit">Create Account</button>
        </form>

        <a href="LibraryLoginPage.html" class="login-link">Already have an account? Log in here</a>
        <div id="errorMessage" class="error-message"></div>
    </div>
    <script src="login.js"></script>
</body>

</html>
