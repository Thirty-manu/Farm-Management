<?php
session_start();
require_once 'connect.php';

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Don't escape passwords

    // Check credentials in the database
    $sql = "SELECT * FROM admin WHERE BINARY username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: admindashboard.php");
            exit();
        } else {
            $message = "Invalid username or password.";
        }
    } else {
        $message = "Invalid username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>

        <!-- Display error message if login fails -->
        <?php if (!empty($message)): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="admin.php" method="POST" onsubmit="return validateAdmin()">
            <input type="text" id="admin-username" name="username" placeholder="Admin Username" required>
            <input type="password" id="admin-password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <script>
        // Client-side validation
        function validateAdmin() {
            const username = document.getElementById("admin-username").value.trim();
            const password = document.getElementById("admin-password").value.trim();

            if (username === "" || password === "") {
                alert("Please fill in all fields.");
                return false;
            }
            return true; // Allow submission for server-side validation
        }
    </script>
</body>
</html>
