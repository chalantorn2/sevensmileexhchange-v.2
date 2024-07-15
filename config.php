<?php
$servername = getenv('dpg-cqaa5llds78s739o8j90-a.oregon-postgres.render.com');
$username = getenv('sevensmileexchange_user');
$password = getenv('ynwfIPoM9v1WqkkxaGCMeOfkrZWXpUe7');
$dbname = getenv('sevensmileexchange');

try {
    // สร้างการเชื่อมต่อ
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
    // ตั้งค่า PDO error mode เป็น exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
