<?php
// PHP qismi — foydalanuvchi ro‘yxatdan o'tishini qayta ishlash
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ma'lumotlar bazasi bilan bog'lanish
    $host = ""; // host adress
    $dbname = ""; // phpMyAdmin-dagi baza nomi
    $username = ""; // phpMyAdmin foydalanuvchi nomi
    $db_password = ""; // parol (agar yo'q bo'lsa, bo'sh)

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Bazaga ulanishda xatolik: " . htmlspecialchars($e->getMessage()));
    }

    // POST dan kelgan ma'lumotlar
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $passwordInput = trim($_POST['password'] ?? '');

    // Maydonlar to‘liq to‘ldirilganligini tekshirish
    if (empty($fullname) || empty($email) || empty($passwordInput)) {
        $message = "❌ Iltimos, barcha maydonlarni to‘ldiring.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "❌ Email manzili noto‘g‘ri formatda.";
    } else {
        // Email takrorlanmasligini tekshirish
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM register WHERE Email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetchColumn() > 0) {
            $message = "❌ Bu email allaqachon ro‘yxatdan o‘tgan.";
        } else {
            $hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO register (Name, Email, Password) VALUES (?, ?, ?)");
            if ($stmt->execute([$fullname, $email, $hashedPassword])) {
                $message = "✅ Ro‘yxatdan o‘tish muvaffaqiyatli amalga oshdi!";
            } else {
                $message = "❌ Xatolik: Foydalanuvchini saqlab bo‘lmadi.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>OsonEdu - Ro‘yxatdan o‘tish</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 { margin: 0; }
        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: 500;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; color: #2c3e50; }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover { background-color: #2980b9; }
        .message {
            text-align: center;
            font-size: 16px;
            color: green;
            margin-top: 10px;
        }
        .error { color: red; }
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <h1>OsonEdu</h1>
    <nav>
        <a href="index.html">Bosh sahifa</a>
        <a href="login.php">Kirish</a>
        <a href="register.php">Ro‘yxatdan o‘tish</a>
    </nav>
</header>

<div class="container">
    <h2>Ro‘yxatdan o‘tish</h2>
    <form action="register.php" method="POST">
        <input type="text" name="fullname" placeholder="F.I.Sh" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Parol" required>
        <button type="submit">Ro‘yxatdan o‘tish</button>
    </form>
    <?php if (!empty($message)): ?>
        <div class="message <?php echo (strpos($message, '❌') !== false) ? 'error' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
</div>

<footer>
    &copy; 2025 OsonEdu. Barcha huquqlar himoyalangan.
</footer>

</body>
</html>
