<?php
// Database configuration
// Update these with your actual database credentials
$db_host = 'localhost';
$db_user = 'your_db_user';
$db_pass = 'your_db_password';
$db_name = 'your_db_name';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Helper functions
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['full_name']);
}

function isAdmin() {
    return isLoggedIn() && isset($_SESSION['security_level']) && $_SESSION['security_level'] >= 1;
}

function getCurrentUser() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['full_name'],
            'security_level' => $_SESSION['security_level'] ?? 0
        ];
    }
    return null;
}
?>

