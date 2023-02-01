<?php $this->load->view("admin/_partials/header.php") ?>
<div class="container-fluid py-4">
     <div class="row">
          <div class="col-12">
               <div class="card mb-4">
                    <div class="card-header pb-0">
                         <div class="row">
                              <div class="col-6">
                                   <h6>Hasil</h6>

                              </div>
                         </div>

                    </div>
                    <div class="card-body py-0 pt-0 pb-0">
                         <div class="px-0 pt-0 pb-2">

                              <h6>Data Awal</h6>
                              <table class="table align-items-center justify-content-center mb-0">
                                   <tr>
                                        <th rowspan="2">Alternative</th>
                                        <th colspan="<?= count($executeQueryTabel) ?>" style="text-align: center;">Kriteria</th>
                                   </tr>
                                   <tr>
                                        <?php foreach ($executeQueryTabel as $data) { ?>
                                             <th><?= $data['namaKriteria']; ?></th>
                                        <?php } ?>
                                   </tr>
                                   <?php foreach ($executeGetAlternative as $dataAlternative) { ?>
                                        <?php
                                        $query = "SELECT * from nilai_mahasiswa WHERE  id_mahasiswa='$dataAlternative[id_mahasiswa]'";
                                        $data =  $this->db->query($query);
                                        ?>
                                        <tr>
                                             <td><?= $dataAlternative['nama_mahasiswa']; ?></td>
                                             <?php foreach ($data->result_array() as $dataNilaiAwal) { ?>
                                                  <td><?= $dataNilaiAwal['nilai_awal'] ?></td>

                                             <?php } ?>



                                        </tr>
                                   <?php } ?>
                              </table>
                              <div><br></div>
                              <h6>Matriks Keputusan / Pembobotan</h6>
                              <table class="table align-items-center justify-content-center mb-0">
                                   <tr>
                                        <th rowspan="2">Alternative</th>
                                        <th colspan="<?= count($executeQueryTabel) ?>" style="text-align: center;">Kriteria</th>
                                   </tr>
                                   <tr>
                                        <?php foreach ($executeQueryTabel as $data) { ?>
                                             <th><?= $data['namaKriteria']; ?></th>
                                        <?php } ?>
                                   </tr>
                                   <?php foreach ($executeGetAlternative as $dataAlternative) { ?>
                                        <?php
                                        $query = "SELECT nilai_kriteria.nilai AS nilai,kriteria.sifat AS sifat,nilai_mahasiswa.id_kriteria AS id_kriteria FROM nilai_mahasiswa JOIN kriteria ON kriteria.id_kriteria=nilai_mahasiswa.id_kriteria JOIN nilai_kriteria ON nilai_kriteria.id_nilaikriteria=nilai_mahasiswa.id_nilaikriteria WHERE  id_mahasiswa='$dataAlternative[id_mahasiswa]'";
                                        $data =  $this->db->query($query);
                                        ?>
                                        <tr>
                                             <td><?= $dataAlternative['nama_mahasiswa']; ?></td>
                                             <?php $i = 0;
                                             foreach ($data->result_array() as $dataNilai) { ?>
                                                  <td><?= $dataNilai['nilai'] ?></td>
                                             <?php $nilaimahasiswa[$this->indexArray][$i] = array("sifat" => $dataNilai['sifat'], "id_kriteria" => $dataNilai['id_kriteria']);
                                                  $this->forminmax[$dataNilai['id_kriteria']][$this->indexArray] = $dataNilai['nilai'];
                                                  $i++;
                                             }

                                             $this->mahasiswaArray[$this->indexArray] = ["nama_mahasiswa" => $dataAlternative['nama_mahasiswa'], "id_mahasiswa" => $dataAlternative['id_mahasiswa']];
                                             $this->indexArray++;

                                             ?>

                                        </tr>
                                   <?php } ?>
                              </table>
                              <h6 class="px-1 pt-4 pb-2">Matriks Normalisasi</h6>
                              <table class="table align-items-center justify-content-center mb-0">
                                   <tr>
                                        <th rowspan="2">Alternative</th>
                                        <th colspan="<?= count($executeQueryTabel) ?>" style="text-align: center;">Kriteria</th>
                                   </tr>
                                   <tr>
                                        <?php foreach ($executeQueryTabel as $data) { ?>
                                             <th><?= $data['namaKriteria']; ?></th>
                                        <?php } ?>
                                   </tr>
                                   <?php function normalisasi($value, $arrayValue, $sifat)
                                   {
                                        if ($sifat == 'benefit') {
                                             $result = $value / max($arrayValue);
                                        } elseif ($sifat == 'cost') {
                                             $result = min($arrayValue) / $value;
                                        }
                                        return round($result, 3);
                                   }
                                   $simpanrangking = array();
                                   for ($j = 0; $j < count($this->mahasiswaArray); $j++) { ?>
                                        <tr>
                                             <td><?= $this->mahasiswaArray[$j]['nama_mahasiswa'] ?></td>
                                             <?php for ($k = 0; $k < count($nilaimahasiswa[$j]); $k++) {
                                                  $idKriteria = $nilaimahasiswa[$j][$k]['id_kriteria'];
                                                  echo "<td>" . $hasil = normalisasi($this->forminmax[$idKriteria][$j], $this->forminmax[$idKriteria], $nilaimahasiswa[$j][$k]["sifat"]) . "</td>";
                                                  $simpanrangking[$j][$k] = floatval($hasil) * $this->bobotArray[$idKriteria];
                                             } ?>
                                        </tr>
                                   <?php } ?>
                              </table>

                              <h6 class="px-1 pt-4 pb-2">Matriks Preferensi</h6>
                              <table class="table align-items-center justify-content-center mb-0">
                                   <tr>
                                        <th rowspan="3">Alternative</th>
                                        <th colspan="<?= count($executeQueryTabel) ?>" style="text-align: center;">Kriteria</th>
                                        <th rowspan='3'>Hasil</th>
                                   </tr>
                                   <tr>
                                        <?php foreach ($executeQueryTabel as $data) { ?>
                                             <th><?= $data['namaKriteria']; ?></th>
                                        <?php } ?>
                                   </tr>
                                   <tr>
                                        <?php foreach ($executeQueryTabel as $data) { ?>
                                             <th><?= $data['bobot']; ?></th>
                                        <?php } ?>
                                   </tr>
                                   <?php
                                   for ($j = 0; $j < count($this->mahasiswaArray); $j++) {
                                        $hasilakhir = 0; ?>
                                        <tr>
                                             <td><?= $this->mahasiswaArray[$j]['nama_mahasiswa'] ?></td>
                                             <?php for ($k = 0; $k < count($simpanrangking[$j]); $k++) { ?>
                                                  <td><?= $hasil = $simpanrangking[$j][$k] ?></td>
                                             <?php $hasilakhir += floatval($hasil);
                                             }
                                             $this->hasil_model->simpanHasil($this->mahasiswaArray[$j]['id_mahasiswa'], round($hasilakhir, 3));
                                             ?>
                                             <td><?= round($hasilakhir, 3) ?></td>

                                        </tr>
                                   <?php } ?>
                              </table>


                              <h6 class="px-1 pt-4 pb-2">Hasil</h6>
                              <p>Berikut ini merupakan hasil rekomendasi Calon Presiden Mahasiswa Universitas Teknologi Digital Indonesia</p>
                              <table class="table align-items-center justify-content-center mb-0">
                                   <tr>
                                        <th>NIM</th>
                                        <th>Alternative</th>
                                        <th>Hasil</th>
                                        <th>Rank</th>
                                   </tr>
                                   <?php $no = 1;
                                   foreach ($urutNilaiAnggota as $nilaiAnggota) { ?>
                                        <tr>

                                             <td><?= $nilaiAnggota['nim']; ?></td>
                                             <td><?= $nilaiAnggota['nama_mahasiswa']; ?></td>
                                             <td><?= $nilaiAnggota['hasil']; ?></td>
                                             <td><?= $no++ ?></td>

                                        <tr>
                                        <?php } ?>
                              </table>


                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<?php $this->load->view("admin/_partials/footer.php") ?>

<?php $this->load->view("admin/_partials/script.php") ?>