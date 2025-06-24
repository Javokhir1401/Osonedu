<?php
// Sessiyani boshlash (agar kerak bo‘lsa, admin ekanini tekshirishing ham mumkin)
session_start();

// Ma'lumotlar bazasi bilan bog‘lanish
$host = ""; // host adress
$dbname = ""; // phpMyAdmin-dagi baza nomi
$username = ""; // phpMyAdmin foydalanuvchi nomi
$db_password = ""; // parol (agar yo'q bo'lsa, bo'sh)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bazaga ulanishda xatolik: " . $e->getMessage());
}

// Foydalanuvchilarni olish
$stmt = $pdo->query("SELECT Name, Email FROM register");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Foydalanuvchilar - OsonEdu</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #003366;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        a.back {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            background: #3498db;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
        }
        a.back:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Foydalanuvchilar Ro‘yxati</h2>

<table>
    <tr>
        <th>#</th>
        <th>Ismi</th>
        <th>Email</th>
    </tr>
    <?php if ($users): ?>
        <?php foreach ($users as $index => $user): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo htmlspecialchars($user['Name']); ?></td>
                <td><?php echo htmlspecialchars($user['Email']); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="3">Hech qanday foydalanuvchi topilmadi.</td></tr>
    <?php endif; ?>
</table>

<a href="admin_dashboard.php" class="back">Orqaga</a>

</body>
</html>

