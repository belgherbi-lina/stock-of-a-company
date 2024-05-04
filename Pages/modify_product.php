<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "Admin") {
    // Retrieve product ID from GET data
    $product_id = $_GET['product_id'];


} else {
    echo "Unauthorized access or invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/modify-product.css">
    <title>Modify Product</title>
</head>
<body>
    <h2>Modify Product</h2>
    <?php
    // Check if product ID is provided
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        // Retrieve product details from the database based on the product ID
        // Perform database query and fetch product details
        // Display product details in the form
        echo '<form action="update_product.php" method="post">';
        echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
        echo 'New Name: <input type="text" name="new_name"><br>';
        echo 'New Price: <input type="text" name="new_price"><br>';
        echo '<input type="submit" value="Update Product">';
        echo '</form>';
    } else {
        echo "Product ID not provided.";
    }
    ?>
</body>
</html>