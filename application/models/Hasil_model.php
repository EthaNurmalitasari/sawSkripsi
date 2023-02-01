<?php defined('BASEPATH') OR exit('No direct script access allowed');
$valueMinMax=array(); $kriteriaArray=array(); $mahasiswaArray=array(); $forminmax=array(); $simpanNormalisasi=array(); $bobotArray=array();

class Hasil_model extends CI_Model
{
   

    public function getDataKriteria() {
           $query = $this->db->query("SELECT kriteria.namaKriteria, bobot_kriteria.bobot FROM bobot_kriteria
            inner join kriteria
            on bobot_kriteria.id_kriteria = kriteria.id_kriteria");
            return $query->result_array();
            
         
    }

    public function datamahasiswa() {
        $queryAlternative = $this->db->query("select mahasiswa.nama_mahasiswa AS nama_mahasiswa,id_mahasiswa from nilai_mahasiswa INNER JOIN mahasiswa USING(id_mahasiswa) GROUP BY id_mahasiswa ORDER BY  nama_mahasiswa ASC");
        return $queryAlternative->result_array();

    }

    public function Bobot() {
        $queryBobot="SELECT id_kriteria,bobot FROM bobot_kriteria";
        $executeBobot=$this->db->query($queryBobot);
        return $executeBobot->result_array();
            
    }


   public function simpanHasil($id_mahasiswa,$hasil){
        $queryCek="SELECT hasil FROM hasil WHERE id_mahasiswa='$id_mahasiswa'";
        $execute=$this->db->query($queryCek)->result_array();
        if (count($execute) > 0) {
            $querySimpan="UPDATE hasil SET hasil='$hasil' WHERE id_mahasiswa='$id_mahasiswa'";
        }else{
            $querySimpan="INSERT INTO hasil(hasil,id_mahasiswa) VALUES ('$hasil','$id_mahasiswa')";
        }
        $execute=$this->db->query($querySimpan);

    }

    public function urutNilaiAnggota() {
        $queryAlternative = $this->db->query("select * from mahasiswa inner join hasil on mahasiswa.id_mahasiswa=hasil.id_mahasiswa order by hasil.hasil desc");
        return $queryAlternative->result_array();


    }

   



}
