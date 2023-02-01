<form id="formEditmahasiswa" method="post">
    <div class="form-group row">
        <label class="col-form-label">Nama</label>
        <div class="col-sm-12">
            <input type="text" value="<?= $datapermahasiswa['nama_mahasiswa'] ?>" id="editnama" class="form-control" name="nama" placeholder="nama mahasiswa" required>
            <!-- id calon anggota -->
            <input type="hidden" name="id" id="idmahasiswa" value="<?= $datapermahasiswa['id_mahasiswa'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label">NIM</label>
        <div class="col-sm-12">
            <input type="number" value="<?= $datapermahasiswa['nim'] ?>" id="editnim" class="form-control" name="nim" placeholder="nim" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label">Jurusan</label>
        <div class="col-sm-12">
            <select class="form-control" id="editjurusan" name="jurusan" style="z-index: 10; position: relative;" required>
                <optgroup label="D3">
                    <option <?php $datapermahasiswa['jurusan_mahasiswa'] == 'Sistem Informasi Akuntansi' ? 'selected' : ''  ?>>Sistem Informasi Akuntansi</option>
                    <option <?php $datapermahasiswa['jurusan_mahasiswa'] == 'Teknologi Komputer' ? 'selected' : ''  ?>>Teknologi Komputer</option>
                    <option <?php $datapermahasiswa['jurusan_mahasiswa'] == 'Rekayasa Perangkat Lunak Aplikasi' ? 'selected' : ''  ?>>Rekayasa Perangkat Lunak Aplikasi</option>
                <optgroup label="S1">
                    <option <?php $datapermahasiswa['jurusan_mahasiswa'] == 'Informatika' ? 'selected' : ''  ?>>Informatika</option>
                    <option <?php $datapermahasiswa['jurusan_mahasiswa'] == 'Sistem Informasi' ? 'selected' : ''  ?>>Sistem Informasi</option>
                    <option <?php $datapermahasiswa['jurusan_mahasiswa'] == 'Teknik Komputer' ? 'selected' : ''  ?>>Teknik Komputer</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>