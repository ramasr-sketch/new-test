!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donors List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

<h2>Blood Donors List</h2>

<table>
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
        die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
    }

    // Fetch data from the database
    $sql = "SELECT name, bloodgroup, location, contact, email, age, gender, diseases FROM register";
    $result = $conn->query($sql);

    if ($result) { // Check if the query ran successfully
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
            echo "<tr><td colspan='8' style='color: red;'>No data found.</td></tr>";
        }
    } else {
        echo "<tr><td colspan='8' style='color: red;'>Query Error: " . $conn->error . "</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>

</table>

<div class="footer">
    <p>© 2025 Blood Bank | Connecting Donors with Patients</p>
</div>

</body>
</html>
