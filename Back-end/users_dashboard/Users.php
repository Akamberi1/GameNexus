<?php
// Start session
session_start();

// Database connection
class Database {
    private $host = "localhost";
    private $db_name = "GameNexus"; 
    private $username = "root"; 
    private $password = ""; 
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function executeQuery($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            if (!empty($params)) {
                $stmt->bind_param(...$params);
            }
            $stmt->execute();
            return $stmt;
        }
        return false;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// User operations
class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function deleteUser($userId) {
        $query = "DELETE FROM users WHERE id = ?";
        return $this->db->executeQuery($query, ['i', $userId]);
    }

    public function getUserById($userId) {
        $query = "SELECT id, username, email, role FROM users WHERE id = ?";
        $stmt = $this->db->executeQuery($query, ['i', $userId]);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUser($userId, $username, $email, $role) {
        $query = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        return $this->db->executeQuery($query, ['sssi', $username, $email, $role, $userId]);
    }

    public function insertUser($username, $email, $password, $role) {
        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        return $this->db->executeQuery($query, ['ssss', $username, $email, $password, $role]);
    }

    public function getAllUsers() {
        $query = "SELECT id, username, password, email, role, created_at FROM users";
        $stmt = $this->db->executeQuery($query);
        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }
}

$database = new Database();
$user = new User($database);

// Handle user deletion (AJAX)
if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $result = $user->deleteUser($userId);
    echo $result ? 'User deleted successfully' : 'Error deleting user';
    exit;
}

// Handle user update
if (isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $result = $user->updateUser($userId, $username, $email, $role);
    echo $result ? 'User updated successfully' : 'Error updating user';
    exit;
}

// Handle user insert
if (isset($_POST['action']) && $_POST['action'] == 'insert') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
    $role = $_POST['role'];

    $result = $user->insertUser($username, $email, $password, $role);
    echo $result ? 'User inserted successfully' : 'Error inserting user';
    exit;
}

// Fetch users for display
$users = $user->getAllUsers();
$database->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4acdbd152b.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../users_dashboard/Users.css">
    <style>
        .button { padding: 5px 10px; margin: 5px; cursor: pointer; }
        .edit-btn { background-color: #4CAF50; color: white; }
        .delete-btn { background-color: #f44336; color: white; }
    </style>
  </head>
  <body>
    <div class="grid-container">
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <i class="fa-solid fa-bars"></i>
        </div>
        <div class="header-left">
          <h2 style="color: white;">Welcome, Admin! </h2>
        </div>
        <div class="header-right">
          <i class="fa-solid fa-bell"></i>
          <i class="fa-solid fa-user"></i>
        </div>
      </header>

      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand"></div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="../admin_dashboard/admin_dashboard.php"><i class="fa-solid fa-table-columns"></i> Dashboard</a>
          </li>
          <li class="sidebar-list-item">
            <a href="../../Front-end/Home/home.php"><i class="fa-solid fa-house"></i> Homepage</a>
          </li>
          <li class="sidebar-list-item">
            <a href="../../Front-end/Categories/Categories.php"><i class="fa-solid fa-list"></i> Categories</a>
          </li>
          <li class="sidebar-list-item">
            <a href="../../Front-end/Contact-us/faq.html"><i class="fa-solid fa-address-book"></i> Contact Us</a>
          </li>
          <li class="sidebar-list-item">
            <a href="../../Front-end/About/about.html"><i class="fa-solid fa-address-card"></i>  About</a>
          </li>
          <li class="sidebar-list-item">
            <a href="#"><i class="fa-solid fa-users"></i>  Users</a>
          </li>
          <li class="sidebar-list-item">
            <a href="#"><i class="fa-solid fa-gamepad"></i> Games</a>
          </li>
        </ul>
      </aside>

      <main class="main-container">
        <div class="container">
          <h1>Users</h1>
          <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created_at</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                <tr id="user-row-<?php echo $user['id']; ?>">
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                    <td>
                        <button class="edit-btn button" onclick="editUser(<?php echo $user['id']; ?>)">Edit</button>
                        <button class="delete-btn button" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
          </div>
          <button class="insert-btn" onclick="insertUser()">Insert</button>
          <button class="logout" onclick="logout()">Logout</button>
        </div>
      </main>
    </div>

    <script src="../admin_dashboard/admin_dashboard.js"></script>
    <script>
      function logout() {
        window.location.href = "../../Front-end/Login/login.html"; // Change to your login page URL
    }
       // Delete user via AJAX
       function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '', // Same file
                    type: 'POST',
                    data: {
                        action: 'delete',
                        user_id: userId
                    },
                    success: function(response) {
                        alert(response);
                        $('#user-row-' + userId).remove();
                    }
                });
            }
        }

        // Edit user - Open edit form in a popup or redirect to a separate page
        function editUser(userId) {
            const username = prompt('Enter new username:');
            const email = prompt('Enter new email:');
            const role = prompt('Enter new role:');

            if (username && email && role) {
                $.ajax({
                    url: '', // Same file
                    type: 'POST',
                    data: {
                        action: 'update',
                        user_id: userId,
                        username: username,
                        email: email,
                        role: role
                    },
                    success: function(response) {
                        alert(response);
                        location.reload(); // Reload the page to reflect changes
                    }
                });
            }
        }

        // Insert new user - Show prompt and send data via AJAX
        function insertUser() {
            const username = prompt('Enter username:');
            const email = prompt('Enter email:');
            const password = prompt('Enter password:');
            const role = prompt('Enter role (e.g., admin, user):');

            if (username && email && password && role) {
                $.ajax({
                    url: '', // Same file
                    type: 'POST',
                    data: {
                        action: 'insert',
                        username: username,
                        email: email,
                        password: password,
                        role: role
                    },
                    success: function(response) {
                        alert(response);
                        location.reload(); // Reload the page to reflect changes
                    }
                });
            }
        }
    </script>
  </body>
</html>
