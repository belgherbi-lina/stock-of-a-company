<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: .php");
    exit();
}

// Include the database connection file
include 'DataBase.php';
include './Pages/navigation.php';

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
    header("Location: admin-dashboard.php");
    exit();
}
if(isset($_POST['add_user'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Perform validation and sanitation
    // Insert new user into the database
    $stmt = $db->prepare("INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)");
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    // Redirect to refresh the page after addition
    header("Location: admin-dashboard.php");
    exit();
}

if(isset($_POST['modify_user'])) {
    $id = $_POST['id'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $db->prepare("UPDATE users SET pseudo = :pseudo, email = :email, password = :password WHERE id = :id");
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    // Redirect to refresh the page after modification
    header("Location: admin-dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style/admin-dashboard.css">
    <link rel="stylesheet" href="./Style/Navigation.css">
    <title>Admin Dashboard</title>
</head>
<body>
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
            <td class="delete-btn">
                <ion-icon name="pencil-outline"></ion-icon>
                <a href="Pages/modify-user.php?id=<?= $user['id'] ?>">Modify</a>
                
                <ion-icon name="trash-outline"></ion-icon>
                <a href="?delete=<?= $user['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <form action="" method="post">
                <td></td>
                <td><input type="text" name="pseudo" placeholder="Username" ></td>
                <td><input type="email" name="email" placeholder="Email"></td>
                <td><input type="password" name="password" placeholder="Password"></td>
                <td></td>
                <td class="add-btn"><button type="submit" name="add_user">Add User</button></td>
            </form>
        </tr>
    </table>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>  
</body>
</html>
