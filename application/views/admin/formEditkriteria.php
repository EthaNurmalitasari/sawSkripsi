 <form id="formeditKriteria">
     <div class="form-group row">
         <label class="col-form-label">Nama Kriteria</label>
         <div class="col-sm-12">
             <input type="text" value="<?= $dataKriteria['namaKriteria'] ?>" id="editnamaKriteria" class="form-control" name="namaKriteria" placeholder="nama kriteria" required>
             <!-- id calon kriteria -->
             <input type="hidden" name="id" id="idKriteria" value="<?= $dataKriteria['id_kriteria'] ?>">
         </div>
     </div>
     <div class="form-group row">
         <label class="col-form-label">Sifat</label>
         <div class="col-sm-12">
             <select id="editsifat" class="form-control" name="editsifat" required>
                 <option selected="true" disabled="disabled"> Pilih Sifat
                 </option <?= $dataKriteria['sifat'] == 'benefit' ? 'selected' : '' ?>>
                 <option> benefit
                 </option>
                 <option <?= $dataKriteria['sifat'] == 'cost' ? 'selected' : '' ?>> cost
                 </option>
             </select>

         </div>
     </div>
     <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Update</button>
     </div>
 </form>