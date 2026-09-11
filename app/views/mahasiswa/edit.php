<?php $title = "Edit Mahasiswa"; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Edit Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= $baseUrl ?>/mahasiswa/<?= $mahasiswa['id'] ?>">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" 
                               value="<?= htmlspecialchars($mahasiswa['nim']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= htmlspecialchars($mahasiswa['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="prodi_id" class="form-label">Program Studi</label>
                        <select class="form-select" id="prodi_id" name="prodi_id" required>
                            <?php foreach ($listProdi as $prodi): ?>
                                <option value="<?= $prodi['id'] ?>" 
                                    <?= ($prodi['id'] == $mahasiswa['prodi_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($prodi['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <input type="number" class="form-control" id="angkatan" name="angkatan" 
                               value="<?= $mahasiswa['angkatan'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="aktif" <?= ($mahasiswa['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                            <option value="cuti" <?= ($mahasiswa['status'] == 'cuti') ? 'selected' : '' ?>>Cuti</option>
                            <option value="lulus" <?= ($mahasiswa['status'] == 'lulus') ? 'selected' : '' ?>>Lulus</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= $baseUrl ?>/mahasiswa" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>