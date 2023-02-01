<form id="formeditbobot" method="post">
    <div class="form-group row">
        <label class="col-form-label">Kriteria</label>
        <div class="col-sm-12">
            <input type="text" value="<?= $dataBobot['namaKriteria'] ?>" id="editnama" class="form-control" name="nama" placeholder="nama mahasiswa" readonly>
            <!-- id calon anggota -->
            <input type="hidden" name="id_kriteria" id="idKriteria" value="<?= $dataBobot['id_kriteria'] ?>">
            <input type="hidden" name="id" id="idBobot" value="<?= $dataBobot['id_bobotkriteria'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label">Bobot <span class="text-xs text-secondary mb-0">1 - 100</span></label>

        <div class="col-sm-12">
            <input type="number" value="<?= $dataBobot['bobot'] ?>" id="editbobot" class="form-control" name="editBobot" min="1" max="100" required>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>