<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    public function login($username, $password) {
        // Sanitize the input to prevent SQL injection
        $username = mysqli_real_escape_string($this->conn, $username);
        $password = mysqli_real_escape_string($this->conn, $password);

        // Query to fetch user data by username
        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            var_dump($user);
            // PREFERABLE SOLUTION

            // Check if the password matches
            // if (password_verify($password, $user['password'])) {
                // Store user information in session
                // $_SESSION['user_id'] = $user['id'];
                // $_SESSION['username'] = $user['username'];
                // $_SESSION['role'] = $user['role']; // Store the role (admin or user)

                // Optional: Remember me functionality
                // if ($remember) {
                //     $this->setRememberMe($user['id']);
                // }

                // return $user; // Return user data (including role) if login is successful
            // }


            // TEMPORARY SOLUTION

            if ($password === $user['password']) { // Direct comparison for testing
                // Store user information in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role']; // Store the role (admin or user)
    
              // Automatically trigger the Remember Me functionality for all users
                $this->setRememberMe($user['id']);
    
                return $user; // Return user data if login is successful
            }
        }

        return false; // Login failed


    }

    private function setRememberMe($userId) {
        // Generate a random token for remembering the user
        $remember_token = bin2hex(random_bytes(16)); 
    
        // Set the cookie to store the token for 30 days
        setcookie('remember_me', $remember_token, time() + (86400 * 30), "/"); // Cookie expires in 30 days
    
        // Save the token in the database for verification on subsequent visits
        $update_query = "UPDATE users SET remember_token = '$remember_token' WHERE id = " . $userId;
        mysqli_query($this->conn, $update_query);
    }

    public function checkRememberMe() {
        if (isset($_COOKIE['remember_me'])) {
            $remember_token = $_COOKIE['remember_me'];

            // Query to find the user based on the remember token
            $query = "SELECT * FROM users WHERE remember_token = '$remember_token' LIMIT 1";
            $result = mysqli_query($this->conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

                // Log the user in automatically
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role']; // Store the role (admin or user)

                // Return user data (indicating they are logged in automatically)
                return $user;
            }
        }

        return false; // No valid remember me token found
    }
}
?>
