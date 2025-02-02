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
    <link rel="stylesheet" href="../games/games.css">
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
    <h1>Games</h1>

    <!-- Insert Game Form -->
    <div id="insertForm">
            <h3>Insert New Game</h3>
            <form action="../../Back-end/games/games_functionality.php" method="POST" class="forma">
                <label for="name">Name:</label>
                <input type="text" name="name" required><br>

                <label for="description">Description:</label>
                <textarea name="description" required></textarea><br>

                <label for="price">Price:</label>
                <input type="number" name="price" required step="0.01"><br>

                <label for="release_date">Release Date:</label>
                <input type="date" name="release_date" required><br>

                <label for="developer">Developer:</label>
                <input type="text" name="developer" required><br>

                <label for="publisher">Publisher:</label>
                <input type="text" name="publisher" required><br>

                <button type="submit" name="insert">Insert Game</button>
            </form>
    </div>
    <!-- Edit Form (Initially Hidden) -->
<div id="editForm">
    <h3>Edit Game</h3>
    <form action="../../Back-end/games/games_functionality.php" method="POST" class="forma2">
        <input type="hidden" name="id" id="editId">
        <label for="name">Name:</label>
        <input type="text" name="name" id="editName" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="editDescription" required></textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="editPrice" required step="0.01"><br>

        <label for="release_date">Release Date:</label>
        <input type="date" name="release_date" id="editReleaseDate" required><br>

        <label for="developer">Developer:</label>
        <input type="text" name="developer" id="editDeveloper" required><br>

        <label for="publisher">Publisher:</label>
        <input type="text" name="publisher" id="editPublisher" required><br>

        <button type="submit" name="edit">Update Game</button>
    </form>
</div>

    <div class="products">
        <div class ="about">
            <div class ="about-divs">
                <p>id</p>
            </div>
            <div class ="about-divs">
                <p>name</p>
            </div>
            <div class ="about-divs">
                <p>description</p>
            </div>
            <div class ="about-divs">
                <p>price</p>
            </div>
            <div class ="about-divs">
                <p>release_date</p>
            </div>
            <div class ="about-divs">
                <p>developer</p>
            </div>
            <div class ="about-divs">
                <p>publisher</p>
            </div>
            <div class ="about-divs">
                <p>Created</p>
            </div>
            <div id="insertButton" class="insert">Insert</div>
        </div>

  

<?php
include_once '../../Back-end/Database/Database.php';

$db = new Database();
$conn = $db->getConnection();

$productQuery = "SELECT * FROM products";
$productResult = $conn->query($productQuery);

if ($productResult->num_rows > 0) {
    while ($product = $productResult->fetch_assoc()) {
        $price = number_format($product['price'], 2);

        echo '

        <div class="product">
            <div class="the-product">
                <div class="product-div">
                    <p>' . $product['id'] . '</p>
                </div>
                <div class="product-div">
                    <p>' . $product['name'] . '</p>
                </div>
                <div class="product-div desc">
                    <p>' . $product['description'] . '</p>
                </div>
                <div class="product-div">
                    <p>' . $price . '$</p>
                </div>
                <div class="product-div">
                    <p>' . $product['release_date'] . '</p>
                </div>
                <div class="product-div desc">
                    <p>' . $product['developer'] . '</p>
                </div>
                <div class="product-div">
                    <p>' . $product['publisher'] . '</p>
                </div>
                <div class="product-div">
                    <p>' . $product['created_at'] . '</p>
                </div>
            </div>
            <div class="buttons">
                <!-- Edit Button: Pass game data to update logic -->
                <button class="editBtn" data-id="' . $product['id'] . '" data-name="' . $product['name'] . '" data-description="' . $product['description'] . '" data-price="' . $product['price'] . '" data-release_date="' . $product['release_date'] . '" data-developer="' . $product['developer'] . '" data-publisher="' . $product['publisher'] . '">Edit</button>

                <!-- Delete Button: Pass game ID for deletion -->
                <form action="games_functionality.php" method="POST" class="formDelete">
                    <input type="hidden" name="id" value="' . $product['id'] . '">
                    <button type="submit" name="delete" onclick="return confirm(\'Are you sure you want to delete this game?\');" class="delBtn">Delete</button>
                </form>
            </div>
        </div>';
    }
} else {
    echo "No products found.";
}
?>    </div>

<script>
    // Get the insert button and form
    const insertButton = document.getElementById('insertButton');
    const insertForm = document.getElementById('insertForm');

    // Toggle form visibility on click
    insertButton.addEventListener('click', function() {
        if (insertForm.style.display === 'none' || insertForm.style.display === '') {
            insertForm.style.display = 'flex';  // Show the form
        } else {
            insertForm.style.display = 'none';   // Hide the form
        }
    });


    document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function() {
        // Get product data from the button's data attributes
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const description = this.getAttribute('data-description');
        const price = this.getAttribute('data-price');
        const releaseDate = this.getAttribute('data-release_date');
        const developer = this.getAttribute('data-developer');
        const publisher = this.getAttribute('data-publisher');

        // Populate the form with the current product values
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editDescription').value = description;
        document.getElementById('editPrice').value = price;
        document.getElementById('editReleaseDate').value = releaseDate;
        document.getElementById('editDeveloper').value = developer;
        document.getElementById('editPublisher').value = publisher;

        // Show the form
        if (document.getElementById('editForm').style.display === 'none' || document.getElementById('editForm').style.display === '') {
            document.getElementById('editForm').style.display = 'flex';  // Show the form
        } else {
            document.getElementById('editForm').style.display = 'none'; // Hide the form
        }
    });
});
</script>

    
</body>
</html>