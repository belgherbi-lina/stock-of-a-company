<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "Admin") {
    // Database connection
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "website";

    // Create connection
    $conn = new mysqli($server, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve product ID from POST data
    $product_id = $_POST['product_id'];

    // Prepare SQL statement to delete product
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../products.php");
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    echo "Unauthorized access.";
}
?>
