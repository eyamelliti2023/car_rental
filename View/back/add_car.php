<?php
include '../../Controller/controller.php';
include '../../model/car.php';
$valid = 0; // Initialize as not valid (0)
$car = null;
$carC = new carC();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate brand (all caps)
    $brand = trim($_POST['brand']);
    if (!ctype_upper($brand)) {
        $errors[] = "Brand must be in all capital letters.";
    }

    // Validate model (exclude specific characters)
    $model = trim($_POST['model']);
    if (preg_match('/[!@#\$%\^&\*\(\)]/', $model)) {
        $errors[] = "Model contains invalid characters.";
    }

    // Validate price (float)
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    if ($price === false) {
        $errors[] = "Price must be a valid float.";
    }

    // Validate colour (actual color)
    $colour = strtolower(trim($_POST['colour']));
    $valid_colours = ['red', 'blue', 'green', 'yellow', 'black', 'white', 'gray', 'orange', 'purple', 'pink']; // Add more colors as needed
    if (!in_array($colour, $valid_colours)) {
        $errors[] = "Colour must be a recognized color name.";
    }

    // Validate number of seats (either 2 or 5)
    $nb_seats = intval($_POST['nb_seats']);
    if (!in_array($nb_seats, [2, 5])) {
        $errors[] = "Number of seats must be either 2 or 5.";
    }

    // Validate transmission (1 or 2)
    $transmission = intval($_POST['transmission']);
    if (!in_array($transmission, [1, 2])) {
        $errors[] = "Transmission must be either 1 (Automatic) or 2 (Manual).";
    }

    // Validate status (1 or 0)
    $status = intval($_POST['status']);
    if (!in_array($status, [1, 0])) {
        $errors[] = "Status must be either 1 (Available) or 0 (Unavailable).";
    }

    // Validate image (png or jpg)
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Move the uploaded file to a directory
            $uploadFileDir = '../car_img/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $image = $dest_path; // Set the image path if upload succeeds
            } else {
                $errors[] = "There was an error moving the uploaded file.";
            }
        } else {
            $errors[] = "Upload file should be PNG or JPG.";
        }
    } else {
        $errors[] = "Image upload failed. Please try again.";
    }

    // If there are no errors, set valid to 1
    if (empty($errors)) {
        $valid = 1;
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
    if($valid == 1){
        $car = new car(
            $_POST['brand'],
            $_POST['model'],
            $_POST['price'],
            $_POST['colour'],
            $_POST['transmission'],
            $_POST['nb_seats'],
            $image,             // Use the path of the uploaded image
            $_POST['status']
        );
        //var_dump($car);
        $carC->addcar($car); // Assuming this adds the car to the database
        header('Location: index.php'); // Redirect to index.php after adding the car
        exit;
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Input Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Car Input Form</h2>
    <form method="post" action="" enctype="multipart/form-data" class="p-4 border rounded shadow-sm">
        <!-- Brand -->
        <div class="mb-3">
            <label for="brand" class="form-label">Brand (All Caps)</label>
            <input type="text" class="form-control" id="brand" name="brand" required>
        </div>

        <!-- Model -->
        <div class="mb-3">
            <label for="model" class="form-label">Model (Exclude: !, @, #, $, %, ^, &, *, (, ))</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price (Float)</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>

        <!-- Colour -->
        <div class="mb-3">
            <label for="colour" class="form-label">Colour (Actual Colour)</label>
            <input type="text" class="form-control" id="colour" name="colour" required>
        </div>

        <!-- Number of Seats -->
        <div class="mb-3">
            <label for="nb_seats" class="form-label">Number of Seats</label>
            <select class="form-select" id="nb_seats" name="nb_seats" required>
                <option value="2">2</option>
                <option value="5">5</option>
            </select>
        </div>

        <!-- Transmission -->
        <div class="mb-3">
            <label for="transmission" class="form-label">Transmission</label>
            <select class="form-select" id="transmission" name="transmission" required>
                <option value="1">Automatic</option>
                <option value="2">Manual</option>
            </select>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
            </select>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image (PNG, JPG)</label>
            <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Back to Index</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
