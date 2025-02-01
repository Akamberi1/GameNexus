<?php
session_start();

class Database {
    private $host = "localhost";
    private $db_name = "GameNexus";
    private $username = "root";
    private $password = "";
    private $conn;

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

class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users ORDER BY id ASC";
        $stmt = $this->db->executeQuery($query);
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertUser($username, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        return $this->db->executeQuery($query, ['ssss', $username, $email, $hashedPassword, $role]);
    }

    public function updateUser($id, $username, $email, $role) {
        $query = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        return $this->db->executeQuery($query, ['sssi', $username, $email, $role, $id]);
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $this->db->executeQuery($query, ['i', $id]);
        
        $this->db->executeQuery("SET @count = 0;");
        $this->db->executeQuery("UPDATE users SET id = @count:= @count + 1;");
        $this->db->executeQuery("ALTER TABLE users AUTO_INCREMENT = 1;");
        return true;
    }
}

$database = new Database();
$user = new User($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'insert':
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            echo $user->insertUser($username, $email, $password, $role) ? 'User added successfully' : 'Error adding user';
            break;
        case 'update':
            echo $user->updateUser($_POST['id'], $_POST['username'], $_POST['email'], $_POST['role']) ? 'User updated' : 'Error updating user';
            break;
        case 'delete':
            echo $user->deleteUser($_POST['id']) ? 'User deleted' : 'Error deleting user';
            break;
    }
    exit;
}

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
        .edit-btn { background-color: #4CAF50; color: white; padding: 10px 10px; }
        .delete-btn { background-color: #f44336; color: white; padding: 10px 10px; }
        .no-users-message { color: red; font-size: 18px; font-weight: bold; }
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
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created_at</th>
                        <th>Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                      <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['role']); ?></td>
                                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                                <td>
                                    <!-- Edit and Delete buttons -->
                                    <button class="edit-btn" onclick="editUser(<?php echo $user['id']; ?>)">Edit</button>
                                    <button class="delete-btn" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                                </td>
                            </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
          </div>
          <button class="insert-btn" onclick="insertUser()">Insert</button>
          <button class="logout">Logout</button>
        </div>
      </main>
    </div>

    <script src="../admin_dashboard/admin_dashboard.js"></script>
    <script>
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
                        // Remove the row from the table after successful deletion
                        $('#user-row-' + userId).remove();

                        // Check if there are no users left, and show the "No accounts found" message
                        if ($('tbody tr').length === 0) {
                            $('body').append('<p class="no-users-message">No accounts found in the database.</p>');
                        }
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
