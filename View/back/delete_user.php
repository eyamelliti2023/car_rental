<?php
    session_start();
    include '../../Controller/controller.php';
    $id=$_GET["id"];
    $userC = new userC();

    $userC->deleteuser($id);
    header('Location: index.php');
    exit();
  