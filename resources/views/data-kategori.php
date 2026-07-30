<?php
// ==== Koneksi Database ====
// Sesuaikan host, username, password, dan nama database dengan punya kamu
$koneksi = mysqli_connect("localhost", "root", "", "nama_database");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// ==== Ambil data kategori ====
// Sesuaikan nama tabel & kolom dengan struktur database kamu
$query = "SELECT kode, nama_kategori, digunakan FROM kategori ORDER BY kode DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Kategori</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<style>
  .body-card {
    background-color: #0f1224;
    padding: 40px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }

  .kategori-card {
    background-color: #1a1e38;
    border-radius: 14px;
    padding: 28px;
    color: #ffffff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  }

  .kategori-card h5 {
    font-weight: 700;
    margin-bottom: 0;
  }

  .btn-add {
    background-color: #6c63ff;
    color: #fff;
    border: none;
  }
  .btn-add:hover { background-color: #5a52e0; color: #fff; }

  .btn-trash {
    background-color: #d92d3f;
    color: #fff;
    border: none;
  }
  .btn-trash:hover { background-color: #c0212f; color: #fff; }

  .search-box {
    background-color: #232849;
    border: none;
    color: #fff;
  }
  .search-box::placeholder { color: #9aa0c3; }

  .search-icon-btn {
    background-color: #6c63ff;
    border: none;
    color: #fff;
  }

  .sort-btn {
    background-color: #232849;
    border: none;
    color: #fff;
  }

  table {
    color: #ffffff;
  }

  thead th {
    border-bottom: 1px solid #2c3157 !important;
    font-weight: 700;
    color: #ffffff;
  }

  tbody td {
    border-bottom: 1px solid #232849 !important;
    vertical-align: middle;
    color: #d7d9ec;
  }

  .btn-edit {
    background-color: #f5a623;
    color: #1a1e38;
    border: none;
    font-weight: 600;
    padding: 4px 16px;
    border-radius: 6px;
  }

  .btn-hapus {
    background-color: #ef4060;
    color: #fff;
    border: none;
    font-weight: 600;
    padding: 4px 16px;
    border-radius: 6px;
  }

  .pagination .page-link {
    background-color: #232849;
    border: none;
    color: #fff;
    margin: 0 2px;
    border-radius: 6px;
  }

  .pagination .page-item.active .page-link {
    background-color: #6c63ff;
    color: #fff;
  }

  .entries-info {
    color: #9aa0c3;
    font-size: 0.9rem;
  }
</style>
</head>
<body>

<div class="kategori-card">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5>Data Kategori</h5>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <button class="btn btn-add me-2"><i class="bi bi-plus-circle"></i> Add</button>
      <button class="btn btn-trash"><i class="bi bi-trash"></i> Trash</button>
    </div>

    <div class="d-flex align-items-center">
      <button class="sort-btn me-2 px-2 py-2 rounded">&#8593;&#8595;</button>
      <input type="text" class="form-control search-box me-2" placeholder="Cari...">
      <button class="search-icon-btn px-3 py-2 rounded">&#128269;</button>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama Kategori</th>
          <th>Digunakan</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
          <td><?= htmlspecialchars($row['kode']) ?></td>
          <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
          <td><?= htmlspecialchars($row['digunakan']) ?></td>
          <td class="text-center">
            <button class="btn-edit">Edit</button>
            <button class="btn-hapus ms-2">Hapus</button>
          </td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
          <td colspan="4" class="text-center">Belum ada data kategori.</td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between align-items-center mt-3">
    <?php
    $total_rows = $result ? mysqli_num_rows($result) : 0;
    ?>
    <span class="entries-info">Showing 1 to <?= $total_rows ?> of <?= $total_rows ?> entries</span>

    <nav>
      <ul class="pagination mb-0">
        <li class="page-item"><a class="page-link" href="#">&lt;</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
      </ul>
    </nav>
  </div>

</div>

</body>
</html>
<?php
mysqli_close($koneksi);
?>
