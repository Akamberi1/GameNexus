<?php session_start()?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Home/home.css">
</head>
<?php if (isset($_SESSION['username'])){ ?>
    <div class="user-info">
        <p>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
        <form action="../../Back-end/login/logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>

<?php } ?>
<body>
    <div class="overlay"></div>
    <div class="loginSignupPop">
        <div class="lS login-click">
            <p>Log in</p>
        </div>
        <hr id="pop-line">
        <div class="lS signup-click">
            <p>Signup</p>
        </div>
    </div>
    <div class="cart-notification-circle">
        <p class="cart-notification-p"></p>
    </div>
    <header class="header">
        <div class="logo">
            <img src="../images/GameNexusLogo.png" alt="logo-img" id="logo1">
        </div>
        <nav class="right">
            <a href="../Home/home.php">home</a>
            <a href="../Categories/Categories.php">categories</a>
            <a href="../About/about.html">About us</a>
            <a href="../Contact-us/faq.php">Contact us</a>
        </nav>
        <div class="right-elements">
            <img src="../images/shopping_cart_21dp_C7D5E0_FILL0_wght400_GRAD0_opsz20.png"
                 alt="shopping-cart-icon" class="shopping-logo">
            <img src="../images/person_24dp_C7D5E0_FILL0_wght400_GRAD0_opsz24.png" alt="profile-icon"
                 class="profile-logo">
        </div>
    </header>
    <main>
        <div class="featured">
            <h1>Featured</h1>
        </div>

        <div class="slider-container">
            <div class="slider">
                <?php 
                include_once '../../Back-end/Database/Database.php';

                $db = new Database();
                $conn = $db->getConnection();

                $query = "SELECT * FROM products LIMIT 6";
                $result = $conn->query($query);


                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        $imageQuery = "SELECT image_filename FROM product_images WHERE product_id = " . $product['id'] . " ORDER BY image_order LIMIT 1";
                        $imageResult = $conn->query($imageQuery);
                        $image = $imageResult->fetch_assoc()['image_filename'];
                        
                        echo '
                        <a href="../Product-details/product-details.php?id=' . $product['id'] . '" class="carousel-linqet">
                        <img src="' . $image . '" alt="'.$product['name'].'" class="slide product carousel-imazhet">
                        </a>
                        ';
                    };
                };
                ?>
            </div>
            <div class="button-sliders">
                <button class="buttons prev">&#10094;</button>
                <button class="buttons next">&#10095;</button>
            </div>
        </div>

        <div class="featured-2">
            <div class="head-2">
                <h1 class="fdd">Featured Deep Discounts</h1>
                <p>Don't miss out on these amazing offers!</p>
            </div>
            <div class="products">
                <?php
                // Include the database connection file
                include_once '../../Back-end/Database/Database.php'; 

                // Create a new database connection
                $db = new Database();
                $conn = $db->getConnection();

                // Function to fetch and display products
                function displayProducts($offset, $limit = 4) {
                    global $conn;
                    $productQuery = "SELECT * FROM products LIMIT $limit OFFSET $offset";
                    $productResult = $conn->query($productQuery);

                    if ($productResult->num_rows > 0) {
                        while ($product = $productResult->fetch_assoc()) {
                            // Get the first image for each product
                            $imageQuery = "SELECT image_filename FROM product_images WHERE product_id = " . $product['id'] . " ORDER BY image_order LIMIT 1";
                            $imageResult = $conn->query($imageQuery);
                            $image = $imageResult->num_rows > 0 ? $imageResult->fetch_assoc()['image_filename'] : 'default-image.jpg';

                            // Format the price
                            $price = number_format($product['price'], 2);

                            echo '
                            
                            <div class="flex-item product">
                            <a href="../Product-details/product-details.php?id=' . $product['id'] . '" class="linqet">
                                <img src="../images/' . $image . '" alt="' . htmlspecialchars($product['name']) . '" class="imazhet">
                            </a>
                                <div class="discount">
                                    <div class="price-now">
                                  
                                        <p class="white-p">$' . $price . '</p>
                                    </div>
                                </div>
                            </div>';
                        }
                    } else {
                        echo "No products found.";
                    }
                }

                // Display first row of products (products 1-4)
                echo '<div class="flex-1">';
                displayProducts(0);
                echo '</div>';

                // Display second row of products (products 5-8)
                echo '<div class="flex-1 flex-2">';
                displayProducts(4,3);
                echo '</div>';

                // Display third row of products (products 9-12)
                echo '<div class="flex-1">';
                displayProducts(7);
                echo '</div>';

                // Display fourth row of products (products 13-16)
                echo '<div class="flex-1 flex-2">';
                displayProducts(11,3);
                echo '</div>';
                ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="info">
            <!-- <div class="footer-image">
                <img src="../images/valve-logo.jpg" alt="example-logo">
            </div> -->
            <div class="footer-p">
                <p>© 2025 GameStore Inc. All rights reserved.</p>
                <div class="p-link">
                    <div class="links">
                        <a href="../Home/home.php">Home</a>
                        <a href="../Categories/Categories.php">Categories</a>
                        <a href="../About/about.html">About us</a>
                        <a href="../Contact-us/faq.php">Contact us</a>
                    </div>
                </div>
            </div>
            <div class="socials">
                <img id="facebook" src="../images/facebook-logo-removebg-preview.png" alt="facebook-logo">
                <img id="instagram" src="../images/insta2-removebg-preview.png" alt="twitter-logo">
                <img id="twitter" src="../images/twitter.png" alt="instagram-logo" id="twitter">
            </div>
        </div>
    </footer>

    <script src="../Home/home.js"></script>
    <script src="../general-functions/functions.js"></script>
</body>
</html>
