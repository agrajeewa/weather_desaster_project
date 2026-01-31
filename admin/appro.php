<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "dms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SIMPLE STATUS UPDATE
if (isset($_GET['user']) && isset($_GET['status'])) {
    $user = $_GET['user'];
    $status = $_GET['status'];

    $conn->query("UPDATE desaster SET status='$status' WHERE user='$user'");
}

// Fetch disasters
$sql = "SELECT ID, user, disaster, location, status, risk, email, date FROM desaster";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Approval Queue</title>
</head>

<body>
    <br>
    <nav>
        <img src="p1.jpg" alt="Logo" height="60px">
        <a href="admin.html">Home</a>
        <a href="appro.php" class="active">Approval Queue</a>
        <a href="vict.html">Victim Monitor</a>
        <a href="user.html">Users</a>
        <a href="../login/login.html">Logout</a>
    </nav>

    <div class="container">
        <h2>Pending Disaster Warnings</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Disaster Type</th>
                <th>Location</th>
                <th>Actions</th>
                <th>Risk Level</th>
                <th>Email</th>
                <th>Date</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo "<tr>";
                    echo "<td>{$row['ID']}</td>";
                    echo "<td>{$row['user']}</td>";
                    echo "<td>{$row['disaster']}</td>";
                    echo "<td>{$row['location']}</td>";
                    echo "<td>";

                    if ($row['status'] == 'Pending') {
                        echo "<a href='?user={$row['user']}&status=Approved'>
                            <button class='btn btn-approve'>Approve</button>
                          </a> ";

                        echo "<a href='?user={$row['user']}&status=Rejected'>
                            <button class='btn btn-reject'>Reject</button>
                          </a>";
                    } else {
                        echo ucfirst($row['status']);
                    }

                    echo "</td>";
                    echo "<td>{$row['risk']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['date']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No reports</td></tr>";
            }
            ?>
        </table>
    </div>

    <footer style="background-color: #1a1a1a41; text-align: center; padding: 10px; margin-top: 20px; position: fixed; bottom: 0; width: 100%;">
        <p>&copy; 2026 Disaster Management System. All rights reserved.</p>
</body>

</html>