<?php $this->load->view("admin/_partials/header.php") ?>
<div class="container-fluid py-4">
     <!-- row kriteria -->
     <div class="row">
          <!-- form input kriteria -->
          <div class="col-4">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Form Input Kriteria</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <form id="tambahKriteria">
                                   <div class="form-group row">
                                        <label class="col-form-label">Nama Kriteria</label>
                                        <div class="col-sm-12">
                                             <input type="text" id="namaKriteria" class="form-control" name="namaKriteria" placeholder="nama kriteria" required>

                                        </div>
                                   </div>
                                   <div class="form-group row">
                                        <label class="col-form-label">Sifat</label>
                                        <div class="col-sm-12">
                                             <select id="sifat" class="form-control" name="sifat" required>
                                                  <option selected="true" disabled="disabled"> pilih sifat
                                                  </option>
                                                  <option value="benefit"> benefit
                                                  </option>
                                                  <option value="cost"> cost
                                                  </option>
                                             </select>

                                        </div>
                                   </div>
                                   <div class="form-group row">
                                        <div class="col-sm-12">
                                             <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                   </div>
                              </form>
                         </div>



                    </div>
               </div>
          </div>

          <!-- table kriteria anggota -->
          <div class="col-8">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Data Kriteria</h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <table id="dataKriteria" class="table align-items-center mb-0" width="100%"></table>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Modal untuk edit data kriteria -->
          <div class="modal fade" id="editKriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Nama Kriteria</h5>
                         </div>
                         <div class="modal-body">
                              <div id="formdataKriteria">

                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <!-- end row kriteria -->


          <div class="row">
               <!-- form input kriteria -->
               <div class="col-4">
                    <div class="card mb-4">
                         <div class="card-header pb-0">
                              <h6>Form Input Sub Kriteria</h6>
                         </div>
                         <div class="card-body px-0 pt-0 pb-2">
                              <div class="px-3 py-2">
                                   <form id="tambahnilaiKriteria">
                                        <div class="form-group row">
                                             <label class="col-form-label">Nama Kriteria</label>
                                             <div class="col-sm-12">
                                                  <select class="form-control namaKriteriaS" id="namaKriteriaS" name="namaKriteriaS" required>
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label class="col-form-label">Keterangan</label>
                                             <div class="col-sm-12">
                                                  <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="keterangan" required>

                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label class="col-form-label">Nilai</label>
                                             <div class="col-sm-12">
                                                  <input type="number" id="nilaiSubKriterita" class="form-control" name="nilaiSubKriterita" placeholder="nilai" required>

                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <div class="col-sm-12">
                                                  <button type="submit" class="btn btn-primary">Tambah</button>
                                             </div>
                                        </div>
                                   </form>
                              </div>



                         </div>
                    </div>
               </div>

               <!-- table kriteria -->
               <div class="col-8">
                    <div class="card mb-4">
                         <div class="card-header pb-0">
                              <h6>Data Sub Kriteria</h6>
                         </div>

                         <div class="card-body px-0 pt-0 pb-2">
                              <div class="px-3 py-2">
                                   <table id="datanilaikriteria" class="table align-items-center mb-0" width="100%"></table>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- Modal untuk edit data mahasiswa -->
               <div class="modal fade" id="editnilaiKriteria" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Edit Data Nilai Kriteria</h5>
                              </div>
                              <div class="modal-body">
                                   <div id="formEditNilaiKriteria">

                                   </div>
                              </div>
                         </div>
                    </div>
               </div>


          </div>

          <?php $this->load->view("admin/_partials/footer.php") ?>
          <script>
               $(document).ready(function() {
                    //  data table untuk menampilkan kriteria
                    var dataKriteria = $('#dataKriteria').DataTable({
                         "processing": true,
                         "ajax": "<?= base_url("index.php/admin/kriteria/dataKriteria") ?>",
                         stateSave: true,
                         columns: [{
                                   title: "No",
                                   "width": "10%"
                              },
                              {
                                   title: "Nama",
                                   "width": "70%"
                              },
                              {
                                   title: "Sifat",
                                   "width": "70%"
                              },
                              {
                                   title: "Aksi",
                                   "width": "20%"
                              },
                         ],

                         "iDisplayLength": 4,
                         "aLengthMenu": [
                              [4],
                              [4]
                         ]
                    })

                    // data table untuk menampilkan data sub kriteria
                    var datanilaikriteria = $('#datanilaikriteria').DataTable({
                         "processing": true,
                         "ajax": "<?= base_url("index.php/admin/NilaiKriteria/datanilaikriteria") ?>",
                         stateSave: true,
                         columns: [{
                                   title: "No",
                                   "width": "10%"
                              },
                              {
                                   title: "Nama Kriteria",
                                   "width": "30%"
                              },
                              {
                                   title: "keterangan",
                                   "width": "20%"
                              },
                              {
                                   title: "Nilai",
                                   "width": "20%"
                              },

                              {
                                   title: "Aksi",
                                   "width": "20%"
                              },
                         ],

                         "iDisplayLength": 4,
                         "aLengthMenu": [
                              [4],
                              [4]
                         ]
                    })

                    $('.namaKriteriaS').select2({
                         theme: "classic",
                         ajax: {
                              dataType: 'json',
                              url: '<?= base_url("index.php/admin/kriteria/dropDown") ?>',
                              delay: 250,
                              data: function(params) {
                                   return {
                                        q: params.term
                                   }
                              },
                              processResults: function(data) {
                                   var results = [];
                                   $.each(data, function(index, item) {
                                        results.push({
                                             id: item.id_kriteria,
                                             text: item.namaKriteria
                                        })
                                   });

                                   return {
                                        results: results
                                   };
                              },
                         }
                    })


                    // kriteria CRUD  
                    //tambah data kriteria
                    $('#tambahKriteria').on('submit', function() {
                         var nama = $('#namaKriteria').val(); // diambil dari id nama yang ada diform modal
                         var sifat = $('#sifat').val();

                         $.ajax({
                              type: "post",
                              url: "<?= base_url('index.php/admin/kriteria/add') ?>",
                              beforeSend: function() {
                                   swal.fire({
                                        title: 'Menunggu',
                                        html: 'Memproses data',
                                        didOpen: () => {
                                             swal.showLoading()
                                        }
                                   })
                              },
                              data: {
                                   nama: nama,
                                   sifat: sifat
                              }, // ambil datanya dari form yang ada di variabel
                              dataType: "JSON",
                              success: function(data) {
                                   dataKriteria.ajax.reload(null, false);
                                   Swal.fire(
                                        'Good job!',
                                        'Data Berhasil ditambahkan',
                                        'success'
                                   );
                                   $('#namaKriteria').val('');
                              }

                         })
                         return false;
                    });


                    //edit data kriteria
                    $('#dataKriteria').on('click', '.ubah-kriteria', function() {
                         // ambil element id pada saat klik ubah
                         var id = $(this).data('id');

                         $.ajax({
                              type: "post",
                              url: "<?= base_url('index.php/admin/kriteria/formedit') ?>",
                              beforeSend: function() {
                                   swal.fire({
                                        title: 'Menunggu',
                                        html: 'Memproses data',
                                        didOpen: () => {
                                             swal.showLoading()
                                        }
                                   })
                              },
                              data: {
                                   id: id
                              },
                              success: function(data) {
                                   swal.close();
                                   $('#editKriteria').modal('show');
                                   $('#formdataKriteria').html(data);


                                   // proses untuk mengubah data
                                   $('#formeditKriteria').on('submit', function() {
                                        var editnama = $('#editnamaKriteria').val(); // diambil dari id nama yang ada diform modal
                                        var id = $('#idKriteria').val();
                                        var editsifat = $('#editsifat').val() //diambil dari id yang ada di form modal
                                        $.ajax({
                                             type: "post",
                                             url: "<?= base_url('index.php/admin/kriteria/ubahDataKriteria') ?>",
                                             beforeSend: function() {
                                                  swal.fire({
                                                       title: 'Menunggu',
                                                       html: 'Memproses data',
                                                       didOpen: () => {
                                                            swal.showLoading()
                                                       }
                                                  })
                                             },
                                             data: {
                                                  editnama: editnama,
                                                  editsifat: editsifat,
                                                  id: id
                                             }, // ambil datanya dari form yang ada di variabel
                                             success: function(data) {
                                                  dataKriteria.ajax.reload(null, false);
                                                  datanilaikriteria.ajax.reload(null, false)
                                                  Swal.fire(
                                                       'Success!',
                                                       'Data Berhasil diupdate',
                                                       'success'
                                                  )
                                                  // tutup form pada modal
                                                  $('#editKriteria').modal('hide');
                                             }
                                        })
                                        return false;
                                   });

                              }
                         });


                    });

                    // fungsi untuk hapus data kriteria
                    $('#dataKriteria').on('click', '.hapus-kriteria', function() {
                         var id = $(this).data('id');
                         swal.fire({
                              title: 'Anda Yakin?',
                              text: "Data yang terhapus tidak dapat dikembalikan!",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonText: 'Iya',
                              cancelButtonText: 'Tidak',
                              confirmButtonColor: '#cb0c9f',
                              cancelButtonColor: '#6c757d',
                              reverseButtons: true
                         }).then((result) => {
                              if (result.value) {
                                   $.ajax({
                                        url: "<?= base_url('index.php/admin/kriteria/hapus') ?>",
                                        method: "post",
                                        beforeSend: function() {
                                             swal.fire({
                                                  title: 'Menunggu',
                                                  html: 'Memproses data',
                                                  didOpen: () => {
                                                       swal.showLoading()
                                                  }
                                             })
                                        },
                                        data: {
                                             id: id
                                        },
                                        success: function(data) {
                                             swal.fire(
                                                  'Hapus',
                                                  'Berhasil Terhapus',
                                                  'success'
                                             )
                                             dataKriteria.ajax.reload(null, false)
                                        }
                                   })
                              } else if (result.dismiss === swal.DismissReason.cancel) {
                                   swal.fire(
                                        'Batal',
                                        'Anda membatalkan penghapusan',
                                        'error'
                                   )
                              }
                         })
                    });

                    // end of kriteria CRUD

                    // sub kriteria CRUD




                    //tambah data sub kriteria
                    $('#tambahnilaiKriteria').on('submit', function() {

                         var id = $('#namaKriteriaS').val(); // diambil dari id nama yang ada diform modal
                         var keterangan = $('#keterangan').val();
                         var nilai = $('#nilaiSubKriterita').val();

                         $.ajax({
                              type: "post",
                              url: "<?= base_url('index.php/admin/NilaiKriteria/add') ?>",
                              beforeSend: function() {
                                   swal.fire({
                                        title: 'Menunggu',
                                        html: 'Memproses data',
                                        didOpen: () => {
                                             swal.showLoading()
                                        }
                                   })
                              },
                              data: {
                                   id: id,
                                   keterangan: keterangan,
                                   nilai: nilai
                              }, // ambil datanya dari form yang ada di variabel
                              dataType: "JSON",
                              success: function(data) {
                                   datanilaikriteria.ajax.reload(null, false);
                                   Swal.fire(
                                        'Good job!',
                                        'Data Berhasil ditambahkan',
                                        'success'
                                   )
                                   $('#namaKriteriaS').val('');
                                   $('#keterangan').val('');
                                   $('#nilaiSubKriterita').val('');
                              }
                         })
                         return false;
                    });


                    //edit data sub kriteria
                    $('#datanilaikriteria').on('click', '.ubah-nilai-kriteria', function() {
                         // ambil element id pada saat klik ubah
                         var id = $(this).data('id');
                         console.log(id);

                         $.ajax({
                              type: "post",
                              url: "<?= base_url('index.php/admin/NilaiKriteria/formedit') ?>",
                              beforeSend: function() {
                                   swal.fire({
                                        title: 'Menunggu',
                                        html: 'Memproses data',
                                        didOpen: () => {
                                             swal.showLoading()
                                        }
                                   })
                              },
                              data: {
                                   id: id
                              },
                              success: function(data) {
                                   swal.close();
                                   $('#editnilaiKriteria').modal('show');
                                   $('#formEditNilaiKriteria').html(data);


                                   // proses untuk mengubah data
                                   $('#editnilaiKriteria').on('submit', function() {
                                        var editNilai = $('#nilaiKriteritaEdit').val(); // diambil dari id nama yang ada diform modal
                                        var editKeterangan = $('#keteranganEdit').val(); // diambil dari id nama yang ada diform modal
                                        var id = $('#id_nilaiKriteria').val(); //diambil dari id yang ada di form modal
                                        $.ajax({
                                             type: "post",
                                             url: "<?= base_url('index.php/admin/NilaiKriteria/ubahdatanilaikriteria') ?>",
                                             beforeSend: function() {
                                                  swal.fire({
                                                       title: 'Menunggu',
                                                       html: 'Memproses data',
                                                       didOpen: () => {
                                                            swal.showLoading()
                                                       }
                                                  })
                                             },
                                             data: {
                                                  nilai: editNilai,
                                                  keterangan: editKeterangan,
                                                  id: id
                                             }, // ambil datanya dari form yang ada di variabel
                                             success: function(data) {
                                                  datanilaikriteria.ajax.reload(null, false);
                                                  Swal.fire(
                                                       'Success!',
                                                       'Data Berhasil diupdate',
                                                       'success'
                                                  )
                                                  // tutup form pada modal
                                                  $('#editnilaiKriteria').modal('hide');
                                             }
                                        })
                                        return false;
                                   });

                              }
                         });


                    });

                    // fungsi untuk hapus data kriteria
                    $('#datanilaikriteria').on('click', '.hapus-nilai-kriteria', function() {
                         var id = $(this).data('id');
                         swal.fire({
                              title: 'Anda Yakin?',
                              text: "Data yang terhapus tidak dapat dikembalikan!",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonText: 'Iya',
                              cancelButtonText: 'Tidak',
                              confirmButtonColor: '#cb0c9f',
                              cancelButtonColor: '#6c757d',
                              reverseButtons: true
                         }).then((result) => {
                              if (result.value) {
                                   $.ajax({
                                        url: "<?= base_url('index.php/admin/NilaiKriteria/hapus') ?>",
                                        method: "post",
                                        beforeSend: function() {
                                             swal.fire({
                                                  title: 'Menunggu',
                                                  html: 'Memproses data',
                                                  didOpen: () => {
                                                       swal.showLoading()
                                                  }
                                             })
                                        },
                                        data: {
                                             id: id
                                        },
                                        success: function(data) {
                                             swal.fire(
                                                  'Hapus',
                                                  'Berhasil Terhapus',
                                                  'success'
                                             )
                                             datanilaikriteria.ajax.reload(null, false)
                                        }
                                   })
                              } else if (result.dismiss === swal.DismissReason.cancel) {
                                   swal.fire(
                                        'Batal',
                                        'Anda membatalkan penghapusan',
                                        'error'
                                   )
                              }
                         })
                    });

                    // end of criteria CRUD


               });
          </script>

          <?php $this->load->view("admin/_partials/script.php") ?>