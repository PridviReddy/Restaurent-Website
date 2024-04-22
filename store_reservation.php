<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $persons = mysqli_real_escape_string($conn, $_POST['person']);
    $reservation_date = mysqli_real_escape_string($conn, $_POST['reservation-date']);
    $reservation_time = mysqli_real_escape_string($conn, $_POST['time']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // SQL to insert data into the database
    $sql = "INSERT INTO reservations (name, phone, persons, reservation_date, reservation_time, message)
            VALUES ('$name', '$phone', '$persons', '$reservation_date', '$reservation_time', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation successfully created!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
