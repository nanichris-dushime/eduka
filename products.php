<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/db.php';

// Protect page
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $pname = trim($_POST['pname'] ?? '');
    $uprice = trim($_POST['uprice'] ?? '0');
    $nproduct = trim($_POST['nproduct'] ?? '0');
    if ($pname !== '') {
        $ins = $pdo->prepare('INSERT INTO Product (Pname, Uprice, Nproduct) VALUES (?, ?, ?)');
        $ins->execute([$pname, $uprice, $nproduct]);
        header('Location: products.php');
        exit;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $pid = $_GET['delete'];
    $del = $pdo->prepare('DELETE FROM Product WHERE Pid = ?');
    $del->execute([$pid]);
    header('Location: products.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <style>
        body { font-family: sans-serif; margin: 30px; background-color: #f8f9fa; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; color: white; font-size: 14px; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; }
        form { background: #eee; padding: 20px; border-radius: 5px; margin-bottom: 30px; }
        input { padding: 8px; width: 90%; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .logout { color: red; text-decoration: none; float: right; }
    </style>
</head>
<body>

<div class="container">
    <a href="logout.php" class="logout">Logout</a>
    <h2>Eduka Product Management</h2>
    <p>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></p>

    <form method="POST" action="products.php">
        <h3>Register New Product</h3>
        <label>Product Name</label><br>
        <input type="text" name="pname" required><br>
        
        <label>Unit Price</label><br>
        <input type="text" name="uprice" required><br>
        
        <label>Quantity</label><br>
        <input type="text" name="nproduct" required><br>
        
        <button type="submit" name="add_product" style="background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer;">Save Product</button>
    </form>

    <h3>Product List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php
    $stmt = $pdo->query("SELECT * FROM Product");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                <td>{$row['Pid']}</td>
                <td>{$row['Pname']}</td>
                <td>{$row['Uprice']}</td>
                <td>{$row['Nproduct']}</td>
                <td>
                    <a href='edit_product.php?id={$row['Pid']}' class='btn btn-edit'>Modify</a>
                    <a href='products.php?delete={$row['Pid']}' class='btn btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>