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

    // Process the other form fields
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Process the image upload
    $image = $_FILES['image'];
    $img_name = $image['name'];
    $img_tmp = $image['tmp_name'];
    $img_size = $image['size'];

    // Check if image is uploaded
    if ($img_tmp) {
        // Get image data
        $img_data = addslashes(file_get_contents($img_tmp));
        // Prepare SQL statement to insert data into the table
        $stmt = $conn->prepare("INSERT INTO products (image, name, price, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("bssd", $img_data, $name, $price, $description); // Use 'd' for double (price)

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: ../products.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "Error uploading image.";
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/add-product.css">
    <title>Image Upload</title>
</head>
<body>
    <h2>Upload a Product</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" placeholder="name"><br><br>
        <label for="image">Product Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*"><br><br> <!-- accept="image/*" restricts to image files -->
        <label for="price">Product Price:</label><br>
        <input type="text" id="price" name="price" placeholder="$price"><br><br>
        <label for="description">Product Description:</label><br>
        <textarea id="description" name="description" placeholder="description"></textarea><br><br>
        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>
