<?php
require_once 'connect.php';

$message = ''; // Initialize message variable

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $visitor_name = $conn->real_escape_string($_POST['visitor_name']);
    $feedback = $conn->real_escape_string($_POST['feedback']);

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (visitor_name, feedback) VALUES ('$visitor_name', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you for your feedback!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="feedback-container">
        <h2>Leave Your Feedback</h2>

        <!-- Display success or error message -->
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Feedback Form -->
        <form action="feedback.php" method="POST">
            <input type="text" name="visitor_name" placeholder="Your Name" required>
            <textarea name="feedback" placeholder="Your Feedback" required></textarea>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
