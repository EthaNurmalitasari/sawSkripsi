 <form id="formEditNilaimahasiswa">
     <div class="form-group row">
         <label class="col-form-label">Nama Calon Anggota</label>
         <div class="col-sm-12">
             <input type="text" value="<?= $dataAnggota['nama_mahasiswa'] ?>" class="form-control" readonly>
             <input type="hidden" name="id" id="edit_id_mahasiswa" value="<?= $dataAnggota['id_mahasiswa'] ?>">
         </div>
         <?php foreach ($dataNilai as $dn) { ?>
             <div class="form-group row">
                 <label class="col-form-label"><?= $dn['namaKriteria']; ?></label>
                 <input type="text" class="id_kriteria" hidden id="edit_id_kriteria" value="<?= $dn['id_kriteria']; ?>" name='edit_id_kriteria[]'>
                 <div class="col-sm-12">
                     <input type="number" min="1" max="100" id="edit_id_nilaikriteria" value="<?= $dn['nilai_awal']; ?>" class="form-control" name="edit_id_nilaikriteria[]" required>
                 </div>
             </div>
         <?php } ?>
     </div>
     <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Update</button>
     </div>
 </form>