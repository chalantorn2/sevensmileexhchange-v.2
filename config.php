<?php
$servername = getenv('DATABASE_HOST');
$username = getenv('DATABASE_USER');
$password = getenv('DATABASE_PASSWORD');
$dbname = getenv('DATABASE_NAME');

try {
    // เพิ่ม sslmode=require เพื่อบังคับใช้ SSL ในการเชื่อมต่อ
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname;sslmode=require", $username, $password);
    // ตั้งค่าให้ PDO แสดงข้อผิดพลาด
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
