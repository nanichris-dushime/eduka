<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Use password_verify for hashed passwords
$stmt = $pdo->prepare('SELECT uid, Username, Upassword, type, Names FROM Users WHERE Username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['Upassword'])) {
    // Login success
    $_SESSION['user_id'] = $user['uid'];
    $_SESSION['username'] = $user['Username'];
    $_SESSION['names'] = $user['Names'];
    $_SESSION['type'] = $user['type'];
    header('Location: products.php');
    exit;
} else {
    header('Location: login.php?error=Invalid+credentials');
    exit;
}

?>