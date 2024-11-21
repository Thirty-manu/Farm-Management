<?php
session_start();
require_once 'connect.php';

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Don't escape passwords

    // Check if the email exists
    $sql = "SELECT * FROM members WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id']; // Store user ID in session for future use
            header("Location: bookings.php"); // Redirect to the booking page
            exit();
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "Invalid email or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <!-- Display error message if login fails -->
        <?php if (!empty($message)): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="register.php">Don't have an account? Register</a>
        <a href= "admin.php">Admin login</a>
    </div>
</body>
</html>
