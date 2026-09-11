<?php $title = "Tambah Mahasiswa"; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Mahasiswa Baru</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= $baseUrl ?>/mahasiswa">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" 
                               required 
                               oninvalid="this.setCustomValidity('NIM wajib diisi')" 
                               oninput="this.setCustomValidity('')">
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               required 
                               oninvalid="this.setCustomValidity('Nama wajib diisi')" 
                               oninput="this.setCustomValidity('')">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               required 
                               oninvalid="this.setCustomValidity('Email wajib diisi')" 
                               oninput="this.setCustomValidity('')">
                    </div>

                    <div class="mb-3">
                        <label for="prodi_id" class="form-label">Program Studi</label>
                        <select class="form-select" id="prodi_id" name="prodi_id" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($listProdi as $prodi): ?>
                                <option value="<?= $prodi['id'] ?>"><?= htmlspecialchars($prodi['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <input type="number" class="form-control" id="angkatan" name="angkatan" 
                               required 
                               oninvalid="this.setCustomValidity('Angkatan wajib diisi')" 
                               oninput="this.setCustomValidity('')">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="aktif">Aktif</option>
                            <option value="cuti">Cuti</option>
                            <option value="lulus">Lulus</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= $baseUrl ?>/mahasiswa" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>