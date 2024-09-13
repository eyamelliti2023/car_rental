<?php
    session_start();
    include '../../Controller/controller.php';
    include '../../model/car.php';
    $id=$_GET["id"];
    $carC = new carC();
    $car= $carC->showcar($id);
    if ($car) {
        // Get the image path from the car details
        $imagePath = $car['image'];
    
        // Check if the image file exists and delete it
        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath); // Deletes the file from the server
        }
    
        // Delete the car from the database
        $carC->deletecar($id);
    }
    header('Location: index.php');
    exit();
  