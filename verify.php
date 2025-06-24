<?php
require 'config.php';

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    $stmt = $pdo->prepare("SELECT * FROM register WHERE Email = ? AND token = ?");
    $stmt->execute([$email, $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $stmt = $pdo->prepare("UPDATE register SET status = 'verified', token = NULL WHERE Email = ?");
        $stmt->execute([$email]);
        echo "✅ Emailingiz tasdiqlandi!";
    } else {
        echo "❌ Noto‘g‘ri link yoki token!";
    }
} else {
    echo "❌ Ma'lumot to‘liq emas!";
}
?>