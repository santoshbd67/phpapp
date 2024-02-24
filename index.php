<?php
$host = 'your-rds-endpoint';
$db = 'your-database-name';
$user = 'your-database-user';
$pass = 'your-database-password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255))");

    // Insert data
    $pdo->exec("INSERT INTO users (name) VALUES ('John Doe')");

    // Read data
    $stmt = $pdo->query("SELECT * FROM users");
    while ($row = $stmt->fetch()) {
        echo "ID: {$row['id']}, Name: {$row['name']}<br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
