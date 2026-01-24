<?php
session_start();

if (!isset($_SESSION['stone'])) {
    $_SESSION['stone'] = 0;
}

$_SESSION['stone']++;

header('Content-Type: application/json');
echo json_encode([
    'stone' => $_SESSION['stone']
]);
