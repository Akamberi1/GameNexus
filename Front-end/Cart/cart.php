<?php
require_once '../../Back-end/Cart/cart.php';

$cart = new Cart();
$cartItems = $cart->getCart();

$checkoutSuccess = isset($_SESSION['checkout_success']) && $_SESSION['checkout_success'];

if ($checkoutSuccess) {
    // Clear the session flag after showing the alert
    unset($_SESSION['checkout_success']);
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cart.css">
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
        <div class="buy-it">
            <h2 class="shp-h">Your shopping cart</h2>
            <div class="shopping">
                <div class="shopping-section">
                <?php 
                require_once "../../Back-end/Database/Database.php"; // Adjust path if necessary

                $totalPrice = 0;

                $db = new Database();
                $conn = $db->getConnection();
                foreach ($cartItems as $item) : 
                    
                $totalPrice += $item['price']; 



                $imageQuery = "SELECT image_filename FROM product_images WHERE product_id = " . $item['id'] . " ORDER BY image_order LIMIT 1";
                $imageResult = $conn->query($imageQuery);
                $image = $imageResult->fetch_assoc()['image_filename'] ?? 'default.jpg'; // Use a default image if none found

                echo '
                <div class="shopping-product">
                    <div class="shopping-image">
                        <img src="' . $image . '" alt="' . htmlspecialchars($item['name']) . '">
                    </div>
                    <div class="title">
                        <h2>' . htmlspecialchars($item['name']) . '</h2>
                        <img src="../images/windows.png" alt="windows-logo">
                    </div>
                    <div class="priceNdMore">
                        <p>' . htmlspecialchars($item['price']) . '$</p>
                        <div class="addRemove">
                            <div class="remove">
                                <form action="../../Back-end/Cart/cart_functionality.php" method="post">
                                    <input type="hidden" name="product_id" value="' . $item['id'] . '">
                                    <button type="submit" class="add-to-cart-btn" name="remove_from_cart">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
';
                endforeach; 
?>

                    <!-- <div class="shopping-product">
                        <div class="shopping-image">
                            <img src="../images/dark-souls-final.jpg" alt="dark souls image">
                        </div>
                        <div class="title">
                            <h2>Dark souls III</h2>
                            <img src="..//images/windows.png" alt="windows-logo">
                        </div>
                        <div class="priceNdMore">
                            <p>59,99$</p>
                            <div class="addRemove">
                                <div class="add">
                                    <p>Add</p>
                                </div>
                                <div class="remove">
                                    <p>remove</p>
                                </div>
                                <div class="vertical-line"></div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="total">
                    <div class="estimated-p">
                        <p>Estimated total</p>
                        <p><?= number_format($totalPrice, 2) ?></p>
                    </div>
                    <p class="tax-p">Sales tax will be calculated during checkout where applicable</p>
                    <div class="continue-to-payment-btn">
                        <!-- <p>Checkout</p> -->
                        <form action="../../Back-end/Cart/checkout.php" method="post">
                            <button type="submit">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="special-section">
        <div class="shoppingRemove">
            <div class="continue-shopping">
                <p>continue shopping</p>
            </div>
            <form action="../../Back-end/Cart/cart_functionality.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <button type="submit" class="add-to-cart-btn" name="add_to_cart">Remove all items</button>
            </form>
        </div>
    </div>
    <aside>
    <div class="recommended">
        <h2 class="rec-h2">Recommendations For You</h2>
            <div class="products">
                <div class="flex-1">
                    <div class="flex-item product">
                        <img src="../images/battlefield2042.jpg" alt="battlefield2042">
                    </div>
                    <div class="flex-item product">
                        <img src="../images/jedi.jpg" alt="jedi survivor">
                    </div>
                    <div class="flex-item product">
                        <img src="../images/resident-evil.jpg" alt="resident-evil">
                    </div>
                </div>
                <div class="flex-1 flex-2">
                    <div class="flex-item product">
                        <img src="../images/cod3.jpg" alt="cod6">
                    </div>
                    <div class="flex-item product">
                        <img src="../images/forza.jpg" alt="forza">
                    </div>
                </div>
                <div class="flex-1 flex-2 flex-3">
                    <div class="flex-item product">
                        <img src="../images/rainbowSixSiege.jpg">
        
                    </div>
                    <div class="flex-item product">
                        <img src="../images/daysGone.jpg">
                    </div>
                </div>
            </div>
        </div>
    </aside>
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
    <script>
        <?php if ($checkoutSuccess) : ?>
            alert('Your order has been placed successfully!');
        <?php endif; ?>
    </script>
    <script src="cart.js"></script>
    <script src="../general-functions/functions.js"></script>
</body>

</html>