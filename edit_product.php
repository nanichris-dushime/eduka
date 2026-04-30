<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/db.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pid = $_GET['id'] ?? null;
if (!$pid) {
    header('Location: products.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM Product WHERE Pid = ?');
$stmt->execute([$pid]);
$product = $stmt->fetch();
if (!$product) {
    echo 'Product not found';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pname = trim($_POST['pname'] ?? '');
    $uprice = trim($_POST['uprice'] ?? '0');
    $nproduct = trim($_POST['nproduct'] ?? '0');
    $upd = $pdo->prepare('UPDATE Product SET Pname = ?, Uprice = ?, Nproduct = ? WHERE Pid = ?');
    $upd->execute([$pname, $uprice, $nproduct, $pid]);
    header('Location: products.php');
    exit;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Product</title>
    <style>body{font-family:Arial;margin:20px;} form{max-width:400px;background:#f7f7f7;padding:20px;border-radius:6px;} input{width:100%;padding:8px;margin:6px 0;border:1px solid #ccc;border-radius:4px;} button{background:#007bff;color:white;padding:8px 12px;border:none;border-radius:4px;}</style>
</head>
<body>
    <h2>Hindura Ibijyanye nigicuruzwa</h2>
    <form method="post">
        <label>Izina Ry'igicuruzwa</label>
        <input name="pname" value="<?php echo htmlspecialchars($product['Pname']); ?>" required>
        <label>Igiciro</label>
        <input name="uprice" value="<?php echo htmlspecialchars($product['Uprice']); ?>" required>
        <label>Ingano</label>
        <input name="nproduct" value="<?php echo htmlspecialchars($product['Nproduct']); ?>" required>
        <button type="submit">Emeza</button>
    </form>
    <p><a href="products.php">Subira inyuma</a></p>
</body>
</html>