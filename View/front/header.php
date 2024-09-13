<?php
session_start();

$username = "";

// Check if the user is logged in and fetch user info
if (isset($_SESSION['user']['name'])) {
    $username = $_SESSION['user']['name'];
}

// Handle logout
if (isset($_POST['logout'])) {
    // Unset session variables
    unset($_SESSION['user']);
    // Redirect to login page
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tooplate's Little Fashion</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css"/>
    <link href="css/tooplate-little-fashion.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="index.php">
                <strong><span>Car</span> Rental</strong>
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>

                    <!-- User Info Section -->
                    <?php if (!empty($username)) { ?>
                        <li class="nav-item"><a class="nav-link" href="history.php">History</a></li>
                        <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="faq.php" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="username"><?php echo htmlspecialchars($username); ?></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="faq.php">Profile</a></li>
                                <li>
                                    <form id="logoutForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="margin: 0;">
                                        <button class="dropdown-item" type="submit" name="logout">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item"><a href="sign-in.html" class="nav-link">Sign In</a></li>
                    <?php } ?>
                </ul>

                <div class="d-lg-none">
                    <?php if (!empty($username)) { ?>
                        <span class="username"><?php echo htmlspecialchars($username); ?></span>
                    <?php } else { ?>
                        <a href="sign-in.html" class="bi-person custom-icon me-3"></a>
                        <a href="product-detail.html" class="bi-bag custom-icon"></a>
                    <?php } ?>
                </div>

            </div>
        </div>
    </nav>
