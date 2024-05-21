<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "root";
    $password = "";
    try {
        $db = new PDO("mysql:host=localhost;dbname=website", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Prepare SQL query to check if user exists
        $stmt = $db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        
        // Execute the query
        $stmt->execute();
        
        // Check if a user with the provided email and password exists
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($email == "Skincare@gmail.com" && $password === "skincare") {
          // Set session variables to identify admin user
          $_SESSION['admin'] = true;
      }
        if ($user) {
            // User exists, set session variables and redirect to home page
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['pseudo'] = $user['pseudo']; // Store user's pseudo in session
            header("Location: ../index.php");
            exit();
      
        } else {
            // User doesn't exist or invalid credentials
            $error = "Invalid email or password";
        }
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
    <title>LogIn Page</title>
</head>
  <body>
    <div class="login-box">
      <h1>Login</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <label>Email</label>
          <input type="email" id="email" name="email" required/>
          <label>Password</label>
          <input type="password" id="password" name="password" required />
          <input type="submit" class="b" value="Submit" />
       </form>
       <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
    </div>
    <p class="para-2">
      Not have an account? <a href="Signup.php">Sign Up Here</a>
    </p>
  </body>
</html> 