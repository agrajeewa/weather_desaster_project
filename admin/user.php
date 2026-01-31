<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Manage Users</title>
</head>

<body>
    <br>
    <nav>
        <img src="p1.jpg" alt="Logo" height="60px">
        <a href="admin.html">Home</a>
        <a href="appro.html">Approvel Queue</a>
        <a href="vict.html">Victem Monitor</a>
        <a href="user.php" class="active">Users</a>
        <a href="../login/login.html">Logout</a>
    </nav>

    <div class="container">
        <h2>Registered Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            <?php
            //db connection
            $servername = "localhost";
            $username   = "root";
            $password   = ""; 
            $dbname     = "dms";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT ID, USRNAME FROM user ORDER BY ID";  
            $result = $conn->query($sql);

            if ($result === false) {
                echo "<tr><td colspan='2'>Query failed: " . $conn->error . "</td></tr>";
            }
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
            echo "<tr>
                        <td>{$row['ID']}</td>
                        <td>{$row['USRNAME']}</td>
                    </tr>";
            }
            } else {
                echo "<tr><td colspan='3'>No data</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
    
    <footer style="background-color: #1a1a1a41; text-align: center; padding: 10px; margin-top: 20px; position: fixed; bottom: 0; width: 100%;">
        <p>&copy; 2026 Disaster Management System. All rights reserved.</p>
</body>

</html>