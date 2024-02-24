<?php
// Use environment variables for database connection
$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME');

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Read data from the database
    $selectQuery = 'SELECT * FROM users';
    $result = $pdo->query($selectQuery);

    // Display the retrieved data
    echo '<h2>Users</h2>';
    echo '<ul>';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<li>' . $row['name'] . ' - ' . $row['email'] . '</li>';
    }
    echo '</ul>';

    // Insert data into the database
    $insertQuery = "INSERT INTO users (name, email) VALUES ('John Doe', 'john.doe@example.com')";
    $pdo->exec($insertQuery);
    echo '<p>New record created successfully.</p>';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

// Close the PDO connection
$pdo = null;
?>
