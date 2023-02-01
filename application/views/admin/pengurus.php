<?php $this->load->view("admin/_partials/header.php") ?>
<div class="container-fluid py-4">
     <div class="row">
          <div class="col-4">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Form Input Data Pengurus</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <form id="tambahPengurus">
                                   <div class="form-group row">
                                        <label class="col-form-label">Username</label>
                                        <div class="col-sm-12">
                                             <input type="text" id="username" class="form-control" name="username" placeholder="username" required>

                                        </div>
                                   </div>
                                   <div class="form-group row">
                                        <label class="col-form-label">Password</label>
                                        <div class="col-sm-8">
                                             <input type="text" id="password" class="form-control" name="password" placeholder="password" required readonly>
                                        </div>
                                        <div class="col-sm-4">
                                             <button type="button" class="btn btn-primary" onClick="random_String_Generator(); return false;"> Generate </button>
                                        </div>
                                   </div>

                                   <div class="form-group row">
                                        <label class="col-form-label">Level</label>
                                        <div class="col-sm-12">
                                             <select class="form-control" id="level" name="level" style="z-index: 10; position: relative;" required>
                                                  <option selected disabled>memilih...</option>
                                                  <option value="1">Admin</option>
                                                  <option value="2">Pengurus</option>

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
                         <h6>Data Pengurus</h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <table id="dataPengurus" class="table align-items-center mb-0" width="100%"></table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <?php $this->load->view("admin/_partials/footer.php") ?>

     <script>
          function random_String_Generator() {
               var result = Math.random().toString(36).slice(2);
               $('#password').val(result);

          }
          $(document).ready(function() {
               var dataPengurus = $('#dataPengurus').DataTable({
                    "processing": true,
                    "ajax": "<?= base_url("/admin/DataPengurus/data") ?>",
                    stateSave: true,
                    columns: [{
                              title: "No"
                         },
                         {
                              title: "username"
                         },
                         {
                              title: "password"
                         },
                         {
                              title: "level"
                         },
                         {
                              title: "Aksi"
                         }
                    ],

               })




               //tambah data
               $('#tambahPengurus').on('submit', function() {
                    console.log("testaing");
                    var username = $('#username').val(); // diambil dari id nama yang ada diform modal
                    var password = $('#password').val(); // diambil dari id alamat yanag ada di form modal 
                    var level = $('#level').val(); // diambil dari id jurusan yanag ada di form modal 

                    $.ajax({
                         type: "post",
                         url: "<?= base_url('/admin/DataPengurus/add') ?>",
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
                              username: username,
                              password: password,
                              level: level
                         }, // ambil datanya dari form yang ada di variabel
                         dataType: "JSON",
                         success: function(data) {
                              dataPengurus.ajax.reload(null, false);
                              Swal.fire(
                                   'Good job!',
                                   'Data Berhasil ditambahkan',
                                   'success'
                              )
                         }
                    })
                    return false;
               });

               // fungsi untuk hapus data
               //pilih selector dari table id dataCalonAnggota dengan class .hapus-mahasiswa
               $('#dataPengurus').on('click', '.hapus-mahasiswa', function() {
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
                                   url: "<?= base_url('/admin/DataPengurus/hapus') ?>",
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
                                        dataPengurus.ajax.reload(null, false)
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