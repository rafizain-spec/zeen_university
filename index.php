<?php 
$pageTitle = "Beranda";
require_once 'config/database.php';

$totalMhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM mahasiswa"))['total'] ?? 1000;
$totalDsn = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM dosen"))['total'] ?? 100;
$totalMk  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM matakuliah"))['total'] ?? 70;

include 'includes/header.php'; 
?>

  <!-- HERO SECTION -->
  <section class="hero">
    <div class="container hero-grid">
      <div>
        <span class="hero-badge">★ Terakreditasi Unggul • Tahun Akademik 2026/2027</span>
        <h1>Membangun masa depan lewat <span>keunggulan akademik</span>.</h1>
        <p>Zain University menaungi 6 fakultas unggulan dengan 28 program studi Sarjana (S1) terakreditasi nasional dan berstandar internasional.</p>
        <div class="hero-buttons">
          <a href="#fakultas" class="btn btn-primary">Jelajahi Program S1</a>
          <a href="login.php" class="btn btn-outline">Masuk Portal SIAKAD</a>
        </div>
      </div>

      <div class="hero-graphic">
        <div class="hero-emblem">
          <svg width="170" height="170" viewBox="0 0 200 200" fill="none" stroke="#e5b94c" stroke-width="2">
            <polygon points="100,18 18,64 182,64" />
            <circle cx="100" cy="44" r="7" />
            <line x1="28" y1="74" x2="172" y2="74" />
            <rect x="38" y="74" width="14" height="86" />
            <rect x="74" y="74" width="14" height="86" />
            <rect x="112" y="74" width="14" height="86" />
            <rect x="148" y="74" width="14" height="86" />
            <line x1="22" y1="160" x2="178" y2="160" />
            <line x1="12" y1="172" x2="188" y2="172" />
          </svg>
          <span>Est. 2010 • Excellence & Integrity</span>
        </div>
      </div>
    </div>
  </section>

  <!-- STATISTIK KAMPUS REAL-TIME -->
  <section class="stats-bar">
    <div class="container stats-grid">
      <div class="stat-item">
        <span class="stat-number">6</span>
        <span class="stat-label">Fakultas Unggulan</span>
      </div>
      <div class="stat-item">
        <span class="stat-number"><?php echo number_format($totalMhs); ?>+</span>
        <span class="stat-label">Mahasiswa Aktif</span>
      </div>
      <div class="stat-item">
        <span class="stat-number"><?php echo number_format($totalDsn); ?></span>
        <span class="stat-label">Dosen & Peneliti</span>
      </div>
      <div class="stat-item">
        <span class="stat-number"><?php echo number_format($totalMk); ?></span>
        <span class="stat-label">Mata Kuliah Terapan</span>
      </div>
    </div>
  </section>

  <!-- PROFIL UNIVERSITAS -->
  <section id="profil" class="profil">
    <div class="container profil-grid">
      <div>
        <span class="section-tag">Tentang Kampus</span>
        <h2>Profil Zain University</h2>
        <p>Zain University adalah institusi pendidikan tinggi modern yang berkomitmen mencetak lulusan Sarjana (S1) inovatif, berintegritas, dan siap bersaing di tingkat global.</p>
        <p>Didukung ekosistem pembelajaran digital terpadu (SIAKAD), laboratorium riset mutakhir, serta jejaring kemitraan industri lintas sektor.</p>
      </div>
      <div class="profil-table">
        <div class="profil-row">
          <span>Identitas Institusi</span>
          <span>Zain University</span>
        </div>
        <div class="profil-row">
          <span>Struktur Akademik</span>
          <span>6 Fakultas • 28 Program Studi S1</span>
        </div>
        <div class="profil-row">
          <span>Peringkat Regional</span>
          <span>Top Tier ASEAN University</span>
        </div>
        <div class="profil-row">
          <span>Sistem Akademik</span>
          <span>SIAKAD Terintegrasi</span>
        </div>
      </div>
    </div>
  </section>

  <!-- 6 FAKULTAS SECTION -->
  <section id="fakultas" class="fakultas">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Pilihan Akademik Sarjana (S1)</span>
        <h2>Enam Fakultas, Beragam Program Studi S1</h2>
        <p>Temukan program studi Sarjana (S1) yang sesuai dengan minat dan visi karier masa depan Anda.</p>
      </div>

      <div class="fakultas-grid">
        <!-- Fakultas 1 -->
        <div class="card">
          <div>
            <div class="card-top">
              <div class="card-icon-wrap">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#e5b94c" stroke-width="2">
                  <rect x="2" y="3" width="20" height="14" rx="2" />
                  <line x1="8" y1="21" x2="16" y2="21" />
                  <line x1="12" y1="17" x2="12" y2="21" />
                </svg>
              </div>
              <span class="akreditasi-pill">Akreditasi Unggul</span>
            </div>
            <h3>Fakultas Ilmu Teknologi & Komputer</h3>
            <div class="prodi-tags">
              <span class="prodi-tag">S1 Sistem Informasi</span>
              <span class="prodi-tag">S1 Teknik Informatika</span>
              <span class="prodi-tag">S1 Jaringan Komputer</span>
              <span class="prodi-tag">S1 Keamanan Siber</span>
              <span class="prodi-tag">S1 Kecerdasan Buatan</span>
              <span class="prodi-tag">S1 Rekayasa Perangkat Lunak</span>
              <span class="prodi-tag">S1 Sains Data</span>
              <span class="prodi-tag">S1 Sistem Komputer</span>
            </div>
            <p>Pusat unggulan komputasi modern yang mencakup sistem informasi enterprise, rekayasa perangkat lunak, jaringan komputer, keamanan siber, dan kecerdasan buatan.</p>
          </div>
          <div class="badge-box">
            <span class="badge-icon">★</span>
            <span>Peringkat tinggi se-ASEAN</span>
          </div>
        </div>

        <!-- Fakultas 2 -->
        <div class="card">
          <div>
            <div class="card-top">
              <div class="card-icon-wrap">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#e5b94c" stroke-width="2">
                  <line x1="12" y1="1" x2="12" y2="23" />
                  <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                </svg>
              </div>
              <span class="akreditasi-pill">Akreditasi Unggul</span>
            </div>
            <h3>Fakultas Ekonomi & Bisnis</h3>
            <div class="prodi-tags">
              <span class="prodi-tag">S1 Akuntansi</span>
              <span class="prodi-tag">S1 Manajemen</span>
              <span class="prodi-tag">S1 Ekonomi Pembangunan</span>
              <span class="prodi-tag">S1 Bisnis Digital</span>
            </div>
            <p>Menghasilkan auditor, analis keuangan, dan wirausahawan berintegritas tinggi dengan kurikulum berbasis standar keuangan global.</p>
          </div>
          <div class="badge-box">
            <span class="badge-icon">★</span>
            <span>Lulusan terbaik skala nasional</span>
          </div>
        </div>

        <!-- Fakultas 3 -->
        <div class="card">
          <div>
            <div class="card-top">
              <div class="card-icon-wrap">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#e5b94c" stroke-width="2">
                  <path d="M12 3v18" />
                  <path d="M5 7h14" />
                  <path d="M5 7l-3 7h6l-3-7z" />
                  <path d="M19 7l-3 7h6l-3-7z" />
                </svg>
              </div>
              <span class="akreditasi-pill">Akreditasi A</span>
            </div>
            <h3>Fakultas Hukum & Sosial</h3>
            <div class="prodi-tags">
              <span class="prodi-tag">S1 Ilmu Hukum</span>
              <span class="prodi-tag">S1 Hubungan Internasional</span>
              <span class="prodi-tag">S1 Administrasi Publik</span>
              <span class="prodi-tag">S1 Psikologi</span>
            </div>
            <p>Mendidik praktisi hukum, diplomat, dan analis kebijakan publik yang kritis, beretika, serta menguasai regulasi era digital.</p>
          </div>
          <div class="badge-box">
            <span class="badge-icon">★</span>
            <span>Mitra lembaga peradilan nasional</span>
          </div>
        </div>

        <!-- Fakultas 4 -->
        <div class="card">
          <div>
            <div class="card-top">
              <div class="card-icon-wrap">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#e5b94c" stroke-width="2">
                  <polygon points="12 2 2 7 12 12 22 7 12 2" />
                  <polyline points="2 17 12 22 22 17" />
                  <polyline points="2 12 12 17 22 12" />
                </svg>
              </div>
              <span class="akreditasi-pill">Akreditasi Unggul</span>
            </div>
            <h3>Fakultas Teknik & Arsitektur</h3>
            <div class="prodi-tags">
              <span class="prodi-tag">S1 Teknik Sipil</span>
              <span class="prodi-tag">S1 Arsitektur</span>
              <span class="prodi-tag">S1 Teknik Industri</span>
              <span class="prodi-tag">S1 Teknik Elektro</span>
            </div>
            <p>Mengembangkan inovasi infrastruktur berkelanjutan, desain perkotaan cerdas, sistem otomasi, serta optimasi manufaktur industri.</p>
          </div>
          <div class="badge-box">
            <span class="badge-icon">★</span>
            <span>Laboratorium riset terpadu</span>
          </div>
        </div>

        <!-- Fakultas 5 -->
        <div class="card">
          <div>
            <div class="card-top">
              <div class="card-icon-wrap">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#e5b94c" stroke-width="2">
                  <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                </svg>
              </div>
              <span class="akreditasi-pill">Akreditasi A</span>
            </div>
            <h3>Fakultas Ilmu Kesehatan</h3>
            <div class="prodi-tags">
              <span class="prodi-tag">S1 Farmasi</span>
              <span class="prodi-tag">S1 Kesehatan Masyarakat</span>
              <span class="prodi-tag">S1 Ilmu Gizi</span>
              <span class="prodi-tag">S1 Keperawatan</span>
            </div>
            <p>Menyiapkan tenaga profesional kesehatan yang kompeten melalui praktik klinis intensif dan riset biomedis modern.</p>
          </div>
          <div class="badge-box">
            <span class="badge-icon">★</span>
            <span>Terafiliasi rumah sakit pendidikan</span>
          </div>
        </div>

        <!-- Fakultas 6 -->
        <div class="card">
          <div>
            <div class="card-top">
              <div class="card-icon-wrap">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#e5b94c" stroke-width="2">
                  <circle cx="12" cy="12" r="10" />
                  <polygon points="10 8 16 12 10 16 10 8" />
                </svg>
              </div>
              <span class="akreditasi-pill">Akreditasi Unggul</span>
            </div>
            <h3>Fakultas Komunikasi & Desain</h3>
            <div class="prodi-tags">
              <span class="prodi-tag">S1 Ilmu Komunikasi</span>
              <span class="prodi-tag">S1 Desain Komunikasi Visual</span>
              <span class="prodi-tag">S1 Sastra Inggris</span>
              <span class="prodi-tag">S1 Animasi & Multimedia</span>
            </div>
            <p>Melahirkan kreator digital, strategis komunikasi korporat, dan desainer visual yang adaptif terhadap ekosistem media masa kini.</p>
          </div>
          <div class="badge-box">
            <span class="badge-icon">★</span>
            <span>Studio produksi multimedia modern</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FASILITAS UNGGULAN -->
  <section id="fasilitas" class="fasilitas">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Ekosistem Kampus</span>
        <h2>Fasilitas Penunjang Akademik</h2>
        <p>Lingkungan belajar modern yang dirancang untuk mendukung kreativitas dan riset mahasiswa.</p>
      </div>

      <div class="fasilitas-grid">
        <div class="fasilitas-card">
          <h4>Digital Library</h4>
          <p>Akses ribuan jurnal ilmiah internasional, e-book, dan ruang baca kolaboratif 24 jam.</p>
        </div>
        <div class="fasilitas-card">
          <h4>Smart & Network Lab</h4>
          <p>Lab komputer spesifikasi tinggi, lab jaringan Cisco/MikroTik, dan studio desain.</p>
        </div>
        <div class="fasilitas-card">
          <h4>SIAKAD Terpadu</h4>
          <p>Pengisian KRS, pemantauan presensi, jadwal kuliah, dan transkrip nilai secara real-time.</p>
        </div>
        <div class="fasilitas-card">
          <h4>Career & Innovation Hub</h4>
          <p>Inkubator startup mahasiswa dan pusat penyaluran karier ke perusahaan multinasional.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA PENDAFTARAN -->
  <section id="pendaftaran" class="cta">
    <div class="container">
      <div class="cta-box">
        <div class="cta-text">
          <h2>Mulai perjalanan akademik Anda bersama Zain University</h2>
          <p>Pendaftaran mahasiswa baru dibuka untuk seluruh 28 Program Studi S1. Masuk ke portal akademik untuk mengakses layanan mahasiswa, dosen, dan administrasi.</p>
        </div>
        <a href="login.php" class="btn btn-primary">Akses Portal Akademik</a>
      </div>
    </div>
  </section>

<?php include 'includes/footer.php'; ?>