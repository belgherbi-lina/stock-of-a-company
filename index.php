<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style/Main.css">
    <title>Home Page</title>
</head>
<body>
    <header>
        <?php include './Pages/navigation.php' ?>
        <section class="section-hero">
            <div class="image">
            <img src="./Images/naturel-product.png" alt="">
            </div>
            <div class="text">
            <h2 class="hero-title">The Organic Store <span>Skin Care</span></h2>
            <p>we know that washing your face is the most important part of any skincare routine ,but we all use different products to get the job</p>
            <a href="products.php" class="btn-primary">

                    <span>Shop Now</span>
                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </a>
            </div>
        </section>
    </header>
     
    <section class="benefits">
      <h2>Benefits</h2>
      <div class="benefit">
        <div class="benefit-1">
            <img src="./Images/tax-free-price.jpg" alt="">
            <p>Tax-free prices on everything</p>
        </div>
        <div class="benefit-2">
          <img src="./Images/SSLTechnology.jpg" alt="">
          <p>Shop with confidence</p>
        </div>
         <div class="benefit-3">
            <img src="./Images/naturel.jpg" alt="">
            <p>100% naturel ingredients</p>
        </div>
        <div class="benefit-4">
            <img src="./Images/30days.jpg" alt="">
            <p>Easy refunds 30-day money back</p>
        </div>
    </div>
    </section>

    <section id="about" class="about-us">
        <div class="about-img">
        <img src="./Images/skin-model.jfif" alt="" >
        </div>
        <div class="about-text">
        <h2>About Us</h2>
        <p>Welcome to the Web top spot for Natural Beauty products. Unlock the hidden beauty secrets and enjoy a younger face and body.</p>
        <p>Shed years the natural way and see the results for yourself. Experience younger-looking, soft supple skin from head to toe.</p>
        <p>The line blends pure natural ingredients with organic es- sential oils ato create products that are holistic as well as effective.</p>
    </div>
</section>
    <?php include './Pages/Footer.php' ?>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html> 
