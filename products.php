<?php
session_start();

// Include the database connection file
include 'DataBase.php';

// SQL query to select all products
$sql = "SELECT * FROM products";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            if ($stmt->rowCount() > 0) {
                // Output data of each row using foreach loop
                foreach ($result as $row) {
                    echo '<div class="product-card">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="' . $row["name"] . '">';
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
$con = null;
?>
