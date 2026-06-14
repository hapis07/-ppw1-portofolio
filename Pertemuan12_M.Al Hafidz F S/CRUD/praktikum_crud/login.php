<?php
include_once("config.php");

if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query  = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            header('Location: index.php');
            exit();
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card shadow-sm border-0 rounded p-3" style="width: 100%; max-width: 400px;">
    <div class="card-body">
        <div class="text-center mb-4">
            <span class="fs-1">🎓</span>
            <h4 class="fw-bold text-primary mt-2">Selamat Datang</h4>
            <p class="text-muted small">Masuk ke Sistem Pendataan Mahasiswa</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger p-2 small text-center" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold small">Username atau Email</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username / email" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold small">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
        </form>

        <div class="text-center mt-4 small text-muted">
            Belum punya akun? <a href="register.php" class="text-decoration-none">Daftar di sini</a>
        </div>
    </div>
</div>

</body>
</html>