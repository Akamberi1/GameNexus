<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Categories/Categories.css">
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
    </div>
    <div class="cart-notification-circle">
        <p class="cart-notification-p"></p>
    </div>
    <header class="header">
        <div class="logo">
            <a href="../Home/home.php"><img src="../images/gamenexus-logo.png" alt="logo-img" id="logo1"></a>
        </div>
        <nav class="right">
            <a href="../Home/home.php">Home</a>
            <a href="../Categories/Categories.php">Categories</a>
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
    <section class="main">
    <section class="headers"></section>
        <div class="featured">
            <h2>Categories</h2>
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
                        $imageData = $imageResult->fetch_assoc();
                        $image = $imageData ? $imageData['image_filename'] : 'default-image.jpg';
                        
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
        <section>
            <div class="container-sign">
                <p>Sign in to view personalized recommendations</p>
                <button class="sign-in-button"><a style="text-decoration: none; color: aliceblue;" href="../Login/login.php">Sign In</a></button>
                <p>Or <a style="color: #103a86;" href="../Register/registration-form.php" class="sign-up-link">sign up</a> and join Steam for free</p>
            </div>
        </section>
        <div class="carousel carousel-1">
            <h2>Looking For More!</h2>
            <p>Unlock endless gaming adventures right here!</p>
        <div class="carousel-images">
            <img src="../images/delta.jpg" alt="Game 1">
            <img src="../images/cod3.jpg" alt="Game 2">
            <img src="../images/default.webp" alt="Game 3">
            <img src="../images/terraria.jpg" alt="Game 1">
            <img src="../images/forza.jpg" alt="Game 2">
            <img src="../images/warhammer.jpg" alt="Game 3">
        </div>
        </div>
        <div class="featured-2">
            <div class="head-2">
                <h1>New Releases</h1>
                <p>Don't miss out on these amazing games!</p>
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
        
    </section>
    <div class="carousel carousel-2">
            <h2>Coming Soon</h2>
            <p style="position: absolute; top: 13%; left: 34%;">Something epic is Coming... Stay tuned!</p>
        <div class="carousel-images">
            <img src="../images/crme.jpg" alt="Game 1">
            <img src="../images/genshin.jpg" alt="Game 2">
            <img src="../images/minecraft.jpg" alt="Game 3">
            <img src="../images/pubg.jpg" alt="Game 1">
            <img src="../images/rocket.jpg" alt="Game 2">
            <img src="../images/valorant.jpg" alt="Game 3">
        </div>
        </div>
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
                        <a href="../Home/home.php">Home</a>
                        <a href="../Categories/Categories.php">Categories</a>
                        <a href="../About/about.html">About us</a>
                        <a href="../Contact-us/faq.php">Contact us</a>
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
    <script src="../Categories/Categories.js"></script>
    <script src="../general-functions/functions.js"></script>
</body>
</html>
