<?php session_start()?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Contact-us/faq.css">
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
    <div class="faqNForm">
        <main>
            <div class="headings">
                <!-- <h2 class="help-h2">Help</h2> -->
                <h3 class="popular-questions-p">Frequently asked questions</h3>
            </div>
            <div class="questions">
                <div class="answers">
                    <div class="header-title">
                        <p class="answers-p"> What is game nexus?</p>
                        <div class="down-image">
                            <img src="../images/arrow_drop_down_45dp_E8EAED_FILL0_wght400_GRAD0_opsz48.svg"
                                alt="down-button">
                        </div>
                    </div>
                    <div class="extra-description">
                        <p class="description"> GameNexus is an online game store platform that offers a seamless digital marketplace for gaming enthusiasts. It allows users to browse, purchase, and manage their game libraries, similar to platforms like Steam.</p>
                    </div>
                </div>
                <div class="answers">
                    <div class="header-title">
                        <p class="answers-p"> If i contact u when will i expect to hear?</p>
                        <div class="down-image">
                            <img src="../images/arrow_drop_down_45dp_E8EAED_FILL0_wght400_GRAD0_opsz48.svg"
                                alt="down-button">
                        </div>
                    </div>
                    <div class="extra-description">
                        <p class="description"> We usually reply within 2 days.</p>
                    </div>
                </div>
                <div class="answers">
                    <div class="header-title">
                        <p class="answers-p"> Who developed GameNexus?</p>
                        <div class="down-image">
                            <img src="../images/arrow_drop_down_45dp_E8EAED_FILL0_wght400_GRAD0_opsz48.svg"
                                alt="down-button">
                        </div>
                    </div>
                    <div class="extra-description">
                        <p class="description"> GameNexus was developed by Arlindi and Eriona.</p>
                    </div>
                </div>
                <div class="answers">
                    <div class="header-title">
                        <p class="answers-p">Are u hiring right now?</p>
                        <div class="down-image">
                            <img src="../images/arrow_drop_down_45dp_E8EAED_FILL0_wght400_GRAD0_opsz48.svg"
                                alt="down-button">
                        </div>
                    </div>
                    <div class="extra-description">
                        <p class="description"> As of now we do not need new members in our crew, however be sure to check in on us on the future for possible positions!</p>
                    </div>
                </div>
            </div>
        </main>
        <section class="contact-us">
            <form action="../../Back-end/Contact/contact_form.php" method="post" class="theForm" id="contact-us-form">
                <h2 class="contact-p">Contact Us</h2>
                <div class="child">
                    <label for="username">Username</label>
                    <input class="inputs" name="username" type="text" id="username">
                </div>
                <div class="child">
                    <label for="email">Email Address</label>
                    <input class="inputs" name="email" type="email" id="email">
                </div>
                <div class="child">
                    <label for="subject">Subject</label>
                    <input class="inputs" name="Subject" type="text" id="subject">
                </div>
                <div class="child area-container">
                    <label class="txt-label" for="message">What can we help with?</label>
                    <textarea class="inputs textarea" name="message" id="message"></textarea>
                </div>
                <input type="hidden" name="user_id" value="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
                <button type="submit" id="submit-contact-btn">Submit</button>
            </form>
        </section>
    </div>
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
    <script src="../Contact-us/faq.js"></script>
    <script src="../general-functions/functions.js"></script>
    <?php if (isset($_SESSION['contact_status'])) { ?>
        <script>
            alert("<?= $_SESSION['contact_status']; ?>");
        </script>
        <?php unset($_SESSION['contact_status']); ?>
    <?php } ?>
</body>

</html>