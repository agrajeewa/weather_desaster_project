<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "dms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch victims data
$sql = "SELECT fname,lname,affected_count,gender,contact,status FROM victem";
$result = $conn->query($sql);
$sq_l = "insert into victem (fname, lname, affected_count, gender, contact, status) values (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sq_l);

$first_name = $_GET['firstname'];
$last_name = $_GET['lastname'];
$affected_count = $_GET['affected'];
$gender = $_GET['gender'];
$contact = $_GET['contact'];
$status = "Pending";

$stmt->bind_param("ssissss", $first_name, $last_name, $affected_count, $gender, $contact, $status);
$stmt->execute();
