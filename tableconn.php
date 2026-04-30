<?php
// tableconn.php - secure user registration handler
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: signup.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$name = trim($_POST['name'] ?? '');
$password = $_POST['password'] ?? '';
$type = $_POST['type'] ?? 'Cashier';

$errors = [];
if ($username === '') $errors[] = 'Username is required';
if ($name === '') $errors[] = 'Name is required';
if ($password === '') $errors[] = 'Password is required';

if (!empty($errors)) {
    foreach ($errors as $err) echo htmlspecialchars($err) . "<br>";
    echo '<a href="signup.php">Back</a>';
    exit;
}

// Check existing username
$check = $pdo->prepare('SELECT uid FROM Users WHERE Username = ?');
$check->execute([$username]);
if ($check->fetch()) {
    echo 'Username already exists. <a href="signup.php">Try another</a>';
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$ins = $pdo->prepare('INSERT INTO Users (Username, Upassword, type, Names) VALUES (?, ?, ?, ?)');
try {
    $ins->execute([$username, $hash, $type, $name]);
    header('Location: login.php');
    exit;
} catch (PDOException $e) {
    echo 'Failed to register: ' . htmlspecialchars($e->getMessage());
}

?>
<?php
$username=$_POST['username'];
$name=$_POST['name'];
$password=$_POST['password'];
$type=$_POST['type'];

try{
    $conn= new PDO("mysql:host=localhost; dbname=eduka","root","",
"");
    $conn->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
}
catch(PDOException $e){
    echo "Connection Failed:".$e -> getMessage();
};


?>
<?php
// tableconn.php - user registration handler
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: signup.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$name = trim($_POST['name'] ?? '');
$password = $_POST['password'] ?? '';
$type = $_POST['type'] ?? 'cashier';

$errors = [];
if ($username === '') $errors[] = 'Username is required';
if ($name === '') $errors[] = 'Name is required';
if ($password === '') $errors[] = 'Password is required';


$username=$_POST['username'];
$name=$_POST['name'];
$password=$_POST['password'];
$type=$_POST['type'];

try{
    $conn= new PDO("mysql:host=localhost; dbname=eduka","root","");
    $conn->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
}
catch(PDOException $e){
    echo "Connection Failed:".$e -> getMessage();
};


?>