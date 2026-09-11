<?php $title = "Daftar Mahasiswa"; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Mahasiswa</h3>
    <a href="<?= $baseUrl ?>/mahasiswa/create" class="btn btn-primary">Tambah Mahasiswa</a>
</div>

<form method="GET" action="<?= $baseUrl ?>/mahasiswa" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Cari NIM atau Nama..." value="<?= htmlspecialchars($keyword ?? '') ?>">
        <button class="btn btn-outline-secondary" type="submit">Cari</button>
        <?php if (!empty($keyword)): ?>
            <a href="<?= $baseUrl ?>/mahasiswa" class="btn btn-outline-danger">Reset</a>
        <?php endif; ?>
    </div>
</form>

<?php if (isset($_SESSION['flash'])): ?>
    <?php if (strpos($_SESSION['flash'], 'Gagal') !== false): ?>
        <div class="alert alert-danger alert-dismissible fade show">
    <?php else: ?>
        <div class="alert alert-success alert-dismissible fade show">
    <?php endif; ?>
        <?= htmlspecialchars($_SESSION['flash']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($listMahasiswa)): ?>
            <tr><td colspan="8" class="text-center">Tidak ada data</td></tr>
        <?php else: ?>
            <?php $no = 1; foreach ($listMahasiswa as $mhs): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($mhs['nim'] ?? '') ?></td>
                    <td><?= htmlspecialchars($mhs['nama'] ?? '') ?></td>
                    <td><?= htmlspecialchars($mhs['email'] ?? '') ?></td>
                    <td><?= htmlspecialchars($mhs['nama_prodi'] ?? '') ?></td>
                    <td><?= $mhs['angkatan'] ?? '' ?></td>
                    <td>
                        <?php
                        $status = strtolower($mhs['status'] ?? 'aktif');
                        $badge = match($status) {
                            'aktif' => 'bg-success',
                            'cuti' => 'bg-warning text-dark',
                            'lulus' => 'bg-primary',
                            default => 'bg-secondary'
                        };
                        ?>
                        <span class="badge <?= $badge ?>"><?= ucfirst($status) ?></span>
                    </td>
                    <td>
                        <a href="<?= $baseUrl ?>/mahasiswa/<?= $mhs['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                        <form action="<?= $baseUrl ?>/mahasiswa/<?= $mhs['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>