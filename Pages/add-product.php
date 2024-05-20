<?php
include '../DataBase.php';

if (isset($_POST['upload'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle the image upload
    $image = $_FILES['image']['tmp_name'];
    $imgContent = file_get_contents($image);

    // Insert data into the database
    $query = "INSERT INTO products (name, price, description, image) VALUES (:name, :price, :description, :image)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $imgContent, PDO::PARAM_LOB);

    if ($stmt->execute()) {
        header("Location: ../products.php");
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/add-product.css">
    <title>Upload Product</title>
</head>
<body>
    <h2>Upload a Product</h2>
    <form action="add-product.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" placeholder="name"><br><br>
        <label for="image">Product Image:</label><br>
        <input type="file" id="image" name="image"><br><br>
        <label for="price">Product Price:</label><br>
        <input type="text" id="price" name="price" placeholder="$price"><br><br>
        <label for="description">Product Description:</label><br>
        <textarea id="description" name="description" placeholder="description"></textarea><br><br>
        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>
