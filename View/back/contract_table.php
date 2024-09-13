<?php
    include("header.php");
    include '../../Controller/controller.php';
    include '../../model/car.php';
    include '../../model/user.php';
    include '../../Model/contract.php';

    $contractC = new contractC();
    $tab= $contractC->listcontracts();
    function mapActiveStatuse($status) {
        switch ($status) {
            case 1:
                return 'Approuved';
            case 0:
                return 'Pending';
        }
    }
    function mapPaymentStatus($status) {
        switch ($status) {
            case 1:
                return 'Paid';
            case 0:
                return 'Upaid';
        }
    }
    function findCarBrand($id){
        $carC= new carC();
        $car = $carC->showcar($id);
        return $car['brand'];
    }
    function findUserName($id){
        $userC = new userC();
        $user = $userC->showuser($id);
        return $user['name'];
    }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
               
            </div>              
            <hr />
            <div class="panel-heading">
                             Contracts
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Car Brand</th>
                                <th>Customer</th>
                                <th>Agent</th>
                                <th>Starts</th>
                                <th>Ends</th>
                                <th>Total amount</th>
                                <th>Active Status</th>
                                <th>Payment Satus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tab as $Contract) { ?>
                                <tr class="odd gradeX">
                                    <td><?= $Contract['contract_id']; ?></td>
                                    <td><?= findCarBrand($Contract['car_id']); ?></td>
                                    <td><?= findUserName($Contract['customer_id']); ?></td>
                                    <td><?= findUserName($Contract['agent_id']); ?></td>
                                    <td><?= $Contract['start_date']; ?></td>
                                    <td><?= $Contract['end_date']; ?></td>
                                    <td><?= $Contract['total']; ?></td>
                                    <td><?= mapActiveStatuse($Contract['active_status']); ?></td>
                                    <td><?= mapPaymentStatus($Contract['payment_status']); ?></td>
                                    <td>
                                        <?php if ($Contract['active_status'] == '0') { ?>
                                            <a href="approve.php?id=<?= $Contract['contract_id']; ?>">
                                                <button class="btn btn-outline-light m-2">Approve</button>
                                            </a>
                                        <?php } ?>
                                        <a href="delete_contract.php?id=<?= $Contract['contract_id']; ?>">
                                            <button class="btn btn-primary ms-2">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</body>
