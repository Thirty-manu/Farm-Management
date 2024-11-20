<?php
require_once 'connect.php';

// Fetch all members
$membersQuery = "SELECT id, name, email FROM members";
$membersResult = $conn->query($membersQuery);

// Fetch all booked visits with member details
$bookingsQuery = "
    SELECT bv.id, m.name AS member_name, bv.visit_date, bv.created_at
    FROM booked_visits bv
    JOIN members m ON bv.member_id = m.id
    ORDER BY bv.created_at DESC";
$bookingsResult = $conn->query($bookingsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Admin Dashboard</h1>

        <!-- Members List -->
        <h2>Registered Members</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($membersResult->num_rows > 0): ?>
                    <?php while ($member = $membersResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No members found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Booked Visits -->
        <h2>Booked Visits</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Member Name</th>
                    <th>Visit Date</th>
                    <th>Booked At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($bookingsResult->num_rows > 0): ?>
                    <?php while ($booking = $bookingsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $booking['id']; ?></td>
                            <td><?php echo $booking['member_name']; ?></td>
                            <td><?php echo $booking['visit_date']; ?></td>
                            <td><?php echo $booking['created_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
