
<?php
session_start();
// Foydalanuvchidan kiritilgan ma'lumotlar
$email = $_POST['email'];
$password = $_POST['password'];

// Ma'lumotlar bazasi bilan bog'lanish
$host = ""; // yoki 127.0.0.1
$dbname = ""; // phpMyAdmin-dagi baza nomi
$username = ""; // phpMyAdmin foydalanuvchi nomi
$db_password = ""; // parol (agar yo'q bo'lsa, bo'sh)

// Agar foydalanuvchi login qilmagan bo‘lsa - login sahifaga yuborish
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <title>OsonEdu - Dashboard</title>
  <link rel="icon" href="/android-chrome-512x512.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #f5f7fa;
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
    header h1 {
      margin: 0;
    }
    nav a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: 500;
    }
    .hero {
      text-align: center;
      padding: 80px 20px;
      background: linear-gradient(135deg, #3498db, #2ecc71);
      color: white;
    }
    .hero h2 {
      font-size: 48px;
      margin-bottom: 20px;
    }
    .hero p {
      font-size: 20px;
      margin-bottom: 40px;
    }
    .hero a {
      background-color: white;
      color: #2c3e50;
      padding: 15px 30px;
      border-radius: 10px;
      font-weight: bold;
      text-decoration: none;
    }
    .section {
      padding: 60px 40px;
      text-align: center;
    }
    .section h3 {
      font-size: 32px;
      margin-bottom: 20px;
    }
    .section p {
      font-size: 18px;
      max-width: 700px;
      margin: 0 auto;
    }
   /* Footer */
    footer {
      background-color: #2c3e50;
      color: white;
      padding: 40px 20px;
    }
    .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0 auto;
    }
    .footer-section {
      flex: 1 1 300px;
      margin: 20px;
    }
    .footer-section h4 {
      font-size: 20px;
      margin-bottom: 10px;
      color: #fff;
    }
    .footer-section ul {
      list-style: none;
      padding: 0;
    }
    .footer-section li {
      margin: 5px 0;
    }
    .footer-section a {
      color: #ddd;
      text-decoration: none;
    }
    .footer-bottom {
      text-align: center;
      margin-top: 30px;
      border-top: 1px solid #444;
      padding-top: 20px;
      font-size: 14px;
    }
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        
      }
      .logo-container {
  display: flex;
  align-items: center;
}

.logo-container h1 {
  margin-left: 15px;
  font-size: 28px;
  color: white;
}

      nav {
        margin-top: 10px;
      }
      .footer-container {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

<header>
  <a href="index.php">
    <img src="OsonEdu.png" alt="OsonEdu logo" width="150">
  </a>
  <h1>OsonEdu</h1>
  <nav>
    <a href="dashboard.php">Bosh sahifa</a>
    <a href="#">Kurslar</a>
    <a href="#">O‘qituvchilar</a>
    <a href="#">Profil (<?php echo $_SESSION['username']; ?>)</a>
    <a href="logout.php">Chiqish</a>
  </nav>
</header>

<section class="hero">
  <h2>Xush kelibsiz, <?php echo $_SESSION['username']; ?>!</h2>
  <p>Shaxsiy dashboard panelingizga hush kelibsiz. Bu yerda kurslaringizni ko‘rib chiqishingiz va profil ma'lumotlaringizni yangilashingiz mumkin.</p>
  <a href="#">Kurslarimni ko‘rish</a>
</section>

<section class="section">
  <h3>Yangi kurslar</h3>
  <p>
    Siz uchun tavsiya etilgan yangi kurslarni ko‘rib chiqing va bilimlaringizni kengaytiring!
  </p>
</section>

<footer>
 <!-- Footer -->
<footer>
  <div class="footer-container">
    <div class="footer-section">
      <h4>Kontakt</h4>
      <ul>
        <li>📍 Jizzax shahri, O‘zbekiston</li>
        <li>📞 +998 90 123-45-67</li>
        <li>📧 info@osonedu.uz</li>
      </ul>
    </div>
    <div class="footer-section">
      <h4>Foydali havolalar</h4>
      <ul>
        <li><a href="#">Kurslar</a></li>
        <li><a href="#">O‘qituvchilar</a></li>
        <li><a href="#">Biz haqimizda</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h4>Ijtimoiy tarmoqlar</h4>
      <ul>
        <li><a href="#">Telegram</a></li>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">YouTube</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2025 OsonEdu. Barcha huquqlar himoyalangan.
  </div>
</footer>
</body>
</html>
