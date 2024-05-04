<?php
    $username = "";

    if (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] != "root") {
        $username = $_SESSION['pseudo'];
    } else {
        $username = "Login";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style/Navigation.css">
    <title></title>
</head>
<body>
    <div class="container">
        <nav class="navbar" data-navbar>
        <a href="#" class="logo"><img src="./Images/Skin_Care_Logo.png" alt=""></a>
            <ul class="navbar-list">
              <li class="navbar-item">
                <a href="./index.php" class="navbar-link">Home</a>
              </li>
              <li class="navbar-item">
                <a href="#about" class="navbar-link">About</a>
              </li>
              <li class="navbar-item">
                <a href="./products.php" class="navbar-link">Products</a>
              </li>
              <li class="navbar-item">
                <a href="#" class="navbar-link">Shop</a>
              </li>
              <li class="navbar-item">
                <a href="#" class="navbar-link">Blog</a>
              </li>
              <li class="navbar-item">
                <a href="#contact" class="navbar-link">Contact</a>
              </li>
            </ul>
            <ul class="nav-action-list">
              <li>
                <button class="nav-action-btn">
                  <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
                  <span class="nav-action-text">Search</span>
                </button>
              </li>
              <?php if ($username != "Login") : ?>
                    <li>
                        <a href="#" class="nav-action-btn">
                            <span class="nav-action-text"><?= $username ?></span>
                        </a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="./Pages/Login.php" class="nav-action-btn">
                            <ion-icon name="person-outline"></ion-icon>
                            <span class="nav-action-text">Log In</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($username == "Admin") : ?>
                  <li>
                  <a  href="./admin-dashboard.php" class="nav-action-btn">
                  <ion-icon name="settings-outline"></ion-icon>
                  </a>
                </li>
                <li>
                  <a  href="./Pages/add-product.php" class="nav-action-btn">
                  <ion-icon name="add-circle-outline"></ion-icon>
                  </a>
                </li>
              <?php else : ?>
              <li>
                <button class="nav-action-btn">
                  <ion-icon name="heart-outline" aria-hidden="false"></ion-icon>
                </button>
              </li>
              <li>
                <button class="nav-action-btn">
                  <ion-icon name="bag-outline" aria-hidden="true"></ion-icon>
                </button>
              </li>
              <?php endif; ?>
              <?php if ($username != "Login") : ?>
                    <li>
                        <a href="./Pages/logout.php" class="nav-action-btn">

                            <span class="nav-action-text">Logout</span>
                            <ion-icon name="log-out-outline"></ion-icon>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        
        </nav>
        </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
