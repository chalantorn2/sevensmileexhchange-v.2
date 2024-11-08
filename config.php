<?php
$host = 'aws-0-us-east-1.pooler.supabase.com';
$port = '6543';
$dbname = 'postgres';
$user = 'postgres.fzmwpiymjgoaqypkivxm';
$password = 'Seven@Ex_241108';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    echo "การเชื่อมต่อล้มเหลว: " . $e->getMessage();
}
?>
