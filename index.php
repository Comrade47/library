<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Online Bookstore</h1>
        <form id="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (name === '' || email === '' || password === '') {
                alert('Please fill in all fields.');
                return false;
            }

            // Additional validation logic for email and password
            // You can use regular expressions or built-in JavaScript methods for validation

            return true;
        }
    </script>

    <?php
    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost";
        $username = "root"; // Change this to your MySQL username
        $password = ""; // Change this to your MySQL password
        $dbname = "mydatabase"; // Change this to your database name

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Validate form inputs
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);

        // Perform additional validation (e.g., email format, password strength)

        // Insert data into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }

        $conn->close();
    }

    // Function to sanitize form inputs
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
</body>
</html>
