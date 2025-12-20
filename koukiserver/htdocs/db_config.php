<?php
$host = 'mysql';       // MySQLホスト名（Dockerならコンテナ名、ローカルならlocalhost）
$username = 'data_user';
$password = 'data';
$database = 'test';
$charset = 'utf8mb4';

try {
    $dsn = "mysql:host={$host};dbname={$database};charset={$charset}";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
