<?php
@include '../config.php';

class Database {
    private $host = 'localhost';
    private $db_name = 'GameNexus';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class Product {
    private $conn;
    private $table_name = 'products';

    public $name;
    public $description;
    public $price;
    public $release_date;
    public $developer;
    public $publisher;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function checkExists() {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->name);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result['count'] > 0; // Returns true if the game exists, false otherwise
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, release_date, developer, publisher, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdssss", 
            $this->name, $this->description, $this->price, 
            $this->release_date, $this->developer, $this->publisher, $this->created_at);

        return $stmt->execute();
    }
}

$database = new Database();
$db = $database->getConnection();

$games = [
    [
        'name' => 'Hades II',
        'description' => 'Hades II is a sequel to Hades currently in development by Supergiant Games. You play as Melinoë, immortal daughter of Hades, on her quest to defeat the Titan of Time, battling numerous angry lost souls along the way.',
        'price' => 29.99,
        'release_date' => '2024-05-06',
        'developer' => 'SuperGiant Games',
        'publisher' => 'SuperGiant Games',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Dragon\'s Dogma II',
        'description' => 'Dragon\'s Dogma II is an action role-playing game in which players assume the role of a former prisoner trying to recall their past and save the world from an evil dragon.',
        'price' => 49.59,
        'release_date' => '2024-03-21',
        'developer' => 'Capcom',
        'publisher' => 'Capcom',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Dark Souls III',
        'description' => 'DARK SOULS™ III continues to push the boundaries with the latest, ambitious chapter in the critically-acclaimed and genre-defining series.',
        'price' => 59.99,
        'release_date' => '2016-04-12',
        'developer' => 'FromSoftware, Inc.',
        'publisher' => 'FromSoftware, Inc., Bandai Namco',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'The Witcher 3: Wild Hunt',
        'description' => 'The Witcher 3: Wild Hunt is a story-driven, open world adventure set in a visually stunning fantasy universe full of meaningful choices and impactful consequences.',
        'price' => 39.99,
        'release_date' => '2015-05-18',
        'developer' => 'CD Projekt Red',
        'publisher' => 'CD Projekt',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Cyberpunk 2077',
        'description' => 'Cyberpunk 2077 is an open-world, action-adventure story set in Night City, a megalopolis obsessed with power, glamour and body modification.',
        'price' => 59.99,
        'release_date' => '2020-12-10',
        'developer' => 'CD Projekt Red',
        'publisher' => 'CD Projekt',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Battlefield 2042',
        'description' => 'Battlefield 2042 is a game, when near-future world will be transformed in disorder and you\'ll have to adapt and overcome dynamic battlegrounds with the help of your squad and an arsenal of cutting-edge weapons and vehicles.',
        'price' => 8.99,
        'release_date' => '2021-11-19',
        'developer' => 'DICE',
        'publisher' => 'Electronic Arts',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Star Wars Jedi: Survivor',
        'description' => 'Star Wars Jedi: Survivor is a third-person action-adventure video game. The game\'s playable character, Jedi Knight Cal Kestis, is equipped with a lightsaber to fight against enemies.',
        'price' => 17.49,
        'release_date' => '2023-04-28',
        'developer' => 'Respawn Entertainment',
        'publisher' => 'Electronic Arts',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Path/Jump to the Endgame(LostArk)',
        'description' => 'A new server setup will be implemented in Arkesia, allowing players to jump-start their characters to level 1415 with support all the way to level 1540! Players on Jump-Start servers will receive materials that provide faster vertical and horizontal progression, including honing materials, card packs, and more.',
        'price' => 0.00,
        'release_date' => '2023-09-13',
        'developer' => 'Smilegate Entertainment, Inc.',
        'publisher' => 'Smilegate',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Apex Legends',
        'description' => 'Apex Legends is an online multiplayer battle royale game featuring squads of three players using pre-made characters with distinctive abilities, called "Legends", similar to those of hero shooters.',
        'price' => 0.00,
        'release_date' => '2019-02-04',
        'developer' => 'Respawn Entertainment',
        'publisher' => 'Electronic Arts',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Resident of Evil 4',
        'description' => 'In Resident Evil 4, you play as Leon S. Kennedy, the protagonist from Resident Evil 2. Now working as a US government agent, Leon is dispatched to an secluded European village after a sighting of the president\'s daughter, who has disappeared.',
        'price' => 19.99,
        'release_date' => '2005-01-11',
        'developer' => 'Capcom',
        'publisher' => 'Capcom',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Nobody Wants To Die',
        'description' => 'Nobody Wants to Die is an adventure game in a first-person perspective, in which players interact with other characters and investigate crime scenes to gather evidence.',
        'price' => 24.99,
        'release_date' => '2024-07-17',
        'developer' => 'Critical Hit Games',
        'publisher' => 'Plaion',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Call of Duty: Black Ops VI',
        'description' => 'Black Ops 6 is a spy action thriller set in the early 90s, a period of transition and upheaval in global politics, characterized by the end of the Cold War and the rise of the United States as a single superpower.',
        'price' => 99.99,
        'release_date' => '2024-10-25',
        'developer' => 'Treyarch',
        'publisher' => 'Activision',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Stardew Valley',
        'description' => 'Stardew Valley is an open-ended country-life RPG! You\'ve inherited your grandfather\'s old farm plot in Stardew Valley. Armed with hand-me-down tools and a few coins, you set out to begin your new life.',
        'price' => 14.99,
        'release_date' => '2016-02-26',
        'developer' => 'ConcernedApe',
        'publisher' => 'ConcernedApe',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Stardew Valley',
        'description' => 'Stardew Valley is an open-ended country-life RPG! You\'ve inherited your grandfather\'s old farm plot in Stardew Valley. Armed with hand-me-down tools and a few coins, you set out to begin your new life.',
        'price' => 14.99,
        'release_date' => '2016-02-26',
        'developer' => 'ConcernedApe',
        'publisher' => 'ConcernedApe',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Hades',
        'description' => 'Hades is a god-like rogue-like dungeon crawler that combines the best aspects of Supergiant\'s critically acclaimed titles, including the fast-paced action of Bastion, the rich atmosphere and depth of Transistor, and the character-driven storytelling of Pyre.',
        'price' => 9.99,
        'release_date' => '2020-09-17',
        'developer' => 'Supergiant Games',
        'publisher' => 'Supergiant Games',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Russian Fishing 4',
        'description' => 'Russian Fishing 4 is a fishing simulator with RPG elements. There is no story line and the whole process is based on the concept of an open, free to roam and free to play game.',
        'price' => 0.00,
        'release_date' => '2018-06-15',
        'developer' => 'FishSoft LLC',
        'publisher' => 'FishSoft LLC',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Terraria',
        'description' => 'erraria is a 2D sandbox game with gameplay that revolves around exploration, building, crafting, combat, survival, and mining, playable in both single-player and multiplayer modes.',
        'price' => 9.99,
        'release_date' => '2011-05-16',
        'developer' => 'Re-Logic',
        'publisher' => 'Re-Logic',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Rogue Trader',
        'description' => 'Rogue Trader is a turn-based tactical RPG set in the Warhammer 40,000 universe, where players take on the role of a powerful voidship captain exploring the vast reaches of the Imperium.',
        'price' => 49.99,
        'release_date' => '2023-12-07',
        'developer' => 'Owlcat Games',
        'publisher' => 'Owlcat Games',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'It Takes Two',
        'description' => 'It Takes Two is a cooperative action-adventure game that follows a couple transformed into dolls, navigating a fantastical world full of puzzles and platforming challenges.',
        'price' => 39.99,
        'release_date' => '2021-03-26',
        'developer' => 'Hazelight Studios',
        'publisher' => 'Electronic Arts',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'FC 25',
        'description' => 'FC 25 is the latest installment in the popular football simulation franchise, offering realistic gameplay, updated teams, and advanced career modes.',
        'price' => 69.99,
        'release_date' => '2024-09-29',
        'developer' => 'Electronic Arts',
        'publisher' => 'Electronic Arts',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Mass Effect',
        'description' => 'Mass Effect is a sci-fi RPG where players take on the role of Commander Shepard, leading a team across the galaxy to stop an ancient alien threat.',
        'price' => 19.99,
        'release_date' => '2007-11-20',
        'developer' => 'BioWare',
        'publisher' => 'Electronic Arts',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Outer Wilds',
        'description' => 'Outer Wilds is an open-world exploration game where players unravel the mysteries of a time loop in a hand-crafted solar system.',
        'price' => 24.99,
        'release_date' => '2019-05-28',
        'developer' => 'Mobius Digital',
        'publisher' => 'Annapurna Interactive',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Counter-Strike 2',
        'description' => 'Counter-Strike 2 is the next evolution of the legendary tactical shooter, featuring improved graphics, physics, and competitive gameplay.',
        'price' => 0.00, // Free-to-play
        'release_date' => '2023-09-27',
        'developer' => 'Valve',
        'publisher' => 'Valve',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Once Human',
        'description' => 'Once Human is a multiplayer open-world survival game set in a post-apocalyptic world overrun by supernatural horrors.',
        'price' => 29.99,
        'release_date' => '2024-07-10',
        'developer' => 'Starry Studio',
        'publisher' => 'NetEase Games',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'World of Warships',
        'description' => 'World of Warships is a free-to-play naval warfare MMO where players command historical warships in tactical battles.',
        'price' => 0.00, // Free-to-play
        'release_date' => '2015-09-17',
        'developer' => 'Wargaming',
        'publisher' => 'Wargaming',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Indiana Jones and the Great Circle',
        'description' => 'Indiana Jones and the Great Circle is an upcoming action-adventure game where players take on the role of the legendary archaeologist in a new thrilling story.',
        'price' => 59.99,
        'release_date' => '2024-12-31',
        'developer' => 'MachineGames',
        'publisher' => 'Bethesda Softworks',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'name' => 'Path of Exile',
        'description' => 'Path of Exile is a free-to-play action RPG with deep customization, a vast world, and complex skill systems inspired by classic ARPGs.',
        'price' => 0.00, // Free-to-play
        'release_date' => '2013-10-23',
        'developer' => 'Grinding Gear Games',
        'publisher' => 'Grinding Gear Games',
        'created_at' => date('Y-m-d H:i:s')
    ]
];

