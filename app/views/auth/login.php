<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg border-0 rounded-4" style="width: 100%; max-width: 400px;">
        <div class="card-body p-4 p-sm-5">
            <div class="text-center mb-4">
                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-lock fs-2"></i>
                </div>
                <h4 class="fw-bold">Selamat Datang</h4>
                <p class="text-muted fs-7">Silakan login untuk mengakses sistem</p>
            </div>

            <?php if (isset($_SESSION['flash'])): ?>
                <script>alert("<?= htmlspecialchars($_SESSION['flash']) ?>");</script>
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> <?= htmlspecialchars($_SESSION['flash']) ?>
                </div>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>

            <form method="POST" action="<?= $baseUrl ?>/login-process">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="admin" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-key"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="admin123" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                </button>
            </form>
        </div>
    </div>
</body>
</html>