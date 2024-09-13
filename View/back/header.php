<?php
session_start();

// Check if the user is logged in and fetch user info
$username = "";
if (isset($_SESSION['user']['name'])) {
    $username = $_SESSION['user']['name'];
}

// Handle logout
if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    header("Location: ../front/index.php");
    exit();
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
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .navbar-side {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #2f4050;
        }

        .sidebar-collapse {
            overflow-y: auto; /* Enable scrolling if content overflows */
            flex-grow: 1;
        }

        .logout-button {
            padding: 20px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <!-- User Info Section -->
                <li class="text-center">
                    <?php if (!empty($username)) { ?>
                        <span class="username" style="color: white;"><?php echo htmlspecialchars($username); ?></span>
                    <?php } ?>
                </li>

                <!-- Sidebar Menu Items -->
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                </li>
            </ul>

            <!-- Logout Button -->
            <?php if (!empty($username)) { ?>
                <li class="logout-button">
                    <form id="logoutForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="margin: 0;">
                        <button class="btn btn-danger btn-block" type="submit" name="logout">Logout</button>
                    </form>
                </li>
            <?php } ?>
        </div>
    </nav>
</body>
</html>
