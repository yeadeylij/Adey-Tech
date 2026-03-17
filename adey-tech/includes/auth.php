<?php
require_once 'config.php';

class Auth {
    private $conn;
    
    public function __construct() {
        $this->conn = getConnection();
    }
    
    public function register($fullName, $email, $username, $password) {
        // Check if user exists
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $stmt->close();
            return ['success' => false, 'message' => 'Email or username already exists'];
        }
        $stmt->close();
        
        // Hash password and insert user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (full_name, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullName, $email, $username, $hashedPassword);
        
        if ($stmt->execute()) {
            $userId = $stmt->insert_id;
            $stmt->close();
            return ['success' => true, 'message' => 'Registration successful', 'user_id' => $userId];
        } else {
            $error = $stmt->error;
            $stmt->close();
            return ['success' => false, 'message' => 'Registration failed: ' . $error];
        }
    }
    
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $stmt->close();
            
            if (password_verify($password, $user['password'])) {
                // Update last login
                $updateStmt = $this->conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $updateStmt->bind_param("i", $user['id']);
                $updateStmt->execute();
                $updateStmt->close();
                
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                
                return ['success' => true, 'user' => $user];
            }
        } else {
            $stmt->close();
        }
        
        return ['success' => false, 'message' => 'Invalid username or password'];
    }
    
    public function getUser($userId) {
        $stmt = $this->conn->prepare("SELECT id, full_name, email, username, bio, location, website, avatar, created_at, last_login FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $stmt->close();
            return $user;
        }
        
        $stmt->close();
        return null;
    }
    
    public function updateProfile($userId, $fullName, $bio, $location, $website) {
        $stmt = $this->conn->prepare("UPDATE users SET full_name = ?, bio = ?, location = ?, website = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $fullName, $bio, $location, $website, $userId);
        
        if ($stmt->execute()) {
            $_SESSION['full_name'] = $fullName;
            $stmt->close();
            return ['success' => true, 'message' => 'Profile updated successfully'];
        } else {
            $error = $stmt->error;
            $stmt->close();
            return ['success' => false, 'message' => 'Update failed: ' . $error];
        }
    }
    
    public function logout() {
        $_SESSION = array();
        session_destroy();
    }
}
?>