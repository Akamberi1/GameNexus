<?php session_start(); ?>
<?php
include_once '../../Back-end/Database/Database.php';
include_once '../../Back-end/Product/product.php';

// Create an instance of the Database class
$db = new Database();

// Get the database connection
$conn = $db->getConnection();

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']); // Convert to integer for security

    $imageQuery = "SELECT image_filename FROM product_images WHERE product_id = " . $productId . " ORDER BY image_order";

    // Execute the query
    $imageResult = $conn->query($imageQuery);

    // Initialize an array to hold the image filenames
    $images = [];

    // Loop through the result set and add each image filename to the array
    while ($row = $imageResult->fetch_assoc()) {
    $images[] = $row['image_filename'];
    }

    $productObj = new Product();
    $product = $productObj->getProductById($productId);

    if (!$product) {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}

$reviewQuery = "SELECT reviews.*, users.username FROM reviews
                JOIN users ON reviews.user_id = users.id
                WHERE reviews.product_id = $productId
                ORDER BY reviews.created_at DESC";

$reviewResult = $conn->query($reviewQuery);

if ($reviewResult->num_rows > 0) {
    $reviews = [];
    while ($review = $reviewResult->fetch_assoc()) {
        $reviews[] = $review;
    }
} else {
    $reviews = [];
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Product-details/product-details.css">
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
        <!-- <div class="featured">
            <h1>Featured</h1>
        </div> -->
        <div class="content">
            <div class="title-game">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
            </div>
            <div class="game">
                <div class="left-side">
                    <div class="main-image">
                        <img src="<?php echo $images[0]; ?>" alt="dark souls first image">
                    </div>
                    <div class="side-images">
                        <div class="div-image">
                            <img src="<?php echo $images[1]; ?>" alt="dark-souls pic 2">
                        </div>
                        <div class="div-image">
                            <img src="<?php echo $images[2]; ?>" alt="dark-souls pic 3">
                        </div>
                        <div class="div-image">
                            <img src="<?php echo $images[3]; ?>" alt="dark-souls pic 3">
                        </div>
                        <div class="div-image">
                            <img src="<?php echo $images[4]; ?>" alt="dark-souls pic 4">
                        </div>
                        <div class="div-image">
                            <img src="<?php echo $images[5]; ?>" alt="dark-souls pic 5">
                        </div>
                    </div>
                </div>
                <div class="right-side">
                    <div class="image-description">
                        <img src="<?php echo $images[6]; ?>" alt="dark souls final image">
                        <p><?= htmlspecialchars($product['description']) ?></p>
                    </div>
                    <div class="reviews">
                        <div class="review-left-side">
                         
                            <p>Release date:</p>
                            <div class="tgth">
                                <p>Developer:</p>
                                <p>Publisher:</p>
                            </div>
                        </div>
                        <div class="review-right-side">
                      
                            <p><?= htmlspecialchars($product['release_date']) ?></p>
                            <div class="tgth extra">
                                <p><?= htmlspecialchars($product['developer']) ?></p>
                                <p><?= htmlspecialchars($product['publisher']) ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="categories">
                        <div class="cat">
                            <p>Souls-like</p>
                        </div>
                        <div class="cat" id="special">
                            <p>Dark fantasy</p>
                        </div>
                        <div class="cat">
                            <p>Difficult</p>
                        </div>
                        <div class="cat">
                            <p>Rpg</p>
                        </div>
                        <div class="cat">
                            <p>Co-op</p>
                        </div>
                    </div> -->
                </div>
            </div>

        </div>
        <div class="overlay"></div>
        <div class="buy">
            <div class="buy-text-div">
                <p class="buy-text">
                    Buy <?= htmlspecialchars($product['name']) ?>
                </p>
            </div>
            <div class="add-to-cart">
                <div class="price">
                    <p><?= htmlspecialchars($product['price']) ?>$</p>
                </div>
                <div class="text">
                <form action="../../Back-end/Cart/cart_functionality.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <button type="submit" class="add-to-cart-btn" name="add_to_cart">Add to Cart</button>
                </form>
                </div>
            </div>
            <div class="windows">
                <img src="../images/windows.png" alt="windows-log">
            </div>
        </div>

        <div class="about-this-game">
            <div class="h3-reviews">
                <h3>About this game</h2>
            </div>
            <p class="p-about p1-about"><?= htmlspecialchars($product['description']) ?></p><br>
            <div class="line-under-h3"></div>
        </div>
        <div class="the-reviews">
            <div class="h3-reviews final-review">
                <h3>Reviews</h2>
                <?php if (isset($_SESSION['username'])){ ?>
                    <div class="add-btn"><img src="../images/add-review-logo.png" alt="add logo"></div>
                <?php } else { ?>
                 <!-- <p>You must be logged in to leave a review.</p> -->
                <?php } ?>
            </div>
            <div class="line-under-h3"></div>
        </div>
        <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review">
                <div class="Text">
                    <div class="review-header">
                        <p><strong><?= htmlspecialchars($review['username']) ?></strong> - 
                        <?= $review['created_at']?></p>
                    </div>
                    <div class="review-text">
                        <p><?= nl2br(htmlspecialchars($review['review_text'])) ?></p>
                    </div>
                </div>
                <div class="review-image">
                        <img src="../images/<?= htmlspecialchars($review['image']) ?>" alt="Review Image" />
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-reviews-yet">No reviews yet. Be the first to review this game!</p>
    <?php endif; ?>
        
    <div class="review-form">
        <h3 id="leave-review-h3">Leave a Review</h3>
        <form action="../../Back-end/Reviews/submit_review.php" method="POST" enctype="multipart/form-data" id="ur-review-form">
            <input type="hidden" name="product_id" value="<?= $productId; ?>">
            <textarea name="review_text" placeholder="Write your review..." required></textarea>
            <input type="file" name="review_image" accept="image/*">
            <button type="submit">Submit Review</button>
        </form>
    </div>
    </main>
    <div class="featured-2">
            <div class="line-under-h3 another-line"></div>
            <div class="head-2">
                <h3>Similar games</h3S>
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
                            </div>';
                        }
                    } else {
                        echo "No products found.";
                    }
                }

            
                echo '<div class="flex-1">';
                displayProducts(0);
                echo '</div>';

                
                echo '<div class="flex-1">';
                displayProducts(4);
                echo '</div>';

                echo '<div class="flex-1">';
                displayProducts(8);
                echo '</div>';

                ?>
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
    <script src="../Product-details/product-details.js"></script>
    <script src="../general-functions/functions.js"></script>
</body>

</html>