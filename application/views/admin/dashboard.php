<?php $this->load->view("admin/_partials/header.php") ?>
<div class="container-fluid py-4">
     <div class="row">
          <div class="col-6">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <h6 class="font-weight-bolder">Anda berhasil login sebagai <?= $current_user->username; ?></h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                         <div class="table-responsive p-0">

                         </div>
                    </div>
               </div>
          </div>
     </div>
     <?php $this->load->view("admin/_partials/footer.php") ?>



     <?php $this->load->view("admin/_partials/script.php") ?>