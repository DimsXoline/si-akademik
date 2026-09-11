<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SI Akademik' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= $baseUrl ?>/">SI AKADEMIK</a>
            <a class="navbar-brand" href="<?= $baseUrl ?>/">SI AKADEMIK</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="<?= $baseUrl ?>/mahasiswa">Mahasiswa</a>
                <a class="nav-link" href="<?= $baseUrl ?>/logout">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card shadow-sm p-4">
            <?= $content ?? '' ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>