<!DOCTYPE html>
<html>
<head>
    <title>Stored Data</title>
</head>
<body>

<h2>Data from Database</h2>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Blood Group</th>
        <th>Location</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Diseases</th>
    </tr>

    <?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "mytutor");

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT name, bloodgroup, location, contact, email, age, gender, diseases FROM register";
    $result = $conn->query($sql);

    // Display data if available
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["name"]."</td>
                    <td>".$row["bloodgroup"]."</td>
                    <td>".$row["location"]."</td>
                    <td>".$row["contact"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["age"]."</td>
                    <td>".$row["gender"]."</td>
                    <td>".$row["diseases"]."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No data found.</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>

</table>

</body>
</html>
