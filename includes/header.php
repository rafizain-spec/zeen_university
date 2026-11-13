<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($pageTitle) ? $pageTitle . ' - Zain University' : 'Zain University'; ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <header>
    <div class="container navbar">
      <a href="index.php" class="brand">
        <div class="brand-icon">Z</div>
        <span>ZAIN UNIVERSITY</span>
      </a>
      <ul class="nav-links">
        <li><a href="index.php#profil">Profil</a></li>
        <li><a href="index.php#fakultas">6 Fakultas</a></li>
        <li><a href="index.php#fasilitas">Fasilitas</a></li>
        <?php if (isset($_SESSION['id_user'])): ?>
          <li><a href="dashboard.php" class="nav-btn">Dashboard (<?php echo htmlspecialchars($_SESSION['role']); ?>)</a></li>
          <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="index.php#pendaftaran">Admisi</a></li>
          <li><a href="login.php" class="nav-btn">Portal Zeen</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </header>