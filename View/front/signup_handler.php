<?php
include '../../Controller/controller.php';
include '../../model/user.php';

session_start();
$error = "";
// Create client
$user = null;
$valid = 0;
$userC = new userC();

// Check if form is submitted
if (isset($_POST["submit"])) {
    // Validate form fields
    if (
        !empty($_POST["name"]) &&
        !empty($_POST["surname"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) 
    ) {
        // Server-side validation
        $exist = $userC->getbyemail($_POST["email"]);
        $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $namePattern = '/^[A-Za-z]+$/';

        if (!preg_match($emailPattern, $_POST["email"])) {
            echo "<script>alert('Invalid email format. Please enter a valid email address.');</script>";
        } elseif (!preg_match($namePattern, $_POST["name"]) || !preg_match($namePattern, $_POST["surname"])) {
            echo "<script>alert('Invalid name format. Names should contain only letters.');</script>";
        } elseif ($exist) {
            echo "<script>alert('Email already exists. Please try another one.');</script>";
        } else {
            $valid = 1; // Form validation passed
        }
    } else {
        $error = "Missing information";
    }

    if ($valid == 1) {
        // Check if file is uploaded successfully
        $user = new user(
            $_POST["name"],
            $_POST["surname"],
            $_POST["email"],
            $_POST["password"],
            1
        );
        $userC->adduser($user); // Assuming this calls the adduser method
        header('Location: index.php');
        exit;
    }
    
}
