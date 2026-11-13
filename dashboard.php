<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit;
}

$pageTitle = "Dashboard Akademik";
$role = $_SESSION['role'];
$username = $_SESSION['username'];
$nama = $_SESSION['nama'];
$tab = $_GET['tab'] ?? 'ringkasan';
$cari = trim($_GET['cari'] ?? '');

include 'includes/header.php';
?>

<section class="dashboard-wrap">
  <div class="container">
    <!-- HEADER PORTAL -->
    <div class="dash-header">
      <div>
        <span class="section-tag">Portal <?php echo htmlspecialchars(strtoupper($role)); ?></span>
        <h2 style="font-size: 2rem; margin-bottom: 4px;">Selamat datang, <?php echo htmlspecialchars($nama); ?></h2>
        <p style="color: var(--text-muted); font-size: 0.9rem;">ID Pengguna: <strong style="color: var(--gold);"><?php echo htmlspecialchars($username); ?></strong> • Tahun Akademik 2026/2027</p>
      </div>
      <a href="logout.php" class="btn btn-outline btn-sm">Keluar (Logout)</a>
    </div>

    <?php if ($role === 'admin'): ?>
      <?php
      $jmlMhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM mahasiswa"))['total'];
      $jmlDsn = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM dosen"))['total'];
      $jmlMk  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM matakuliah"))['total'];
      $jmlJdw = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM jadwal"))['total'];
      ?>

      <!-- TAB NAVIGASI ADMIN -->
      <div class="dash-tabs">
        <a href="?tab=ringkasan" class="tab-btn <?php echo $tab === 'ringkasan' ? 'active' : ''; ?>">Ringkasan Statistik</a>
        <a href="?tab=mahasiswa" class="tab-btn <?php echo $tab === 'mahasiswa' ? 'active' : ''; ?>">Mahasiswa (<?php echo $jmlMhs; ?>)</a>
        <a href="?tab=dosen" class="tab-btn <?php echo $tab === 'dosen' ? 'active' : ''; ?>">Dosen (<?php echo $jmlDsn; ?>)</a>
        <a href="?tab=matakuliah" class="tab-btn <?php echo $tab === 'matakuliah' ? 'active' : ''; ?>">Mata Kuliah (<?php echo $jmlMk; ?>)</a>
        <a href="?tab=jadwal" class="tab-btn <?php echo $tab === 'jadwal' ? 'active' : ''; ?>">Jadwal Kelas (<?php echo $jmlJdw; ?>)</a>
      </div>

      <?php if ($tab === 'ringkasan'): ?>
        <div class="fakultas-grid" style="grid-template-columns: repeat(2, 1fr);">
          <div class="card">
            <h3>Total Mahasiswa</h3>
            <span class="stat-number" style="margin: 12px 0;"><?php echo number_format($jmlMhs); ?> Mahasiswa</span>
            <p>Terdaftar aktif pada seluruh program studi.</p>
            <a href="?tab=mahasiswa" class="btn btn-outline btn-sm">Lihat Daftar Mahasiswa →</a>
          </div>
          <div class="card">
            <h3>Total Dosen</h3>
            <span class="stat-number" style="margin: 12px 0;"><?php echo number_format($jmlDsn); ?> Dosen</span>
            <p>Tenaga pengajar tetap dan peneliti aktif.</p>
            <a href="?tab=dosen" class="btn btn-outline btn-sm">Lihat Daftar Dosen →</a>
          </div>
          <div class="card">
            <h3>Total Mata Kuliah</h3>
            <span class="stat-number" style="margin: 12px 0;"><?php echo number_format($jmlMk); ?> Mata Kuliah</span>
            <p>Kurikulum aktif lintas 6 fakultas.</p>
            <a href="?tab=matakuliah" class="btn btn-outline btn-sm">Lihat Mata Kuliah →</a>
          </div>
          <div class="card">
            <h3>Jadwal Perkuliahan</h3>
            <span class="stat-number" style="margin: 12px 0;"><?php echo number_format($jmlJdw); ?> Kelas Aktif</span>
            <p>Terjadwal pada ruang kelas & laboratorium.</p>
            <a href="?tab=jadwal" class="btn btn-outline btn-sm">Lihat Jadwal Kelas →</a>
          </div>
        </div>

      <?php elseif ($tab === 'mahasiswa'): ?>
        <div class="data-panel">
          <div class="panel-toolbar">
            <h3 style="color: var(--gold);">Direktori Mahasiswa (Menampilkan maks. 50 data)</h3>
            <form method="GET" style="display: flex; gap: 8px;">
              <input type="hidden" name="tab" value="mahasiswa">
              <input type="text" name="cari" class="search-input" placeholder="Cari NIM / Nama / Jurusan..." value="<?php echo htmlspecialchars($cari); ?>" style="width: 260px;">
              <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            </form>
          </div>
          <?php
          $sqlMhs = "SELECT * FROM mahasiswa";
          if ($cari !== '') {
            $safe = mysqli_real_escape_string($conn, $cari);
            $sqlMhs .= " WHERE nim LIKE '%$safe%' OR nama_lengkap LIKE '%$safe%' OR jurusan LIKE '%$safe%'";
          }
          $sqlMhs .= " LIMIT 50";
          $resMhs = mysqli_query($conn, $sqlMhs);
          ?>
          <table class="data-table">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Program Studi / Jurusan</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($r = mysqli_fetch_assoc($resMhs)): ?>
                <tr>
                  <td style="color: var(--gold); font-weight: 600;"><?php echo htmlspecialchars($r['nim']); ?></td>
                  <td><?php echo htmlspecialchars($r['nama_lengkap']); ?></td>
                  <td><?php echo htmlspecialchars($r['jurusan']); ?></td>
                  <td><span class="grade-badge">Aktif</span></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

      <?php elseif ($tab === 'dosen'): ?>
        <div class="data-panel">
          <h3 style="color: var(--gold); margin-bottom: 16px;">Direktori Dosen Pengajar</h3>
          <?php $resDsn = mysqli_query($conn, "SELECT * FROM dosen LIMIT 100"); ?>
          <table class="data-table">
            <thead>
              <tr>
                <th>NID</th>
                <th>Nama Lengkap & Gelar</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($r = mysqli_fetch_assoc($resDsn)): ?>
                <tr>
                  <td style="color: var(--gold); font-weight: 600;"><?php echo htmlspecialchars($r['nid']); ?></td>
                  <td><?php echo htmlspecialchars($r['nama_lengkap']); ?></td>
                  <td><span class="grade-badge">Dosen Tetap</span></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

      <?php elseif ($tab === 'matakuliah'): ?>
        <div class="data-panel">
          <h3 style="color: var(--gold); margin-bottom: 16px;">Daftar Kurikulum Mata Kuliah</h3>
          <?php $resMk = mysqli_query($conn, "SELECT * FROM matakuliah LIMIT 100"); ?>
          <table class="data-table">
            <thead>
              <tr>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>Bobot SKS</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($r = mysqli_fetch_assoc($resMk)): ?>
                <tr>
                  <td style="color: var(--gold); font-weight: 600;"><?php echo htmlspecialchars($r['kode_mk']); ?></td>
                  <td><?php echo htmlspecialchars($r['nama_mk']); ?></td>
                  <td><?php echo htmlspecialchars($r['sks']); ?> SKS</td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

      <?php elseif ($tab === 'jadwal'): ?>
        <div class="data-panel">
          <h3 style="color: var(--gold); margin-bottom: 16px;">Jadwal Perkuliahan Aktif</h3>
          <?php
          $resJdw = mysqli_query($conn, "
            SELECT j.*, m.nama_mk, m.sks, d.nama_lengkap AS nama_dosen
            FROM jadwal j
            JOIN matakuliah m ON j.kode_mk = m.kode_mk
            JOIN dosen d ON j.nid = d.nid
            ORDER BY j.id_jadwal ASC
          ");
          ?>
          <table class="data-table">
            <thead>
              <tr>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Hari & Jam</th>
                <th>Ruangan</th>
                <th>Dosen Pengampu</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($r = mysqli_fetch_assoc($resJdw)): ?>
                <tr>
                  <td style="color: var(--gold); font-weight: 600;"><?php echo htmlspecialchars($r['kode_mk']); ?></td>
                  <td><?php echo htmlspecialchars($r['nama_mk']); ?></td>
                  <td><?php echo htmlspecialchars($r['sks']); ?></td>
                  <td><?php echo $r['hari'] . ', ' . substr($r['jam_mulai'],0,5) . ' - ' . substr($r['jam_selesai'],0,5); ?></td>
                  <td><span class="grade-badge"><?php echo htmlspecialchars($r['ruangan']); ?></span></td>
                  <td><?php echo htmlspecialchars($r['nama_dosen']); ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>

    <?php elseif ($role === 'dosen'): ?>
      <?php
      $qJadwal = mysqli_query($conn, "
        SELECT j.*, m.nama_mk, m.sks
        FROM jadwal j
        JOIN matakuliah m ON j.kode_mk = m.kode_mk
        WHERE j.nid = '$username'
      ");
      ?>
      <div class="data-panel">
        <h3 style="margin-bottom: 16px; color: var(--gold);">Jadwal Mengajar Dosen (NID: <?php echo htmlspecialchars($username); ?>)</h3>
        <table class="data-table">
          <thead>
            <tr>
              <th>Kode MK</th>
              <th>Mata Kuliah</th>
              <th>SKS</th>
              <th>Hari</th>
              <th>Waktu</th>
              <th>Ruangan</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($qJadwal)): ?>
              <tr>
                <td style="color: var(--gold); font-weight: 600;"><?php echo htmlspecialchars($row['kode_mk']); ?></td>
                <td style="font-weight: 600;"><?php echo htmlspecialchars($row['nama_mk']); ?></td>
                <td><?php echo htmlspecialchars($row['sks']); ?> SKS</td>
                <td><?php echo htmlspecialchars($row['hari']); ?></td>
                <td><?php echo substr($row['jam_mulai'],0,5) . ' - ' . substr($row['jam_selesai'],0,5); ?></td>
                <td><span class="grade-badge"><?php echo htmlspecialchars($row['ruangan']); ?></span></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>

    <?php else: ?>
      <?php
      $qMhs = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$username'");
      $mhs = mysqli_fetch_assoc($qMhs);

      $qKrs = mysqli_query($conn, "
        SELECT k.*, m.kode_mk, m.nama_mk, m.sks, j.hari, j.jam_mulai, j.jam_selesai, j.ruangan, d.nama_lengkap AS nama_dosen
        FROM krs k
        JOIN jadwal j ON k.id_jadwal = j.id_jadwal
        JOIN matakuliah m ON j.kode_mk = m.kode_mk
        JOIN dosen d ON j.nid = d.nid
        WHERE k.nim = '$username'
      ");
      ?>
      <div class="profil-table" style="margin-bottom: 28px;">
        <div class="profil-row"><span>Nomor Induk Mahasiswa (NIM)</span><span><?php echo htmlspecialchars($mhs['nim'] ?? $username); ?></span></div>
        <div class="profil-row"><span>Nama Lengkap</span><span><?php echo htmlspecialchars($mhs['nama_lengkap'] ?? $nama); ?></span></div>
        <div class="profil-row"><span>Program Studi / Jurusan</span><span><?php echo htmlspecialchars($mhs['jurusan'] ?? '-'); ?></span></div>
        <div class="profil-row"><span>Status Akademik</span><span>Aktif • Semester Berjalan</span></div>
      </div>

      <div class="data-panel">
        <h3 style="margin-bottom: 16px; color: var(--gold);">Kartu Rencana Studi (KRS) & Hasil Studi</h3>
        <table class="data-table">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Mata Kuliah</th>
              <th>SKS</th>
              <th>Jadwal & Ruang</th>
              <th>Dosen Pengampu</th>
              <th>TM / UTS / UAS</th>
              <th>Nilai Akhir</th>
              <th>Grade</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($qKrs)): ?>
              <tr>
                <td style="color: var(--gold); font-weight: 600;"><?php echo htmlspecialchars($row['kode_mk']); ?></td>
                <td style="font-weight: 600;"><?php echo htmlspecialchars($row['nama_mk']); ?></td>
                <td><?php echo htmlspecialchars($row['sks']); ?></td>
                <td><?php echo $row['hari'] . ', ' . substr($row['jam_mulai'],0,5) . '-' . substr($row['jam_selesai'],0,5) . ' (' . $row['ruangan'] . ')'; ?></td>
                <td><?php echo htmlspecialchars($row['nama_dosen']); ?></td>
                <td><?php echo ($row['nilai_tm'] ?? '-') . ' / ' . ($row['nilai_uts'] ?? '-') . ' / ' . ($row['nilai_uas'] ?? '-'); ?></td>
                <td style="color: var(--gold); font-weight: 600;"><?php echo $row['nilai_akhir'] ?? '-'; ?></td>
                <td><span class="grade-badge"><?php echo $row['grade'] ?? '-'; ?></span></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>