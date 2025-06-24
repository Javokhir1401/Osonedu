<?php
$host = ""; // host adress
$dbname = ""; // phpMyAdmin-dagi baza nomi
$username = ""; // phpMyAdmin foydalanuvchi nomi
$db_password = ""; // parol (agar yo'q bo'lsa, bo'sh)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB ulanmadi: " . $e->getMessage());
}
?>