<?php
include '../../Controller/controller.php';
include '../../model/car.php';
include("header.php");

$carC= new carC();
$car_search_brand = '';
$car_search_color = '';
$sort_status = '';  // Variable for sorting

// If sorting is requested by user type
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['sort_status'])) {
        $sort_status = intval($_POST['sort_status']);
        $tab = $carC->getcarsByStatus($sort_status-1); // Fetch cars sorted by type
    } elseif (!empty($_POST['search_brand'])) {
        $car_search_email = $_POST['search_brand'];
        $tab = $carC->getbybrand($car_search_email); // Fetch cars by email
    } elseif (!empty($_POST['search_color'])) {
        $car_search_color = $_POST['search_color'];
        $tab = $carC->getbyColor($car_search_color); // Fetch cars by name
    } else {
        $tab = $carC->listcars(); // Fallback to listing all cars
    }
} else {
    $tab = $carC->listcars(); // Default to all cars when not posting
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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tooplate's Little Fashion - Products</title>

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

<section class="preloader">
    <div class="spinner">
        <span class="sk-inner-circle"></span>
    </div>
</section>

<main>

    <header class="site-header section-padding d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <h1>
                        <span class="d-block text-primary">Choose your</span>
                        <span class="d-block text-dark">Car</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
            <div class="row">
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
                        <label for="sort_status" class="form-label">Sort by User Type</label>
                        <select class="form-select" name="sort_status" id="sort_status" onchange="this.form.submit()">
                            <option value="">Select User Type</option>
                            <option value="1" <?= isset($_POST['sort_status']) && $_POST['sort_status'] == '1' ? 'selected' : '' ?>>Uanavailable</option>
                            <option value="2" <?= isset($_POST['sort_status']) && $_POST['sort_status'] == '2' ? 'selected' : '' ?>>Available</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <section class="products section-padding">
        <div class="container">
            <div class="row">
                <?php foreach ($tab as $car) { ?>
                    <div class="col-lg-4 col-12 mb-3">
                        <div class="product-thumb">
                            <a href="product-detail.php?id=<?= $car['car_id'] ?>">
                                <img src="<?= $car['image'] ?>" class="img-fluid product-image" alt="<?= $car['model'] ?>">
                            </a>
                            <p>
                                <strong>Brand:</strong> <?= $car['brand']; ?><br>
                                <strong>Model:</strong> <?= $car['model']; ?><br>
                                <strong>Price:</strong> $<?= number_format($car['price_per_day'], 2); ?><br>
                                <strong>Color:</strong> <?= $car['color']; ?><br>
                                <strong>Transmission:</strong> <?= maptransmission($car['transmission']); ?><br>
                                <strong>Seats:</strong> <?= $car['seats']; ?><br>
                                <strong>Status:</strong><?= mapstatus($car['status']); ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

</main>

<footer class="site-footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-10 me-auto mb-4">
                <h4 class="text-white mb-3"><a href="index.html">Little</a> Fashion</h4>
                <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2022 <strong>Little Fashion</strong></p>
                <br>
                <p class="copyright-text">Designed by <a href="https://www.tooplate.com/" target="_blank">Tooplate</a></p>
            </div>

            <div class="col-lg-5 col-8">
                <h5 class="text-white mb-3">Sitemap</h5>

                <ul class="footer-menu d-flex flex-wrap">
                    <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">Story</a></li>
                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Products</a></li>
                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy policy</a></li>
                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">FAQs</a></li>
                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-4">
                <h5 class="text-white mb-3">Social</h5>

                <ul class="social-icon">
                    <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                    <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>
                    <li><a href="#" class="social-icon-link bi-instagram"></a></li>
                    <li><a href="#" class="social-icon-link bi-skype"></a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/Headroom.js"></script>
<script src="js/jQuery.headroom.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
