<?php
    include("header.php");
    include '../../Controller/controller.php';
    include '../../Model/contract.php';
    $id=$_GET['id'];
    $contractC = new contractC();
    $contract=$contractC->showcontract($id);
    $start_date = $contract['start_date'];
    $end_date = $contract['end_date'];
    $total_price = $contract['total'];
    $car_id= $contract['car_id'];
    $customer= $contract['customer_id'];
    $agent = $contract['agent_id'];
    $status= $contract['active_status'];
    $contract= new contract(
        $car_id,
        $customer,
        $agent,
        $start_date,
        $end_date,
        $total_price,
        $status,
        1
    );
    $contractC->updatecontract($contract,$id);
    header('Location: history.php');
    exit();