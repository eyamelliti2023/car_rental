<?php
session_start();
include '../../Controller/controller.php';
include '../../model/user.php';

$userC = new userC();
if (isset($_POST["email"]) && isset($_POST["password"]) ) {
    if (!empty($_POST["email"]) && !empty($_POST["password"]) ){
        $user= $userC->getbyemail($_POST["email"]);
        $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($emailPattern, $_POST["email"])) {
          echo "<script>
                  alert('Invalid email format. Please enter a valid email address.');
                  setTimeout(function() {
                    window.location.href = 'sign-in.html';
                  }, 100);
                </script>";
        }elseif(!$user){
          echo "<script>
                  alert('Email desnt exist. Please try another one.');
                  setTimeout(function() {
                    window.location.href = 'sign-in.html';
                  }, 100);
                </script>";
        }elseif($user['password']!=$_POST["password"]){
          echo "<script>
                  alert('Email or password are invalid. Please try again.');
                  setTimeout(function() {
                    window.location.href = 'sign-in.html';
                  }, 100);
                </script>";
        }else {
          $_SESSION["user"] = $user;
          if($_SESSION["user"]["type"]=="2" || $_SESSION["user"]["type"]=="3"){
            header('Location:../back/index.php');
          }
          if ($_SESSION["user"]["type"]=="1") {
            header('Location:index.php');
          }
          exit;
        }
    } else {
        $error = "Missing information";
    }
}
