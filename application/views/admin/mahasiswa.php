<?php $this->load->view("admin/_partials/header.php") ?>
<div class="container-fluid py-4">

     <div class="row">
          <!-- form input mahasiswa -->
          <div class="col-4">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Form Input Data Mahasiswa</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <form id="tambahmahasiswa">
                                   <div class="form-group row">
                                        <label class="col-form-label">Nama</label>
                                        <div class="col-sm-12">
                                             <input type="text" id="namamahasiswa" class="form-control" name="namamahasiswa" placeholder="nama mahasiswa" required>

                                        </div>
                                   </div>
                                   <div class="form-group row">
                                        <label class="col-form-label">NIM</label>
                                        <div class="col-sm-12">
                                             <input type="number" id="nim" class="form-control" name="nim" placeholder="nim" required>
                                        </div>
                                   </div>

                                   <div class="form-group row">
                                        <label class="col-form-label">Jurusan</label>
                                        <div class="col-sm-12">
                                             <select class="form-control" id="jurusan" name="jurusan" style="z-index: 10; position: relative;" required>
                                                  <option selected disabled>memilih...</option>
                                                  <optgroup label="D3">
                                                       <option>Sistem Informasi Akuntansi</option>
                                                       <option>Teknologi Komputer</option>
                                                       <option>Rekayasa Perangkat Lunak Aplikasi</option>
                                                  <optgroup label="S1">
                                                       <option>Informatika</option>
                                                       <option>Sistem Informasi</option>
                                                       <option>Teknik Komputer</option>
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

          <!-- table calon anggota -->
          <div class="col-8">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Data Mahasiswa</h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <table id="datamahasiswa" class="table align-items-center mb-0" width="100%"></table>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Modal untuk edit data mahasiswa-->
     <div class="modal fade" id="editmahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Edit Data Mahasiswa</h5>
                    </div>
                    <div class="modal-body">
                         <div id="formdatamahasiswa">

                         </div>
                    </div>
               </div>
          </div>



     </div>

     <?php $this->load->view("admin/_partials/footer.php") ?>

     <script>
          $(document).ready(function() {
               var datamahasiswa = $('#datamahasiswa').DataTable({
                    "processing": true,
                    "ajax": "<?= base_url("index.php/admin/mahasiswa/datamahasiswa") ?>",
                    stateSave: true,
                    columns: [{
                              title: "No"
                         },
                         {
                              title: "Nama"
                         },
                         {
                              title: "Nim"
                         },
                         {
                              title: "Jurusan"
                         },
                         {
                              title: "Aksi"
                         }
                    ],

               })


               //tambah data
               $('#tambahmahasiswa').on('submit', function() {
                    var nama = $('#nama').val(); // diambil dari id nama yang ada diform modal
                    var nim = $('#nim').val(); // diambil dari id alamat yanag ada di form modal 
                    var jurusan = $('#jurusan').val(); // diambil dari id jurusan yanag ada di form modal 

                    $.ajax({
                         type: "post",
                         url: "<?= base_url('index.php/admin/mahasiswa/add') ?>",
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
                              nim: nim,
                              jurusan: jurusan
                         }, // ambil datanya dari form yang ada di variabel
                         dataType: "JSON",
                         success: function(data) {
                              datamahasiswa.ajax.reload(null, false);
                              Swal.fire(
                                   'Good job!',
                                   'Data Berhasil ditambahkan',
                                   'success'
                              )
                         }
                    })
                    return false;
               });


               //edit data
               $('#datamahasiswa').on('click', '.ubah-mahasiswa', function() {
                    // ambil element id pada saat klik ubah
                    var id = $(this).data('id');
                    console.log(id);

                    $.ajax({
                         type: "post",
                         url: "<?= base_url('index.php/admin/mahasiswa/formedit') ?>",
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
                              $('#editmahasiswa').modal('show');
                              $('#formdatamahasiswa').html(data);


                              // proses untuk mengubah data
                              $('#formubahdatamhs').on('submit', function() {
                                   var editnama = $('#editnama').val(); // diambil dari id nama yang ada diform modal
                                   var editnim = $('#editnim').val(); // diambil dari id alamat yanag ada di form modal 
                                   var editjurusan = $('#editjurusan').val(); // diambil dari id alamat yanag ada di form modal 
                                   var id = $('#idmahasiswa').val(); //diambil dari id yang ada di form modal
                                   $.ajax({
                                        type: "post",
                                        url: "<?= base_url('index.php/admin/mahasiswa/ubahDatamahasiswa') ?>",
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
                                             editnim: editnim,
                                             editjurusan: editjurusan,
                                             id: id
                                        }, // ambil datanya dari form yang ada di variabel
                                        success: function(data) {
                                             datamahasiswa.ajax.reload(null, false);
                                             Swal.fire(
                                                  'Success!',
                                                  'Data Berhasil diupdate',
                                                  'success'
                                             )
                                             // tutup form pada modal
                                             $('#editmahasiswa').modal('hide');
                                        }
                                   })
                                   return false;
                              });

                         }
                    });


               });

               // fungsi untuk hapus data
               //pilih selector dari table id datamahasiswa dengan class .hapus-mahasiswa
               $('#datamahasiswa').on('click', '.hapus-mahasiswa', function() {
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
                                   url: "<?= base_url('index.php/admin/mahasiswa/hapus') ?>",
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
                                        datamahasiswa.ajax.reload(null, false)
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
          });
     </script>

     <?php $this->load->view("admin/_partials/script.php") ?>