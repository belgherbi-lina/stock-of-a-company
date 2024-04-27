<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "root";
    $password = "";
    try {
        $db = new PDO("mysql:host=localhost;dbname=website", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare SQL query to insert new user
        $stmt = $db->prepare("INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        // Execute the query
        $stmt->execute();

        // Set session variable for the newly signed up user
        $_SESSION['pseudo'] = $pseudo;

        // Redirect to home page or any other desired page
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/Login.css">
    <title>SignUp Page</title>
</head>
<body>
    <div class="signup-box">
      <h1>Sign Up</h1>
      <h4>It's free and only takes a minute</h4>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="pseudo">Name</label>
        <input  type="text" id="pseudo" name="pseudo" required />
        <label  for="email">Email</label>
        <input type="email" id="email" name="email" required />
        <label  for="password">Password</label>
        <input  type="password" id="password" name="password" required/>
        <label  for="password" >Confirm Password</label>
        <input type="password" id="password" name="password" required/>
        <input type="submit" class="b" value="Sign Up" />
      </form>
      <p>
        By clicking the Sign Up button,you agree to our <br />
        <a href="#">Terms and Condition</a> and <a href="#">Policy Privacy</a>
      </p>
    </div>
    <p class="para-2">
      Already have an account? <a href="login.php">Login here</a>
    </p>
</body>
</html>
