<?php
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT id, password FROM registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email exists, verify the password
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // Password is correct, log in the user
            session_start();
            $_SESSION["user_id"] = $id;
            header("Location: video_upload.php"); // Redirect to the video upload page
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Password is incorrect. Please check again.');</script>";
        }
    } else {
        // Email not found, display an error message
        echo "<script>alert('User not found. Please register first.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
