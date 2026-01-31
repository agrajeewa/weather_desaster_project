<?php
    $_conn = new mysqli("localhost", "root", "", "test");
    if ($_conn->connect_error) {
        die("Connection failed: " . $_conn->connect_error);
    }
    //prepare and bind
    $stmt = $_conn->prepare("select tp_number from user where name = ?");
    // Assuming you have already fetched $row from the database
if ($row['USRNAME'] == 'admin') {
    // Redirect to Admin page
    header("Location: admin.php"); 
    exit();
} else {
    // Redirect to Member page
    header("Location: profile.php");
    exit();
}
    
    if ($stmt === false) {
        die("Prepare failed: " . $_conn->error);
    }
?>