foreach ($games as $game_data) {
    $product = new Product($db);
    $product->name = $game_data['name'];
    $product->description = $game_data['description'];
    $product->price = $game_data['price'];
    $product->release_date = $game_data['release_date'];
    $product->developer = $game_data['developer'];
    $product->publisher = $game_data['publisher'];
    $product->created_at = $game_data['created_at'];

    if (!$product->checkExists()) {
        if ($product->create()) {
            echo '<div style="display:none;">Game " . $product->name . " added successfully.</div>';
        } else {
            echo '<div style="display:none;">Unable to add game " . $product->name. ".</div>';
        }
    } else {
        echo '<div style="display:none;">Game " . $product->name . " already exists. Skipping...</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Categories/Categories.css">
    <script src="https://kit.fontawesome.com/4acdbd152b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
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
            <a href="../Home/home.html">Home</a>
            <a href="../Categories/Categories.html">Categories</a>
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
    <section class="headers">
    </section>

    <section class="main-featured">
        <h1 class="featured-title">Categories</h1>
        <div class="featured"></div>
    <div class="featured-title"></div>
        <div class="slider-container">
            <div class="slider">
                <div class="campus-col">
                    <img src="../images/hero_capsule.jpg" alt="Image 1" class="slide product">
                    <div class="layer">
                        <h3>FREE TO PLAY</h3>
                    </div>
                 </div>
                 <div class="campus-col">
                    <img src="../images/dragonDogma.jpg" alt="Image 2" class="slide product">
                    <div class="layer">
                        <h3>CASUAL</h3>
                    </div>
                 </div>
                 <div class="campus-col">
                    <img src="../images/dragonDogma.jpg" alt="Image 2" class="slide product">
                    <div class="layer">
                        <h3>CASUAL</h3>
                    </div>
                 </div>
            </div>
            <div class="button-sliders">
                <button class="buttons prev">&#10094;</button>
                <button class="buttons next">&#10095;</button>
            </div>
            <div></div>
        </div>
    </section>
 
    <section>
    <div class="container-sign">
        <p>Sign in to view personalized recommendations</p>
        <button class="sign-in-button"><a style="text-decoration: none; color: aliceblue;" href="../Login/login.html">Sign In</a></button>
        <p>Or <a style="color: #103a86;" href="../Register/registration-form.html" class="sign-up-link">sign up</a> and join Steam for free</p>
    </div>
    </section>

    <section class="games">
        <div class="featured-2">
            <div class="head-2">
                <h1>Featured Deep Discounts</h1>
                <p>Don't miss out on these amazing offers!</p>
            </div>
            <div class="products">
                <div class="flex-1">
                    <div class="flex-item product">
                        <img src="../images/lostark.jpg" alt="battlefield2042">
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
                        <img src="../images/poster-game-apex-legends.jpg" alt="jedi survivor">
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
                        <img src="../images/img_41186_MAIN.png" alt="forza">
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
                        <img src="../images/hero_capsule (4).jpg" alt="horizon">
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
    </section>

    <section class="game-slider">
        <h1 class="feature-title">Most Played Games</h1>
        <div class="slider-container">
            <div class="slider-g">
                <div class="game-col">
                    <img style="height: 145px;" src="../images/csgo.webp" alt="Game 1" class="game-image">
                    <h3>Game Title 1</h3>
                </div>
                <div class="game-col">
                    <img style="height: 145px;" src="../images/default.webp" alt="Game 2" class="game-image">
                    <h3>Game Title 2</h3>
                </div>
                <div class="game-col">
                    <img style="height: 145px;" src="../images/war.jpg" alt="Game 3" class="game-image">
                    <h3>Game Title 3</h3>
                </div>
                <div class="game-col">
                    <img style="height: 145px;" src="../images/93h58lnoh9dc1.jpeg" alt="Game 4" class="game-image">
                    <h3>Game Title 4</h3>
                </div>
                <div class="game-col">
                    <img style="height: 145px;" src="../images/path.jpg" alt="Game 5" class="game-image">
                    <h3>Game Title 5</h3>
                </div>
                <div class="game-col">
                    <img style="height: 145px;" src="../images/delta.jpg" alt="Game 6" class="game-image">
                    <h3>Game Title 6</h3>
                </div>
            </div>
            <div class="button-slider">
                <button class="button prevs">&#10094;</button>
                <button class="button nexts">&#10095;</button>
            </div>
        </div>
    </section>

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
    <script src="../Categories/Categories.js"></script>
    <script src="../general-functions/functions.js"></script>
</body>
</html>