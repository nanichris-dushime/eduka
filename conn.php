<?php
$host = "localhost";
$dbname = "eduka";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // 1. Collect the data
        $Names = $_POST['name'];
        $Username = $_POST['username'];
        $type = $_POST['type'];
        $Upassword = $_POST['password'];

        // 2. Prepare the SQL Statement (Removed the duplicate 'Names' column)
        // Order: Username, Upassword, type, Names
        $sql = "INSERT INTO Users (Username, Upassword, type, Names) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // 3. Execute with exactly 4 variables to match the 4 placeholders
        if ($stmt->execute([$Username, $Upassword, $type, $Names])) {
            echo "Ibyo wasabye byageze mu database neza! (Data saved successfully)";
        } else {
            echo "Hari ikibazo cyabaye.";
        }
    }
} 
catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
?>