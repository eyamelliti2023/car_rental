<?php
    include("header.php");
    include '../../Controller/controller.php';
    include '../../model/car.php';
    include '../../model/user.php';
    include '../../Model/contract.php';
    $userC = new userC();
    $user_search_name = '';
    $user_search_email = '';
    $sort_type = '';  // Variable for sorting

    // If sorting is requested by user type
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['sort_type'])) {
            $sort_type = $_POST['sort_type'];
            $user_tab = $userC->getUsersByType($sort_type); // Fetch users sorted by type
        } elseif (!empty($_POST['user_email'])) {
            $user_search_email = $_POST['user_email'];
            $user_tab = $userC->searchemail($user_search_email); // Fetch users by email
        } elseif (!empty($_POST['user_name'])) {
            $user_search_name = $_POST['user_name'];
            $user_tab = $userC->searchname($user_search_name); // Fetch users by name
        } else {
            $user_tab = $userC->listusers(); // Fallback to listing all users
        }
    } else {
        $user_tab = $userC->listusers(); // Default to all users when not posting
    }
    function mapUserRole($role) {
        switch ($role) {
            case 1:
                return 'User';
            case 2:
                return 'Agent';
            case 3:
                return 'Admin';
        }
    }
    $carC= new carC();
    $car_search_brand = '';
    $car_search_color = '';
    $sort_status = '';  // Variable for sorting

    // If sorting is requested by user type
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['sort_status'])) {
            $sort_status = intval($_POST['sort_status']);
            $car_tab = $carC->getcarsByStatus($sort_status-1); // Fetch cars sorted by type
        } elseif (!empty($_POST['search_brand'])) {
            $car_search_email = $_POST['search_brand'];
            $car_tab = $carC->getbybrand($car_search_email); // Fetch cars by email
        } elseif (!empty($_POST['search_color'])) {
            $car_search_color = $_POST['search_color'];
            $car_tab = $carC->getbyColor($car_search_color); // Fetch cars by name
        } else {
            $car_tab = $carC->listcars(); // Fallback to listing all cars
        }
    } else {
        $car_tab = $carC->listcars(); // Default to all cars when not posting
    }
    function mapstatus($status) {
        switch ($status) {
            case 1:
                return 'Available';
            case 0:
                return 'Unavailable';
        }
    }
    function maptransmission($transmission) {
        switch ($transmission) {
            case 1: 
                return 'Automatic';
            case 2:
                return 'Manual';
        }
    }
    $contractC = new contractC();
    $contractCount = $contractC->countContractsWithStatusZero();
    $stats = $contractC->getContractStatistics();
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
                    <div class="col-md-12">
                        <h2><?= mapUserRole($_SESSION['user']['type']); ?> Dashboard</h2>   
                        <h5>Welcome <?= $_SESSION['user']['name'] ?> , Love to see you back. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                <hr />
                <?php if ($_SESSION['user']['type']=="2") {?>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green set-icon">
                                    <i class="fa fa-bars"></i>
                                </span>
                                <div class="text-box" >
                                    <a href="contract_table.php">
                                        <p class="main-text"><?= $contractCount ?> Tasks</p>
                                        <p class="text-muted">Remaining</p>
                                    </a>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6"> 
                                <div class="text-box" >
                                    <a href="add_car.php">
                                        <button class="btn btn-primary btn-lg">Add Car</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                 <!-- /. ROW  -->
                <hr />                
                <div class="row">
                    <?php if($_SESSION['user']['type']== "3"){ ?>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6"> 
                                <div class="text-box" >
                                    <a href="add_user.php">
                                        <button class="btn btn-primary btn-lg">Add</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="panel-heading">
                            Users
                        </div>
                        <form method="post">
                            <label for="user_email" class="form-label">email</label>
                            <input type="text" class="form-control" id="colour" name="user_email">
                            <label for="user_name" class="form-label">name</label>
                            <input type="text" class="form-control" id="colour" name="user_name">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        
                        <form method="post" action="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="sort_type" class="form-label">Sort by User Type</label>
                                    <select class="form-select" name="sort_type" id="sort_type" onchange="this.form.submit()">
                                        <option value="">Select User Type</option>
                                        <option value="1" <?= isset($_POST['sort_type']) && $_POST['sort_type'] == '1' ? 'selected' : '' ?>>User</option>
                                        <option value="2" <?= isset($_POST['sort_type']) && $_POST['sort_type'] == '2' ? 'selected' : '' ?>>Agent</option>
                                        <option value="3" <?= isset($_POST['sort_type']) && $_POST['sort_type'] == '3' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Surname(s)</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user_tab as $user) { 
                                            echo '<tr class="odd gradeX">
                                                    <td>'.$user['user_id'].'</td>
                                                    <td>'.$user['name'].'</td>
                                                    <td>'.$user['surname'].'</td>
                                                    <td>'.$user['email'].'</td>
                                                    <td>'.mapUserRole($user['type']).'</td>
                                                    <td>
                                                        <a href="update_user.php?id='.$user['user_id'].'"><button class="btn btn-outline-light m-2">Update</button></a>
                                                        <a href="delete_user.php?id='.$user['user_id'].'"><button class="btn btn-primary ms-2">Delete</button></a>
                                                    </td>
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                        <div class="panel-heading">
                             Cars
                        </div>
                        <form method="post">
                            <label for="search_brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="search_brand">
                            <label for="search_color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="brand" name="search_color">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        
                        <form method="post" action="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="sort_status" class="form-label">Sort by Status</label>
                                    <select class="form-select" name="sort_status" id="sort_status" onchange="this.form.submit()">
                                        <option value="">Select Status</option>
                                        <option value="1" <?= isset($_POST['sort_status']) && $_POST['sort_status'] == '1' ? 'selected' : '' ?>>Uanavailable</option>
                                        <option value="2" <?= isset($_POST['sort_status']) && $_POST['sort_status'] == '2' ? 'selected' : '' ?>>Available</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Price</th>
                                            <th>Color</th>
                                            <th>NB Seats</th>
                                            <th>Transmission</th>
                                            <th>Status</th>
                                            <th>Picture</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($car_tab as $car) { 
                                            echo '<tr class="odd gradeX">
                                                    <td>'.$car['car_id'].'</td>
                                                    <td>'.$car['brand'].'</td>
                                                    <td>'.$car['model'].'</td>
                                                    <td>'.$car['price_per_day'].'</td>
                                                    <td>'.$car['color'].'</td>
                                                    <td>'.$car['seats'].'</td>
                                                    <td>'.maptransmission($car['transmission']).'</td>
                                                    <td>'.mapstatus($car['status']).'</td>
                                                    <td><img src="'.$car['image'].'" class="img-fluid product-image" alt=""></td>
                                                    <td>
                                                        <a href="update_car.php?id='.$car['car_id'].'"><button class="btn btn-outline-light m-2">Update</button></a>
                                                        <a href="delete_car.php?id='.$car['car_id'].'"><button class="btn btn-primary ms-2">Delete</button></a>
                                                    </td>
                                                </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <?php if($_SESSION['user']['type']== "3"){ ?>
                        <!-- Chart.js library -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <!-- Chart Container -->
                        <div class="panel-body">
                            <h3>Contract Statistics</h3>
                            <canvas id="contractStatsChart"></canvas>
                            <script>
                                const ctx = document.getElementById('contractStatsChart').getContext('2d');
                                const contractStatsChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Approved & Paid', 'Approved & Not Paid', 'Not Approved'],
                                        datasets: [{
                                            label: 'Number of Contracts',
                                            data: [
                                                <?php echo $stats['approved_paid']; ?>,
                                                <?php echo $stats['approved_not_paid']; ?>,
                                                <?php echo $stats['not_approved']; ?>
                                            ],
                                            backgroundColor: [
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 159, 64, 0.2)',
                                                'rgba(255, 99, 132, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 159, 64, 1)',
                                                'rgba(255, 99, 132, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                    <?php } ?>
                </div>
                           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>