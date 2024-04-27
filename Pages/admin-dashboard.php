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

// Fetch all users from the database
$stmt = $db->prepare("SELECT * FROM users WHERE pseudo != 'Admin'");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Delete user if requested
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    // Redirect to refresh the page after deletion
    header("Location: admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/admin-dashboard.css">
    <link rel="stylesheet" href="../Style/Navigation.css">
    <title>Admin Dashboard</title>
</head>
<body>
    
    <h2>Welcome, Admin</h2>
    <a href="logout.php">Logout</a>
    <h3>Users</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Date access</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['pseudo'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['password'] ?></td>
            <td><?= $user['date'] ?></td>
            <td><ion-icon name="trash-outline"></ion-icon>
                <a href="?delete=<?= $user['id'] ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
