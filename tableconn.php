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
if ($username === '') $errors[] = 'amazina ukoresha ni ngombwa';
if ($name === '') $errors[] = 'Amazina ni ngombwa';
if ($password === '') $errors[] = 'Ijambo ry`ibanga ni ngombwa';

if (!empty($errors)) {
    foreach ($errors as $err) echo htmlspecialchars($err) . "<br>";
    echo '<a href="signup.php">Inyuma</a>';
    exit;
}

// Check existing username
$check = $pdo->prepare('SELECT uid FROM Users WHERE Username = ?');
$check->execute([$username]);
if ($check->fetch()) {
    echo 'Aya mazina yamaze GUkoreshwa. <a href="signup.php">Gerageza irindi</a>';
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
if ($username === '') $errors[] = 'Amazina ukoresha ni ngombwa';
if ($name === '') $errors[] = 'Izina ryawe ni ngombwa';
if ($password === '') $errors[] = 'Ijambo ry`ibanga ni ngombwa';


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