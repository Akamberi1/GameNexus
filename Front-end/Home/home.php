<?php session_start()?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Home/home.css">
</head>
<body>
    <div class="loginSignupPop">
        <div class="lS login-click">
            <p>Log in</p>
        </div>
        <hr id="pop-line">
        <div class="lS signup-click">
            <p>Signup</p>
        </div>
        <div class="triangle"></div>
    </div>
    <div class="cart-notification-circle">
        <p class="cart-notification-p"></p>
    </div>
    <header class="header">
        <div class="logo">
            <img src="#" alt="logo-img" id="logo1">
        </div>
        <nav class="right">
            <a href="../Home/home.html">home</a>
            <a href="../Categories/Categories.html">categories</a>
            <a href="../About/about.html">About us</a>
            <a href="../Contact-us/faq.html">Contact us</a>
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
                <img src="../images/hero_capsule.jpg" alt="Hades 2" class="slide product">
                <img src="../images/dragonDogma.jpg" alt="Dragon Dogma" class="slide product">
                <img src="../images/dark-souls3.jpg" alt="Dark souls 3" class="slide product">
            </div>
            <div class="button-sliders">
                <button class="buttons prev">&#10094;</button>
                <button class="buttons next">&#10095;</button>
            </div>
            <div></div>
        </div>

        <div class="featured-2">
            <div class="head-2">
                <h1>Featured Deep Discounts</h1>
                <p>Don't miss out on these amazing offers!</p>
            </div>
            <div class="products">
                <div class="flex-1">
                    <div class="flex-item product">
                        <img src="../images/battlefield2042.jpg" alt="battlefield2042">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
        
                    </div>
                    <div class="flex-item product">
                        <img src="../images/jedi.jpg" alt="jedi survivor">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-item product">
                        <img src="../images/resident-evil.jpg" alt="resident-evil">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-item product">
                        <img src="../images/nobody.jpg" alt="">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex-2">
                    <div class="flex-item product">
                        <img src="../images/cod3.jpg" alt="cod6">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
        
                    </div>
                    <div class="flex-item product">
                        <img src="../images/forza.jpg" alt="forza">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-item product">
                        <img src="../images/hades.jpg" alt="hades">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex-item product">
                        <img src="../images/horizon.jpg" alt="horizon">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
        
                    </div>
                    <div class="flex-item product">
                        <img src="../images/terraria.jpg" alt="terraria">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-item product">
                        <img src="../images/warhammer.jpg" alt="warhammer">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-item product">
                        <img src="../images/it-takes-two.jpg" alt="">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex-2">
                    <div class="flex-item product">
                        <img src="../images/fifa.jpg" alt="cod6">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
        
                    </div>
                    <div class="flex-item product">
                        <img src="../images/mass-efect.jpg" alt="forza">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-item product">
                        <img src="../images/outer-wilds.jpg" alt="hades">
                        <div class="discount">
                            <div class="discount-now">
                                <p>25%</p>
                            </div>
                            <div class="price-now">
                                <div class="diagonal-line"></div>
                                <p class="grey-p">23,99$</p>
                                <p class="white-p">17,99$</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <div class="info">
            <div class="footer-image">
                <img src="../images/valve-logo.jpg" alt="example-logo">
            </div>
            <div class="footer-p">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque</p>
                <div class="p-link">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque</p>
                    <div class="links">
                        <a href="../Home/home.html">Home</a>
                        <a href="../Categories/Categories.html">Categories</a>
                        <a href="../About/about.html">About us</a>
                        <a href="../Contact-us/faq.html">Contact us</a>
                    </div>
                </div>
            </div>
            <div class="socials">
                <img src="../images/facebook-logo-removebg-preview.png" alt="facebook-logo">
                <img src="../images/insta2-removebg-preview.png" alt="twitter-logo">
                <img src="../images/twitter.png" alt="instagram-logo" id="twitter">
            </div>
        </div>
    </footer>
    <script src="../Home/home.js"></script>
    <script src="../general-functions/functions.js"></script>
</body>
</html> -->


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
    <div class="loginSignupPop">
        <div class="lS login-click">
            <p>Log in</p>
        </div>
        <hr id="pop-line">
        <div class="lS signup-click">
            <p>Signup</p>
        </div>
        <div class="triangle"></div>
    </div>
    <div class="cart-notification-circle">
        <p class="cart-notification-p"></p>
    </div>
    <header class="header">
        <div class="logo">
            <img src="#" alt="logo-img" id="logo1">
        </div>
        <nav class="right">
            <a href="../Home/home.html">home</a>
            <a href="../Categories/Categories.html">categories</a>
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

                $query = "SELECT * FROM products LIMIT 3";
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
                <h1>Featured Deep Discounts</h1>
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
                                    <div class="discount-now">
                                        <p>25%</p>
                                    </div>
                                    <div class="price-now">
                                        <div class="diagonal-line"></div>
                                        <p class="grey-p">$' . $price . '</p>
                                        <p class="white-p">$' . number_format($product['price'] * 0.75, 2) . '</p>
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
            <div class="footer-image">
                <img src="../images/valve-logo.jpg" alt="example-logo">
            </div>
            <div class="footer-p">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque</p>
                <div class="p-link">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque</p>
                    <div class="links">
                        <a href="../Home/home.html">Home</a>
                        <a href="../Categories/Categories.html">Categories</a>
                        <a href="../About/about.html">About us</a>
                        <a href="../Contact-us/faq.html">Contact us</a>
                    </div>
                </div>
            </div>
            <div class="socials">
                <img src="../images/facebook-logo-removebg-preview.png" alt="facebook-logo">
                <img src="../images/insta2-removebg-preview.png" alt="twitter-logo">
                <img src="../images/twitter.png" alt="instagram-logo" id="twitter">
            </div>
        </div>
    </footer>

    <script src="../Home/home.js"></script>
    <script src="../general-functions/functions.js"></script>
</body>
</html>
