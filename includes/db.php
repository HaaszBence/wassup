<?php
$host = getenv('DB_HOST') ?: 'db';
$dbname = getenv('MYSQL_DATABASE') ?: 'messagewall';
$user = 'root';
$pass = getenv('MYSQL_ROOT_PASSWORD') ?: 'change_this_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function getMessages() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addMessage($name, $message) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
    $stmt->execute([$name, $message]);
}
