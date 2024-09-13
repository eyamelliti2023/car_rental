<?php
    session_start();
    include '../../Controller/controller.php';
    $id=$_SESSION['user']["user_id"];
    $userC = new userC();

    $userC->deleteuser($id);
    unset($_SESSION['user']);
    header('Location: index.php');
    exit();
  