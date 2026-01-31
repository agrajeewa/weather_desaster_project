<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "dms");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$usrname = $_POST['user_name'];
$fname  = $_POST['fname'];
$lname  = $_POST['lname'];
$email = $_POST['email'];


// Prepare SQL
$stmt = $conn->prepare("INSERT INTO user(USRNAME, FNAME, LNAME, EMAIL, TP_NUMBER, ADDRESS ) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssis",$usrname, $fname, $lname, $email, $_POST["tp_num"], $_POST["address"]);

// Execute
if ($stmt->execute()) {
    echo "<script>alert('Account created successfully.');
    window.location.href = 'login.html';
    </script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "');</script>";
}

// Close
$stmt->close();
$conn->close();
?>