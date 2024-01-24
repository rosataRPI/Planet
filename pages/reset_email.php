<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldEmail = $_POST['email_old'];
    $newEmail = $_POST['email_new'];
    $enteredPassword = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $password = "RPInets13";
    $dbname = "planet";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkUserQuery = "SELECT * FROM users WHERE email='$oldEmail'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($enteredPassword, $user['password'])) {
            $updateEmailQuery = "UPDATE users SET email='$newEmail' WHERE email='$oldEmail'";
            
            if ($conn->query($updateEmailQuery) === TRUE) {
                echo "Email updated successfully";
            } else {
                echo "Error updating email: " . $conn->error;
            }
        } else {
            echo "Incorrect password. Email not updated.";
        }
    } else {
        echo "User not found or incorrect old email. Email not updated.";
    }
    $conn->close();
}
?>