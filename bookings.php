<?php
session_start();
require_once 'connect.php';

$message = ''; // Initialize message variable

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $visit_date = $conn->real_escape_string($_POST['visit_date']);
    $member_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Insert booking into the database
    $sql = "INSERT INTO booked_visits (member_id, visit_date, visitor_name, phone) VALUES ('$member_id', '$visit_date', '$name', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $message = "Booking successful! Thank you for booking your visit.";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Visit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="booking-container">
        <h2>Book a Visit</h2>

        <!-- Display success or error message -->
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Booking Form -->
        <form action="bookings.php" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

            <label for="visit-date">Choose a Date:</label>
            <input type="date" id="visit-date" name="visit_date" required>

            <button type="submit">Book Visit</button>
        </form>
        <a href="feedback.php">Want to submit Feedback? Submit</a>
    </div>
</body>
</html>
