<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Retrieve form data
    $product_id = $_POST['product_id'];
    $new_name = $_POST['new_name'];
    $new_price = $_POST['new_price'];

    if(!$new_name ){
        $sql = "UPDATE products SET price='$new_price' WHERE id=$product_id";
       // Prepare SQL statement to update product attributes
    }else {
        $sql = "UPDATE products SET name='$new_name' WHERE id=$product_id";
    }
    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        header("Location: ../products.php");
    } else {
        echo "Error updating product: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
