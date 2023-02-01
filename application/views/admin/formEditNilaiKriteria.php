 <form id="formEditNilaiKriteria">
     <div class="form-group row">
         <label class="col-form-label">Nama Kriteria</label>
         <div class="col-sm-12">
             <input type="text" value="<?= $datanilaikriteria['namaKriteria'] ?>" class="form-control" readonly>
             <input type="hidden" name="id" id="id_nilaiKriteria" value="<?= $datanilaikriteria['id_nilaikriteria'] ?>">
         </div>
     </div>
     <div class="form-group row">
         <label class="col-form-label">Keterangan</label>
         <div class="col-sm-12">
             <input type="text" id="keteranganEdit" value="<?= $datanilaikriteria['keterangan'] ?>" class="form-control" name="keterangan" placeholder="keterangan" required>

         </div>
     </div>
     <div class="form-group row">
         <label class="col-form-label">Nilai</label>
         <div class="col-sm-12">
             <input type="number" value="<?= $datanilaikriteria['nilai'] ?>" id="nilaiKriteritaEdit" class="form-control" placeholder="nilai" required>

         </div>
     </div>
     <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Update</button>
     </div>
 </form>