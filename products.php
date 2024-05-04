<?php
session_start();

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

// SQL query to select all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style/products.css">
    <link rel="stylesheet" href="./Style/navigation.css">
    <title>Product</title>
</head>
<body>
    <?php include './Pages/navigation.php'?>
    <h1>All Products</h1>
    <div class="container">
        <div class="products">
            <?php
            // Check if there are any products
            if ($result->num_rows > 0) {
                // Output data of each row using while loop
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-card">';
                    if (!empty($row["image"])) {
                        $imageData = base64_encode($row["image"]);
                        echo '<img src="data:image/jpeg;base64,' . $imageData . '">';
                    } else {
                        echo '<img src="placeholder-image.jpg" alt="Placeholder Image">';
                    }
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p>$' . $row["price"] . '</p>';
                    echo '<p>' . $row["description"] . '</p>';
                    if (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "Admin") {
                        echo '<form action="./Pages/delete_product.php" method="post">';
                        echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                        echo '<button type="submit"><ion-icon name="trash-outline"></ion-icon>Delete</button>';
                        echo '</form>';
                        
                        echo '<form action="./Pages/modify_product.php" method="get">';
                        echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                        echo '<button type="submit"><ion-icon name="create-outline"></ion-icon>Modify</button>';
                        echo '</form>';
                    }
                    echo '</div>';
                }
            } else {
                echo "No products found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
// Close connection
$conn->close();
?>
