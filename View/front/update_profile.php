<?php
session_start();
include '../../Controller/controller.php';
include '../../model/user.php';
$id=$_SESSION['user']['user_id'];
$error = "";

// create client
$valid=0;
$userC = new userC();
// create an instance of the controller
if (
isset($_POST["name"]) &&
isset($_POST["surname"]) &&
isset($_POST["email"]) &&
isset($_POST["password"])
) {
if (
!empty($_POST["name"]) &&
!empty($_POST["surname"]) &&
!empty($_POST["email"]) &&
!empty($_POST["password"])
) {
// Server-side validation
$exist= $userC->getbyemail($_POST["email"]);
$emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$namePattern = '/^[A-Za-z]+$/';

if (!preg_match($emailPattern, $_POST["email"])) {
    echo "<script>alert('Invalid email format. Please enter a valid email address.');</script>";
} elseif (!preg_match($namePattern, $_POST["name"]) || !preg_match($namePattern, $_POST["surname"])) {
    echo "<script>alert('Invalid name format. Names should contain only letters.');</script>";
} elseif ($exist && $exist['user_id']!=$id) {
    echo "<script>alert('Email is already in use.');</script>";
} else {
    $valid = 1; // Form validation passed
}

} else {
$error = "Missing information";
}
}

if ($valid == 1) {  
// Form is valid, proceed with adding the use
$role=$_SESSION['user']['type'];
$updatedrole = intval($role);
$user = new user(
$_POST["name"],
$_POST["surname"],
$_POST["email"],
$_POST["password"],
$updatedrole 
);

//var_dump($user);
$userC->updateuser($user,$id);
$user = $userC->showuser($id);
$_SESSION['user']=$user;
header('Location: faq.php');
exit;
} 


