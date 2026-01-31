<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Victim Monitor</title>
</head>
<body>
    <?php
    session_start();
    echo"<br>";
    echo '<nav>
        <img src="p1.jpg" alt="Logo" height="60px">
        <a href="admin.html">Home</a>
        <a href="appro.php">Approvel Queue</a>
        <a href="vict.html" class="active">Victem Monitor</a>
        <a href="user.php">Users</a>
        <a href="../login/login.html">Logout</a>
    </nav>';
    echo '<div class="container">
        <h2>Active Victim Reports</h2>
        <table id="victim_list">
            <tr>
                <th>Victim Name</th>
                <th>Affected Count</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Created</th>
                <th>Status</th>
                <th>Action</th>
            </tr>';

            //db connection
            $servername = "localhost";
            $username   = "root";
            $password   = "";
            $dbname     = "dms";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT fname,lname,affected_count,gender,contact,created,status FROM victem WHERE status='Pending' ORDER BY id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['status'] === 'Pending') {
                        echo "<tr>
                        <td>{$row['fname']} {$row['lname']}</td>
                        <td>{$row['affected_count']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['contact']}</td>
                        <td>{$row['created']}</td>
                        <td><strong>{$row['status']}</strong></td>
                        <td>";
                        echo '<button id="butn" name="butn" onclick="upCount()" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px;">Mark as Helped</button>';
                        echo "</td>";
                        echo "</tr>";
                        if ()
                    }
                }
            } else {
                echo "<tr><td colspan='7' style='text-align: center;'>No pending reports found.</td></tr>";
            }
        echo'<script>
        let count = 0;

        function upCount() {
            document.getElementById("count").innerText = ++count;
            document.getElementById("butn").disabled = true;
        }
        </script>
        </table>

        <div id="stats_summary" style="margin-top: 500px; padding: 20px; border: 2px dashed #333;">
            <h3>Helped Count Summary</h3>
            <p>Total Victims Helped Today: <strong>
                    <div id="count"></div>
                </strong></p>
        </div>
    </div>

    <footer style="background-color: #1a1a1a41; text-align: center; padding: 10px; margin-top: 20px; position: fixed; bottom: 0; width: 100%;">
        <p>&copy; 2026 Disaster Management System. All rights reserved.</p>';
?>
</body>

</html>