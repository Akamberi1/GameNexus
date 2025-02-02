<?php include_once '../../Back-end/Database/Database.php'; 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Front-end/Login/login.html");
    exit;
}
if (isset($_SESSION['message'])) {
    echo '<script>alert("' . $_SESSION['message'] . '");</script>';
    unset($_SESSION['message']); 
}
// Create a new database connection
$db = new Database();
$conn = $db->getConnection(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Contact/viewContacts.css">
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
    <a href="../admin_dashboard/admin_dashboard.php" class="img-link"><img src="../../Front-end/images/return-icon.png" alt="return-icon"></a>
    <h1>Contact forms from users</h1>
    <div class="products">
        <div class ="about">
            <div class ="about-divs">
                <p>id</p>
            </div>
            <div class ="about-divs">
                <p>user_id</p>
            </div>
            <div class ="about-divs">
                <p>username</p>
            </div>
            <div class ="about-divs" id="email-about">
                <p>email</p>
            </div>
            <div class ="about-divs msg">
                <p>message</p>
            </div>
            <div class ="about-divs">
                <p>Created</p>
            </div>
        </div>

  

<?php
include_once '../../Back-end/Database/Database.php';

$db = new Database();
$conn = $db->getConnection();

$contactQuery = "SELECT * FROM contact_form";
$contactResult = $conn->query($contactQuery);

if ($contactResult->num_rows > 0) {
    while ($contact = $contactResult->fetch_assoc()) {

        echo '

        <div class="product">
            <div class="the-product">
                <div class="product-div" id="producting_id">
                    <p>' . $contact['id'] . '</p>
                </div>
                <div class="product-div">
                    <p>' . $contact['user_id'] . '</p>
                </div>
                <div class="product-div">
                    <p>' . $contact['name'] . '</p>
                </div>
                <div class="product-div" id="product-id">
                    <p>' . $contact['email'] . '</p>
                </div>
                <div class="product-div desc msg">
                    <p>' . $contact['message'] . '</p>
                </div>
                <div class="product-div createdAt" id="whenCreated">
                    <p>' . $contact['created_at'] . '</p>
                </div>
            </div>
        </div>';
    }
} else {
    echo "No products found.";
}
?>    </div>
</body>
</html>