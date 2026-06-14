<?php
include_once("config.php");
requireLogin();

$errors = [];
$foto_filename = null;

if (isset($_POST['submit'])) {
    $nim     = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $alamat  = mysqli_real_escape_string($conn, $_POST['alamat']);

    if (empty($nim))     $errors[] = 'NIM tidak boleh kosong';
    if (empty($nama))    $errors[] = 'Nama tidak boleh kosong';
    if (empty($jurusan)) $errors[] = 'Jurusan tidak boleh kosong';
    
    if (empty($email)) {
        $errors[] = 'Email tidak boleh kosong';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid';
    }

    if (empty($errors)) {
        $chk = mysqli_query($conn, "SELECT nim FROM mahasiswa WHERE nim='$nim'");
        if (mysqli_num_rows($chk) > 0) {
            $errors[] = 'NIM sudah terdaftar';
        }
    }

    if (empty($errors) && !empty($_FILES['foto']['name'])) {
        $upload = uploadFile($_FILES['foto']);
        if ($upload['success']) {
            $foto_filename = $upload['filename'];
        } else {
            $errors[] = $upload['message'];
        }
    }

    if (empty($errors)) {
        $foto_sql = $foto_filename ? "'$foto_filename'" : 'NULL';
        
        $sql = "INSERT INTO mahasiswa (nim, nama, jurusan, email, alamat, foto) 
                VALUES ('$nim', '$nama', '$jurusan', '$email', '$alamat', $foto_sql)";
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = 'Data berhasil ditambahkan!';
            header('Location: index.php');
            exit();
        } else {
            $errors[] = 'Error: ' . mysqli_error($conn);
            if ($foto_filename) deleteFile($foto_filename);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0 rounded">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold text-primary mb-4">Tambah Data Mahasiswa</h5>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger p-2 mb-3 small" role="alert">
                    <ul class="mb-0 ps-3">
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="tambah.php" method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Foto Profil</label>
                    <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                    <div class="form-text text-muted" style="font-size: 11px;">Format: JPG, PNG, GIF. Maks: 5MB</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">NIM <span class="text-danger">*</span></label>
                    <input type="text" name="nim" class="form-control" required value="<?= isset($_POST['nim']) ? htmlspecialchars($_POST['nim']) : ''; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" required value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Jurusan <span class="text-danger">*</span></label>
                    <input type="text" name="jurusan" class="form-control" required value="<?= isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan']) : ''; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"><?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="submit" class="btn btn-primary px-4">Simpan</button>
                    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>