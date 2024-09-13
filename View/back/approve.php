<?php
    include("header.php");
    include '../../Controller/controller.php';
    include '../../model/contract.php';
    include '../../Model/car.php';
    $id=$_GET['id'];
    $contractC = new contractC();
    $contract = $contractC->showcontract($id);
    $start_date = $contract['start_date'];
    $end_date = $contract['end_date'];
    $total_price = $contract['total'];
    $car_id= $contract['car_id'];
    $customer= $contract['customer_id'];
    $agent = $_SESSION['user']['user_id'];
    $payment= $contract['payment_status'];
    $carC= new carC();
    $car= $carC->showcar($car_id);
    $brand= $car['brand'];
    $model= $car['model'];
    $price_per_day= $car['price_per_day'];
    $color= $car['color'];
    $transmission= $car['transmission'];
    $seats= $car['seats'];
    $image= $car['image'];
    $contract= new contract(
        $car_id,
        $customer,
        $agent,
        $start_date,
        $end_date,
        $total_price,
        1,
        $payment
    );
    $car= new car(
        $brand,
        $model,
        $price_per_day,
        $color,
        $transmission,
        $seats,
        $image,
        0
    );
    $contractC->updatecontract($contract,$id);
    $carC->updatecar($car, $car_id);
    header('Location: contract_table.php');
    exit();