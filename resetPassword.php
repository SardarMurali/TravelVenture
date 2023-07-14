<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted username
    $username = $_POST['username'];

    // Connect to your database (replace with your own database connection code)
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "Travel";

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username_db, $password_db);

    // Prepare and execute a SELECT query to check if the username exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // If the username exists, redirect to the change password page
    if ($user) {
        header("Location: ../Html/changePassword.html");
        exit();
    } else {
        // Display an error message if the username is not found
        echo "Username not found. Please try again.";
        header("Location: ../Html/login.html");
    }
}
?>
