<?php
session_start();

// Faqat admin bo‘lsa, kirishga ruxsat
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin.html"); // Admin bo‘lmasa bosh sahifaga qaytarish
    exit();
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel - OsonEdu</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      padding: 0;
      background: #f0f2f5;
    }
    header {
      background: #003366;
      color: white;
      padding: 15px;
      text-align: center;
    }
    nav {
      width: 200px;
      background: #333;
      height: 100vh;
      float: left;
      color: white;
    }
    nav ul {
      list-style: none;
      padding: 0;
    }
    nav ul li {
      padding: 10px;
      border-bottom: 1px solid #444;
    }
    nav ul li:hover {
      background: #444;
      cursor: pointer;
    }
    main {
      margin-left: 200px;
      padding: 20px;
    }
    .logout {
      display: block;
      margin: 20px 0;
      padding: 10px;
      background-color: #e74c3c;
      color: white;
      text-align: center;
      border-radius: 4px;
      text-decoration: none;
      width: 160px;
    }
    .logout:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

  <header>
    <h1>OsonEdu Admin Paneli</h1>
  </header>

  <nav>
    <ul>
      <li>Bosh sahifa</li>
      <li><a href="users.php" style="color:white; text-decoration:none;">Foydalanuvchilar</a></li>
      <li>Kurslar</li>
      <li>Videolar</li>
      <li>Sozlamalar</li>
      <li><a href="logout.php" class="logout">Chiqish</a></li>
    </ul>
  </nav>

  <main>
    <h2>Dashboard</h2>
    <p>Bu yerda statistik ma’lumotlar chiqadi.</p>
  </main>

</body>
</html>
