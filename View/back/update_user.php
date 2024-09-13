<?php
session_start();
include '../../Controller/controller.php';
include '../../model/user.php';

$id = $_GET['id'];
$error = "";

// Create an instance of the controller
$userC = new userC();
$user = $userC->showuser($id); // Fetch the user details

$valid = 0;

// Check if the form is submitted and required fields are set
if (
    isset($_POST["name"]) &&
    isset($_POST["surname"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["type"]) // Role field is added here
) {
    // Server-side validation
    $exist = $userC->getbyemail($_POST["email"]);
    $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $namePattern = '/^[A-Za-z]+$/';

    if (!preg_match($emailPattern, $_POST["email"])) {
        echo "<script>alert('Invalid email format. Please enter a valid email address.');</script>";
    } elseif (!preg_match($namePattern, $_POST["name"]) || !preg_match($namePattern, $_POST["surname"])) {
        echo "<script>alert('Invalid name format. Names should contain only letters.');</script>";
    } elseif ($exist && $exist['user_id'] != $id) {
        echo "<script>alert('Email is already in use.');</script>";
    } else {
        $valid = 1; // Form validation passed
    }
}

if ($valid == 1) {
    // Form is valid, proceed with updating the user
    $updatedRole = intval($_POST['type']); // Capture the selected role

    $user = new user(
        $_POST["name"],
        $_POST["surname"],
        $_POST["email"],
        $_POST["password"],
        $updatedRole // Updated role is passed to the constructor
    );

    $userC->updateuser($user, $id);
    header('Location: index.php'); // Redirect to the user list page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Update User Information</h2>
    <form method="post" action="" class="p-4 border rounded shadow-sm">
        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <!-- Surname -->
        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" value="<?= htmlspecialchars($user['surname']) ?>" required>
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= htmlspecialchars($user['password']) ?>" required>
        </div>

        <!-- Role Dropdown -->
        <div class="mb-3">
            <label for="type" class="form-label">Role</label>
            <select class="form-select" id="type" name="type" required>
                <option value="1" <?= $user['type'] == 1 ? 'selected' : '' ?>>User</option>
                <option value="2" <?= $user['type'] == 2 ? 'selected' : '' ?>>Agent</option>
                <option value="3" <?= $user['type'] == 3 ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Back to Index</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>