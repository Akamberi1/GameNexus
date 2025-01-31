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
    <div class="faqNForm">
        <main>
            <div class="headings">
                <!-- <h2 class="help-h2">Help</h2> -->
                <h3 class="popular-questions-p">Frequently asked questions</h3>
            </div>
            <div class="questions">
                <div class="answers">
                    <div class="header-title">
                        <p class="answers-p"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
                            feugiat
                            quam ut lacus eleifend, a bibendum nibh malesuada.</p>
                        <div class="down-image">
                            <img src="../images/arrow_drop_down_45dp_E8EAED_FILL0_wght400_GRAD0_opsz48.svg"
                                alt="down-button">
                        </div>
                    </div>
                    <div class="extra-description">
                        <p class="description"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque
                            venenatis nunc viverra tempor. Sed id rhoncus quam. Curabitur eleifend nec mi nec iaculis.
                            Donec
                            eleifend sem magna, sed ultricies diam posuere id. Curabitur nec sapien vel nisl rutrum
                            placerat. Vestibulum ullamcorper lorem id nibh dignissim, fermentum dignissim sem rhoncus.
                            Ut
                            ullamcorper rutrum efficitur. Suspendisse feugiat quam ut lacus eleifend, a bibendum nibh
                            malesuada.</p>
                    </div>
                </div>
                <div class="answers">
                    <div class="header-title">
                        <p class="answers-p"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
                            feugiat
                            quam ut lacus eleifend, a bibendum nibh malesuada.</p>
                        <div class="down-image">
                            <img src="../images/arrow_drop_down_45dp_E8EAED_FILL0_wght400_GRAD0_opsz48.svg"
                                alt="down-button">
                        </div>
                    </div>
                    <div class="extra-description">
                        <p class="description"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque
                            venenatis nunc viverra tempor. Sed id rhoncus quam. Curabitur eleifend nec mi nec iaculis.
                            Donec
                            eleifend sem magna, sed ultricies diam posuere id. Curabitur nec sapien vel nisl rutrum
                            placerat. Vestibulum ullamcorper lorem id nibh dignissim, fermentum dignissim sem rhoncus.
                            Ut
                            ullamcorper rutrum efficitur. Suspendisse feugiat quam ut lacus eleifend, a bibendum nibh
                            malesuada.</p>
                    </div>
                </div>
                <div class="answers">
                    <div class="header-title">
                        <p class="answers-p"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
                            feugiat
                            quam ut lacus eleifend, a bibendum nibh malesuada.</p>
                        <div class="down-image">
                            <img src="../images/arrow_drop_down_45dp_E8EAED_FILL0_wght400_GRAD0_opsz48.svg"
                                alt="down-button">
                        </div>
                    </div>
                    <div class="extra-description">
                        <p class="description"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque
                            venenatis nunc viverra tempor. Sed id rhoncus quam. Curabitur eleifend nec mi nec iaculis.
                            Donec
                            eleifend sem magna, sed ultricies diam posuere id. Curabitur nec sapien vel nisl rutrum
                            placerat. Vestibulum ullamcorper lorem id nibh dignissim, fermentum dignissim sem rhoncus.
                            Ut
                            ullamcorper rutrum efficitur. Suspendisse feugiat quam ut lacus eleifend, a bibendum nibh
                            malesuada.</p>
                    </div>
                </div>
                <div class="answers">
                    <div class="header-title">
                        <p class="answers-p"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
                            feugiat
                            quam ut lacus eleifend, a bibendum nibh malesuada.</p>
                        <div class="down-image">
                            <img src="../images/arrow_drop_down_45dp_E8EAED_FILL0_wght400_GRAD0_opsz48.svg"
                                alt="down-button">
                        </div>
                    </div>
                    <div class="extra-description">
                        <p class="description"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque
                            venenatis nunc viverra tempor. Sed id rhoncus quam. Curabitur eleifend nec mi nec iaculis.
                            Donec
                            eleifend sem magna, sed ultricies diam posuere id. Curabitur nec sapien vel nisl rutrum
                            placerat. Vestibulum ullamcorper lorem id nibh dignissim, fermentum dignissim sem rhoncus.
                            Ut
                            ullamcorper rutrum efficitur. Suspendisse feugiat quam ut lacus eleifend, a bibendum nibh
                            malesuada.</p>
                    </div>
                </div>
            </div>
        </main>
        <section class="contact-us">
            <form action="#" class="theForm" id="contact-us-form">
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
                <button type="submit" id="submit-contact-btn">Submit</button>
            </form>
        </section>
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
    <script src="../Contact-us/faq.js"></script>
    <script src="../general-functions/functions.js"></script>
</body>

</html>