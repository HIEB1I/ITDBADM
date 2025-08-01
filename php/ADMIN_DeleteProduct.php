<?php
session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] == 'Customer') {
  exit("Access denied.");
}

require_once 'db_connect.php';

if (!isset($_GET['productID'])) {
    exit("No product ID provided.");
}

$productID = $_GET['productID'];


// Prepare and execute deletion
$stmt = $conn->prepare("DELETE FROM PRODUCT WHERE productID = ?");
$stmt->bind_param("s", $productID);

if ($stmt->execute()) {
    header("Location: ADMIN_Dashboard.php");
    exit();
} else {
    echo "Failed to delete product. Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
