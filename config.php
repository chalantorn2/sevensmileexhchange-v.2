<?php
$servername = getenv('dpg-cqaa5llds78s739o8j90-a.oregon-postgres.render.com');
$username = getenv('sevensmileexchange_user');
$password = getenv('ynwfIPoM9v1WqkkxaGCMeOfkrZWXpUe7');
$dbname = getenv('sevensmileexchange');

try {
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
