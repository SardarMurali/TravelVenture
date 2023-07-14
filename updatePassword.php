<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted username and new password
    $usernameOrg = $_POST['username'];
    $passwordOrg = $_POST['new_password'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Travel";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the update statement using prepared statements
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $passwordOrg, $usernameOrg);

    // Execute the prepared statement
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Record updated successfully";
        } else {
            echo "No records updated";
        }
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    var_dump($usernameOrg, $passwordOrg);
    $stmt->close();
    $conn->close();
}
?>
