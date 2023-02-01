<?php $this->load->view("admin/_partials/header.php") ?>
<div class="container-fluid py-4">
     <div class="row">
          <!-- form input kriteria mahasiswa -->
          <div class="col-4">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Form Input Nilai</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <form id="tambah">
                                   <div class="form-group row">
                                        <label class="col-form-label">Nama Mahasiswa</label>
                                        <div class="col-sm-12">
                                             <select class="form-control nama_mahasiswa" id="nama_mahasiswa" name="nama_mahasiswa" required>
                                             </select>
                                        </div>

                                   </div>
                                   <?php foreach ($dataKriteria as $k) { ?>
                                        <div class="form-group row">
                                             <label class="col-form-label"><?= $k['namaKriteria']; ?></label>
                                             <input type="text" class="id_kriteria" hidden id="id_kriteria" value="<?= $k['id_kriteria']; ?>" name='id_kriteria[]'>
                                             <div class="col-sm-12">
                                                  <input type="number" min="1" max="100" id="id_nilaikriteria" class="form-control id_nilaikriteria" name="id_nilaikriteria[]" required>
                                             </div>
                                        </div>
                                   <?php } ?>
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

          <!-- table kriteria mahasiswa -->
          <div class="col-8">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6>Data Nilai Mahasiswa</h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="px-3 py-2">
                              <table id="dataNilai" class="table align-items-center mb-0" width="100%"></table>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Modal untuk edit data kriteria -->
          <div class="modal fade" id="editNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Nilai Mahasiswa</h5>
                         </div>
                         <div class="modal-body">
                              <div id="formDataNilai">

                              </div>
                         </div>
                    </div>
               </div>
          </div>

     </div>
     <?php $this->load->view("admin/_partials/footer.php") ?>

     <script>
          $(document).ready(function() {
               var dataNilai = $('#dataNilai').DataTable({
                    "processing": true,
                    "ajax": "<?= base_url("index.php/admin/penilaian/dataNilai") ?>",
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
                              title: "Aksi",
                              "width": "20%"
                         },
                    ],

                    "iDisplayLength": 5
               })

               $('.nama_mahasiswa').select2({
                    theme: "classic",
                    ajax: {
                         dataType: 'json',
                         url: '<?= base_url("index.php/admin/mahasiswa/dropDown") ?>',
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
                                        id: item.id_mahasiswa,
                                        text: item.nama_mahasiswa
                                   })
                              });

                              return {
                                   results: results
                              };
                         },
                    }
               })


               $('#tambah').on('submit', function() {
                    var kriteria = $("input[name='id_kriteria[]']")
                         .map(function() {
                              return $(this).val();
                         }).get();

                    var nilai = $("input[name='id_nilaikriteria[]']")
                         .map(function() {
                              return $(this).val();
                         }).get();

                    var id_mahasiswa = $('#nama_mahasiswa').val();

                    for (i in kriteria) {
                         data = {
                              id_mahasiswa: id_mahasiswa,
                              id_kriteria: kriteria[i],
                              id_nilaikriteria: nilai[i]
                         }
                         postData(data)
                    }
                    // dataNilai.reload(false)

                    return false;

               });

               async function postData(tambahData) {
                    var result = await $.ajax({
                         type: "post",
                         url: "<?= base_url('index.php/admin/penilaian/add') ?>",
                         beforeSend: function() {
                              swal.fire({
                                   title: 'Menunggu',
                                   html: 'Memproses data',
                                   didOpen: () => {
                                        swal.showLoading()
                                   }
                              })
                         },
                         data: tambahData
                    })
                    Swal.fire(
                         'Success!',
                         'Data Berhasil ditambahkan',
                         'success'
                    )

                    return result

               }



               $('#dataNilai').on('click', '.ubah-nilai', function() {
                    // ambil element id pada saat klik ubah
                    var id = $(this).data('id');
                    $.ajax({
                         type: "post",
                         url: "<?= base_url('index.php/admin/penilaian/formedit') ?>",
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
                              $('#editNilai').modal('show');
                              $('#formDataNilai').html(data);

                              $('#formEditNilaimahasiswa').on('submit', function() {
                                   console.log('submit button')
                                   // proses untuk mengubah data
                                   var kriteria_edit = $("input[name='edit_id_kriteria[]']").map(function() {
                                        return $(this).val();
                                   }).get();

                                   var nilai_edit = $("input[name='edit_id_nilaikriteria[]']")
                                        .map(function() {
                                             return $(this).val();
                                        }).get();
                                   var id_mahasiswa = $('#edit_id_mahasiswa').val();

                                   for (i in kriteria_edit) {
                                        data = {
                                             id_mahasiswa: id_mahasiswa,
                                             id_kriteria: kriteria_edit[i],
                                             id_nilaikriteria: nilai_edit[i]
                                        }
                                        ubahData(data)

                                   }
                                   return false;
                              });

                         }
                    });
               })


               async function ubahData(updateNilai) {
                    var result = await $.ajax({
                         type: "post",
                         url: "<?= base_url('index.php/admin/penilaian/ubahDataNilai') ?>",
                         beforeSend: function() {
                              swal.fire({
                                   title: 'Menunggu',
                                   html: 'Memproses data',
                                   didOpen: () => {
                                        swal.showLoading()
                                   }
                              })
                         },
                         data: updateNilai,
                         success: function(data) {
                              dataNilai.ajax.reload(null, false);
                         }
                    })
                    Swal.fire(
                         'Success!',
                         'Data Berhasil diupdate',
                         'success'
                    )

                    // tutup form pada modal
                    $('#editNilai').modal('hide');

                    return result

               }

               $('#dataNilai').on('click', '.hapus-nilai', function() {
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
                                   url: "<?= base_url('index.php/admin/penilaian/hapus') ?>",
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
                                        dataNilai.ajax.reload(null, false)
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





          })
     </script>


     <?php $this->load->view("admin/_partials/script.php") ?>