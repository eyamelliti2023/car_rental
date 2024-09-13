<?php
    session_start();
    include '../../Controller/controller.php';
    $id=$_GET["id"];
    $contractC = new contractC();

    $contractC->deletecontract($id);
    header('Location: contract_table.php');
    exit();
  