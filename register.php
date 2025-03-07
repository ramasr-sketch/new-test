<?php
$host = "localhost"; // Change if needed
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "mytutor"; // Database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Message to show success or errors
<?php
$host = "localhost"; // Change if needed
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "mytutor"; // Database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Message to show success or errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $blood_group = $_POST["bloodgroup"];
    $location = $_POST["location"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $diseases = $_POST["diseases"];

    // Phone number validation (exactly 10 digits)
    if (strlen($contact) !== 10 || !is_numeric($contact)) {
        $message = "<p style='color:red;'>Phone number should be exactly 10 digits.</p>";
    }
    // Password validation (at least 8 characters and one special character)
    elseif (strlen($password) < 8 || !preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
        $message = "<p style='color:red;'>Password must be at least 8 characters long and contain a special symbol.</p>";
    } else {
        // Prevent duplicate email entry
        $check_email = "SELECT * FROM register WHERE email='$email'";
        $result = $conn->query($check_email);

        if ($result->num_rows > 0) {
            $message = "<p style='color:red;'>Email already registered!</p>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Encrypt password
            $sql = "INSERT INTO register(name, bloodgroup, location, contact, email, password, age, gender, diseases) 
                    VALUES ('$name', '$blood_group', '$location', '$contact', '$email', '$hashed_password', '$age', '$gender', '$diseases')";

            if ($conn->query($sql) === TRUE) {
                $message = "<p style='color:green;'>Registration successful!</p>";
            } else {
                $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Donation Website</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Blood Donation Website</h1>
    <p>Saving lives through your generous blood donations</p>
  </header>

  <nav>
    <a href="#register">Register as a Donor</a>
  </nav>

  <main>
    <!-- Register as a Donor Section -->
    <section id="register">
      <h2>Register as a Donor</h2>

      <!-- Display success/error messages -->
      <?php if ($message != "") { echo $message; } ?>

      <form action="#" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="blood-group">Blood Group:</label>
        <select id="blood-group" name="bloodgroup" required>
          <option value="">Select Blood Group</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
        </select>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" placeholder="City/State" required>

        <label for="contact">Contact Number:</label>
        <input type="tel" id="contact" name="contact" placeholder="123-456-7890" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br><br>
        
        <label for="diseases">Please mention if you have any diseases or else fill N/A:</label><br>
        <textarea id="diseases" name="diseases" rows="4" cols="30"></textarea><br><br>

        <button type="submit">Register</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Blood Donation Website. All Rights Reserved.</p>
  </footer>
</body>
</html>

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $blood_group = $_POST["blood-group"];
    $location = $_POST["location"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encrypt password
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $diseases = $_POST["diseases"];

    // Prevent duplicate email entry
    $check_email = "SELECT * FROM register WHERE email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        $message = "<p style='color:red;'>Email already registered!</p>";
    } else {
        $sql = "INSERT INTO register(name, bloodgroup, location, contact, email, password, age, gender, diseases) 
                VALUES ('$name', '$blood_group', '$location', '$contact', '$email', '$password', '$age', '$gender', '$diseases')";

        if ($conn->query($sql) === TRUE) {
            $message = "<p style='color:green;'>Registration successful!</p>";
        } else {
            $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Donation Website</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Blood Donation Website</h1>
    <p>Saving lives through your generous blood donations</p>
  </header>

  <nav>
    <a href="#register">Register as a Donor</a>
  </nav>

  <main>
    <!-- Register as a Donor Section -->
    <section id="register">
      <h2>Register as a Donor</h2>
      <form action="#" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="blood-group">Blood Group:</label>
        <select id="blood-group" name="bloodgroup" required>
          <option value="">Select Blood Group</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
        </select>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" placeholder="City/State" required>

        <label for="contact">Contact Number:</label>
        <input type="tel" id="contact" name="contact" placeholder="123-456-7890" required>
  <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br><br>
        
        <label for="diseases">Please mention if you have any diseases or else fill N/A:</label><br>
        <textarea id="diseases" name="diseases" rows="4" cols="30"></textarea><br><br>

        <button type="submit">Register</button>
      </form>
    </section>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Blood Donation Website. All Rights Reserved.</p>
  </footer>
</body>
