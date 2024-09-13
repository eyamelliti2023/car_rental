<?php
include '../../Controller/controller.php';
include '../../model/user.php';

session_start();
$error = "";
$valid = 0;
$userC = new userC();

// Check if form is submitted
if (isset($_POST["submit"])) {
    // Validate form fields
    if (
        !empty($_POST["name"]) &&
        !empty($_POST["surname"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        isset($_POST["type"])
    ) {
        // Server-side validation
        $exist = $userC->getbyemail($_POST["email"]);
        $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $namePattern = '/^[A-Za-z]+$/';
        $validTypes = [1, 2, 3];

        if (!preg_match($emailPattern, $_POST["email"])) {
            echo "<script>alert('Invalid email format. Please enter a valid email address.');</script>";
        } elseif (!preg_match($namePattern, $_POST["name"]) || !preg_match($namePattern, $_POST["surname"])) {
            echo "<script>alert('Invalid name format. Names should contain only letters.');</script>";
        } elseif ($exist) {
            echo "<script>alert('Email already exists. Please try another one.');</script>";
        } elseif (!in_array($_POST["type"], $validTypes)) {
            echo "<script>alert('Invalid user type selected.');</script>";
        } else {
            $valid = 1; // Form validation passed
        }
    } else {
        $error = "Missing information";
    }

    if ($valid == 1) {
        // Create user object and add to database
        $user = new user(
            $_POST["name"],
            $_POST["surname"],
            $_POST["email"],
            $_POST["password"],
            $_POST["type"]
        );
        $userC->adduser($user); // Calls the adduser method
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Input Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Add User</h2>
    <form method="post" action="" class="p-4 border rounded shadow-sm">
        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Surname -->
        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <!-- Type -->
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="1">User</option>
                <option value="2">Agent</option>
                <option value="3">Admin</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Back to Index</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
