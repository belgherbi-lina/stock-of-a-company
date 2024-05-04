<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: .php");
    exit();
}

// Include the database connection file
include '../DataBase.php';
include 'navigation.php';
// Fetch the user's ID from the query parameter
if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
    // Fetch user details from the database
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirect if user ID is not provided
    header("Location: ../admin-dashboard.php");
    exit();
}

// Update user details if form is submitted
if(isset($_POST['modify_user'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $db->prepare("UPDATE users SET pseudo = :pseudo, email = :email, password = :password WHERE id = :id");
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    // Redirect to admin dashboard after modification
    header("Location: ../admin-dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/admin-dashboard.css">
    <link rel="stylesheet" href="../Style/navigation.css">
    <link rel="stylesheet" href="../Style/modify-user.css">
    <title>Modify User</title>
</head>
<body>
    <h1>Modify User</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <label for="pseudo">Username:</label>
        <input type="text" id="pseudo" name="pseudo" value="<?= $user['pseudo'] ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?>">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= $user['password'] ?>">
        <button type="submit" name="modify_user">Save Changes</button>
    </form>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
