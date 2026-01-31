<?php
session_start(); // Start a session to store user data across pages
$conn = new mysqli("localhost", "root", "", "dms"); // Connect to database 'dms'

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['name'];
// 1. First, check the Admin table
$sql_admin = "SELECT * FROM ADMN WHERE usrname = '$uname'";
$res_admin = $conn->query($sql_admin);

if ($res_admin->num_rows > 0) {
    // It's an admin!
    $_SESSION['uname'] = $uname;
    $_SESSION['role'] = 'admin';
    header("Location: ../admin/admin.html");
    exit();
} 

// 2. If not an admin, check the User table
$sql_user = "SELECT * FROM user WHERE USRNAME = '$uname'";
$res_user = $conn->query($sql_user);

if ($res_user->num_rows > 0) {
    // It's a regular user!
    $_SESSION['uname'] = $uname;
    $_SESSION['role'] = 'user';
    header("Location: ../user.html");
    exit();
} else {
    // 3. Not found in either table
    echo "<script>alert('Account not found'); window.location.href='signup.html';</script>";
}
}
?>