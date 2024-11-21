<?php
include "../../../config/connect.php";

if (isset($_POST['packageName'])) {
    $packageName = $_POST['packageName'];

    $stmt = $conn->prepare("SELECT * FROM packages WHERE name = ?");
    $stmt->bind_param("s", $packageName); // "s" denotes string
    $stmt->execute();
    
    $result = $stmt->get_result();
    $packageData = $result->fetch_assoc();
    
    if ($packageData) {
        // Return the package data as a JSON response
        echo json_encode($packageData);
    } else {
        echo json_encode(['error' => 'Package not found']);
    }
    
    $stmt->close();
    $conn->close();
}
?>
