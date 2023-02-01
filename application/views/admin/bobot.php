<?php $this->load->view("admin/_partials/header.php") ?>
<div class="container-fluid py-4">
     <div class="row">
          <div class="col-12">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Bobot Penilaian</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <table id="dataBobotKriteria" class="table align-items-center mb-0" width="100%"></table>
                         </div>
                    </div>

                    <!-- Modal untuk edit data mahasiswa -->
                    <div class="modal fade" id="editBobotKriteria" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                   <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Bobot Kriteria</h5>
                                   </div>
                                   <div class="modal-body">
                                        <div id="formBobotKriteria">

                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

     </div>
     <?php $this->load->view("admin/_partials/footer.php") ?>

     <script>
          $(document).ready(function() {
               var dataBobotKriteria = $('#dataBobotKriteria').DataTable({
                    "processing": true,
                    "ajax": "<?= base_url("/admin/bobot/dataBobot") ?>",
                    stateSave: true,
                    columns: [{
                              title: "No",
                              "width": "10%"
                         },
                         {
                              title: "Kriteria",
                              "width": "50%"
                         },
                         {
                              title: "Bobot",
                              "width": "20%"
                         },
                         {
                              title: "Aksi",
                              "width": "20%"
                         },
                    ]
               })


               // ubah data
               $('#dataBobotKriteria').on('click', '.ubah-nilai-bobot', function() {
                    // ambil element id pada saat klik ubah
                    var id = $(this).data('id');

                    $.ajax({
                         type: "post",
                         url: "<?= base_url('/admin/bobot/formedit') ?>",
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
                              $('#editBobotKriteria').modal('show');
                              $('#formBobotKriteria').html(data);


                              // proses untuk mengubah data
                              $('#formeditbobot').on('submit', function() {
                                   var id = $('#idBobot').val(); //diambil dari id yang ada di form modal
                                   var bobot = $('#editbobot').val();
                                   $.ajax({
                                        type: "post",
                                        url: "<?= base_url('/admin/bobot/ubahDataBobot') ?>",
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
                                             bobot: bobot
                                        }, // ambil datanya dari form yang ada di variabel
                                        dataType: 'JSON',
                                        success: function(data) {
                                             console.log(data)
                                             if (data == true) {
                                                  dataBobotKriteria.ajax.reload(null, false);
                                                  Swal.fire(
                                                       'Success!',
                                                       'Data Berhasil diupdate',
                                                       'success'
                                                  )
                                                  // tutup form pada modal
                                                  $('#editBobotKriteria').modal('hide');

                                             } else {
                                                  swal.fire(
                                                       'Warning',
                                                       'total bobot tidak boleh lebih dari 100',
                                                       'error'
                                                  )
                                             }

                                        }
                                   })
                                   return false;
                              });

                         }
                    });


               });
          })
     </script>
     <?php $this->load->view("admin/_partials/script.php") ?>