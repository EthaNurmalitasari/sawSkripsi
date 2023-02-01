<?php $this->load->view("admin/_partials/header.php") ?>
<div class="container-fluid py-4">
     <div class="row">
          <div class="col-12">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Update Password</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <form id="updatepassword">
                                   <div class="form-group row">
                                        <label class="col-form-label">Username</label>
                                        <div class="col-sm-12">
                                             <input type="text" id="username" class="form-control" name="username" value="<?= $current_user->username ?>" placeholder="username" required>
                                             <input type="text" id="id" value="<?= $current_user->Id_user ?>" hidden>

                                        </div>
                                   </div>
                                   <div class="form-group row">
                                        <label class="col-form-label">Password Lama</label>
                                        <div class="col-sm-12">
                                             <input type="password" id="passwordLama" class="form-control" placeholder="password lama" required>
                                        </div>
                                   </div>
                                   <div class="form-group row">
                                        <label class="col-form-label">Password Baru</label>
                                        <div class="col-sm-12">
                                             <input type="password" id="password" class="form-control" name="password" placeholder="password" required>
                                        </div>
                                   </div>

                                   <div class="form-group row">
                                        <div class="col-sm-12">
                                             <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                   </div>
                              </form>
                         </div>



                    </div>
               </div>
          </div>

     </div>
     <?php $this->load->view("admin/_partials/footer.php") ?>

     <script>
          $(document).ready(function() {
               //tambah data
               $('#updatepassword').on('submit', function() {
                    var id = $('#id').val()
                    var username = $('#username').val();
                    var passwordLama = $('#passwordLama').val();
                    var password = $('#password').val();

                    console.log("<?= $current_user->text ?>")

                    if (passwordLama == '<?= $current_user->text ?>') {
                         $.ajax({
                              type: "post",
                              url: "<?= base_url('/admin/DataPengurus/update') ?>",
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
                                   username: username,
                                   password: password
                              }, // ambil datanya dari form yang ada di variabel
                              dataType: "JSON",
                              success: function(data) {
                                   Swal.fire(
                                        'Good job!',
                                        'Data Berhasil ditambahkan',
                                        'success'
                                   )
                              }
                         })

                    } else {
                         swal.fire(
                              'Salah',
                              'Password Lama yang dimasukkan salah',
                              'error'
                         )

                    }


                    return false;
               });

          });
     </script>

     <?php $this->load->view("admin/_partials/script.php") ?>