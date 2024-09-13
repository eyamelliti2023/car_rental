<?php
session_start(); // Start the session

include '../../Controller/controller.php';
include '../../model/car.php';
include '../../Model/contract.php';
include("header.php");

$car_id = $_GET["id"];
$carC = new carC();
$car = $carC->showcar($car_id);
$contract=null;
$contractC= new contractC();
if ($car['status'] == "0") {
    echo "<script>
            alert('Car unavailable');
            setTimeout(function() {
                window.location.href = 'products.php';
            }, 100);
          </script>";
    exit();
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    // Calculate the number of days
    $start_date = new DateTime($_POST['start_date']);
    $end_date = new DateTime($_POST['end_date']);
    $interval = $start_date->diff($end_date);
    $days = $interval->days;

    // Calculate the total price
    $total_price = ($days +1) * $car['price_per_day'];
    $start_date_str = $start_date->format('Y-m-d');
    $end_date_str = $end_date->format('Y-m-d');
    $contract= new contract(
        $car_id,
        $_SESSION['user']['user_id'],
        1,
        $start_date_str,
        $end_date_str,
        $total_price,
        0,
        0
    );
    $contractC->addcontract($contract);
    echo "<script>
            alert('Item added to cart successfully!');
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 100);
        </script>";
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Your existing head content -->
    <script>
        function calculateTotalPrice() {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);
            const pricePerDay = <?= $car['price_per_day']; ?>;
            let totalPrice = 0;

            if (startDate && endDate && endDate >= startDate) {
                const timeDiff = endDate.getTime() - startDate.getTime();
                const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert milliseconds to days
                totalPrice = (daysDiff+1) * pricePerDay;
            }

            document.getElementById('total_price').innerText = totalPrice.toFixed(2);
        }
    </script>
</head>

<body>
    <main>
        <section class="product-detail section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12">
                        <div class="product-thumb">
                            <img src="<?= $car['image'] ?>" class="img-fluid product-image" alt="car">
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="product-info d-flex">
                            <div>
                                <h2 class="product-title mb-0"><?= $car['brand'] ?></h2>
                            </div>
                        </div>
                        <div>
                            <p>
                                <strong>Model:</strong> <?= $car['model']; ?><br>
                                <strong>Price per day:</strong> $<?= number_format($car['price_per_day'], 2); ?><br>
                                <strong>Color:</strong> <?= $car['color']; ?><br>
                                <strong>Transmission:</strong> <?= maptransmission($car['transmission']); ?><br>
                                <strong>Seats:</strong> <?= $car['seats']; ?><br>
                                <strong>Status:</strong> <?= mapstatus($car['status']); ?>
                            </p>
                            <div>
                                <form method="post" action="">
                                    <div class="col-lg-6 col-12">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" name="start_date" required onchange="calculateTotalPrice()">
                                    </div><br>

                                    <div class="col-lg-6 col-12">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" id="end_date" name="end_date" required onchange="calculateTotalPrice()">
                                    </div><br>

                                    <p><strong>Total Price:</strong> $<span id="total_price">0.00</span></p>

                                    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                                        <button type="submit" name="add_to_cart" class="btn custom-btn cart-btn">Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <p>
                            <a href="#" class="product-additional-link">Details</a>
                            <a href="#" class="product-additional-link">Delivery and Payment</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- (Rest of your content) -->

    </main>

    <!-- (Your existing footer and scripts) -->
</body>
</html>
