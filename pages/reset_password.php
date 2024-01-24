<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $password = "RPInets13";
    $dbname = "planet";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkUserQuery = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($oldPassword, $user['password'])) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordQuery = "UPDATE users SET password='$hashedNewPassword' WHERE email='$email'";

            if ($conn->query($updatePasswordQuery) === TRUE) {
                echo "Password reset successfully";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Incorrect old password. Password not updated.";
        }
    } else {
        echo "User not found. Password not updated.";
    }

    $conn->close();
}
?>
