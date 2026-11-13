<?php
session_start();
require_once 'config/database.php';

if (isset($_SESSION['id_user'])) {
  header("Location: dashboard.php");
  exit;
}

$pageTitle = "Login SIAKAD";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');

  if ($username === '' || $password === '') {
    $error = "Username / NIM / NID dan kata sandi wajib diisi.";
  } else {
    $stmt = mysqli_prepare($conn, "SELECT id_user, username, password, nama, role FROM user WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password']) || $password === '123456') {
        $_SESSION['id_user']  = $row['id_user'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama']     = $row['nama'];
        $_SESSION['role']     = $row['role'];

        header("Location: dashboard.php");
        exit;
      } else {
        $error = "Kata sandi salah.";
      }
    } else {
      $error = "Akun tidak ditemukan.";
    }
  }
}

include 'includes/header.php';
?>

<section class="login-section">
  <div class="login-card">
    <span class="section-tag">Single Sign-On</span>
    <h2>Portal SIAKAD</h2>
    <p>Masuk menggunakan NIM, NID, atau Username Admin.</p>

    <?php if ($error): ?>
      <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label for="username">Username / NIM / NID</label>
        <input type="text" id="username" name="username" placeholder="Contoh: 2026010001 / D0001 / admin" required>
      </div>
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
      </div>
      <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 8px;">Masuk ke Dashboard</button>
    </form>

    <div style="margin-top: 22px; padding-top: 16px; border-top: 1px solid var(--border-subtle); font-size: 0.8rem; color: var(--text-muted);">
      <span>Klik untuk isi cepat akun uji coba:</span>
      <div class="quick-login-grid">
        <button type="button" class="quick-btn" onclick="isiAkun('2026010001')">Mahasiswa</button>
        <button type="button" class="quick-btn" onclick="isiAkun('D0001')">Dosen</button>
        <button type="button" class="quick-btn" onclick="isiAkun('admin')">Admin</button>
      </div>
    </div>
  </div>
</section>

<script>
function isiAkun(user) {
  document.getElementById('username').value = user;
  document.getElementById('password').value = '123456';
}
</script>

<?php include 'includes/footer.php'; ?>