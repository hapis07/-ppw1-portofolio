<?php
include_once("config.php");

if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$errors  = [];
$success = "";

if (isset($_POST['register'])) {
    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $password  = $_POST['password'];
    $confirm   = $_POST['confirm_password'];

    if (empty($username))   $errors[] = 'Username tidak boleh kosong';
    if (empty($email))      $errors[] = 'Email tidak boleh kosong';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email tidak valid';
    if (empty($full_name))  $errors[] = 'Nama lengkap tidak boleh kosong';
    if (strlen($password) < 6) $errors[] = 'Password minimal 6 karakter';
    if ($password !== $confirm) $errors[] = 'Konfirmasi password tidak cocok';

    $check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($check) > 0) $errors[] = 'Username atau email sudah terdaftar';

    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql    = "INSERT INTO users (username, email, full_name, password) VALUES ('$username', '$email', '$full_name', '$hashed')";
        
        if (mysqli_query($conn, $sql)) {
            $success = "Pendaftaran berhasil! Silakan <a href='login.php' class='alert-link'>Login</a>";
        } else {
            $errors[] = "Gagal menyimpan data ke database.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card shadow-sm border-0 rounded p-3 my-4" style="width: 100%; max-width: 500px;">
    <div class="card-body">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary">Buat Akun Baru</h4>
            <p class="text-muted small">Daftar untuk mengakses sistem CRUD</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger p-2 mb-3 small" role="alert">
                <ul class="mb-0 ps-3">
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success p-2 mb-3 small text-center" role="alert">
                <?= $success; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold small">Nama Lengkap</label>
                <input type="text" name="full_name" class="form-control" placeholder="Nama Lengkap" value="<?= isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '' ?>" required>
            </div>
            
            <div class="row g-2 mb-3">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold small">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold small">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@example.com" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                </div>
            </div>

            <div class="row g-2 mb-4">
                <div class="col-sm-6">
                    <label class="form-label fw-semibold small">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold small">Konfirmasi Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" name="register" class="btn btn-primary w-100">Daftar Sekarang</button>
        </form>

        <div class="text-center mt-4 small text-muted">
            Sudah punya akun? <a href="login.php" class="text-decoration-none">Masuk di sini</a>
        </div>
    </div>
</div>

</body>
</html>