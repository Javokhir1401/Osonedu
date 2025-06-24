<?php
session_start();

// Foydalanuvchidan kelgan ma'lumotlar
$email = $_POST['email'];
$password = $_POST['password'];

// Ma'lumotlar bazasiga ulanish
$host = ""; // host adress
$dbname = ""; // phpMyAdmin-dagi baza nomi
$username = ""; // phpMyAdmin foydalanuvchi nomi
$db_password = ""; // parol (agar yo'q bo'lsa, bo'sh)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bazaga ulanishda xatolik: " . $e->getMessage());
}

// Email bo‘yicha userni tekshirish
$stmt = $pdo->prepare("SELECT * FROM register WHERE Email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['Password'])) {
    // Muvaffaqiyatli login
    $_SESSION['username'] = $user['Name']; 
    $_SESSION['email'] = $user['Email'];

    // Agar email sizniki bo‘lsa admin panelga kiradi
    if ($user['Email'] === 'anvarortiqov17@gmail.com') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: dashboard.php");
    }
    exit();
} else {
    // Login xato
    echo "❌ Email yoki parol noto‘g‘ri!";
}
?>
