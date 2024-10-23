<?php
// Database connection
$host = 'localhost';
$dbname = 'reservation_system';
$username = 'root'; // Change this if your MySQL username is different
$password = ''; // Add your MySQL password here

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];

    // Prepare SQL query to insert the reservation
    $stmt = $conn->prepare("INSERT INTO reservations (name, email, reservation_date, reservation_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $reservation_date, $reservation_time);

    if ($stmt->execute()) {
        echo "Reservation successfully made!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
</head>
<body>
    <h2>Make a Reservation</h2>
    <form method="POST" action="reservation.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="reservation_date">Reservation Date:</label>
        <input type="date" name="reservation_date" required><br><br>

        <label for="reservation_time">Reservation Time:</label>
        <input type="time" name="reservation_time" required><br><br>

        <input type="submit" value="Submit Reservation">
    </form>
</body>
</html>
