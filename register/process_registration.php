<?php
include("dbconn.php");

// Start the session
session_start();

if (isset($_POST['submit'])) {
    $emailId = mysqli_real_escape_string($conn, $_POST['email']);

    // Query to check if the Emp ID already exists
    $query = "SELECT COUNT(*) as count FROM registration WHERE email = '$emailId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            // Employee with the same Emp ID already exists
            // Handle the error or redirect back to the form with an error message
            echo "<script>alert('Email id already exists. Please check email id.');</script>";
            echo "<script>window.location.href = 'register.html';</script>";
            exit();
        }
    } else {
        // Handle database query error
        // echo "Error: " . mysqli_error($conn);
        exit();
    }
    

    // Now check for empty fields
    $Name = mysqli_real_escape_string($conn, $_POST['name']);
    $emailId = mysqli_real_escape_string($conn, $_POST['email']);
    $Password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check for empty fields
    if (empty($emailId) || empty($Name) || empty($_POST['password'])) {
        echo "<script>alert('Please fill in all the required details.');</script>";
        echo '<script>window.location.href = "register.html";</script>';
        exit();
    }

    // Proceed with the insertion into the database
    $query = "INSERT INTO registration (name, email, password)
              VALUES ('$Name','$emailId','$Password')";

    if (mysqli_query($conn, $query)) {
        // Registration successful, set session variable
        $_SESSION['email'] = $emailId;

        // Redirect to dash.php
        header("Location: index.html");
        exit();
    } else {
        // echo "Error: " . mysqli_error($conn);
    }
} else {
    // echo "Invalid parameters!";
}
?>
